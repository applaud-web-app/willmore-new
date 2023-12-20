<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
class FreelancerApprovedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $template = EmailTemplate::where('id',48)->first();
        $mailBody = str_replace('_FREELANCERH_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_FREELANCER_', $this->request['name'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $AA['logo_center']= 1;
        // $mailSub = str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_subject);
        // $mailSub = str_replace('_FREELANCER_', $this->request['name'], $mailSub);
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['email'])
                    ->subject($template->email_subject)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
