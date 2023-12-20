<?php

namespace App\Http\Controllers\Admin\Modules\Contant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsOption;
use App\Models\HomepageContent;
use App\Models\AdminContact;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Contant;
use App\Models\Logo;
use Storage;
class ContantController extends Controller
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

    public function manageTestimonials(Request $request)
    {
         $data['testimonial']= new Testimonial;
         $data['category'] = Category::where(['parent_id'=>0,'status'=>'A'])->get();
         if(@$request->all()){
             if (@$request->keyword) {
                 $data['testimonial'] = $data['testimonial']->whereNested(function($q) use ($request){
                     $q->where('name', 'like', '%' . $request->keyword. '%')
                     ->orwhere('title', 'like', '%' .$request->keyword. '%')
                     ->orwhere('problem', 'like', '%' .$request->keyword. '%')
                     ->orwhere('solution', 'like', '%' .$request->keyword. '%');
                 });
             }
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
         // dd($data);
         return view('admin.modules.contant.manage_testimonials')->with($data);
    }

    public function createTestimonials(Request $request)
   {
    $data=[];
    $data['category'] = Category::where(['parent_id'=>0,'status'=>'A'])->get();
    if($request->id){
        $data['testimonials']=Testimonial::where('id',$request->id)->first(); 
        $data['subcategory'] = Category::where(['status'=>'A'])->where('parent_id',$data['testimonials']->category_id)->get();
    }
    return view('admin.modules.contant.create_testimonials')->with($data);
   }

   public function storeTestimonials(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'problem' => 'required',
            'solution' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);
        $input['name']=$request->name;
        $input['title']=$request->title;
        $input['problem']=$request->problem;
        $input['solution']=$request->solution;
        $input['category_id'] = $request->category_id;
        $input['subcategory_id'] = @$request->subcategory_id ? $request->subcategory_id : 0;
        if($request->id){
            $slug=str_slug($request->title,"-");
            $chk=Testimonial::where('slug',$slug)->where('id','!=',$request->id)->first();
            if($chk){
                $input['slug']=$slug."-".($request->ID);
            }
            $input['slug'] = $slug;
        }else{
            $slug=str_slug($request->title,'-');
            $chk=Testimonial::where('slug',$slug)->first();
            if($chk){
                $maxid=Testimonial::max('id');
                $slug=$slug."-".($maxid+1);
            }
            $input['slug'] = $slug;
        }
        if(@$request->image){
            $image = $request->image;
            $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('testimonials', $image, $filename);
            if(@$request->id){
                $testimonial = Testimonial::where('id',$request->id)->first();
                @unlink(storage_path('app/testimonials/'.@$testimonial->image));
            }
            $input['image'] = $filename;
        }
        if($request->id){
            Testimonial::where('id',$request->id)->update($input);
            session()->flash("success", "Success Stories updated successfully.");
        }else{
            Testimonial::create($input);
            session()->flash("success", "Success Stories added successfully.");
        }
        return redirect()->back();
    }

    public function deleteTestimonials(Request $request , $id){
        $testimonial = Testimonial::where('id',$id)->first();
        if($testimonial){
            @unlink(storage_path('app/testimonials/'.@$testimonial->image));
            Testimonial::where('id',$id)->delete();
            return redirect()->back()->with('success','Success Stories deleted successfully.');
        } else {
            return redirect()->back()->with('error','Somthing went be wrong.');
        }
    }

    public function viewTestimonials(Request $request , $id){
        $testimonial = Testimonial::where('id',$id)->first();
        if($request->slug){
            $data['testimonial'] = Testimonial::where('slug',$request->slug)->first();
            return view('admin.modules.contant.view_testimonials')->with($data);
        }   
        return redirect()->back();
    }
}
