<aside id="sidebar" class="sidebar">

    <div class="logo-container">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/bark_Logo.png') }}" alt="Logo" class="logo-img">
        </a>
    </div>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['users.index', 'users.create', 'users.edit']) ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="nav-heading">Content Management</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['categories.index', 'categories.create', 'categories.edit']) ? 'active' : '' }}" href="{{ route('categories.index') }}">
                <i class="bi bi-grid-fill"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['subCategories.index', 'subCategories.create', 'subCategories.edit']) ? 'active' : '' }}" href="{{ route('subCategories.index') }}">
                <i class="bi bi-view-list"></i>
                <span>Sub Categories</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['brands.index', 'brands.create', 'brands.edit']) ? 'active' : '' }}" href="{{ route('brands.index') }}">
                <i class="bi bi-tags-fill"></i>
                <span>Brands</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['products.index', 'products.create', 'products.edit', 'products.show']) ? 'active' : '' }}" href="{{ route('products.index') }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Products</span>
            </a>
        </li>
    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('bulk.entry.index') ? 'active' : '' }}" href="{{ route('bulk.entry.index') }}">
        <i class="bi bi-stack"></i>
        <span>Bulk Entry</span>
    </a>
</li>

        <!-- New tab: Deleted Items -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-toggle="collapse"
                href="#deletedItemsDropdown"
                role="button"
                aria-expanded="false"
                aria-controls="deletedItemsDropdown"
            >
                <i class="bi bi-trash-fill"></i>
                <span>Deleted Items</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div class="collapse" id="deletedItemsDropdown" data-bs-parent="#sidebar-nav">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('deleted.categories') }}" class="nav-link">
                            Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deleted.subCategories') }}" class="nav-link">
                            Sub Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('deleted.products') }}" class="nav-link">
                            Product
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- End of Deleted Items tab -->

        <li class="nav-heading">Sales & Orders</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['order.index', 'order.show', 'order.edit']) ? 'active' : '' }}" href="{{ route('order.index') }}">
                <i class="bi bi-cart-fill"></i>
                <span>Orders</span>
            </a>
        </li>

        @if(Auth::user()->role == 'manager')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pay.index') ? 'active' : '' }}" href="/pay">
                    <i class="bi bi-credit-card-fill"></i>
                    <span>Payments</span>
                </a>
            </li>
        @endif

        <li class="nav-heading">Pages</li>
        @if(Auth::user()->role == 'manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ config('app.user_view_url') }}" target="_blank" rel="noopener">
                    <i class="bi bi-eye-fill"></i>
                    <span>View as User</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile_dash.show') ? 'active' : '' }}" href="{{ route('profile_dash.show') }}">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>

</aside>
