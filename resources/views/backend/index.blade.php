<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.metas')
    <title>{{ get_phrase('Admin') }} | {{ get_phrase('Panel') }}</title>
    @include('backend.includes_top')
</head>

<body>
    <div class="sidebar">
        <div class="logo-details mb-3">
            <div class="img_wrapper">
                @if (get_frontend_settings('light_logo'))
                    <img height="40px" src="{{ asset('public/assets/uploads/logo/' . get_frontend_settings('light_logo')) }}" alt="">
                @else
                    <img height="40px" src="{{ asset('public\assets\global\images\logo\light_logo.png') }}" alt="">
                @endif
            </div>
        </div>
        <div class="closeIcon">
            <span>{{ get_phrase('Close') }}</span>
        </div>
        <ul class="nav-links">
            <!-- sidebar title -->

            <!-- Sidebar menu -->


            <li class="nav-links-li {{ request()->is('admin/dashboard') ? 'showMenu' : '' }} ">
                <div class="iocn-link">
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="48" height="48">
                                <g>
                                    <path
                                        d="M117.333,234.667C52.532,234.667,0,182.135,0,117.333S52.532,0,117.333,0s117.333,52.532,117.333,117.333   C234.596,182.106,182.106,234.596,117.333,234.667z M117.333,64C87.878,64,64,87.878,64,117.333s23.878,53.333,53.333,53.333   s53.333-23.878,53.333-53.333S146.789,64,117.333,64z" />
                                    <path
                                        d="M394.667,234.667c-64.801,0-117.333-52.532-117.333-117.333S329.865,0,394.667,0S512,52.532,512,117.333   C511.929,182.106,459.439,234.596,394.667,234.667z M394.667,64c-29.455,0-53.333,23.878-53.333,53.333   s23.878,53.333,53.333,53.333S448,146.789,448,117.333S424.122,64,394.667,64z" />
                                    <path
                                        d="M117.333,512C52.532,512,0,459.468,0,394.667s52.532-117.333,117.333-117.333s117.333,52.532,117.333,117.333   C234.596,459.439,182.106,511.929,117.333,512z M117.333,341.333C87.878,341.333,64,365.211,64,394.667S87.878,448,117.333,448   s53.333-23.878,53.333-53.333S146.789,341.333,117.333,341.333z" />
                                    <path
                                        d="M394.667,512c-64.801,0-117.333-52.532-117.333-117.333s52.532-117.333,117.333-117.333S512,329.865,512,394.667   C511.929,459.439,459.439,511.929,394.667,512z M394.667,341.333c-29.455,0-53.333,23.878-53.333,53.333S365.211,448,394.667,448   S448,424.122,448,394.667S424.122,341.333,394.667,341.333z" />
                                </g>
                            </svg>

                        </div>
                        <span class="link_name"> {{ get_phrase('Dashboard') }}</span>
                    </a>
                </div>
            </li>

            <li class="nav-links-li {{ request()->is('admin/listing-types*') || request()->is('admin/real-estate/category*') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="{{ route('admin.ListingTypes') }}">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="48" height="48">
                                <path
                                    d="M18,17.5A1.5,1.5,0,0,1,16.5,19h-1a1.5,1.5,0,0,1,0-3h1A1.5,1.5,0,0,1,18,17.5ZM13.092,14H10.908A1.5,1.5,0,0,1,8,13.5V10a4,4,0,0,1,8,0v3.5a1.5,1.5,0,0,1-2.908.5ZM11,10v1h2V10a1,1,0,0,0-2,0Zm-.569,5.947-.925.941a1.5,1.5,0,0,0-2.139,2.095s.163.187.189.211a2.757,2.757,0,0,0,3.9-.007l1.116-1.134a1.5,1.5,0,1,0-2.138-2.106ZM22,7.157V18.5A5.507,5.507,0,0,1,16.5,24h-9A5.507,5.507,0,0,1,2,18.5V5.5A5.507,5.507,0,0,1,7.5,0h7.343a5.464,5.464,0,0,1,3.889,1.611l1.657,1.657A5.464,5.464,0,0,1,22,7.157ZM18.985,7H17a2,2,0,0,1-2-2V3.015C14.947,3.012,7.5,3,7.5,3A2.5,2.5,0,0,0,5,5.5v13A2.5,2.5,0,0,0,7.5,21h9A2.5,2.5,0,0,0,19,18.5S18.988,7.053,18.985,7Z" />
                            </svg>
                        </div>
                        <span class="link_name">
                            {{ get_phrase('Listing Type') }}
                        </span>
                    </a>

                </div>
            </li>


            <li class="nav-links-li {{ request()->is('admin/customer*') || request()->is('admin/agent*') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="#">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="48" height="48">
                                <path
                                    d="M16.5,24a1.5,1.5,0,0,1-1.489-1.335,3.031,3.031,0,0,0-6.018,0,1.5,1.5,0,0,1-2.982-.33,6.031,6.031,0,0,1,11.982,0,1.5,1.5,0,0,1-1.326,1.656A1.557,1.557,0,0,1,16.5,24Zm6.167-9.009a1.5,1.5,0,0,0,1.326-1.656A5.815,5.815,0,0,0,18.5,8a1.5,1.5,0,0,0,0,3,2.835,2.835,0,0,1,2.509,2.665A1.5,1.5,0,0,0,22.5,15,1.557,1.557,0,0,0,22.665,14.991ZM2.991,13.665A2.835,2.835,0,0,1,5.5,11a1.5,1.5,0,0,0,0-3A5.815,5.815,0,0,0,.009,13.335a1.5,1.5,0,0,0,1.326,1.656A1.557,1.557,0,0,0,1.5,15,1.5,1.5,0,0,0,2.991,13.665ZM12.077,16a3.5,3.5,0,1,0-3.5-3.5A3.5,3.5,0,0,0,12.077,16Zm6-9a3.5,3.5,0,1,0-3.5-3.5A3.5,3.5,0,0,0,18.077,7Zm-12,0a3.5,3.5,0,1,0-3.5-3.5A3.5,3.5,0,0,0,6.077,7Z" />
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('Users') }}</span>
                    </a>
                    <span class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4.743" height="7.773" viewBox="0 0 4.743 7.773">
                            <path id="navigate_before_FILL0_wght600_GRAD0_opsz24"
                                d="M1.466.247,4.5,3.277a.793.793,0,0,1,.189.288.92.92,0,0,1,0,.643A.793.793,0,0,1,4.5,4.5l-3.03,3.03a.828.828,0,0,1-.609.247.828.828,0,0,1-.609-.247.875.875,0,0,1,0-1.219L2.668,3.886.247,1.466A.828.828,0,0,1,0,.856.828.828,0,0,1,.247.247.828.828,0,0,1,.856,0,.828.828,0,0,1,1.466.247Z"
                                fill="#fff" opacity="1" />
                        </svg>
                    </span>
                </div>
                <ul class="sub-menu">
                    <li><a class="{{ request()->is('admin/agent') ? 'active' : '' }}" href="{{ route('admin.agent_list') }}"><span>
                                {{ get_phrase('Agent') }}
                            </span></a></li>
                    <li><a class="{{ request()->is('admin/customer') ? 'active' : '' }}" href="{{ route('admin.customer_list') }}"><span>
                                {{ get_phrase('Customer') }}
                            </span></a></li>

                </ul>
            </li>

            <li class="nav-links-li {{ request()->is('admin/listings') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="{{ route('admin.listings') }}">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 1792 1536">
                                <path
                                    d="M1792 1120v320q0 40-28 68t-68 28h-320q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832H960v192h96q40 0 68 28t28 68v320q0 40-28 68t-68 28H736q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832H320v192h96q40 0 68 28t28 68v320q0 40-28 68t-68 28H96q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832q0-52 38-90t90-38h512V512h-96q-40 0-68-28t-28-68V96q0-40 28-68t68-28h320q40 0 68 28t28 68v320q0 40-28 68t-68 28h-96v192h512q52 0 90 38t38 90v192h96q40 0 68 28t28 68z" />
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('Listings') }}</span>
                    </a>
                </div>
            </li>
            <li class="nav-links-li {{ request()->is('admin/cities/list*') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="{{ route('admin.cities') }}">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" class="bi bi-briefcase" viewBox="0 0 16 16">
                                <path id="Back_Office_Icon" data-name="Back Office Icon"
                                    d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </div>
                        <span class="link_name">
                            {{ get_phrase('State & City') }}
                        </span>
                    </a>

                </div>
            </li>



            <li class="nav-links-li <?php if (request()->is('admin/blogs*') || request()->is('admin/blogs/create*') || request()->is('admin/blog_category/list*') || request()->is('admin/blog/settings*')) {
                echo 'showMenu';
            } ?>">
                <div class="iocn-link">
                    <a href="#">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
                                <path
                                    d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('Blogs') }}</span>
                    </a>
                    <span class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4.743" height="7.773" viewBox="0 0 4.743 7.773">
                            <path id="navigate_before_FILL0_wght600_GRAD0_opsz24"
                                d="M1.466.247,4.5,3.277a.793.793,0,0,1,.189.288.92.92,0,0,1,0,.643A.793.793,0,0,1,4.5,4.5l-3.03,3.03a.828.828,0,0,1-.609.247.828.828,0,0,1-.609-.247.875.875,0,0,1,0-1.219L2.668,3.886.247,1.466A.828.828,0,0,1,0,.856.828.828,0,0,1,.247.247.828.828,0,0,1,.856,0,.828.828,0,0,1,1.466.247Z"
                                fill="#fff" opacity="1" />
                        </svg>
                    </span>
                </div>
                <ul class="sub-menu">
                    <li><a class="{{ request()->is('admin/blogs') ? 'active' : '' }}" href="{{ route('admin.blogs') }}"><span>{{ get_phrase('All Blogs') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/blogs/create*') ? 'active' : '' }}"
                            href="{{ route('admin.create.blogs') }}"><span>{{ get_phrase('Create New Blog') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/blog_category/list*') ? 'active' : '' }}"
                            href="{{ route('admin.blog_Category.list') }}"><span>{{ get_phrase('Blog Category') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/blog/settings*') ? 'active' : '' }}"
                            href="{{ route('admin.blog.settings') }}"><span>{{ get_phrase('Blog Settings') }}</span></a></li>
                </ul>
            </li>

            <li
                class="nav-links-li {{ request()->is('admin/package*') || request()->is('admin/subscription/report*') || request()->is('admin/subscription/pending*') || request()->is('admin/subscription/approve*') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="#">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="48" height="48">
                                <path
                                    d="M16.5,10c-1.972-.034-1.971-2.967,0-3h1c1.972,.034,1.971,2.967,0,3h-1Zm-3.5,4.413c0-1.476-.885-2.783-2.255-3.331l-2.376-.95c-.591-.216-.411-1.15,.218-1.132h1.181c.181,0,.343,.094,.434,.251,.415,.717,1.334,.962,2.05,.547,.717-.415,.962-1.333,.548-2.049-.511-.883-1.381-1.492-2.363-1.684-.399-1.442-2.588-1.375-2.896,.091-3.161,.875-3.414,5.6-.285,6.762l2.376,.95c.591,.216,.411,1.15-.218,1.132h-1.181c-.181,0-.343-.094-.434-.25-.415-.717-1.334-.961-2.05-.547-.717,.415-.962,1.333-.548,2.049,.511,.883,1.381,1.491,2.363,1.683,.399,1.442,2.588,1.375,2.896-.091,1.469-.449,2.54-1.817,2.54-3.431ZM18.5,1H5.5C2.468,1,0,3.467,0,6.5v11c0,3.033,2.468,5.5,5.5,5.5h3c1.972-.034,1.971-2.967,0-3h-3c-1.379,0-2.5-1.122-2.5-2.5V6.5c0-1.378,1.121-2.5,2.5-2.5h13c1.379,0,2.5,1.122,2.5,2.5v2c.034,1.972,2.967,1.971,3,0v-2c0-3.033-2.468-5.5-5.5-5.5Zm-5.205,18.481c-.813,.813-1.269,1.915-1.269,3.064,.044,.422-.21,1.464,.5,1.455,1.446,.094,2.986-.171,4.019-1.269l6.715-6.715c2.194-2.202-.9-5.469-3.157-3.343l-6.808,6.808Z" />
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('Subscriptions') }}</span>
                    </a>
                    <span class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4.743" height="7.773" viewBox="0 0 4.743 7.773">
                            <path id="navigate_before_FILL0_wght600_GRAD0_opsz24"
                                d="M1.466.247,4.5,3.277a.793.793,0,0,1,.189.288.92.92,0,0,1,0,.643A.793.793,0,0,1,4.5,4.5l-3.03,3.03a.828.828,0,0,1-.609.247.828.828,0,0,1-.609-.247.875.875,0,0,1,0-1.219L2.668,3.886.247,1.466A.828.828,0,0,1,0,.856.828.828,0,0,1,.247.247.828.828,0,0,1,.856,0,.828.828,0,0,1,1.466.247Z"
                                fill="#fff" opacity="1" />
                        </svg>
                    </span>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a class="{{ request()->is('admin/package*') ? 'active' : '' }}"
                            href="{{ route('admin.package') }}"><span>{{ get_phrase('Price Package') }}</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/subscription/report*') ? 'active' : '' }}"
                            href="{{ route('admin.subscription.report') }}"><span>{{ get_phrase('Subscription Report') }}</span></a>
                    </li>

                </ul>
            </li>


            <li class="nav-links-li {{ request()->is('admin/profile*') ? 'showMenu' : '' }}">
                <div class="iocn-link">
                    <a href="{{ route('admin.profile') }}">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="48" height="48">
                                <g>
                                    <path
                                        d="M244.317,299.051c-90.917,8.218-160.183,85.041-158.976,176.32V480c0,17.673,14.327,32,32,32l0,0c17.673,0,32-14.327,32-32   v-5.909c-0.962-56.045,40.398-103.838,96-110.933c58.693-5.82,110.992,37.042,116.812,95.735c0.344,3.47,0.518,6.954,0.521,10.441   V480c0,17.673,14.327,32,32,32l0,0c17.673,0,32-14.327,32-32v-10.667c-0.104-94.363-76.685-170.774-171.047-170.67   C251.854,298.668,248.082,298.797,244.317,299.051z" />
                                    <path
                                        d="M256.008,256c70.692,0,128-57.308,128-128S326.7,0,256.008,0s-128,57.308-128,128   C128.078,198.663,185.345,255.929,256.008,256z M256.008,64c35.346,0,64,28.654,64,64s-28.654,64-64,64s-64-28.654-64-64   S220.662,64,256.008,64z" />
                                </g>
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('My Profile') }}</span>
                    </a>
                </div>
            </li>


            <li class="nav-links-li <?php if (request()->is('admin/settings/system*') || request()->is('admin/settings/website*') || request()->is('admin/settings/seo*') || request()->is('admin/payment/settings*') || request()->is('admin/map/settings*') || request()->is('admin/settings/smtp*') || request()->is('admin/settings/faq*') || request()->is('admin/contact/settings') || request()->is('admin/settings/mortgage') || request()->is('admin/settings/about*') || request()->is('admin/settings/language*')) {
                echo 'showMenu'; } ?>">
                <div class="iocn-link">
                    <a href="#">
                        <div class="sidebar_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="48" height="48">
                                <g>
                                    <path
                                        d="M256,162.923c-51.405,0-93.077,41.672-93.077,93.077s41.672,93.077,93.077,93.077s93.077-41.672,93.077-93.077   C349.019,204.619,307.381,162.981,256,162.923z M256,285.077c-16.059,0-29.077-13.018-29.077-29.077s13.018-29.077,29.077-29.077   c16.059,0,29.077,13.018,29.077,29.077l0,0C285.066,272.054,272.054,285.066,256,285.077z" />
                                    <path
                                        d="M469.333,256c-0.032-32.689-7.633-64.927-22.208-94.187l10.965-7.616c14.496-10.104,18.058-30.046,7.957-44.544l0,0   c-10.104-14.496-30.046-18.058-44.544-7.957l-10.987,7.637c-32.574-34.38-75.691-56.904-122.517-64V32c0-17.673-14.327-32-32-32   l0,0c-17.673,0-32,14.327-32,32v13.333c-46.826,7.096-89.944,29.62-122.517,64l-10.987-7.637   c-14.498-10.101-34.44-6.538-44.544,7.957l0,0c-10.101,14.498-6.538,34.44,7.957,44.544l10.965,7.616   c-29.61,59.3-29.61,129.073,0,188.373l-10.965,7.616c-14.496,10.104-18.058,30.046-7.957,44.544l0,0   c10.104,14.496,30.046,18.058,44.544,7.957l10.987-7.637c32.574,34.38,75.691,56.904,122.517,64V480c0,17.673,14.327,32,32,32l0,0   c17.673,0,32-14.327,32-32v-13.333c46.826-7.096,89.944-29.62,122.517-64l10.987,7.637c14.498,10.101,34.44,6.538,44.544-7.957l0,0   c10.101-14.498,6.538-34.44-7.957-44.544l-10.965-7.616C461.7,320.927,469.301,288.689,469.333,256z M256,405.333   c-82.475,0-149.333-66.859-149.333-149.333S173.525,106.667,256,106.667S405.333,173.525,405.333,256   C405.228,338.431,338.431,405.228,256,405.333z" />
                                </g>
                            </svg>
                        </div>
                        <span class="link_name">{{ get_phrase('Settings') }}</span>
                    </a>
                    <span class="arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4.743" height="7.773" viewBox="0 0 4.743 7.773">
                            <path id="navigate_before_FILL0_wght600_GRAD0_opsz24"
                                d="M1.466.247,4.5,3.277a.793.793,0,0,1,.189.288.92.92,0,0,1,0,.643A.793.793,0,0,1,4.5,4.5l-3.03,3.03a.828.828,0,0,1-.609.247.828.828,0,0,1-.609-.247.875.875,0,0,1,0-1.219L2.668,3.886.247,1.466A.828.828,0,0,1,0,.856.828.828,0,0,1,.247.247.828.828,0,0,1,.856,0,.828.828,0,0,1,1.466.247Z"
                                fill="#fff" opacity="1" />
                        </svg>
                    </span>
                </div>
                <ul class="sub-menu">
                    <li><a class="{{ request()->is('admin/settings/system*') ? 'active' : '' }}"
                            href="{{ route('admin.system_settings') }}"><span>{{ get_phrase('System Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/website*') ? 'active' : '' }}"
                            href="{{ route('admin.website_settings') }}"><span>{{ get_phrase('Website Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/seo*') ? 'active' : '' }}"
                            href="{{ route('admin.seo_settings') }}"><span>{{ get_phrase('SEO Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/language*') ? 'active' : '' }}"
                            href="{{ route('admin.language.manage') }}"><span>{{ get_phrase('language  Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/payment/settings*') ? 'active' : '' }}"
                            href="{{ route('admin.payment_settings') }}"><span>{{ get_phrase('Payment Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/smtp*') ? 'active' : '' }}"
                            href="{{ route('admin.smtp_settings') }}"><span>{{ get_phrase('Smtp settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/mortgage*') ? 'active' : '' }}"
                            href="{{ route('admin.mortgage_settings') }}"><span>{{ get_phrase('Mortgage settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/faq*') ? 'active' : '' }}"
                            href="{{ route('admin.faq_views') }}"><span>{{ get_phrase('Manage Faq') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/map/settings*') ? 'active' : '' }}"
                            href="{{ route('admin.map_settings') }}"><span>{{ get_phrase('Map Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/contact/settings*') ? 'active' : '' }}"
                            href="{{ route('admin.contact.settings') }}"><span>{{ get_phrase('Contact Settings') }}</span></a></li>
                    <li><a class="{{ request()->is('admin/settings/about*') ? 'active' : '' }}" href="{{ route('admin.about') }}"><span>{{ get_phrase('About') }}</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <div class="home-header">
                <div class="row w-100 justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="sidebar_menu_icon">
                            <div class="menuList">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12">
                                    <path id="Union_5" data-name="Union 5" d="M-2188.5,52.5v-2h15v2Zm0-5v-2h15v2Zm0-5v-2h15v2Z" transform="translate(2188.5 -40.5)"
                                        fill="#6e6f78" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    @if (get_settings('frontend_view') == '1')
                        <div class="col float-left">
                            <div class="sidebar_menu_icon">
                                <a href="" target="" class="btn btn-outline-primary ml-3 d-none d-md-inline-block"><?php echo get_phrase('Visit Website'); ?></a>
                            </div>
                        </div>
                    @endif

                    <div class="col-auto">
                        <div class="header-menu">
                            <ul>

                                <li class="user-profile help-center">
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true"
                                            aria-expanded="false">
                                            <i class="bi bi-question-circle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu" aria-labelledby="defaultDropdown">

                                            <li>
                                                <a class="dropdown-item" href="https://creativeitem.com/docs/locus/about" target="_blank">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 24 24">
                                                            <path
                                                                d="M18 4h-5c-.552 0-1 .448-1 1v2H7c-1.103 0-2 .897-2 2v9c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 14H7V8h11v10zm-6-3h4v2h-4v-2zm0-3h4v2h-4v-2zm0-3h4v2h-4v-2z" />
                                                        </svg>
                                                    </span>
                                                    {{ get_phrase('Read documentation') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="https://www.youtube.com/watch?v=-HHhJUGQPeU&amp;list=PLR1GrQCi5Zqvhh7wgtt-ShMAM1RROYJgE"
                                                    target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play">
                                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                                    </svg>
                                                    {{ get_phrase('Watch video tutorial') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="https://support.creativeitem.com" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-headphones">
                                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                                        <path d="M21.209 13.944a12.01 12.01 0 0 1-2.843 5.336"></path>
                                                        <path d="M10.581 10.296a4 4 0 0 1 2.918 7.514"></path>
                                                        <path d="M18.364 16.97a6 6 0 0 1-8.53 2.53"></path>
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                    </svg>
                                                    {{ get_phrase('Get customer support') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="https://support.creativeitem.com" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                                                        <path fill="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M18.293 7.293l-4.5 4.5a1 1 0 0 1-1.414 0l-4.5-4.5a1 1 0 0 1 1.414-1.414L12 9.086l3.793-3.793a1 1 0 0 1 1.414 1.414zm-12 9l4.5-4.5a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1-1.414 1.414L12 14.914l-3.793 3.793a1 1 0 0 1-1.414-1.414z" />
                                                    </svg>

                                                    {{ get_phrase('Order customization') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="https://creativeitem.com/docs/locus/about" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                                                        <path fill="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M12 2a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 2a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm0 3a1 1 0 0 0-1 1v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-1-1zm0 8a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1zm4-4a1 1 0 0 0-1 1v3h2v-3a1 1 0 0 0-1-1zm-8 0a1 1 0 0 0-1 1v3h2v-3a1 1 0 0 0-1-1z" />
                                                    </svg>
                                                    {{ get_phrase('Request a new feature') }}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>

                                <li class="user-profile">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown"
                                            data-bs-auto-close="true" aria-expanded="false">
                                            <div class="">
                                                <img src="{{ get_user_image(auth()->user()->id) }}" height="42px" />
                                            </div>
                                            <div class="px-2 text-start"><span class="user-name">{{ auth()->user()->name }}</span>
                                                <span class="user-title">{{ get_phrase('Admin') }} </span>
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu" aria-labelledby="defaultDropdown">
                                            <li class="user-profile user-profile-inner">
                                                <button class="btn w-100 d-flex align-items-center" type="button">
                                                    <div class="">
                                                        <img class="radious-5px" src="{{ get_user_image(auth()->user()->id) }}" height="42px" />
                                                    </div>
                                                    <div class="px-2 text-start">
                                                        <span class="user-name">{{ auth()->user()->name }}</span>
                                                        <span class="user-title">{{ get_phrase('Admin') }}</span>
                                                    </div>
                                                </button>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.275" height="14.944" viewBox="0 0 13.275 14.944">
                                                            <g id="user_icon" data-name="user icon" transform="translate(-1368.531 -147.15)">
                                                                <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(1370.609 147.15)" fill="none" stroke="#181c32"
                                                                    stroke-width="2">
                                                                    <ellipse cx="4.576" cy="4.435" rx="4.576" ry="4.435" stroke="none" />
                                                                    <ellipse cx="4.576" cy="4.435" rx="3.576" ry="3.435" fill="none" />
                                                                </g>
                                                                <path id="Path_41" data-name="Path 41"
                                                                    d="M1485.186,311.087a5.818,5.818,0,0,1,5.856-4.283,5.534,5.534,0,0,1,5.466,4.283"
                                                                    transform="translate(-115.686 -149.241)" fill="none" stroke="#181c32" stroke-width="2" />
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    {{ get_phrase('My Account') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.password', ['edit']) }}">
                                                    <span>
                                                        <svg id="Layer_1" width="13.275" height="14.944" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                            data-name="Layer 1">
                                                            <path
                                                                d="m6.5 16a1.5 1.5 0 1 1 -1.5 1.5 1.5 1.5 0 0 1 1.5-1.5zm3 7.861a7.939 7.939 0 0 0 6.065-5.261 7.8 7.8 0 0 0 .32-3.85l.681-.689a1.5 1.5 0 0 0 .434-1.061v-2h.5a2.5 2.5 0 0 0 2.5-2.5v-.5h1.251a2.512 2.512 0 0 0 2.307-1.52 5.323 5.323 0 0 0 .416-2.635 4.317 4.317 0 0 0 -4.345-3.845 5.467 5.467 0 0 0 -3.891 1.612l-6.5 6.5a7.776 7.776 0 0 0 -3.84.326 8 8 0 0 0 2.627 15.562 8.131 8.131 0 0 0 1.475-.139zm-.185-12.661a1.5 1.5 0 0 0 1.463-.385l7.081-7.08a2.487 2.487 0 0 1 1.77-.735 1.342 1.342 0 0 1 1.36 1.149 2.2 2.2 0 0 1 -.08.851h-1.409a2.5 2.5 0 0 0 -2.5 2.5v.5h-.5a2.5 2.5 0 0 0 -2.5 2.5v1.884l-.822.831a1.5 1.5 0 0 0 -.378 1.459 4.923 4.923 0 0 1 -.074 2.955 5 5 0 1 1 -6.36-6.352 4.9 4.9 0 0 1 1.592-.268 5.053 5.053 0 0 1 1.357.191z" />
                                                        </svg>
                                                    </span>
                                                    {{ get_phrase('Change Password') }}
                                                </a>
                                            </li>



                                            <!-- Logout Button -->
                                            <li>
                                                <a class="btn eLogut_btn" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14.046" height="12.29" viewBox="0 0 14.046 12.29">
                                                            <path id="Logout"
                                                                d="M4.389,42.535H2.634a.878.878,0,0,1-.878-.878V34.634a.878.878,0,0,1,.878-.878H4.389a.878.878,0,0,0,0-1.756H2.634A2.634,2.634,0,0,0,0,34.634v7.023A2.634,2.634,0,0,0,2.634,44.29H4.389a.878.878,0,1,0,0-1.756Zm9.4-5.009-3.512-3.512a.878.878,0,0,0-1.241,1.241l2.015,2.012H5.267a.878.878,0,0,0,0,1.756H11.05L9.037,41.036a.878.878,0,1,0,1.241,1.241l3.512-3.512A.879.879,0,0,0,13.788,37.525Z"
                                                                transform="translate(0 -32)" fill="#fff" />
                                                        </svg>
                                                    </span>
                                                    {{ get_phrase('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_content">
                @yield('content')
                <!-- Start Footer -->
                <div class="copyright-text">
                    <p style="font-size:14px"> {{date('Y')}} {{ get_phrase('by') }} <a href="{{ get_settings('footer_link') }}" target="_blank">{{ get_settings('footer_text') }}</a>,
                        {{ get_phrase('All rights reserved') }}.</p>
                </div>
                <!-- End Footer -->
            </div>
        </div>
        @include('backend.modal')
    </section>

    @include('backend.includes_bottom')

</body>

</html>
