@extends('auth.index')
@section('content')

<section class="sign-section mt-5">
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
                                        <h3 class="title-form pb-14">{{ get_phrase('Forget Password') }}</h3>
                                        <p class="subtitle-form pb-60">
                                        {{ get_phrase('Enter your email address to receive a verification
                                            Link') }}
                                        </p>

                                        <div class="card-body">
                                            @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                            @endif

                                            <form id="emailsend" method="POST" action="{{ route('password.email') }}" class="form-sign">
                                                @csrf
                                                
                                                <div class="input-wrap  pb-16">
                                                    <label for="email" class="eForm-label">{{ get_phrase('Email') }}</label>
                                                        <input id="email" type="email" class="form-control eForm-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="example@mail.com" aria-label="example@mail.com" />

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                </div>
                                                
                                                <button type="submit" class="sign-btn-main w-100 mt-14">{{ get_phrase('Send') }}</button>
                                                <p class="subtitle-form2 text-center mt-25">
                                                {{ get_phrase('Already have an account') }}?
                                                    <a href="{{ route('login') }}">{{ get_phrase('Login') }}</a>
                                                </p>
                                            </form>
                                        </div>
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
