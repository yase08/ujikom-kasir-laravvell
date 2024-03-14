<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard-ecommerce.html">Kasir</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-ecommerce.html">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('dashboard/product*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('product') }}"><i class="fas fa-box"></i> <span>Product</span></a></li>
            <li class="{{ Request::is('dashboard/sale*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('sale') }}"><i class="fas fa-plus"></i> <span>Sale</span></a></li>
            </li>
            @if (Auth::user()->hasRole('admin'))
                <li class="{{ Request::is('dashboard/user*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('user') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
                <li class="{{ Request::is('dashboard/detail-sale*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('detail_sale') }}"><i class="fas fa-history"></i> <span>Detail Sale</span></a>
                <li class="{{ Request::is('dashboard/register*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('register') }}"><i class="fas fa-address-book"></i>
                        <span>Register</span></a></li>
            @endif
        </ul>
    </aside>
</div>
