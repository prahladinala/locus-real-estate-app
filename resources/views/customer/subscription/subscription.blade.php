@extends('customer.index')
@section('customerRightPanel')

<div class="subscription_div col-lg-9" id="subscription_body">
    @include('customer.subscription.subscription_details')
</div>

@endsection


<script type="text/javascript">

    "use strict"

    function renew_subscription() {
        let url = "{{ route('renewSubscription') }}";
        $.ajax({
            url: url,
            success: function(data){
                $('#subscription_body').html(data);
            }
        });
    }

    function purchase_package(id) {
        let url = "{{ route('purchasePackage', ['id' => ":id"]) }}";
        url = url.replace(":id", id);
        $.ajax({
            url: url,
            success: function(data){
                $('#subscription_body').html(data);
            }
        });
    }

    function go_back() {
        let url = "{{ route('subscriptionDetailsOnly') }}";
        $.ajax({
            url: url,
            success: function(data){
                $('#subscription_body').html(data);
            }
        });
    }

    function goto_packages() {
        let url = "{{ route('renewSubscription') }}";
        $.ajax({
            url: url,
            success: function(data){
                $('#subscription_body').html(data);
            }
        });
    }

</script>