@php
    [$categories, $brands, $tags, $rand, $categoriesRequest, $urlCurrent, $categoryId, $maxFilterPrice] = 
EcommerceHelper::dataForFilter($category ?? null);

    $categories = ProductCategoryHelper::getActiveTreeCategories();

    Theme::asset()->usePath()->add('jquery-ui-css', 'css/jquery-ui.css');
    Theme::asset()->container('footer')->usePath()->add('jquery-ui-js', 'js/jquery-ui.js', ['jquery']);
    Theme::asset()->container('footer')->usePath()->add('touch-punch', 'js/jquery.ui.touch-punch.min.js', ['jquery-ui-js']);

    Theme::asset()->usePath()
                ->add('custom-scrollbar-css', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css');
    Theme::asset()->container('footer')->usePath()
                ->add('custom-scrollbar-js', 'plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js', ['jquery']);
@endphp

<div class="widget">
    <h5 class="widget_title">{{ __('Product Categories') }}</h5>
    <ul class="ps-list--categories">
        @foreach($categories as $category)
            <li class="@if ($urlCurrent == $category->url || (!empty($categoriesRequest && in_array($category->id, $categoriesRequest)))) current-menu-item @endif @if ($category->activeChildren->count()) menu-item-has-children @endif">
                <a href="{{ $category->url }}">{{ $category->name }}</a>
                @if ($category->activeChildren->count())
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.sub-categories', ['children' => $category->activeChildren])
                @endif
            </li>
        @endforeach
    </ul>
</div>

@if ($brands->isNotEmpty())
    <aside class="widget">
        <h5 class="widget_title">{{ __('Brands') }}</h5>
        <ul class="list_brand ps-custom-scrollbar">
            @foreach($brands as $brand)
                <li>
                    <div class="custome-checkbox">
                        <input class="form-check-input submit-form-on-change" type="checkbox" name="brands[]" id="brand-{{ $brand->id }}" value="{{ $brand->id }}" @if (in_array($brand->id, request()->input('brands', []))) checked @endif>
                        <label class="form-check-label" for="brand-{{ $brand->id }}"><span>{{ $brand->name }} <span class="d-inline-block">({{ $brand->products_count }})</span> </span></label>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
@endif
@if ($tags->isNotEmpty())
    <aside class="widget widget--tags">
        <h5 class="widget_title">{{ __('Product Tags') }}</h5>
        <ul class="list_brand ps-custom-scrollbar">
            @foreach($tags as $tag)
                <li>
                    <div class="custome-checkbox">
                        <input class="form-check-input submit-form-on-change" type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" @if (in_array($tag->id, request()->input('tags', []))) checked @endif>
                        <label class="form-check-label" for="tag-{{ $tag->id }}"><span>{{ $tag->name }} <span class="d-inline-block">({{ $tag->products_count }})</span> </span></label>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
@endif

@if ($maxFilterPrice)
    <aside class="widget">
        <h5 class="widget_title">{{ __('By Price') }}</h5>
        <div class="filter_price">
            <div id="price_filter" data-min="0" data-max="{{ $maxFilterPrice }}" data-min-value="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}" data-max-value="{{ BaseHelper::stringify(request()->input('max_price', $maxFilterPrice)) }}" data-price-sign="{{ get_application_currency()->symbol }}"></div>
            <div data-is-prefix-symbol="{{ get_application_currency()->is_prefix_symbol }}"></div>
            <div class="price_range">
                <span>{{ __('Price') }}: <span id="flt_price"></span></span>
                <input class="product-filter-item product-filter-item-price-0" id="price_first" name="min_price" value="{{ BaseHelper::stringify(request()->input('min_price', 0)) }}" type="hidden">
                <input class="product-filter-item product-filter-item-price-1" id="price_second" name="max_price" value="{{ BaseHelper::stringify(request()->input('max_price', $maxFilterPrice)) }}" type="hidden">
            </div>
        </div>
    </aside>
@endif

<aside class="widget" style="border: none">
    {!! render_product_swatches_filter([
        'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.attributes-filter-renderer'
    ]) !!}
</aside>
