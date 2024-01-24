<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubcriptionPayment;
use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Package;
use App\Models\SystemSetting;


use Omnipay\Omnipay;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Stripe;
use PaytmWallet;
use Session;
use Exception;

use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    /**
     * Show the offline payment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private $publicly_user_id;
    public function __construct()
    {
       
    }



    public function payWithPaypal_ForSubscription(Request $request)
    {

        $gateway;
        $this->gateway = Omnipay::create('PayPal_Rest');

        $global_system_currency = SystemSetting::where('key', 'system_currency')->get()->toArray();
        $global_system_currency = $global_system_currency[0]['value'];

        $paypal_keys = json_decode(get_settings('paypal'));
      

        if ($paypal_keys->mode == "test") {
            
            $this->gateway->setClientId($paypal_keys->test_client_id);
            $this->gateway->setSecret($paypal_keys->test_secret_key);
            $this->gateway->setTestMode(true);
            
        } elseif ($paypal_keys->mode == "live") {
            
            $this->gateway->setClientId($paypal_keys->live_client_id);
            $this->gateway->setSecret($paypal_keys->live_secret_key);
            $this->gateway->setTestMode(false);
        }


        $user_data = $request->all();
        $success_url = $user_data['success_url'];
        $cancle_url = $user_data['cancle_url'];
         

        $user_data = implode(' ', array_map(function ($key, $value) {
            return "$key:$value";
        }, array_keys($user_data), $user_data));
          
        try {

            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' =>  $global_system_currency,
                'returnUrl' => route($success_url, ['user_data' => $user_data, 'response' => 'check']),
                'cancelUrl' => route($cancle_url, ['user_data' => $user_data, 'response' => 'check'])
            ))->send();


            if ($response->isRedirect()) {


                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }



    public function PayWithStripe_ForSubscription(Request $request)
    {

        $global_system_currency = SystemSetting::where('key', 'system_currency')->get()->toArray();
        $global_system_currency = $global_system_currency[0]['value'];

        $stripe_keys = json_decode(get_settings('stripe'));
        $STRIPE_KEY;
        $STRIPE_SECRET;


        if ($stripe_keys->mode == "test") {
            $STRIPE_KEY = $stripe_keys->test_key;
            $STRIPE_SECRET = $stripe_keys->test_secret_key;
        } elseif ($stripe_keys->mode == "live") {
            $STRIPE_KEY = $stripe_keys->public_live_key;
            $STRIPE_SECRET = $stripe_keys->secret_live_key;
        }

        $user_data = $request->all();
        $expense_type = $user_data['expense_type'];

        $amount = $user_data['amount'] * 100;
        $success_url = $user_data['success_url'];
        $cancle_url = $user_data['cancle_url'];
        $user_data = implode(' ', array_map(function ($key, $value) {
            return "$key:$value";
        }, array_keys($user_data), $user_data));

        try {

            Stripe\Stripe::setApiKey($STRIPE_SECRET);

            $session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' =>  $global_system_currency,
                        'product_data' => [
                            'name' =>  $expense_type,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' =>  route($success_url, ['user_data' => $user_data, 'response' => 'check request->all() to get the response ']) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' =>  route($cancle_url, ['user_data' => $user_data, 'response' => 'check request->all() to get the response ']) . '?session_id={CHECKOUT_SESSION_ID}',
            ]);


            return redirect($session->url);

          } catch (\Exception $e) {

              return $e->getMessage();
          }


    }


    public function string_to_array($user_data)
    {
        $user_data = explode(' ', $user_data);
        $recover_user_data = array();
        foreach ($user_data as $key => $value) {
            $length = strlen($value);
            $position = strpos($value, ':');
            $array_key = substr($value, 0, $position);
            $array_value = substr($value, $position + 1, $length);
            $recover_user_data[$array_key] = $array_value;
        }

        return $recover_user_data;
    }



    public function successfullyBecomeAnAgnet(Request $request, $user_data, $response)
    {

        $user_data = $this->string_to_array($user_data);

        $purchesed_package=Package::find($user_data['package_id']);
        $interval=strtolower($purchesed_package->interval);
        if($interval=='monthly')
               $expireDate=Carbon::now()->addMonths($purchesed_package->duration);
        elseif($interval=='yearly')
               $expireDate=Carbon::now()->addYears($purchesed_package->duration);
        elseif($interval=='days')
               $expireDate=Carbon::now()->addDays($purchesed_package->duration);

       


        if ($user_data['payment_method'] == 'paypal') {

            $paypal_response_from_api = $request->all();
            
            $paypal_payment_response = json_encode($paypal_response_from_api);

            $newPayment= new SubcriptionPayment();
            $newPayment->expense_type=$user_data['expense_type'];
            $newPayment->package_id=$user_data['package_id'];
            $newPayment->user_id=$user_data['user_id'];
            $newPayment->payment_method	= 'paypal';
            $newPayment->amount=$user_data['amount'];
            $newPayment->status='paid';
            $newPayment->transaction_keys=$paypal_payment_response;
            $done=$newPayment->save();

            if($done)
            {
                $newSubscription= new Subscription();
                $newSubscription->user_id=$user_data['user_id'];
                $newSubscription->subscription_payment_id=$newPayment->id;
                $newSubscription->status='active';
                $newSubscription->payment_method='paypal';
                $newSubscription->paid_amount=$user_data['amount'];
                $newSubscription->package_id=$user_data['package_id'];
                $newSubscription->expire_date=$expireDate;
                $newSubscription->save();
                config([
                    'mail.mailers.smtp.transport' => get_settings('smtp_protocol'),
                    'mail.mailers.smtp.host' => get_settings('smtp_host'),
                    'mail.mailers.smtp.port' => get_settings('smtp_port'),
                    'mail.mailers.smtp.username' => get_settings('smtp_user'),
                    'mail.mailers.smtp.password' => get_settings('smtp_pass'),
                    'mail.mailers.smtp.encryption' => get_settings('smtp_crypto'),
                    'mail.from.address' => $request->input('email'),
                    'mail.from.name' => get_settings('system_title'),
                ]);
                $subscription_details = Subscription::find($newSubscription->id);
                Mail::to(auth()->user()->email)->send(new SubscriptionMail($subscription_details));

                $customerUpdatedToAgent= User::find($user_data['user_id']);
                if( $customerUpdatedToAgent->is_agent==0)
                {
                    $customerUpdatedToAgent->is_agent=1;
                    $customerUpdatedToAgent->save();

                }

            }


            return redirect()->route('customerAccount')->with('message', 'Subscription  successfully completed');
        }



        if ($user_data['payment_method'] == 'stripe') {

            $stripe_keys = json_decode(get_settings('stripe'));
            $STRIPE_KEY;
            $STRIPE_SECRET;


            if ($stripe_keys->mode == "test") {
                $STRIPE_KEY = $stripe_keys->test_key;
                $STRIPE_SECRET = $stripe_keys->test_secret_key;
            } elseif ($stripe_keys->mode == "live") {
                $STRIPE_KEY = $stripe_keys->public_live_key;
                $STRIPE_SECRET = $stripe_keys->secret_live_key;
            }


            $stripe_api_response_session_id = $request->all();
            $stripe = new \Stripe\StripeClient($STRIPE_SECRET);
            $session_response = $stripe->checkout->sessions->retrieve($stripe_api_response_session_id['session_id'], []);
            $stripe_payment_intent = $session_response['payment_intent'];
            $stripe_session_id = $stripe_api_response_session_id['session_id'];

            $stripe_transaction_keys = array();
            $stripe_response['payment_intent']  = $stripe_payment_intent;
            $stripe_response['session_id'] = $stripe_session_id;
            $stripe_transaction_keys = $stripe_response;
            $stripe_payment_response = json_encode($stripe_transaction_keys);


            $newPayment= new SubcriptionPayment();
            $newPayment->expense_type=$user_data['expense_type'];
            $newPayment->package_id=$user_data['package_id'];
            $newPayment->user_id=$user_data['user_id'];
            $newPayment->payment_method	= 'stripe';
            $newPayment->amount=$user_data['amount'];
            $newPayment->status='paid';
            $newPayment->transaction_keys=$stripe_payment_response;
            $done=$newPayment->save();

            if($done)
            {
                $newSubscription= new Subscription();
                $newSubscription->user_id=$user_data['user_id'];
                $newSubscription->subscription_payment_id=$newPayment->id;
                $newSubscription->status='active';
                $newSubscription->payment_method='stripe';
                $newSubscription->paid_amount=$user_data['amount'];
                $newSubscription->package_id=$user_data['package_id'];
                $newSubscription->expire_date=$expireDate;
                $newSubscription->save();

                config([
                    'mail.mailers.smtp.transport' => get_settings('smtp_protocol'),
                    'mail.mailers.smtp.host' => get_settings('smtp_host'),
                    'mail.mailers.smtp.port' => get_settings('smtp_port'),
                    'mail.mailers.smtp.username' => get_settings('smtp_user'),
                    'mail.mailers.smtp.password' => get_settings('smtp_pass'),
                    'mail.mailers.smtp.encryption' => get_settings('smtp_crypto'),
                    'mail.from.address' => get_settings('system_email'),
                    'mail.from.name' => get_settings('system_title'),
                ]);
                $subscription_details = Subscription::find($newSubscription->id);
                $subject = 'New Mail from ';
                $user_email = auth()->user()->email;
                Mail::to($user_email)->send(new SubscriptionMail($subscription_details));
            }   
            $customerUpdatedToAgent= User::find($user_data['user_id']);
            if( $customerUpdatedToAgent->is_agent==0)
            {
                $customerUpdatedToAgent->is_agent=1;
                $customerUpdatedToAgent->save();

            }

            return redirect()->route('subscriptionDetails')->with('message', ' Subscription  successfully completed');
        }

    }

    public function failToBecomeAnAgnet(Request $request, $user_data, $response)
    {

        return redirect()->route('becomeAnAgentFor')->with('message', ' Subscription Failed!');

    }


}
