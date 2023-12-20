<?php

namespace App\Http\Controllers\Admin\Modules\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Admin;
use Auth;
use Storage;

class PackageController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }
  
  public function managePackage(Request $request){
    $data['packages'] = Packages::orderBy('id','asc')->paginate(10);
    return view('admin.modules.package.manage_package')->with($data);
}

public function editPackage(Request $request , $id=null, $type=null){

    $packageDetails = Packages::find(@$id);

    if($packageDetails){
        if(@$type == 'view'){
            return view('admin.modules.package.view_package')->with(['package' => $packageDetails ]);
        }else{
        return view('admin.modules.package.edit_package')->with(['package' => $packageDetails ]);
        }
    } else {
        return redirect()->back()->with('error','Somthing went be wrong.');
    }
}

public function updatePackage(Request $request){

    if(@$request->package_id){
        $input['package_price']    = $request->package_price;
        $input['package_desc']    = $request->package_desc;
        Packages::where('id', $request->package_id)->update($input); 
        return redirect()->back()->with('success','Package price updated successfully.');
    }
    else {
        return redirect()->back()->with('error','Somthing went be wrong.');
    }
}

}
