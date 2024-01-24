


<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.metas')
    <title>{{ get_phrase('Agent') }} | {{ get_phrase('Panel') }}</title>
    <!-- Bootstrap CSS -->
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
        padding:8px 0;
        font-size:14px;
    }
    .text-center{
       text-align:center;
    }
    .w-100{
        width:140px;
    }
</style>


<body>
    <div class="container">
        <div class="row">
           <div class="col-lg-12">
            <table class="table-content">
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: space-between; " >
                                <p style="font-size: 15px; font-weight: 500; color: #7B7F84;">{{ get_phrase('INVOICE') }}</p>
                            </div>
                            <div style="margin-top:30px; ">
                                <div>
                                    <p style="color:#0C141D; font-size: 16px; font-weight:600">{{ get_phrase('Dear').' '.auth()->user()->name }}</p>
                                    <p style="color:#7B7F84; font-size: 14px; margin-top:-10px;">{{ get_phrase('Please find below the invoice') }}</p>
                                </div>
                                <div style="color:#0C141D; font-size: 16px; font-weight:600">{{ get_phrase('Billing Address') }}</div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <p style="font-size: 15px; color: #7B7F84; line-height:25px;">
                                        {{ get_phrase('Country').': '.$country->name }}<br>
                                        {{ get_phrase('State').': '.$address->state }}<br>
                                        {{ get_phrase('Address line').': '.$address->addressline }}<br>
                                        {{ get_phrase('Zip Code').': '.$address->zipcode }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: 15px; color: #0C141D;">{{ get_phrase('Paid') }}</p>
                        </td>
                        <td class="w-100"></td>
                        <td class="w-100"></td>
                        <td class="w-100"></td>
                        <td>
                            <div>
                                <p style="color: #0C141D; font-size: 17px;">{{ get_phrase('Invoice no') }}</p>
                                <p style="font-size: 15px; color: #7B7F84;">{{ $subscriptionDetails->id }}</p>
                                <p style="font-size: 15px; color: #7B7F84;">{{ get_phrase('Date') }}</p>
                                <p style="font-size: 15px; color: #7B7F84;">{{ date('D, d-M-Y') }}</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered">
                       <thead>
                            <th><p>{{ get_phrase('ID') }}</p></th>
                            <th>{{ get_phrase('Package') }}</th>
                            <th>{{ get_phrase('Date') }}</th>
                            <th>{{ get_phrase('Total Amount') }}</th>
                            <th>{{ get_phrase('Paid Amount') }}</th>
                         </thead>
                        @php
                        $created_at = date('d-m-Y', strtotime($subscriptionDetails->created_at));
                        $expire_date = date('d-m-Y', strtotime($subscriptionDetails->expire_date));
                        @endphp
                        <tbody>
                            <tr>
                                <td>
                                    <p class="text-center">1</p>
                                </td>
                                <td class="w-100">
                                   <p class="text-center">{{ $subscriptionDetails->subscription_to_package->name }}</p>
                                </td>
                                <td class="w-100">
                                  <p class="text-center">{{ $created_at }}</p>
                                </td>
                                <td class="w-100">
                                   <p class="text-center">{{ currency($subscriptionDetails->subscription_to_package->price) }}</p>
                                </td>
                                <td class="w-100">
                                    <p class="text-center">{{ currency($subscriptionDetails->paid_amount) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-100"></td>
                                <td class="w-100"></td>
                                <td class="w-100"></td>
                                <td class="w-100">
                                    <p class="text-center">{{ get_phrase('Subtotal') }}</p>
                                </td>
                                <td class="w-100">
                                   <p class="text-center">{{ currency($subscriptionDetails->paid_amount) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-100"></td>
                                <td class="w-100"></td>
                                <td class="w-100"></td>
                                <td>
                                    <p class="text-center">{{ get_phrase('Grand Total') }}</p>
                                </td>
                                <td>
                                   <p class="text-center">{{ currency($subscriptionDetails->paid_amount) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
         </div>
    </div>
 </div>
 <script src="{{ asset('public/assets/global/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
