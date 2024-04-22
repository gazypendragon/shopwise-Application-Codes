<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Number products per page') }}</label>
    <input type="number" name="per_page" value="{{ Arr::get($attributes, 'per_page') }}" class="form-control" placeholder="{{ __('Number products per page') }}">
</div>
