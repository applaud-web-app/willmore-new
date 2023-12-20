<?php

namespace App\Http\Controllers\Admin\Modules\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Packages;
use App\Models\WillMaster;
use Mail;
#For Export To Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Excel;
use DB;

class UserController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }


    public function manageUser(Request $request){
    	$data['users'] = User::where('status','!=','D')->orderBy('id', 'DESC');
        if ($request->all()) {
            if (@$request->keyword) {
                $data['users'] = $data['users']->where(function($q) use($request){
                    $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orwhere('mobile', 'like', '%' . $request->keyword . '%')
                    ->orwhere('email', 'like', '%' . $request->keyword . '%')
                    ->orwhere('user_relation', 'like', '%' . $request->keyword . '%')
                    ->orwhere('relationship', 'like', '%' . $request->keyword . '%')
                    ->orwhere('relationship', 'like', '%' . $request->keyword . '%')
                    ->orwhere('city', 'like', '%' . $request->keyword . '%')
                    ->orwhere('state', 'like', '%' . $request->keyword . '%')
                    ->orwhere('address1', 'like', '%' . $request->keyword . '%');
                });
            }
            if($request->from_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), ">=", date('Y-m-d',strtotime(@$request->from_date)));
            }
            if($request->to_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), "<=", date('Y-m-d',strtotime(@$request->to_date)));
            }

            if (@$request->status == 'A' || @$request->status == 'I' || @$request->status == 'U') {
                $data['users'] = $data['users']->where('status', $request->status);
            }
        }

        $data['users'] = $data['users']->paginate(10);

        $data['key'] = $request->all();
    	return view('admin.modules.users.manage_user')->with($data);
    }

    public function changeStatus(Request $request , $id){
        $user = User::where('id',$id)->first();
        if(!$user){
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
        if($user->status=='A') {
            $update_status['status'] = 'I';
        }
        if($user->status=='I') {
            $update_status['status'] = 'A';
        }
        $user->update($update_status);
        return redirect()->back()->with('success','User status changed successfully.');
    }

    public function deleteUser(Request $request , $id){
        $deluser = User::where('id',$id)->first();
        if($deluser){
            User::where('id',$id)->update(['status'=>'D']);
            return redirect()->back()->with('success','User deleted successfully.');
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function viewUser(Request $request , $id){

        $data['user'] = User::where('id',$id)->first();
        if($data['user']){
            $data['wills'] = WillMaster::with('getPackage')->where('user_id',$id)->orderBy('id','desc')->paginate(10);
            return view('admin.modules.users.view_user')->with($data);
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function editUser(Request $request , $id){

        $userDetails = User::find(@$id);

        if($userDetails){
            return view('admin.modules.user.edit_user')->with(['user' => $userDetails ]);
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function updateUser(Request $request , $id)
    {
        $user = User::find(@$id);
        $current_email = $user->email;
        if(@$request->exam_page==1){
            $input['hourly_rate'] = @$request->hourly_rate ? $request->hourly_rate : 0.00;
            $input['currency'] = @$request->currency;
            $convt = CurrencyConversion::where('id',1)->first();
            if(@$request->currency==1){
                $input['hourly_INR'] = @$request->hourly_rate ? $request->hourly_rate : 0.00;
            }
            if(@$request->currency==2){
                $input['hourly_INR'] = $request->hourly_rate * $convt->conv_factor;
            }
            User::where('id', $user->id)->update($input);
            return redirect()->back()->with('success', 'Hourly rate updated successfully.');
        }
        $this->validate($request, [
            'first_name'  =>'required',
            'last_name'   =>'required',
            'address'     =>'required',
            'city'        =>'required',
            // 'state'       =>'required',
            'country_id'  =>'required',
            'zip_code'    =>'required|alpha_numeric',
            'work_exp'    =>'required',
        ]);
        $CNTROW = Country::where('id',$request->country_id)->first();
        $input['first_name']    = $request->first_name;
        $input['last_name']     = $request->last_name;
        $input['name']          = $request->first_name.' '.$request->last_name;
        $input['slug']          = str_slug($input['name']).'-'.$user->id;

        $input['mobile'] = $request->mobile;

        if(@$request->email){
            $user->temp_email = $request->email;
            $user->vcode = rand(10000,99999);
            $user->save();
        }
        // $DOB = \DateTime::createFromFormat('m-d-Y', $request->dob);
        // if($DOB){
        //   $DOB = \DateTime::createFromFormat('m-d-Y', $request->dob)->format('Y-m-d');
        //   $input['dob'] = $DOB;
        // }elseif(@$request->dob){
        //   $input['dob'] = date("Y-m-d",strtotime($request->dob));
        // } else{
        //   return redirect()->back()->with('error','Date of birth is invalid format');
        // }

        $input['address']       = $request->address;
        $input['city']          = $request->city;
        $input['state']         = $request->state_id;
        $input['zip_code']      = $request->zip_code;
        $input['country']       = $request->country_id;
        $input['pnonecode']     = '+'.$CNTROW->phonecode;
        $input['time_zone']     = $request->time_zone;
        $input['work_exp']      = $request->work_exp;
        $input['opportunity']      = $request->opportunity;
        $input['english_proficiency'] = $request->eng_proficiency;
        $input['edit_profile_complete'] = 'Y';
        $input['hourly_rate'] = @$request->hourly_rate ? $request->hourly_rate : 0.00;

        UserToLanguages::where('user_id',$user->id)->delete();
        if (!empty($request->other_language)){
            foreach ($request->other_language as $key => $row){
                $inputs['user_id'] = $user->id;
                $inputs['language_id'] =$row;
                $userLanguage = UserToLanguages::create($inputs);
            }
        }
        User::where('id', $user->id)->update($input);
        if(@$request->email){
            $creates['link'] = route('verify', [@$user->vcode,md5(@$user->id), 'type'=>'true']);
            $creates['name'] = $user->name;
            $creates['email'] = $user->temp_email;
            $prevemail['name']=$user->name;
            $prevemail['email']=$user->email;
            $prevemail['prevemail']=$user->email;
            $prevemail['newemail']=$user->temp_email;
            // Mail::send(new ChangeEmailToPrevMail($prevemail));
            // Mail::send(new UserEmailVerifyMail($creates));
        }
        if(@$request->email){
            return redirect()->back()->with('success', 'Profile updated successfully. A verification link has been sent to your mail '.@$request->email.', Please verify email.');
        }else{
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }
    }

    public function userMobileCheck(Request $request)
    {
        $user = User::where([
                    'mobile' => trim($request->mobile)
                ])
                ->where('id','!=',$request->user_id)
                ->where('status', '!=', 'D')
                ->first();

        if(@$user) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function userEmailCheck(Request $request)
    {
        $userCount = User::where('email', trim($request->email))->where('id','!=',$request->user_id)->where('status', '!=', 'D')->count();
        if(@$userCount>0) {
            return response('false');
        } else {
            return response('true');
        }
    }

    public function verifyUser($id){
        $user = User::find($id);
        $input['is_approve'] = 'Y';
        $data = User::where('id',$id)->update($input);

        #Notification : 6
        $notificationData['sender_id'] = Auth::id();
        $notificationData['receiver_id'] = $id;
        $notificationData['notification_title'] = "Digilancers admin has approved your profile";
        $notificationData['notification_msg'] = "Digilancers admin has approved your profile";
        $notificationData['page_link'] = route('user.basic.info');
        sendNotification($notificationData);

        $maildata['name'] = $user->username;
        $maildata['email'] = $user->email;
        Mail::send(new FreelancerApprovedMail($maildata));
        return redirect()->back()->with('success','Profile is approved successfully. ');
    }
}
