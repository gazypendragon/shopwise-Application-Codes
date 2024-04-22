<div class="mb-3">
    <label class="form-label">{{ trans('plugins/simple-slider::simple-slider.select_slider') }}</label>
    {!! Form::customSelect('key', $sliders, Arr::get($attributes, 'key')) !!}
</div>

@if (is_plugin_active('ecommerce'))
    <div class="mb-3">
        <label class="form-label">{{ __('Collapsing product categories?') }}</label>
        {!! Form::customSelect('collapsing_product_categories', [
            '' => __('Inherit from theme option'),
            'yes' => __('Yes'),
            'no' => __('No'),
        ], Arr::get($attributes, 'collapsing_product_categories')) !!}
    </div>
@endif

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-2' => __('Style 2'),
        'style-3' => __('Style 3'),
        'style-4' => __('Style 4'),
        'style-5' => __('Style 5'),
        'style-6' => __('Style 6'),
    ], Arr::get($attributes, 'style')) !!}
</div>

@if ($ads->isNotEmpty())
    <div class="mb-3">
        <label class="form-label">{{ __('Ads 1') }}</label>
        {!! Form::customSelect('ads_1', ['' => __('-- None --')] + $ads->pluck('name', 'key')->toArray(), Arr::get($attributes, 'ads_1')) !!}
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Ads 2') }}</label>
        {!! Form::customSelect('ads_2', ['' => __('-- None --')] + $ads->pluck('name', 'key')->toArray(), Arr::get($attributes, 'ads_2')) !!}
    </div>
@endif
