<div class="section background_bg" @if ($shortcode->background_image) data-img-src="{{ RvMedia::getImageUrl($shortcode->background_image) }}" @endif>
	<div class="container">
    	<div class="row">
            <div class="col-lg-6 col-md-8 col-sm-9">
            	<div class="furniture_banner">
                    <h2 class="single_bn_title h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <h3 class="single_bn_title1 text_default">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                    <div class="countdown_time countdown_style3 mb-4" data-time="{{ $flashSale->end_date }}"></div>
                    @if ($shortcode->button_url)
                        <a href="{{ url($shortcode->button_url) }}" class="btn btn-fill-out">{{ $shortcode->button_text ?: __('Shop Now') }}</a>
                    @endif

                    @if (is_plugin_active('newsletter') && $shortcode->show_newsletter == 'yes')
                        <div class="newsletter_form2 mt-5">
                            {!! Theme::partial('shortcodes.newsletter-form.form', ['attributes' => ['class' => 'btn btn-fill-out text-uppercase']]) !!}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
