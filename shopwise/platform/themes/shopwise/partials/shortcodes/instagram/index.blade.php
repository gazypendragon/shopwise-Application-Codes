<!-- START SECTION INSTAGRAM IMAGE -->
<div class="section small_pt small_pb">
	<div class="container-fluid p-0">
        <div class="row no-gutters">
        	<div class="col-12">
            	<div class="follow_box">
                    <i class="ti-instagram"></i>
                    <h3>{!! BaseHelper::clean($shortcode->title) !!}</h3>
                    <span>{{ $shortcode->username }}</span>
                </div>
            	<div class="client_logo carousel_slider owl-carousel owl-theme" data-dots="false" data-margin="0" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "6"}}'>
                	@foreach (array_filter(explode(',', $shortcode->images)) as $image)
                        <div class="item">
                            <div class="instafeed_box">
                                <a href="javascript:void(0);"><img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $image }}"/></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION INSTAGRAM IMAGE --> 
