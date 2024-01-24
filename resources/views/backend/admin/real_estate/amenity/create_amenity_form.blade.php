<form method="POST" class="d-block ajaxForm" action="{{ route('admin.RealEstateAmenityCreateModalPost') }}">
    @csrf
    <div class="form-row">
        <div class="fpb-7">
            <label for="type" class="eForm-label">
               {{ get_phrase('Amenity name') }}
            </label>
            <input type="text" class="form-control eForm-control" id="type" name="type" placeholder="Provide amenity name" required>
        </div>

        <div class="fpb-7">
            <label for="font_awesome_class" class="eForm-label">{{ get_phrase('Icon picker') }}</label>
            <input type="text" id ="font_awesome_class" name="font_awesome_class" class="form-control icon-picker" autocomplete="off" required>
        </div>

        <div class="fpb-7 pt-2">
            <button class="btn-form" type="submit">
                {{ get_phrase('Create Amenity') }}
            </button>
        </div>
    </div>
</form>

<script src="{{ asset('public/build/assets/backend/font-awesome-icon-picker/fontawesome-iconpicker.min.js') }}"></script>
<script>

    "use strict";

    $(function() {
        $('.icon-picker').iconpicker();
    });

</script>
