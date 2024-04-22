<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

@if ($ads->isNotEmpty())
    <div class="mb-3">
        <label class="form-label">{{ __('Ads') }}</label>
        {!! Form::customSelect('ads_key', ['' => __('-- None --')] + $ads->pluck('name', 'key')->toArray(), Arr::get($attributes, 'ads_key')) !!}
    </div>
@endif

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-5' => __('Style 5'),
        'style-6' => __('Style 6'),
    ], Arr::get($attributes, 'style')) !!}
</div>
