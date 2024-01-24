
@php
isset($following_agent) ? "" : $following_agent ="";
isset($account) ? "" : $account ="";
isset($mylistings) ? "" : $mylistings ="";
isset($createListing) ? "" : $createListing ="";
isset($customer_appointment) ? "" : $customer_appointment ="";
isset($agent_appointment) ? "" : $agent_appointment ="";
isset($wishlist) ? "" : $wishlist ="";
isset($payment_settings) ? "" : $payment_settings ="";
isset($become_an_agent) ? "" : $become_an_agent ="";
isset($customer_messages) ? "" : $customer_messages ="";
isset($agent_messages) ? "" : $agent_messages ="";
isset($subscription) ? "" : $subscription ="";
isset($blogs) ? "" : $blogs ="";

use App\Models\Appointment;
$no_of_customer_appointments = Appointment::where("customer_id", auth()->user()->id)->count();
$no_of_agent_appointments = Appointment::where("agent_id", auth()->user()->id)->count();



@endphp
<style>
    .icon path{
        fill:#929292;
    }
    .nav-links-li:hover .sidebar_icon .icon path{
        fill:#007bff;
        transition: .5s;
    }
    .user_img img {
        height: 100px;
        width: 100px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
<div class="col-lg-3 col-md-4 col-sm-5">
    <div class="l_sideber_left">
        <!-- Admin Info -->
        <div class="user_info d-flex flex-column align-items-center">
            <div class="user_img rounded-circle overflow-hidden">
                <img src="{{ get_user_image(auth()->user()->id) }}" alt="" />



            </div>
            <div class="adminDetails d-flex flex-column align-items-center">
                <h3 class="title">{{ auth()->user()->name }}</h3>
                <p class="info">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <!-- Start Tab -->
        <div class="l_sidebar_tab d-flex flex-row flex-lg-column flex-wrap">
            <div class="sidebar_customer_panel">
                <h5 class="tab_title">{{ get_phrase('My Customer Panel') }}</h5>
                <div class="l_sidebarMenu">
                    <ul class="nav-links">
                        <!-- Sidebar menu -->
                        <li class="nav-links-li">
                            <a href="{{ route('checkWishlistDetails', ['type' => '1']) }}" class="nav-item {{ $wishlist }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/wishlist.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Wishlist') }}</span>
                                </div>
                                <!-- Notification -->
                                <div class="nav-item-notify">

                                    <span><?= count(json_decode(auth()->user()->wishlist, TRUE)); ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('customerAppointmentList', ['type' => 1 ]) }}" class="nav-item {{ $customer_appointment }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/appointment.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Appointment') }}</span>
                                </div>
                                <div class="nav-item-notify">

                                    <span>{{ $no_of_customer_appointments }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('agentMesssage') }}" class="nav-item {{ $agent_messages }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/messages.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Messages') }}</span>
                                </div>
                                <!-- Notification -->
                                <div class="nav-item-notify">
                                    <span><?= count_unread_agent_messages(); ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('customerAccount') }}" class="nav-item {{ $account }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/account.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Account') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('followingAgentView') }}" class="nav-item {{ $following_agent }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/following-agent.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Following Agent') }}</span>
                                </div>
                                <div class="nav-item-notify">

                                    <span><?= count(json_decode(auth()->user()->following_agent, TRUE)); ?></span>
                                </div>
                            </a>
                        </li>

                        @if(auth()->user()->is_agent==0)
                        <li class="nav-links-li">
                            <a href="{{ route('becomeAnAgentFor') }}" class="nav-item {{ $become_an_agent }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </div>
                                    <span class="link_name">{{ get_phrase('Become an Agent') }}</span>
                                </div>
                            </a>
                        </li>
                        @endif

                        <li class="nav-links-li">
                    </ul>
                </div>
            </div>
            @if(auth()->user()->is_agent==1)
            <div class="sidebar_agent_panel">
                <h5 class="tab_title">{{ get_phrase('My Agent Panel') }}</h5>
                <div class="l_sidebarMenu">
                    <ul class="nav-links">
                        <!-- Sidebar menu -->
                        <li class="nav-links-li">
                            <a href="{{ route('showMyListings', ['type' => 1]) }}" class="nav-item {{ $mylistings }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                    <svg id="Layer_1" class="icon" enable-background="new 0 0 25 25" height="19" viewBox="0 0 25 25" width="19" xmlns="http://www.w3.org/2000/svg"><g><path d="m4.6 24.5h15.8c2.3 0 4.1-1.8 4.1-4.1v-15.8c0-2.3-1.8-4.1-4.1-4.1h-15.8c-2.3 0-4.1 1.8-4.1 4.1v15.8c0 2.3 1.8 4.1 4.1 4.1zm5.3-18.5h9.6c.5 0 1 .4 1 1 0 .5-.5 1-1 1h-9.6c-.6 0-1-.5-1-1 0-.6.4-1 1-1zm0 5.5h9.6c.5 0 1 .5 1 1s-.5 1-1 1h-9.6c-.6 0-1-.5-1-1s.4-1 1-1zm0 5.5h9.6c.5 0 1 .5 1 1 0 .6-.5 1-1 1h-9.6c-.6 0-1-.4-1-1 0-.5.4-1 1-1zm-5-10.9c.5-.3.9-.2 1.3.1s.4 1 0 1.4c-.4.5-1.1.4-1.4.1-.4-.4-.5-1.1.1-1.6zm1.3 7.1c-.4.4-1 .4-1.4 0-.3-.3-.4-.9 0-1.4.4-.4 1-.4 1.4 0s.4 1 0 1.4zm-1.4 4.1c.3-.4 1.1-.4 1.4 0 .4.4.4 1.1 0 1.4-.4.4-1 .4-1.4 0-.4-.3-.4-.9 0-1.4z"/></g></svg>
                                    </div>
                                    <span class="link_name">{{ get_phrase('My Listings') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('add_listings_view', ['type' => 1]) }}" class="nav-item {{ $createListing }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/appointment.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Create Listings') }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('agentAppointmentList', ['type' => 1]) }}" class="nav-item {{ $agent_appointment }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/agent-appointment.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Appointment') }}</span>
                                </div>
                                <div class="nav-item-notify">

                                    <span>{{ $no_of_agent_appointments }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-links-li">
                            <a href="{{ route('customerMesssage') }}" class="nav-item {{ $customer_messages }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                        <img src="{{ asset('public/assets/customer/images/icon/messages.svg')  }}" alt="" />
                                    </div>
                                    <span class="link_name">{{ get_phrase('Messages') }}</span>
                                </div>
                                <!-- Notification -->
                                <div class="nav-item-notify">
                                    <span><?= count_unread_customer_messages(); ?></span>
                                </div>
                            </a>
                        </li>
                         @if(get_settings('agents_blog_permission') == 1 && get_frontend_settings('blog_visibility_on_home_page') == 1)   
                        <li class="nav-links-li">
                            <a href="{{ route('blogList') }}" class="nav-item {{ $blogs }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">                                     
                                    <svg class="icon" height="19" viewBox="0 0 24 24" width="19" xmlns="http://www.w3.org/2000/svg"><g id="Glyph"><path d="m18 21h-12a1 1 0 0 0 0 2h12a1 1 0 0 0 0-2z"/><path d="m18 1h-12a5 5 0 0 0 -5 5v8a5 5 0 0 0 5 5h12a5 5 0 0 0 5-5v-8a5 5 0 0 0 -5-5zm-11 6h5a1 1 0 0 1 0 2h-5a1 1 0 0 1 0-2zm10 6h-10a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2z"/></g></svg>

                                    </div>
                                    <span class="link_name">{{ get_phrase('Blog') }}</span>
                                </div>
                            </a>
                        </li>
                        @endif
                        <li class="nav-links-li">
                            <a href="{{ route('subscriptionDetails') }}" class="nav-item {{ $subscription }} d-flex justify-content-between align-items-center">
                                <!-- Icon & Text -->
                                <div class="icon-link d-flex align-items-center">
                                    <div class="sidebar_icon">
                                       <svg height="19" class="icon" viewBox="0 0 24 24" width="19" xmlns="http://www.w3.org/2000/svg"><path d="m21 6c0 2.85-4.3 5-10 5s-10-2.15-10-5 4.3-5 10-5 10 2.15 10 5zm-8 15c-4.25 0-7.88-1.1-10-2.95.06 2.83 4.33 4.95 10 4.95s9.91-2.11 10-4.91c-2.09 1.81-5.63 2.91-10 2.91zm-2-4a18.74 18.74 0 0 1 -7.51-1.4c1.28 2.02 4.94 3.4 9.51 3.4 5.7 0 10-2.15 10-5a3 3 0 0 0 -.57-1.72c-1.49 2.86-5.8 4.72-11.43 4.72zm1-4h-1-1c-3.92-.15-7.11-1.22-9-2.89.09 2.78 4.36 4.89 10 4.89s9.91-2.11 10-4.91c-1.93 1.67-5.12 2.74-9 2.91z"/></svg>
                                    </div>
                                    <span class="link_name">{{ get_phrase('Subscription') }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @endif
        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form1').submit();" class="sidebarLogoutBtn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>{{get_phrase('Logout')}}</span>
        </a>
    </div>
</div>

<form id="logout-form1" action="{{ route('logout') }}" method="POST" class="d-none">
    {{ csrf_field() }}
</form>
