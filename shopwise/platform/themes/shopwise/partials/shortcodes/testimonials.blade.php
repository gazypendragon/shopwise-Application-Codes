<div class="section bg_redon">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>{!! BaseHelper::clean($title) !!}</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div
                     class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2"
                     data-nav="true" data-dots="false" data-center="true" data-loop="false" data-autoplay="true" data-items='1'>
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>{{ BaseHelper::clean($testimonial->content) }}</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{ RvMedia::getImageUrl($testimonial->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $testimonial->name }}" loading="lazy" />
                                </div>
                                <div class="author_name">
                                    <h6>{{ $testimonial->name }}</h6>
                                    <span>{{ $testimonial->company }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
