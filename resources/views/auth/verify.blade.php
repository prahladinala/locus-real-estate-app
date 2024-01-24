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
                                        <p class="subtitle-form pb-30">

                                            @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                            @endif

                                            {{ __('Before proceeding, please check your email for a verification link.') }}

                                            <form id="resend" class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                @csrf
                                            </form>
                                            
                                            <a href="javascript:{}" onclick="document.getElementById('resend').submit();" class="sign-btn-main w-100 mt-14 m-width-408">{{ get_phrase('Resend') }}</a>
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
