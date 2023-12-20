<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class UserMessageMail extends Mailable
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
        $template = EmailTemplate::where('id',39)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_USERNAME_', $this->request['username'], $mailBody);
        $mailBody = str_replace('_PROJECT_TITLE_', $this->request['project_title'], $mailBody); 
        $mailBody = str_replace('http://_BTNLINK_/', $this->request['btn_link'], $mailBody);
        // $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        // $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $mailSub = str_replace('_USERNAME_', $this->request['username'], $template->email_subject);
        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
        ->to($this->request['email'])
        ->subject($mailSub)
        ->from($mData['mail_name'],$mData['app_name']);
    }
}
