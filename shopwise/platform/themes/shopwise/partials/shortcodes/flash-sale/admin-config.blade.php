<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Description') }}</label>
    <input type="text" name="description" value="{{ Arr::get($attributes, 'description') }}" class="form-control" placeholder="{{ __('Description') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Flash sale item') }}</label>
    {!! Form::customSelect('flash_sale_id', ['' => __('All')] + $flashSales->pluck('name', 'id')->toArray(), Arr::get($attributes, 'flash_sale_id')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Background image') }}</label>
    {!! Form::mediaImage('background_image', Arr::get($attributes, 'background_image')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Button URL') }}</label>
    <input type="text" name="button_url" value="{{ Arr::get($attributes, 'button_url') }}" class="form-control" placeholder="{{ __('Button URL') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Button Text') }}</label>
    <input type="text" name="button_text" value="{{ Arr::get($attributes, 'button_text') }}" class="form-control" placeholder="{{ __('Button Text') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-4' => __('Style 4'),
    ], Arr::get($attributes, 'style')) !!}
</div>

@if (is_plugin_active('newsletter'))
    <div class="mb-3">
        <label class="form-label">{{ __('Show newsletter?') }}</label>
        {!! Form::customSelect('show_newsletter', [
            '' => trans('core/base::base.no'),
            'yes' => trans('core/base::base.yes'),
        ], Arr::get($attributes, 'show_newsletter')) !!}
    </div>
@endif
