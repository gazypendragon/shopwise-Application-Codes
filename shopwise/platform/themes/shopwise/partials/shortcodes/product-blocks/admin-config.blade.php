<div class="mb-3">
    <label class="form-label">{{ __('Featured Products Title') }}</label>
    <input type="text" name="featured_product_title" value="{{ Arr::get($attributes, 'featured_product_title') }}"
           class="form-control" placeholder="{{ __('Featured Products Title') }}">
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Featured Products Description') }}</label>
    <input type="text" name="featured_product_description" value="{{ Arr::get($attributes, 'featured_product_description') }}"
           class="form-control" placeholder="{{ __('Featured Products Description') }}">
</div>

@if (EcommerceHelper::isReviewEnabled())
    <div class="mb-3">
        <label class="form-label">{{ __('Top Rated Products Title') }}</label>
        <input type="text" name="top_rated_product_title" value="{{ Arr::get($attributes, 'top_rated_product_title') }}"
            class="form-control" placeholder="{{ __('Top Rated Products Title') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">{{ __('Top Rated Products Description') }}</label>
        <input type="text" name="top_rated_product_description" value="{{ Arr::get($attributes, 'top_rated_product_description') }}"
            class="form-control" placeholder="{{ __('Top Rated Products Description') }}">
    </div>
@endif

<div class="mb-3">
    <label class="form-label">{{ __('On Sale Products Description') }}</label>
    <input type="text" name="on_sale_product_title" value="{{ Arr::get($attributes, 'on_sale_product_title') }}"
        class="form-control" placeholder="{{ __('On Sale Products Title') }}">
</div>
<div class="mb-3">
    <label class="form-label">{{ __('On Sale Products Description') }}</label>
    <input type="text" name="on_sale_product_description" value="{{ Arr::get($attributes, 'on_sale_product_description') }}"
        class="form-control" placeholder="{{ __('On Sale Products Description') }}">
</div>
<div class="help-block">
    <span>{{ __('Leave the title blank if you dont want it displayed') }}</span>
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Number of displays') }}</label>
    <input type="number" min="2" max="20" name="number_of_displays" value="{{ Arr::get($attributes, 'number_of_displays') }}" class="form-control" placeholder="{{ __('Number of displays') }}">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
        'style-1' => __('Style 1'),
        'style-2' => __('Style 2'),
        'style-4' => __('Style 4'),
    ], Arr::get($attributes, 'style')) !!}
</div>
