<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class ProjectBidMail extends Mailable
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
        if(@$this->request['bid_type']){
            $template = EmailTemplate::where('id',17)->first();
        }else{
            $template = EmailTemplate::where('id',4)->first();
        }
        // dd($template);
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_BIDAMOUNT_', $this->request['amount'], $mailBody);
        $mailBody = str_replace('_EMPLOYERUSERNAME_', $this->request['freelancerusername'], $mailBody);
        $mailBody = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailBody);
        $mailBody = str_replace('http://_PROFILELINK_/', $this->request['emp_link'], $mailBody);
        $mailBody = str_replace('http://_PROJECTLINK_/', $this->request['project_link'], $mailBody);
        $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;

        $mailSub = str_replace('_TOUSER_', $this->request['name'], $template->email_subject);
        $mailSub = str_replace('_BIDAMOUNT_', $this->request['amount'], $mailSub);
        $mailSub = str_replace('_EMPLOYERUSERNAME_', $this->request['freelancerusername'], $mailSub);
        $mailSub = str_replace('_PROJECTNAME_', $this->request['projecttitle'], $mailSub);
        $mailSub = str_replace('http://_PROFILELINK_/', $this->request['emp_link'], $mailSub);
        $mailSub = str_replace('http://_PROJECTLINK_/', $this->request['project_link'], $mailSub);
        $mData=mailDetail();
        return $this->view('mail.send_mail',$AA)
                    ->to($this->request['email'])
                    ->subject($mailSub)
                    ->from($mData['mail_name'],$mData['app_name']);

        
    }
}
