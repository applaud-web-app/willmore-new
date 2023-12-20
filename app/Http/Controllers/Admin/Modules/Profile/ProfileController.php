<?php

namespace App\Http\Controllers\Admin\Modules\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Storage;
class ProfileController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }
  
  public function editProfile(Request $request){
    $id = Auth::guard('admin')->user()->id;
    $data['profile'] = Admin::where('id',$id)->first();
    if($request->all()){
        $update['name'] = $request->name;
        $update['mobile'] = $request->mobile;
        $update['email'] = $request->email;
        if(@$request->image){
            $image = $request->image;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('admin/profileImage', $image, $filename);
            @unlink(storage_path('app/admin/profileImage/'.$data['profile']->image));
            $update['image'] = $filename;
        }
        $updateProfile = Admin::where('id',$id)->update($update);
        if($updateProfile){
            return redirect()->back()->with('success','Profile updated Successfully.');
        }

    }
    return view('admin.modules.profile.edit_profile')->with($data);
}

  public function updatePassword(Request $request){
    $id = Auth::guard('admin')->user()->id;
    $data['profile'] = Admin::where('id',$id)->first();
    if($request->all()){
        if($request->password){
            if($request->password!=$request->cpassword){
                return redirect()->back()->with('error','Password & Confirm Password not matched.');
            }
            $update['password'] = \Hash::make($request->password);
            $updateProfile = Admin::where('id',$id)->update($update);
            if($updateProfile){
                return redirect()->back()->with('success','Password updated Successfully.');
            }
        }

    }
    return view('admin.modules.profile.change_password')->with($data);
}

}
