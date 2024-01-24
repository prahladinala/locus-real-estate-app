@extends('backend.index')
@section('content')

<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Website Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('Website Settings') }}</a></li>
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
                <div class="row">
                    <div class="col-md-8 pb-3">
                        <div class="eForm-layouts">
                            <p class="column-title">{{ get_phrase('FRONTEND SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.website.update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="website_hero_title" class="eForm-label">{{ get_phrase('Website Hero Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('website_hero_title'); }}" id="website_hero_title" name = "website_hero_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="website_title" class="eForm-label">{{ get_phrase('Website Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('website_title'); }}" id="website_title" name = "website_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="website_subtitle" class="eForm-label">{{ get_phrase('Website Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('website_subtitle') }}" id="website_subtitle" name = "website_subtitle" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="feature_city_title" class="eForm-label">{{ get_phrase('Feature City Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('feature_city_title') }}" id="feature_city_title" name="feature_city_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="feature_city_subtitle" class="eForm-label">{{ get_phrase('Feature City Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('feature_city_subtitle') }}" id="feature_city_subtitle" name="feature_city_subtitle" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="real_estate_subtitle" class="eForm-label">{{ get_phrase('Real Estate Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('real_estate_subtitle') }}" id="real_estate_subtitle" name="real_estate_subtitle" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="feature_video_title" class="eForm-label">{{ get_phrase('Feature Video Title') }}</label>

                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('feature_video_title') }}" id="feature_video_title" name = "feature_video_title" required>

                                </div>
                                <div class="fpb-7">
                                    <label for="feature_video_subtitle" class="eForm-label">{{ get_phrase('Feature Video Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('feature_video_subtitle') }}" id="feature_video_subtitle" name = "feature_video_subtitle" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="feature_video_description" class="eForm-label">{{ get_phrase('Feature Video Description') }}</label>
                                    <textarea type="text" row="3" class="form-control eForm-control" value="{{ get_frontend_settings('feature_video_description') }}" id="feature_video_description" name="feature_video_description">{{ get_frontend_settings('feature_video_description') }}</textarea>
                                </div>

                                <div class="fpb-7">
                                    <label for="feature_video_url" class="eForm-label">{{ get_phrase('Feature Video Url') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('feature_video_url') }}" id="feature_video_url" name="feature_video_url" placeholder="E.g: https://www.youtube.com/watch?v=oBtf8Yglw2w">
                                </div>

                                <div class="fpb-7">
                                    <label for="directory_title" class="eForm-label">{{ get_phrase('Directory Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('directory_title') }}" id="directory_title" name = "directory_title" required>
                                </div>
                                {{-- <div class="fpb-7">
                                    <label for="footer_need_help_text" class="eForm-label">{{ get_phrase('Footer Need Help Text') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('footer_need_help_text') }}" id="footer_need_help_text" name = "footer_need_help_text" required>
                                </div> --}}

                                <div class="fpb-7">
                                    <label for="newsleter_footer_text" class="eForm-label">{{ get_phrase('Footer Newsleter Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('newsleter_footer_text') }}" id="newsleter_footer_text" name = "newsleter_footer_text" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="newsleter_short_text" class="eForm-label">{{ get_phrase('Footer Newsleter Short Description') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('newsleter_short_text') }}" id="newsleter_short_text" name = "newsleter_short_text" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="footer_description" class="eForm-label">{{ get_phrase('Footer Descripion') }}</label>
                                    <input type="text" class="form-control eForm-control" id="footer_description" name="footer_description" value="{{ get_frontend_settings('footer_description') }}" placeholder="Enter description link" />
                                </div>

                                <div class="fpb-7">
                                    <label for="facebook_link" class="eForm-label">{{ get_phrase('Facebook') }}</label>
                                    <input type="text" class="form-control eForm-control" id="facebook_link" name="facebook_link" value="{{ get_frontend_settings('facebook_link') }}" placeholder="Enter facebook link" />
                                </div>

                                <div class="fpb-7">
                                    <label for="twitter_link" class="eForm-label">{{ get_phrase('Twitter') }}</label>
                                    <input type="text" class="form-control eForm-control" id="twitter_link" name="twitter_link" value="{{ get_frontend_settings('twitter_link') }}" placeholder="Enter twitter link" />
                                </div>

                                <div class="fpb-7">
                                    <label for="linkedin_link" class="eForm-label">{{ get_phrase('Linkedin') }}</label>
                                    <input type="text" class="form-control eForm-control" id="linkedin_link" name="linkedin_link" value="{{ get_frontend_settings('linkedin_link') }}" placeholder="Enter linkedin link" />
                                </div>

                                <div class="fpb-7">
                                    <label for="instagram_link" class="eForm-label">{{ get_phrase('Instagram') }}</label>
                                    <input type="text" class="form-control eForm-control" id="instagram_link" name="instagram_link" value="{{ get_frontend_settings('instagram_link') }}" placeholder="Enter instagram link" />
                                </div>

                                
                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form">{{ get_phrase('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="eSection-wrap">
        <div class="eMain">
          <form action="{{route('admin.website_logo.add')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="eForm-file">
                             <p class="column-title">{{ get_phrase('Header Light logo') }}</p>
                              <div class="form-group mt-3 blog-img-show logo_imgs log_card">
                                 <div class="card text-center">
                                    @if(get_frontend_settings('light_logo'))
                                      <img  id="light_logo" class="img-fluied" src="{{asset('public/assets/uploads/logo/'.get_frontend_settings('light_logo'))}}" alt="img" name="light_logo" >
                                      @else
                                      <img  id="light_logo" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="image" name="light_logo" >
                                      @endif

                                    <div class="card-body pt-0">
                                        <p  class="p_text">{{get_phrase('(85 x 160)')}}</p>
                                       <input type="file"  id="light_logo"  class="form-control eForm-control" name="light_logo" >
                                        <input type="hidden" name="old_light_logo" value="{{get_frontend_settings('light_logo')}}">
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="eForm-file">
                             <p class="column-title">{{ get_phrase('Header Dark logo') }}</p>
                              <div class="form-group mt-3 blog-img-show logo_imgs log_card">
                                 <div class="card text-center">
                                    @if(get_frontend_settings('light_logo'))
                                      <img  id="light_logo" class="img-fluied" src="{{asset('public/assets/uploads/logo/'.get_frontend_settings('dark_logo'))}}" alt="img" name="dark_logo" >
                                      @else
                                      <img  id="dark_logo" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="image" name="dark_logo" >
                                      @endif
                                    <div class="card-body pt-0">
                                        <p  class="p_text">{{get_phrase('(85 x 160)')}}</p>
                                       <input type="file"  id="dark_logo"  class="form-control eForm-control" name="dark_logo" >
                                        <input type="hidden" name="old_dark_logo" value="{{get_frontend_settings('dark_logo')}}">
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                         <div class="eForm-file">
                             <p class="column-title">{{ get_phrase('Favicon') }}</p>
                              <div class="form-group mt-3 blog-img-show logo_imgs log_card">
                                 <div class="card text-center">
                                    @if(get_frontend_settings('favicon'))
                                      <img  id="favicon" class="img-fluied" src="{{asset('public/assets/uploads/logo/'.get_frontend_settings('favicon'))}}" alt="img" name="favicon" >
                                      @else
                                      <img  id="favicon" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="img" name="favicon" >
                                      @endif

                                    <div class="card-body pt-0">
                                        <p  class="p_text">{{get_phrase('(80 x 80)')}}</p>
                                       <input type="file"  id="favicon"  class="form-control eForm-control" name="favicon" >
                                        <input type="hidden" name="old_favicon" value="{{get_frontend_settings('favicon')}}">
                                     </div>
                                </div>
                            </div>
                        </div>                 
                    </div>
                    <div class="col-lg-3">
                         <div class="eForm-file">
                             <p class="column-title">{{ get_phrase('Footer logo') }}</p>
                              <div class="form-group mt-3 blog-img-show logo_imgs log_card">
                                 <div class="card text-center">
                                    @if(get_frontend_settings('footer_logo'))
                                      <img  id="footer_logo" class="img-fluied" src="{{asset('public/assets/uploads/logo/'.get_frontend_settings('footer_logo'))}}" alt="img" name="footer_logo" >
                                      @else
                                      <img  id="footer_logo" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="img" name="footer_logo" >
                                      @endif

                                    <div class="card-body pt-0">
                                        <p  class="p_text">{{get_phrase('(85 x 160)')}}</p>
                                       <input type="file"  id="footer_logo"  class="form-control eForm-control" name="footer_logo" >
                                        <input type="hidden" name="old_footer_logo" value="{{get_frontend_settings('footer_logo')}}">
                                     </div>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
             <button type="submit" class="btn-form mt-3">{{get_phrase('Update')}}</button>
          </form>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="eSection-wrap">
        <div class="eMain row">
            <div class="col-md-4 pb-3">
               <p class="column-title">{{ get_phrase('Banner Image') }}</p>
                <div class="eForm-file">
                    <form action="{{route('admin.website_bannar.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                     <div class="form-group mt-3 blog-img-show">
                          <div class="card text-center">
                               @if(get_frontend_settings('bannar'))
                                     <img id="preview" class="img-fluied" src="{{asset('public/assets/uploads/bannar/'. get_frontend_settings('bannar'))}}" name="bannar_image"/>
                                  @else
                                  <img  id="preview" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="img" name="bannar_image" >
                                   @endif
                             <div class="card-body">
                                <label for="banner" class="form-label">
                                    <span>{{get_phrase('Choose a banner')}} </span>
                                    <p>{{get_phrase('(2000 x 500)')}}</p>
                                    </label>
                                    <input type="file" onchange="showPreview(event);" id="banner"  class="form-control d-none" name="bannar_image" >
                                    <input type="hidden" name="old_bannar_image" value="{{get_frontend_settings('bannar')}}">
                                </div>
                           </div>
                       </div>
                       <button type="submit" class="btn-form mt-3">{{get_phrase('update')}}</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 pb-3">
               <p class="column-title">{{ get_phrase('Video Image') }}</p>
                <div class="eForm-file">
                    <form action="{{route('admin.video_image')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                     <div class="form-group mt-3 blog-img-show">
                          <div class="card text-center">
                               @if(get_frontend_settings('video_image'))
                                     <img id="preview-1" class="img-fluied" src="{{asset('public/assets/uploads/bannar/'. get_frontend_settings('video_image'))}}" name="video_image"/>
                                  @else
                                  <img  id="preview-1" class="img-fluied" src="{{asset('public/assets/backend/images/test-2.png')}}" alt="img" name="video_image" >
                                   @endif
                             <div class="card-body">
                                <label for="banners" class="form-label">
                                    <span>{{get_phrase('Choose a Video Image')}} </span>
                                    <p>{{get_phrase('(2000 x 500)')}}</p>
                                    </label>
                                    <input type="file" onchange="showPreviews(event);" id="banners"  class="form-control d-none" name="video_image" >
                                    <input type="hidden" name="old_video_image" value="{{get_frontend_settings('video_image')}}">
                                </div>
                           </div>
                       </div>
                       <button type="submit" class="btn-form mt-3">{{get_phrase('update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-8 pb-3">
                        <div class="eForm-layouts">
                            <p class="column-title">{{ get_phrase('REAL-ESTATE SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.real_estate.update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="real_estate_title" class="eForm-label">{{ get_phrase('Real-Estate Title') }}</label>

                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('real_estate_title') }}" id="real_estate_title" name = "real_estate_title" required>

                                </div>
                                <div class="fpb-7">
                                    <label for="re_subtitle" class="eForm-label">{{ get_phrase('Real-Estate Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('re_subtitle') }}" id="re_subtitle" name = "re_subtitle" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="re_listing_title" class="eForm-label">{{ get_phrase('Listing Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('re_listing_title') }}" id="re_listing_title" name="re_listing_title" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="faq_title" class="eForm-label">{{ get_phrase('Faq Title') }}</label>

                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('faq_title') }}" id="faq_title" name = "faq_title" required>

                                </div>
                                <div class="fpb-7">
                                    <label for="faq_subtitle" class="eForm-label">{{ get_phrase('Faq Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('faq_subtitle') }}" id="faq_subtitle" name = "faq_subtitle" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="blog_title" class="eForm-label">{{ get_phrase('Blog Title') }}</label>

                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('blog_title') }}" id="blog_title" name = "blog_title" required>

                                </div>
                                <div class="fpb-7">
                                    <label for="blog_subtitle" class="eForm-label">{{ get_phrase('Blog Subtitle') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_frontend_settings('blog_subtitle') }}" id="blog_subtitle" name = "blog_subtitle" required>
                                </div>
                                
                                <div class="fpb-7 pt-2">
                                    <button type="submit" class="btn-form">{{ get_phrase('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
"Use strict";
function showPreview(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("preview");
      preview.src = src;
      preview.style.display = "block";
    }
  }
function showPreviews(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("preview-1");
      preview.src = src;
      preview.style.display = "block";
    }
  }

</script>

@endsection
