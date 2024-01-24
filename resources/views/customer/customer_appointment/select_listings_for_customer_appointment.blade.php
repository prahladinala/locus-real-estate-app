@extends('customer.index')
@section('customerRightPanel')


<div class="col-lg-9">
    <div class="l_col_main">
        <div class="dl-noData d-flex flex-column align-items-center">
            <div class="selectWrap">
              <select class="form-select eForm-select eChoice-multiple-without-remove" id="select_listing_type"  data-placeholder="Type to search...">
                    <option value="">
                        {{ get_phrase('Select Listing Type') }}
                    </option>
                    @foreach($listings_types as $key => $types)
                    <option value="{{ $types->id }}">
                        {{ $types->title }}
                    </option>
                    @endforeach
                </select>

            </div>
            <div class="image">
                <img class="mb-3" src="{{ asset('public/assets/global/images/no_data_img.png') }}" />
            </div>
        </div>
    </div>






    @endsection

    @section('customerjs')


    <script type="text/javascript">

    "use strict";

    $('#select_listing_type').on('change', function () {

        var type = $(this).val(); // get selected value
        var url = '{{ route("customerAppointmentList", ":type") }}';
        url = url.replace(':type', type);

        if (type!="") {
            window.location.href = url;

        }

    });
    </script>

    @endsection
