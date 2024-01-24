@extends('backend.index')
@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="eSection-wrap">
            <div class="title">
                <h3>{{ get_phrase('Select a listing type') }}</h3>
            </div>
            <div class="row">
                @foreach($listing_types as $listing)
                @php
                if($listing->slug == 'real-estate'){
                    $route = route('admin.RealEstateCategoryPropertyAmenities');
                } else if($listing->slug == 'restaurant') {
                    $route = route('admin.RealEstateCategoryPropertyAmenities');
                } else {
                    $route = '#';
                }
                @endphp
                <div class="col-md-4">
                    <a class='list-category' href="{{ $route }}">
                        <div class="eCard">
                        <div class="eCard-body">
                        <h5 class="eCard-title">{{ $listing->title }}</h5>
                        </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
