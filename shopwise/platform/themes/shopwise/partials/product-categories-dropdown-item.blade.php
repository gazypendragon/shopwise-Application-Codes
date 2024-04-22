@php
    $hasChildren = $groupedCategories->has($category->id);
@endphp

<li @if ($hasChildren) class="dropdown dropdown-mega-menu" @endif>
    <a class="dropdown-item nav-link @if ($hasChildren) dropdown-toggler @endif" href="{{ route('public.single', $category->url) }}" @if ($hasChildren) data-toggle="dropdown" @endif>
        @if ($category->icon_image)
            <img src="{{ RvMedia::getImageUrl($category->icon_image) }}" alt="{{ $category->name }}" width="22" height="22" loading="lazy" />
        @elseif ($category->icon)
            <i class="{{ $category->icon }}"></i>
        @endif
        <span>{{ $category->name }}</span>
    </a>
    @if ($hasChildren)
        <div class="dropdown-menu">
            <ul class="mega-menu d-lg-flex">
                <li class="mega-menu-col">
                    <ul>
                        @php
                            $currentCategories = $groupedCategories->get($category->id);
                        @endphp
                        @if($currentCategories)
                            @foreach ($currentCategories as $childCategory)
                                <li><a class="dropdown-item nav-link nav_item" href="{{ route('public.single', $childCategory->url) }}">{{ $childCategory->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    @endif
</li>
