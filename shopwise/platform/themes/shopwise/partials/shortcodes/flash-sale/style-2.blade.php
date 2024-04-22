
<!-- START SECTION SHOP -->
<div class="section small_pt small_pb">
	<div class="container">
    	<div class="row">
			<div class="col-md-12">
            	<div class="heading_tab_header">
                    <div class="heading_s2">
                        <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    </div>
                    <div class="deal_timer">
                    	<div class="countdown_time countdown_style1" data-time="{{ $flashSale->end_date }}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                	@foreach ($flashSale->products as $product)
                        @continue (! EcommerceHelper::showOutOfStockProducts() && $product->isOutOfStock())

                        <div class="item">
                            {!! Theme::partial('product-item', compact('product', 'flashSale')) !!}
                        </div>
                    @endforeach
                </div>
            </div>
		</div>
    </div>
</div>
<!-- END SECTION SHOP -->
