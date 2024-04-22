<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="newsletter_text text_white">
                    <h3>{!! BaseHelper::clean($shortcode->title) !!}</h3>
                    @if ($shortcode->description)
                        <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                    @endif
                    @if ($shortcode->subtitle)
                        <p>{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form2 rounded_input">
                    {!! Theme::partial('shortcodes.newsletter-form.form') !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->
