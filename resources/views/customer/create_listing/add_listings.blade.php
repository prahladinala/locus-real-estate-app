@extends('customer.index')
@section('customerRightPanel')
<style>
    .h-200px{
        height: 200px;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>

<div class="col-lg-9">
    <div class="dl_column_content d-flex flex-column rg-30">
        <!-- My Listings Tabs -->
        <div class="dl_column_item pt-22 px-30 pb-30 boxShadow-06 bg-white">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center flex-wrap g-12 mb-16">
                <div class="tableTitle-3">
                    <h4 class="fz-24-sb-black">{{ get_phrase('Add Listing') }}</h4>
                </div>
                <!-- Button -->
                <a href="{{ route('showMyListings',$listings_type->id) }}" class="back-listing cg-10"><i class="fa-solid fa-arrow-left"></i> {{ get_phrase('Back to listing') }}</a>
            </div>
            <!-- Tabs -->


            <!-- Basic -->
            <form  class="required-form" action="{{ route('saveRealEstateListing') }}" method="post">
                @csrf
                <div class="dl_column_form d-flex flex-column rg-22">
                    <!-- Title -->
                    <div class="row justify-content-between align-items-center">
                        <label for="inputTitle" class="col-sm-2 col-eForm-label">{{ get_phrase('Property Title*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Property title"  name="title" class="form-control eForm-control2" id="inputTitle" required/>
                        </div>
                    </div>

                    <input type="hidden" id="listing_type_id"    name="listing_type_id"  value="{{ $listings_type->id }}" >

                    <!-- Category -->
                    <div class="row justify-content-between align-items-center">
                        <label class="col-sm-2 col-eForm-label">{{ get_phrase('Property Type*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <select class="form-select eForm-select eChoice-multiple-without-remove" name="category" data-placeholder="Type to search..." required>
                                <option value="">{{get_phrase('Select Property type')}}</option>
                                @foreach ( $categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->type }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <!-- Property Type -->
                    <div class="row justify-content-between align-items-center">
                        <label class="col-sm-2 col-eForm-label">{{ get_phrase('Listing Type*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <div class="dl-gender-wrap d-inline-flex justify-content-between">
                                <div class="gender-item">
                                    <div class="form-check">
                                        <input type="radio" name="type" value="rent" class="form-check-input dl-radio" id="rent" checked required /><label for="rent" class="form-check-label">{{ get_phrase('Rent') }}</label>
                                    </div>
                                </div>
                                <div class="gender-item">
                                    <div class="form-check">
                                        <input type="radio" name="type" value="sell" class="form-check-input dl-radio" id="sell"  required/><label for="sell" class="form-check-label">{{ get_phrase('Sell') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Description -->
                    <div class="row justify-content-between align-items-start">
                        <label for="description" class="col-sm-2 col-eForm-label">{{ get_phrase('Description*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <textarea class="form-control eForm-control2" id="description" name="description"  placeholder="Type your keyword" required></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="year_build_in" class="col-sm-2 col-eForm-label">{{ get_phrase('Build In*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Write the year. Ex: 2007" class="form-control eForm-control2" id="year_build_in" name="year_build_in" required />
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="size" class="col-sm-2 col-eForm-label">{{ get_phrase('Size*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="number" placeholder="Write a size in sqft" class="form-control eForm-control2" id="size" name="size"  required />
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="bedroom" class="col-sm-2 col-eForm-label">{{ get_phrase('Bedroom*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="bedroom"  name="bedroom" required />
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="bathroom" class="col-sm-2 col-eForm-label">{{ get_phrase('Bathroom*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="bathroom" name="bathroom" required />
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="garage" class="col-sm-2 col-eForm-label">{{ get_phrase('Garage*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="number" placeholder="Provide the number" min="0" class="form-control eForm-control2" id="garage" name="garage"  required />
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row justify-content-between align-items-center">
                        <label for="price"  class="col-sm-2 col-eForm-label">{{ get_phrase('Price*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="number" class="form-control eForm-control2 w-115" id="price"  name="price"  required />
                        </div>
                    </div>
                    <!-- Visibility -->
                    <div class="row justify-content-between align-items-center">
                        <label class="col-sm-2 col-eForm-label">{{ get_phrase('Visibility') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <div class="dl-gender-wrap d-inline-flex justify-content-between">
                                <div class="gender-item">
                                    <div class="form-check">
                                        <input type="radio" name="status" value="0" class="form-check-input dl-radio"  id="hidden" checked required /><label for="hidden" class="form-check-label">{{ get_phrase('Hidden') }}</label>
                                    </div>
                                </div>
                                <div class="gender-item">
                                    <div class="form-check">
                                        <input type="radio" name="status" value="1" class="form-check-input dl-radio"  id="visible" required /><label for="visible" class="form-check-label">{{ get_phrase('Visible') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Address -->
               <br>
                <!-- Form -->
                <div class="dl_column_form d-flex flex-column rg-22">
                    <!-- Country -->
                    <div class="row justify-content-between align-items-center">
                        <label for="countries" class="col-sm-2 col-eForm-label">{{ get_phrase('Country*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <select id="countries" name="country_id" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search..."  onchange="countryWiseState(this.value)" required >

                                <option value="">
                                    {{ get_phrase('Select a Country') }}
                                </option>

                                @foreach($countries as $key => $country)

                                <option value="{{ $country->code }}">
                                    {{ $country->name }}
                                </option>

                                @endforeach

                            </select>
                        </div>
                    </div>



                    <div class="row justify-content-between align-items-center">
                        <label for="state" class="col-sm-2 col-eForm-label">{{ get_phrase('State*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <select id="state" name="state_id" class="form-select eForm-select eChoice-multiple-without-remove"  data-placeholder="Type to search..." required>

                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <label for="city" class="col-sm-2 col-eForm-label">{{ get_phrase('City*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <select id="city" name="city_id" class="form-select eForm-select eChoice-multiple-without-remove" data-placeholder="Type to search..." required>

                            </select>
                        </div>
                    </div>



                    <!-- Area -->
                    <div class="row justify-content-between align-items-center">
                        <label for="area" class="col-sm-2 col-eForm-label">{{ get_phrase('Area*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Write a area" class="form-control eForm-control2" id="area"  name="area"  required />
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="row justify-content-between align-items-start">
                        <label for="address" class="col-sm-2 col-eForm-label">{{ get_phrase('Address*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <textarea class="form-control eForm-control2" id="address" name="address" required value="address" placeholder="Type your Address" required ></textarea>
                        </div>
                    </div>
                    <!-- Postal Code -->
                    <div class="row justify-content-between align-items-center">
                        <label for="postalcode" class="col-sm-2 col-eForm-label">{{ get_phrase('Postal Code*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Write postal code" class="form-control eForm-control2" id="postalcode" name="postalcode" required />
                        </div>
                    </div>
                    <!-- Latitude -->
                    <div class="row justify-content-between align-items-center">
                        <label for="latitude" class="col-sm-2 col-eForm-label">{{ get_phrase('Latitude*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Provide latitude" class="form-control eForm-control2" id="latitude" name="latitude" required />
                        </div>
                    </div>
                    <!-- Longitude -->
                    <div class="row justify-content-between align-items-center">
                        <label for="longitude" class="col-sm-2 col-eForm-label">{{ get_phrase('Longitude*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <input type="text" placeholder="Provide longitude" class="form-control eForm-control2" id="longitude"  name="longitude" required />
                        </div>
                    </div>
                    <!-- Select Location -->
                    <div class="row justify-content-between align-items-start">
                        <label class="col-sm-2 pe-0 col-eForm-label">{{ get_phrase('Select Location*') }}</label>
                        <div class="col-sm-10 col-md-9 col-lg-10">
                            <div class="contact-map">
                                <div class="map-area">
                                    <div class="map-frame">
                                        <link rel="stylesheet" href="{{ asset('public/assets/customer/css/leaflet.css') }}" />
                                        <script src="{{ asset('public/assets/customer/js/leaflet.js') }}"></script>
                                        <div id="map" class="h-200px cursor-pointer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button -->
                <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
                    <button  type="button" onclick="checkRequiredFields()" class="eBtn saveChanges-btn">{{ get_phrase('Save Address') }}</button>
                </div>

            </form>




        </div>
    </div>
</div>


@endsection

@section('customerjs')
<script>

    "use strict";
    
    function countryWiseState(countryid) {



        let url = "{{ route('countryWiseState', ['id' => ":countryid"]) }}";
        url = url.replace(":countryid", countryid);
        $.ajax({
            url: url,
            success: function(response){
                $('#state').html(response);
                console.log(response);
                stateWiseCity(countryid);
            }
        });
    }

    function stateWiseCity(countryid) {

    let url = "{{ route('stateWiseCity', ['id' => ":countryid"]) }}";
    url = url.replace(":countryid", countryid);
    $.ajax({
        url: url,
        success: function(response){
            $('#city').html(response);
        }
    });
    }




</script>


<!-- map start -->
<script type="text/javascript">

    "use strict";

    $(document).ready(function () {
        $('#description').summernote({
            height: 330,
        });
    });

    <?php if (get_settings("active_map") == 'openstreetmap'): ?>

        //free map
        var map = L.map('map').setView([<?=get_settings('default_location');?>], 13);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?=get_settings("system_title");?></a>',
            gestureHandling: true
        }).addTo(map);

    <?php else: ?>

        //paid maps
        var map = L.map('map').setView([<?=get_settings('default_location');?>], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?=get_settings("system_title");?></a>',
            id: 'mapbox/streets-v11',
            accessToken: '<?=get_settings("map_access_token");?>',
            gestureHandling: true
        }).addTo(map);

    <?php endif;?>

    var popup = L.popup();
    map.on('click', onMapClick);

    function onMapClick(e) {
        popup.setLatLng(e.latlng).setContent("{{ get_phrase('Your selected') }} " + e.latlng.toString()).openOn(map);

        var lat_lan_string =  e.latlng.toString();
        var lat_lan_string_arr = lat_lan_string.split(", ");
        var lat_string_arr = lat_lan_string_arr[0].split('LatLng(');
        var lan_string_arr = lat_lan_string_arr[1].split(')');
        var lat = lat_string_arr[1];
        var lan = lan_string_arr[0];
        $('#latitude').val(lat);
        $('#longitude').val(lan);
    }

</script>

<script src="{{ asset('public/assets/customer/js/gmaps.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
@endsection


