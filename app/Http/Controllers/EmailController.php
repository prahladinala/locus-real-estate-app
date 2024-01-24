<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionMail;
use App\Models\Subscription;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
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
      
        $input = $request->all();
        if(get_settings('recaptcha_status')==1){
            $recaptcha_secret = get_settings('recaptcha_secretkey');
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$input['g-recaptcha-response']);
            $response = json_decode($response, true);
        }else{
            $response['success'] = true;
        }

        if($response['success'] === true)
        {
            // Retrieve user data from the request
            $name = $request->input('customer_name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $company = $request->input('company');
            $mailDescription = $request->input('description');

            // Compose the email content
            $subject = 'New Mail from ' . $name;
            $body = "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\n\n$mailDescription";

            // Send the email
            Mail::raw($body, function ($message) use ($email, $subject) {
                $message->from($email, get_settings('system_title'))
                    ->to(get_settings('system_email'))
                    ->subject($subject);
                   
            });
            // Return a response or redirect as desired
            return redirect()->back()->with('message','Email sent successfully.');
        } else {
            return redirect()->back()->with('error', 'You have to provide captcha');
        }
    }
}
