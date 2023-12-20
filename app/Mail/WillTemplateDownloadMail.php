<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
class WillTemplateDownloadMail extends Mailable
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
        $files =  $this->request['files'];
        $template = EmailTemplate::where('id',49)->first();
        $mailBody = $template->email_body;
        $AA['mailBody']= $mailBody;
        $AA['logo_center']= 1; //1 For Center , other wise Right Aling
        $message =  $this->view('mail.send_mail',$AA)
                    ->to($this->request['email'])
                    ->subject($template->email_subject.' - '.date('d M Y H:i'));
        foreach($files as $file){
            $message->attach($file);
        }
        $message->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
        return $message;            
    }
}
