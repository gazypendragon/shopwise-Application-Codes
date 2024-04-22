<div class="banner_section slide_wrap shop_banner_slider staggered-animation-wrap">
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
                    <div @class([
                        'carousel-item background_bg',
                        'active' => $loop->first,
                    ]) data-img-src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                        @if ($tabletImage) data-tablet-img-src="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                        @if ($mobileImage) data-mobile-img-src="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif>
                        <div class="banner_slide_content banner_content_inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-9 col-10">
                                        <div class="banner_content2">
                                            @if ($slider->getMetaData('sub_title', true))
                                                <h6 class="mb-2 mb-sm-3 staggered-animation text-uppercase" data-animation="fadeInDown" data-animation-delay="0.2s">{{ $slider->getMetaData('sub_title', true) }}</h6>
                                            @endif
                                            @if ($slider->title)
                                                <h2 class="staggered-animation" data-animation="fadeInDown" data-animation-delay="0.3s">{{ $slider->title }}</h2>
                                            @endif
                                            @if ($slider->description)
                                                <p class="staggered-animation" data-animation="fadeInUp" data-animation-delay="0.4s">{{ $slider->description }}</p>
                                            @endif
                                            @if ($slider->link)
                                                <a class="btn btn-line-fill btn-radius staggered-animation text-uppercase" href="{{ $slider->link }}" data-animation="slideInLeft"
                                                    data-animation-delay="1.5s">{!! BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')) !!}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <ol class="carousel-indicators indicators_style2">
                @foreach($sliders as $slider)
                    <li data-target="#carouselExampleControls" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>
                @endforeach
            </ol>
        </div>
    @if ($collapsingProductCategories)
                </div>
            </div>
        </div>
    @endif
</div>
