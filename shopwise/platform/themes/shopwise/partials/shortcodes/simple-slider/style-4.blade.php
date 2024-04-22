<div class="banner_section full_screen staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow carousel_style2" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders->loadMissing('metadata') as $slider)
                @php
                    $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                    $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;
                @endphp
                <div @class([
                    'carousel-item background_bg overlay_bg_50',
                    'active' => $loop->first,
                ]) data-img-src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                    @if ($tabletImage) data-tablet-img-src="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                    @if ($mobileImage) data-mobile-img-src="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif>
                    <div class="banner_slide_content banner_content_inner">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-10 @if ($collapsingProductCategories) offset-lg-2 offset-md-1 @endif">
                                    <div class="banner_content text_white text-center">
                                        @if ($slider->getMetaData('sub_title', true))
                                            <h5 class="mb-3 bg_strip staggered-animation text-uppercase" data-animation="fadeInDown"
                                                data-animation-delay="0.2s">{{ $slider->getMetaData('sub_title', true) }}</h5>
                                        @endif
                                        @if ($slider->title)
                                            <h2 class="staggered-animation" data-animation="fadeInDown" data-animation-delay="0.3s">{{ $slider->title }}</h2>
                                        @endif
                                        @if ($slider->description)
                                            <p class="staggered-animation" data-animation="fadeInUp" data-animation-delay="0.4s">{{ $slider->description }}</p>
                                        @endif
                                        @if ($slider->link)
                                            <a class="btn btn-white staggered-animation" href="{{ $slider->link }}" data-animation="fadeInUp"
                                                data-animation-delay="0.5s">{!! BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')) !!}</a>
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
</div>
