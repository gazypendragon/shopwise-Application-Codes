@if (count($sliders) > 0)
    <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
        <div class="container">
            <div class="row">
                <div class="@if (theme_option('collapsing_product_categories_on_homepage', 'no') == 'no') col-lg-9 offset-lg-3 @else col-12 @endif">
                    <div id="carouselExampleControls" class="carousel slide light_arrow" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($sliders->loadMissing('metadata') as $slider)
                                @php
                                    $tabletImage = $slider->getMetaData('tablet_image', true) ?: $slider->image;
                                    $mobileImage = $slider->getMetaData('mobile_image', true) ?: $tabletImage;
                                @endphp

                                <div class="carousel-item @if ($loop->first) active @endif"
                                     data-img-src="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"
                                     @if ($tabletImage) data-tablet-img-src="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                                     @if ($mobileImage) data-mobile-img-src="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" @endif
                                >
                                    <div class="banner_slide_content banner_content_inner">
                                        <div class="col-lg-8 col-10">
                                            <div class="banner_content overflow-hidden">
                                                @if ($slider->description)
                                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">{{ $slider->description }}</h5>
                                                @endif
                                                @if ($slider->title)
                                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ $slider->title }}</h2>
                                                @endif
                                                @if ($slider->link)
                                                    @php
                                                        $buttonText = MetaBox::getMetaData($slider, 'button_text', true);
                                                    @endphp
                                                    <a class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" href="{{ $slider->link }}" data-animation="slideInLeft" data-animation-delay="1.5s">{!! BaseHelper::clean($buttonText ?: __('Shop Now')) !!}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <ol class="carousel-indicators indicators_style1">
                            @foreach($sliders as $slider)
                                <li data-target="#carouselExampleControls" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
