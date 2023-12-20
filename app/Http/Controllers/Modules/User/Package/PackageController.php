<?php

namespace App\Http\Controllers\Modules\User\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\WillMasterPackage;
use App\User;
use Auth;
use Mail;

class PackageController extends Controller
{

    public function index() 
    {
        $data['packages'] = Packages::get(); 
        $data['user'] = User::where('id',Auth::id())->first();
    	return view('modules.user.package.purchase_package')->with($data);
    }

    public function packageDetail(Request $request, $id=null) 
    {
        $data['packages'] = Packages::get(); 
        $data['packageDetail'] = Packages::find(@$id);
        
        if(!$data['packageDetail']){
            abort(404);
        }
        $data['user'] = User::where('id',Auth::id())->first();
    	return view('modules.user.package.package_detail')->with($data);
    }

    public function buyPackage(Request $request, $id=null) 
    {
        if($id==null || empty($id)){
            abort(404);
        }

        $createWill['user_id']      = Auth::id();
        $createWill['start_date']   = date('Y-m-d');
        $createWill['status']       = 1;
        $will = WillMaster::create($createWill);
        
        $inputPackage['will_master_id']  = $will->id;
        $inputPackage['package_id']      = $id;
        $pckg = WillMasterPackage::create($inputPackage);

        return redirect()->route('user.mywill')->with('success', 'Package purchased Successfully.');

    }

}
