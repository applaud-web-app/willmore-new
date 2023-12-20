<?php

use App\User;
use App\Models\Art;
use App\Models\PPF;
use App\Models\Bank;
use App\Models\Cash;
use App\Models\Demat;
use App\Models\Locker;
use App\Models\Jewelry;
use App\Models\Witness;
use App\Models\Executor;
use App\Models\Property;
use App\Models\Vehicles;
use App\Models\Insurance;
use App\Models\Liability;
use App\Models\WillMaster;
use App\Models\Contingency;
use App\Models\MutualFunds;
use App\Models\OtherAssets;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Models\ResidualAssets;
use App\Models\CashBeneficiaries;
use App\Models\WillDownloadAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\PropertyBeneficiaries;
use App\Models\UserAssetsBeneficiaries;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Modules\Message\MessageController;

// use Auth;

/**
* Method: timeDifference
* Description: Calculate the difference.
* Author: Pankaj
*/
function timeDifference($lastView=null) {
    if($lastView==null){
        return 'not viewed yet.';
    }
    $date1Timestamp = strtotime($lastView) ;
    $date2Timestamp = strtotime(date('Y-m-d h:i:s')) + 3600*12;
    $timeDiff = '';
    //Calculate the difference.
    $difference = $date2Timestamp - $date1Timestamp;
    $days = floor($difference / (60*60*24) );
    $month = floor($difference / (60*60*24*12) );
    $seconds = floor($difference);
    $minutes = floor($difference / 60);
    $hours = floor($difference / (60*60));
    $years = floor($difference / (60*60*24*365) );
    // echo "Days =>  $days - minutes => $minutes - months => $month - seconds => $seconds  hours=> $hours";

    if($month>12) {
        $timeDiff = $years." Years ago";
    }
    elseif ($days>30) {
        $timeDiff = $month." Months ago";
    }
    elseif ($hours>=24) {
        $timeDiff = $days." Days ago";
    }
    elseif ($minutes>60) {
        $timeDiff = $hours.' Hours ago';
    }
    elseif ($seconds>60) {
        $timeDiff = $minutes.' Minutes ago';
    }
    else {
        $timeDiff = $seconds.' Seconds ago';
    }
    return $timeDiff;
}

function getWillCount($will_id){
    $count = 0;
    $Beneficiaries = Beneficiaries::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $Executor = Executor::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    //Cash asset
    $cash = Cash::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $bank = Bank::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $jewelry = Jewelry::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    // $locker = Locker::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    //Property asset
    $commercialProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','C')->count();
    $residentialProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','R')->count();
    $landProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','L')->count();

    $demat = Demat::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $mutualFunds = MutualFunds::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $insurance = Insurance::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $ppf = PPF::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $vehicles = Vehicles::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $art = Art::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    $OtherAssets = OtherAssets::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $ResidualAssets = ResidualAssets::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $Liability = Liability::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    // $Contingency = Contingency::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $Witness = Witness::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$Executor > 0){
        $count = $count + 1;
    }
    if(@$Beneficiaries > 0){
        $count = $count + 1;
    }

    if(@$cash > 0){
        $count = $count + 1;
    }
    if(@$bank > 0){
        $count = $count + 1;
    }
    if(@$jewelry > 0){
        $count = $count + 1;
    }
    // if(@$locker > 0){
    //     $count = $count + 1;
    // }
    if(@$commercialProperty > 0){
        $count = $count + 1;
    }
    if(@$residentialProperty > 0){
        $count = $count + 1;
    }
    if(@$landProperty > 0){
        $count = $count + 1;
    }
    if(@$demat > 0){
        $count = $count + 1;
    }
    if(@$mutualFunds > 0){
        $count = $count + 1;
    }
    if(@$insurance > 0){
        $count = $count + 1;
    }
    if(@$ppf > 0){
        $count = $count + 1;
    }
    if(@$vehicles > 0){
        $count = $count + 1;
    }
    if(@$art > 0){
        $count = $count + 1;
    }
    if(@$OtherAssets > 0){
        $count = $count + 1;
    }
    if(@$ResidualAssets > 0){
        $count = $count + 1;
    }
    if(@$Liability > 0){
        $count = $count + 1;
    }
    // if(@$Contingency > 0){
    //     $count = $count + 1;
    // }
    if(@$Witness > 0){
        $count = $count + 1;
    }

    $data['count'] = $count;
    $data['total'] = 18;
    return $data;
}

function getLocationCount($will_id){
    $count = 0;
    $Beneficiaries = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','L')->whereIn('user_type',['B','E'])->count();
    //$Executor = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','L')->where('user_type','E')->count();
    $will = WillMaster::where('user_id',Auth::id())->where('id',@$will_id)->first();
    $willLocation = $will->will_location;

    // if(@$Executor > 0){
    //     $count = $count + 1;
    // }
    if(@$Beneficiaries > 0){
        $count = $count + 1;
    }
    if(@$willLocation != null){
        $count = $count + 1;
    }

    $data['count'] = $count;
    $data['total'] = 2;
    return $data;

}

