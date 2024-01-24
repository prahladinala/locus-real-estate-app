@extends('auth.index')
@section('content')

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
                                        <h3 class="title-form pb-14">{{ get_phrase('Sign up') }}</h3>
                                        <p class="subtitle-form pb-30">
                                        {{ get_phrase('Create account to start using Locus') }}
                                        </p>
                                        
                                        <!-- Form -->
                                        <form id="signup_form" method="post" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-sign">
                                                <div class="input-wrap pb-16">
                                                    <label for="name" class="eForm-label">{{ get_phrase('Name') }}</label>
                                                    <input type="text" class="form-control eForm-control" id="name"  name="name" placeholder="Your name" aria-label="Your name" />
                                                </div>
                                                <div class="input-wrap pb-16">
                                                    <label for="email" class="eForm-label">{{ get_phrase('Email') }}</label>
                                                    <input type="email" class="form-control eForm-control" id="email" name="email" placeholder="example@mail.com" aria-label="example@mail.com" />
                                                </div>
                                                <div class="input-wrap pb-16">
                                                    <label for="password" class="eForm-label">{{ get_phrase('Password') }}</label>
                                                    <input type="password" class="form-control eForm-control" id="password" name="password" placeholder="at least 4 charecters" aria-label="at least 4 charecters" autocomplete="off"/>
                                                </div>
                                                <!-- Sign button -->
                                                <button type="submit" class="sign-btn-main w-100 mt-14">{{ get_phrase('SIGNUP') }}</button>
                                            </div>
                                        </form>
                                        <p class="subtitle-form2 text-center mt-25">
                                        {{ get_phrase('Already have an account') }}?
                                            <a href="{{ route('login') }}">{{ get_phrase('Login') }}</a>
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
