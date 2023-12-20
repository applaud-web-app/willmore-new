<?php

namespace App\Http\Controllers\Admin\Modules\Dashboard;

use App\User;
use Carbon\Carbon;
use App\Models\Packages;
use App\Models\WillMaster;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){

          $this->middleware('admin.auth:admin');
    }

    public function dashboard(){

        $data['totalUser'] = User::where('status','!=','D')->count();
        $data['totalWC'] = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',1);})->count();
        $data['totalLS'] = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',2);})->count();
        $data['totalLOI'] = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',3);})->count();
        $data['totalC'] = WillMaster::whereHas('getPackage.packageDetail', function($q){
            $q->where('id',4);})->count();

        $WC = Packages::where('id',1)->first();
        $LS = Packages::where('id',2)->first();
        $LOI = Packages::where('id',3)->first();
        $C = Packages::where('id',4)->first();

        $data['totalSell'] = ((@$WC->package_price * @$data['totalWC'])+(@$LS->package_price * @$data['totalLS'])+(@$LOI->package_price * @$data['totalLOI'])+(@$C->package_price * @$data['totalC']));

        return view('admin.modules.dashboard.dashboard')->with(@$data);
    }

}
