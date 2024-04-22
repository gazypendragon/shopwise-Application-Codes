<div class="main_content crop-avatar">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard_menu">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            @foreach (DashboardMenu::getAll('customer') as $item)
                                <li class="nav-item" id="{{ $item['id'] }}">
                                    <a
                                        class="nav-link
                                            @if ($item['active']) active @endif"
                                        href="{{ $item['url']  }}"
                                        aria-current="@if ($item['active']) true @else false @endif"
                                    >
                                        @if ($item['icon'])
                                            <x-core::icon :name="$item['icon']" />
                                        @endif
                                        {{ __($item['name']) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
