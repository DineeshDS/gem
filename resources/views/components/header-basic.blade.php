<div class="header">
    <div class="menu-toggle-btn">
        <!-- Menu close button for mobile devices -->
        <a href="#">
            <i class="bi bi-list"></i>
        </a>
    </div>
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <img width="300" src="{{ url('assets/images/logo.png') }}" alt="logo">
    </a>
    <!-- ./ Logo -->
    <div class="page-title">@yield('page-title')</div>
    <div class="search-form">
        <div class="input-group {{request()->is('dashboard')||request()->is('settings')||request()->is('account') || request()->is('shopify-settings') || request()->is('shopify-credentials') || request()->is('apparel-magic-credentials') || request()->is('dp-world-credentials') || request()->is('webhooks') || request()->is('schedulers/*') || request()->is('users') || request()->is('am-order-settings/*') || request()->is('dp-world-settings') || request()->is('dp-world-purchase-order-settings') || request()->is('users/create') || request()->routeIs('users.edit') || request()->routeIs('reconcile.receiver-from-shiphero') ?'d-none':''}}" >
            <button class="btn btn-outline-light" type="button" id="button-addon1">
                <i class="bi bi-search"></i>
            </button>
            <input type="text" class="form-control searchInput" placeholder="Search..." aria-label="" aria-describedby="button-addon1">
            <a href="#" class="btn btn-outline-light close-header-search-bar">
                <i class="bi bi-x"></i>
            </a>

        </div> 
    </div>
    <div class="header-bar ms-auto">
   
    </div>
    <!-- Header mobile buttons -->
    <div class="header-mobile-buttons">
        <a href="#" class="search-bar-btn">
            <i class="bi bi-search"></i>
        </a>
        <a href="#" class="actions-btn">
            <i class="bi bi-three-dots"></i>
        </a>
    </div>
    <!-- ./ Header mobile buttons -->
</div>
