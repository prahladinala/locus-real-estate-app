@extends('customer.index')
@section('customerRightPanel')

<style>
     .zoom-modal .eBtn {
        font-size: 14px;
        height: 40px;
        width: 100px;
      }
    .zoom-modal h1{
        font-size: 16px !important;
    }
</style>

<div class="col-lg-9">
    <div class="l_col_main">
        <!-- Table -->
        <div class="table-responsive">
            <table class="table eTable eTable-2 table-icon">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th scope="col">{{ get_phrase('Time') }}</th>
                        <th scope="col">{{ get_phrase('Customer') }}</th>
                        <th scope="col">{{ get_phrase('Appointment Type') }}</th>
                        <th scope="col">{{ get_phrase('Property Id') }}</th>
                        <th scope="col">{{ get_phrase('Property Type') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($agentAppointments as $appointment )

                    @php
                    $listing=$appointment->appointment_to_listing;
                    $property_details=$listing->get_property_details($listing->listing_type_id,$listing->id);
                    @endphp

                    <tr>
                        <td>
                            <div class="dl_property_time d-flex flex-column g-8">
                                <p>{{ date('d-m-Y', strtotime($appointment->date)) }}</p>
                                <span class="eBadge">{{ $appointment->time; }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_id">
                                <p>{{ $appointment->appointment_to_customer->name }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_price">
                                <p>{{ $appointment->type }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_type d-flex flex-column g-8">
                                <p>{{ $listing->property_id }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="dl_property_type d-flex flex-column g-8">
                            <span class="eBadge">{{ $appointment->appointment_to_listing->type }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="tableIcons d-flex flex-wrap g-8">
                                <div class="tRemoveIcon" data-bs-toggle="modal" onclick="show('{{ $appointment->phone }}')" data-bs-target="#dlPhoneModal">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Phone Number">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                </div>
                                <div class="tRemoveIcon" data-bs-toggle="modal" onclick="show_email('{{ $appointment->email }}')" data-bs-target="#dlEmailModal">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Email Address">
                                        <i class="fa-solid fa-envelope"></i></span>
                                </div>
                                <div class="tRemoveIcon" onclick="viewproperty('<?= $appointment->appointment_to_listing->slug ?>', '<?= $appointment->listing_id ?>')" >
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Property Details">
                                        <i class="fa-solid fa-house"></i></span>
                                </div>
                                @if($appointment->type=='video')
                                <div class="tRemoveIcon"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="show_app('{{$appointment->id}}','{{$appointment->zoom_meeting_link}}')">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Join Meeting">
                                        <i class="fa-solid fa-video"></i></span>
                                </div>
                                @endif
                                <div class="tRemoveIcon" onclick="confirmModal('{{ route('deleteAppointment', ['id' => $appointment->id]) }}', 'undefined');">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                        <i class="fa-solid fa-trash-can"></i></span>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @empty

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination -->

    <div class="adminPanel-pagi pt-40">

        {!! $agentAppointments->links('pagination::bootstrap-4') !!}

    </div>
</div>




@endsection

@section('booking_page_modal')
    <!-- Modal Delete -->
    <div class="modal eModal fade" id="confirmSweetAlerts" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered sweet-alerts">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="icon icon-confirm">
                        <i class="fa-solid fa-exclamation"></i>
                    </div>
                    <p class="title">{{ get_phrase('Are you sure') }}?</p>
                    <p class="focus-text">{{ get_phrase("You won't able to revert this") }}!</p>
                    <div class="confirmBtn">
                        <button type="button" class="eBtn eBtn-green">
                            {{ get_phrase('Yes').', '.get_phrase('delete it') }}
                        </button>
                        <button type="button" class="eBtn eBtn-red" data-bs-dismiss="modal">
                            {{ get_phrase('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

   



    <!-- Zoom Modal Modal -->
<div class="zoom-modal">
    <div class="modal eModal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
             <form action="" method="POST" id="zoom">
             @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{get_phrase('Add Meeting Link')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="zoom_meeting_link" name="zoom_meeting_link" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="eBtn saveChanges-btn">{{get_phrase('Save')}}</button>
                        <span id="test"></span>
                    </div>
                </div>
             </form>
        </div>
    </div>
</div>
<!-- Modal -->

@endsection

@section('customerjs')

  <script>
    "Use strict";
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
   function show_app(value,link)
   {
        var url = '{{route('agent.zoom',':id')}}';
        url = url.replace(':id', value); 
        $('#zoom_meeting_link').val(link);
       $('#zoom').attr('action', url);
       if(link){
       $('#test').html("<a href='link' target='_blank' id='link' class='eBtn saveChanges-btn'>{{get_phrase('Join Now')}}</a>");
       }
       $('#link').attr('href', link);
   }

   function viewproperty(slug, listing_id)
   {
        var url = '{{ route("singlePropertyView", [":slug", ":id"]) }}';
        url = url.replace(':slug', slug);
        url = url.replace(':id', listing_id);
        window.open(url, '_blank');

   }

   function meeting(appointment_id)
   {
    var url = '{{ route("joinZoomAsAgent", ":id") }}';
            url = url.replace(':id', appointment_id);
            window.location.href = url;

   }

  </script>
@endsection
