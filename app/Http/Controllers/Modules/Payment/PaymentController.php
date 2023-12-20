<?php

namespace App\Http\Controllers\Modules\Payment;

use App\Models\Executor;
use App\Models\WillMaster;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\WillMasterPackage;
use App\Http\Controllers\Controller;
use App\Models\WillDownloadAccess;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;
use App\Models\Country;
use App\Models\Packages;
use App\Models\Payment;
use App\User;
use Auth;

class PaymentController extends Controller
{

    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        if(count($input)  && !empty($request['params']['razorpay_payment_id'])){
            try
            {
                $order  = $api->order->create([
                    'receipt' =>  @$request['params']['package_id']?@$request['params']['package_id']:rand(111111,999999),
                    'amount'  =>  $request['params']['totalAmount'],
                    'currency' => 'INR'
                    ]);
                    $order_id=$order->id;
                    if($order_id && $request['params']['page_type'] == 'P'){
                        //if($request['params']['page_type'] == 'P'){

                            if(@$request['params']['package_id'] == 4){

                                $createWill['user_id']      = Auth::id();
                                $createWill['start_date']   = date('Y-m-d');
                                $createWill['status']       = 1;
                                $will = WillMaster::create($createWill);
                                $locationWill = WillMaster::create($createWill);
                                $loiWill = WillMaster::create($createWill);

                                $pckg = Packages::where('id',@$request['params']['package_id'])->first();
                                $max_master_id = WillMasterPackage::max('master_will_id');
                                
                                if(@$max_master_id != null){
                                    $master_will_id = $max_master_id + 1;
                                }else{
                                    $master_will_id = 1;
                                }

                                $pckg1 = Packages::where('id',1)->first();
                                $pckg2 = Packages::where('id',2)->first();
                                $pckg3 = Packages::where('id',3)->first();

                                #insert for package 1
                                $onlineCreationPackage['will_master_id']  = $will->id;
                                $onlineCreationPackage['package_id']      = 1;
                                $onlineCreationPackage['master_will_id'] = @$master_will_id;
                                $onlineCreationPackage['package_price']   = @$pckg->package_price;
                                $pckg1 = WillMasterPackage::create($onlineCreationPackage);

                                #insert for package 2
                                $locationPackage['will_master_id']  = $locationWill->id;
                                $locationPackage['package_id']      = 2;
                                $locationPackage['master_will_id'] = @$master_will_id;
                                $locationPackage['package_price']   = @$pckg->package_price;
                                $pckg2 = WillMasterPackage::create($locationPackage);

                                #insert for package 3
                                $loiPackage['will_master_id']  = $loiWill->id;
                                $loiPackage['package_id']      = 3;
                                $loiPackage['master_will_id'] = @$master_will_id;
                                $loiPackage['package_price']   = @$pckg->package_price;
                                $pckg3 = WillMasterPackage::create($loiPackage);
                                
                            }else{
                                $createWill['user_id']      = Auth::id();
                                $createWill['start_date']   = date('Y-m-d');
                                $createWill['status']       = 1;
                                $will = WillMaster::create($createWill);

                                $pckg = Packages::where('id',@$request['params']['package_id'])->first();
                                $inputPackage['will_master_id']  = $will->id;
                                $inputPackage['package_id']      = @$request['params']['package_id'];
                                //$inputPackage['master_will_id']  = @$request['params']['package_id'];
                                $inputPackage['package_price']   = @$pckg->package_price;
                                $pckg = WillMasterPackage::create($inputPackage);
                            }

                            Payment::where('id',@$request['params']['payment_id'])->update([
                                'status'=>'1',
                                'razorpay_payment_id'=>@$request['params']['razorpay_payment_id'],
                                'description'=>"Package purchased of amount Rs ".@$pckg->package_price,
                            ]);
                        //}

                        $response['result']['status'] = true;
                        $response['result']['order_id'] = $order_id;
                        $response['result']['will_id'] = $will->id;

                        //Session::put('purchase_success',"Package purchased Successfully.");
                        return response()->json($response);
                    }
            }
            catch (\Exception $e)
            {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

    }

    public function storePayment(Request $request)
    {

        if(@$request->package_id){

            $pckg = Packages::where('id',@$request->package_id)->first();

            $creates['user_id']         = Auth::id();
            $creates['package_id']      = $request->package_id;
            $creates['price']           = @$pckg->package_price;
            $payment = Payment::create($creates);

            $response['status'] = true;
            $response['payment_id'] = $payment->id;
            return response()->json($response);
        }

    }

    public function successPayment($willID=null)
    {

        if(@$willID != null){

            $data['will'] = WillMasterPackage::with('packageDetail')->where('will_master_id',@$willID)->first();
            if(@$data['will']->master_will_id != null){
                $pckg = Packages::where('id',4)->first();
                $package_name = @$pckg ? @$pckg->package_name : '';
            }else{
                $package_name = @$data['will']->packageDetail ? @$data['will']->packageDetail->package_name : '';
            }
            $data['package_name'] = @$package_name;
            
            // Session::put('purchase_success',"You have successfully purchased package - ".@$package_name);
            Session::put('purchase_success',"You have successfully purchased the " .@$package_name. " package");
            return view('auth.success')->with(@$data);
        }

    }

}