function getAMDCount($will_id){
    $count = 0;
    $Beneficiaries = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','AMD')->whereIn('user_type',['B','E'])->count();
    //$Executor = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','L')->where('user_type','E')->count();
    $will = WillMaster::where('user_id',Auth::id())->where('id',@$will_id)->first();
    $willAMD = $will->amd_file;

    // if(@$Executor > 0){
    //     $count = $count + 1;
    // }
    if(@$Beneficiaries > 0){
        $count = $count + 1;
    }
    if(@$willAMD != null){
        $count = $count + 1;
    }

    $data['count'] = $count;
    $data['total'] = 2;
    return $data;

}

function getLOICount($will_id){
    $count = 0;
    $Beneficiaries = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','LI')->whereIn('user_type',['B','E'])->count();
    //$Executor = WillDownloadAccess::where('will_id',@$will_id)->where('access_type','LI')->where('user_type','E')->count();
    $will = WillMaster::where('user_id',Auth::id())->where('id',@$will_id)->first();
    $willLoi = $will->loi;
    $willLoiFile = $will->loi_file;

    // if(@$Executor > 0){
    //     $count = $count + 1;
    // }
    if(@$Beneficiaries > 0){
        $count = $count + 1;
    }
    if(@$willLoiFile != null){
        $count = $count + 1;
    }

    $data['count'] = $count;
    $data['total'] = 2;
    return $data;

}

function getCompleteWillUrl($will_id){

    $url=route('user.manage.executor',[@$will_id]);
    // $url=route('introduction',[@$will_id]);

    // $stepcount = getWillCount(@$will_id);
    // if(@$stepcount['count'] < 1){
    //     $url = route('introduction',[@$will_id]);
    //     return $url;
    // }

    $Executor = Executor::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$Executor < 1){
        $url = route('user.manage.executor',[@$will_id]);
        return $url;
    }

    $Beneficiaries = Beneficiaries::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$Beneficiaries < 1){
        $url = route('user.manage.beneficiaries',[@$will_id]);
        return $url;
    }

    $cash = Cash::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$cash < 1){
        $url = route('user.manage.cash',[@$will_id]);
        return $url;
    }

    $bank = Bank::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$bank < 1){
        $url = route('user.manage.bank',[@$will_id]);
        return $url;
    }

    $jewelry = Jewelry::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$jewelry < 1){
        $url = route('user.manage.jewelry',[@$will_id]);
        return $url;
    }

    $residentialProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','R')->count();
    if(@$residentialProperty < 1){
        $url = route('user.manage.residentials',[@$will_id]);
        return $url;
    }

    $commercialProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','C')->count();
    if(@$commercialProperty < 1){
        $url = route('user.manage.commercial',[@$will_id]);
        return $url;
    }

    $landProperty = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->where('type','L')->count();
    if(@$landProperty < 1){
        $url = route('user.manage.land',[@$will_id]);
        return $url;
    }

    $demat = Demat::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$demat < 1){
        $url = route('user.manage.demat',[@$will_id]);
        return $url;
    }

    $mutualFunds = MutualFunds::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$mutualFunds < 1){
        $url = route('user.manage.mutualFund',[@$will_id]);
        return $url;
    }

    $insurance = Insurance::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$insurance < 1){
        $url = route('user.manage.insurance',[@$will_id]);
        return $url;
    }

    $ppf = PPF::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$ppf < 1){
        $url = route('user.manage.ppf',[@$will_id]);
        return $url;
    }

    $vehicles = Vehicles::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$vehicles < 1){
        $url = route('user.manage.vehicles',[@$will_id]);
        return $url;
    }

    $art = Art::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$art < 1){
        $url = route('user.manage.art',[@$will_id]);
        return $url;
    }

    $OtherAssets = OtherAssets::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$OtherAssets < 1){
        $url = route('user.manage.otherAssets',[@$will_id]);
        return $url;
    }

    $ResidualAssets = ResidualAssets::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$ResidualAssets < 1){
        $url = route('user.manage.residualAssets',[@$will_id]);
        return $url;
    }

    $Liability = Liability::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    if(@$Liability < 1){
        $url = route('user.manage.liability',[@$will_id]);
        return $url;
    }

    // $locker = Locker::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    // if(@$locker < 1){
    //     $url = route('user.manage.residentials',[@$will_id]);
    //     return $url;
    // }


    return $url;
}

function checkWillExist($will_id){
    $count = 0;
    $cash = Cash::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $bank = Bank::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $jewelry = Jewelry::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    // $locker = Locker::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $property = Property::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $demat = Demat::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $mutualFunds = MutualFunds::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $insurance = Insurance::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $ppf = PPF::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $vehicles = Vehicles::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();
    $art = Art::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$cash > 0 || @$bank > 0 || @$jewelry > 0 || @$property > 0 || @$demat > 0|| @$mutualFunds > 0|| @$insurance > 0|| @$ppf > 0|| @$vehicles > 0|| @$art > 0){
        $count = 1;
    }

    if(@$count > 0){
        return true;
    }
    return false;
}


