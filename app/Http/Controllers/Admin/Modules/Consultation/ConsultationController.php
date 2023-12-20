<?php

namespace App\Http\Controllers\Admin\Modules\Consultation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ConsultContactRequest;

class ConsultationController extends Controller
{
    public function __construct(){

        $this->middleware('admin.auth:admin');
  }


    public function manageConsultation(Request $request){

        $data['consultation'] = ConsultContactRequest::orderBy('id', 'DESC');

        if ($request->all()) {

            if (@$request->type) {
                $data['consultation'] = $data['consultation']->where('form_type', $request->type);
            }
            if($request->send_date){
                $data['consultation'] = $data['consultation']->where(DB::raw("(STR_TO_DATE(created_at,'%Y-%m-%d'))"),date('Y-m-d',strtotime(@$request->send_date)));
            }
        }

        $data['consultation'] = $data['consultation']->paginate(50);
        $data['key'] = $request->all();

    	return view('admin.modules.consultation.manage_consultation')->with($data);
    }

}
