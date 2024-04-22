@php
    $style = $shortcode->style;
    if (! in_array($style, ['style-1', 'style-3'])) {
        $style = 'style-1';
    }
@endphp
@include(Theme::getThemeNamespace('partials.shortcodes.featured-brands.' . $style))
