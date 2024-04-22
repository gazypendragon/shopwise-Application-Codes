<!-- START SECTION BANNER -->
<div class="mt-4 staggered-animation-wrap">
	<div class="custom-container">
    	<div class="row">
        	<div class="@if ($collapsingProductCategories) col-lg-7 offset-lg-3 @else col-lg-9 @endif">
            	<div class="banner_section shop_el_slider">
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
                                        <div class="col-lg-7 col-10">
                                            <div class="banner_content3 overflow-hidden">
                                                @if ($slider->getMetaData('sub_title', true))
                                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft"
                                                        data-animation-delay="0.5s">{{ $slider->getMetaData('sub_title', true) }}</h5>
                                                @endif
                                                @if ($slider->title)
                                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $slider->title }}</h2>
                                                @endif
                                                @if ($slider->description)
                                                    <h3 class="staggered-animation mb-4 product-price" data-animation="slideInLeft"
                                                        data-animation-delay="1.2s">{{ $slider->description }}</h3>
                                                @endif
                                                @if ($slider->link)
                                                    <a class="btn btn-fill-out btn-radius staggered-animation text-uppercase"
                                                        href="{{ $slider->link }}" data-animation="slideInLeft"
                                                        data-animation-delay="1.5s">{!! BaseHelper::clean($slider->getMetaData('button_text', true) ?: __('Shop Now')) !!}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <ol class="carousel-indicators indicators_style3">
                            @foreach($sliders as $slider)
                                <li data-target="#carouselExampleControls" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            @if (is_plugin_active('ads'))
                <div class="col-lg-2 d-none d-lg-block">
                    {!! AdsManager::displayAds($shortcode->ads_1, ['class' => 'shop_banner2 el_banner1'], ['class' => 'hover_effect1']) !!}
                    {!! AdsManager::displayAds($shortcode->ads_2, ['class' => 'shop_banner2 el_banner2'], ['class' => 'hover_effect1']) !!}
                </div>
            @endif
        </div>
    </div>
</div>
<!-- END SECTION BANNER -->
