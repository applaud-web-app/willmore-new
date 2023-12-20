<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class AdminSendMail extends Mailable
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
        // dd($this->request);
        $template = EmailTemplate::where('id',7)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_MAILBODY_', nl2br($this->request['mail_msg']), $mailBody);
        
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        // $mailBody = str_replace('_IMAGE2_', asset('storage/app/mail_template/'.$template->image2), $mailBody);
        
        $AA['mailBody']= $mailBody;
        // dd($AA);
        $mData=mailDetail();
        // dd($mData);
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['email'])
                    // ->subject(@$template->email_subject ? $template->email_subject : $this->request['mail_sub'])
                    ->subject(@$this->request['mail_sub'])
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
