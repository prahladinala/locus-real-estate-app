<style>
    .h-200px{
        height: 200px;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>

<form id="edit_nearby_form" action="{{ route('updateNearByLocation', ['id' => $editLocation->id]) }}" method="post">
    @csrf
    <div class="dl_column_form d-flex flex-column rg-22">
        <!-- Nearby Location -->
        <div class="row justify-content-between align-items-center">
            <label for="addnearby" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Add a Nearby Location') }}</label>
            <div class="col-sm-9">
                <select class="form-select eForm-select " id="nearby_id" name="nearby_id" data-placeholder="Type to search...">


                    @foreach ($nearby_loc as $key=>$near)
                    <option value="{{ $key }}" @if($editLocation->nearby_id==$key) selected @endif>{{ $near }}</option>
                    @endforeach
                </select>
            </div>
        </div>
          <!-- name -->
          <div class="row justify-content-between align-items-center">
            <label for="name" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Name') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="name" class="form-control eForm-control2" id="name" name="name" value= "{{ $editLocation->name }}"/>
            </div>
        </div>
        <input type="hidden"  id="listing_id" name="listing_id" value="{{ $editLocation->listing_id }}"/>
        <!-- Latitude -->
        <div class="row justify-content-between align-items-center">
            <label for="edit-latitude" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Latitude') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="9206" class="form-control eForm-control2" id="edit-latitude" name="latitude" value="{{ $editLocation->latitude }}"/>
            </div>
        </div>
        <!-- Longitude -->
        <div class="row justify-content-between align-items-center">
            <label for="edit-longitude" class="col-sm-3 pe-0 col-eForm-label">{{ get_phrase('Longitude') }}</label>
            <div class="col-sm-9">
                <input type="text" placeholder="9206" class="form-control eForm-control2" id="edit-longitude" name="longitude" value="{{ $editLocation->longitude }}" />
            </div>
        </div>
        <!-- Select Location -->
        <div class="row justify-content-between align-items-start">
            <label for="inputLocation" class="col-sm-2 pe-0 col-eForm-label">{{ get_phrase('Select Location') }}</label>
            <div class="col-sm-10 col-md-9 col-lg-10">
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
        <a href="javascript:{}" onclick="document.getElementById('edit_nearby_form').submit();" class="eBtn saveChanges-btn">{{ get_phrase('Update Nearby Location') }}</a>
    </div>
</form>

<script type="text/javascript">

    "use strict";
    
    <?php if(get_settings("active_map") == 'openstreetmap'): ?>
        //free map
        var map = L.map('nearby-map').setView(["{{ $editLocation->latitude }}", "{{ $editLocation->longitude }}"], 13);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
            attribution: '<a href="{{ route('home') }}" target="_blank"><?= get_settings("system_title"); ?></a>', 
            gestureHandling: true
        }).addTo(map);
    <?php else: ?>
        //paid maps
        var map = L.map('nearby-map').setView(["{{ $editLocation->latitude }}", "{{ $editLocation->longitude }}"], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', { attribution: '<a href="{{ route('home') }}" target="_blank"><?= get_settings("system_title"); ?></a>', 
            id: 'mapbox/streets-v11', 
            accessToken: '<?= get_settings("map_access_token"); ?>', 
            gestureHandling: true
        }).addTo(map);
    <?php endif; ?>


    L.marker(["{{ $editLocation->latitude }}", "{{ $editLocation->longitude }}"]).addTo(map).openPopup();

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
        $('#edit-latitude').val(lat);
        $('#edit-longitude').val(lan);
    }

    function set_previous_lat_lan(){
        if($('.leaflet-pane.leaflet-popup-pane').html() === ""){
            $('#edit-latitude').val("{{ $editLocation->latitude }}");
            $('#edit-longitude').val("{{ $editLocation->longitude }}");
        }
    }

</script>