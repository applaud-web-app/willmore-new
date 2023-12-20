<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class PrivateProjectAcceptMail extends Mailable
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
        $template = EmailTemplate::where('id',19)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_FREELANCERUSERNAME_', $this->request['freelancer_username'], $mailBody);
        $mailBody = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailBody);
        $mailBody = str_replace('http://_PROJECTLINK_/', $this->request['project_link'], $mailBody);
        $mailBody = str_replace('http://_BTNLINK_/', $this->request['btn_link'], $mailBody);
        $mailBody = str_replace('http://_PROFILELINK_/', $this->request['profile_link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;

        $mailSub = str_replace('_TOUSER_', $this->request['name'], $template->email_subject);
        $mailSub = str_replace('_FREELANCERUSERNAME_', $this->request['freelancer_username'], $mailSub);
        $mailSub = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailSub);
        $mailSub = str_replace('http://_PROJECTLINK_/', $this->request['project_link'], $mailSub);
        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
                    ->to($this->request['email'])
                    ->subject($mailSub)
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
