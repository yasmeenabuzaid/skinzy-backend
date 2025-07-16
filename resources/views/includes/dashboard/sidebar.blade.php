  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <div class="logo-container">
        <img src="{{asset('assets/img/new_logo2.png')}}" alt="Logo" class="logo-img">
      </div>

    <ul class="sidebar-nav" id="sidebar-nav">


          {{-- @if(Auth::user()->role == 'manager') --}}
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
          <i class="bi bi-bar-chart"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('users.index', 'users.create', 'users.edit') ? 'active' : '' }}" href="{{route('users.index')}}">
          <i class="bi bi-people"></i>
          <span>Users</span>
        </a>
      </li>
      {{-- @endif --}}


      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('categories.index', 'categories.create', 'categories.edit') ? 'active' : '' }} collapsed " href="{{route('categories.index')}}">
          <i class="bi bi-grid"></i><span>Categories</span></i>
        </a>

      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('subCategories.index', 'subCategories.create', 'subCategories.edit') ? 'active' : '' }} collapsed " href="{{route('subCategories.index')}}">
          <i class="bi bi-grid"></i><span>Sub Categories</span></i>
        </a>

      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('brands.index', 'brands.create', 'brands.edit') ? 'active' : '' }} collapsed " href="{{route('brands.index')}}">
          <i class="bi bi-grid"></i><span>Brands</span></i>
        </a>

      </li><!-- End Components Nav -->





      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('products.index', 'products.create', 'products.edit', 'products.show') ? 'active' : '' }} collapsed" href="{{route('products.index')}}">
          <i class="bi bi-bag "></i><span>Products</span></i>
        </a>

      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('order.index', 'order.show', 'order.edit') ? 'active' : '' }} collapsed" href="{{route('order.index')}}">
          <i class="bi bi-cart"></i><span>Orders</span></i>
        </a>

      </li><!-- End Charts Nav -->

      {{-- @if(Auth::user()->role == 'manager')
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('contacts.index', 'contacts.show') ? 'active' : '' }} collapsed" href="/contacts">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li><!-- End Contact Page Nav -->
      @endif --}}
      {{-- @if(Auth::user()->role == 'manager')
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('feedback.index', 'feedback.show') ? 'active' : '' }} collapsed" href="{{ route('feedback.index') }}">
            <i class="bi bi-envelope"></i>
        <span class="ms-1">feedback</span>
        </a>
      </li>
      @endif

      @if(Auth::user()->role == 'manager')
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('pay.index') ? 'active' : '' }} collapsed" href="/pay">
          <i class="bi bi-credit-card me-1"></i>
          <span class="ms-1">payments</span>
        </a>
      </li>
      @endif --}}



      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile_dash.show') ? 'active' : '' }} collapsed" href="{{ route('profile_dash.show') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('home')}}">
          <i class="bi bi-house-door"></i>
          <span>User side</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>

      </li><!-- End Login Page Nav -->



    </ul>

  </aside><!-- End Sidebar-->
