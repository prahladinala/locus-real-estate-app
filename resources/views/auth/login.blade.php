@extends('auth.index')
@section('content')
@if(get_settings('recaptcha_status')==1)
  <script src="{{ asset('public/assets/global/js/api.js') }}"></script>
@endif
<section class="sign-section">
    <div class="container-xl">
        <div class="row align-items-center p-5 ">
            <div class="col-lg-7 d-none d-lg-block p-0 pr-5">
                <div class="bg-image"></div>
            </div>
            <div class="col-lg-5 p-0 position-relative">
                <div class="parent-elem">
                    <div class="middle-elem">
                        <div class="primary-form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign-wrap">
                                        <h3 class="title-form pb-14">{{ get_phrase('Login') }}</h3>
                                        <p class="subtitle-form pb-30">
                                        {{ get_phrase('Sign into your account to start using Locus') }}
                                        </p>
                                        <!-- Form -->
                                        <form id="login_form" method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-sign">
                                                <div class="input-wrap pb-16">
                                                    <label for="email" class="eForm-label">{{ get_phrase('Email') }}</label>
                                                    <input type="email" class="form-control eForm-control" id="email" name="email" placeholder="example@mail.com" aria-label="example@mail.com" />
                                                </div>
                                                <div class="input-wrap pass-group pb-16">
                                                    <label for="password" class="eForm-label">{{ get_phrase('Password') }}</label>
                                                    <input type="password" class="form-control eForm-control" id="password" name="password" placeholder="at least 8 charecters" aria-label="at least 4 charecters"  autocomplete="off"/>
                                                    <div class="pass-icon">
                                                    </div>
                                                </div>
                                                <!-- reCAPTCHA -->
                                                    @if(get_settings('recaptcha_status')==1)
                                                      <div class="g-recaptcha" data-sitekey="{{get_settings('recaptcha_sitekey')}}"></div><br/>
                                                    @endif
                                                <div class="remember-area d-flex align-items-center justify-content-between">
                                                  
                                                  <div class="input-group forgetPass d-flex align-items-center">
                                                    <input type="checkbox" class="form-check" id="remember">
                                                    <label for="remember"> {{ get_phrase('Remember me') }}</label>
                                                  </div>
                                                  <a href="{{ route('password.request') }}" class="forgetPass pass-two">{{ get_phrase('Forget password') }}?</a>
                                                </div>
                                                <!-- Sign button -->
                                                <button type="submit" class="sign-btn-main w-100 mt-14">{{ get_phrase('LOGIN') }}</button>
                                            </div>
                                        </form>
                                        <p class="subtitle-form2 text-center mt-25">
                                        {{ get_phrase("Don't have account") }}? <a href="{{ route('register') }}">{{ get_phrase('Sign up') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
