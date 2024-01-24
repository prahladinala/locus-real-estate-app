@extends('backend.index')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                <div class="d-flex flex-column">
                    <h4>
                        {{ get_phrase('Real Estate') }}
                    </h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">
                                {{ get_phrase('Home') }}
                            </a></li>
                        <li><a href="#">
                                {{ get_phrase('Real Estate') }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

@php
$categoryindex=1;
$propertryindex=1;
$amenityindex=1;
@endphp

<style>
    .export_btn {
        display: table-cell;
    }
    .eNav-Tabs-custom {
        overflow-x: inherit;
    }
</style>


<div class="row justify-content-center">
    <div class="col-9">
        <div class="eSection-wrap">

            <ul class="nav nav-tabs eNav-Tabs-custom" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($active_tab == 'category') active @endif" id="category-tab" data-bs-toggle="tab" data-bs-target="#categorytable" type="button" role="tab" aria-controls="categorytable" aria-selected="false">
                        {{ get_phrase('Property Type') }}

                        <span></span>
                    </button>
                </li>



                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($active_tab == 'amenity') active @endif" id="amenities-tab" data-bs-toggle="tab" data-bs-target="#amenitiestable" type="button" role="tab" aria-controls="amenitiestable" aria-selected="false">
                        {{ get_phrase('Property Amenities');}}

                        <span></span>
                    </button>
                </li>


            </ul>


            <div class="tab-content pb-2" id="nav-tabContent">
                <div class="tab-pane fade show @if($active_tab == 'category') active @endif" id="categorytable" role="tabpanel" aria-labelledby="category-tab">

                    <div class="d-flex justify-content-between">
                        <p class="list-count">{{ get_phrase('Total Property Type') }}: <span>{{ count($categories) }}</span></p> 
                        <div class="export-btn-area">
                            <a href="javascript:;" class="listing_btn" onclick="rightModal('{{ route('admin.RealEstateCategoryCreateModal') }}', 'Create Property')"> {{ get_phrase('Add Property Type') }}</a>
                        </div>
                    </div>

                    <div class="eForm-layouts">

                        <div class="table-responsive">

                            <table class="table eTable eTable-2">
                                @if(count($categories)>0)
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>

                                        <th scope="col">
                                            {{ get_phrase('Name') }}
                                        </th>
                                        <th scope="col" class="text-end">
                                            {{ get_phrase('Options') }}
                                        </th>
                                    </tr>

                                </thead>
                                @endif

                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td scope="row">


                                            <div class="dAdmin_profile d-flex align-items-center min-w-200px">

                                                <div class="dAdmin_profile_name">
                                                    <p class="row-number"> {{ $categoryindex++ }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dAdmin_profile d-flex align-items-center min-w-200px">

                                                <div class="dAdmin_profile_name">
                                                    <h4>{{ ucfirst($category->type) }} </h4>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="dAdmin_info_name min-w-200px">

                                                <div class="adminTable-action">
                                                        <button type="button" class="eBtn eBtn-black dropdown-toggle table-action-btn-2 " data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ get_phrase('Actions') }}
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('admin.RealEstateCategoryEditModal',['id'=> $category->id ]) }}', ' {{ get_phrase('Update property Type'); }}  ');">{{ get_phrase('Edit') }}</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.RealEstateCategoryDelete',['id'=> $category->id ]) }}', 'undefined')">{{ get_phrase('Delete') }}</a>
                                                            </li>


                                                        </ul>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @include('backend.admin.no_data_found')

                                    @endforelse

                                </tbody>
                            </table>


                        </div>




                    </div>
                </div>


                <div class="tab-pane fade show @if($active_tab == 'amenity') active @endif" id="amenitiestable" role="tabpanel" aria-labelledby="amenities-tab">

                    <div class="d-flex justify-content-between">
                        <p class="list-count">{{ get_phrase('Total Property Amenity') }}: <span>{{ count($amenities) }}</span></p> 
                        <div class="export-btn-area">
                            <a href="javascript:;" class="listing_btn" onclick="rightModal('{{ route('admin.RealEstateAmenityCreateModal') }}', 'Create Amenity')">   {{ get_phrase('Add Property Amenity') }}</a>
                        </div>
                    </div>

                    <div class="eForm-layouts">

                        <div class="table-responsive">

                            <table class="table eTable eTable-2">
                                @if(count($amenities)>0)
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>

                                        <th scope="col">
                                            {{ get_phrase('Name') }}
                                        </th>

                                        <th scope="col">
                                            {{ get_phrase('Icon') }}
                                        </th>

                                        <th scope="col" class="text-end">
                                            {{ get_phrase('Options') }}
                                        </th>
                                    </tr>

                                </thead>
                                @endif

                                <tbody>
                                    @forelse ($amenities as $amenity)
                                    <tr>
                                        <td scope="row">

                                            <div class="dAdmin_profile d-flex align-items-center">

                                                <div class="dAdmin_profile_name">
                                                    <p class="row-number"> {{ $amenityindex++ }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dAdmin_profile d-flex align-items-center min-w-200px">

                                                <div class="dAdmin_profile_name">
                                                    <h4>{{ ucfirst($amenity->type) }} </h4>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="dAdmin_profile d-flex align-items-center min-w-100px">

                                                <div class="dAdmin_profile_name">
                                                    <i class="{{ $amenity->font_awesome_class }}"></i>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="dAdmin_info_name min-w-200px">

                                                <div class="adminTable-action">
                                                    <button type="button" class="eBtn eBtn-black dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ get_phrase('Actions') }}
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('admin.RealEstateAmenityEditModal',['id'=> $amenity->id ]) }}', ' {{ get_phrase('Update property amenity'); }}  ');"> {{ get_phrase('Edit') }}</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('admin.RealEstatePropertyDelete',['id'=> $amenity->id ]) }}', 'undefined')"> {{ get_phrase('Delete') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @include('backend.admin.no_data_found')

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
