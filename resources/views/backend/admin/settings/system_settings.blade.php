@extends('backend.index')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('System Settings') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Home') }}</a></li>
                        <li><a href="#">{{ get_phrase('Settings') }}</a></li>
                        <li><a href="#">{{ get_phrase('System Settings') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-7">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-11 pb-3">
                        <div class="eForm-layouts">
                            <p class="column-title">{{ get_phrase('SYSTEM SETTINGS') }}</p>
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.system.update') }}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="website_title" class="eForm-label">{{ get_phrase('Website Title') }}</label>

                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('website_title'); }}" id="website_title" name = "website_title" required>

                                </div>
                                <div class="fpb-7">
                                    <label for="system_title" class="eForm-label">{{ get_phrase('System Title') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('system_title') }}" id="system_title" name = "system_title" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="meta_keyword" class="eForm-label">{{ get_phrase('Meta Keyword') }}</label>
                                    <input type="text" class="form-control eForm-control" rows="5" value="{{ get_settings('meta_keyword') }}" id="meta_keyword" meta_keyword = "name" data-role="tagsinput" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="meta_description" class="eForm-label">{{ get_phrase('Meta Description') }}</label>
                                    <input type="text" class="form-control eForm-control" rows="5" value="{{ get_settings('meta_description'); }}" id="meta_description" name = "meta_description" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="system_email" class="eForm-label">{{  get_phrase('System Email') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('system_email') }}" id="system_email" name = "system_email" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="address" class="eForm-label">{{ get_phrase('Address') }}</label>
                                    <textarea class="form-control eForm-control" id="address" name = "address" rows="5" required>{{  get_settings('address') }}</textarea>
                                </div>

                                <div class="fpb-7">
                                    <label for="phone" class="eForm-label">{{ get_phrase('Phone') }}</label>
                                    <input type="number" class="form-control eForm-control" value="{{ get_settings('phone') }}" id="phone" name = "phone" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="meta_pixel" class="eForm-label">{{ get_phrase('Meta pixel') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('meta_pixel') }}" id="meta_pixel" name = "meta_pixel" required>
                                </div>
                                    <label for="country_id" class="eForm-label">
                                        {{ get_phrase('Country') }}
                                    </label>
                                    <select name="country_id" id="country_id" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                                        <option value="">
                                            {{ get_phrase('Select a Country') }}
                                        </option>

                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @if(get_settings('country_id')==$country->id) {{ 'selected' }} @endif>
                                            {{  get_phrase(ucfirst($country->name )) }}
                                        </option>
                                        @endforeach
                                    </select>
                                        <div class="row fmb-7 mt-2 justify-content-between align-items-center">
                                        <label for="timezone" class=" eForm-label">
                                            {{ get_phrase('Time zone') }}
                                        </label>
                                        <div class="col-md-10 w-100">
                                        <select name="timezone" id="timezone" class="form-select eForm-select eChoice-multiple-with-remove" required>
                                            <option value="">
                                                {{ get_phrase('Select a Time zone') }}
                                            </option>

                                            @foreach ($timezones as $timezone)
                                            <option value="{{ $timezone }}" @if(get_settings('timezone')==$timezone) {{ 'selected' }} @endif>
                                                {{ get_phrase(ucfirst($timezone )) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="fpb-7 mt-2">
                                    <label for="language" class="eForm-label">{{ get_phrase('System Language') }}</label>
                                    <select class="form-select eForm-select eChoice-multiple-with-remove" id="language" name="language" required>
                                        <?php $languages = get_all_language(); ?>
                                        <?php foreach ($languages as $language): ?>
                                        <option value="{{ $language->identifier  }}" {{ get_settings('language') == $language->identifier ?  'selected':'' }}>{{ ucfirst($language->identifier) }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <div class="fpb-7 mt-2">
                                    <label for="purchase_code" class="eForm-label">{{ get_phrase('Purchase Code') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('purchase_code') }}" id="purchase_code" name = "purchase_code" required>
                                </div>

                                <label for="verification" class="eForm-label">
                                        {{ get_phrase('Email Verification') }}
                                    </label>
                                    <select name="signup_email_verification" id="verification" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                                        <option value="">{{get_phrase('Select email verfication')}} </option>
                                        <option value="1" @if(get_settings('signup_email_verification') == 1) selected @endif>
                                            {{ get_phrase('Enable') }}
                                        </option>
                                        <option value="0" @if(get_settings('signup_email_verification') == 0) selected @endif>
                                            {{ get_phrase('Disable') }}
                                        </option>  
                                    </select>

                                <div class="fpb-7">
                                    <label for="footer_text" class="eForm-label">{{ get_phrase('Footer Text') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('footer_text') }}" id="footer_text" name = "footer_text" required>
                                </div>
                                <div class="fpb-7">
                                    <label for="footer_link" class="eForm-label">{{ get_phrase('Footer Link') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('footer_link') }}" id="footer_link" name = "footer_link" required>
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
    <div class="col-5">
        <div class="eSection-wrap">
            <div class="eMain">
                <div class="row">
                    <div class="col-md-12 pb-3">
                        <p class="column-title">{{ get_phrase('PRODUCT UPDATE') }}</p>
                        <div class="eForm-file">
                            <form action="{{route('admin.product.update')}}" method="post" enctype="multipart/form-data">
                                @CSRF
                                <div class="mb-3">
                                    <label for="formFileSm" class="eForm-label">{{ get_phrase('File') }}</label>
                                    <input class="form-control eForm-control-file" id="formFileSm" type="file" name="file">
                                </div>
                                <button type="submit" class="btn-form float-end">{{ get_phrase('Update') }}</button>
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
            <div class="row">
                <div class="col-md-12 pb-3">
                    <p class="column-title">{{ get_phrase('Recapcha Settings') }}</p>
                    <div class="eForm-file">
                        <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('admin.system.update') }}">
                            @csrf 
                            <div class="row">

                                <div class="eRadios">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="recaptcha_status" id="recaptcha_status" value="1" @if(get_settings('recaptcha_status')==1) checked @endif />
                                      <label class="form-check-label" for="recaptcha_status">
                                        {{ get_phrase('Active') }}
                                      </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recaptcha_status" id="recaptcha_status" value="0"  @if(get_settings('recaptcha_status')==0) checked @endif/>
                                        <label class="form-check-label" for="recaptcha_status">
                                            {{ get_phrase('In Active') }}
                                        </label>
                                      </div>



                                  </div>

                                <div class="fpb-7">
                                    <label for="recaptcha_sitekey" class="eForm-label">{{ get_phrase('Site Key') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('recaptcha_sitekey') }}" id="recaptcha_sitekey" name = "recaptcha_sitekey" required>
                                </div>

                                <div class="fpb-7">
                                    <label for="recaptcha_secretkey" class="eForm-label">{{ get_phrase('Secrect Key') }}</label>
                                    <input type="text" class="form-control eForm-control" value="{{ get_settings('recaptcha_secretkey') }}" id="recaptcha_secretkey" name = "recaptcha_secretkey" required>
                                </div>

                            </div>
                            <button type="submit" class="btn-form">{{ get_phrase('Update recapcha') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')
<script>

    "use strict";
    
     if($('.tagify').height()){
    	$('.tagify').tagify();
    }
</script>
@endsection
