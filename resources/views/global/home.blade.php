<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('global.seo')

    @include('global.include_top')

</head>
<style>
    .hidden-text {
        display: none;
    }
</style>

@php
    $banner_image = asset('public/assets/uploads/bannar/' . get_frontend_settings('bannar'));
    if(!file_exists('public/assets/uploads/bannar/' . get_frontend_settings('bannar'))){
        $banner_image = asset('public/assets/global/images/banner-placeholder.svg');
    }

@endphp

<div class="entry_header_control" style="background-image: url({{ $banner_image }}); ">
    <!-- Header Top Area Start -->
    <div class="header_new">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-8 col-12">
                    <div class="new_header_left">
                        <ul class="d-flex align-items-center">
                            <li><a href="tel:{{ get_settings('phone') }}"><i class="fa-solid fa-phone"></i>{{ get_settings('phone') }}</a></li>
                            <li><a href="mailto:{{ get_settings('system_email') }}"><svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.41289 18.9883C11.6579 17.1493 15.8499 13.0773 15.8499 8.30728C15.85 7.28054 15.6478 6.26384 15.2549 5.31523C14.8621 4.36662 14.2862 3.50468 13.5603 2.77862C12.0941 1.31227 10.1055 0.488414 8.03189 0.488281C7.00515 0.488216 5.98845 0.690382 5.03984 1.08324C4.09123 1.47609 3.22929 2.05194 2.50323 2.77791C1.03688 4.24407 0.213023 6.23269 0.212891 8.30628C0.212891 13.0773 4.40489 17.1493 6.64989 18.9883C7.0378 19.3113 7.52662 19.4881 8.03139 19.4881C8.53617 19.4881 9.02498 19.3113 9.41289 18.9883ZM8.03089 10.0443C8.54631 10.0443 9.05015 9.89144 9.47871 9.60509C9.90726 9.31874 10.2413 8.91174 10.4385 8.43555C10.6358 7.95937 10.6874 7.43539 10.5868 6.92988C10.4863 6.42436 10.2381 5.96002 9.87361 5.59556C9.50916 5.23111 9.04481 4.98291 8.5393 4.88235C8.03378 4.7818 7.5098 4.83341 7.03362 5.03065C6.55743 5.22789 6.15043 5.56191 5.86408 5.99047C5.57773 6.41902 5.42489 6.92286 5.42489 7.43828C5.42489 8.12944 5.69945 8.79228 6.18817 9.281C6.67689 9.76972 7.33974 10.0443 8.03089 10.0443Z"
                                            fill="#007BFF" />
                                    </svg>
                                    {{ get_settings('address') }}</a></li>
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
    <header class="header-area global_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-sm-4 col-4 col-lg-2">
                    <!-- Logo Area Start -->
                    <div class="logo">
                        @if (get_frontend_settings('light_logo'))
                            <a href="{{ route('home') }}"><img src="{{ asset('public/assets/uploads/logo/' . get_frontend_settings('light_logo')) }}" alt="Logo Image"></a>
                        @else
                            <a href="{{ route('home') }}"><img src="{{ asset('public/assets/global/images/logo/light_logo.png') }}" alt="Logo Image"></a>
                        @endif
                    </div>
                    <!-- Logo Area End   -->
                </div>
                <div class="col-md-8 col-lg-7 menu-items">
                    <!-- Header Menu Start -->
                    <nav class="header-menu">
                        <ul class="primary-menu">
                            <li class="{{ request()->is('/') ? 'homeactive' : '' }}"><a href="{{ route('home') }}">{{ get_phrase('Home') }}</a></li>
                            <li><a href="{{ route('realeStateListings') }}">{{ get_phrase('Listing') }}</a></li>
                            <li><a href="{{ route('subscriptionPackages') }}">{{ get_phrase('Pricing') }}</a></li>
                            @if (get_frontend_settings('blog_visibility_on_home_page') == 1)
                                <li><a href="{{ route('blogGrid') }}">{{ get_phrase('Blog') }}</a></li>
                            @endif
                            <li><a href="{{ route('contactUs') }}">{{ get_phrase('Contact') }}</a></li>
                        </ul>
                    </nav>
                    <!-- Header Menu End -->
                </div>

                <div class="col-md-8 col-sm-8 col-8 col-lg-3">
                    <!-- Header Button Start -->
                    <div class="header-btn">
                        @if (Auth::check())
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
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                                class="fa-solid fa-arrow-right-from-bracket"></i> {{ get_phrase('Logout') }}</a>
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
    <!-- Bannar Area Start -->
    <section class="bannar-area bd_top">
        <div class="container">
            <div class="inner-col">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bannar-content text-center ">
                            <span class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">{{ get_frontend_settings('website_hero_title') }}</span>
                            <?php
                            $banner_title = get_phrase(get_frontend_settings('website_title'));
                            $banner_title_arr = explode(' ', $banner_title);
                            ?>
                            <h2 class="wow fadeInUp" data-wow-duration="1000" data-wow-delay="500"><?php
                            foreach ($banner_title_arr as $key => $value) {
                                if ($key == count($banner_title_arr) - 1) {
                                    echo '<span class="last_text">' . $value . '</span>';
                                } else {
                                    echo $value . ' ';
                                }
                            }
                            ?></h2>
                            <p class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">{{ get_frontend_settings('website_subtitle') }}.</p>
                        </div>
                        <!-- Bannar Search -->
                        <div class="bannar_drop wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <form action="{{ route('realeStateListingsFilter') }}" class="bannar-search" method="get">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-6 ban-col res-mb-20 ">
                                        <div class="single-search">
                                            <span>
                                                <svg width="22" height="29" viewBox="0 0 22 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.8481 6.48246L15.5076 1.43002C14.9395 0.892608 14.196 0.59668 13.4141 0.59668H3.24644C1.56674 0.59668 0.200195 1.96322 0.200195 3.64292V25.9082C0.200195 27.5879 1.56674 28.9544 3.24644 28.9544H18.7546C20.4343 28.9544 21.8008 27.5879 21.8008 25.9082V8.69536C21.8008 7.86185 21.4535 7.05526 20.8481 6.48246ZM19.2343 7.24302H15.0991C14.9464 7.24302 14.8222 7.11879 14.8222 6.96609V3.0689L19.2343 7.24302ZM18.7546 27.2928H3.24644C2.48294 27.2928 1.86178 26.6717 1.86178 25.9082V3.64292C1.86178 2.87942 2.48294 2.25827 3.24644 2.25827H13.1606V6.96609C13.1606 8.03499 14.0302 8.90461 15.0991 8.90461H20.1392V25.9082C20.1392 26.6717 19.5181 27.2928 18.7546 27.2928Z"
                                                        fill="#007BFF" />
                                                    <path
                                                        d="M16.9259 11.6738H4.74095C4.28213 11.6738 3.91016 12.0458 3.91016 12.5046C3.91016 12.9634 4.28213 13.3354 4.74095 13.3354H16.9259C17.3847 13.3354 17.7567 12.9634 17.7567 12.5046C17.7567 12.0458 17.3847 11.6738 16.9259 11.6738Z"
                                                        fill="#007BFF" />
                                                    <path
                                                        d="M16.9259 16.1047H4.74095C4.28213 16.1047 3.91016 16.4767 3.91016 16.9355C3.91016 17.3943 4.28213 17.7663 4.74095 17.7663H16.9259C17.3847 17.7663 17.7567 17.3943 17.7567 16.9355C17.7567 16.4767 17.3847 16.1047 16.9259 16.1047Z"
                                                        fill="#007BFF" />
                                                    <path
                                                        d="M8.76863 20.5356H4.74095C4.28213 20.5356 3.91016 20.9076 3.91016 21.3664C3.91016 21.8253 4.28213 22.1972 4.74095 22.1972H8.76863C9.22745 22.1972 9.59943 21.8253 9.59943 21.3664C9.59943 20.9076 9.22745 20.5356 8.76863 20.5356Z"
                                                        fill="#007BFF" />
                                                </svg>
                                            </span>
                                            <div>
                                                <select name="searched_category"  class="form-select nice-control cate" aria-label="">
                                                    @foreach ($categoris as $category)
                                                        <option value="{{ $category->slug }}">{{ $category->type }}</option>
                                                    @endforeach

                                                </select>
                                                <p>{{ get_phrase('Choose Type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 ban-col res-mb-20">
                                        <div class="single-search">
                                            <span>
                                                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_147_73)">
                                                        <path
                                                            d="M22.1382 4.3957C19.9337 2.19114 17.0026 0.977051 13.8849 0.977051C10.7672 0.977051 7.83604 2.19114 5.63154 4.3957C3.42698 6.60031 2.21289 9.53138 2.21289 12.649C2.21289 18.9559 8.17625 24.2017 11.38 27.0199C11.8252 27.4116 12.2097 27.7498 12.516 28.0359C12.8998 28.3944 13.3924 28.5736 13.8848 28.5736C14.3774 28.5736 14.8699 28.3944 15.2537 28.0359C15.56 27.7497 15.9445 27.4116 16.3897 27.0199C19.5935 24.2017 25.5568 18.9559 25.5568 12.649C25.5568 9.53138 24.3427 6.60031 22.1382 4.3957ZM15.322 25.8062C14.867 26.2064 14.4741 26.5521 14.1502 26.8546C14.0014 26.9935 13.7683 26.9936 13.6194 26.8546C13.2955 26.552 12.9026 26.2064 12.4477 25.8062C9.43573 23.1567 3.82935 18.2249 3.82935 12.649C3.82935 7.10449 8.34016 2.59367 13.8848 2.59367C19.4293 2.59367 23.9402 7.10449 23.9402 12.649C23.9402 18.2249 18.3339 23.1567 15.322 25.8062Z"
                                                            fill="#007BFF" />
                                                        <path
                                                            d="M13.8849 7.06421C11.0487 7.06421 8.74121 9.3716 8.74121 12.2079C8.74121 15.0441 11.0487 17.3515 13.8849 17.3515C16.7212 17.3515 19.0286 15.0441 19.0286 12.2079C19.0286 9.3716 16.7212 7.06421 13.8849 7.06421ZM13.8849 15.7349C11.9401 15.7349 10.3578 14.1526 10.3578 12.2078C10.3578 10.263 11.9401 8.68072 13.8849 8.68072C15.8298 8.68072 17.412 10.263 17.412 12.2078C17.412 14.1526 15.8298 15.7349 13.8849 15.7349Z"
                                                            fill="#007BFF" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_147_73">
                                                            <rect width="27.5966" height="27.5966" fill="white" transform="translate(0.0859375 0.977051)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <div>
                                                <select name="searched_cities" class="form-select nice-control location_h" aria-label="">
                                                    <option value="">{{ get_phrase('Location') }}</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                                                    @endforeach

                                                </select>
                                                <p>{{ get_phrase('Choose your location') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6  res-mb-20 ">
                                        <div class="single-search">
                                            <span>
                                                <svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M21.5893 13.6897V7.80732C21.5893 7.63895 21.5116 7.48338 21.4015 7.3603L14.8065 0.434992C14.6835 0.305511 14.5085 0.234131 14.3337 0.234131H3.87753C1.94718 0.234131 0.405273 1.80829 0.405273 3.73888V23.5107C0.405273 25.4413 1.94718 26.9896 3.87753 26.9896H12.1311C13.6922 29.5809 16.5299 31.3171 19.7624 31.3171C24.6729 31.3171 28.683 27.3264 28.683 22.4095C28.6897 18.1143 25.6058 14.5254 21.5893 13.6897ZM14.9816 2.5081L19.4062 7.16585H16.5363C15.6811 7.16585 14.9816 6.45987 14.9816 5.60473V2.5081ZM3.87753 25.6939C2.6662 25.6939 1.70103 24.7221 1.70103 23.5107V3.73888C1.70103 2.52091 2.6662 1.52988 3.87753 1.52988H13.6858V5.60473C13.6858 7.17889 14.9621 8.4616 16.5363 8.4616H20.2936V13.5211C20.0994 13.5147 19.9438 13.4952 19.7754 13.4952C17.5145 13.4952 15.435 14.3634 13.8672 15.7239H5.63975C5.28332 15.7239 4.99187 16.0153 4.99187 16.3715C4.99187 16.728 5.28332 17.0194 5.63975 17.0194H12.6623C12.2022 17.6673 11.82 18.3152 11.5221 19.0278H5.63975C5.28332 19.0278 4.99187 19.3192 4.99187 19.6757C4.99187 20.0318 5.28332 20.3235 5.63975 20.3235H11.1009C10.939 20.9714 10.8548 21.6904 10.8548 22.4095C10.8548 23.5755 11.0815 24.7287 11.4896 25.7005H3.87753V25.6939ZM19.769 30.0279C15.5711 30.0279 12.1569 26.6138 12.1569 22.4159C12.1569 18.2179 15.5645 14.8038 19.769 14.8038C23.9733 14.8038 27.3809 18.2179 27.3809 22.4159C27.3809 26.6138 23.9669 30.0279 19.769 30.0279Z"
                                                        fill="#007BFF" />
                                                    <path
                                                        d="M5.63909 13.7738H12.2016C12.558 13.7738 12.8494 13.4821 12.8494 13.1259C12.8494 12.7695 12.558 12.478 12.2016 12.478H5.63909C5.28266 12.478 4.99121 12.7695 4.99121 13.1259C4.99121 13.4821 5.28266 13.7738 5.63909 13.7738Z"
                                                        fill="#007BFF" />
                                                    <path
                                                        d="M19.555 18.4191C19.6069 18.4319 19.6586 18.4385 19.7106 18.4385C19.7753 18.4385 19.8336 18.4319 19.892 18.4124C20.7471 18.4838 21.4144 19.1964 21.4144 20.0646C21.4144 20.4208 21.7059 20.7122 22.0621 20.7122C22.4185 20.7122 22.71 20.4208 22.71 20.0646C22.71 18.6394 21.6995 17.4472 20.3584 17.1686V16.7541C20.3584 16.3977 20.0668 16.1062 19.7106 16.1062C19.3541 16.1062 19.0627 16.3977 19.0627 16.7541V17.1947C17.7669 17.5056 16.8018 18.6783 16.8018 20.0646C16.8018 21.6971 18.1298 23.0187 19.7559 23.0187C20.6693 23.0187 21.4144 23.7636 21.4144 24.6771C21.4144 25.5905 20.6757 26.342 19.7559 26.342C18.8424 26.342 18.0975 25.5969 18.0975 24.6835C18.0975 24.3273 17.8058 24.0356 17.4496 24.0356C17.0932 24.0356 16.8018 24.3273 16.8018 24.6835C16.8018 26.0764 17.7669 27.2425 19.0627 27.5534V28.2207C19.0627 28.5771 19.3541 28.8686 19.7106 28.8686C20.0668 28.8686 20.3584 28.5771 20.3584 28.2207V27.5728C21.6995 27.2942 22.71 26.1023 22.71 24.6771C22.71 23.0446 21.382 21.723 19.7559 21.723C18.8424 21.723 18.0975 20.9778 18.0975 20.0646C18.0975 19.2223 18.7323 18.5163 19.555 18.4191Z"
                                                        fill="#007BFF" />
                                                </svg>
                                            </span>
                                            <div>
                                                <select id="searched_price" class="form-select nice-control" aria-label="" onchange="updateHiddenFields()">
                                                    @php
                                                        $highestPrice = ceil((App\Models\Listing::max('price') + 100) / 4) * 4;
                                                        $searched_price = $highestPrice;
                                                        $step = $highestPrice % 4 === 0 ? $highestPrice / 4 : ceil($highestPrice / 4);
                                                        for ($i = 0; $i < $highestPrice; $i += $step) {
                                                            $startPrice = $i;
                                                            $endPrice = $i + $step - 1;
                                                            if ($endPrice > $highestPrice) {
                                                                $endPrice = $highestPrice;
                                                            }
                                                            $priceRanges[] = "$startPrice - $endPrice";
                                                        }
                                                    @endphp
                                                    <option value="">{{ get_phrase('Pricing') }}</option>
                                                    @if (!empty($priceRanges))
                                                        @foreach ($priceRanges as $rangeLabel)
                                                            <option value="{{ $rangeLabel }}">{{ $rangeLabel }}</option>
                                                        @endforeach
                                                    @else
                                                    @endif

                                                    <input type="hidden" id="min_price" name="min_price" value="">
                                                    <input type="hidden" id="max_price" name="max_price" value="">

                                                </select>
                                                <p>{{ get_phrase('Choose your budget') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 res-mb-20 ">
                                        <div class="single-search">
                                            <button type="submit" class="main-btn w-100"><svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.2912 16.4088C16.123 16.3072 15.9632 16.1923 15.8134 16.065C14.7756 15.0382 13.7421 14.0068 12.7128 12.9709C12.6752 12.9283 12.6404 12.8832 12.6089 12.8359C11.2055 14.0087 9.40376 14.595 7.57892 14.4727C5.75407 14.3503 4.04675 13.5288 2.81248 12.1791C1.57821 10.8294 0.91213 9.05564 0.952942 7.22714C0.993755 5.39865 1.73831 3.65638 3.03157 2.36312C4.32483 1.06986 6.06711 0.325298 7.8956 0.284485C9.72409 0.243673 11.4979 0.909751 12.8475 2.14402C14.1972 3.37829 15.0188 5.08561 15.1411 6.91046C15.2635 8.73531 14.6772 10.537 13.5044 11.9404C13.5552 11.9762 13.6039 12.0149 13.6503 12.0562C14.6795 13.0837 15.7073 14.1129 16.7335 15.144C16.8607 15.2935 16.9757 15.453 17.0773 15.6209V15.9045C17.035 16.0203 16.968 16.1254 16.8809 16.2125C16.7938 16.2996 16.6887 16.3666 16.573 16.4088H16.2912ZM2.26135 7.35713C2.25685 8.50189 2.59187 9.62228 3.22405 10.5767C3.85623 11.531 4.75718 12.2766 5.81301 12.719C6.86883 13.1614 8.03213 13.2808 9.15582 13.0621C10.2795 12.8435 11.3132 12.2966 12.1261 11.4906C12.939 10.6845 13.4946 9.6556 13.7228 8.5338C13.951 7.41201 13.8415 6.24774 13.4081 5.18819C12.9747 4.12864 12.2369 3.22138 11.2879 2.58111C10.3389 1.94084 9.22141 1.59631 8.07665 1.59107C6.54123 1.58573 5.06644 2.18995 3.97612 3.27103C2.8858 4.35212 2.26907 5.82171 2.26135 7.35713Z"
                                                        fill="white" stroke="white" stroke-width="0.2" />
                                                </svg>
                                                {{ get_phrase('Explore from listing') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bannar Area End   -->
    <!-- Building Area Start -->
    @if (count($property_category) > 0)
        <section class="building-area">
            <div class="container">
                <div class="row">
                    @foreach ($property_category as $category)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb__20 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <div class="single-building mr-14">
                                <span>
                                    <img src="{{ asset('public/uploads/real_estate/property-image/' . $category->property_image) }}" alt="">
                                </span>
                                <h4>{{ $category->type }}</h4>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Building Area End -->
</div>
@else
@endif
</div>
<!-- New City Gallary  Area Start   -->
<section class="new_antrygallary wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
    <div class="container">
        <div class="row">
            @foreach ($states as $key => $state)
                @php
                    $country = $state->state_to_country->name;
                $places = $state->state_to_city; @endphp

                @if ($key >= 0 && $key <= 1)
                    @if ($key == 0)
                        <div class="col-lg-4">
                            <div class="row">
                    @endif
                    @if ($key == 0)
                        <div class="col-lg-12 col-md-6 col-sm-12  mb-20 mr-10 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                            <div class="Egallary">
                                <div class="title_gallary">
                                    <span>{{ get_frontend_settings('feature_city_title') }}</span>
                                    <h4>{{ get_frontend_settings('feature_city_subtitle') }}.</h4>
                                </div>

                                <div class="gallar-img">
                                    <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                                    <div class="gallary_text">
                                        <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                                        <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                                    </div>
                                </div>
                                <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                                    <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                                    <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($key == 1)
                        <div class="col-lg-12 col-md-6 col-sm-12  mb-20 mr-10 mt_gallary wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="450ms">
                            <div class="Egallary">
                                <div class="gallar-img small_gallary">
                                    <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                                    <div class="gallary_text">
                                        <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                                        <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                                    </div>
                                </div>
                                <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                                    <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                                    <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                                </form>
                            </div>
                        </div>
                    @endif
                    @if ($key == 1)
        </div>
    </div>
    @endif
    @endif
    @if ($key >= 2)
        @if ($key == 2)
            <div class="col-lg-8">
                <div class="row">
        @endif
        @if ($key == 2)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-20 mr-10 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                <div class="Egallary">
                    <div class="gallar-img">
                        <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                        <div class="gallary_text">
                            <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                            <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                        </div>
                    </div>
                    <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                        <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                        <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                    </form>
                </div>
            </div>
        @endif

        @if ($key == 3)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-20 mr-10 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="550ms">
                <div class="Egallary">
                    <div class="gallar-img">
                        <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                        <div class="gallary_text">
                            <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                            <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                        </div>
                    </div>
                    <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                        <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                        <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                    </form>
                </div>
            </div>
        @endif

        @if ($key == 4)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-20 mr-10 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                <div class="Egallary">
                    <div class="gallar-img">
                        <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                        <div class="gallary_text">
                            <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                            <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                        </div>
                    </div>
                    <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                        <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                        <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                    </form>
                </div>
            </div>
        @endif

        @if ($key == 5)
            <div class="col-lg-6 col-md-6 col-sm-12 mb-20 mr-10 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
                <div class="Egallary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <div class="gallar-img overly">
                        <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                    </div>
                    <div class="egallary_count">
                        <span>{{ get_phrase('See All') }}</span>
                    </div>
                </div>
            </div>
        @endif
        @if ($key == 5)
            </div>
            </div>
        @endif
    @endif
    @endforeach
    </div>
    </div>
    <div class="text-center mt-5">
        <a href="{{ route('realeStateListingsFilter') }}" class="main-btn gallary_btn">{{ get_phrase('See More Property') }}
            <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.406 3.74159L10.4363 0.741149C10.365 0.669224 10.2801 0.612135 10.1866 0.573177C10.0931 0.534218 9.99276 0.51416 9.89146 0.51416C9.79016 0.51416 9.68986 0.534218 9.59635 0.573177C9.50283 0.612135 9.41796 0.669224 9.34662 0.741149C9.2037 0.884927 9.12348 1.07942 9.12348 1.28215C9.12348 1.48488 9.2037 1.67937 9.34662 1.82315L12.0785 4.57803H1.03593C0.83241 4.57803 0.637225 4.65888 0.493314 4.80279C0.349403 4.9467 0.268555 5.14189 0.268555 5.34541C0.268555 5.54893 0.349403 5.74412 0.493314 5.88803C0.637225 6.03194 0.83241 6.11279 1.03593 6.11279H12.1245L9.34662 8.88302C9.2747 8.95435 9.21761 9.03923 9.17865 9.13274C9.13969 9.22625 9.11963 9.32655 9.11963 9.42785C9.11963 9.52916 9.13969 9.62946 9.17865 9.72297C9.21761 9.81648 9.2747 9.90135 9.34662 9.97269C9.41796 10.0446 9.50283 10.1017 9.59635 10.1407C9.68986 10.1796 9.79016 10.1997 9.89146 10.1997C9.99276 10.1997 10.0931 10.1796 10.1866 10.1407C10.2801 10.1017 10.365 10.0446 10.4363 9.97269L13.406 6.99527C13.8372 6.56362 14.0793 5.9785 14.0793 5.36843C14.0793 4.75836 13.8372 4.17324 13.406 3.74159Z"
                    fill="white" />
            </svg>

        </a>
    </div>
</section>
<!-- Gallary Popup Modal  -->
<div class="new_g_modal">
    <!-- Modal -->
    <div class="modal rel-modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">{{ get_phrase('More Gallery') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body modal_gallary">
                    <div class="row">
                        @foreach ($states as $state)
                            @php
                                $country = $state->state_to_country->name;
                                $places = $state->state_to_city;
                            @endphp
                            <div class="col-lg-4 mb-3">
                                <div class="Egallary">
                                    <div class="gallar-img">
                                        <img src="{{ asset('public/assets/uploads/state/' . $state->thumbnail) }}" alt="image">
                                        <div class="gallary_text">
                                            <span>{{ ucfirst($state->title) }}, {{ ucfirst($country) }}</span>
                                            <p>{{ count($places) . ' ' . get_phrase('Places') }}</p>
                                        </div>
                                    </div>
                                    <form id="state_form-{{ $state->id }}" method="get" action="{{ route('realeStateListingsFilter') }}">
                                        <input type="hidden" id="{{ $state->title }}" name="searched_states" value="{{ $state->id }}" />
                                        <a href="javascript:{}" class="stretched-link" onclick="document.getElementById('state_form-{{ $state->id }}').submit();"></a>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New City Gallary  Area  End   -->
<!-- Counter  Area  Start   -->
<section class="counter_area wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 mb__20">
                <div class="counter_left">
                    <h3>{{ get_frontend_settings('directory_title') }}</h3>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-ms-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb__20">
                        <div class="counter_right">
                            <h4>{{ count($listings) }} + </h4>
                            <p>{{ get_phrase('Total Listing') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb__20">
                        <div class="counter_right">
                            <h4>{{ count($cities) }} + </h4>
                            <p>{{ get_phrase('Place In The World') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="counter_right">
                            <h4>{{ count($users) }} +</h4>
                            <p>{{ get_phrase('Happy Peoples') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter  Area  End   -->

<!-- Real Estate  Area Start  -->
<section class="real-estate section-padding pt-5wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
    <div class="container">
        <div class="title mb-50 real_title">
            <a class="title-btn" href="javascript:;"> {{ get_phrase('REAL ESTATE') }}</a>
            <p>{{ get_frontend_settings('real_estate_subtitle') }}.</p>
        </div>
        <div class="row">
            <!-- Single Product -->
            @php $counter=1 @endphp
            @foreach ($listings as $listing)
                @php
                    
                    $counter++;
                    
                    $image = json_decode($listing->gallery, true);
                    if (!empty($image)) {
                        $image = $image[0];
                    } else {
                        $image = 'nophoto';
                    }
                    
                    $property_details = $listing->get_property_details($listing->listing_type_id, $listing->id);
                    
                    if (strlen($listing->title) < 41) {
                        $title = $listing->title;
                    } else {
                        $title = substr($listing->title, 0, 30) . '...';
                    }
                    
                    $location = ucfirst($listing->listing_to_city->title) . ', ' . ucfirst($listing->listing_to_state->title) . ', ' . ucfirst($listing->listing_to_country->name);
                    
                    if (strlen($location) < 31) {
                        $location = $location;
                    } else {
                        $location = substr($location, 0, 30) . '...';
                    }
                    
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="slider-controls estate-product">
                        <!-- Single Product -->
                        <a href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}">
                            <div class="product-entry">
                                <div class="product-img">
                                    <span class="featured">{{ ucfirst($listing->type) }}</span>
                                    <img src="{{ get_listing_image_or_video($listing->id, $image) }}" alt="" />
                                    @php $wish_status=check_wishlist_status($listing->id); @endphp
                                    <span id="{{ 'grid_' . $counter }}" class="wishlist {{ $wish_status }}"
                                        onclick="wishlist_check('<?= $listing->id ?>','<?= $counter ?>'); return false;">
                                        @if ($wish_status == 'active-color')
                                            <i class="fa-solid fa-heart"></i>
                                        @else
                                            <i class="fa-regular fa-heart"></i>
                                        @endif
                                    </span>

                                </div>
                                <div class="product-details">
                                    <div class="list_price">
                                        <div>
                                            <div class="product-location d-flex">
                                                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_164_877)">
                                                        <path
                                                            d="M15.3713 2.85199C13.9334 1.33418 12.0216 0.498291 9.9881 0.498291C7.95459 0.498291 6.04272 1.33418 4.60482 2.85199C3.1669 4.36985 2.375 6.38786 2.375 8.5343C2.375 12.8766 6.26462 16.4882 8.35428 18.4285C8.64467 18.6982 8.89544 18.931 9.09524 19.128C9.34555 19.3748 9.66684 19.4983 9.98807 19.4983C10.3094 19.4983 10.6306 19.3748 10.8809 19.128C11.0807 18.931 11.3315 18.6982 11.6219 18.4285C13.7115 16.4882 17.6012 12.8766 17.6012 8.5343C17.6011 6.38786 16.8093 4.36985 15.3713 2.85199ZM10.9254 17.5929C10.6287 17.8684 10.3724 18.1064 10.1611 18.3147C10.0641 18.4104 9.91206 18.4104 9.81496 18.3147C9.6037 18.1064 9.34741 17.8684 9.05066 17.5929C7.08612 15.7688 3.42934 12.3733 3.42934 8.53434C3.42934 4.71697 6.37153 1.61131 9.98803 1.61131C13.6045 1.61131 16.5467 4.71697 16.5467 8.53434C16.5467 12.3733 12.89 15.7688 10.9254 17.5929Z"
                                                            fill="#007BFF" />
                                                        <path
                                                            d="M9.98879 4.68933C8.13883 4.68933 6.63379 6.27795 6.63379 8.23069C6.63379 10.1834 8.13883 11.772 9.98879 11.772C11.8388 11.772 13.3438 10.1834 13.3438 8.23069C13.3438 6.27795 11.8388 4.68933 9.98879 4.68933ZM9.98879 10.659C8.72025 10.659 7.6882 9.56963 7.6882 8.23065C7.6882 6.89167 8.72025 5.80228 9.98879 5.80228C11.2573 5.80228 12.2894 6.89167 12.2894 8.23065C12.2894 9.56963 11.2573 10.659 9.98879 10.659Z"
                                                            fill="#007BFF" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_164_877">
                                                            <rect width="18" height="19" fill="white" transform="translate(0.988281 0.498291)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p>{{ $location }}</p>
                                            </div>
                                            <h3 class="product-title mt-0">{{ $title }}</h3>
                                        </div>
                                        <div class="antry_list_price">
                                            <div>
                                                <div class="item-price-1">{{ currency($listing->price) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="l_text mt-0">{{ Str::limit(strip_tags($listing->short_description), 60) }}</p>
                                    <div class="product-meta d-flex justify-content-between align-items-center">
                                        <div class="product-meta-item">
                                            <img class="bed" src="{{ asset('public/assets/real-estate/images/double.png') }}" alt="">
                                            <div>
                                                <span class="number">{{ $listing->bedroom }}</span> {{ get_phrase('Bed') }}
                                            </div>
                                        </div>
                                        <div class="product-meta-item">
                                            <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.2196 7.37785H1.92022V1.83965C1.92022 1.46518 2.24617 1.13669 2.6182 1.13669H3.9035C4.26634 1.13669 4.55844 1.45203 4.56152 1.83635C3.96193 1.99732 3.45766 2.58859 3.45766 3.21268V4.09302C3.45766 4.2737 3.59603 4.42151 3.76516 4.42151H5.91753C6.08666 4.42151 6.22502 4.2737 6.22502 4.09302V3.21271C6.22502 2.57873 5.75457 1.99732 5.17651 1.83965C5.17651 1.09071 4.60768 0.479736 3.90353 0.479736H2.61823C1.90794 0.479736 1.30527 1.10386 1.30527 1.83965V7.37785C0.797916 7.37455 0.385897 7.81474 0.382812 8.35673C0.382812 8.63922 0.493507 8.90529 0.690306 9.09252V10.8138C0.690306 12.1507 1.24686 13.2971 2.14778 14.0427L1.64352 15.1136C1.56664 15.2745 1.62815 15.4716 1.78189 15.5537C1.93256 15.6358 2.11705 15.5701 2.1939 15.4059L2.66744 14.3974C3.28857 14.7522 3.98346 14.9361 4.68761 14.9296H10.8373C11.5414 14.9361 12.2363 14.7522 12.8575 14.3974L13.331 15.4059C13.4079 15.5669 13.5924 15.6325 13.743 15.5537C13.8937 15.4749 13.9552 15.2745 13.8814 15.1136L13.3771 14.0394C14.278 13.297 14.8346 12.1474 14.8346 10.8105V9.08923C15.0283 8.90855 15.1421 8.64248 15.1421 8.36329C15.1421 7.81803 14.73 7.37785 14.2196 7.37785ZM4.86902 2.45063C5.23491 2.45063 5.61006 2.83495 5.61006 3.21271V3.76456H4.07262V3.21271C4.07262 2.8481 4.48773 2.45063 4.86902 2.45063ZM14.2196 10.8138C14.2196 12.788 12.7652 14.276 10.8373 14.276H4.68758C2.75966 14.276 1.30527 12.7879 1.30527 10.8138V9.34877H14.2196V10.8138ZM14.2196 8.69178H1.31449C1.16076 8.69178 1.02239 8.57353 1.00086 8.41256C0.973182 8.20892 1.12077 8.0348 1.30527 8.0348H14.2104C14.3641 8.0348 14.5025 8.15305 14.524 8.31402C14.5517 8.5177 14.4041 8.69178 14.2196 8.69178Z"
                                                    fill="#007BFF" />
                                            </svg>
                                            <div>
                                                <span class="number">{{ $listing->bathroom }}</span> {{ get_phrase('Bat') }}
                                            </div>
                                        </div>
                                        <div class="product-meta-item">
                                            <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8237 1.52173H4.97971C4.88797 1.52173 4.79998 1.55823 4.73511 1.6232C4.67023 1.68817 4.63379 1.77629 4.63379 1.86817C4.63379 1.96006 4.67023 2.04818 4.73511 2.11315C4.79998 2.17812 4.88797 2.21462 4.97971 2.21462H12.8237C13.0179 2.21481 13.2041 2.29216 13.3415 2.42969C13.4788 2.56722 13.5561 2.75371 13.5563 2.94822V10.8044C13.5563 10.8962 13.5928 10.9844 13.6576 11.0493C13.7225 11.1143 13.8105 11.1508 13.9022 11.1508C13.994 11.1508 14.082 11.1143 14.1468 11.0493C14.2117 10.9844 14.2482 10.8962 14.2482 10.8044V2.94822C14.2477 2.57 14.0975 2.2074 13.8305 1.93996C13.5634 1.67253 13.2014 1.52212 12.8237 1.52173Z"
                                                    fill="#007BFF" />
                                                <path
                                                    d="M13.0684 11.9352C13.0025 11.8722 12.9149 11.8371 12.8239 11.8371C12.7328 11.8371 12.6452 11.8722 12.5793 11.9352C12.5472 11.9674 12.5217 12.0055 12.5043 12.0476C12.4869 12.0896 12.4779 12.1346 12.4779 12.1801C12.4779 12.2256 12.4869 12.2707 12.5043 12.3127C12.5217 12.3547 12.5472 12.3929 12.5793 12.4251L13.0673 12.9137H3.60608C3.4119 12.9135 3.22574 12.8361 3.08844 12.6986C2.95114 12.5611 2.87392 12.3746 2.87371 12.1801V2.70455L3.36151 3.1932C3.42741 3.25618 3.515 3.29132 3.60609 3.29132C3.69717 3.29132 3.78476 3.25618 3.85066 3.1932C3.88279 3.16104 3.90828 3.12286 3.92566 3.08083C3.94305 3.0388 3.952 2.99375 3.952 2.94826C3.952 2.90276 3.94305 2.85771 3.92566 2.81568C3.90828 2.77365 3.88279 2.73547 3.85066 2.70331L2.77236 1.62326C2.70646 1.56028 2.61888 1.52515 2.52779 1.52515C2.4367 1.52515 2.34911 1.56028 2.28321 1.62326L1.20469 2.70331C1.1399 2.76831 1.10352 2.85641 1.10352 2.94826C1.10352 3.0401 1.1399 3.1282 1.20469 3.1932C1.27059 3.25618 1.35818 3.29132 1.44927 3.29132C1.54035 3.29132 1.62794 3.25618 1.69384 3.1932L2.18187 2.70455V12.1801C2.18228 12.5583 2.33246 12.9209 2.59946 13.1883C2.86646 13.4558 3.22847 13.6062 3.60608 13.6066H13.0673L12.5793 14.0953C12.5472 14.1275 12.5217 14.1656 12.5043 14.2077C12.4869 14.2497 12.478 14.2947 12.478 14.3402C12.478 14.3857 12.4869 14.4308 12.5043 14.4728C12.5217 14.5148 12.5472 14.553 12.5793 14.5852C12.6114 14.6174 12.6495 14.6429 12.6915 14.6603C12.7335 14.6777 12.7784 14.6866 12.8239 14.6866C12.8693 14.6866 12.9143 14.6777 12.9562 14.6603C12.9982 14.6429 13.0363 14.6174 13.0684 14.5852L14.147 13.5051C14.1791 13.473 14.2046 13.4348 14.222 13.3928C14.2393 13.3507 14.2483 13.3057 14.2483 13.2602C14.2483 13.2147 14.2393 13.1696 14.222 13.1276C14.2046 13.0856 14.1791 13.0474 14.147 13.0152L13.0684 11.9352Z"
                                                    fill="#007BFF" />
                                                <path
                                                    d="M9.23441 10.4509C9.32613 10.4508 9.41406 10.4143 9.47891 10.3494C9.54376 10.2844 9.58023 10.1963 9.58033 10.1045V6.76342C9.58099 6.49573 9.50051 6.23414 9.34954 6.01324C9.19857 5.79234 8.98422 5.62252 8.73482 5.52624C8.48542 5.42996 8.21272 5.41175 7.95276 5.47402C7.69281 5.53629 7.45784 5.6761 7.27893 5.87498C7.15534 5.73796 7.00454 5.6283 6.8362 5.55301C6.66785 5.47772 6.48567 5.43847 6.3013 5.43775C6.07976 5.43769 5.86195 5.49486 5.66892 5.60376C5.6646 5.51344 5.62519 5.4284 5.55911 5.36679C5.49303 5.30518 5.40552 5.27189 5.31526 5.27402C5.225 5.27616 5.13916 5.31355 5.07606 5.37821C5.01296 5.44288 4.9776 5.52969 4.97754 5.62011V10.1045C4.97754 10.1964 5.01398 10.2845 5.07886 10.3495C5.14373 10.4144 5.23172 10.4509 5.32346 10.4509C5.4152 10.4509 5.50319 10.4144 5.56806 10.3495C5.63293 10.2845 5.66938 10.1964 5.66938 10.1045V6.76342C5.6697 6.59581 5.73641 6.43517 5.85486 6.31676C5.97332 6.19835 6.13384 6.13185 6.3012 6.13185C6.46856 6.13185 6.62908 6.19835 6.74754 6.31676C6.86599 6.43517 6.9327 6.59581 6.93302 6.76342V10.1045C6.93302 10.1964 6.96947 10.2845 7.03434 10.3495C7.09921 10.4144 7.1872 10.4509 7.27894 10.4509C7.37069 10.4509 7.45867 10.4144 7.52354 10.3495C7.58842 10.2845 7.62486 10.1964 7.62486 10.1045V6.76342C7.62486 6.5956 7.69143 6.43465 7.80992 6.31598C7.92841 6.19731 8.08911 6.13064 8.25668 6.13064C8.42425 6.13064 8.58496 6.19731 8.70345 6.31598C8.82194 6.43465 8.88851 6.5956 8.88851 6.76342V10.1045C8.88861 10.1963 8.92508 10.2844 8.98993 10.3494C9.05478 10.4143 9.1427 10.4508 9.23441 10.4509Z"
                                                    fill="#007BFF" />
                                                <path
                                                    d="M11.9304 5.63728L11.9854 5.56228C12.0993 5.39437 12.1602 5.19609 12.1603 4.99311C12.1603 4.72149 12.0526 4.46101 11.8608 4.26895C11.6691 4.07689 11.409 3.96899 11.1378 3.96899C10.8666 3.96899 10.6065 4.07689 10.4147 4.26895C10.223 4.46101 10.1152 4.72149 10.1152 4.99311C10.1152 5.08499 10.1517 5.17311 10.2166 5.23808C10.2814 5.30305 10.3694 5.33955 10.4612 5.33955C10.5529 5.33955 10.6409 5.30305 10.7058 5.23808C10.7706 5.17311 10.8071 5.08499 10.8071 4.99311C10.8074 4.94278 10.8191 4.89319 10.8414 4.84809C10.8637 4.80299 10.8959 4.76357 10.9357 4.73282C10.9755 4.70207 11.0217 4.68079 11.0709 4.67062C11.1201 4.66044 11.171 4.66163 11.2197 4.67409C11.2684 4.68655 11.3136 4.70995 11.3519 4.74252C11.3902 4.77509 11.4205 4.81597 11.4407 4.86206C11.4609 4.90815 11.4703 4.95824 11.4682 5.00852C11.4662 5.0588 11.4527 5.10795 11.4289 5.15224L10.3506 6.31157C10.2925 6.37363 10.2538 6.45135 10.2392 6.53517C10.2246 6.61898 10.2349 6.70523 10.2686 6.7833C10.3023 6.86138 10.3581 6.92787 10.4291 6.97459C10.5001 7.02132 10.5832 7.04624 10.6681 7.0463H11.793C11.8848 7.0463 11.9728 7.0098 12.0376 6.94483C12.1025 6.87985 12.139 6.79173 12.139 6.69985C12.139 6.60797 12.1025 6.51985 12.0376 6.45488C11.9728 6.38991 11.8848 6.35341 11.793 6.35341H11.2611L11.9052 5.66751C11.914 5.65791 11.9225 5.64776 11.9304 5.63728Z"
                                                    fill="#007BFF" />
                                            </svg>
                                            <div>
                                                <span class="number">{{ $listing->area }}</span>{{ get_phrase('Sqft') }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- See All Button -->
        <div class="see-btn-group">
            <a href="{{ route('realeStateListingsFilter') }}" class="main-btn gallary_btn">{{ get_phrase('See More Property') }}
                <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.406 3.74159L10.4363 0.741149C10.365 0.669224 10.2801 0.612135 10.1866 0.573177C10.0931 0.534218 9.99276 0.51416 9.89146 0.51416C9.79016 0.51416 9.68986 0.534218 9.59635 0.573177C9.50283 0.612135 9.41796 0.669224 9.34662 0.741149C9.2037 0.884927 9.12348 1.07942 9.12348 1.28215C9.12348 1.48488 9.2037 1.67937 9.34662 1.82315L12.0785 4.57803H1.03593C0.83241 4.57803 0.637225 4.65888 0.493314 4.80279C0.349403 4.9467 0.268555 5.14189 0.268555 5.34541C0.268555 5.54893 0.349403 5.74412 0.493314 5.88803C0.637225 6.03194 0.83241 6.11279 1.03593 6.11279H12.1245L9.34662 8.88302C9.2747 8.95435 9.21761 9.03923 9.17865 9.13274C9.13969 9.22625 9.11963 9.32655 9.11963 9.42785C9.11963 9.52916 9.13969 9.62946 9.17865 9.72297C9.21761 9.81648 9.2747 9.90135 9.34662 9.97269C9.41796 10.0446 9.50283 10.1017 9.59635 10.1407C9.68986 10.1796 9.79016 10.1997 9.89146 10.1997C9.99276 10.1997 10.0931 10.1796 10.1866 10.1407C10.2801 10.1017 10.365 10.0446 10.4363 9.97269L13.406 6.99527C13.8372 6.56362 14.0793 5.9785 14.0793 5.36843C14.0793 4.75836 13.8372 4.17324 13.406 3.74159Z"
                        fill="white" />
                </svg>

            </a>
        </div>
    </div>
</section>
<!-- Real Estate Area End   -->
<!-- Hero  Area Start  -->
<section class="hero-area wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms"
    style="background-image: url({{ asset('public/assets/uploads/bannar/' . get_frontend_settings('video_image')) }}); ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 hero-icon-control">
                <div class="hero-icon">
                    <a href="{{ get_frontend_settings('feature_video_url') }}" class="vedio-popup" id="vedio-popup" data-autoplay="true" data-vbtype="video"><i
                            class="fa-solid fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero-content">
                    <a class="bussines-btn" href="#">{{ get_frontend_settings('feature_video_title') }}</a>
                    <h4>{{ get_frontend_settings('feature_video_subtitle') }}</h4>
                    <p>{{ get_frontend_settings('feature_video_description') }}</p>
                    <a href="{{ route('contactUs') }}" class="main-btn">{{ get_phrase('Contact Us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero  Area End   -->
<!-- Testimonials  Area Start   -->
<section class="testimonials-area section-padding wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-intro">
                    <p>{{ get_phrase('REVIEWS') }}</p>
                    <h4>{{ get_phrase('What the people Thinks About Us.') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonials-carousel owl-carousel owl-theme">
                    @foreach ($reviews as $review)
                        @php
                            $user_name = $review->review_to_user->name;
                        @endphp
                        <div class="review-card  rounded">
                            <div class="avatar d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <img class="me-3 rounded-image" src="{{ get_user_image($review->user_id) }}" alt="" />
                                    <div class="avatar-info">
                                        <h5>{{ $user_name }}</h5>
                                    </div>
                                </div>
                                <div class="quote-img">
                                    <svg width="45" height="38" viewBox="0 0 45 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.68">
                                            <path
                                                d="M3.04468 35.1776C-4.51369 15.163 4.96572 5.48375 12.9945 2.10619C14.7281 1.3769 16.4739 2.77087 16.4739 4.65162V6.35747C16.4739 7.98512 15.0873 9.20463 13.6035 9.87369C11.129 10.9895 10.0939 13.5567 9.77411 15.8584C9.56449 17.3673 10.8665 18.5406 12.3899 18.5406H16.9135C18.5412 18.5406 19.8606 19.8601 19.8606 21.4877V34.0655C19.8606 35.6931 18.5412 37.0126 16.9135 37.0126H5.73851C4.54877 37.0126 3.465 36.2906 3.04468 35.1776Z"
                                                fill="#007BFF" />
                                            <path
                                                d="M27.5212 35.1776C19.9629 15.163 29.4423 5.48375 37.4711 2.10619C39.2047 1.3769 40.9504 2.77087 40.9504 4.65162V6.35747C40.9504 7.98512 39.5639 9.20463 38.0801 9.87369C35.6056 10.9895 34.5704 13.5567 34.2507 15.8584C34.0411 17.3673 35.343 18.5406 36.8664 18.5406H41.3901C43.0177 18.5406 44.3372 19.8601 44.3372 21.4877V34.0655C44.3372 35.6931 43.0177 37.0126 41.3901 37.0126H30.2151C29.0253 37.0126 27.9416 36.2906 27.5212 35.1776Z"
                                                fill="#007BFF" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <p>{{ substr($review->review, 0, 140) }}... </p>
                            <div class="d-flex align-items-center mt-3">
                                <div class="ratings me-4 rate">
                                    @php
                                        $star_count = (int) $review->rating;
                                        $blank_count = 5 - $star_count;
                                    @endphp
                                    @while ($star_count > 0)
                                        <span><i class="fa fa-star"></i></span>
                                        @php $star_count--; @endphp
                                    @endwhile
                                    @while ($blank_count > 0)
                                        <span class="color_hide"><i class="fa-solid fa-star"></i></span>
                                        @php $blank_count--; @endphp
                                    @endwhile
                                </div>
                                <span class="rating-point fw-bold">{{ $review->rating }}.0</span>
                            </div>
                        </div>
                        <!-- Review Card End -->
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials  Area End   -->
<!-- Pricing Plan  Area Start   -->
<section class="pricing_plan wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-intro mb-50">
                    <p>{{ get_frontend_settings('pricing_subtitle') }}</p>
                    <h4>{{ get_frontend_settings('pricing_title') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($packages as $package)
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="card packageBox">
                        <div class="card-head">
                            <span class="price_icon">
                                @if ($package->icon_type == 1)
                                    <svg viewBox="0 0 32 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.26815 37.1424L0.25662 13.5267C0.256271 13.4693 0.251891 13.4117 0.243517 13.3543C-0.155679 11.5151 0.237636 9.95007 1.43148 8.69069C1.75609 8.34859 2.17418 8.10516 2.54981 7.81641L23.2731 0.288628C23.3085 0.299009 23.3447 0.304553 23.3808 0.305122C24.9095 0.0920977 26.5913 1.86676 26.1032 3.69634C25.5602 5.72812 25.0873 7.78493 24.5726 9.82698C24.5179 10.0462 24.5633 10.1529 24.7464 10.2824C26.4964 11.4941 28.2362 12.7223 29.9856 13.9325C30.8599 14.5364 31.2605 15.3698 31.1938 16.4106C31.1272 17.4513 30.6191 18.1595 29.6747 18.5026C22.4627 21.1143 15.2532 23.7318 8.04618 26.3549L7.7134 26.4758L7.8694 26.8846C8.99868 29.844 10.1166 32.8066 11.2652 35.759C11.5533 36.5015 11.5384 37.1093 10.977 37.6118L10.5124 37.7806C10.2785 37.7894 10.0421 37.7355 9.82472 37.6241C9.60736 37.5126 9.416 37.347 9.26815 37.1424Z"
                                            fill="#007BFF" />
                                    </svg>
                                @endif
                                @if ($package->icon_type == 2)
                                    <svg width="33" height="26" viewBox="0 0 33 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M32.2388 5.20097L32.444 19.8006C32.3949 20.0541 32.3515 20.3084 32.2957 20.5604C31.6257 23.5679 29.0729 25.609 25.892 25.6701C24.0232 25.7063 22.1542 25.7201 20.2853 25.7451C16.0042 25.8023 11.7235 25.8877 7.44175 25.904C3.82701 25.9179 0.944267 23.1161 0.886595 19.5981C0.812865 15.0937 0.74956 10.5889 0.696679 6.08374C0.692461 5.83411 0.722469 5.58504 0.785908 5.34316C1.30349 3.4416 3.66842 2.79661 5.15169 4.16082C6.23617 5.15705 7.28976 6.18179 8.35799 7.1935C8.43561 7.26712 8.51811 7.33666 8.63235 7.4379C8.73117 7.32177 8.80392 7.22446 8.88917 7.13822C10.7221 5.30042 12.5554 3.46341 14.3889 1.62721C15.6248 0.388795 17.1611 0.369849 18.433 1.57311L24.1081 6.95631C24.1915 7.03547 24.2824 7.11454 24.3775 7.20077C24.4653 7.11932 24.5327 7.0574 24.5961 6.99393C25.6282 5.96136 26.6544 4.92324 27.6915 3.89622C28.4103 3.18415 29.2768 2.91164 30.2776 3.1696C31.2785 3.42756 31.9094 4.08626 32.1768 5.06693C32.193 5.11346 32.2138 5.15835 32.2388 5.20097Z"
                                            fill="#007BFF" />
                                    </svg>
                                @endif
                                @if ($package->icon_type == 3)
                                    <svg width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M32.2133 11.6225C31.9734 12.6241 31.5269 13.5675 30.901 14.3955C29.4141 16.35 27.9495 18.3204 26.4758 20.2844L19.8641 29.1001C18.1939 31.3271 15.0691 31.3416 13.3831 29.1331C9.5828 24.1457 5.78087 19.1593 1.97731 14.1741C1.42694 13.4554 1.0381 12.6318 0.836094 11.7568L9.04875 11.6957C9.57021 12.9843 10.0934 14.2782 10.6182 15.5774L15.3284 27.2559C15.663 28.0868 16.4156 28.4331 17.1588 28.1037C17.5504 27.9296 17.758 27.6137 17.9035 27.2352C18.8024 24.8942 19.7041 22.554 20.6085 20.2145C21.6806 17.4276 22.7548 14.6401 23.8313 11.852C23.8667 11.7598 23.9119 11.6699 23.9529 11.5648L32.2124 11.5033L32.2133 11.6225Z"
                                            fill="#007BFF" />
                                        <path
                                            d="M12.4112 0.155991C11.9547 1.36919 11.4993 2.58319 11.045 3.79797C10.4019 5.4879 9.75875 7.17543 9.12139 8.86692C9.0579 9.03615 8.98965 9.12143 8.78291 9.12217C6.19543 9.13423 3.60803 9.15668 1.02059 9.17434C0.938558 9.17495 0.861354 9.16432 0.76695 9.15703C0.913367 8.27242 1.26916 7.43322 1.80612 6.70596C2.98025 5.14804 4.16097 3.59327 5.37966 2.06701C6.20266 1.03397 7.32117 0.441802 8.647 0.238388C8.71629 0.223688 8.78463 0.20502 8.85167 0.18248L12.4112 0.155991Z"
                                            fill="#007BFF" />
                                        <path
                                            d="M23.8945 0.0707396C24.3368 0.183417 24.7887 0.26723 25.2181 0.414394C26.1231 0.722693 26.9135 1.28675 27.4885 2.03465C28.6835 3.56561 29.8714 5.10302 31.0523 6.64687C31.5745 7.32974 31.9419 8.11294 32.1303 8.94463L31.7808 8.94723C29.2746 8.96588 26.7683 8.98053 24.2622 9.00798C24.0226 9.00976 23.9114 8.95061 23.8227 8.72013C22.709 5.84173 21.5875 2.96713 20.458 0.0963135L23.8945 0.0707396Z"
                                            fill="#007BFF" />
                                        <path
                                            d="M17.6933 0.116847C17.7639 0.332263 17.8255 0.551745 17.9076 0.763877C18.939 3.40668 19.9715 6.04868 21.005 8.68987C21.0436 8.78876 21.0706 8.89253 21.1093 9.01301L11.8285 9.08207L15.2363 0.135132L17.6933 0.116847Z"
                                            fill="#007BFF" />
                                        <path d="M16.5484 23.2929L11.8584 11.6749L21.1285 11.6059C19.6221 15.5094 18.1195 19.4062 16.6207 23.2963L16.5484 23.2929Z"
                                            fill="#007BFF" />
                                    </svg>
                                @endif
                            </span>
                            <h4>{{ $package->name }}</h4>
                            <p>{{ $package->description }}</p>
                        </div>
                        <div class="card-body">
                            <div class="Eprice">
                                <h3>{{ $package->price }}</h3>
                                <p>/{{ $package->interval }}</p>
                            </div>
                            <ul class="packageFeatures">
                                @php $service_list = json_decode($package->services); @endphp
                                @foreach ($service_list as $service)
                                    <li>
                                        <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.3296 20.7221L0.560238 12.1574L9.30906 15.3444L22.8701 0.975588L10.3296 20.7221Z" fill="#47CE85" />
                                        </svg>
                                        {{ $service }}
                                    </li>
                                @endforeach
                            </ul>
                            @if (auth()->user() && auth()->user()->role == 'admin')
                                <a href="javascript:;" onclick="purchase_package('<?= $package->id ?>')" class="packageSubs_btn">{{ get_phrase('Enroll Now') }}</a>
                            @else
                                <a href="{{ route('paymentForSubscription', ['package_id' => $package->id]) }}" class="packageSubs_btn">{{ get_phrase('Enroll Now') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Pricing Plan  Area End   -->
<!-- Faq   Area Start    -->
<section class="faq-area wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
    <div class="container">
        <div class="row">
            <div class="section-intro">
                <h4>{{ get_frontend_settings('faq_title') }}</h4>
            </div>
            <div class="col-lg-12">
                <div class="accordion_antry">
                    <div class="accordion" id="accordionExample">
                        @foreach ($faqs as $key => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne{{ $key }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}"
                                        aria-expanded="true" aria-controls="collapseOne">{{ $faq->title }}</button>
                                </h2>
                                <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                    aria-labelledby="headingOne{{ $key }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{ $faq->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FAQ  Area End   -->
<!-- Blog  Area Start  -->
@if (get_frontend_settings('blog_visibility_on_home_page') == 1)
    <section class="blog-area pb-100 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="700ms">
        <div class="container">
            <div class="section-intro">
                <p>{{ get_frontend_settings('blog_title') }}</p>
                <h4>{{ get_frontend_settings('blog_subtitle') }}</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-post-items">
                        <!-- Blog Start -->
                        @foreach ($blogs as $blog)
                            @php $date = date('M d, Y', strtotime($blog->created_at));
                            $length = strlen($blog->description); @endphp
                            <div class="post-item antry-blog-post wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                                <div class="post-image">
                                    <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}">
                                        @if($blog->thumbnail)
                                        <img  src="{{ asset('public/uploads/blog/' . $blog->thumbnail) }}" alt="blog-image">
                                        @else
                                        <img src="{{ asset('public/uploads/blog/placeholder.jpg') }}"  alt="...">
                                        @endif
                                    </a>
                                </div>
                                <div class="post-content mt-3">
                                    <div class="post-meta">
                                        <ul>
                                            <li>
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_164_1319)">
                                                        <path
                                                            d="M15.5299 1.87337H14.7383V1.08171C14.7383 0.871743 14.6549 0.670379 14.5064 0.521913C14.3579 0.373447 14.1566 0.290039 13.9466 0.290039C13.7367 0.290039 13.5353 0.373447 13.3868 0.521913C13.2384 0.670379 13.1549 0.871743 13.1549 1.08171V1.87337H6.82161V1.08171C6.82161 0.871743 6.73821 0.670379 6.58974 0.521913C6.44127 0.373447 6.23991 0.290039 6.02995 0.290039C5.81998 0.290039 5.61862 0.373447 5.47016 0.521913C5.32169 0.670379 5.23828 0.871743 5.23828 1.08171V1.87337H4.44661C3.39719 1.87463 2.3911 2.29207 1.64904 3.03413C0.906979 3.77619 0.489538 4.78228 0.488281 5.83171L0.488281 15.3317C0.489538 16.3811 0.906979 17.3872 1.64904 18.1293C2.3911 18.8713 3.39719 19.2888 4.44661 19.29H15.5299C16.5794 19.2888 17.5855 18.8713 18.3275 18.1293C19.0696 17.3872 19.487 16.3811 19.4883 15.3317V5.83171C19.487 4.78228 19.0696 3.77619 18.3275 3.03413C17.5855 2.29207 16.5794 1.87463 15.5299 1.87337ZM2.07161 5.83171C2.07161 5.20182 2.32184 4.59773 2.76724 4.15233C3.21264 3.70693 3.81673 3.45671 4.44661 3.45671H15.5299C16.1598 3.45671 16.7639 3.70693 17.2093 4.15233C17.6547 4.59773 17.9049 5.20182 17.9049 5.83171V6.62337H2.07161V5.83171ZM15.5299 17.7067H4.44661C3.81673 17.7067 3.21264 17.4565 2.76724 17.0111C2.32184 16.5657 2.07161 15.9616 2.07161 15.3317V8.20671H17.9049V15.3317C17.9049 15.9616 17.6547 16.5657 17.2093 17.0111C16.7639 17.4565 16.1598 17.7067 15.5299 17.7067Z"
                                                            fill="#9098A4" />
                                                        <path
                                                            d="M9.98828 13.3525C10.6441 13.3525 11.1758 12.8209 11.1758 12.165C11.1758 11.5092 10.6441 10.9775 9.98828 10.9775C9.33244 10.9775 8.80078 11.5092 8.80078 12.165C8.80078 12.8209 9.33244 13.3525 9.98828 13.3525Z"
                                                            fill="#9098A4" />
                                                        <path
                                                            d="M6.03027 13.3525C6.68611 13.3525 7.21777 12.8209 7.21777 12.165C7.21777 11.5092 6.68611 10.9775 6.03027 10.9775C5.37444 10.9775 4.84277 11.5092 4.84277 12.165C4.84277 12.8209 5.37444 13.3525 6.03027 13.3525Z"
                                                            fill="#9098A4" />
                                                        <path
                                                            d="M13.9463 13.3525C14.6021 13.3525 15.1338 12.8209 15.1338 12.165C15.1338 11.5092 14.6021 10.9775 13.9463 10.9775C13.2905 10.9775 12.7588 11.5092 12.7588 12.165C12.7588 12.8209 13.2905 13.3525 13.9463 13.3525Z"
                                                            fill="#9098A4" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_164_1319">
                                                            <rect width="19" height="19" fill="white" transform="translate(0.488281 0.290039)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $date }}
                                            </li>
                                            <li>
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_180_70)">
                                                        <path
                                                            d="M9.03711 9.29004C9.92713 9.29004 10.7972 9.02612 11.5372 8.53165C12.2772 8.03719 12.854 7.33438 13.1946 6.51212C13.5352 5.68985 13.6243 4.78505 13.4506 3.91213C13.277 3.03922 12.8484 2.2374 12.2191 1.60806C11.5898 0.978724 10.7879 0.550141 9.91502 0.376507C9.0421 0.202874 8.1373 0.291989 7.31503 0.632583C6.49277 0.973178 5.78996 1.54995 5.2955 2.28997C4.80103 3.03 4.53711 3.90003 4.53711 4.79004C4.5383 5.98315 5.01279 7.12705 5.85644 7.97071C6.7001 8.81436 7.844 9.28885 9.03711 9.29004ZM9.03711 1.79004C9.63045 1.79004 10.2105 1.96599 10.7038 2.29563C11.1972 2.62528 11.5817 3.09381 11.8087 3.64199C12.0358 4.19017 12.0952 4.79337 11.9795 5.37531C11.8637 5.95725 11.578 6.4918 11.1584 6.91136C10.7389 7.33092 10.2043 7.61664 9.62238 7.7324C9.04044 7.84815 8.43724 7.78874 7.88906 7.56168C7.34088 7.33462 6.87234 6.9501 6.5427 6.45675C6.21306 5.9634 6.03711 5.38339 6.03711 4.79004C6.03711 3.99439 6.35318 3.23133 6.91579 2.66872C7.4784 2.10611 8.24146 1.79004 9.03711 1.79004Z"
                                                            fill="#9098A4" />
                                                        <path
                                                            d="M9.03711 10.79C7.24751 10.792 5.53177 11.5038 4.26633 12.7693C3.00089 14.0347 2.28909 15.7504 2.28711 17.54C2.28711 17.739 2.36613 17.9297 2.50678 18.0704C2.64743 18.211 2.8382 18.29 3.03711 18.29C3.23602 18.29 3.42679 18.211 3.56744 18.0704C3.70809 17.9297 3.78711 17.739 3.78711 17.54C3.78711 16.1477 4.34023 14.8123 5.3248 13.8277C6.30936 12.8432 7.64472 12.29 9.03711 12.29C10.4295 12.29 11.7649 12.8432 12.7494 13.8277C13.734 14.8123 14.2871 16.1477 14.2871 17.54C14.2871 17.739 14.3661 17.9297 14.5068 18.0704C14.6474 18.211 14.8382 18.29 15.0371 18.29C15.236 18.29 15.4268 18.211 15.5674 18.0704C15.7081 17.9297 15.7871 17.739 15.7871 17.54C15.7851 15.7504 15.0733 14.0347 13.8079 12.7693C12.5424 11.5038 10.8267 10.792 9.03711 10.79Z"
                                                            fill="#9098A4" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_180_70">
                                                            <rect width="18" height="18" fill="white" transform="translate(0.0371094 0.290039)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                @php
                                                    $name = App\Models\User::where('id', $blog->user_id)->first();
                                                @endphp
                                                {{ get_phrase('by') }}<span>&nbsp;
                                                    @if ($blog->user_id == 1)
                                                        {{ get_phrase('admin') }}
                                                    @else
                                                        {{ substr($name->name, 0, 6) }}
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3><a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}">{{ $blog->title }}</a></h3>
                                    @if ($length < 85)
                                        <p>{{ Str::limit(strip_tags($blog->description), 80) }}</p>
                                    @else
                                        <p>{{ Str::limit(strip_tags($blog->description)) }}...</p>
                                    @endif

                                    <a href="{{ route('blogDetails', ['slug' => slugify($blog->title), 'id' => $blog->id]) }}"
                                        class="read-more">{{ get_phrase('Read More') }}<svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_164_1362" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="6" y="0" width="10"
                                                height="17">
                                                <path d="M15.919 0.314941H6.24023V16.3149H15.919V0.314941Z" fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_164_1362)">
                                                <path
                                                    d="M8.17181 12.3977C7.82405 12.735 7.82405 13.2838 8.17181 13.6211C8.33686 13.7812 8.56084 13.8726 8.79662 13.8726C9.03239 13.8726 9.25638 13.7812 9.42142 13.6211L14.2902 8.89893C14.632 8.56163 14.632 8.01852 14.2902 7.68123L9.42142 2.95906C9.25638 2.79899 9.03239 2.70752 8.79662 2.70752C8.56084 2.70752 8.33686 2.79899 8.16592 2.95906C7.81815 3.29064 7.81226 3.82803 8.15413 4.16533L8.16592 4.17676L12.3981 8.28722L8.16592 12.392L8.17181 12.3977Z"
                                                    fill="#0D0A08" />
                                            </g>
                                            <path
                                                d="M1.22656 7.31494C0.674278 7.31494 0.226562 7.76266 0.226562 8.31494C0.226563 8.86723 0.674278 9.31494 1.22656 9.31494L1.22656 7.31494ZM1.22656 9.31494L13.2598 9.31494L13.2598 7.31494L1.22656 7.31494L1.22656 9.31494Z"
                                                fill="#0B162D" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <!-- Blog End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- Blog  Area End   -->
<script type="text/javascript">
    "use strict";

    function purchase_package(package_id) {
        // body...
        toastr.error("You do not have access to enroll.");
    }
</script>
<script type="text/javascript">
    "use strict";

    function updateHiddenFields() {
        var selectedValue = document.getElementById('searched_price').value;
        var parts = selectedValue.split('-');
        var minPrice = parseInt(parts[0].trim());
        var maxPrice = parseInt(parts[1].trim());
        document.getElementById('min_price').value = minPrice;
        document.getElementById('max_price').value = maxPrice;
    }
</script>

@if (Auth::check())
    <script>
        "use strict";

        function wishlist_check(listing_id, id) {
            let url = "{{ route('checkWishlist') }}";
            var list = '#list_' + id;
            var grid = '#grid_' + id;

            $.ajax({
                url: url,
                data: {
                    listing_id: listing_id
                },
                success: function(response) {

                    if (response == 1) {
                        $('#grid_' + id).html('<i class="fa-solid fa-heart"></i>');
                        $(list).addClass('active-color');
                        $(grid).addClass('active-color');
                        toastr.success("Item Add To Wishlist!");
                    } else if (response == 0) {
                        $('#grid_' + id).html('<i class="fa-regular fa-heart"></i>');
                        $(list).removeClass('active-color');
                        $(grid).removeClass('active-color');
                        toastr.error("Item Remove To Wishlist!");
                    }
                }
            });
        }
    </script>
@else
    <script type="text/javascript">
        "use strict";

        function wishlist_check(listing_id, id) {
            toastr.error("Please log in first");
        }
    </script>
@endif


<!-- Footer  Area Start   -->
@include('global.footer')
<!-- Footer Area End   -->

<!-- Bottom Area Start -->
@include('global.include_bottom')
<!-- Bottom Area End   -->
</body>

</html>
