<?php

namespace App\Http\Controllers\Modules\User\Will\LetterOfInstruction;

use Mail;
use App\User;
use App\Models\LOI;
use App\Models\Cash;
use App\Models\Country;
use App\Models\Witness;
use App\Models\Packages;
use App\Models\WillMaster;
use App\Models\Contingency;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Beneficiaries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAssetsBeneficiaries;

class LOIController extends Controller
{

    public function addLOI(Request $request, $willID=null)
    {
        if($willID==null || empty($willID)){
            abort(404);
        }

        if(checkBeneficiarExist($willID)== false || checkExecutorsExist($willID)== false || checkWitnessExist($willID)== false){
            return redirect()->route('user.service.authorized',[@$willID])->with('error','Please add atleast one executor and beneficiaries and witness to proceed');
        }

        $data['loi'] = LOI::where('will_master_id',@$willID)->where('user_id',Auth::id())->first();

        $data['will_id'] = $willID;

        $data['witness'] = Witness::where('will_master_id',@$willID)->where('user_id',Auth::id())->count();
        $data['cash'] = Cash::where('will_master_id',@$willID)->where('user_id',Auth::id())->where('status','A')->count();

    	return view('modules.user.will.letter_of_instruction.addLOI')->with($data);
    }

    public function saveLOI(Request $request)
    {
        $this->validate($request, [
          'instructions'   =>'required'
        ]);

        $creates['user_id']             = Auth::id();
        $creates['will_master_id']      = $request->will_id;
        $creates['instructions']       = $request->instructions;

        //dd($creates);
        $LOI = LOI::create($creates);

        if(@$request->SaveConti == 'SQ'){

            $cash = Cash::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$cash >0){
                return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Letter of Instruction added successfully');
            }
            return redirect()->route('user.add.cash',[@$request->will_id])->with('success', 'Letter of Instruction added successfully');
        }

        return redirect()->route('user.add.loi',[@$request->will_id])->with('success', 'Letter of Instruction added successfully');
    }

    public function updateLOI(Request $request)
    {
        if($request->loi_id==null || empty($request->loi_id)){
            abort(404);
        }

        $this->validate($request, [
            'instructions'   =>'required'
          ]);

          $creates['user_id']             = Auth::id();
          $creates['will_master_id']      = $request->will_id;
          $creates['instructions']       = $request->instructions;

          LOI::where('id', $request->loi_id)->where('user_id', Auth::id())->where('will_master_id', $request->will_id)->update($creates);

          if(@$request->SaveConti == 'SQ'){

            $cash = Cash::where('will_master_id',@$request->will_id)->where('user_id',Auth::id())->where('status','A')->count();
            if(@$cash >0){
                return redirect()->route('user.manage.cash',[@$request->will_id])->with('success', 'Letter of Instruction added successfully');
            }
            return redirect()->route('user.add.cash',[@$request->will_id])->with('success', 'Letter of Instruction added successfully');
        }

        return redirect()->route('user.add.loi',[@$request->will_id])->with('success', 'Letter of Instruction updated successfully');

    }

}
