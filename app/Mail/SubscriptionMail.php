<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription_details)
    {
        $this->subscription_details = $subscription_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subscription Confirmation Mail')
                    ->view('emails.subscriptionMail');
    }
    
}
