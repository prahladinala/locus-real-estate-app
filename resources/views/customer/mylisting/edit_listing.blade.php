@extends('customer.index')
@section('customerRightPanel')

    <style>
        .video-promo {
            position: relative;
        }

        .video-promo .apnd-img {
            max-width: 120px;
            max-height: 100px;
        }

        .video-promo .pre-delete-image {
            position: absolute;
            right: -4px;
            top: -5px;
            color: red;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            font-size: 13px;
            border: none;
        }

        .eNav-Tabs-custom {
            gap: 40px;
        }

        model-viewer {
            width: 100% !important;
            height: 300px !important;
        }

        .new_label {
            border: 1px solid #007BFF;
            width: 100%;
            text-align: center;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .h-200px{
            height: 200px;
        }
        .cursor-pointer{
            cursor: pointer;
        }
        .og_image img {
            height: 48px;
            object-fit: cover;
            width: 95px;
            border-radius: 5px 5px 0 0;
        }
    </style>

    <!-- Right Side -->
    <div class="col-lg-9">
        <div class="dl_column_content d-flex flex-column rg-30">
            <!-- My Listings Tabs -->
            <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap g-12 mb-16">
                    <div class="tableTitle-3">
                        <h4 class="fz-24-sb-black">{{ get_phrase('Edit Listing') }}</h4>
                    </div>
                    <div class="justify-content-end d-flex gap-3">
                        <a href="{{ route('showMyListings', $listing->listing_type_id) }}" class="frontend-btn cg-10"><i class="fa-solid fa-arrow-left"></i> {{ get_phrase('Go Back') }}</a>
                        <!-- Button -->
                        <a href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}" target="_blank"
                            class="back-listing cg-10">{{ get_phrase('View on frontend') }} <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- Tabs -->
                <div class="my_listings_tabs">
                    <ul class="nav nav-tabs eNav-Tabs-custom" id="myTab" role="tablist">
                        <!-- Basic -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="cBasic-tab" data-bs-toggle="tab" data-bs-target="#cBasic" type="button" role="tab" aria-controls="cBasic"
                                aria-selected="true">
                                {{ get_phrase('Basic') }}
                                <span></span>
                            </button>
                        </li>

                        <!-- Features -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cFeatures-tab" data-bs-toggle="tab" data-bs-target="#cFeatures" type="button" role="tab" aria-controls="cFeatures"
                                aria-selected="false">
                                {{ get_phrase('Features') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- SEO -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cSEO-tab" data-bs-toggle="tab" data-bs-target="#cSEO" type="button" role="tab" aria-controls="cSEO"
                                aria-selected="false">
                                {{ get_phrase('SEO') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- Address -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cAddress-tab" data-bs-toggle="tab" data-bs-target="#cAddress" type="button" role="tab" aria-controls="cAddress"
                                aria-selected="false">
                                {{ get_phrase('Address') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- Media -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cMedia-tab" data-bs-toggle="tab" data-bs-target="#cMedia" type="button" role="tab" aria-controls="cMedia"
                                aria-selected="false">
                                {{ get_phrase('Media') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- Nearby -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cNearby-tab" data-bs-toggle="tab" data-bs-target="#cNearby" type="button" role="tab" aria-controls="cNearby"
                                aria-selected="false">
                                {{ get_phrase('Nearby') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- Model -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cModel-tab" data-bs-toggle="tab" data-bs-target="#cModel" type="button" role="tab" aria-controls="cModel"
                                aria-selected="false">
                                {{ get_phrase('3d Model') }}
                                <span></span>
                            </button>
                        </li>
                        <!-- Model -->
                    </ul>
                    <div class="tab-content eNav-Tabs-content" id="myTabContent">
                        <!-- Basic -->
                        <div class="tab-pane fade show active" id="cBasic" role="tabpanel" aria-labelledby="cBasic-tab">
                            <form class="basic-form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'basic']) }}" method="post">
                                @csrf
                                <div class="dl_column_form d-flex flex-column rg-22">
                                    <!-- Title -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="title" name="title" v class="col-sm-2 col-eForm-label">{{ get_phrase('Property Title') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Your title" class="form-control eForm-control2" id="title" name="title"
                                                value="{{ $listing->title }}" required />
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-2 col-eForm-label">{{ get_phrase('Property Type') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <select class="form-select eForm-select eChoice-multiple-without-remove" name="category" data-placeholder="Type to search..." required>

                                                @foreach ($all_categories as $category)
                                                    <option value="{{ $category->id }}" @if ($listing->listing_arrtibute_type_id == $category->id) selected @endif>{{ $category->type }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <!-- Property Type -->
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-2 col-eForm-label">{{ get_phrase('Property Status') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <div class="dl-gender-wrap d-inline-flex justify-content-between">
                                                <div class="gender-item">
                                                    <div class="form-check">
                                                        <input type="radio" name="type" class="form-check-input dl-radio" id="rent" value='rent' required
                                                            @if ($listing->type == 'rent') checked @endif /><label for="rent"
                                                            class="form-check-label">{{ get_phrase('Rent') }}</label>
                                                    </div>
                                                </div>
                                                <div class="gender-item">
                                                    <div class="form-check">
                                                        <input type="radio" name="type" class="form-check-input dl-radio" id="sell" value='sell' required
                                                            @if ($listing->type == 'sell') checked @endif /><label for="sell"
                                                            class="form-check-label">{{ get_phrase('Sell') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <div class="row justify-content-between align-items-start">
                                        <label for="description" class="col-sm-2 col-eForm-label">{{ get_phrase('Description') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <textarea class="form-control eForm-control2" id="description" name="description" placeholder="Type your keyword"> {{ $listing->short_description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="row justify-content-between align-items-center">
                                        <label for="year_build_in" class="col-sm-2 col-eForm-label">{{ get_phrase('Build In*') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Write the year. Ex: 2007" class="form-control eForm-control2" id="year_build_in"
                                                name="year_build_in" value="{{ $listing->year_build_in }}" required />
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label for="size" class="col-sm-2 col-eForm-label">{{ get_phrase('Size*') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Write a size in sqft" class="form-control eForm-control2" id="size" name="size"
                                                value="{{ $listing->area }}" required />
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label for="bedroom" class="col-sm-2 col-eForm-label">{{ get_phrase('Bedroom*') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="bedroom"
                                                name="bedroom" value="{{ $listing->bedroom }}" required />
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label for="bathroom" class="col-sm-2 col-eForm-label">{{ get_phrase('Bathroom*') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="bathroom"
                                                name="bathroom" value="{{ $listing->bathroom }}" required />
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label for="garage" class="col-sm-2 col-eForm-label">{{ get_phrase('Garage*') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="garage"
                                                name="garage" value="{{ $listing->garage }}" required />
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="price" class="col-sm-2 col-eForm-label">{{ get_phrase('Price') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="$50,000" class="form-control eForm-control2 w-115" id="price" name="price" required
                                                value="{{ $listing->price }}" />
                                        </div>
                                    </div>
                                    <!-- Visibility -->
                                    <div class="row justify-content-between align-items-center">
                                        <label  class="col-sm-2 col-eForm-label">{{ get_phrase('Visibility') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <div class="dl-gender-wrap d-inline-flex justify-content-between">
                                                <div class="gender-item">
                                                    <div class="form-check">
                                                        <input type="radio" name="status" class="form-check-input dl-radio" id="hidden" name="status" required
                                                            value="0" @if ($listing->status == '0') checked @endif /><label for="hidden"
                                                            class="form-check-label">{{ get_phrase('Hidden') }}</label>
                                                    </div>
                                                </div>
                                                <div class="gender-item">
                                                    <div class="form-check">
                                                        <input type="radio" name="status" class="form-check-input dl-radio" id="visible" name="status" required
                                                            value="1" @if ($listing->status == '1') checked @endif /><label for="visible"
                                                            class="form-check-label">{{ get_phrase('Visible') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                                    <button type="button" onclick="checkBasicForm()" class="eBtn saveChanges-btn">{{ get_phrase('Save Basic') }}</button>
                                </div>
                            </form>
                        </div>

                        <!-- Features -->
                        <div class="tab-pane fade" id="cFeatures" role="tabpanel" aria-labelledby="cFeatures-tab">

                            <form class="features-form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'features']) }}" method="post">
                                @csrf
                                <div class="my_listing_features">
                                    <p class="fz-16-m-gray pb-20">{{ get_phrase('Selected Features') }}</p>
                                    <ul class="my_listing_fLists d-flex flex-wrap g-15">

                                        @forelse ($all_amenities as $aminity)
                                            <li class="fLists_item" for="{{ $aminity->id }}">
                                                <div class="checkMark">
                                                    <input class="form-check-input" type="checkbox" @if (in_array($aminity->id, $active_amenities)) @checked(true) @endif name="features[]"
                                                        id="{{ $aminity->id }}" value=" {{ $aminity->id }} " />
                                                </div>
                                                <div class="iconText">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-{{ $aminity->type }}"></i>
                                                    </div>
                                                    <span class="text">{{ $aminity->type }}</span>
                                                </div>
                                            </li>

                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                                <br>
                                <button type="submit" class="eBtn saveChanges-btn float-end">{{ get_phrase('Save Features') }}</button>
                            </form>

                        </div>
                        <!-- SEO -->
                        <div class="tab-pane fade" id="cSEO" role="tabpanel" aria-labelledby="cSEO-tab">
                            <!-- Form -->
                            <form class="form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'tag']) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="dl_column_form d-flex flex-column rg-22">
                                    <!-- Meta Keywords -->
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Meta Title') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control eForm-control2" id="meta_title" name="meta_title" placeholder="Type your meta title"
                                                value="{{ $listing->meta_title }}" />
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Meta Keywords') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control eForm-control2" id="meta_keywords" name="meta_keywords" placeholder="Type your meta keywords" value="{{ $listing->meta_keywords }}" />
                                        </div>
                                    </div>
                                    <!-- Meta Description -->
                                    <div class="row justify-content-between align-items-start">
                                        <label  class="col-sm-3 col-eForm-label">{{ get_phrase('Meta Description') }}</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control eForm-control2" id="meta_description" name="meta_description" placeholder="Type your keyword">{{ $listing->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Og Title') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control eForm-control2" id="meta_keywords" name="og_title"  value="{{ $listing->og_title }}" />
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase(' Canonical Url') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control eForm-control2" id="meta_keywords" name="canonical"  value="{{ $listing->canonical }}" placeholder="https://example.com/dresses/cocktail?gclid=ABCD." />
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Og Description') }}</label>
                                        <div class="col-sm-9">
                                            <Textarea class="form-control  eForm-control2" id="og_description" name="og_description">{{$listing->og_description}}</Textarea>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Og Image') }}</label>
                                        <div class="col-sm-9">
                                            <div class="og_image">
                                                @if($listing->og_image)
                                                <img src="{{ asset('public/uploads/seo/'.$listing->og_image) }}" alt="....">
                                                @else
                                                <img src="{{ asset('public/uploads/blog/placeholder.jpg') }}" alt="...">
                                                @endif
                                             </div>
                                            <input type="file" class="form-control eForm-control h-auto" id = "og_image" name="og_image"/>
                                            <input type="hidden" class="form-control eForm-control" id = "og_image" name="old_og_image" value="{{$listing->og_image}}"/>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <label class="col-sm-3 col-eForm-label">{{ get_phrase('Json ld') }}</label>
                                        <div class="col-sm-9">
                                            <Textarea class="form-control eForm-control2" id="json_ld" name="json_ld" placeholder='<script src="https://cdn.jsdelivr.net/npm/json ld"></script>'></Textarea>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                                        <button type="submit" class="eBtn saveChanges-btn float-end">{{ get_phrase('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Address -->
                        <div class="tab-pane fade" id="cAddress" role="tabpanel" aria-labelledby="cAddress-tab">
                            <!-- Form -->

                            <form class="address-form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'address']) }}" method="post">
                                @csrf
                                <div class="dl_column_form d-flex flex-column rg-22">
                                    <!-- Country -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="countries" class="col-sm-2 col-eForm-label">Country</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <select id="countries" name="country_id" class="form-select eForm-select eChoice-multiple-without-remove"
                                                data-placeholder="Type to search..." required onchange="countryWiseState(this.value)">

                                                <option value="NN">
                                                    {{ get_phrase('Select a Country') }}
                                                </option>

                                                @foreach ($countries as $key => $country)
                                                    <option value="{{ $country->code }}" @if ($country->id == $listing->country_id) selected @endif>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="row justify-content-between align-items-center">
                                        <label for="state" class="col-sm-2 col-eForm-label">{{ get_phrase('State') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <select id="state" name="state_id" class="form-select eForm-select eChoice-multiple-without-remove" required
                                                data-placeholder="Type to search...">



                                                <option value="{{ $listing->state_id }}" selected>
                                                    {{ $listing->listing_to_state->title }}
                                                </option>



                                            </select>
                                        </div>
                                    </div>

                                    <div class="row justify-content-between align-items-center">
                                        <label for="city" class="col-sm-2 col-eForm-label">{{ get_phrase('City') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <select id="city" name="city_id" class="form-select eForm-select eChoice-multiple-without-remove" required
                                                data-placeholder="Type to search...">

                                                <option value="{{ $listing->city_id }}" selected>
                                                    {{ $listing->listing_to_city->title }}
                                                </option>


                                            </select>
                                        </div>
                                    </div>
                                    <!-- Area -->
                                    @php $address = explode(",",$listing->address); @endphp
                                    <div class="row justify-content-between align-items-center">
                                        <label for="area" class="col-sm-2 col-eForm-label">{{ get_phrase('Area') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Write a Area" class="form-control eForm-control2" id="area" name="area"
                                                value="{{ $address[1] }}" />
                                        </div>
                                    </div>
                                    <!-- Address -->
                                    <div class="row justify-content-between align-items-start">
                                        <label for="address" class="col-sm-2 col-eForm-label">{{ get_phrase('Address') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <textarea class="form-control eForm-control2" id="address" name="address" placeholder="Type your keyword">{{ $address[0] }}</textarea>
                                        </div>
                                    </div>
                                    <!-- Postal Code -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="postal" class="col-sm-2 col-eForm-label">{{ get_phrase('Postal Code') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Write postal code" class="form-control eForm-control2" id="postal" name="postalcode"
                                                value="{{ $address[2] }} " />
                                        </div>
                                    </div>
                                    <!-- Latitude -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="latitude" class="col-sm-2 col-eForm-label">{{ get_phrase('Latitude') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Provide latitude" class="form-control eForm-control2" id="latitude" name="latitude"
                                                value="{{ $listing->latitude }}" />
                                        </div>
                                    </div>
                                    <!-- Longitude -->
                                    <div class="row justify-content-between align-items-center">
                                        <label for="longitude" class="col-sm-2 col-eForm-label">{{ get_phrase('Longitude') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <input type="text" placeholder="Provide longitude" class="form-control eForm-control2" id="longitude" name="longitude"
                                                value="{{ $listing->longitude }}" />
                                        </div>
                                    </div>
                                    <!-- Select Location -->
                                    <div class="row justify-content-between align-items-start">
                                        <label class="col-sm-2 pe-0 col-eForm-label">{{ get_phrase('Select Location') }}</label>
                                        <div class="col-sm-10 col-md-9 col-lg-10">
                                            <div class="contact-map">
                                                <div class="map-area">
                                                    <div class="map-frame">
                                                        <link rel="stylesheet" href="{{ asset('public/assets/customer/css/leaflet.css') }}" crossorigin="" />
                                                        <script src="{{ asset('public/assets/customer/js/leaflet.js') }}" crossorigin=""></script>
                                                        <div id="map" class="h-200px cursor-pointer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                                    <button type="button" onclick="checkAddressForm()" class="eBtn saveChanges-btn">{{ get_phrase('Save Address') }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- Media -->

                        <div class="tab-pane fade" id="cMedia" role="tabpanel" aria-labelledby="cMedia-tab">

                            <form class="media-form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'media']) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                @php $gallery_image= json_decode($listing->gallery,true) @endphp
                                @if (!empty($gallery_image) && count($gallery_image) > 0)
                                    <div class="row justify-content-between">
                                        <div class="col-sm-2 pe-0">
                                            <p class="col-eForm-label media-pt-28">
                                                {{ get_phrase('Property Photo') }}
                                            </p>
                                        </div>
                                        <div class="col-sm-10">
                                            <ul class="previous-media">


                                                @foreach ($gallery_image as $img)
                                                    <li class="uploaded-image">
                                                        <img id="{{ $img }}" src="{{ asset('public/uploads/real_estate/galleryImages/' . $img) }}" alt="" />
                                                        <button class="pre-delete-image" onclick="deletephoto('<?= $img . '_uploaded' ?>')"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                        <input type="hidden" id="{{ $img . ' _uploaded' }}" name="uploadedproperty[]" value="{{ $img }}">
                                                    </li>
                                                @endforeach



                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="row justify-content-between">
                                    <div class="col-sm-2 pe-0">
                                        <p class="col-eForm-label media-pt-28">
                                            {{ get_phrase('Upload Photo') }}
                                        </p>
                                    </div>

                                    <div class="col-sm-10">
                                        <div class="dl-photoUploader">
                                            <div class="input-images-property-and-videos"></div>
                                        </div>
                                    </div>

                                    @php $additional_gallery= json_decode($listing->additional_gallery,true) @endphp
                                    @if (!empty($additional_gallery) && count($additional_gallery) > 0)
                                        <div class="row justify-content-between">
                                            <div class="col-sm-2 pe-0">
                                                <p class="col-eForm-label media-pt-28">
                                                    {{ get_phrase('Floor Photo') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-10">
                                                <ul class="previous-media">
                                                    @foreach ($additional_gallery as $img)
                                                        <li class="uploaded-image">
                                                            <img id="{{ $img }}" src="{{ asset('public/uploads/real_estate/additionalGallery/' . $img) }}" alt="" />
                                                            <button class="pre-delete-image" onclick="deletephoto('<?= $img . '_upload' ?>')"><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </li>
                                                        <input type="hidden" id="{{ $img . '_upload' }}" name="uploadedfloor[]" value="{{ $img }}">
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-sm-2 pe-0">
                                        <p class="col-eForm-label media-pt-28">
                                            {{ get_phrase('Floor design') }}
                                        </p>
                                    </div>

                                    <div class="col-sm-10">
                                        <div class="dl-photoUploader">
                                            <div class="input-images-and-videos"></div>
                                        </div>
                                    </div>
                                    <ul class="video_test d-flex mb-3">
                                        <li class="file">
                                            <div class="form-check">
                                                <input class="form-check-input me-1" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                                    @if (!empty($listing->promo_video) && strpos($listing->promo_video, 'https') !== false) checked @endif>
                                                <label class="form-check-label me-3" for="flexRadioDefault2">
                                                    {{ get_phrase('Choose video link') }}
                                                </label>
                                            </div>
                                        </li>
                                        <li>{{ get_phrase('---OR---') }}</li>
                                        <li class="link">
                                            <div class="form-check">
                                                <input class="form-check-input me-1" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                                                    @if (!empty($listing->promo_video) && strpos($listing->promo_video, 'promo_video') !== false) checked @endif>
                                                <label class="form-check-label me-3" for="flexRadioDefault1">
                                                    {{ get_phrase('Choose video file') }}
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class=" video_file">
                                        <div class="row justify-content-between">
                                            <div class="col-sm-2 pt-10">
                                                <label for="singleVideoLink" class="col-eForm-label">{{ get_phrase('Video Link') }}</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="oneVideo-link">

                                                    @if (!empty($listing->promo_video) && strpos($listing->promo_video, 'https') !== false)
                                                        <input type="text" id="singleVideoLink" name="singleVideoLink" class="form-control eForm-control2"
                                                            value="{{ $listing->promo_video }}" placeholder="https://youtube.com" />
                                                    @else
                                                        <input type="text" id="singleVideoLink" name="singleVideoLink" class="form-control eForm-control2"
                                                            placeholder="https://youtube.com" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $listing->promo_video }}" name="video-hide">
                                    <div class="video_link">
                                        @if (!empty($listing->promo_video) && strpos($listing->promo_video, 'promo_video') !== false)
                                            <div class="row justify-content-between">
                                                <div class="col-sm-2 pe-0">
                                                    <p class="col-eForm-label media-pt-28">
                                                        {{ get_phrase('Promo Video') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="previous-media video-promo">

                                                        <div class="apnd-img" id="{{ $listing->promo_video . '_upload_vdo' }}">
                                                            <video autoplay="" muted="" src="{{ asset('public/uploads/real_estate/video/' . $listing->promo_video) }}"
                                                                id="{{ $listing->promo_video . '_upload_vdo' }}"></video>
                                                            <button class="pre-delete-image" type="button" onclick="deletevideo('<?= $listing->promo_video . '_upload_vdo' ?>')"><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                            <input type="hidden" name="uploadedvideo[]" value="{{ $listing->promo_video }}">
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                        <div class=" row justify-content-between">
                                            <div class="col-sm-2">
                                                <p class="col-eForm-label media-pt-28">
                                                    {{ get_phrase('Video Upload') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="oneVideo-wrap">
                                                    <a class="vid" href="javascript:void(0)">
                                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                                        <p class="info">
                                                            {{ get_phrase('Click to upload or drag and drop') }} SVG, PNG, JPG
                                                            or GIF (max. 500 x 700px)
                                                        </p>
                                                    </a>
                                                    <div class="gallery"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Button -->
                                    <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                                        <button type="submit" class="eBtn sav   eChanges-btn float-end">{{ get_phrase('Save') }}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Nearby -->
                        <!-- Nearby -->
                        <div class="tab-pane fade" id="cNearby" role="tabpanel" aria-labelledby="cNearby-tab">
                            <!-- Title -->
                            <div class="d-flex justify-content-between align-items-center flex-wrap g-12 bd-b-1 pb-30">
                                <div class="tableTitle-3">
                                    <h4 class="fz-18-m-black">{{ get_phrase('Nearby Location') }}</h4>
                                </div>
                                <!-- Button -->
                                <a href="javascript:;" class="add-listing cg-10"
                                    onclick="nearbyLocationAddModal('{{ route('addNearByLocation', ['listing_id' => $listing->id]) }}')"><i class="fa-solid fa-plus"></i>
                                    {{ get_phrase('Add Nearby Location') }}</a>
                            </div>
                            <!-- Tabs -->
                            <ul class="nav nav-tabs eNav-Tabs-custom justify-content-between nearby-tab" id="myTab" role="tablist">
                                <!-- School -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="cSchool-tab" data-bs-toggle="tab" data-bs-target="#cSchool" type="button" role="tab"
                                        aria-controls="cSchool" aria-selected="true">
                                        {{ ucfirst($nearby_loc[0]) . ' ( ' . $school_count . ' )' }}
                                        <span></span>
                                    </button>
                                </li>
                                <!-- Hospital -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cHospital-tab" data-bs-toggle="tab" data-bs-target="#cHospital" type="button" role="tab"
                                        aria-controls="cHospital" aria-selected="false">
                                        {{ ucfirst($nearby_loc[1]) . ' ( ' . $hospital_count . ' )' }}
                                        <span></span>
                                    </button>
                                </li>
                                <!-- Shopping Center -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cShoppingCenter-tab" data-bs-toggle="tab" data-bs-target="#cShoppingCenter" type="button" role="tab"
                                        aria-controls="cShoppingCenter" aria-selected="false">
                                        {{ ucfirst($nearby_loc[2]) . ' ( ' . $shoppingcenter_count . ' )' }}
                                        <span></span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content eNav-Tabs-content" id="myTabContent">
                                <!-- School -->
                                <div class="tab-pane fade show active" id="cSchool" role="tabpanel" aria-labelledby="cSchool-tab">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table class="table eTable eTable-2 table-icon table-p0">
                                            <tbody>

                                                @forelse ($listing->get_location_by_nearby_id($listing->id,0) as $school)
                                                    <tr>
                                                        <td>
                                                            <div class="dl_property_type d-flex flex-column g-8">
                                                                <p class="fz-18-m-black">
                                                                    {{ $school->name }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tableIcons d-flex justify-content-end flex-wrap g-8">
                                                                <div class="tRemoveIcon table-edit"
                                                                    onclick="nearbyLocationEditModal('{{ route('editNearByLocation', ['id' => $school->id]) }}')">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                        <i class="fa-solid fa-edit"></i></span>
                                                                </div>
                                                                <div class="tRemoveIcon table-delete"
                                                                    onclick="confirmModal('{{ route('deleteNearByLocation', ['id' => $school->id]) }}', 'undefined');">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fa-solid fa-trash-can"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                @endforelse


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Hospital -->
                                <div class="tab-pane fade" id="cHospital" role="tabpanel" aria-labelledby="cHospital-tab">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table class="table eTable eTable-2 table-icon table-p0">
                                            <tbody>
                                                @forelse ($listing->get_location_by_nearby_id($listing->id,1) as $hospital)
                                                    <tr>
                                                        <td>
                                                            <div class="dl_property_type d-flex flex-column g-8">
                                                                <p class="fz-18-m-black">
                                                                    {{ $hospital->name }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tableIcons d-flex justify-content-end flex-wrap g-8">
                                                                <div class="tRemoveIcon table-edit"
                                                                    onclick="nearbyLocationEditModal('{{ route('editNearByLocation', ['id' => $hospital->id]) }}')">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                        <i class="fa-solid fa-edit"></i></span>
                                                                </div>
                                                                <div class="tRemoveIcon table-delete"
                                                                    onclick="confirmModal('{{ route('deleteNearByLocation', ['id' => $hospital->id]) }}', 'undefined');">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fa-solid fa-trash-can"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Shopping Center -->
                                <div class="tab-pane fade" id="cShoppingCenter" role="tabpanel" aria-labelledby="cShoppingCenter-tab">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table class="table eTable eTable-2 table-icon table-p0">
                                            <tbody>
                                                @forelse ($listing->get_location_by_nearby_id($listing->id,2) as $mall)
                                                    <tr>
                                                        <td>
                                                            <div class="dl_property_type d-flex flex-column g-8">
                                                                <p class="fz-18-m-black">
                                                                    {{ $mall->name }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tableIcons d-flex justify-content-end flex-wrap g-8">
                                                                <div class="tRemoveIcon table-edit"
                                                                    onclick="nearbyLocationEditModal('{{ route('editNearByLocation', ['id' => $mall->id]) }}')">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                        <i class="fa-solid fa-edit"></i></span>
                                                                </div>
                                                                <div class="tRemoveIcon table-delete"
                                                                    onclick="confirmModal('{{ route('deleteNearByLocation', ['id' => $mall->id]) }}', 'undefined');">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fa-solid fa-trash-can"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Park -->
                                <div class="tab-pane fade" id="cPark" role="tabpanel" aria-labelledby="cPark-tab">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table class="table eTable eTable-2 table-icon table-p0">
                                            <tbody>
                                                @forelse ($listing->get_location_by_nearby_id($listing->id,3) as $park)
                                                    <tr>
                                                        <td>
                                                            <div class="dl_property_type d-flex flex-column g-8">
                                                                <p class="fz-18-m-black">
                                                                    {{ $park->name }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tableIcons d-flex justify-content-end flex-wrap g-8">
                                                                <div class="tRemoveIcon table-edit"
                                                                    onclick="nearbyLocationEditModal('{{ route('editNearByLocation', ['id' => $park->id]) }}')">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                        <i class="fa-solid fa-edit"></i></span>
                                                                </div>
                                                                <div class="tRemoveIcon table-delete"
                                                                    onclick="confirmModal('{{ route('deleteNearByLocation', ['id' => $park->id]) }}', 'undefined');">
                                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                        <i class="fa-solid fa-trash-can"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 3d Model  -->
                        <div class="tab-pane fade" id="cModel" role="tabpanel" aria-labelledby="cModel-tab">
                            <form class="media-form" action="{{ route('updateRealEstateListing', ['id' => $listing->id, 'form' => 'model']) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-between">
                                    <div class="col-sm-3 pe-0">
                                        <p class="col-eForm-label media-pt-28">
                                            {{ get_phrase('Upload 3D Model:') }}
                                        </p>
                                    </div>

                                    <div class="col-sm-9">
                                        <div class="3d-view w-100">
                                            <script type="module" src="{{ asset('public/assets/customer/js/model-viewer.min.js') }}"></script>
                                            <model-viewer alt="Neil Armstrong's Spacesuit from the Smithsonian Digitization Programs Office and National Air and Space Museum"
                                                src="{{ asset('public/assets/uploads/3d/' . $listing->model) }}" shadow-intensity="1" ar camera-controls
                                                touch-action="pan-y"></model-viewer>
                                        </div>
                                        <div class="dl-photoUploaders mt-3">
                                            <input type="file" class="eForm-laebl d-none" name="model" id="model">
                                            <input type="hidden" class="eForm-laebl" id="model" name="old_model" value="{{ $listing->model }}">

                                            <label for="model" class="eForm-laebl new_label">{{ get_phrase('Upload A 3D Model') }}</label>
                                        </div>
                                        <button type="submit" class=" mt-3 eBtn saveChanges-btn float-end">{{ get_phrase('save') }}</button>
                                    </div>

                            </form>

                        </div>
                        <!-- 3d Model  -->
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
    </div>


    </div>


@endsection

@section('customerjs')
    <script>
        // Function to show the file upload input and hide the video link input
        $('document').ready(function() {
            $(".file").on('click', function() {
                $(".video_file").removeClass("hide");
                $(".video_link").addClass("hide");
            });

            $(".link").on('click', function() {
                $(".video_file").addClass("hide");
                $(".video_link").removeClass("hide");
                $(".video_link").addClass("show");
            });
        });
    </script>

    <Script>
        "use strict";

        $(document).ready(function() {

            var country = '{{ $listing->country_id }}';

        });

        $(document).ready(function() {
            $('#description').summernote({
                height: 330,
            });
        });


        function countryWiseState(countryid) {



            let url = "{{ route('countryWiseState', ['id' => ':countryid']) }}";
            url = url.replace(":countryid", countryid);
            $.ajax({
                url: url,
                success: function(response) {
                    $('#state').html(response);
                    console.log(response);
                    stateWiseCity(countryid);
                }
            });
        }

        function stateWiseCity(countryid) {

            let url = "{{ route('stateWiseCity', ['id' => ':countryid']) }}";
            url = url.replace(":countryid", countryid);
            $.ajax({
                url: url,
                success: function(response) {
                    $('#city').html(response);
                }
            });
        }


        function checkBasicForm() {
            var pass = 1;
            $('form.basic-form').find('input, select, radio').each(function() {
                if ($(this).prop('required')) {
                    if ($(this).val() === "") {
                        pass = 0;
                    }
                }
            });

            if (pass === 1) {
                $('form.basic-form').submit();
            } else {
                alert('please_fill_all_the_required_fields');
            }
        }

        function checkPropertyForm() {
            var pass = 1;
            $('form.propertydetails-form').find('input, select, radio').each(function() {
                if ($(this).prop('required')) {
                    if ($(this).val() === "") {
                        pass = 0;
                    }
                }
            });

            if (pass === 1) {
                $('form.propertydetails-form').submit();
            } else {
                alert('please_fill_all_the_required_fields');
            }
        }

        function checkAddressForm() {
            var pass = 1;
            $('form.address-form').find('input, select, radio').each(function() {
                if ($(this).prop('required')) {
                    if ($(this).val() === "") {
                        pass = 0;
                    }
                }
            });

            if (pass === 1) {
                $('form.address-form').submit();
            } else {
                alert('please_fill_all_the_required_fields');
            }
        }

        // Select2 js
        $(document).ready(function() {
            $(".eChoice-multiple-without-remove").select2({
                placeholder: "Select a state",
            });
        });
        $(document).ready(function() {
            $(".eChoice-multiple-with-remove").select2();
        });

        //multiple file upload plugin initialize only for images
        $(".input-images:not(.initialized)").imageUploader({
            imagesInputName: "floor_files",
            extensions: [".jpg", ".jpeg", ".png", ".gif", ".svg"],
            mimes: ["image/jpeg", "image/png", "image/gif", "image/svg+xml"],
            label: "Drag & Drop files here or click to browse",
        });
        //multiple file upload plugin initialize for images and videos
        $(".input-images-and-videos:not(.initialized)").imageUploader({
            imagesInputName: "floor_files",
            extensions: [
                ".jpg",
                ".jpeg",
                ".png",
                ".gif",
                ".svg",
                ".mp4",
            ],
            mimes: [
                "image/jpeg",
                "image/png",
                "image/gif",
                "image/svg+xml",
                "video/*",
            ],
            label: "Click to upload or drag and drop SVG, PNG, JPG or GIF ( max. 500 x 700px)",
        });


        //multiple file upload plugin initialize only for images
        $(".input-images-property:not(.initialized)").imageUploader({
            imagesInputName: "property_files",
            extensions: [".jpg", ".jpeg", ".png", ".gif", ".svg"],
            mimes: ["image/jpeg", "image/png", "image/gif", "image/svg+xml"],
            label: "Drag & Drop files here or click to browse",
        });
        //multiple file upload plugin initialize for images and videos
        $(".input-images-property-and-videos:not(.initialized)").imageUploader({
            imagesInputName: "property_files",
            extensions: [
                ".jpg",
                ".jpeg",
                ".png",
                ".gif",
                ".svg",
            ],
            mimes: [
                "image/jpeg",
                "image/png",
                "image/gif",
                "image/svg+xml",
                "video/*",
            ],
            label: "Click to upload or drag and drop SVG, PNG, JPG or GIF ( max. 500 x 700px)",
        });

        // For country
        function format(item, state) {
            if (!item.id) {
                return item.text;
            }
            var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
            var stateUrl = "https://oxguy3.github.io/flags/svg/us/";
            var url = state ? stateUrl : countryUrl;
            var img = $("<img>", {
                class: "img-flag",
                width: 26,
                src: url + item.element.value.toLowerCase() + ".svg",
            });
            var span = $("<span>", {
                text: " " + item.text,
            });
            span.prepend(img);
            return span;
        }

        $(document).ready(function() {
            $("#countries").select2({
                templateResult: function(item) {
                    return format(item, false);
                },
            });
            $("#us-states").select2({
                templateResult: function(item) {
                    return format(item, true);
                },
            });
        });

        $("ul.previous-media li button.pre-delete-image").on('click', function() {
            $(this).parent().remove();
        });

        function deletephoto(id) {
            document.getElementById(id).remove();
        }

        function deletevideo(id) {
            document.getElementById(id).remove();
        }

        $("input[name=files]").prop("multiple", false);
        $(
            ".dl-photoUploader .input-images-and-videos .image-uploader input"
        ).prop("multiple", false);

        $(".gallery").miv({
            image: ".cam",
            video: ".vid"
        });
    </Script>

    <script type="text/javascript">
        "use strict";

        <?php if(get_settings("active_map") == 'openstreetmap'): ?>
        //free map
        var map = L.map('map').setView(["{{ $listing->latitude }}", "{{ $listing->longitude }}"], 13);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?= get_settings('system_title') ?></a>',
            gestureHandling: true
        }).addTo(map);
        <?php else: ?>
        //paid maps
        var map = L.map('map').setView(["{{ $listing->latitude }}", "{{ $listing->longitude }}"], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?= get_settings('system_title') ?></a>',
            id: 'mapbox/streets-v11',
            accessToken: '<?= get_settings('map_access_token') ?>',
            gestureHandling: true
        }).addTo(map);
        <?php endif; ?>


        L.marker(["{{ $listing->latitude }}", "{{ $listing->longitude }}"]).addTo(map).openPopup();

        var popup = L.popup();
        map.on('click', onMapClick);

        function onMapClick(e) {
            popup.setLatLng(e.latlng).setContent("{{ get_phrase('Your selected') }} " + e.latlng.toString()).openOn(map);

            var lat_lan_string = e.latlng.toString();
            var lat_lan_string_arr = lat_lan_string.split(", ");
            var lat_string_arr = lat_lan_string_arr[0].split('LatLng(');
            var lan_string_arr = lat_lan_string_arr[1].split(')');
            var lat = lat_string_arr[1];
            var lan = lan_string_arr[0];
            $('#latitude').val(lat);
            $('#longitude').val(lan);
        }

        function set_previous_lat_lan() {
            if ($('.leaflet-pane.leaflet-popup-pane').html() === "") {
                $('#latitude').val("{{ $listing->latitude }}");
                $('#longitude').val("{{ $listing->longitude }}");
            }
        }
    </script>


<script src="{{ asset('public/assets/customer/js/gmaps.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>

@endsection
