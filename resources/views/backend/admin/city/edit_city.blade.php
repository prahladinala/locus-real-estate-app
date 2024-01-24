

<Style>

    .form_stryle{
        min-width: 300px; max-width: 400px;
    }
    .row_style{
        margin-left: 2px;
    }
    .style_colour{
        color: #fff;
    }
    .disp_n{
        display: none;
    }
    #mySelect{
        font-size: 14px;
    }
    .nice-select .list {
	  width: 100% !important;
   }
    .nice-select {
        width: 100% !important;
    }
    .nice-select:after {
       display: none;
    }
    .nice-select {
	  line-height: 30px;
   }
   .nice-select .option {
	  line-height: 33px;
	  min-height: 27px;
	 font-size: 14px;
   }
   .nice-select .option.selected {
	 font-weight: 500;
   }
</Style>

<form method="POST" class="d-block ajaxForm responsive_media_query form_stryle" action="{{ route('admin.EditCitiesModalPost') }}" >

    @csrf
    

    <div class="form-group row">


        <div class="fpb-7">
            <label for="country_id" class="eForm-label">
                {{  get_phrase('Country'); }}
            </label>
            <select name="country_id" id="country_id" class="form-select" onchange="load_countrys_state(this.value);"  required>
                <option value="">
                    {{   get_phrase('Select a Country'); }}
                </option>

                @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if($city->country_id==$country->id) {{ 'selected' }} @endif>
                    {{   get_phrase(ucfirst($country->name )); }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="fpb-7">
            <label for="state_id" class="eForm-label">
                {{  get_phrase('State'); }}
            </label>
            <select name="state_id" id="state_id" class="form-select eForm-select eChoice-multiple-with-remove"   required>
                <option value="{{ $city->state_id }}"> {{ get_phrase($city->city_to_state->title); }}
                </option>
            </select>
        </div>

        <div class="fpb-7">
            <label for="title" class="eForm-label">
                {{ get_phrase('City Name') }}
            </label>
            <input type="text" class="form-control eForm-control inputDate" id="title" name="title" value="{{ $city->title }}"  required>
        </div>

        <input type="hidden"  id="id" name="id" value="{{ $city->id }}"  >

    </div>


    <div class="form-group col-md-12 mt-2" id="submit" >
        <button class="btn w-100 btn-primary" type="submit">
           {{ get_phrase('Update City') }}
        </button>
    </div>
</form>

<script type="text/javascript">

    "use strict";

    $(document).ready(function () {
      $(".eChoice-multiple-with-remove").select2();
    });
    $(document).ready(function() {
       $('#country_id').niceSelect();
    });
</script>

