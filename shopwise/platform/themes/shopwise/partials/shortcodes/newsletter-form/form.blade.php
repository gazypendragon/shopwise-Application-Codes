<div class="newsletter-form">
    <form method="post" action="{{ route('public.newsletter.subscribe') }}">
        @csrf
        <input name="email" type="email" class="form-control" placeholder="{{ __('Enter Your Email') }}">
        <button type="submit" class="{{ Arr::get($attributes ?? [], 'class', 'btn btn-dark btn-radius') }}">{{ __('Subscribe') }}</button>

        @if (setting('enable_captcha') && is_plugin_active('captcha'))
            {!! Captcha::display() !!}
        @endif
    </form>

    <div class="newsletter-message newsletter-success-message" style="display: none"></div>
    <div class="newsletter-message newsletter-error-message" style="display: none"></div>
</div>
