<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class SubAdminWelcomMail extends Mailable
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
        $template = EmailTemplate::where('id',18)->first();
        $mailBody = str_replace('_SUB_ADMIN_', $this->request['ADMIN'], $template->email_body);
        $mailBody = str_replace('_NAME_', $this->request['name'], $mailBody);
        $mailBody = str_replace('_EMAIL_', $this->request['email'], $mailBody);
        $mailBody = str_replace('_PASSWORD_', $this->request['password'], $mailBody);
        $mailBody = str_replace('http://_LINK_/', $this->request['link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        // dd(str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_body));
        // dd($template->email_body,$mailBody);
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['to'])
                    ->subject($template->email_subject)
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
