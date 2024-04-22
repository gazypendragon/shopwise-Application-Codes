@for ($i = 1; $i < 5; $i++)
    <div class="mb-3">
        <label class="form-label">{{ __('Ads :i', ['i' => $i]) }}</label>
        {!! Form::customSelect('key_' . $i, ['' => __('-- Select --')] + $ads->pluck('name', 'key')->toArray(), Arr::get($attributes, 'key_' . $i)) !!}
    </div>
@endfor

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-2' => __('Style 2'),
        'style-3' => __('Style 3'),
    ], Arr::get($attributes, 'style')) !!}
</div>
