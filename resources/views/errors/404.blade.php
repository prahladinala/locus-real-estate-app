@extends('global.index')
@section('content')
<div class="error-parent">
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center error_404">
                    <img src="{{ asset('public/assets/global/images/404.png') }}" alt="photo">
                    <h1>{{ get_phrase('Something Went Wrong') }}.</h1>
                    <p class="display-5">{{ get_phrase('Error 404 page not found') }}</p>
                    <a href="" class="listing-btn">{{ get_phrase('Go to Home') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
