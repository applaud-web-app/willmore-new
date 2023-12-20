<?php

namespace App\Http\Controllers\Modules\User\Dashboard;

use App\User;
use App\Models\Packages;
use App\Models\WillMaster;
use Illuminate\Http\Request;
use App\Models\WillMasterPackage;
use App\Http\Controllers\Controller;
use App\Models\ConsultationPayment;
use App\Models\UserCalendlyEvent;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
class DashboardController extends Controller
{

    public function dashboard()
    {
        $data['user'] = User::where('id',Auth::id())->first();
        $data['packages'] = Packages::orderBy('id','asc')->get();
        $data['wills'] = WillMaster::with('getPackage')->where('user_id',Auth::id())->orderBy('id','desc')->get();

        $will_ids = WillMaster::where('user_id',Auth::id())->pluck('id');

        $data['totalWillPkg1'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',1)->count();
        $data['totalWillPkg2'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',2)->count();
        $data['totalWillPkg3'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',3)->count();
        $data['totalWillPkg5'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',5)->count();
        $data['totalWillPkg8'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',8)->count();

        $data['willTempDownload'] = WillMasterPackage::whereIn('will_master_id',@$will_ids)->where('package_id',8)->orderBy('id','DESC')->first();

    	return view('modules.user.dashboard.dashboard')->with($data);
    }

    public function consultation(){
        $userId = Auth::id();
        $consultations = UserCalendlyEvent::where('user_id',$userId)->count();
        $payments =  ConsultationPayment::where(['user_id'=>Auth::id(),'user_calendly_event_id'=>0])->count();
        if($consultations > 0){
            if($payments == 0){
                return redirect('consultation-events')->with('error','Pay Consultation Fee to continue.');
            }
        }
        return view('modules.user.dashboard.consultation',compact('consultations'));
    }

    public function storeCalendlyEventData(Request $request){
        $uri = $request->uri;
        $userId = Auth::id();
        $token = config('services.calendly_api.access_token');
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $uri,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer $token"
          ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return response()->json(['s'=>2]);
        } else {
            $dataS = json_decode($response,true);
            // dd($dataS);
            $data = $dataS['resource'];
            $calendly = new UserCalendlyEvent();
            $calendly->user_id = $userId;
            $calendly->calendly_uri = $uri;
            $calendly->event_guests = json_encode($data['event_guests']);
            $calendly->event_name = $data['name'];
            $calendly->start_time = date("Y-m-d H:i:s",strtotime($data['start_time']));
            $calendly->end_time = date("Y-m-d H:i:s",strtotime($data['end_time']));
            $calendly->event_type = $data['event_type'];
            $calendly->join_url = isset($data['location']) && $data['location']!=null ? (isset($data['location']['join_url']) ? $data['location']['join_url'] : null) : null;
            $calendly->save();
            $id = $calendly->id;

            // check if payment with 0 exists
            $checkPayment = ConsultationPayment::where(['user_id'=>Auth::id(),'user_calendly_event_id'=>0])->first();
            if($checkPayment){
                ConsultationPayment::where('id',$checkPayment->id)->update([
                    'user_calendly_event_id'=>$id
                ]);
            }
            return response()->json(['s'=>1,'url'=>url('consultation-events')]);
        }
    }

    public function consultationEvents(){
        $userId = Auth::id();
        $consultations = UserCalendlyEvent::select('calendly_uri','user_id','event_guests','event_name','start_time','end_time','event_type','join_url')->where('user_id',$userId)->orderBy('id','DESC')->paginate(50);
        $payments =  ConsultationPayment::where(['user_id'=>Auth::id(),'user_calendly_event_id'=>0])->count();
        return view('modules.user.dashboard.consultation-events',compact('consultations','payments'));
    }

    public function storeConsultationEventsPayment(Request $request){
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        if(count($input)  && !empty($request['params']['razorpay_payment_id'])){
            try
            {
                $paymentId = $request['params']['razorpay_payment_id'];
                $amountPaid = $request['params']['totalAmount'] / 100;
                $payObj = new ConsultationPayment();
                $payObj->user_id = Auth::id();
                $payObj->user_calendly_event_id = 0;
                $payObj->transaction_id = $paymentId;
                $payObj->amount_paid = $amountPaid;
                $payObj->save();
                return response()->json(['s'=>1]);
            }
            catch (\Exception $e)
            {
                return  $e->getMessage();
                return redirect()->back();
            }
        }
    }

}
