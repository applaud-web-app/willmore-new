<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['data'] =  $this->request;
        // dd($this->request);
        $mData=mailDetail();
        return $this->view('mail.subscribe_request', $data)
                    ->to($this->request->to)
                    ->subject('DignifiedMe Subscription')
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
