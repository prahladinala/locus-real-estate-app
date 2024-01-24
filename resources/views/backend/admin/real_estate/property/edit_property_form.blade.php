<form method="POST" class="d-block ajaxForm" action="{{ route('admin.RealEstatePropertyEditModalPost',['id'=>$property->id ] ) }}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="fpb-7">
        <label for="type" class="eForm-label">
          {{ get_phrase('Property name') }}
        </label>
        <input type="text" class="form-control eForm-control" id="type" name="type" value="{{ $property->type }}" placeholder="Provide property name" required>
      </div>

      <div class="fpb-7 pt-2">
        <button class="btn-form" type="submit">
         {{ get_phrase('Update Property') }}
        </button>
      </div>
    </div>
  </form>
