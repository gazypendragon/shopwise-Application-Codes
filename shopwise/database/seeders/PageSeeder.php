<?php

namespace Database\Seeders;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Models\Page;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        $fake = $this->fake();

        $pages = [
            [
                'name' => 'Homepage',
                'content' => Html::tag('div', '[simple-slider with_product_categories="" key="home-slider"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[featured-product-categories title="Top Categories" subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius."][/featured-product-categories]'
                    ) .
                    Html::tag('div', '[flash-sale title="Best deals for you"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[product-collections title="Exclusive Products"][/product-collections]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag(
                        'div',
                        '[trending-products title="Trending Products"][/trending-products]'
                    ) .
                    Html::tag(
                        'div',
                        '[product-blocks featured_product_title="Featured Products" top_rated_product_title="Top Rated Products" on_sale_product_title="On Sale Products"][/product-blocks]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-brands title="Our Brands"][/featured-brands]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-news title="Visit Our Blog" subtitle="Our Blog updated the newest trend of the world regularly"][/featured-news]'
                    ) .
                    Html::tag('div', '[testimonials title="Our Client Say!"][/testimonials]') .
                    Html::tag(
                        'div',
                        '[our-features icon1="flaticon-shipped" title1="Free Delivery" subtitle1="Free shipping on all US order or order above $200" icon2="flaticon-money-back" title2="30 Day Returns Guarantee" subtitle2="Simply return it within 30 days for an exchange" icon3="flaticon-support" title3="27/4 Online Support" subtitle3="Contact us 24 hours a day, 7 days a week"][/our-features]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Join Our Newsletter Now" subtitle="Register now to get updates on promotions."][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'Contact us',
                'content' => Html::tag('div', '[contact-form][/contact-form]') . Html::tag('div', '[google-map]959 Homestead Street Eastlake, NYC[/google-map]'),
            ],
            [
                'name' => 'Blog',
                'content' => Html::tag('p', '---'),
                'template' => 'blog-sidebar',
            ],
            [
                'name' => 'About us',
                'content' => Html::tag('p', $fake->realText(500)),
            ],
            [
                'name' => 'FAQ',
                'content' => Html::tag('div', '[faqs][/faqs]'),
            ],
            [
                'name' => 'Location',
                'content' => Html::tag('p', $fake->realText(500)),
            ],
            [
                'name' => 'Affiliates',
                'content' => Html::tag('p', $fake->realText(500)),
            ],
            [
                'name' => 'Brands',
                'content' => Html::tag('p', '[all-brands][/all-brands]'),
            ],
            [
                'name' => 'Cookie Policy',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this website we are using Cookies and collecting some data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
            ],
            [
                'name' => 'Homepage 2',
                'content' => Html::tag('div', '[simple-slider collapsing_product_categories="yes" style="style-2" key="home-slider"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[product-collections title="Exclusive Products"][/product-collections]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="DHAEBCMWGYJG" key_2="MDEUVQI9QPKM" style="style-2"][/theme-ads]'
                    ) .
                    Html::tag('div', '[flash-sale style="style-2" title="Deal Of The Days" flash_sale_id="1"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag(
                        'div',
                        '[product-blocks featured_product_title="Featured Products" style="style-2"][/product-blocks]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-brands title="Our Brands"][/featured-brands]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-form style="style-2" title="Subscribe Our Newsletter"][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 3',
                'content' => Html::tag('div', '[simple-slider collapsing_product_categories="yes" style="style-3" key="home-slider"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[our-features style="style-3" icon1="flaticon-shipped" title1="Free Delivery" subtitle1="Worldwide" icon2="flaticon-money-back" title2="Money Returns" subtitle2="30 Days money return" icon3="flaticon-support" title3="27/4 Online Support" subtitle3="Customer Support" icon4="flaticon-lock" title4="Payment Security" subtitle4="Safe Payment"][/our-features]'
                    ) .
                    Html::tag(
                        'div',
                        '[product-blocks featured_product_title="Exclusive Products" style="style-3" number_of_displays="8"][/product-blocks]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads style="style-3" key_1="EYMG7NGZTHJL" key_2="NKWBGV6NAC3M"][/theme-ads]'
                    ) .
                    Html::tag(
                        'div',
                        '[trending-products style="style-3" title="Trending Items"][/trending-products]'
                    ) .
                    Html::tag(
                        'div',
                        '[instagram title="instagram" username="@shoppingzone" images="general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg,general/insta-1.jpg"][/instagram]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-brands style="style-3" title="Our Brands"][/featured-brands]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 4',
                'content' => Html::tag('div', '[simple-slider collapsing_product_categories="yes" style="style-4" key="home-slider"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[featured-product-categories style="style-4" link="products" title="Top Categories" subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius."][/featured-product-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[trending-products style="style-4" number_of_displays="8" title="Our Top Products" description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius."][/trending-products]'
                    ) .
                    Html::tag('div', '[flash-sale style="style-4" flash_sale_id="1" background_image="general/furniture-banner3.jpg" show_newsletter="yes" title="Big Sale Deal" description="Sale 40% Off" button_url="/products"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[product-blocks style="style-4" on_sale_product_title="Special Offers" on_sale_product_description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius."][/product-blocks]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-news title="Latest News" subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore."][/featured-news]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Join Our Newsletter Now" subtitle="Register now to get updates on promotions."][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 5',
                'content' => Html::tag('div', '[simple-slider collapsing_product_categories="no" style="style-5" key="home-slider" ads_1="WF2VEBKBGUFA" ads_2="YKE9S2TUEEJB"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[product-collections style="style-5" ads_key="WF2VEBKBGUFA" title="Exclusive Products"][/product-collections]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag('div', '[flash-sale title="Best deals for you"][/flash-sale]') .
                    Html::tag(
                        'div',
                        '[trending-products ads_key="YKE9S2TUEEJB" title="Trending Products"][/trending-products]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-brands title="Our Brands"][/featured-brands]'
                    ) .
                    Html::tag(
                        'div',
                        '[product-blocks featured_product_title="Featured Products" top_rated_product_title="Top Rated Products" on_sale_product_title="On Sale Products"][/product-blocks]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Join Our Newsletter Now" subtitle="Register now to get updates on promotions."][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'Homepage 6',
                'content' => Html::tag('div', '[simple-slider collapsing_product_categories="yes" style="style-6" key="home-slider"][/simple-slider]') .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-product-categories title="Top Categories" subtitle="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius."][/featured-product-categories]'
                    ) .
                    Html::tag(
                        'div',
                        '[product-collections style="style-6" title="Exclusive Products"][/product-collections]'
                    ) .
                    Html::tag(
                        'div',
                        '[theme-ads key_1="7W3YFO7XE422"][/theme-ads]'
                    ) .
                    Html::tag(
                        'div',
                        '[trending-products title="Trending Products"][/trending-products]'
                    ) .
                    Html::tag('div', '[testimonials title="Our Client Say!"][/testimonials]') .
                    Html::tag(
                        'div',
                        '[featured-news title="Visit Our Blog" subtitle="Our Blog updated the newest trend of the world regularly"][/featured-news]'
                    ) .
                    Html::tag(
                        'div',
                        '[featured-brands title="Our Brands" style="style-3"][/featured-brands]'
                    ) .
                    Html::tag(
                        'div',
                        '[newsletter-form title="Join Our Newsletter Now" subtitle="Register now to get updates on promotions."][/newsletter-form]'
                    )
                ,
                'template' => 'homepage',
            ],
        ];

        Page::query()->truncate();

        foreach ($pages as $item) {
            $item['user_id'] = 1;

            if (! isset($item['template'])) {
                $item['template'] = 'default';
            }

            $page = Page::query()->create($item);

            Slug::query()->create([
                'reference_type' => Page::class,
                'reference_id' => $page->id,
                'key' => Str::slug($page->name),
                'prefix' => SlugHelper::getPrefix(Page::class),
            ]);
        }
    }
}
