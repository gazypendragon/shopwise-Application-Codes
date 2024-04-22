<div class="section pt-0 pb_20 product-blocks">
    <div class="container">
        <div class="row">
            @foreach ($data as $key => $products)
                <div class="col-lg-{{ 12 / $data->count() }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading_tab_header">
                                <div class="heading_s2">
                                    <h2 class="h4">{!! BaseHelper::clean($shortcode->{$key . '_title'}) !!}</h2>
                                </div>
                                <div class="view_all">
                                    <a href="{{ route('public.products') }}" class="text_default"><span>{{ __('View All') }}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="product_slider carousel_slider product_list owl-carousel owl-theme nav_style5" data-nav="true"
                                data-dots="false" data-loop="false" data-margin="20"
                                data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
                                @foreach($products->chunk(3) as $chunk)
                                    <div class="item">
                                        @foreach ($chunk as $product)
                                            {!! Theme::partial('product-item', ['product' => $product]) !!}
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
