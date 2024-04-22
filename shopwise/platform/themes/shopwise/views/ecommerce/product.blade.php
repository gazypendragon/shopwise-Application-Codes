@php
    Theme::set('pageName', $product->name);
    Theme::asset()->usePath()->add('lightGallery-css', 'plugins/lightGallery/css/lightgallery.min.css');
    Theme::asset()->container('footer')->usePath()
        ->add('lightGallery-js', 'plugins/lightGallery/js/lightgallery.min.js', ['jquery']);
@endphp

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
                <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" data-zoom-enable="{{ theme_option('enabled_product_image_zoom', 'yes') == 'yes' ? 'true' : 'false' }}" data-zoom-image="{{ RvMedia::getImageUrl($product->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" loading="lazy" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                        @foreach ($productImages as $img)
                            <div class="item">
                                <a href="#" class="product_gallery_item @if ($loop->first) active @endif" data-image="{{ RvMedia::getImageUrl($img, 'medium') }}" data-zoom-image="{{ RvMedia::getImageUrl($img) }}">
                                    <img src="{{ RvMedia::getImageUrl($img, 'thumb') }}" alt="{{ $product->name }}" loading="lazy"/>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="pr_detail">
                <div class="product_description">
                    <h4 class="product_title"><a href="{{ $product->url }}">{{ $product->name }}</a></h4>
                    <div class="product_price">
                        <span class="price product-sale-price-text">{{ format_price($product->front_sale_price_with_taxes) }}</span>
                        <del class="product-price-text" @if ($product->front_sale_price == $product->price) style="display: none" @endif>{{ format_price($product->price_with_taxes) }}</del>
                        <div class="on_sale" @if ($product->front_sale_price == $product->price) style="display: none" @endif>
                            <span class="on_sale_percentage_text">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</span> <span>{{ __('Off') }}</span>
                        </div>
                    </div>
                    @if (EcommerceHelper::isReviewEnabled())
                        @if ($product->reviews_count > 0)
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                </div>
                                <span class="rating_num">({{ $product->reviews_count }})</span>
                            </div>
                        @endif
                    @endif
                    <div class="clearfix"></div>
                    <div class="pr_desc">
                        {!! apply_filters('ecommerce_before_product_description', null, $product) !!}
                        <p>{!! BaseHelper::clean($product->description) !!}</p>
                        {!! apply_filters('ecommerce_after_product_description', null, $product) !!}
                    </div>

                    <div class="cart_extra">
                        <form class="add-to-cart-form" method="POST" action="{{ route('public.cart.add-to-cart') }}">
                            @csrf

                            @if ($product->variations()->count() > 0)
                                <div class="pr_switch_wrap">
                                    {!! render_product_swatches($product, [
                                        'selected' => $selectedAttrs,
                                        'view'     => Theme::getThemeNamespace() . '::views.ecommerce.attributes.swatches-renderer'
                                    ]) !!}
                                </div>
                            @endif

                           {!! render_product_options($product) !!}

                            <hr />

                            {!! apply_filters(ECOMMERCE_PRODUCT_DETAIL_EXTRA_HTML, null, $product) !!}
                            <input type="hidden" name="id" id="hidden-product-id" value="{{ ($product->is_variation || !$product->defaultVariation->product_id) ? $product->id : $product->defaultVariation->product_id }}"/>
                            @if (EcommerceHelper::isCartEnabled())
                                <div class="cart-product-quantity">
                                    <div class="quantity float-left">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" name="qty" value="1" title="{{ __('Qty') }}" class="qty" size="4">
                                        <input type="button" value="+" class="plus">
                                    </div> &nbsp;
                                    <div class="float-right number-items-available" style="@if (!$product->isOutOfStock()) display: none; @endif line-height: 45px;">
                                        @if ($product->isOutOfStock())
                                            <span class="text-danger">({{ __('Out of stock') }})</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                            @endif
                            <div class="cart_btn">
                                @if (EcommerceHelper::isCartEnabled())
                                    <button class="btn btn-fill-out @if ($product->isOutOfStock()) btn-disabled @endif" type="submit" @if ($product->isOutOfStock()) disabled @endif><i class="icon-basket-loaded"></i> {{ __('Add to cart') }}</button>
                                @endif
                                @if (EcommerceHelper::isQuickBuyButtonEnabled())
                                    &nbsp;
                                    <button class="btn btn-dark @if ($product->isOutOfStock()) btn-disabled @endif" type="submit" @if ($product->isOutOfStock()) disabled @endif name="checkout">{{ __('Quick Buy') }}</button>
                                @endif
                                @if (EcommerceHelper::isCompareEnabled())
                                    <a class="add_compare js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}" href="#" title="{{ __('Compare') }}"><i class="icon-shuffle"></i></a>
                                @endif
                                @if (EcommerceHelper::isWishlistEnabled())
                                    <a class="add_wishlist js-add-to-wishlist-button" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}" title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a>
                                @endif
                            </div>
                            <br>
                            <div class="success-message text-success" style="display: none;">
                                <span></span>
                            </div>
                            <div class="error-message text-danger" style="display: none;">
                                <span></span>
                            </div>
                        </form>
                    </div>
                    <hr />
                    <ul class="product-meta">
                        <li id="product-sku" @if (!$product->sku) style="display: none" @endif>{{ __('SKU') }}: <span>{{ $product->sku }}</span></li>
                        @if ($product->categories()->exists())
			                <li>{{ __('Category') }}:
                                @foreach ($product->categories()->get() as $category)
                                    <a href="{{ $category->url }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                                @endforeach
                            </li>
			            @endif
                        @if (!$product->tags->isEmpty())
                            <li>{{ __('Tags') }}:
                                @foreach ($product->tags as $tag)
                                    <a href="{{ $tag->url }}" rel="tag">{{ $tag->name }}</a>@if (!$loop->last),@endif
                                @endforeach
                            </li>
                        @endif
                    </ul>

                    <div class="product_share">
                        <span>{{ __('Share') }}:</span>
                        <ul class="social_icons">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&title={{ rawurldecode(strip_tags(SeoHelper::getDescription())) }}" target="_blank" title="{{ __('Share on Facebook')
}}"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode(strip_tags(SeoHelper::getDescription())) }}" target="_blank" title="{{ __('Share on Twitter') }}">
                                    <i class="ion-social-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&summary={{ rawurldecode(strip_tags(SeoHelper::getDescription())) }}&source=Linkedin" title="{{ __('Share on
Linkedin') }}"
target="_blank"><i class="ion-social-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</a>
                        </li>
                        @if (EcommerceHelper::isReviewEnabled())
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">{{ __('Reviews') }} ({{ $product->reviews_count }})</a>
                            </li>
                        @endif
                        @if (is_plugin_active('faq'))
                            @if (count($product->faq_items) > 0)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-faq">{{ __('Questions and Answers') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <div class="tab-content shop_info_tab">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div id="app" class="ck-content">
                                {!! BaseHelper::clean($product->content) !!}
                            </div>
                            <br />
                            {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $product) !!}
                        </div>

                        @if (is_plugin_active('faq') && count($product->faq_items) > 0)
                            <div class="tab-pane fade faqs-list" id="tab-faq">
                                <div class="accordion" id="faq-accordion">
                                    @foreach($product->faq_items as $faq)
                                        <div class="card">
                                            <div class="card-header" id="heading-faq-{{ $loop->index }}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left @if (!$loop->first) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse-faq-{{ $loop->index }}" aria-expanded="true" aria-controls="collapse-faq-{{ $loop->index }}">
                                                        {!! BaseHelper::clean($faq[0]['value']) !!}
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapse-faq-{{ $loop->index }}" class="collapse @if ($loop->first) show @endif" aria-labelledby="heading-faq-{{ $loop->index }}" data-parent="#faq-accordion">
                                                <div class="card-body">
                                                    {!! BaseHelper::clean($faq[1]['value']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (EcommerceHelper::isReviewEnabled())
                            <div class="tab-pane fade product-reviews-container" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                @include('plugins/ecommerce::themes.includes.reviews')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php
            $crossSellProducts = get_cross_sale_products($product);
        @endphp
        @if (count($crossSellProducts) > 0)
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row shop_container grid">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>{{ __('Customers who bought this item also bought') }}</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        @foreach ($crossSellProducts as $crossSellProduct)
                            {!! Theme::partial('product-item-grid', ['product' => $crossSellProduct]) !!}
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="row shop_container grid">
            <div class="col-12">
                <div class="heading_s1">
                    <h3>{{ __('Related Products') }}</h3>
                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    @php
                        $relatedProducts = get_related_products($product);
                    @endphp
                    @if (!empty($relatedProducts))
                        @foreach ($relatedProducts as $related)
                            {!! Theme::partial('product-item-grid', ['product' => $related]) !!}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
