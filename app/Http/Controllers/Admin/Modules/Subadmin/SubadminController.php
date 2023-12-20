<?php

namespace App\Http\Controllers\Admin\Modules\Subadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Mail\SubAdminWelcomMail;
use Storage;
use Auth;
use Mail;
class SubadminController extends Controller
{
    public function __construct(){

        $this->middleware(function ($request, $next) {      
            if(auth()->guard('admin')->user()->admin_type!='MA'){
                return redirect()->back()->with('error','You have no access to this menu');
            }
            return $next($request);
        });

           
  }

    public function manageSubadmin(){
        $data['subadmins'] = Admin::where('admin_type','!=','MA')->orderBy('id','desc')->paginate(10);
        return view('admin.modules.subadmin.manage_subadmin')->with($data);
    }
 
    public function createSubadmin(Request $request,$id=null){
        if($request->all()){
            if(@$request->ID){
                $request->validate([
                    'name' => 'required|regex:/^[A-Za-z ]+$/',
                    'email' => 'required|email',
                    'old_password' => 'nullable',
                    //'type' => 'required'
                ]);
                $subadmin = Admin::find($request->ID);

                if(@$request->password){
                    $request->validate([
                        'old_password' =>'required|min:6',
                        'password' =>'required|min:6|confirmed',
                        'password_confirmation' =>'required',
                    ]);
                    if (!Hash::check($request->old_password, $subadmin->password)) { 
                        return redirect()->back()->with('error','Current password does not match please try again!');                
                    }
                }
            
                $subadmin->name = $request->get('name');
                $subadmin->email = $request->get('email');
                //$subadmin->admin_type = $request->get('type');
                // $subadmin->mobile = $request->get('mobile');

                if(@$request->image){
                    $image = $request->image;
                    $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                    Storage::putFileAs('admin/profileImage', $image, $filename);
                    @unlink(storage_path('app/admin/profileImage/'.@$subadmin->image));
                    $subadmin->image = $filename;
                }
                $subadmin->save();
                return redirect()->back()->with('success','Sub-admin updated successfully.');
            } else {
                $request->validate([
                    'name' => 'required|regex:/^[A-Za-z ]+$/',
                    'email' => 'required|email|unique:admins',
                    'password' =>'required|min:6|confirmed',
                    'password_confirmation' => 'required',
                    //'type' => 'required'
                ]); 
                // dd($request->type);
                $subadmin = Admin::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    //'admin_type' => $request->type,
                    'status' => "A",
                ]);
                $subadmin->status = "A";
                $subadmin->save();
                if(@$request->image){
                    $image = $request->image;
                    $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                    Storage::putFileAs('admin/profileImage', $image, $filename);
                    $subadmin->image = $filename;
                    $subadmin->save();
                }
                $mailData['ADMIN'] = $request->get('name');
                $mailData['to'] = $request->get('email');
                $mailData['name'] = $request->get('name');
                $mailData['email'] = $request->get('email');
                $mailData['password'] = $request->get('password');
                $mailData['link'] = route('admin.login');
                //Mail::send(new SubAdminWelcomMail($mailData));
                return redirect()->back()->with('success','Sub-admin created successfully.');
            }
        }
        if(@$id){
            $subadmin = Admin::find($id);
            return view('admin.modules.subadmin.create_subadmin', compact('subadmin'));
        }
        return view('admin.modules.subadmin.create_subadmin');
    }

   
    public function activeSubadmin($id){
        $subadmin = Admin::find($id);
        if(@$subadmin->status == 'A'){
            $subadmin->status = 'I';
            $subadmin->save();
            return redirect()->back()->with('success','Sub-admin Inactivated.');
        } else {
            $subadmin->status = 'A';
            $subadmin->save();
            return redirect()->back()->with('success','Sub-admin Activated.');
        }
    }
 
    public function deleteSubadmin($id){
        $subadmin = Admin::find($id);
        @unlink(storage_path('app/admin/profileImage/'.@$subadmin->image));
        $subadmin->delete();
        return redirect()->back()->with('success','Sub-admin deleted successfully.');
    }

    public function adminEmailCheck(Request $request)
    {

     $user = Admin::where('email', trim($request->email))->where('status', '!=', 'D');
     if($request->id){
        $user=$user->where('id', '!=', trim($request->id));
     }
     $user=$user->first();
      if(@$user) {
          return response('false');
      } else {
          return response('true');
      }
    }
}
