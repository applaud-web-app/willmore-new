@extends('layouts.app')
@section('title','Blog')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="pager-section banner_img">
    <div class="container">
        <div class="main-banner-content p-relative">
            @include('includes.social_links')
            <!--social-links end-->
            <div class="pager-content">
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Blog</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">Blog</h2>
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="page-content pt-0">
    <div class="blog-page-head">
        <div class="container">
            {{-- <ul class="cate-list-head"> --}}
            <ul>
                <li><a @if(@$blocata->id == null) class="active" @endif href="{{route('blog')}}" title="">All Blogs</a></li>
                @if(count(@$blogcategory)>0)
                @foreach(@$blogcategory as $category)
                    <li><a @if(@$blocata->id == $category->id) class="active" @endif href="{{route('display.blog.category',['category_slug'=>@$category->category_slug])}}" title="">{{ @$category->category }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
        {{-- <div class="search_form">
            <form>
                <input type="text" name="search" placeholder="Search">
                <button type="submit"><i class="flaticon-search"></i></button>
            </form>
        </div> --}}
        <!--search_form end-->
    </div>
    <!--blog-page-head end-->
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="blog-page-content">
                    <div class="blog-main-post">
                        @if(@$blog)
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="blog-main-thumbnail black_bg">
                                        @if(@$blog->home_image)
                                        <img src="{{url('storage\app\blog_cata_img\home_img')}}/{{ @$blog->home_image }}" alt="">
                                        @elseif(@$blog->image)
                                        <img src="{{url('storage\app\blog_cata_img')}}/{{ @$blog->image }}" alt="">
                                        @else
                                        <img src="{{asset('public/images/logo.png')}}" alt="">
                                        @endif
                                </div>
                                <!--blog-main-thumbnail end-->
                            </div>
                            <div class="col-md-6">
                                <div class="blog-main-para">
                                    <span> {{ @$blog->getBlogCata->category }} </span>
                                    <h2><a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">
                                        @if(strlen(@$blog->title)>50)
                                            {!! str_limit(strip_tags(@$blog->title), 50) !!}
                                        @else
                                            {!! @$blog->title !!}
                                        @endif
                                    </h2>
                                    <p>
                                        @if(strlen(@$blog->description)>235)
                                        {!! str_limit(strip_tags(@$blog->description), 235) !!}
                                        @else
                                            {!! @$blog->description !!}
                                        @endif
                                    </p>
                                    <ul class="meta">
                                        <li><a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">{{ @$blog->created_at?date('j F Y',strtotime(@$blog->created_at)):'' }}</a></li>
                                        <li><span> <i class="flaticon-eye"></i> {{ @$blog->tot_view }} </span></li>
                                    </ul>
                                </div>
                                <!--blog-main-para end-->
                            </div>
                        </div>
                        @else
                        <div class="row align-items-center">
                            <div class="col-md-6">

                                <!--blog-main-thumbnail end-->
                            </div>
                            <div class="col-md-6">
                                <div class="blog-main-para">
                                    <span> !! No Blog Found !! </span>

                                </div>
                                <!--blog-main-para end-->
                            </div>
                        </div>
                        @endif

                    </div>
                    <!--blog-main-post end-->
                    <div class="blog-posts blog-page-v">
                        <div class="row">
                            {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post-lg overlay">
                                    <img src="https://via.placeholder.com/444x573" alt="" class="w-100">
                                    <div class="figcaption">
                                        <h4>Business</h4>
                                        <h2><a href="{{route('blog_details')}}" title="">How to file for bankruptcy of your
                                                company</a></h2>
                                        <span>15 Jule 2019</span>
                                    </div>
                                </div>
                                <!--post-lg end-->
                            </div> --}}

                            @if(count(@$allblog)>0)
                            @foreach(@$allblog as $blog)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail black_bg">
                                        @if(@$blog->image)
                                        <img src="{{url('storage\app\blog_cata_img')}}/{{ @$blog->image }}" alt="" class="img-size">
                                        @else
                                        <img src="{{asset('public/images/logo.png')}}" alt="" class="img-size">
                                        @endif
                                    </div>
                                    <div class="blog-info blog_wid">
                                        <h4>{{ @$blog->getBlogCata->category }}</h4>
                                        <h2>
                                            <a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">
                                                @if(strlen(@$blog->title)>50)
                                                {!! str_limit(strip_tags(@$blog->title), 50) !!}
                                                @else
                                                    {!! @$blog->title !!}
                                                @endif
                                            </a>
                                        </h2>
                                        <span>{{ @$blog->created_at?date('j F Y',strtotime(@$blog->created_at)):'' }}</span>
                                    </div>
                                </div>
                                <!--blog-post end-->
                            </div>
                            @endforeach
                            @endif

                            {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Business</h4>
                                        <h2><a href="{{route('blog_details')}}" title="">How to survive a business pandemic.
                                                Recommendations</a></h2>
                                        <span>18 April 2019</span>
                                    </div>
                                </div>
                                <!--blog-post end-->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Family relation</h4>
                                        <h2><a href="{{route('blog_details')}}" title="">What should I do if the landlord
                                                terminates the contract?</a></h2>
                                        <span>23 October 2019</span>
                                    </div>
                                </div>
                                <!--blog-post end-->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Business</h4>
                                        <h2><a href="{{route('blog_details')}}" title="">How to take out <br /> a loan with
                                                minimal interest </a></h2>
                                        <span>18 April 2019</span>
                                    </div>
                                </div>
                                <!--blog-post end-->
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="blog-post">
                                    <div class="blog-thumbnail">
                                        <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                                    </div>
                                    <div class="blog-info">
                                        <h4>Business</h4>
                                        <h2><a href="{{route('blog_details')}}" title="">New method of safe home purchase in
                                                Russia</a></h2>
                                        <span>18 April 2019</span>
                                    </div>
                                </div>
                                <!--blog-post end-->
                            </div> --}}
                        </div>
                    </div>
                    <!--blog-posts end-->
                </div>
                <!--blog-page-content end-->
                <div class="zeus-pagination text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            {{-- <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i> Prev
                                </a>
                                </li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        Next <i class="fa fa-angle-right"></i>
                                    </a>
                            </li> --}}
                            {{$allblog->links('pagination')}}
                        </ul>
                    </nav>
                </div>
                <!--zeus-pagination end-->
            </div>
            <div class="col-xl-4">
                <div class="sidebar blog-sidebar">
                    {{-- <div class="widget widget-newsletter">
                        <h3 class="widget-title">Newsletter</h3>
                        <form>
                            <input type="text" name="newsletter" placeholder="Your e-mail">
                            <button type="submit"><i class="flaticon-send"></i></button>
                        </form>
                    </div> --}}
                    <!--widget-newsletter end-->
                    <div class="widget widget-posts">
                        <h3 class="widget-title">Latest Blogs</h3>
                        <ul>

                            @if(count(@$letestblog)>0)
                            @foreach(@$letestblog as $blog)
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb black_bg ">
                                        @if(@$blog->image)
                                        <img src="{{url('storage\app\blog_cata_img')}}/{{ @$blog->image }}" alt="">
                                        @else
                                        <img src="{{asset('public/images/logo.png')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="wd-post-info">
                                        <h4>
                                            <a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">
                                                @if(strlen(@$blog->title)>30)
                                                    {!! str_limit(strip_tags(@$blog->title), 30) !!}
                                                @else
                                                    {!! @$blog->title !!}
                                                @endif
                                            </a>
                                        </h4>
                                        <span>{{ @$blog->created_at?date('j F Y',strtotime(@$blog->created_at)):'' }}</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li>
                            @endforeach
                            @endif

                            {{-- <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="{{route('blog_details')}}" title="">How to choose the right law firm</a>
                                        </h4>
                                        <span>Dec 9, 2019</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="{{route('blog_details')}}" title="">Pandemic. What is it and how to act?</a>
                                        </h4>
                                        <span>Dec 9, 2020</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li> --}}
                        </ul>
                    </div>
                    <!--widget-posts end-->
                    <div class="widget widget-posts">
                        <h3 class="widget-title">Popular Blogs</h3>
                        <ul>

                            @if(count(@$popularblog)>0)
                            @foreach(@$popularblog as $blog)
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb black_bg">
                                        @if(@$blog->image)
                                        <img src="{{url('storage\app\blog_cata_img')}}/{{ @$blog->image }}" alt="">
                                        @else
                                        <img src="{{asset('public/images/logo.png')}}" alt="">
                                        @endif
                                    </div>
                                    <div class="wd-post-info">
                                        <h4>
                                            <a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">
                                                @if(strlen(@$blog->title)>30)
                                                    {!! str_limit(strip_tags(@$blog->title), 30) !!}
                                                @else
                                                    {!! @$blog->title !!}
                                                @endif
                                            </a>
                                        </h4>
                                        <span>{{ @$blog->created_at?date('j F Y',strtotime(@$blog->created_at)):'' }}</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li>
                            @endforeach
                            @endif

                            {{-- <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x287" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="{{route('blog_details')}}" title="">Law, what literature will help a
                                                beginner?</a></h4>
                                        <span>Jul 21, 2020</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li>
                            <li>
                                <div class="wd-post d-flex flex-wrap align-items-center">
                                    <div class="wd-post-thumb">
                                        <img src="https://via.placeholder.com/444x344" alt="">
                                    </div>
                                    <div class="wd-post-info">
                                        <h4><a href="{{route('blog_details')}}" title="">Law, what literature will help a
                                                beginner?</a></h4>
                                        <span>Dec 9, 2019</span>
                                    </div>
                                </div>
                                <!--wd-post end-->
                            </li> --}}
                        </ul>
                    </div>
                    <!--widget-posts end-->
                </div>
                <!--sidebar end-->
            </div>
        </div>
    </div>
</section>
<!--page-content end-->

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@endsection
