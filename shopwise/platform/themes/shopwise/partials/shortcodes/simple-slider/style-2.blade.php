<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    @if ($collapsingProductCategories)
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
    @endif
        <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders->loadMissing('metadata') as $slider)
                    @php
                        $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                        $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;
                    @endphp

                    <div class="carousel-item @if ($loop->first) active @endif background_bg"
                        data-img-src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                        @if ($tabletImage) data-tablet-img-src="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                        @if ($mobileImage) data-mobile-img-src="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                    >
                        <div class="banner_slide_content">
                            <div class="container"><!-- STRART CONTAINER -->
                                <div class="row">
                                    <div class="col-lg-7 col-9">
                                        <div class="banner_content overflow-hidden">
                                            @if ($slider->description)
                                                <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">{{ $slider->description }}</h5>
                                            @endif
                                            @if ($slider->title)
                                                <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $slider->title }}</h2>
                                            @endif
                                            @if ($slider->link)
                                                <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="{{ $slider->link }}"
                                                    data-animation="slideInLeft" data-animation-delay="1.5s">{!! BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')) !!}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
        </div>
    @if ($collapsingProductCategories)
                </div>
            </div>
        </div>
    @endif
</div>
