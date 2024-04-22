<ol class="breadcrumb justify-content-md-end">
    @foreach ($crumbs = Theme::breadcrumb()->getCrumbs() as $i => $crumb)
        @if ($i != (count($crumbs) - 1))
            <li class="breadcrumb-item">
                <a href="{{ $crumb['url'] }}" title="{{ $crumb['label'] }}">
                    {!! BaseHelper::clean($crumb['label']) !!}
                </a>
            </li>
        @else
            <li class="breadcrumb-item active">{!! BaseHelper::clean($crumb['label']) !!}</li>
        @endif
    @endforeach
</ol>
