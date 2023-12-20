<?php

namespace App\Http\Controllers\Admin\Modules\Faq;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!in_array(auth()->guard('admin')->user()->admin_type,['MA','AG'])){
                return redirect()->back()->with('error','You have no access to this menu');
            }
            return $next($request);
        });
    }
    public function create(Request $request)
    {
        $data=[];
        if($request->id){
            $data['faq']=Faq::where('id',$request->id)->first();
        }
        return view('admin.modules.faq.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            // 'display_order' => 'required',
        ]);

        $input['question']=$request->question;
        $input['answer']=$request->answer;
        // $input['display_order']=$request->display_order;
        // if(@$request->image){
        //     $image = $request->image;
        //     $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //     Storage::putFileAs('faq', $image, $filename);
        //     $input['image'] = $filename;
        //     if(@$request->id){
        //         $faq = Faq::where('id',$request->id)->first();
        //         @unlink(storage_path('app/faq/'.@$faq->image));
        //     }
        // }
        if($request->id){
            Faq::where('id',$request->id)->update($input);
            session()->flash("success", "FAQ updated successfully.");
        }else{
            Faq::create($input);
            session()->flash("success", "FAQ added successfully.");
        }
        return redirect()->back();
    }

    public function listing(Request $request)
    {
        $data['faq']= new Faq;
        if(@$request->all()){
            if (@$request->keyword) {
                $data['faq'] = $data['faq']->whereNested(function($q) use ($request){
                    $q->where('question', 'like', '%' . $request->keyword. '%')
                    ->orwhere('answer', 'like', '%' .$request->keyword. '%');
                });
            }
            if (@$request->type) {
                $data['faq'] = $data['faq']->where('type', $request->type);
            }
            $data['key'] = $request->all();
        }
        $data['faq']=$data['faq']->paginate(10);
        return view('admin.modules.faq.listing')->with($data);
    }

    public function delete(Request $request , $id){
        $faq = FAQ::where('id',$id)->first();
        if($faq){
            FAQ::where('id',$id)->delete();
            return redirect()->back()->with('success','FAQ deleted successfully.');
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }
}
