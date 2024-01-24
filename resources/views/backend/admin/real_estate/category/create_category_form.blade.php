
<style>
    .og_image img {
        height: 48px;
        object-fit: cover;
        width: 86px;
        border-radius: 5px 5px 0 0;
   } 
</style>

<form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.RealEstateCategoryCreateModalPost') }}">
    @csrf
    <div class="form-row">
        <div class="fpb-7">
            <label for="type" class="eForm-label">
                {{ get_phrase('Property Name') }}
            </label>
            <input type="text" class="form-control eForm-control" id="type" name="type" placeholder="Provide property name">
        </div>
        <div class="fpb-7">
            <label for="file" class="eForm-label">
                {{ get_phrase('Property Image (80 X 80)') }}
            </label>
            <input type="file" class="form-control eForm-control" id="file" name="property_image" required>
        </div>

        {{-- Property SEO --}}
        <div class="fpb-7 mt-3">
            <label class="eForm-label">{{ get_phrase('Property SEO:-') }}</label>
        </div>
        <div class="fpb-7">
            <label for="meta_title" class="eForm-label">{{ get_phrase('Meta Title') }}</label>
            <input class="form-control eForm-control" id="meta_title" name="meta_title" type="text" placeholder="Meta Title"/>
        </div>
        <div class="fpb-7">
            <label for="meta_keywords" class="eForm-label">{{ get_phrase('Meta Keywords') }}</label><br>
            <input type="text" class="form-control eForm-control" id = "meta_keywords" name="meta_keywords" placeholder="Ex: keyword1, keyword2, keyword3"/>
        </div>
        <div class="fpb-7">
            <label for="meta_description" class="eForm-label">{{ get_phrase('Meta Description') }}</label>
            <Textarea class="form-control eForm-control" id="meta_description" name="meta_description" type="text" placeholder="Meta Description"></Textarea>
        </div>
        <div class="fpb-7">
            <label for="og_title" class="eForm-label">{{ get_phrase('Og Title') }}</label>
           <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "og_title" name="og_title"/>
        </div>
        <div class="fpb-7">
            <label for="canonical " class="eForm-label">{{ get_phrase(' Canonical Url') }}</label>
            <input type="text" class="form-control eForm-control" data-role="tagsinput" id = "canonical " name="canonical" placeholder="https://example.com/dresses/cocktail?gclid=ABCD."/>
        </div>
        <div class="fpb-7">
            <label for="og_description" class="eForm-label">{{ get_phrase('Og Description') }}</label>
            <Textarea class="form-control eForm-control" id="og_description" name="og_description" type="text"></Textarea>
        </div>
        <div class="fpb-7">
            <label for="og_image" class="eForm-label">{{ get_phrase('Og Image') }}</label>
           <input type="file" class="form-control eForm-control " id = "og_image" name="og_image"/>
        </div>
        <div class="fpb-7">
            <label for="json_ld" class="eForm-label">{{ get_phrase('Json Id') }}</label>
            <Textarea class="form-control eForm-control" id="json_ld" name="json_ld" placeholder='<script src="https://cdn.jsdelivr.net/npm/json ld"></script>'></Textarea>
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
