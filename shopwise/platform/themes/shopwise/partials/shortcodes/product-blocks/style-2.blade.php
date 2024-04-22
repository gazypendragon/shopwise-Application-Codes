<!-- START SECTION SHOP -->
<div class="section small_pt pb_20">
    @foreach ($data as $key => $products)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_tab_header">
                        <div class="heading_s2">
                            <h2 class="h4">{!! BaseHelper::clean($shortcode->{$key . '_title'}) !!}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_slider product_list carousel_slider owl-carousel owl-theme nav_style3" data-loop="true"
                        data-dots="false" data-nav="true" data-margin="20"
                        data-responsive='{"0":{"items": "1"}, "767":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "3"}}'>
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
<!-- END SECTION SHOP -->
