<?php

namespace App\Http\Controllers\Modules\Contant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsEmail;
use App\Models\Contant;
use App\Models\Country;
use App\Models\Faq;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactUsOption;
use App\Models\Packages;
use App\Models\WillSearchEnquiry;
use Illuminate\Support\Facades\Validator;
use App\Rules\Captcha;
class ContantController extends Controller
{
     /**
    *   Method      : aboutUs
    *   Description : This is use to display About Us.
    *   Author      : Neha
    *   Date        : 23-Sep-2022
    **/
    public function aboutUs(Request $request)
    {
    	return view('modules.contant.about_us');
    }

    public function services(Request $request)
    {
        $data['packages'] = Packages::get();
    	return view('modules.contant.services')->with($data);
    }

    public function serviceDetail(Request $request, $id=null)
    {
        $data['id'] = $id;
        $data['packageDetail'] = Packages::find(@$id);
    	return view('modules.contant.service_detail')->with($data);
    }

    public function contactUs(Request $request)
    {
        $data['countrys'] = Country::get();
        return view('modules.contant.contact_us')->with($data);
    }

    public function contactUsPost(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => new Captcha(),
            'name'                 => 'required',
            'subject'              => 'required',
            'email'                => ['required', 'string', 'email', 'max:255'],
        ]);
        $maildata['email']  = $request->email;
        $maildata['name']   = $request->name;
        $maildata['subject'] = $request->subject;
        $maildata['message'] = $request->message;
        $maildata['option'] = $request->option;

        // dd($maildata);

        Mail::send(new ContactUsEmail($maildata));
        return redirect()->back()->with('success','Message sent successfully.');
    }

    public function faq()
    {
        // $data['faq_msg']=Contant::where('id',20)->first();
        $data['faqs']=Faq::orderBy('id','asc')->get();
        return view('modules.contant.faqs')->with(@$data);
    }

    public function othersFaq(Request $request)
    {
        $data['faq_msg']=Contant::where('id',20)->first();
        $data['faq']=Faq::where('type','OT')->orderBy('display_order')->get();
        return view('modules.contant.faq')->with($data);
    }

    public function testimonials(Request $request)
    {
        $data['testimonial']= new Testimonial;
        $data['category'] = Category::where(['parent_id'=>0,'status'=>'A'])->get();
        if(@$request->all()){
            if (@$request->category_id) {
                $data['testimonial'] = $data['testimonial']->where('category_id', $request->category_id);
                $data['subcategory'] = Category::where(['status'=>'A'])->where('parent_id',$request->category_id)->get();
            }
            if (@$request->subcategory_id) {
                $data['testimonial'] = $data['testimonial']->where('subcategory_id', $request->subcategory_id);
            }
            $data['key'] = $request->all();
        }
        $data['testimonial']=$data['testimonial']->get();
        return view('modules.contant.for_employer.testimonials')->with($data);
    }

    public function testimonialsDetails(Request $request)
    {
        $data=[];
        if (@$request->slug) {
            $data['testimonial'] =Testimonial::where('slug', $request->slug)->first();
            $data['testimonialCategory']=Testimonial::where('category_id', $data['testimonial']->category_id)->where('slug','!=',$request->slug)->paginate(3);
            // $data['testimonialCategory']=Testimonial::where('category_id', $data['testimonial']->category_id)->paginate(3);
        }
        return view('modules.contant.for_employer.testimonials_detail')->with($data);;
    }

    //terms
    public function privacyPolicy(Request $request)
    {
        // $data['template'] = SiteSetting::where('id',1)->first();
        return view('modules.contant.terms.privacy_policy');
    }
    public function termsAndConditions()
    {
        // $data['template'] = SiteSetting::where('id',2)->first();
    	return view('modules.contant.terms.term_and_condition');
    }
    public function termsOfServices()
    {
        // $data['template'] = SiteSetting::where('id',2)->first();
    	return view('modules.contant.terms.terms_of_services');
    }

    public function cookies()
    {
        $data['template'] = SiteSetting::where('id',3)->first();
        return view('modules.contant.terms.index')->with($data);
    }

    public function copyrightPolicy()
    {
        $data['template'] = SiteSetting::where('id',4)->first();
    	return view('modules.contant.terms.index')->with($data);
    }

    public function team(){

        return view('modules.contant.team');
    }

    public function teamDetail(){

        return view('modules.contant.team-detail');
    }

    public function prices(){

        return view('modules.contant.prices');
    }

    public function disclaimerPolicy(Request $request)
    {
        // $data['template'] = SiteSetting::where('id',1)->first();
        return view('modules.contant.terms.disclaimer_policy');
    }

    public function willEnquiryContact(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile_number'=>'required',
            'message'=>'required',
        ]);
        try{
            $willSearchObj = new WillSearchEnquiry();
            $willSearchObj->name = $request->name;
            $willSearchObj->email = $request->email;
            $willSearchObj->mobile_number = $request->mobile_number;
            $willSearchObj->message = $request->message;
            $willSearchObj->save();
            return response()->json(['s'=>1]);
        }catch(\Exception $e){
            echo $e->getMessage();die;
            return response()->json(['s'=>2]);
        }
        
    }
}
