@extends('customer.index')
@section('customerRightPanel')

@php
    isset($typeButton) ? "" : $typeButton ="Type";
    isset($visibilityButton) ? "" : $visibilityButton ="Visibility";
@endphp

<div class="col-lg-9">
    <div class="l_col_main">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center flex-wrap pt-26 pb-30 mb-16 bd-b-1">
            <form action="{{ route('showMyListings',['type' => Session::get('listing_type_id') ]) }}" method="get">
                <div class="tableTitle-3 d-flex flex-wrap g-20">


                    <div class="adminTable-action">
                        <button type="button" id="Type_button" class="eBtn-table dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ ucfirst($typeButton) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action listingType" >
                            <li>
                                <a class="dropdown-item" data-listingType="all" href="javascript:void(0)" >{{ get_phrase('All') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-listingType="sell" href="javascript:void(0)" >{{ get_phrase('Sell') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-listingType="rent" href="javascript:void(0)" >{{ get_phrase('Rent') }}</a>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden"  name="listing_type" id="listing_type" value="all">
                    <input type="hidden"  name="status" id="status" value="all">
                    <input type="hidden"  name="action" id="action" value="filter">
                    <input type="hidden"  name="type_tag" id="type_tag" >
                    <input type="hidden"  name="status_tag" id="status_tag" >

                    <!-- Visibility -->
                    <div class="adminTable-action">
                        <button type="button" id="visibility_button" class="eBtn-table dropdown-toggle table-action-btn-2 w-110" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ ucfirst($visibilityButton) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action listingStatus">
                            <li>
                                <a class="dropdown-item" data-listingStatus="all" href="javascript:void(0)" >{{ get_phrase('All') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-listingStatus="1" href="javascript:void(0)" >{{ get_phrase('Visible') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-listingStatus="0" href="javascript:void(0)" >{{ get_phrase('Hidden') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Filter -->
                    <button type="sybmit" class="table-filter-btn">
                        {{ get_phrase('Filter') }}
                    </button>
                </div>
            </form>
            <!-- Button -->
            <a href="{{ route('add_listings_view', ['type' => 1]) }}" class="add-listing cg-10"><i class="fa-solid fa-plus"></i> {{ get_phrase('Add listings') }}</a>
        </div>
        @if(count($listings) > 0)
        <!-- Table -->
        <div class="table-responsive">
            <table class="table eTable eTable-2 table-pt0">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th scope="col">{{ get_phrase('Image') }}</th>
                        <th scope="col">{{ get_phrase('Property ID') }}</th>
                        <th scope="col">{{ get_phrase('Price') }}</th>
                        <th scope="col">{{ get_phrase('Property Type') }}</th>
                        <th scope="col">{{ get_phrase('Status') }}</th>
                        <th scope="col">{{ get_phrase('Remove') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ( $listings as $listing )

                    @php
                        $property_details=$listing->get_property_details($listing->listing_type_id,$listing->id);
                        $image= json_decode($listing->gallery,true);
                        if(!empty($image))
                            $image= $image[0];
                        else
                            $image='';
                    @endphp

                    <tr>

                        <td>
                            <div class="dl_thumb_img">
                                <img class="" src="{{ get_listing_image_or_video($listing->id,$image); }}" width="130" height="110"/>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_id">
                                <p>{{ $listing->property_id }}</p>
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
                            <div class="dl_property_type">
                                @if($listing->status==1)

                                <span class="badge bg-success">{{ get_phrase('Visible') }}</span>

                                @else
                                <span class="badge bg-danger">{{ get_phrase('Hidden') }}</span>

                                @endif

                            </div>
                        </td>
                        <td>
                            <div class="adminTable-action">
                                <button type="button" class="eBtn-table dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ get_phrase('Actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('editRealEstateListing',['id'=> $listing->id]) }}">{{ get_phrase('Edit Listing') }}</a>
                                    </li>
                                    @if($listing->status==1)
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="confirmModal('{{ route('hideRealEstateListing', ['id' => $listing->id]) }}', 'undefined');" >{{ get_phrase('Hide Listing') }}</a>
                                    </li>
                                    @else

                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="confirmModal('{{ route('showRealEstateListing', ['id' => $listing->id]) }}', 'undefined');" >{{ get_phrase('Visible') }}</a>
                                        </li>

                                    @endif
                                    <li>

                                        <a class="dropdown-item" href="javascript:void(0)" onclick="confirmModal('{{ route('deleteRealEstateListing', ['id' => $listing->id]) }}', 'undefined');" >{{ get_phrase('Remove Listing') }}</a>
                                    </li>
                                </ul>
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

@section('customerjs')
<script>

    "use strict";

    $('ul.listingType li').on('click',function(){
        var value=$(this).find('[data-listingType]').attr('data-listingType')
        var lbl='';
        $('#listing_type').val(value);
        if(value=='sell')
            lbl='Sell';
        else if(value=='rent')
            lbl='Rent';
        else if(value=='all')
            lbl='All';
        else
           lbl='Type';

       $("#Type_button").html(lbl);

       $('#type_tag').val(lbl)


    });

    $('ul.listingStatus li').on('click',function(){
        var value=$(this).find('[data-listingStatus]').attr('data-listingStatus')
        $('#status').val(value);
        var lbl='';
        if(value=='0')
            lbl='Hidden';
        else if(value=='1')
            lbl='Visible';
        else if(value=='all')
            lbl='All';
        else
           lbl='Visibility';

       $("#visibility_button").html(lbl);
       $('#status_tag').val(lbl)
    });
</script>
@endsection
