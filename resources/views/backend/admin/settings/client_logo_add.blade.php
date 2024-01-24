<div class="eForm-file">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.clientLogoAdd') }}">
        @csrf 
        <div class="col">
            <label class="eForm-label" for="example-fileinput">{{ get_phrase('Client Thumbnail') }}</label>
            <div class="eCard d-block text-center bg-light">
                <div class="eCard-body">
                    <input class="form-control eForm-control-file" id="formFileSm" type="file" name="client" id="client">
                </div>
            </div>
        </div>
        <button type="submit" class="btn-form">{{ get_phrase('Upload') }}</button>
    </form>
</div>