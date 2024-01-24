<script src="{{ asset('public/assets/global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('public/assets/real-estate/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/real-estate/js/fontawesome.all.min.js') }}"></script>
<script src="{{ asset('public/assets/real-estate/vendors/nice-select/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('public/assets/real-estate/js/custom.js') }}"></script>

<script src="{{ asset('public/assets/real-estate/vendors/slick/slick.min.js') }}"></script>
{{-- <script src="{{ asset('public/assets/real-estate/vendors/rangeslider/rangeslider.min.js') }}"></script> --}}

<script src="{{ asset('public/assets/real-estate/vendors/venobox/venobox.min.js') }}"></script>

<script src="{{ asset('public/build/assets/js/toastr.min.js') }}"></script>

<script src="{{ asset('public/assets/real-estate/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('public/assets/real-estate/js/mapbox-gl-geocoder.min.js') }}"></script>
<script src="{{ asset('public/assets/real-estate/js/map.js') }}"></script>


@yield('js_frontend')

<script>

    "use strict";


    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script>

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
	$('form.required-form').find('input, select, radio').each(function(){
		if($(this).prop('required')){
			if ($(this).val() === "") {
				pass = 0;
			}
		}
	});

	if (pass === 1) {
		$('form.required-form').submit();
	}else {
		console.log('error');

	}
}

</script>

@yield('js_real_estate')
