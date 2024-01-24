@extends('backend.index')
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gr-15">
                <div class="d-flex flex-column">
                    <h4>
                        {{ get_phrase('Directories') }}
                    </h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li>
                            <a href="#">
                                {{ get_phrase('Home') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ get_phrase('Listings') }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ get_phrase('All Directories') }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="eSection-wrap">
            @if(count($listings) > 0)
            <!-- Table -->
            <div class="table-responsive">
                <table class="table eTable eTable-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ get_phrase('Title') }}</th>
                            <th scope="col">{{ get_phrase('Categories') }}</th>
                            <th scope="col">{{ get_phrase('Location') }}</th>
                            <th scope="col">{{ get_phrase('Status') }}</th>
                            <th scope="col">{{ get_phrase('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listings as $listing)
                            @php
                            $createdAt = $listing->created_at;
                            $date = new DateTime($createdAt);
                            $formattedDate = $date->format('D, d-M-Y');
                            @endphp
                            <tr>
                                <th scope="row">
                                    <p class="row-number">{{ $loop->index + 1 }}</p>
                                </td>
                                <td>
                                    <div class="dAdmin_profile d-flex align-items-center min-w-250px">
                                        <div class="dAdmin_profile_name">
                                            <h4>{{ ucfirst($listing->title) }}</h4>
                                            <p>{{ $listing->listings_to_user->name }}</p>
                                            <p>{{ $formattedDate }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dAdmin_info_name min-w-150px">
                                        <p>{{ $listing->listing_to_listingtype->title }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dAdmin_info_name min-w-250px">
                                        <p>{{ $listing->address }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dAdmin_info_name min-w-100px">
                                        <?php if ($listing->status != 1): ?>
                                            <span class="eBadge ebg-danger">{{ get_phrase("Inactive") }}</span>
                                        <?php else: ?>
                                            <span class="eBadge ebg-success">{{ get_phrase("Active") }}</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="adminTable-action">
                                        <button type="button" class="eBtn eBtn-black dropdown-toggle table-action-btn-2" data-bs-toggle="dropdown" aria-expanded="false">{{ get_phrase('Actions') }}</button>
                                        <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('singlePropertyView', ['slug' => $listing->slug, 'id' => $listing->id]) }}" target="_blank">{{ get_phrase('View On Frontend') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:;" onclick="largeModal('{{ route('admin.contactAgent', ['id' => $listing->user_id]) }}', 'Contact Agent')">{{ get_phrase('Contact agent') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                @include('backend.admin.no_data_found')
            @endif
        </div>
    </div>
</div>
@endsection