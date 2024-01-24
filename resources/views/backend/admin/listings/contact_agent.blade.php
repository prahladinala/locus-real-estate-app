
<style>
    .rel-ag-img{
        width: 120px;
        height: 120px;
    }
   .rel-ag-img img {
    height: 120px;
    border-radius: 5px;
    width: 120px;
    object-fit: cover;
    }
   .rel-ag-text h6{
    margin-bottom: 7px;
   }
   .rel-ag-text span{
     color: #0B162D;
   }
   .list-clear li{
    font-size: 14px;
    color: #0B162D;
   }
   .ag-ratings {
        font-size: 14px;
        gap: 10px;
        display: flex;
    }
   .ag-ratings i{
    color: #007BFF;
    margin-left: 5px;
   }
   .btn3{
    background: #007BFF !important;
    border-color: #007BFF !important;
   }
   .property-form .form-control{
    font-size: 14px;
    color: #0B162D;
   }
   .property-form label{
    font-size: 14px;
    color: #0B162D
   }
   .modal-title{
    color: #0B162D;
    font-size: 16px;
   }
</style>
<!-- Near By Modal End -->
<div class="row review-comments">
    <div class="col-md-10 mx-3 my-3">
        <div class="info l-32">
            <div class="d-flex rel-flex mb-3">
                <div class="rel-ag-img me-4">
                    <img src="{{ get_user_image($agent_id) }}" alt="photo">
                </div>
                <div class="rel-ag-text">
                    <h6> <span class="fw-normal">{{ get_phrase('Listing by') }}</span> {{ $agent_details->name }} </h6>
                    <div class="ag-ratings mb-0">
                        @php $summary=agent_review($agent_id) @endphp
                        <span class="mb-0">{{ $summary['rating'] }}  <i class="fa fa-star"></i></span>({{ $summary['review'].' '.get_phrase('reviews') }})
                    </div>
                    <div class="d-flex flex-wrap">
                        <ul class="list-clear">
                            <li>{{ get_phrase('Phone') }}: <span>{{ $agent_details->phone }}</span></li>
                            <li>{{ get_phrase('Email') }}: <span>{{ $agent_details->email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="property-form">
           <form action="{{route('mailAgent',['id' => $agent_id])}}" method="post">
               @csrf
                <div class="mb-20">
                    <label for="review" class="form-label">{{ get_phrase('Your Message') }}</label>
                    <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Type your keyword" required></textarea>
                </div>
                <button type="submit" class="btn2 btn btn-success btn3 mt-3">{{ get_phrase('Send') }}</button>
            </form>
        </div>
    </div>
</div>

<script>
    "use strict";

    function send_query(agent_id) {
    var message = $('#message').val();

    if (message != "") {

        $.ajax({
            url: '{{ route('mailAgent') }}',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                agent_id: agent_id,
                message: message
            },
            success: function (response) {
                console.log(response);
                if (response.status == 'success') {
                    toastr.success("Message sent to agent");
                } else {
                    toastr.error("Message send failed");
                }
            }
        });
    } else {
        toastr.error("Please fill up the field first");
    }
}

</script>