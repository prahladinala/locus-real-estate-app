@extends('backend.index')

@section('content')

<style type="text/css">
.bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white !important;
    background-color: #0d6efd;
    padding: 0.2rem;
    border-radius: 5px;
}
</style>

<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Add Blog Form') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('Create New Blog') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
            <div class="eMain">
                <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.blogs.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pb-3">
                            <div class="eForm-layouts">
                                <p class="column-title">{{ get_phrase('Create Blog') }}</p>
                                <div class="fpb-7">
                                    <label for="title" class="eForm-label">{{ get_phrase('Blog Title') }}</label>
                                    <input type="text" class="form-control eForm-control" id="title" name = "title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="blog_category_id" class="eForm-label">{{ get_phrase('Blog Category') }}</label>
                                    <select name="blog_category_id" id="blog_category_id" class="form-select eForm-select eChoice-multiple-with-remove" required>
                                        <option value="">{{ get_phrase('Select a category') }}</option>
                                        @foreach($blog_categories as $blog_category)
                                            <option value="{{ $blog_category->id }}">{{ $blog_category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fpb-7">
                                    <label for="description" class="eForm-label">{{ get_phrase('Blog Description') }}</label>
                                    <textarea class="form-control eForm-control" id="description" name="description" rows="5" required></textarea>
                                </div>
                                <div class="fpb-7">
                                    <label for="keywords" class="eForm-label">{{ get_phrase('keywords') }}</label>
                                    <input type="text" class="form-control eForm-control" id = "keywords" name="keywords" placeholder="Ex: keyword1, keyword2, keyword3"/>
                                </div>
                                <div class="row fpb-7">
                                    <div class="col-sm-6">
                                        <label class="eForm-label" for="example-fileinput">{{ get_phrase('Blog Thumbnail') }}</label>
                                        <div class="eCard d-block text-center bg-light">
                                            <img src="{{ asset('public/uploads/blog/placeholder.jpg') }}" class="mx-4 my-5" width="200px"
                                                alt="...">
                                            <div class="eCard-body">
                                                <input class="form-control eForm-control-file" id="formFileSm" type="file" name="thumbnail" id="thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fpb-7">
                                    <p class="column-title">{{ get_phrase('Do you want to mark it as popular') }}?</p>
                                    <div class="eCheckbox">
                                        <div class="form-check">
                                            <input class="form-check-label" type="checkbox" value="1" id="is_popular" name="is_popular" />
                                            <label class="form-check-label" for="is_popular">
                                                {{ get_phrase('Mark as popular') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fpb-7 pt-2">
                                    <button class="btn-form" type="submit">{{ get_phrase('Create') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="eForm-layouts">
                                <p class="column-title">{{ get_phrase('Seo Settings') }}</p>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    "use strict";

    $(document).ready(function () {
        $('#description').summernote({
            height: 330,
        });
    });
</script>

@endsection