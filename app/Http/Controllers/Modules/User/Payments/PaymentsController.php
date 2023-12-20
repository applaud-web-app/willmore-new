<?php

namespace App\Http\Controllers\Modules\User\Payments;

use PDF;
use Mail;
use App\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CashBeneficiaries;
use App\Models\WillMaster;
use App\Models\WillMasterPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{

    public function myPayments(Request $request)
    {
        $data['payments'] = Payment::where('user_id',Auth::id());


        if($request->from_date){
            $data['payments'] = $data['payments']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"),'>=',date('Y-m-d',strtotime(@$request->from_date)));
        }

        if($request->to_date){
            $data['payments'] = $data['payments']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"),'<=',date('Y-m-d',strtotime(@$request->to_date)));
        }

        if($request->status == 1 || $request->status == 2 || $request->status == 3){
            $data['payments'] = $data['payments']->where('status',@$request->status);
        }

        $data['user'] = User::where('id',Auth::id())->first();
        $data['payments'] = $data['payments']->orderBy('id','desc')->paginate(10);
        $data['key'] = $request->all();

    	return view('modules.user.payment.my_payments')->with($data);
    }

    public function viewPayment(Request $request, $id=null)
    {
        if($id==null || empty($id)){
            abort(404);
        }

        $data['paymentDetail'] = Payment::with('getPackage')->where('id',@$id)->where('user_id',Auth::id())->first();
        $data['user'] = User::where('id',Auth::id())->first();

    	return view('modules.user.payment.view_payment')->with($data);
    }

    public function delete(Request $request , $id)
    {

        $del = Payment::where('id',$id)->where('user_id',Auth::id())->first();

        if($del)
        {
            Payment::where('id',$id)->where('user_id',Auth::id())->delete();

            return redirect()->back()->with('success','Payment deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

}
