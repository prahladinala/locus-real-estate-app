
<!--  Header Area Start -->
<header class="header-area">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4 col-sm-4 col-4 col-lg-2">
        <!-- Logo Area Start -->
        <div class="logo">
          <a href="{{ route('home') }}"><img src="{{ asset('public/assets/global/images/locus-logo.png') }}" alt="Logo Image"></a>
        </div>
        <!-- Logo Area End   -->
      </div>
      <div class="col-md-8 col-lg-7 menu-items">
        <!-- Header Menu Start -->
        <nav class="header-menu">
          <ul class="primary-menu">
            <li><a href="{{ route('home') }}">{{ get_phrase('Home') }}</a></li>
            <li><a href="{{ route('realeStateListings') }}">{{ get_phrase('Listing') }}</a></li>
            <li><a href="{{ route('subscriptionPackages') }}">{{ get_phrase('Pricing') }}</a></li>
            <li><a href="{{ route('blogGrid') }}">{{ get_phrase('Blog') }}</a></li>
            <li><a href="{{ route('contactUs') }}">{{ get_phrase('Contact') }}</a></li>
            <li><a class="listing-btn sm-show-btn" href="{{ route('selectListigForMyListings') }}">+ {{ get_phrase('Add Listing') }}</a></li>
            
          </ul>
        </nav>
        <!-- Header Menu End -->
      </div>
      <div class="col-md-8 col-sm-8 col-8 col-lg-3">
        <!-- Header Button Start -->
        <div class="header-btn">
          @if(Auth::check())
          <!-- User Profile Start -->
          <div class="user-profile">
            <button class="us-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ get_user_image(auth()->user()->id) }}" alt="user-img">
            </button>
            <ul class="dropdown-menu dropmenu-end">
              @if(auth()->user()->role =='user')
                <li><a class="dropdown-item" href="{{ route('customerAccount') }}"><i class="fa-solid fa-user"></i> {{ get_phrase('Profile') }}</a></li>
              @else
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa-solid fa-user"></i> {{ get_phrase('Profile') }}</a></li>
              @endif
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i>  {{ get_phrase('Logout') }}
                </a>
                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </div>
          <!-- User Profile End -->
          @else
          <a class="login-btn" href="{{ route('login') }}">{{ get_phrase('Login') }}</a>
          @endif

          <a class="listing-btn sm-hide-btn" href="#">+ {{ get_phrase('Add Listing') }}</a>
          

          <span class="toggle-icon"><i class="fa-solid fa-bars"></i></span>
          <span class="crose-icon"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <!-- Header Button End -->
      </div>
    </div>
  </div>
</header>
<!-- Header Area End   -->