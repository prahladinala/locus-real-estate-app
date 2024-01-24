<form method="POST" class="d-block ajaxForm" action="{{ route('admin.RealEstatePropertyCreateModalPost') }}">
    @csrf
    <div class="form-row">
        <div class="fpb-7">
            <label for="type" class="eForm-label">
                {{ get_phrase('Property name') }}
            </label>
            <input type="text" class="form-control eForm-control" id="type" name="type" placeholder="Provide property name">
        </div>

        <div class="fpb-7 pt-2">
            <button class="btn-form" type="submit">
                {{ get_phrase('Create Property') }}
            </button>
        </div>
    </div>
</form>

<script>
    "use strict";
    $(".ajaxForm").validate({});
$(".ajaxForm").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, showAllRole);
});

</script>
