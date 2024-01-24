@extends('auth.index')
@section('content')

<section class="sign-section mt-5">
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
                                    <div class="sign-wrap">
                                        <h3 class="title-form pb-14">{{ get_phrase('Careate New Password') }}</h3>
                                        <p class="subtitle-form pb-30">
                                        {{ get_phrase('Your new password must be different from previously used password') }}
                                        </p>
                                        <form id="reset_password" method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-sign">
                                                <div class="input-wrap pb-16">
                                                    <label for="newpassword" class="eForm-label">{{ get_phrase('Email') }}</label>
                                                    <input id="email" type="email" class="form-control eForm-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required  autocomplete="email" autofocus readonly>

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="input-wrap pb-16">
                                                    <label for="newpassword" class="eForm-label">{{ get_phrase('New Password') }}</label>

                                                    <input id="password" type="password" class="form-control eForm-control  @error('password') is-invalid @enderror" name="password"  autocomplete="new-password"  placeholder="********" aria-label="********" required />

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-wrap pb-16">
                                                    <label for="confirmpassword" class="eForm-label">{{ get_phrase('Confirm Password') }}</label>

                                                    <input id="password-confirm" type="password" class="form-control eForm-control" name="password_confirmation"  autocomplete="new-password"  placeholder="********"
                                                    aria-label="********" required>

                                                </div>
                                                <!-- Sign button -->
                                                <button type="submit" class="sign-btn-main w-100 mt-14">{{ get_phrase('Save') }}</button>
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
