@extends('auth.index')
@section('content')
<section class="sign-section">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 d-none d-lg-block p-0">
                <div class="bg-image"></div>
            </div>
            <div class="col-lg-5 p-0 position-relative">
                <div class="parent-elem">
                    <div class="middle-elem">
                        <div class="primary-form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sign-wrap sign-wrap2">
                                        <h3 class="title-form pb-14">{{ get_phrase('Verify Your Email') }}</h3>
                                            <form id="resend" class="d-inline" method="POST" action="{{ route('verification.verify') }}">
                                                @csrf
                                                <div class="form-sign">
                                                   <div class="input-wrap pb-16">
                                                       <label for="code" class="eForm-label">{{ get_phrase('Verfication Code') }}</label>
                                                       <input type="text" id="code" name="code" class="form-control eForm-control @error('code') is-invalid @enderror" placeholder="enter your verification code"  required/>
                                                       @error('code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="sign-btn-main w-100 mt-14">{{ get_phrase('Verification') }}</button>
                                                </div>
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
</section>

@endsection
