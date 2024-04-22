<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Username') }}</label>
    <textarea name="subtitle" class="form-control" placeholder="Ex: @username" rows="3">{{ Arr::get($attributes, 'subtitle') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Images') }}</label>
    {!! Form::mediaImages('images', explode(',', Arr::get($attributes, 'images'))) !!}
</div>
