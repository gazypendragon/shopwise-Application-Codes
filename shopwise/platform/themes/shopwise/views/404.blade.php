@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
    Theme::breadcrumb()->add(__('Home'), route('public.index'))->add(SeoHelper::getTitle());
@endphp

{!! Theme::partial('header') !!}
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>{{ Theme::get('pageName') }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                {!! Theme::partial('breadcrumbs') !!}
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="error_wrap">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-10 order-lg-first">
                    <div class="text-center">
                        <div class="error_txt">404</div>
                        <h5 class="mb-2 mb-sm-3">{{ __('Oops! The page you requested was not found!') }}</h5>
                        <p>{{ __('The page you are looking for was moved, removed, renamed or might never existed.') }}</p>
                        @if (is_plugin_active('ecommerce'))
                            <div class="search_form pb-3 pb-md-4">
                                <form action="{{ route('public.products') }}" method="GET">
                                    <input name="q" type="text" placeholder="{{ __('Search') }}" class="form-control">
                                    <button type="submit" class="btn icon_search"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                        @endif
                        <a href="{{ route('public.single') }}" class="btn btn-fill-out">{{ __('Back To Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
