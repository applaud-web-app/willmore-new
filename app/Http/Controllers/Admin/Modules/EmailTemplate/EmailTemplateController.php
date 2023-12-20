<?php

namespace App\Http\Controllers\Admin\Modules\EmailTemplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Storage;
class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {      
            if(!in_array(auth()->guard('admin')->user()->admin_type,['MA','AG'])){
                return redirect()->back()->with('error','You have no access to this menu');
            }
            return $next($request);
        });       
    }

    	/**
    *   Method      : emailTemplateList
    *   Description : This is use to show email Template List
    *   Author      : Pankaj
    *   Date        : 2020-NOV-13
    **/
    public function emailTemplateList(Request $request)
    {
    	try {
    		$data['template'] = EmailTemplate::orderBy('template_name')->get();
            // dd($data);
    		return view('admin.modules.email_template.template_list')->with($data);
    	} 
    	catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

     /**
    *   Method      : emailTemplateEdit
    *   Description : This is use to show email Template Edit
    *   Author      : Pankaj
    *   Date        : 2020-NOV-13
    **/
    public function emailTemplateEdit($id)
    {
    	try {
    		$data['template'] = EmailTemplate::where(['id'=>$id])->first();
            // dd($request()->all());
    		return view('admin.modules.email_template.template_edit')->with($data);
    	} 
    	catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    /**
    *   Method      : emailTemplateUpdate
    *   Description : This is use to Update email Template
    *   Author      : Pankaj
    *   Date        : 2020-NOV-13
    **/
    public function emailTemplateUpdate(Request $request)
    {
    	try {
            if($request->email_subject==null){
                return redirect()->back()->with('error','Mail Subject is required.');
            }
            $update['email_subject'] = $request->email_subject;
            $update['email_body'] = $request->email_body;
            if(@$request->image1){
                $image = $request->image1;
                $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                Storage::putFileAs('mail_template', $image, $filename);
                $update['image1'] = $filename;
            }
            if(@$request->image2){
                $IMAGE = $request->image2;
                $filename = time().'-'.rand(1000,9999).'.'.$IMAGE->getClientOriginalExtension();
                Storage::putFileAs('mail_template', $IMAGE, $filename);
                $update['image2'] = $filename;
            }
    		$template = EmailTemplate::where('id',$request->id)->first();
    		$template->update($update);
            // dd($update,$request->id,$template);
    		if (@$template) {
    			return redirect()->back()->with('success','Template successfully updated.');
    		}
    	} 
    	catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }
}
