
<!-- START SECTION SHOP -->
<div class="section small_pt pb_20">
    @foreach ($data as $key => $products)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s3 text-center">
                        <h2>{!! BaseHelper::clean($shortcode->{$key . '_title'}) !!}</h2>
                    </div>
                    <div class="small_divider clearfix"></div>
                </div>
            </div>
            <div class="row shop_container">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-6">
                        {!! Theme::partial('product-item', ['product' => $product]) !!}
                    </div>
                @endforeach
            </div> 
        </div>
    @endforeach
</div>
<!-- END SECTION SHOP -->
