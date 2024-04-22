@if ($product)
    <div class="product">
        @if ($product->isOutOfStock())
            <span class="pr_flash bg-secondary">{{ __('Out Of Stock') }}</span>
        @else
            @if ($product->productLabels->count())
                @foreach ($product->productLabels as $label)
                    <span class="pr_flash" @if ($label->color) style="background-color: {{ $label->color }}" @endif>{{ $label->name }}</span>
                @endforeach
            @else
                @if ($product->front_sale_price !== $product->price)
                    <div class="pr_flash bg-success" dir="ltr">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</div>
                @endif
            @endif
        @endif
        <div class="product_img">
            <a href="{{ $product->url }}">
                <img src="{{ RvMedia::getImageUrl($product->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" loading="lazy" />
            </a>
            <div class="product_action_box">
                <ul class="list_none pr_action_btn">
                    @if (EcommerceHelper::isCartEnabled())
                        <li class="add-to-cart"><a class="add-to-cart-button" data-id="{{ $product->id }}" href="#" data-url="{{ route('public.cart.add-to-cart') }}" title="{{ __('Cart') }}"><i class="icon-basket-loaded"></i> {{ __('Add To Cart') }}</a></li>
                    @endif
                    @if (EcommerceHelper::isCompareEnabled())
                        <li><a href="#" class="js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}" title="{{ __('Compare') }}"><i class="icon-shuffle"></i></a></li>
                    @endif
                    <li><a href="{{ route('public.ajax.quick-view', $product->id) }}" class="popup-ajax" rel="nofollow" title="{{ __('Quick view') }}"><i class="icon-magnifier-add"></i></a></li>
                    @if (EcommerceHelper::isWishlistEnabled())
                        <li><a class="js-add-to-wishlist-button" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}" title="{{ __('Wishlist') }}"><i class="icon-heart"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="product_info">
            <h6 class="product_title"><a href="{{ $product->url }}">{{ $product->name }}</a></h6>

            {!! apply_filters('ecommerce_before_product_price_in_listing', null, $product) !!}
            <div class="product_price">
                <span class="price">{{ format_price($product->front_sale_price_with_taxes) }}</span>
                @if ($product->front_sale_price !== $product->price)
                    <del>{{ format_price($product->price_with_taxes) }}</del>
                    <div class="on_sale">
                        <span>{{ __(':percentage Off', ['percentage' => get_sale_percentage($product->price, $product->front_sale_price)]) }}</span>
                    </div>
                @endif
            </div>
            {!! apply_filters('ecommerce_after_product_price_in_listing', null, $product) !!}

            @if (EcommerceHelper::isReviewEnabled())
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                    </div>
                    <span class="rating_num">({{ $product->reviews_count }})</span>
                </div>
            @endif
            <div class="pr_desc">
                <p>{!! BaseHelper::clean($product->description) !!}</p>
            </div>
            @if (count($product->variationAttributeSwatchesForProductList))
                <div class="pr_switch_wrap">
                    <div class="product_color_switch">
                        @foreach($product->variationAttributeSwatchesForProductList->unique('attribute_id') as $attribute)
                            @if ($attribute->display_layout == 'visual')
                                <span @if ($attribute->image) style="background-image: url({{ RvMedia::getImageUrl($attribute->image) }});" @else data-color="{{ $attribute->color }}" @endif></span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="list_product_action_box">
                <ul class="list_none pr_action_btn">
                    @if (EcommerceHelper::isCartEnabled())
                        <li class="add-to-cart"><a class="add-to-cart-button" data-id="{{ $product->id }}" href="#" data-url="{{ route('public.cart.add-to-cart') }}"><i class="icon-basket-loaded"></i> {{ __('Add To Cart') }}</a></li>
                    @endif

                    @if (EcommerceHelper::isCompareEnabled())
                        <li><a href="#" class="js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}"><i class="icon-shuffle"></i></a></li>
                    @endif

                    <li><a href="{{ route('public.ajax.quick-view', $product->id) }}" class="popup-ajax" rel="nofollow"><i class="icon-magnifier-add"></i></a></li>

                    @if (EcommerceHelper::isWishlistEnabled())
                        <li><a class="js-add-to-wishlist-button" href="#" data-url="{{ route('public.wishlist.add', $product->id) }}"><i class="icon-heart"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
