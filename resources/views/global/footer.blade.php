
@php 
$cities= App\Models\City::take(5)->get();
$categoris = App\Models\Listing_arrtibute_type::where('listring_attribute_id', 1)->take(5)->get();
@endphp

<!-- Footer  Area Start   -->
<footer class="footer-area wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
<!-- Footer Top Content Start -->
    <div class="footer-content">
        <div class="container">
            <div class="row mb-70">
                <div class="col-lg-8 col-md-6 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                    <div class="newslater-text single-footer">
                        <h3 class="mb-3">{{get_settings('newsleter_footer_text')}}</h3>
                        <p>{{get_settings('newsleter_short_text')}}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                   <form action="{{ route('emailSubscribe') }}" class="newslater-form" method="POST">
                        @csrf
                        <input type="email" placeholder="Enter your email Address" class="form-control" id="subscribe_email" name="email" required>
                        <button class="n_btn" type="submit">{{ get_phrase('Subscribe') }}</button>
                    </form>
                </div>
            </div>
            <div class="row flex-column-reverse flex-sm-row mt-50">
                  <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                      <!-- Footer Logo Start -->
                    <div class="single-footer">
                        @if(get_frontend_settings('footer_logo'))
                        <a href="#"><img src="{{ asset('public/assets/uploads/logo/'.get_frontend_settings('footer_logo')) }}" alt=""></a>
                        @else
                        <a href="#"><img src="{{ asset('public/assets/global/images/logo/light_logo.png') }}" alt=""></a>
                        @endif
                        <!-- Footer Logo End -->
                        <p class="des">{{ get_frontend_settings('footer_description') }}</p>
                    </div>
                     <!-- End Footer Link Column -->
                  </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="550ms">
                    <div class="single-footer">
                        <h3>{{get_phrase('Category')}}</h3>
                            <ul class="footer-menu-link">
                                @foreach($categoris as $key => $category)
                                <li>
                                    <a href="{{route('realeStateListings')}}">{{$category->type}}</a>
                                </li>
                               @endforeach
                            </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="single-footer">
                        <h3>{{get_phrase('City')}}</h3>
                             <ul class="footer-menu-link">
                                @foreach($cities as $key => $city) 
                                <li><a href="{{route('realeStateListings')}}">{{$city->title}}</a></li>
                                @endforeach
                             </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="470ms">
                    <div class="single-footer">
                        <h3>{{get_phrase("Usefull Links")}}</h3>
                            <ul class="footer-menu-link">
                                <li><a href="{{ route('home') }}">{{ get_phrase('Home') }}</a></li>
                                <li><a href="{{ route('realeStateListingsFilter') }}">{{ get_phrase('Listings') }}</a></li>
                                <li><a href="{{ route('subscriptionPackages') }}">{{ get_phrase('Pricing') }}</a></li>
                                <li><a href="{{ route('blogGrid') }}">{{ get_phrase('Blog') }}</a></li>
                                
                            </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
                    <div class="single-footer">
                        <h3>{{get_phrase('Help')}}</h3>
                        <ul class="contact ">
                            <li><a href="{{ route('contactUs') }}">{{ get_phrase('Contact Us') }}</a></li>
                            <li><a href="mailto:{{ get_settings('system_email') }}"><i class="fa-solid fa-envelope"></i> 
                            <span>{{ get_settings('system_email') }}</span>
                            </a></li>
                            <li><a href="tel:{{ get_settings('phone') }}" class="contact-num"><i class="fa-solid fa-phone"></i> 
                            <span>{{ get_settings('phone') }}</span>   
                           </a></li>
                        </ul>
                         
                    </div>
                </div>
                <!-- End Footer Link Column -->
           </div>
    </div>  


    <!-- Footer Top Content End -->
    <!-- Footer Bottom  Content Area Start -->
    <div class="footer-bottom-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="copyright-text text-left">
                        <p>{{date('Y')}}  {{ get_phrase('by') }} <a href="{{ get_settings('footer_link') }}" target="_blank">{{ get_settings('footer_text') }}</a>, {{ get_phrase('All rights reserved') }}.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="social-link f-social-links">
                        <ul>
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
    <!-- Footer Content Bottom Area End -->
</footer>
<!--  Footer Area End   -->