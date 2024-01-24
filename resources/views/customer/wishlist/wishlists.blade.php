@extends('customer.index')
@section('customerRightPanel')

<div class="col-lg-9">
    <div class="l_col_main">
        @if(count($listings) > 0)
        <!-- Table -->
        <div class="table-responsive">
            <table class="table eTable eTable-2">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th scope="col">{{ get_phrase('Image') }}</th>
                        <th scope="col">{{ get_phrase('Property ID') }}</th>
                        <th scope="col">{{ get_phrase('Price') }}</th>
                        <th scope="col">{{ get_phrase('Property Type') }}</th>
                        <th scope="col">{{ get_phrase('Remove') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ( $listings as $listing)

                    @php
                    $property_details=$listing->get_property_details($listing->listing_type_id,$listing->id);
                    $image= json_decode($listing->gallery,true);
                    if(!empty($image))
                    $image= $image[0];
                    else
                    $image='nophoto';



                    @endphp


                    <tr>
                        <td>
                            <div class="dl_thumb_img">
                                <a href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}">
                                    <img class="" src="{{ get_listing_image_or_video($listing->id,$image); }}" width="130" height="110" />
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_id">
                                <a href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}">
                                    <p>{{ $listing->property_id }}</p>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_price">
                                <p>{{ $listing->price }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_type">
                                <p>{{ $listing->type }}</p>
                            </div>
                        </td>


                        <td>
                            <div class="tRemoveIcon" onclick="confirmModal('{{ route('checkWishlistDelete', ['id' => $listing->id]) }}', 'undefined');">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Wishlist">
                                    <i class="fa-solid fa-trash-can"></i></span>
                            </div>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        @else
           @include('no_data_found')
        @endif
    </div>
    <!-- Pagination -->
    <div class="adminPanel-pagi pt-40">
        {!! $listings->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection
