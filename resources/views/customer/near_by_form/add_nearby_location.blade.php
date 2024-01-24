<style>
    .h-200px{
        height: 200px;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>

<form id="nearby_form" action="{{ route('saveNearByLocation') }}" method="post">
    @csrf
    <div class="dl_column_form d-flex flex-column rg-22">
        <!-- Nearby Location -->
         <div class="row justify-content-between align-items-center">
            <label for="addnearby" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Add a Nearby Location') }}</label>
            <div class="col-sm-9">
                <select class="form-select eForm-select eChoice-multiple-without-remove" id="nearby_id" name="nearby_id" data-placeholder="Type to search...">
                    @foreach ($nearby_loc as $key=>$near)
                    <option value="{{ $key }}">{{ ucfirst($near) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
          <!-- name -->
          <div class="row justify-content-between align-items-center">
            <label for="name" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Name') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="name" class="form-control eForm-control2" id="name" name="name"/>
            </div>
        </div>
        <input type="hidden"  id="listing_id" name="listing_id" value="{{ $listing->id }}"/>
        <!-- Latitude -->
        <div class="row justify-content-between align-items-center">
            <label for="nearby-latitude" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Latitude') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="9206" class="form-control eForm-control2" id="nearby-latitude" name="latitude" />
            </div>
        </div>
        <!-- Longitude -->
        <div class="row justify-content-between align-items-center">
            <label for="nearby-longitude" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Longitude') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="9206" class="form-control eForm-control2" id="nearby-longitude" name="longitude" />
            </div>
        </div>
        <!-- Select Location -->
        <div class="row justify-content-between align-items-start">
            <label for="inputLocation" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Select Location') }}</label>
            <div class="col-sm-10 col-md-9 col-lg-9">
                <div class="contact-map">
                    <div class="map-area">
                        <div class="map-frame">
                            <link rel="stylesheet" href="{{ asset('public/assets/customer/css/leaflet.css') }}" />
                            <script src="{{ asset('public/assets/customer/js/leaflet.js') }}"></script>
                            <div id="nearby-map" class="h-200px cursor-pointer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button -->
    <div class="dl_form_btn d-flex justify-content-end g-20 pt-40">
        <a href="javascript:{}" onclick="document.getElementById('nearby_form').submit();" class="eBtn saveChanges-btn">{{ get_phrase('Save Nearby') }}</a>
    </div>
</form>

<!-- map start -->
<script type="text/javascript">

    "use strict";

    <?php if (get_settings("active_map") == 'openstreetmap'): ?>

        //free map
        var map = L.map('nearby-map').setView([<?=get_settings('default_location');?>], 13);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?=get_settings("system_title");?></a>',
            gestureHandling: true
        }).addTo(map);

    <?php else: ?>

        //paid maps
        var map = L.map('nearby-map').setView([<?=get_settings('default_location');?>], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '<a href="{{ route('home') }}" target="_blank"><?=get_settings("system_title");?></a>',
            id: 'mapbox/streets-v11',
            accessToken: '<?=get_settings("map_access_token");?>',
            gestureHandling: true
        }).addTo(map);

    <?php endif;?>

    var popup = L.popup();
    map.on('click', onNearbyMapClick);

    function onNearbyMapClick(e) {
        popup.setLatLng(e.latlng).setContent("{{ get_phrase('Your selected') }} " + e.latlng.toString()).openOn(map);

        var lat_lan_string =  e.latlng.toString();
        var lat_lan_string_arr = lat_lan_string.split(", ");
        var lat_string_arr = lat_lan_string_arr[0].split('LatLng(');
        var lan_string_arr = lat_lan_string_arr[1].split(')');
        var lat = lat_string_arr[1];
        var lan = lan_string_arr[0];
        $('#nearby-latitude').val(lat);
        $('#nearby-longitude').val(lan);
    }

</script>