@extends('backend.index')

@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Blog Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blogs') }}</a></li>
                        <li><a href="#">{{ get_phrase('Blog Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-md-2">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-11 pb-1">
                        <div class="eForm-layouts">
                        	<form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.blog_settings.update') }}">
                                @csrf

                                <div class="fpb-7">
									<label class="column-title">{{ get_phrase('Agents blog permission') }}?</label><br>
                                    <div class="eRadios">
                                        <input type="radio" name="agents_blog_permission" id="yes" value="1" {{ get_settings('agents_blog_permission') == 1 ? 'checked' : '' }}> <label for="yes">{{ get_phrase('Yes') }}</label>
                                        <br>
                                        <input type="radio" class="ml-2" name="agents_blog_permission" id="no" value="0" {{ get_settings('agents_blog_permission') == 0 ? 'checked' : '' }}> <label for="no">{{ get_phrase('No') }}</label>
                                    </div>
								</div>

                                <div class="fpb-7">
                                    <div class="eRadios">
                                        <label class="column-title">{{ get_phrase('Blog visibility on home page') }}?</label>
                                        <br>
                                        <input type="radio" name="blog_visibility_on_home_page" id="enable" value="1" {{ get_frontend_settings('blog_visibility_on_home_page') == 1 ? 'checked' : '' }}> <label for="enable">{{ get_phrase('Visible') }}</label>
                                        <br>
                                        <input type="radio" class="ml-2" name="blog_visibility_on_home_page" id="disabled" value="0" {{ get_frontend_settings('blog_visibility_on_home_page') == 0 ? 'checked' : '' }}> <label for="disabled">{{ get_phrase('Invisible') }}</label>
                                    </div>
                                </div>

                                <div class="fpb-7 pt-2">
                                    <button class="btn-form" type="submit">{{ get_phrase('Save Changes') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection