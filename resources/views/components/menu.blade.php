<div class="menu">
    <div class="menu-header">
        <a href="{{ url('/') }}" class="menu-header-logo">
            <img style="width:250px" src="{{ url('assets/images/logo.png') }}" alt="logo">
        </a>
        <a href="{{ url('/') }}" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>
    <div class="menu-body">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                <div style="width: 90%;">
                    <div class="fw-bold">Dineesh</div>
                    <small class="text-muted">Dineesh</small>
                </div>
                <div class="">
                    <i class="bi bi-gear"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                   class="dropdown-item d-flex align-items-center text-danger">
                    <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <ul>
            <li class="menu-divider">Menu</li>
            <li>
                <a href="{{ route('orders.list') }}" @if (request()->routeIs('orders.list') || request()->routeIs('orders.create')) class="active" @endif>
                    <span class="nav-link-icon">
                        <i class="bi bi-ui-radios-grid"></i>
                    </span>
                    <span>Orders</span>
                </a>
            </li>
        </ul>
    </div>
</div>
