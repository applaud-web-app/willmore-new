<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;
class DisputeAdminMessage extends Mailable
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
        $template = EmailTemplate::where('id',31)->first();
        $mailBody = str_replace('_TOUSER_', $this->request['name'], $template->email_body);
        $mailBody = str_replace('_ADMINMESSAGE_', $this->request['meeasge'], $mailBody); 
        $mailBody = str_replace('http://_BTNLINK_/', $this->request['btn_link'], $mailBody);
        // $mailBody = str_replace('_IMAGE1_', "<img src=".asset('storage/app/mail_template/'.$template->image1).">", $mailBody);
        // $mailBody = str_replace('_IMAGE2_', "<img src=".asset('storage/app/mail_template/'.$template->image2).">", $mailBody);
        $AA['mailBody'] = $mailBody;
        $AA['logo_center']= 1;
        $mailSub = str_replace('_PROJECTNAME_', $this->request['project_title'], $template->email_subject);
        // dd(str_replace('_ADMIN_', $this->request['ADMIN'], $template->email_body));
        // dd($template->email_body,$mailBody);
        $mData=mailDetail();
        $mail=$this->view('mail.send_mail', $AA)
                    ->to($this->request['email'])
                    ->subject($mailSub);
                    if(@$this->request['files']){
                        foreach(@$this->request['files'] as $files){
                            $mail=$mail->attach(storage_path("app/public/dispute_file/" .@$files->file_name),['as'=>substr(@$files->file_name,strpos(@$files->file_name,'.')+1)]);
                        }
                    }
        return $mail=$mail->from(env('MAIL_SEND_FROM'),env('APP_NAME'));
    }
}
