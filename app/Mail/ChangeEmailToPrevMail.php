<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class ChangeEmailToPrevMail extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public function __construct($request, $type=null)
    {
        $this->request = $request;
        $this->type = $type;
    }
    public function build()
    {
        $data['data'] =  $this->request;
        // $email =  $this->request['email'];
        // dd($data);
        if(@$this->type){
            $toEmail = $this->request['temp_email'];
        }else{
            $toEmail = $this->request['email'];
        }
        $data['type'] = $this->type;


        $template = EmailTemplate::where('id',35)->first();
        $mailBody = str_replace('__TOUSER__', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_NEWEMAIL_', $this->request['newemail'], $mailBody);
        $mailBody = str_replace('_PREVEMAIL_', $this->request['prevemail'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody']= $mailBody;

        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
                    ->to($toEmail)
                    ->subject($template->email_subject)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
