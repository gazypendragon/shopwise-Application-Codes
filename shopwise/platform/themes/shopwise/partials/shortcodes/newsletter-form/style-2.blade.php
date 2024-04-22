<div class="section bg_dark small_pt small_pb">
	<div class="container">	
    	<div class="row align-items-center">	
            <div class="col-md-6">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>{!! BaseHelper::clean($shortcode->title) !!}</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form">
                    {!! Theme::partial('shortcodes.newsletter-form.form', ['attributes' => ['class' => 'btn btn-fill-out rounded-0']]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
