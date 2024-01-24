@extends('global.index')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/jquery-ui.css') }}">
    <script src="{{ asset('public/assets/global/js/jquery-ui.js') }}"></script>
  
    @php
        $min_value = $min_value != '' ? $min_value:0;
        $max_value = $max_value != '' ? $max_value:0;
        
        isset($type) ? $type : ($type = '');
        isset($searched_word) ? '' : ($searched_word = '');
        isset($searched_category) ? '' : ($searched_category = []);
        isset($searched_states) ? '' : ($searched_states = []);
        isset($searched_cities) ? '' : ($searched_cities = []);
        isset($searched_amenities) ? $searched_amenities : ($searched_amenities = '');
        isset($searched_type) ? '' : ($searched_type = []);
        isset($searched_bedroom) ? '' : ($searched_bedroom = []);
        isset($searched_bathroom) ? '' : ($searched_bathroom = []);
        isset($searched_garage) ? '' : ($searched_garage = []);
        
        isset($searched_min_price_range) ? '0' : ($searched_min_price_range = $min_value);
        isset($searched_max_price_range) ? '0' : ($searched_max_price_range = $max_value);
        isset($searched_area_range) ? '' : ($searched_area_range = $max_area);
        
        $number_of_visible_categories = 3;
        $number_of_visible_amenities = 3;
        $number_of_visible_cities = 3;
        $number_of_visible_states = 3;
        
        $licenses = ['Sell', 'Rent'];
        
        $numbers = ['01', '02', '03', '04', '05'];
    @endphp
    <style>
        .mapboxgl-marker {
            width: 20px;
            height: 20px;
            border: 2px solid #000;
            border-radius: 50%;
            background-color: transparent;
            cursor: pointer;
            border:0;
        }

        .selected-marker {
            width: 30px;
            height: 30px;
            border-width: 3px;
        }
        .h-500px{
            height: 500px;
        }
    </style>
    <div class="container">
        <div class="sub-header antrySub">
            <div class="row align-items-center real-row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 real-estate-search ">
                    <form id="fsdd_form" action="{{ route('realeStateListingsFilter', $type) }}" class="search-control form-search-area">

                        <input type="search" name="search" id="search" value="{{ $searched_word }}" placeholder="Search with property title" class="form-control">
                        <button type="submit" class="search-icon property-search"><svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.2912 16.4088C16.123 16.3072 15.9632 16.1923 15.8134 16.065C14.7756 15.0382 13.7421 14.0068 12.7128 12.9709C12.6752 12.9283 12.6404 12.8832 12.6089 12.8359C11.2055 14.0087 9.40376 14.595 7.57892 14.4727C5.75407 14.3503 4.04675 13.5288 2.81248 12.1791C1.57821 10.8294 0.91213 9.05564 0.952942 7.22714C0.993755 5.39865 1.73831 3.65638 3.03157 2.36312C4.32483 1.06986 6.06711 0.325298 7.8956 0.284485C9.72409 0.243673 11.4979 0.909751 12.8475 2.14402C14.1972 3.37829 15.0188 5.08561 15.1411 6.91046C15.2635 8.73531 14.6772 10.537 13.5044 11.9404C13.5552 11.9762 13.6039 12.0149 13.6503 12.0562C14.6795 13.0837 15.7073 14.1129 16.7335 15.144C16.8607 15.2935 16.9757 15.453 17.0773 15.6209V15.9045C17.035 16.0203 16.968 16.1254 16.8809 16.2125C16.7938 16.2996 16.6887 16.3666 16.573 16.4088H16.2912ZM2.26135 7.35713C2.25685 8.50189 2.59187 9.62228 3.22405 10.5767C3.85623 11.531 4.75718 12.2766 5.81301 12.719C6.86883 13.1614 8.03213 13.2808 9.15582 13.0621C10.2795 12.8435 11.3132 12.2966 12.1261 11.4906C12.939 10.6845 13.4946 9.6556 13.7228 8.5338C13.951 7.41201 13.8415 6.24774 13.4081 5.18819C12.9747 4.12864 12.2369 3.22138 11.2879 2.58111C10.3389 1.94084 9.22141 1.59631 8.07665 1.59107C6.54123 1.58573 5.06644 2.18995 3.97612 3.27103C2.8858 4.35212 2.26907 5.82171 2.26135 7.35713Z"
                                    fill="white" stroke="white" stroke-width="0.2" />
                            </svg>{{ get_phrase('Search') }}</button>
                        <input type="submit" hidden />
                    </form>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="header-bar">
                        <!-- Tablet Device Search -->
                        <div class="tablet-check">
                            <div class="tablet-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div class="tab-crose">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                        </div>
                        <!-- Single Header Bar  End -->
                        <div class="text-center title-listing filter-area">
                            @php
                                count($listings) > 0 ? ($total_listing = $listings->lastItem() - ($listings->firstItem() - 1)) : ($total_listing = 0);
                            @endphp
                            <span>{{ get_phrase('Now showing') . ' ' . $total_listing . ' ' . get_phrase('of') . ' ' . $listings->total() }}</span>
                        </div>
                        <!-- Single Header Bar Start -->
                        <div class="grid-tab">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if (Session::get('property_view') == 'grid_view') active @endif" id="pills-grid-tab" data-bs-toggle="pill" data-bs-target="#pills-grid"
                                        type="button" role="tab" aria-controls="pills-grid"
                                        aria-selected="{{ Session::get('property_view') == 'grid_view' ? 'true' : 'flase' }}"><svg width="23" height="22" viewBox="0 0 23 22"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.5969 16.1624H4.75657C5.71077 16.1624 6.48433 16.9425 6.48433 17.9048V20.0829C6.48433 21.0453 5.71077 21.8254 4.75657 21.8254H2.5969C1.6427 21.8254 0.869141 21.0453 0.869141 20.0829V17.9048C0.869141 16.9425 1.6427 16.1624 2.5969 16.1624Z"
                                                fill="white" />
                                            <path
                                                d="M21.3542 16.4603C21.0692 16.2656 20.7327 16.1618 20.3884 16.1624H18.2287C17.2745 16.1624 16.501 16.9425 16.501 17.9048V20.0829C16.501 21.0453 17.2745 21.8254 18.2287 21.8254H20.3884C21.3426 21.8254 22.1162 21.0453 22.1162 20.0829V17.9048C22.1161 17.3255 21.8305 16.7842 21.3542 16.4603Z"
                                                fill="white" />
                                            <path
                                                d="M2.5969 8.28027H4.75657C5.71077 8.28027 6.48433 9.06042 6.48433 10.0228V12.2008C6.48433 13.1632 5.71077 13.9433 4.75657 13.9433H2.5969C1.6427 13.9433 0.869141 13.1632 0.869141 12.2008V10.0228C0.869141 9.06038 1.6427 8.28027 2.5969 8.28027Z"
                                                fill="white" />
                                            <path
                                                d="M21.3542 8.57824C21.0692 8.38352 20.7327 8.2797 20.3884 8.28028H18.2287C17.2745 8.28028 16.501 9.06042 16.501 10.0228V12.2008C16.501 13.1632 17.2745 13.9433 18.2287 13.9433H20.3884C21.3426 13.9433 22.1162 13.1632 22.1162 12.2008V10.0228C22.1161 9.44341 21.8305 8.90205 21.3542 8.57824Z"
                                                fill="white" />
                                            <path
                                                d="M2.5969 0.398193H4.75657C5.71077 0.398193 6.48433 1.17834 6.48433 2.14067V4.31874C6.48433 5.28108 5.71077 6.06123 4.75657 6.06123H2.5969C1.6427 6.06123 0.869141 5.28108 0.869141 4.31874V2.14067C0.869141 1.17834 1.6427 0.398193 2.5969 0.398193Z"
                                                fill="white" />
                                            <path
                                                d="M13.5378 16.4603C13.2528 16.2656 12.9163 16.1618 12.572 16.1624H10.4123C9.45813 16.1624 8.68457 16.9425 8.68457 17.9048V20.0829C8.68457 21.0452 9.45813 21.8254 10.4123 21.8254H12.572C13.5262 21.8254 14.2998 21.0453 14.2998 20.0829V17.9048C14.2997 17.3255 14.0141 16.7842 13.5378 16.4603Z"
                                                fill="white" />
                                            <path
                                                d="M13.5378 8.57824C13.2528 8.38352 12.9163 8.2797 12.572 8.28028H10.4123C9.45813 8.28028 8.68457 9.06042 8.68457 10.0228V12.2008C8.68457 13.1632 9.45813 13.9433 10.4123 13.9433H12.572C13.5262 13.9433 14.2998 13.1632 14.2998 12.2008V10.0228C14.2997 9.44341 14.0141 8.90205 13.5378 8.57824Z"
                                                fill="white" />
                                            <path
                                                d="M13.5378 0.696158C13.2528 0.501437 12.9163 0.397624 12.572 0.398196H10.4123C9.45813 0.398196 8.68457 1.17834 8.68457 2.14068V4.31875C8.68457 5.28108 9.45813 6.06123 10.4123 6.06123H12.572C13.5262 6.06123 14.2998 5.28108 14.2998 4.31875V2.14068C14.2997 1.56137 14.0141 1.01997 13.5378 0.696158Z"
                                                fill="white" />
                                            <path
                                                d="M21.8207 1.16662C21.4996 0.686272 20.9628 0.398275 20.3884 0.398193H18.2287C17.2745 0.398193 16.501 1.17834 16.501 2.14067V4.31874C16.501 5.28108 17.2745 6.06123 18.2287 6.06123H20.3884C21.3426 6.06123 22.1162 5.28108 22.1162 4.31874V2.14067C22.1167 1.79346 22.0138 1.45409 21.8207 1.16662Z"
                                                fill="white" />
                                        </svg>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if (Session::get('property_view') == 'list_view') active @endif" id="pills-list-tab" data-bs-toggle="pill" data-bs-target="#pills-list"
                                        type="button" role="tab" aria-controls="pills-list"
                                        aria-selected="{{ Session::get('property_view') == 'list_view' ? 'true' : 'flase' }}"><svg width="29" height="23" viewBox="0 0 29 23"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_164_3283)">
                                                <path
                                                    d="M28.228 3.27928C28.228 4.04416 27.6158 4.66159 26.8573 4.66159H7.66848C6.91007 4.66159 6.29785 4.04416 6.29785 3.27928C6.29785 2.5144 6.91007 1.89697 7.66848 1.89697H26.8573C27.6158 1.89697 28.228 2.5144 28.228 3.27928ZM12.2373 18.4847H7.66848C6.91007 18.4847 6.29785 19.1021 6.29785 19.867C6.29785 20.6319 6.91007 21.2493 7.66848 21.2493H12.2373C12.9957 21.2493 13.6079 20.6319 13.6079 19.867C13.6079 19.1021 12.9957 18.4847 12.2373 18.4847ZM19.5473 10.1908H7.66848C6.91007 10.1908 6.29785 10.8083 6.29785 11.5731C6.29785 12.338 6.91007 12.9555 7.66848 12.9555H19.5473C20.3057 12.9555 20.9179 12.338 20.9179 11.5731C20.9179 10.8083 20.3057 10.1908 19.5473 10.1908Z"
                                                    fill="#0B162D" />
                                            </g>
                                            <rect x="0.979492" y="1.89673" width="2.81979" height="2.81142" rx="1.40571" fill="#0B162D" />
                                            <rect x="0.979492" y="9.92603" width="2.81979" height="2.81142" rx="1.40571" fill="#0B162D" />
                                            <rect x="0.979492" y="18.4377" width="2.81979" height="2.81142" rx="1.40571" fill="#0B162D" />
                                            <defs>
                                                <clipPath id="clip0_164_3283">
                                                    <rect width="21.9301" height="22.117" fill="white" transform="translate(6.29785 0.0537109)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- Single Header Bar End  -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product-grid-post real-pagi">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-md-12 mb-3 ">
                    <div class="product-grid-sidebar">
                        <div class="sidebar-area">
                            <!-- Sidebar Content -->
                            <div class="sidebar-content pt-3">
                                @php
                                    if (isset($type) && $type != '') {
                                        $filterRouter = route('realeStateListingsFilter', ['type' => $type]);
                                    } else {
                                        $filterRouter = route('realeStateListingsFilter');
                                    }
                                    
                                @endphp
                                <form id="filter_form" action="{{ $filterRouter }}" class="real-search">
                                    <!-- Sidebar Items -->
                                    <div class="accordion entry_accordion" id="accordionExample">
                                        <!-- Items 01 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h4>{{ get_phrase('Property Type') }}</h4>
                                            </button>
                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                <div class="accordion-body" id="Example">
                                                    <ul class="side-mega-check">
                                                        @if (!empty($real_estate_categories))
                                                            @foreach ($real_estate_categories as $index => $category)
                                                                <li class="reviews @if ($loop->iteration > 4) 'hidden-categories hidden' @endif"
                                                                    style="display: {{ $index < 4 ? 'block' : 'none' }}">
                                                                    <a href="{{ route('realeStateListingsFilter', ['type' => $category->slug]) }}">
                                                                        <div class="d-flex align-items-center g-3">
                                                                            <label>{{ ucfirst($category->type) }}</label>
                                                                        </div>
                                                                        <?php
                                                                        $list_count = App\Models\Listing::where('listing_arrtibute_type_id', $category->id)->get();
                                                                        ?>
                                                                        <p>({{ count($list_count) }})</p>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                            @if (count($real_estate_categories) > 4)
                                                                <a href="javascript:;" id="showMoreButton" class="show_text">{{ get_phrase('Show More') }}</a>
                                                            @endif
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Sidebar Items -->
                                        <div class="sidebar-items pirce_range_con">
                                            <h4>{{ get_phrase('Price Range') }}</h4>
                                            <div id="slider-range" class="new_slider"></div>
                                            <span class="new_range">
                                                <p>{{ get_phrase('Price:') }}({{ currency() }})</p>
                                                <input type="text" id="min" name="min_price" value="{{ $searched_min_price_range }}" readonly
                                                    onchange="document.getElementById('filter_form').submit()">
                                                <input type="text" id="max" name="max_price" value="{{ $searched_max_price_range }}" readonly
                                                    onchange="document.getElementById('filter_form').submit()">
                                            </span>

                                        </div>
                                        <!-- Items 02 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <h4>{{ get_phrase('Bedroom') }}</h4>
                                            </button>
                                            <div id="collapseThree" class="accordion-collapse collapse @if (!empty($searched_bedroom)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($numbers as $key => $number)
                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="bedroom-{{ $key }}" class="form-check-input" name="bedroom" type="radio"
                                                                            value="{{ $number }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($searched_bedroom == $number) checked @endif>
                                                                    </div>
                                                                    <label for="bedroom-{{ $key }}">{{ $number }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 03-->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                <h4>{{ get_phrase('Bathrooms') }}</h4>
                                            </button>
                                            <div id="collapseFour" class="accordion-collapse collapse @if (!empty($searched_bathroom)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($numbers as $key => $number)
                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="bathrooms-{{ $key }}" class="form-check-input" name="bathroom" type="radio"
                                                                            value="{{ $number }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($searched_bathroom == $number) checked @endif>
                                                                    </div>
                                                                    <label for="bathrooms-{{ $key }}">{{ $number }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 04 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">
                                                <h4>{{ get_phrase('Garage') }}</h4>
                                            </button>
                                            <div id="collapseFive" class="accordion-collapse collapse @if (!empty($searched_garage)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($numbers as $key => $number)
                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="carSpaces-{{ $key }}" class="form-check-input" name="garage" type="radio"
                                                                            value="{{ $number }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($searched_garage == $number) checked @endif>
                                                                    </div>
                                                                    <label for="carSpaces-{{ $key }}">{{ $number }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 05 -->

                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                                aria-controls="collapseSix">
                                                <h4>{{ get_phrase('Type') }}</h4>
                                            </button>
                                            <div id="collapseSix" class="accordion-collapse collapse @if (!empty($searched_type)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($licenses as $key => $license)
                                                            @php $value_check = strtolower($license);
                                                            @endphp

                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="type-{{ $key }}" class="form-check-input" name="searched_type" type="radio"
                                                                            value="{{ strtolower($license) }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($value_check == $searched_type) checked @endif>
                                                                    </div>
                                                                    <label for="type-{{ $key }}">{{ $license }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 06 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                aria-expanded="false" aria-controls="collapseSeven">
                                                <h4>{{ get_phrase('Features') }}</h4>
                                            </button>
                                            <div id="collapseSeven" class="accordion-collapse collapse @if (!empty($searched_amenities)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        <ul class="side-mega-check">
                                                            @if (!empty($all_amenities))
                                                                @foreach ($all_amenities as $key => $amenity)
                                                                    <li class="@if ($loop->iteration > 3) 'hidden-categories hidden' @endif">
                                                                        <div class="d-flex align-items-center g-3">
                                                                            <div class="form-check">
                                                                                <input id="amn{{$key}}" class="form-check-input" name="searched_amenities" type="radio"
                                                                                    value="{{ $amenity->id }}" onchange="document.getElementById('filter_form').submit()"
                                                                                    @if ($amenity->id == $searched_amenities) checked @endif>
                                                                            </div>
                                                                            <label for="amn{{$key}}">{{ $amenity->type }}</label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 07 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                aria-expanded="false" aria-controls="collapseEight">
                                                <h4>{{ get_phrase('Cities') }}</h4>
                                            </button>
                                            <div id="collapseEight" class="accordion-collapse collapse @if (!empty($searched_cities)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($cities as $city)
                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="filter_{{ $city->title }}" class="form-check-input" name="searched_cities" type="radio"
                                                                            value="{{ $city->id }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($searched_cities == $city->id) checked @endif>
                                                                    </div>
                                                                    <label for="filter_{{ $city->title }}">{{ $city->title }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Items 08 -->
                                        <div class="accordion-item sidebar-items">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                                aria-expanded="false" aria-controls="collapseNine">
                                                <h4>{{ get_phrase('States') }}</h4>
                                            </button>
                                            <div id="collapseNine" class="accordion-collapse collapse @if (!empty($searched_states)) show @endif"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul class="side-mega-check">
                                                        @foreach ($states as $state)
                                                            <li>
                                                                <div class="d-flex align-items-center g-3">
                                                                    <div class="form-check">
                                                                        <input id="{{ $state->title }}" class="form-check-input" name="searched_states" type="radio"
                                                                            value="{{ $state->id }}" onchange="document.getElementById('filter_form').submit()"
                                                                            @if ($searched_states == $state->id) checked @endif>
                                                                    </div>
                                                                    <label for="{{ $state->title }}">{{ $state->title }}</label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-3 order-2 order-lg-1">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade @if (Session::get('property_view') == 'grid_view') show active @endif" id="pills-grid" role="tabpanel" aria-labelledby="pills-grid-tab"
                            tabindex="0">
                            @include('real_estate.filter_grid')
                        </div>
                        <div class="tab-pane fade @if (Session::get('property_view') == 'list_view') show active @endif" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab"
                            tabindex="0">
                            @include('real_estate.filter_list')
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="adminPanel-pagi pt-60">
                        {!! $listings->appends(request()->all())->links('pagination::bootstrap-4') !!}
                    </div>
                </div>

                @php
                    $map_location = [];
                @endphp
                @foreach ($listings as $listing)
                    @php
                        array_push($map_location, ['long' => $listing['longitude'], 'lat' => $listing['latitude']]);
                        
                    @endphp
                @endforeach

                <div class="col-lg-3 col-md-12 mb-3 order-1  order-lg-1">
                    <div class="map-filter title-listing filter-area mb-3">
                        <span class="maptext">{{ get_phrase('Map') }}</span>
                        <div id="map" class="map_custom w-100 h-500px"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        mapboxgl.accessToken = "{{ get_settings('map_access_token') }}";
        zoom = "{{ get_settings('max_zoom_level') }}";
        // Sample list of locations
        var locations = <?= $locations ?>;
        if (locations.length === 0) {
            // If there are no locations, create a blank map container with a default center and zoom level
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [47.6238767, 34.6775777], // Default center coordinates
                zoom: 1, // Default zoom level
            });
        } else {
            // Initialize the map
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: locations[0].lngLat,
                zoom: zoom,

            });

            // Create markers for each location
            const markers = [];

            locations.forEach((location, index) => {
                let marker;

                if (location.isPrimary) {
                    // Create a red marker for the primary location with a larger size
                    marker = new mapboxgl.Marker({
                        color: '#FF0000'
                    });
                } else {
                    // Create the default marker for other locations
                    marker = new mapboxgl.Marker();
                }

                marker.setLngLat(location.lngLat)
                    .setPopup(new mapboxgl.Popup({
                            offset: 25
                        })
                        .setHTML(`<h3>${location.name}</h3><p>${location.lngLat}</p>`))
                    .addTo(map);

                markers.push(marker);

                marker.getElement().addEventListener('click', () => {
                    // Decrease the size of the previously selected marker (red marker)
                    markers.forEach((m) => {
                        if (m !== marker) {
                            m._element.classList.remove('selected-marker');
                        }
                    });

                    // Increase the size of the clicked marker
                    marker._element.classList.add('selected-marker');

                    // You can also do other actions here when a marker is clicked
                    // For example, update the selectedMarker variable
                    selectedMarker = location;
                });
            });
        }
    
        document.addEventListener("DOMContentLoaded", function() {
            var showMoreButton = document.getElementById('showMoreButton');
            var reviewsContainer = document.getElementById('Example');

            document.getElementById("showMoreButton").addEventListener('click', function() {
                var reviewDivs = reviewsContainer.getElementsByClassName('reviews');
                for (var i = 0; i < reviewDivs.length; i++) {
                    reviewDivs[i].style.display = 'block';
                }
                // Hide the "Show More" button after showing all items
                showMoreButton.style.display = 'none';
            });
        });
    
        $(function() {
            var minPrice = <?= $min_value ?>;
            var maxPrice = <?= $max_value + 10 ?>;
            var submitTimeout;

            // Set the default values for the slider
            var defaultMin = '<?= $searched_min_price_range ?>';
            var defaultMax = '<?= $searched_max_price_range ?>';

            $("#slider-range").slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                values: [defaultMin, defaultMax],
                slide: function(event, ui) {
                    $("#min").val(ui.values[0]);
                    $("#max").val(ui.values[1]);
                    // Call the onchange event and submit the form
                    clearTimeout(submitTimeout);

                    // Set a new timeout to submit the form after 500 milliseconds
                    submitTimeout = setTimeout(function() {
                        document.getElementById('filter_form').submit();
                    }, 500);
                }

            });
        });
    </script>
@endsection

