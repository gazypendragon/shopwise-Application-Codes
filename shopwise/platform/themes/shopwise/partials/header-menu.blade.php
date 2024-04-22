<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
        <span class="ion-android-menu"></span>
    </button>
    <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
        {!! Menu::renderMenuLocation('main-menu', ['view' => 'menu', 'options' => ['class' => 'navbar-nav']]) !!}
    </div>
    @if (is_plugin_active('ecommerce'))
        <ul class="navbar-nav attr-nav align-items-center">
            <li><a href="@if (!auth('customer')->check()) {{ route('customer.overview') }} @else {{ route('customer.login') }} @endif" class="nav-link"  title="{{ __('Account') }}"><i class="linearicons-user"></i></a></li>
            @if (EcommerceHelper::isWishlistEnabled())
                <li><a href="{{ route('public.wishlist') }}" class="nav-link btn-wishlist" title="{{ __('Wishlist') }}"><i class="linearicons-heart"></i><span class="wishlist_count">{{ !auth('customer')->check() ? Cart::instance('wishlist')->count() : auth('customer')->user()->wishlist()->count() }}</span></a></li>
            @endif

            @if (EcommerceHelper::isCartEnabled())
                <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger btn-shopping-cart" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">{{ Cart::instance('cart')->count() }}</span></a>
                    <div class="cart_box dropdown-menu dropdown-menu-right">
                        {!! Theme::partial('cart') !!}
                    </div>
                </li>
            @endif
        </ul>
        <div class="pr_search_icon">
            <span class="nav-link pr_search_trigger cursor-pointer text-white" title="{{ __('Search') }}"><i class="linearicons-magnifier"></i></span>
        </div>
    @endif
</nav>
