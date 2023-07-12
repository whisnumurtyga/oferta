<!-- resources/views/sidebar.blade.php -->

<nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block sidebar collapse" style="padding-top: 70px; overflow:hidden; background-color: #F9F9F9;">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('transactions') ? 'active' : '' }}" href="{{ route('transactions') }}">
                    Transactions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('goods') ? 'active' : '' }}" href="{{ route('goods') }}">
                    Goods
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers') }}">
                    Suppliers
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members') ? 'active' : '' }}" href="{{ route('members') }}">
                    Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    Profile
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
