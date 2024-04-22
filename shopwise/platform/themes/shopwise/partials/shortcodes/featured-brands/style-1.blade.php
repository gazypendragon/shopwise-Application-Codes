<div class="section pt-0 small_pb">
    <div class="container">
        <div class="heading_tab_header">
            <div class="heading_s2">
                <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
            </div>
        </div>
        <div class="col-12">
            <div class="client_logo carousel_slider owl-carousel owl-theme nav_style3"
                 data-dots="false" data-nav="true" data-margin="30" data-loop="false" data-autoplay="true"
                 data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}, "1199":{"items": "6"}}'>
                @foreach($brands as $brand)
                    <div class="item">
                        <div class="cl_logo">
                            @if ($brand->website)
                                <a href="{{ $brand->website }}">
                                    <img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}" loading="lazy"/>
                                </a>
                            @else
                                <img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}" loading="lazy"/>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
