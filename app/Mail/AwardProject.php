<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class AwardProject extends Mailable
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
        // dd($data);
        $template = EmailTemplate::where('id',8)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_EMPLOYERUSERNAME_', $this->request['empusername'], $mailBody);
        $mailBody = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailBody);
        $mailBody = str_replace('http://_PROJECTLINK_/', $this->request['link'], $mailBody);
        $mailBody = str_replace('http://_PROFILELINK_/', $this->request['profile_link'], $mailBody);
        $mailBody = str_replace('http://_BTNLINK_/', $this->request['btn_link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $AA['logo_center']= 1;
        $mailSub = str_replace('_TOUSER_', $this->request['name'], $template->email_subject);
        $mailSub = str_replace('_EMPLOYERUSERNAME_', $this->request['empusername'], $mailSub);
        $mailSub = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailSub);
        $mailSub = str_replace('http://_PROJECTLINK_/', $this->request['link'], $mailSub);
        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
                    ->to($this->request['email'])
                    ->subject($mailSub)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
