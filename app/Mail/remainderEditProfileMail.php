<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class remainderEditProfileMail extends Mailable
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
        $template = EmailTemplate::where('id',$this->request['id'])->first();
        $mailBody = str_replace('__TOUSER__', $this->request['name'], $template->email_body);
        $AA['mailBody'] = $mailBody;
        $mailSub =$template->email_subject;
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['to'])
                    ->subject($mailSub)
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
