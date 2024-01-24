
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{get_phrase('Document')}}</title>
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/bootstrap.min.css') }}">
</head>
<style>
    .table-responsive{
        margin:auto;
    }
    .table-responsive .table th{
        padding:10px 0;
        border-bottom:1px solid #e3e4ea !important;
        font-size:15px;
        font-weight:500;
    }
    .table-responsive .table{
        border:1px solid #e3e4ea !important;
    }
    .table-responsive .table tr td{
        border-bottom:1px solid #e3e4ea !important;
    }
    .table-responsive .table tr td{
        padding:10px 0;
        font-size:14px;
    }
    .locus-div{
        text-align:center;
    }
    .locus-div h4{
        font-size:20px;
        font-weight:500;
        margin-bottom:15px;
    }
    .left{
        padding-left:10px !important;
    }
</style>
<body>
    <div class="subscription_table">
        <div class="conatiner">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($subscriptions) > 0)
                    <div class="table-responsive" id="subscription_report">
                        <div class="locus-div ">
                           <h4>{{get_phrase('Subscription Report')}}</h4>
                        </div>
                        <table class="table eTable table-bordered">
                            <thead>
                                <th class="left">#</th>
                                <th>{{ get_phrase('Package Name') }}</th>
                                <th>{{ get_phrase('price') }}</th>
                                <th>{{ get_phrase('User') }}</th>
                                <th>{{ get_phrase('Payment Method') }}</th>
                                <th>{{ get_phrase('Purchase Date') }}</th>
                                <th>{{ get_phrase('Expire Date') }}</th>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)

                                    <tr>
                                        <td class="left">{{ $loop->index + 1 }}</td>
                                        <td><strong>{{ $subscription->subscription_to_package->name }}</strong></td>
                                        <td>{{ $subscription->paid_amount }}</td>
                                        <td>{{ $subscription->subscription_to_user->name }}</td>
                                        <td>{{ $subscription->payment_method }}</td>
                                        <td>{{  $subscription->created_at->format('Y-m-d') }}</td>
                                        <td>{{  \Carbon\Carbon::parse($subscription->expire_date)->format('Y-m-d') }}</td>
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
    </div>
    <script src="{{ asset('public/assets/global/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>