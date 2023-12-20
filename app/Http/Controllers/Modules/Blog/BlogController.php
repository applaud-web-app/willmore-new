<?php

namespace App\Http\Controllers\Modules\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
     /**
    *   Method      : blog
    *   Description : This is use to display blog.
    *   Author      : Sourav
    *   Date        : 17-Nov-2022
    **/
    public function blog()
    {
        $data['blog'] = Blog::orderBy('tot_view','desc')->first();
        $data['allblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('created_at','desc')->paginate(6);
        $data['letestblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('created_at','desc')->take(3)->get();
        $data['popularblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('tot_view','desc')->take(3)->get();
        $data['blogcategory'] = BlogCategory::get();

        return view('modules.blog.display_blog')->with(@$data);
    }


    public function displayBlog($category_slug)
    {
        $data['blocata'] = BlogCategory::where('category_slug',$category_slug)->first();

        $data['blog'] = Blog::where('category_id', @$data['blocata']->id)->orderBy('tot_view','desc')->first();
        $data['allblog'] = Blog::where('category_id', @$data['blocata']->id)->where('id', '!=', @$data['blog']->id)->orderBy('created_at','desc')->paginate(6);
        $data['letestblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('created_at','desc')->take(3)->get();
        $data['popularblog'] = Blog::where('id', '!=', @$data['blog']->id)->orderBy('tot_view','desc')->take(3)->get();
        $data['blogcategory'] = BlogCategory::get();

        return view('modules.blog.display_blog')->with(@$data);
    }


    public function blogDetails($blog_slug=null)
    {
        $data['blogDetails'] = Blog::where('blog_slug',$blog_slug)->first();

        $blog = Blog::find($data['blogDetails']->id);
        $blog->increment('tot_view');

        $data['letestblog'] = Blog::where('id', '!=', @$data['blogDetails']->id)->orderBy('created_at','desc')->take(3)->get();
        $data['popularblog'] = Blog::where('id', '!=', @$data['blogDetails']->id)->orderBy('tot_view','desc')->take(3)->get();
        $data['blogcategory'] = BlogCategory::get();
        $data['similarblog'] = Blog::where('category_id', @$data['blogDetails']->category_id)->where('id', '!=', @$data['blogDetails']->id)->orderBy('id','desc')->take(3)->get();

        return view('modules.blog.blog_details')->with(@$data);
    }


}
