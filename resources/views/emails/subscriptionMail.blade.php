<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{get_phrase('Subscription')}} | {{get_phrase('Payment')}} </title>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet"> 
</head>
<body style="margin:0; padding:0; font-family: 'Cabin', sans-serif;">
    <div class="email-container" style="background-color: #fff;">
        <table class="table-content" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 45px 30px 34px 30px ;  margin: auto; width: 600px;">
            <tbody>
                <tr>
                    <td>
                        <div class="inner-content">
                           <div class="inner-content-top">
                                <div class="feature-item" style="margin-top:30px; ">
                                     <div class="feature-text">
                                        <p style="color:#0C141D; font-size: 24px; font-weight:600">{{ get_phrase('Your Locus subscription receipt') }}</p>
                                     </div>
                                     <div style="display: flex; justify-content: space-between; align-items: center;">
                                         <div>
                                            <p style="font-size: 15px; color: #7B7F84;">{{ date('d M, Y') }}</p>
                                         </div>
                                         <div>
                                            <p style="color: #0C141D; font-size: 17px;">{{ get_phrase('Username') }}</p>
                                            <p style="font-size: 15px; color: #7B7F84;">{{ $subscription_details->subscription_to_user->name }}</p>
                                         </div>
                                     </div>
                                </div>
                           </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style="border:1px solid #E4E7EC; margin-top: 15px;" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                            <tr style="background-color: #E4E7EC;">
                               <th><p style="margin: 0; font-size: 16px; color: #0C141D;">{{ get_phrase('Package') }}</p></th>
                                <th><p style="margin: 0; font-size: 16px; color: #0C141D;">{{ get_phrase('Price') }}</p></th>
                                <th><p style="margin: 0; font-size: 16px; color: #0C141D;">{{ get_phrase('Paid') }}</p></th>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding:16px 0 ; border-bottom: 1px solid #E4E7EC;">
                                    <p style="margin: 0;  color: #0C141D; font-size: 15px;">{{ $subscription_details->subscription_to_package->name }}</p>
                                </td>
                                <td style="text-align: center; padding: 16px 0 ; border-bottom: 1px solid #E4E7EC;">
                                    <p style="margin: 0; font-size: 15px; color: #7B7F84;">{{ currency($subscription_details->subscription_to_package->price) }}</p>
                                </td>
                                <td style="text-align: center; padding: 16px  0; border-bottom: 1px solid #E4E7EC;">
                                    <p style="margin: 0; font-size: 15px; color: #7B7F84;">{{ currency($subscription_details->paid_amount) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 16px 0 ;">
                                    <p style="margin: 0; color: #0C141D; font-size: 15px;">{{ get_phrase('Total') }}</p>
                                </td>
                                <td style="text-align: center; padding: 16px 0 ;"> </td>
                                <td style="text-align: center; padding: 16px 0 ;">
                                    <p style="margin: 0; font-size: 16px; font-weight: 500; color: #007BFF;">{{ currency($subscription_details->paid_amount) }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <p style="font-size: 17px; color: #0C141D; margin: 0; margin-top: 20px;">{{ get_phrase('Payment Method') }}</p>
                        <p style="font-size: 15px; color: #7B7F84; margin: 0; margin-top: 6px;">{{ ucfirst($subscription_details->payment_method) }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>    