<!-- Header Top Area Start -->
<div class="header_new">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-8 col-12">
         <div class="new_header_left">
            <ul class="d-flex align-items-center">
              <li><a href="tel:{{ get_settings('phone') }}"><i class="fa-solid fa-phone"></i>{{ get_settings('phone') }}</a></li>
              <li><a href="mailto:{{ get_settings('system_email') }}"><i class="fa-solid fa-envelope"></i>{{ get_settings('system_email') }}</a></li>
            </ul>
         </div>
      </div>
      <div class="col-md-4 col-lg-4 col-sm-4 col-12">
         <div class="new_header_right">
              <ul class="d-flex align-items-center">
                  <li><a href="{{ get_frontend_settings('facebook_link') }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                  <li><a href="{{ get_frontend_settings('twitter_link') }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                  <li><a href="{{ get_frontend_settings('linkedin_link') }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                  <li><a href="{{ get_frontend_settings('instagram_link') }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
             </ul>
         </div>
      </div>
    </div>
  </div>
</div>
<!-- Header Top Area  End -->

<!--  Header Area Start -->
<header class="header-area">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-4 col-sm-4 col-4 col-lg-2">
               <!-- Logo Area Start -->
                  <div class="logo">
                     @if(get_frontend_settings('dark_logo'))
                     <a href="{{ route('home') }}"><img src="{{ asset('public/assets/uploads/logo/'.get_frontend_settings('dark_logo')) }}" alt="Logo Image"></a>
                     @else
                     <a href="{{ route('home') }}"><img src="{{ asset('public/assets/global/images/logo/dark_logo.png') }}" alt="Logo Image"></a>
                     @endif
                  </div>
               <!-- Logo Area End   -->
         </div>
         <div class="col-md-8 col-lg-7 menu-items">
               <!-- Header Menu Start -->
               <nav class="header-menu">
                  <ul class="primary-menu">
                     <li class="{{request()->is('/')?'active':''}}"><a href="{{ route('home') }}">{{ get_phrase('Home') }}</a></li>
                     <li class="{{request()->is('listings')?'active':''}}" ><a href="{{ route('realeStateListings') }}">{{ get_phrase('Listing') }}</a></li>
                     <li class="{{request()->is('pricing')?'active':''}}"><a href="{{ route('subscriptionPackages') }}">{{ get_phrase('Pricing') }}</a></li>
                     @if(get_frontend_settings('blog_visibility_on_home_page') == 1)
                     <li class="{{request()->is('blog')?'active':''}}"><a href="{{ route('blogGrid') }}">{{ get_phrase('Blog') }}</a></li>
                     @endif
                     <li class="{{request()->is('contact')?'active':''}}"><a href="{{ route('contactUs') }}">{{ get_phrase('Contact') }}</a></li>
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
                        @php 
                           $profileRoute = auth()->user()->role == 'admin' ? route('admin.profile') : route('customerAccount'); 
                        @endphp
                         @if(auth()->user()->role == 'admin')    
                           <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-user"></i> {{ get_phrase('Dashboard') }}</a></li>
                         @endif
                        <li><a class="dropdown-item" href="{{ $profileRoute }}"><i class="fa-solid fa-user"></i> {{ get_phrase('Profile') }}</a></li>
                        <li>
                           <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i>  {{ get_phrase('Logout') }}</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                           </form>
                        </li>
                  </ul>
                  </div>
               <!-- User Profile End -->
               @else
               <a class="login-btn" href="{{ route('login') }}">{{ get_phrase('Login') }}</a>
               @endif
                 @if(!auth()->user() || auth()->user()->role != 'admin' )
                     @if (auth()->user() && auth()->user()->is_agent == 1)
                           <a class="listing-btn" href="{{ route('add_listings_view', ['type' => 1]) }}">+ {{ get_phrase('Add Listing') }}</a>
                     @else
                           <a class="listing-btn" href="{{route('becomeAnAgentFor')}}">+ {{ get_phrase('Add Listing') }}</a>
                     @endif
                @endif
        
                  
                  <span class="toggle-icon"><i class="fa-solid fa-bars"></i></span>
                  <span class="crose-icon"><i class="fa-solid fa-xmark"></i></span>
               </div>
               <!-- Header Button End -->
         </div>

      </div>
   </div>
</header>
<!-- Header Area End   -->
