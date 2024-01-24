<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ get_phrase('Customer') }} | {{ get_phrase('Panel') }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	

	@include('customer.include_top')

</head>
<body>

	<!-- Header Area Start -->
    @include('global.header')
    <!-- Header Area End   -->

    @php
		
	use App\Models\Listing_type;
	$listing_types=Listing_type::all();
	isset($current_route) ? "" : $current_route ="empty";

	@endphp

	<!-- Start Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-9 offset-lg-3">
              <div
                class="breadcrumb-title-2 d-flex justify-content-between align-items-center">
                <h3 class="fz-34-sb-white">{{ $navigation_name }}</h3>


              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- End Breadcrumb -->


    <section class="locus-section">
        <div class="container">
          <div class="locus-section-wrap">
            <div class="row justify-content-center">

                @include('customer.navigation')
                @yield('customerRightPanel')

            </div>
        </div>
      </div>
    </section>

    <!-- Bottom Area Start -->
    @include('global.footer')
    <!-- Bottom Area End   -->

    @include('customer.include_bottom')

    @include('modal')


    @yield('booking_page_modal')

    <script type="text/javascript">

    	"use strict";

        function redirect_current_route(listing_type_id,current_route)
        {

            var check_route='{{ $current_route }}';

            if(check_route!="")
            {
                var route=current_route;
                url=route.slice(0, -1)+listing_type_id;
                window.location.href = url;

            }


        }

    </script>

    <script type="text/javascript">

    	"use strict";

        jQuery(document).ready(function(){
	        $('input[name="datetimes"]').daterangepicker({
	            timePicker: true,
	            startDate: moment().startOf('day').subtract(30, 'day'),
	            endDate: moment().startOf('day'),
	            locale: {
	           format: 'M/DD/YYYY '
	          }

	        });
	    });

	    function checkRequiredFields() {
			var pass = 1;
			$('form.required-form').find('input, select, radio').each(function() {
				if($(this).prop('required')){
					if ($(this).val() === "") {
						pass = 0;
					}
				}
			});

			if (pass === 1) {
				$('form.required-form').submit();
			} else {
				toastr.error("Please fill all the required rield!");
			}

		}

    </script>


    <script type="text/javascript">

    	"use strict";

		// Select2 js
		$(document).ready(function () {
			$(".eChoice-multiple-without-remove").select2({
				placeholder: "Select a state",
			});
		});
		$(document).ready(function () {
			$(".eChoice-multiple-with-remove").select2();
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

		$(document).ready(function () {
		    $("#countries").select2({
		      templateResult: function (item) {
		        return format(item, false);
		      },
		    });
		    $("#us-states").select2({
		      templateResult: function (item) {
		        return format(item, true);
		      },
		    });
		});


    </script>

     @yield('customerjs')

</body>
</html>