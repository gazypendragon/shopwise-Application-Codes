<!-- START SECTION SHOP -->
<div class="section small_pt pb_70">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
                <div class="heading_s4 text-center">
                    <h2>{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <p class="text-center leads">{!! BaseHelper::clean($shortcode->description) !!}</p>
            </div>
		</div>
        <div class="row shop_container">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-6">
                    {!! Theme::partial('product-item', ['product' => $product]) !!}
                </div>
            @endforeach
        </div> 
    </div>
</div>
<!-- END SECTION SHOP -->
