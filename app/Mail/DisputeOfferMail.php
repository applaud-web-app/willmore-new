<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class DisputeOfferMail extends Mailable
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
        $template = EmailTemplate::where('id',26)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        // $mailBody = str_replace('_EMAIL_', $this->request['email'], $mailBody);
        $mailBody = str_replace('_USERNAME_', $this->request['username'], $mailBody);
        if(auth()->user()->user_type=="SS"){
            $mailBody = str_replace('receive', 'pay', $mailBody);
        }
        $mailBody = str_replace('_AMOUNT_', $this->request['amount'], $mailBody);
        $mailBody = str_replace('_TOTALAMOUNT_', $this->request['total_amount'], $mailBody);
        $mailBody = str_replace('_PROJECT_TITLE_', $this->request['project_title'], $mailBody);
        $mailBody = str_replace('http://_BTNLINK1_/', $this->request['accept_offer_link'], $mailBody);
        $mailBody = str_replace('http://_BTNLINK2_/', $this->request['counter_offer_link'], $mailBody);
        // $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        // $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $mailSub = str_replace('_USERNAME_', $this->request['username'], $template->email_subject);
        // dd(str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_body));
        // dd($template->email_body,$mailBody);
        $AA['logo_center']= 1;
        $mData=mailDetail();
        return $this->view('mail.send_mail', $AA)
                    ->to($this->request['email'])
                    ->subject($mailSub)
                    ->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
