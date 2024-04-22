@php
    $groupedCategories = $categories->groupBy('parent_id');

    $currentCategories = $groupedCategories->get(0);
@endphp

@if($currentCategories)
    @foreach ($currentCategories as $category)
        @php
            $categoryHtml = Theme::partial('product-categories-dropdown-item', ['category' => $category, 'groupedCategories' => $groupedCategories]);
        @endphp

        @if ($loop->index < 10)
            {!! $categoryHtml !!}
        @else
            @if ($loop->index == 10)
                <li>
                    <ul class="more_slide_open" style="display: none;">
            @endif

            {!! $categoryHtml !!}

            @if ($loop->last)
                </ul>
            </li>
            @endif
        @endif
    @endforeach
@endif
