<div class="section small_pt small_pb">
    <div class="container">
        <div class="row">
            @if (is_plugin_active('ads') && $shortcode->ads_key && $ads = AdsManager::displayAds($shortcode->ads_key, ['class' => 'sale-banner'], ['class' => 'hover_effect1']))
                <div class="col-xl-3 d-none d-xl-block">
                    {!! $ads !!}
                </div>
                <div class="col-xl-9">
            @else
                <div class="col-12">
            @endif
                <div class="row">
                    <div class="col-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2">
                                <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                            </div>
                            <div class="view_all">
                                <a href="{{ route('public.products') }}" class="text_default">
                                    <i class="linearicons-power"></i>
                                    <span>{{ __('View All') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                            @foreach($products as $product)
                                <div class="item">
                                    {!! Theme::partial('product-item', ['product' => $product]) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
