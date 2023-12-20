<?php

namespace App\Mail;

use App\Models\AdminContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class ContactUsEmail extends Mailable
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
        $template = EmailTemplate::where('id',37)->first();
        $mailBody = str_replace('_NAME_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_EMAIL_', $this->request['email'], $mailBody);
        $mailBody = str_replace('_SUBJECT_', $this->request['subject'], $mailBody);
        $mailBody = str_replace('_MESSAGE_', $this->request['message'], $mailBody);
        $mailBody = str_replace('_OPTION_', $this->request['option'], $mailBody);
        // $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        // $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody']= $mailBody;
        $contact=AdminContact::first();
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to(@$contact->email)
                    ->subject($template->email_subject)
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
