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
                <a class="nav-link {{ request()->routeIs('transactions') || request()->routeIs('history-transaction') ? 'active' : '' }}" href="{{ route('transactions') }}">
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
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('members') ? 'active' : '' }}" href="{{ route('members') }}">
                    Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <!-- Letakkan tombol logout di halaman tampilan Anda -->
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="mt-3 nav-link btn btn-outline-primary btn-lg" style="width: 100%">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
