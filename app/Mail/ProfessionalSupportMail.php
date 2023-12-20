<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class ProfessionalSupportMail extends Mailable
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
        $template = EmailTemplate::where('id',42)->first();
        $mailBody = str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_body);
        $mailBody = str_replace('_FREELANCER_', $this->request['name'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $mailSub = str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_subject);
        $mailSub = str_replace('_FREELANCER_', $this->request['name'], $mailSub);
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['to'])
                    ->subject($mailSub)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
