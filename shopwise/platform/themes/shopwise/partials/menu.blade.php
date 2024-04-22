<ul {!! $options !!}>
    @php $menu_nodes->loadMissing('metadata'); @endphp
    @foreach ($menu_nodes as $key => $row)
        <li @if ($row->has_child || $row->css_class || $row->active) class="@if ($row->has_child) dropdown @endif @if ($row->css_class) {{ $row->css_class }} @endif @if ($row->active) active @endif" @endif>
            <a class="@if ($row->has_child) dropdown-toggle nav-link @else nav-link nav_item @endif" href="{{ $row->has_child ? '#' : url($row->url) }}" @if ($row->target !== '_self') target="{{ $row->target }}" @endif @if ($row->has_child) data-toggle="dropdown" @endif>
                @if ($iconImage = $row->getMetadata('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="icon image" width="14" height="14" style="vertical-align: top; margin-top: 3px" loading="lazy" />
                @elseif ($row->icon_font) <i class="{{ trim($row->icon_font) }}"></i> @endif {{ $row->title }}
            </a>
            @if ($row->has_child)
                <div class="dropdown-menu dropdown-reverse">
                    {!! Menu::generateMenu([
                        'menu'       => $menu,
                        'menu_nodes' => $row->child,
                        'view'       => 'sub-menu',
                    ]) !!}
                </div>
            @endif
        </li>
    @endforeach

    <li class="mobile-menu-item mobile-menu-item-first-item">
        @if (is_plugin_active('language'))
            <div class="language-wrapper">
                {!! Theme::partial('language-switcher') !!}
            </div>
        @endif
    </li>
    <li class="mobile-menu-item">
        @if (is_plugin_active('ecommerce'))
            @php $currencies = get_all_currencies(); @endphp
            @if (count($currencies) > 1)
                <div class="language-wrapper choose-currency">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ get_application_currency()->symbol }} - {{ get_application_currency()->title }}
                            <span class="language-caret"></span>
                        </button>
                        <ul class="dropdown-menu language_bar_chooser">
                            @foreach ($currencies as $currency)
                                <li>
                                    <a href="{{ route('public.change-currency', $currency->title) }}" @if (get_application_currency_id() == $currency->id) class="active" @endif><span>{{ $currency->symbol }} - {{ $currency->title }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endif
    </li>
</ul>
