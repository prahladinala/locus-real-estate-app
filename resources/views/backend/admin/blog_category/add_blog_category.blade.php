<style type="text/css">
    textarea.eForm-control {
        height: 70px;
        min-height: 30px !important;
    }
</style>

<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.blog_category.create') }}">
        @csrf
        <div class="form-row">
            <div class="fpb-7">
                <label for="title" class="eForm-label">{{ get_phrase('Blog Category Title') }}</label>
                <input type="text" class="form-control eForm-control" id="title" name = "title" required>
            </div>
            <div class="fpb-7">
                <label for="subtitle" class="eForm-label">{{ get_phrase('Blog Subtitle').'('.get_phrase('80 Charecter').')' }}</label>
                <textarea class="form-control eForm-control" id="subtitle" name = "subtitle" rows="3" required></textarea>
            </div>

            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Create') }}</button>
            </div>
        </div>
    </form>
</div>