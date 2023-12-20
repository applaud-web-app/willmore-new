<?php

namespace App\Http\Controllers\Admin\Modules\Reports;

use App\User;
use App\Models\Packages;
use App\Models\WillMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ConsultContactRequest;

class ReportsController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }

    /**
    *   Method      : signUpReports
    *   Description : Sign Up User Reports
    *   Author      : Sourav
    *   Date        : 31-DEC-2022
    **/
    public function signUpReports(Request $request){

        $data['users'] = User::where('status','!=','D')->orderBy('id', 'DESC');

        if ($request->all()) {

            $data['users'] = User::where('status','!=','D')->orderBy('id', 'DESC');


            if($request->from_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), ">=", date('Y-m-d',strtotime(@$request->from_date)));
            }
            if($request->to_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), "<=", date('Y-m-d',strtotime(@$request->to_date)));
            }

            $data['users'] = $data['users']->paginate(50);
            $data['tot_user'] = $data['users']->count();
            $data['key'] = $request->all();

            return view('admin.modules.reports.reports_on_signup')->with($data);
        }
        $data['users'] = $data['users']->paginate(50);
        return view('admin.modules.reports.reports_on_signup')->with($data);
    }

    /**
    *   Method      : servicesReports
    *   Description : All Service Reports
    *   Author      : Sourav
    *   Date        : 31-DEC-2022
    **/
    public function servicesReports(Request $request){

        $data['packages'] = Packages::all();

        if ($request->all()) {

            $data['wills'] = WillMaster::orderBy('id', 'DESC');

            if (@$request->package) {

                $data['wills'] = $data['wills']->whereHas('getPackage.packageDetail', function($q) use($request){

                    $q->where('id', $request->package);
               });
            }
            if($request->from_date){
                $data['wills'] = $data['wills']->where(DB::raw("(STR_TO_DATE(start_date,'%Y-%m-%d'))"), ">=", date('Y-m-d',strtotime(@$request->from_date)));
            }
            if($request->to_date){
                $data['wills'] = $data['wills']->where(DB::raw("(STR_TO_DATE(start_date,'%Y-%m-%d'))"), "<=", date('Y-m-d',strtotime(@$request->to_date)));
            }
            $data['tot_wills'] = $data['wills']->count();

            $data['wills'] = $data['wills']->paginate(50);
            $data['key'] = $request->all();

            return view('admin.modules.reports.reports_on_services')->with($data);
        }

    	return view('admin.modules.reports.reports_on_services')->with($data);
    }

    /**
    *   Method      : userReports
    *   Description : User Demographical Reports
    *   Author      : Sourav
    *   Date        : 31-DEC-2022
    **/
    public function userReports(Request $request){

        if ($request->all()) {

            $data['users'] = User::where('status','!=','D');

            if($request->from_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), ">=", date('Y-m-d',strtotime(@$request->from_date)));
            }
            if($request->to_date){
                $data['users'] = $data['users']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"), "<=", date('Y-m-d',strtotime(@$request->to_date)));
            }

            $data['users'] = $data['users']->get();
            $data['tot_male'] = $data['users']->where('gender','Male')->count();
            $data['tot_female'] = $data['users']->where('gender','Female')->count();
            $data['tot_user'] = $data['users']->count();

            $data['blow_40'] = $data['users']->where( 'dob', '>', Carbon::now()->subYears(40))->count();
            $data['age_40_50'] = $data['users']->where( 'dob', '<=', Carbon::now()->subYears(40))->where( 'dob', '>=', Carbon::now()->subYears(50))->count();
            $data['age_50_60'] = $data['users']->where( 'dob', '<=', Carbon::now()->subYears(50))->where( 'dob', '>=', Carbon::now()->subYears(60))->count();
            $data['above_60'] = $data['users']->where( 'dob', '<', Carbon::now()->subYears(60))->count();

            $data['key'] = $request->all();

            // dd($data['tot_female']);
            return view('admin.modules.reports.reports_on_user')->with($data);
        }

        $data['tot_male'] = User::where('status','!=','D')->where('gender','Male')->count();
        $data['tot_female'] = User::where('status','!=','D')->where('gender','Female')->count();
        $data['tot_user'] = User::where('status','!=','D')->count();
        $data['blow_40'] = User::where('status','!=','D')->where( 'dob', '>', Carbon::now()->subYears(40))->count();
        $data['age_40_50'] = User::where('status','!=','D')->where( 'dob', '<=', Carbon::now()->subYears(40))->where( 'dob', '>=', Carbon::now()->subYears(50))->count();
        $data['age_50_60'] = User::where('status','!=','D')->where( 'dob', '<=', Carbon::now()->subYears(50))->where( 'dob', '>=', Carbon::now()->subYears(60))->count();
        $data['above_60'] = User::where('status','!=','D')->where( 'dob', '<', Carbon::now()->subYears(60))->count();

        $data['blow_40s'] = User::where('status','!=','D')->where( 'dob', '>', Carbon::now()->subYears(40))->get();

        // dd($data['blow_40s']);
        return view('admin.modules.reports.reports_on_user')->with($data);
    }

}
