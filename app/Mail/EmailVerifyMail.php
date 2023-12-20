<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class EmailVerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build()
    {
        $data['data'] =  $this->request;
        $template = EmailTemplate::where('id',2)->first();
        $mailBody = str_replace('__TOUSER__', $this->request['name'], $template->email_body);
        $mailBody = str_replace('http://__urllink__/', $this->request['link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody']= $mailBody;
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['email'])
                    ->subject($template->email_subject)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
