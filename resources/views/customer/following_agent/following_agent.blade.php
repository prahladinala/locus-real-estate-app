@extends('customer.index')
@section('customerRightPanel')


<!-- Right Side -->
<div class="col-lg-9">
    <div class="l_col_main">
        @if(count($followingAgents) > 0)
        <!-- Table -->
        <div class="table-responsive">
            <table class="table eTable eTable-2 table-icon">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th scope="col">{{ get_phrase('Name') }}</th>
                        <th scope="col">{{ get_phrase('Phone') }}</th>
                        <th scope="col">{{ get_phrase('Email') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $followingAgents as $agent)


                    <tr>
                        <td>
                            <div class="dl_Agent_profile d-flex align-items-center g-12">
                                <div class="dl_Agent_img">
                                    <img class="img-fluid" src="{{ get_user_image($agent->id) }}" />
                                </div>
                                <div class="dl_Agent_name">
                                    <h4>{{ $agent->name }}</h4>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="dl_Agent_info d-flex align-items-center g-12">
                                <div class="icon wh-40 d-flex justify-content-center align-items-center border-round" data-bs-toggle="modal" onclick="show('{{ $agent->phone }}')" data-bs-target="#dlPhoneModal">
                                    <i class="fa-regular fa-address-book"></i>
                                </div>
                                <p>{{ $agent->phone }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_Agent_info d-flex align-items-center g-12">
                                <div class="icon wh-40 d-flex justify-content-center align-items-center border-round" data-bs-toggle="modal" onclick="show_email('{{ $agent->email }}')" data-bs-target="#dlEmailModal">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <p>{{ $agent->email }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_btn d-flex g-16">
                                <a href="{{ route('agentDetails',$agent->id) }}" class="eBtn viewDetails-btn">{{ get_phrase('View details') }}</a>

                                <a class="eBtn unfollow-btn" href="javascript:void(0)" onclick="confirmModal('{{ route('unfollowAgent', ['id' => $agent->id]) }}', 'undefined');" >{{ get_phrase('Unfollow') }}</a>
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
        {!! $followingAgents->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection

@section('booking_page_modal')
    <!-- Modal Phone -->
    <div class="modal eModal fade" id="dlPhoneModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered sweet-alerts">
            <div class="modal-content">
                <div class="modal-body dl-modal flex-row g-10">
                    <div class="icons"><i class="fa-solid fa-phone"></i></div>
                    <p id="show_value"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Email -->
    <div class="modal eModal fade" id="dlEmailModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered sweet-alerts">
            <div class="modal-content">
                <div class="modal-body dl-modal flex-row g-10">
                    <div class="icons"><i class="fa-solid fa-envelope"></i></div>
                    <p id="show_email_value"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customerjs')

<script type="text/javascript">

    "use strict";

    function show(value)
    {
        var phone='<a href="tel:'+value+'">'+value+'</a>';
        $('#show_value').html(phone);
    }

    function show_email(value)
    {
        var mail='<a href="mailto: '+value+'">'+value+'</a>';
        $('#show_email_value').html(mail);
    }


</script>

@endsection