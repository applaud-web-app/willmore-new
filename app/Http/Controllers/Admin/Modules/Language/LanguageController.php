<?php

namespace App\Http\Controllers\Admin\Modules\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
class LanguageController extends Controller
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
    *   Method      : manageLanguage
    *   Description : This is use to manageLanguage page
    *   Author      : Pankaj
    *   Date        : 2020-Aug-29
    **/
    public function manageLanguage(Request $request){
    	$data['language'] = Language::where('status','!=','D')->orderBy('created_at','desc');
        if ($request->all()) {
            if (@$request->keyword) {
                $data['language'] = $data['language']->where('language', 'like', '%' . $request->keyword . '%');
            }
            
            if (@$request->status) {
                $data['language'] = $data['language']->where('status', $request->status);
            }
        }
        $data['language'] = $data['language']->get();
        $data['key'] = $request->all();
    	return view('admin.modules.language.manage_language')->with($data);
    }

     /**
    *   Method      : createLanguage
    *   Description : This is use to createLanguage page
    *   Author      : Pankaj
    *   Date        : 2020-Aug-29
    **/
    public function createLanguage(Request $request,$id=null){
        if($request->all()){
            $request->validate([
                'language'        => 'required'
            ]);
            $chklang = Language::where('language',$request->language)->where('id','!=',@$request->ID)->where('status','!=','D')->count();
            if($chklang>0){
            	return redirect()->back()->with('error',$request->language.' Language already exits.');
            }
            $language['language'] = $request->language;
            $language['display_order'] = $request->display_order;
            if(@$request->ID){
                Language::where('id',$request->ID)->update($language);
                return redirect()->route('manage.language')->with('success','Language updated successfully.');
            }
            $language['status'] = 'A';
            Language::create($language);
            return redirect()->route('manage.language')->with('success','Language added successfully.');
        }
        $data['language'] = Language::where('id',@$id)->first();
        return view('admin.modules.language.create_language')->with(@$data);
    }

    /**
    *@ Method: chkLanguageExist
    *@ Description: Language unique check
    *@ Author: Pankaj
    *@ Date: 22-Sep-2020
    */
    public function chkLanguageExist(Request $request)
    {   
    	// dd($request->all());
    	 $response = [
            'jsonrpc' => '2.0'
        ];
        if(@$request->data['language']){
            if(@$request->ID){
                $response['result']['language'] = Language::where(['language' => trim($request->data['language'])])
						                                ->where('status', '!=', 'D')
						                                ->where('id','!=',$request->ID)
						                                ->first();
            } else {
                $response['result']['language'] = Language::where(['language' => trim($request->data['language'])])
						                                ->where('status', '!=', 'D')
						                                ->first();
            }
        }        
        return response()->json($response);
    }

        /**
    *   Method      : changeStatus
    *   Description : This is use to changeStatus
    *   Author      : Pankaj
    *   Date        : 2020-Aur-29
    **/
    public function changeStatus(Request $request , $id){
        $Language = Language::where('id',$id)->first();
        if(!$Language){
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
        if($Language->status=='A') {
            $update_status['status'] = 'I';
        }           
        if($Language->status=='I') {
            $update_status['status'] = 'A';
        }
        $Language->update($update_status);
        return redirect()->back()->with('success','Language status changed successfully.');
    }

    /**
    *   Method      : deleteLanguage
    *   Description : This is use to deleteLanguage
    *   Author      : Pankaj
    *   Date        : 2020-Aug-29
    **/
    public function deleteLanguage(Request $request , $id){
        $delLanguage = Language::where('id',$id)->first();
        if($delLanguage){
            Language::where('id',$id)->update(['status'=>'D']);
            return redirect()->back()->with('success','Language deleted successfully.');
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }
}
