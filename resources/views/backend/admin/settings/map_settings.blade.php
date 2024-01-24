@extends('backend.index')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{   get_phrase('Map settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{   get_phrase('Home') }}</a></li>
                        <li><a href="#">{{   get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{   get_phrase('Map settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-12 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" class="col-12 live-class-settings-form" action="{{ route('admin.update_map_settings') }}" id="live-class-settings-form">
                                @csrf 


                                <div class="fpb-7">
                                    <label for="active_map" class="eForm-label">{{   get_phrase('Choose your map') }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id = "active_map" name="active_map" onchange="change_map(this.value)" required>
                                        <option value="openstreetmap" @if(get_settings('active_map') == 'openstreetmap')  selected @endif >{{ get_phrase('Openstreet Map') }}</option>
                                        <option value="mapbox" @if (get_settings('active_map') == 'mapbox') selected @endif>{{ get_phrase('mapbox') }}</option>

                                      </select>
                                </div>

                                <div class="fpb-7" id="map_access_token_section"  style="@if(get_settings('active_map') != 'mapbox') display: none; @endif">
                                    <label for="map_access_token" class="eForm-label" >{{ get_phrase('Map access Token ') }} </label>
                                     <input type="text" class="form-control eForm-control" value="{{ get_settings('map_access_token'); }}" id="map_access_token" name = "map_access_token" required>
                                </div>


                                <div class="fpb-7">
                                    <label for="default_location" class="eForm-label">{{ get_phrase('Contact location') }} <small>( {{ get_phrase('Latitude') }}, {{ get_phrase('Longitude') }})</small></label>
                                     <input type="text" class="form-control eForm-control" value="{{ get_settings('default_location'); }}" id="default_location" name = "default_location" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="max_zoom_level" class="eForm-label">{{ get_phrase('Max Zoom Level') }} </label>
                                     <input type="text" class="form-control eForm-control" value="{{ get_settings('max_zoom_level'); }}" id="max_zoom_level" name = "max_zoom_level" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="min_zoom_listings_page" class="eForm-label">{{ get_phrase('Min zoom level on the listings page') }} </label>
                                     <input type="text" class="form-control eForm-control" value="{{ get_settings('min_zoom_listings_page'); }}" id="min_zoom_listings_page" name = "min_zoom_listings_page" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="min_zoom_directory_page" class="eForm-label">{{ get_phrase('Min zoom level on the directory page') }} </label>
                                     <input type="text" class="form-control eForm-control" value="{{ get_settings('min_zoom_directory_page'); }}" id="min_zoom_directory_page" name = "min_zoom_directory_page" required>
                                </div>

                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form" onclick="">{{ get_phrase('Update Map') }}</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

<script>
"Use strict";

function change_map(map){
    if(map != 'mapbox'){
      $('#map_access_token_section').hide();
    }else{
      $('#map_access_token_section').show();
    }
  }
</script>

@endsection
