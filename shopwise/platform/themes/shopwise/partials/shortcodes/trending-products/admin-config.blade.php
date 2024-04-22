<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Description') }}</label>
    <input type="text" name="description" value="{{ Arr::get($attributes, 'description') }}" class="form-control" placeholder="{{ __('Description') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Number of displays') }}</label>
    <input type="number" min="0" max="20" name="number_of_displays" value="{{ Arr::get($attributes, 'number_of_displays') }}" class="form-control" placeholder="{{ __('Number of displays') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-3' => __('Style 3'),
        'style-4' => __('Style 4'),
    ], Arr::get($attributes, 'style')) !!}
</div>

@if ($ads->isNotEmpty())
    <div class="mb-3">
        <label class="form-label">{{ __('Ads') }}</label>
        {!! Form::customSelect('ads_key', ['' => __('-- None --')] + $ads->pluck('name', 'key')->toArray(), Arr::get($attributes, 'ads_1')) !!}
    </div>
@endif
