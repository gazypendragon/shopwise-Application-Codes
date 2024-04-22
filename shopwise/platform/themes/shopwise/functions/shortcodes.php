<?php

use Botble\Ads\Facades\AdsManager;
use Botble\Ads\Models\Ads;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Models\FlashSale;
use Botble\Ecommerce\Models\ProductCollection;
use Botble\Faq\Models\FaqCategory;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\SimpleSlider\Models\SimpleSlider;
use Botble\Testimonial\Models\Testimonial;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;

app()->booted(function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('ecommerce')) {
        add_shortcode(
            'featured-product-categories',
            __('Featured Product Categories'),
            __('Featured Product Categories'),
            function (Shortcode $shortcode) {
                $categories = get_featured_product_categories();

                return Theme::partial('shortcodes.featured-product-categories.index', [
                    'shortcode' => $shortcode,
                    'categories' => $categories,
                ]);
            }
        );

        shortcode()->setAdminConfig('featured-product-categories', function (array $attributes) {
            return Theme::partial('shortcodes.featured-product-categories.admin-config', compact('attributes'));
        });

        add_shortcode('featured-brands', __('Featured Brands'), __('Featured Brands'), function (Shortcode $shortcode) {
            $brands = get_featured_brands();

            return Theme::partial('shortcodes.featured-brands.index', compact('brands', 'shortcode'));
        });

        shortcode()->setAdminConfig('featured-brands', function (array $attributes) {
            return Theme::partial('shortcodes.featured-brands.admin-config', compact('attributes'));
        });

        add_shortcode(
            'product-collections',
            __('Product Collections'),
            __('Product Collections'),
            function (Shortcode $shortcode) {
                $collections = ProductCollection::query()
                    ->wherePublished()
                    ->select('id', 'name', 'slug')
                    ->get();

                if ($collections->isEmpty()) {
                    return null;
                }

                $collectionId = $collections->first()->getKey();
                if ($shortcode->collection_id && $collections->firstWhere('id', $shortcode->collection_id)) {
                    $collectionId = $shortcode->collection_id;
                }

                $limit = (int)$shortcode->limit ?: 10;

                $products = get_products_by_collections(
                    array_merge([
                        'collections' => [
                            'by' => 'id',
                            'value_in' => [$collectionId],
                        ],
                        'take' => $limit,
                        'with' => EcommerceHelper::withProductEagerLoadingRelations(),
                    ], EcommerceHelper::withReviewsParams())
                );

                return Theme::partial(
                    'shortcodes.product-collections.index',
                    compact('limit', 'shortcode', 'products', 'collectionId', 'collections')
                );
            }
        );

        shortcode()->setAdminConfig('product-collections', function (array $attributes) {
            $ads = collect();
            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();
            }

            return Theme::partial('shortcodes.product-collections.admin-config', compact('attributes', 'ads'));
        });

        add_shortcode(
            'trending-products',
            __('Trending Products'),
            __('Trending Products'),
            function (Shortcode $shortcode) {
                $products = get_trending_products(
                    [
                        'take' => min(
                            max((int)$shortcode->number_of_displays ?: 10, 2),
                            20
                        ),
                    ] + EcommerceHelper::withReviewsParams()
                );

                return Theme::partial('shortcodes.trending-products.index', compact('products', 'shortcode'));
            }
        );

        shortcode()->setAdminConfig('trending-products', function (array $attributes) {
            $ads = collect();
            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();
            }

            return Theme::partial('shortcodes.trending-products.admin-config', compact('attributes', 'ads'));
        });

        add_shortcode('product-blocks', __('Product Blocks'), __('Product Blocks'), function (Shortcode $shortcode) {
            $numberOfDisplays = min(max((int)$shortcode->number_of_displays ?: 10, 2), 20);
            $featuredProducts = collect();
            if ($shortcode->featured_product_title) {
                $featuredProducts = get_featured_products(
                    ['take' => $numberOfDisplays] + EcommerceHelper::withReviewsParams()
                );
            }

            $topRatedProducts = collect();
            if ($shortcode->top_rated_product_title && EcommerceHelper::isReviewEnabled()) {
                $topRatedProducts = get_top_rated_products(
                    $numberOfDisplays,
                    [],
                    EcommerceHelper::withReviewsParams()['withCount']
                );
            }

            $onSaleProducts = collect();
            if ($shortcode->on_sale_product_title) {
                $onSaleProducts = get_products_on_sale(
                    ['take' => $numberOfDisplays] + EcommerceHelper::withReviewsParams()
                );
            }

            $data = collect([
                'featured_product' => $featuredProducts,
                'top_rated_product' => $topRatedProducts,
                'on_sale_product' => $onSaleProducts,
            ])->filter(fn ($item) => $item->isNotEmpty());

            return Theme::partial('shortcodes.product-blocks.index', compact('data', 'shortcode'));
        });

        shortcode()->setAdminConfig('product-blocks', function (array $attributes) {
            return Theme::partial('shortcodes.product-blocks.admin-config', compact('attributes'));
        });

        add_shortcode('all-products', __('All Products'), __('All Products'), function (Shortcode $shortcode) {
            $products = get_products([
                'paginate' => [
                    'per_page' => $shortcode->per_page,
                    'current_paged' => (int)request()->input('page'),
                ],
            ]);

            return Theme::partial('shortcodes.all-products', [
                'title' => $shortcode->title,
                'products' => $products,
            ]);
        });

        shortcode()->setAdminConfig('all-products', function (array $attributes) {
            return Theme::partial('shortcodes.all-products-admin-config', compact('attributes'));
        });

        add_shortcode('all-brands', __('All Brands'), __('All Brands'), function (Shortcode $shortcode) {
            $brands = get_all_brands();

            return Theme::partial('shortcodes.all-brands', [
                'title' => $shortcode->title,
                'brands' => $brands,
            ]);
        });

        shortcode()->setAdminConfig('all-brands', function (array $attributes) {
            return Theme::partial('shortcodes.all-brands-admin-config', compact('attributes'));
        });

        add_shortcode('flash-sale', __('Flash sale'), __('Flash sale'), function (Shortcode $shortcode) {
            $with = [
                'products' => function ($query) {
                    $reviewParams = EcommerceHelper::withReviewsParams();

                    if (EcommerceHelper::isReviewEnabled()) {
                        $query->withAvg($reviewParams['withAvg'][0], $reviewParams['withAvg'][1]);
                    }

                    return $query
                        ->wherePublished()
                        ->withCount($reviewParams['withCount'])
                        ->with(EcommerceHelper::withProductEagerLoadingRelations());
                },
            ];

            if (in_array($shortcode->style, ['style-4', 'style-2'])) {
                if ($shortcode->flash_sale_id) {
                    $flashSale = FlashSale::query()
                        ->notExpired()
                        ->where([
                            'status' => BaseStatusEnum::PUBLISHED,
                            'id' => $shortcode->flash_sale_id,
                        ])
                        ->when($shortcode->style == 'style-2', fn ($query) => $query->with($with))
                        ->first();
                    if (! $flashSale) {
                        return null;
                    }

                    return Theme::partial('shortcodes.flash-sale.index', compact('flashSale', 'shortcode'));
                }

                return null;
            }
            $flashSales = FlashSale::query()
                ->notExpired()
                ->wherePublished()
                ->with($with)
                ->when($shortcode->flash_sale_id, fn ($query) => $query->where('id', $shortcode->flash_sale_id))
                ->get();

            if (! $flashSales->count()) {
                return null;
            }

            return Theme::partial('shortcodes.flash-sale.index', compact('flashSales', 'shortcode'));
        });

        shortcode()->setAdminConfig('flash-sale', function (array $attributes) {
            $flashSales = FlashSale::query()
                ->notExpired()
                ->wherePublished()
                ->get();

            return Theme::partial('shortcodes.flash-sale.admin-config', compact('attributes', 'flashSales'));
        });
    }

    add_shortcode('banners', __('Banners'), __('Banners'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.banners', [
            'image1' => $shortcode->image1,
            'url1' => $shortcode->url1,
            'image2' => $shortcode->image2,
            'url2' => $shortcode->url2,
            'image3' => $shortcode->image3,
            'url3' => $shortcode->url3,
        ]);
    });

    shortcode()->setAdminConfig('banners', function (array $attributes) {
        return Theme::partial('shortcodes.banners-admin-config', compact('attributes'));
    });

    add_shortcode('our-features', __('Our features'), __('Our features'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.our-features.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('our-features', function (array $attributes) {
        return Theme::partial('shortcodes.our-features.admin-config', compact('attributes'));
    });

    add_shortcode('instagram', __('Instagram images'), __('Instagram images'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.instagram.index', compact('shortcode'));
    });

    shortcode()->setAdminConfig('instagram', function (array $attributes) {
        return Theme::partial('shortcodes.instagram.admin-config', compact('attributes'));
    });

    if (is_plugin_active('testimonial')) {
        add_shortcode('testimonials', __('Testimonials'), __('Testimonials'), function (Shortcode $shortcode) {
            $testimonials = Testimonial::query()
                ->where(['status' => BaseStatusEnum::PUBLISHED])
                ->get();

            return Theme::partial('shortcodes.testimonials', [
                'title' => $shortcode->title,
                'testimonials' => $testimonials,
            ]);
        });

        shortcode()->setAdminConfig('testimonials', function (array $attributes) {
            return Theme::partial('shortcodes.testimonials-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('newsletter')) {
        add_shortcode('newsletter-form', __('Newsletter Form'), __('Newsletter Form'), function (Shortcode $shortcode) {
            return Theme::partial('shortcodes.newsletter-form.index', compact('shortcode'));
        });

        shortcode()->setAdminConfig('newsletter-form', function (array $attributes) {
            return Theme::partial('shortcodes.newsletter-form.admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace('partials.shortcodes.contact-form');
        }, 120);
    }

    if (is_plugin_active('blog')) {
        add_shortcode('featured-news', __('Featured News'), __('Featured News'), function (Shortcode $shortcode) {
            $posts = app(PostInterface::class)->getFeatured(3);

            return Theme::partial('shortcodes.featured-news', [
                'title' => $shortcode->title,
                'description' => $shortcode->description,
                'subtitle' => $shortcode->subtitle,
                'posts' => $posts,
            ]);
        });
        shortcode()->setAdminConfig('featured-news', function (array $attributes) {
            return Theme::partial('shortcodes.featured-news-admin-config', compact('attributes'));
        });
    }

    if (is_plugin_active('simple-slider')) {
        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function () {
            return Theme::getThemeNamespace('partials.shortcodes.simple-slider.index');
        }, 120);

        shortcode()->setAdminConfig('simple-slider', function (array $attributes) {
            $sliders = SimpleSlider::query()
                ->wherePublished()
                ->pluck('name', 'key')
                ->all();

            $ads = collect();
            if (is_plugin_active('ads')) {
                $ads = Ads::query()
                    ->wherePublished()
                    ->notExpired()
                    ->get();
            }

            return Theme::partial('shortcodes.simple-slider.admin-config', compact('attributes', 'sliders', 'ads'));
        });
    }

    if (is_plugin_active('ads')) {
        add_shortcode('theme-ads', __('Theme ads'), __('Theme ads'), function (Shortcode $shortcode) {
            $style = $shortcode->style;

            if (! in_array($style, ['style-1', 'style-2', 'style-3'])) {
                $style = 'style-1';
            }

            $bannerClass = null;
            switch ($style) {
                case 'style-1':
                    $bannerClass = 'sale-banner mb-3 mb-md-4';

                    break;
                case 'style-2':
                case 'style-3':
                    $bannerClass = 'single_banner';

                    break;
            }

            $ads = [];
            for ($i = 1; $i < 5; $i++) {
                if ($key = $shortcode->{'key_' . $i}) {
                    $ad = AdsManager::displayAds((string)$key, ['class' => $bannerClass], $style == 'style-1' ? ['class' => 'hover_effect1'] : []);
                    if ($ad) {
                        $ads[] = $ad;
                    }
                }
            }

            $ads = array_filter($ads);

            if (empty($ads)) {
                return null;
            }

            return Theme::partial('shortcodes.theme-ads.index', compact('shortcode', 'ads', 'style'));
        });

        shortcode()->setAdminConfig('theme-ads', function (array $attributes) {
            $ads = Ads::query()
                ->wherePublished()
                ->notExpired()
                ->get();

            return Theme::partial('shortcodes.theme-ads.admin-config', compact('ads', 'attributes'));
        });
    }

    if (is_plugin_active('faq')) {
        add_shortcode('faqs', __('FAQs'), __('List of FAQs'), function (Shortcode $shortcode) {
            $categories = FaqCategory::query()
                ->wherePublished()
                ->with([
                    'faqs' => function ($query) {
                        $query->wherePublished();
                    },
                ])
                ->orderBy('order')
                ->orderByDesc('created_at')
                ->when($shortcode->category_id, function ($query, $categoryId) {
                    $query->where('id', $categoryId);
                })
                ->get();

            return Theme::partial('shortcodes.faqs', compact('categories'));
        });

        shortcode()->setAdminConfig('faqs', function (array $attributes) {
            $categories = FaqCategory::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            return Theme::partial('shortcodes.faqs-admin-config', compact('attributes', 'categories'));
        });
    }
});
