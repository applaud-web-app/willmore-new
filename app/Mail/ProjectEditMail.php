<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class ProjectEditMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request; 
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['data'] =  $this->request;
        // dd($data);
        $template = EmailTemplate::where('id',5)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_PROJECTID_', $this->request['projectid'], $mailBody);
        $mailBody = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailBody);
        $mailBody = str_replace('http://_BTNLINK_/', $this->request['link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
                    ->to($this->request['email'])
                    ->subject($template->email_subject)
                    ->from($mData['mail_name'],$mData['app_name']);
    }
}
