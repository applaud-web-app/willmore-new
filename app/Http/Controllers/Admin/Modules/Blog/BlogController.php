<?php

namespace App\Http\Controllers\Admin\Modules\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!in_array(auth()->guard('admin')->user()->admin_type,['MA'])){
                return redirect()->back()->with('error','You have no access to this menu');
            }
            return $next($request);
        });
    }

	/**
    *   Method      : manageBlogCategories
    *   Description : This is use to manage blog categories page
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function manageBlogCategories(Request $request)
    {
    	$data['bogcatagory'] = BlogCategory::orderBy('created_at','desc');

    	if (@$request->keyword) {
                $data['bogcatagory'] = $data['bogcatagory']->where('category', 'like', '%' . $request->keyword . '%')
                                                    /*->orwhereHas('gerParentName',function($e) use ($request){
                                                        $e->where('name', 'like', '%' . $request->keyword . '%');
                                                    })*/;
            }

        $data['bogcatagory'] = $data['bogcatagory']->paginate(10);
        $data['key'] = $request->all();

    	return view('admin.modules.blog.manage_blog_categories')->with(@$data);
    }

    /**
    *   Method      : createBlogCategories
    *   Description : This is use to create blog categories.
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function createBlogCategories(Request $request,$id=null)
    {
    	// dd('test');
    	return view('admin.modules.blog.create_blog_categories');
    }

    /**
    *   Method      : saveBlogCategories
    *   Description : This is use to store blog categories.
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function saveBlogCategories(Request $request)
    {
    	$request->validate([
                'name'        => 'required',

            ]);

    	if ($request->blog_cata_id)
    	{

    		$imputs['category'] = $request->name;
    		$imputs['category_slug'] = str_slug($imputs['category']);
    		$catdata = BlogCategory::where('id',$request->blog_cata_id)->update($imputs);

    		return redirect()->back()->with('success','Category added successfully.');
    	}



    	$input['category'] = $request->name;
    	$input['category_slug'] = str_slug($input['category']);

    	$catdata = BlogCategory::create($input);

    	return redirect()->back()->with('success','Category added successfully.');



    }

    /**
    *@ Method: chkBlogCategoryExist
    *@ Description: Blog Category unique check
    *@ Author: Partha
    *@ Date: 28-12-2020
    */
    public function chkBlogCata(Request $request)
    {

     $user = BlogCategory::where([
                  'category' => trim($request->name)
                ])->first();

      if(@$user) {
          return response('false');
      } else {
          return response('true');
      }

    }

    // /**
    // *@ Method: chkBlogCategoryExist
    // *@ Description: Blog Category unique check
    // *@ Author: Partha
    // *@ Date: 28-12-2020
    // */
    // public function chkBlogCategoryExist(Request $request)
    // {
    //     // dd($request->all());
    //      $response = [
    //         'jsonrpc' => '2.0'
    //     ];
    //     if(@$request->data['name']){
    //         if(@$request->id){
    //             $response['result']['category'] = BlogCategory::where(['category' => trim($request->data['name']),'parent_id'=>@$request->data['parent_id']])
    //                                                     ->where('status', '!=', 'D')
    //                                                     ->where('id','!=',$request->id)
    //                                                     ->first();
    //         } else {
    //             $response['result']['category'] = BlogCategory::where(['category' => trim($request->data['name']),'parent_id'=>@$request->data['parent_id']])
    //                                                     ->where('status', '!=', 'D')
    //                                                     ->first();
    //         }
    //     }
    //     return response()->json($response);
    // }

     /**
    *   Method      : editBlogCategories
    *   Description : This is use to edit blog categories.
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function editBlogCategories($id)
    {
    	$data['blogupdata'] = BlogCategory::where('id',$id)->first();
    	// dd($data);
    	return view('admin.modules.blog.create_blog_categories')->with(@$data);
    }

     /**
    *   Method      : deleteBlogCategories
    *   Description : This is use to delete blog categories.
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function deleteBlogCategories($id)
    {
    	$blogcatdata = BlogCategory::find($id);

        $chkblog = Blog::where('category_id',$id)->count();

        if ($chkblog>0)
        {
            return redirect()->back()->with('error','You can not delete this category, there is blog in this category.');
        }

    	$blogcatdata->delete();
    	return redirect()->back()->with('success','Category deleted successfully.');
    }


    /**
    *   Method      : manageBlog
    *   Description : This is use to manageBlog page
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function manageBlog(Request $request)
    {
    	// dd('test');
    	$data['blogdata'] = Blog::orderBy('created_at','desc');
        $data['blogcatdata'] = BlogCategory::get();

        if (@$request->keyword) {
                $data['blogdata'] = $data['blogdata']->where('title', 'like', '%' . $request->keyword . '%')
                                                    /*->orwhereHas('gerParentName',function($e) use ($request){
                                                        $e->where('name', 'like', '%' . $request->keyword . '%');
                                                    })*/;
            }

        if (@$request->category_id) {
                $data['blogdata'] = $data['blogdata']->where('category_id', $request->category_id);
            }

        $data['blogdata'] = $data['blogdata']->paginate(10);
        $data['key'] = $request->all();

    	return view('admin.modules.blog.manage_blog')->with(@$data);
    }


     /**
    *   Method      : createBlog
    *   Description : This is use to create Blog
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function createBlog(Request $request)
    {
    	// dd('test');
    	$data['blogcata'] = BlogCategory::get();

    	return view('admin.modules.blog.create_blog')->with(@$data);
    }

     /**
    *   Method      : storeBlog
    *   Description : This is use to store Blog
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function storeBlog(Request $request)
    {
    	// dd($request->all());
    	$request->validate([
                'category_id'        => 'required',

            ]);
    	$input['category_id'] = $request->category_id;
    	$input['title'] = $request->title;
    	$input['blog_slug'] = str_slug($input['title']);
        $description =  $request->description;
        // $description =  strip_tags($request->description);
        $input['description'] = substr($description,0);
        // $input['description'] = strip_tags(preg_replace('/[\t\n\r\s]+/','', $request->description));
    	$input['author_name'] =  $request->author_name;
        $input['meta_title'] =  $request->meta_title;
        $input['meta_desc'] =  $request->meta_desc;
    	$input['status'] = 'A';

        // dd($input);
        // if(@$request->home_image){
        //     $image = $request->home_image;
        //     $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //     $imageFile = Image::make($image)->resize(444,573);
        //     Storage::putFileAs('blog_cata_img/home_img', $imageFile, $filename);
        //     @unlink(storage_path('app/blog_cata_img/home_img'.@$request->home_image));
        //     $input['home_image'] = $filename;
        // }
        if($request->hasFile('home_image')) {
            $image = $request->home_image;
            $fileName =  time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(444,573)->save(storage_path('app/blog_cata_img/home_img/'.$fileName));
            $input['home_image'] = $fileName;
          }

    	if(@$request->image){
                $image = $request->image;
                $filename = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(880,449)->save(storage_path('app/blog_cata_img/'.$filename));
                @unlink(storage_path('app/blog_cata_img/'.@$request->image));
                $input['image'] = $filename;
            }

        // dd($input);

        if ($request->id)
        {
            // dd($input);
            $storblogdata = Blog::where('id',$request->id)->update($input);
            return redirect()->route('manage.blog')->with('success','Blog details is update successfully.');
        }

        $storblogdata = Blog::create($input);

        $updateblogcata = BlogCategory::where('id',$request->category_id)->increment('tot_post', 1);

    	return redirect()->route('manage.blog')->with('success','Blog details is save successfully.');
    }

     /**
    *   Method      : editBlog
    *   Description : This is use to edit blog .
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function editBlog($id)
    {
    	$data['blogdata'] = blog::find($id);
    	$data['blogcata'] = BlogCategory::get();

    	// dd($data);

    	return view('admin.modules.blog.create_blog')->with(@$data);
    }


     /**
    *   Method      : deleteBlog
    *   Description : This is use to delete blog .
    *   Author      : Partha
    *   Date        : 28-12-2020
    **/
    public function deleteBlog($id)
    {
    	$blogcatdata = blog::find($id);

    	@unlink(storage_path('app/blog_cata_img/'.$blogcatdata->image));
    	$blogcatdata->delete();

        $updateblogcata = BlogCategory::where('id',$blogcatdata->category_id)->decrement('tot_post', 1);

    	return redirect()->back()->with('success','Blog deleted successfully.');
    }
}