function checkWillAssetsExist($id=null){
    $count = 0;
    $CashBeneficiaries = CashBeneficiaries::where('beneficiar_id',@$id)->count();
    $PropertyBeneficiaries = PropertyBeneficiaries::where('beneficiar_id',@$id)->count();
    $UserAssetsBeneficiaries = UserAssetsBeneficiaries::where('beneficiar_id',@$id)->count();

    if(@$CashBeneficiaries > 0 || @$PropertyBeneficiaries > 0 || @$UserAssetsBeneficiaries > 0){
        $count = 1;
    }

    if(@$count > 0){
        return true;
    }
    return false;
}

function checkBeneficiarExist($will_id){
    $Beneficiaries = Beneficiaries::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$Beneficiaries > 0){
        return true;;
    }
    return false;
}

function checkExecutorsExist($will_id){
    $Executor = Executor::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$Executor > 0){
        return true;;
    }
    return false;
}

function checkWitnessExist($will_id){
    $Executor = Witness::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$Executor > 0){
        return true;;
    }
    return false;
}

function checkWitnessCount($will_id){
    $Witness = Witness::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    return $Witness;
}

function checkLiabilityExist($will_id){
    $Liability = Liability::where('user_id',Auth::id())->where('will_master_id',@$will_id)->count();

    if(@$Liability > 0){
        return true;;
    }
    return false;
}

function checkWillAccess($will_id){

    $existWillAccess = WillDownloadAccess::where('will_id', @$will_id)->count();

    if(@$existWillAccess > 0){
        return true;
    }
    return false;
}

function checkCodeExist($will_code){

    $data['will_code'] = Session::get('will_code');
    $code = $data['will_code'];
    $WillCode = WillMaster::where('will_code',@$code)->first();

    if(@$WillCode->will_code == $will_code){
        return true;
    }
    return false;
}

function getTitle($val=null){
    if($val == 'D' || $val == 'Female'){
        $title = 'Ms';
    }elseif($val == 'S' || $val == 'H' || $val == 'Male'){
        $title = 'Mr';
    }elseif($val == 'W'){
        $title = 'Ms';
    }else{
        $title = '-';
    }
    return $title;
}

function getRelation($val=null){
    if($val == 'S' || $val == 'D' || $val == 'W'){
        $title = 'Mr';
    }elseif($val == 'H'){
        $title = 'Ms';
    }else{
        $title = '-';
    }
    return $title;
}

function numberFormat($amt)
{
   return number_format($amt,2,'.','');
}

function verifyStatus($id){
    $chk = User::where(['status'=>'A','id'=>$id])
            // ->whereIn('dignity_level',['L1','L2','L3','L4'])
            ->where(function($q){
                $q->where('is_mobile_verified', 'Y')
                ->where('govt_id_verified', 'Y')
                ->where('is_email_verify', 'Y')
                // ->where('is_payment_verified', 'Y')
                ->whereNotNull('linked_id')
                ->where('profile_percent', 100);
            })
            ->first();
    if(@$chk){
        return 'Y';
    }
    return 'N';
}

function mailDetail()
{
    $data['app_name']='WillAndMore';
    $data['mail_name']='noreply@willandmore.com';
    return $data;
}

function sendmsg($number,$message){
    try{
        $apiKey = urlencode('NTE3NDMxNDg2MjZlMzU0NDRiNzg0NDM1NjI0NzQ4NTY=');
        $num = '91'.$number;
        $numbers = urlencode($num);
        $sender = urlencode('BRMSGS');
        // $message = 'Use '.$otp.' OTP to verify your mobile number.';
        $message = $message;


        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;

        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }catch(Exception $e){
        return '';
    }
}


function authenticateCountryApi(){
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.universal-tutorial.com/api/getaccesstoken",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "api-token: ".getenv('COUNTRY_DROPDOWN_API_KEY'),
        "user-email: ".getenv('COUNTRY_DROPDOWN_API_EMAIL')
    ],
    ]);
    $token = '';
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    }else {
        $resp = json_decode($response);
        $token = $resp->auth_token;
    }
    return $token;
}


function getCountryFromApi(){
    try{

        $token = authenticateCountryApi();
        if($token==''){
            return [];
        }
        $countries = [];
        $curl1 = curl_init();
        curl_setopt_array($curl1, [
            CURLOPT_URL => "https://www.universal-tutorial.com/api/countries/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Bearer $token",
            ],
        ]);
        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        if (!$err1) {
            $countries = json_decode($response1);
        }
        return $countries;
        
    }catch(\Exception $e){
        return [];
    }
}

function getStateFromApi($country){
    try{
        $token = authenticateCountryApi();
        if($token==''){
            return [];
        }
        $states = [];
        $curl1 = curl_init();
        curl_setopt_array($curl1, [
            CURLOPT_URL => "https://www.universal-tutorial.com/api/states/".$country,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: Bearer $token",
            ],
        ]);
        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        if (!$err1) {
            $states = json_decode($response1);
        }
        return $states;
    }catch(\Exception $e){
        return [];
    }
}
