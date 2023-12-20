@extends('layouts.app')
@section('title','Careers')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')
<section class="about_us_ban">
  <div class="back_imgs"><img src="{{ url('public/images/how-it_banner.png') }}" alt="">
    <div class="oberflow_bac"></div>
  </div>
  <div class="about_ban_text">
    <div class="container">
      <div class="abt_ban_text_bx">
        <h2>Careers</h2>
        <ul>
          <li><a href="#">Home</a></li>
          <li class="breadcrumb-sep">//</li>
          <li>Careers</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="bookmark_area">
    <div class="container">
        <a href="{{ route('about_us') }}">About <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
        <a href="{{ route('why') }}">Why <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
        <a href="{{ route('how.work.employer') }}">How <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
        <a href="{{ route('what') }}">What <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
        <a href="{{ route('career') }}" class="innr_page_active">Careers <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
        <a href="{{ route('team') }}">Team <img src="{{ url('public/images/arrow-up-right2.png') }}" alt=""></a>
    </div>
</section>

<section class="careers_main_area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h1>Careers at Digilancers</h1>
          <p class="hjjkk">Join our dynamic and ambitious team of talent today</p>
        </div>
        <div class="careers_mn">
        <h3 class="das_headingds mb-0">Talented? Come & join the revolution!</h3>
        
        <form>
          <div class="input-from">
            <div class="row"> 
              
              <!--<div class="col-sm-4 col-md-4 col-sm-6">
                        <div class="input_sh_bx2">
                          <div class="dash-field">
                            <input type="text" id="name" autocomplete="off" value="" placeholder="Enter here">
                            <label for="name">Designation </label>
                          </div>
                        </div>
                      </div>-->
              
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <input type="text" id="name" autocomplete="off" placeholder="Enter here" value="">
                    <label for="name">Name</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <input type="email" id="name" autocomplete="off"  placeholder="Enter here" >
                    <label for="name">Email</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <input type="text" id="name" autocomplete="off" value="" placeholder="Enter here">
                    <label for="name">Social (Linkedin)</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <select class="floating-select" onclick="" value="" required="">
                      <option value="1">Select</option>
                      <option value="2">Male</option>
                      <option value="3">Female</option>
                    </select>
                    <label for="name">Gender</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <input type="text" id="name" autocomplete="off" value="" placeholder="Enter here">
                    <label for="name">Telephone</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <input type="text" id="name" autocomplete="off" placeholder="Enter here" value="">
                    <label for="name">Your Location</label>
                  </div>
                </div>
              </div>
              
              <!--<div class="col-sm-4 col-md-4 col-sm-6">
                        <div class="input_sh_bx2">
                          <div class="dash-field auto_selcts">
                            <p class="autocomplete-select"></p>
                            <label for="name">Languages</label>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-sm-6">
                        <div class="input_sh_bx2">
                          <div class="dash-field">
                            <input type="text" id="name" autocomplete="off" value="" placeholder="Enter here" >
                            <label for="name">D.O.B</label>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-8 col-sm-12">
                        <div class="input_sh_bx2">
                          <div class="dash-field">
                            <input type="text" id="name" autocomplete="off" value="" placeholder="Enter here">
                            <label for="name">Address</label>
                          </div>
                        </div>
                      </div>-->
              
              <div class="col-sm-12">
                <div class="input_sh_bx2">
                  <div class="dash-field">
                    <textarea placeholder="Enter here..."></textarea>
                    <label for="name">Brief Bio About Yourself</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 ff_nch">
                <h3 class="das_headingds mb-0 ffrfff">On which area of expertise are you interested in?</h3>
                
                <div class="all_chckk_areaa01">

                <div class="checkbox-group"> 
                <input type="checkbox" id="check1"> 
                <label for="check1"><span class="check"></span><span class="box"></span><img src="{{ url('public/images/vector.png') }}" class="hoverb"> Website Design </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check2">
                  <label for="check2"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/megaphone.png') }}" class="hoverb"> Digital Marketing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check3">
                  <label for="check3"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/video.png') }}" class="hoverb"> Video & Animation </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check4">
                  <label for="check4"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/music-note.png') }}" class="hoverb"> Music & Audio </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check5">
                  <label for="check5"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/brief.png') }}" class="hoverb"> Business </label>
                </div>
                
                
                
                
                <div class="checkbox-group"> 
                <input type="checkbox" id="check6"> 
                <label for="check6"><span class="check"></span><span class="box"></span><img src="{{ url('public/images/programing.png') }}" class="hoverb"> Lifestyle </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check7">
                  <label for="check7"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/vector.png') }}" class="hoverb"> Graphics Design</label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check8">
                  <label for="check8"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/analytics.png') }}" class="hoverb"> Data Analytics </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check9">
                  <label for="check9"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/copywriting.png') }}" class="hoverb"> Writing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check10">
                  <label for="check10"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/add-friend.png') }}" class="hoverb"> Proofreading  </label>
                </div>
                
                
                
                
                <div class="checkbox-group"> 
                <input type="checkbox" id="check11"> 
                <label for="check11"><span class="check"></span><span class="box"></span><img src="{{ url('public/images/android.png') }}" class="hoverb"> Android Apps </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check12">
                  <label for="check12"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/recovery.png') }}" class="hoverb"> MySQL</label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check13">
                  <label for="check13"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/adobe-photoshop.png') }}" class="hoverb"> Photoshop Marketing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check14">
                  <label for="check14"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/document.png') }}" class="hoverb"> Accounting </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check15">
                  <label for="check15"> <span class="check"></span> <span class="box"></span><img src="{{ url('public/images/product.png') }}" class="hoverb"> Manufacturing </label>
                </div>
                
                
                
                <div class="checkbox-group"> 
                <input type="checkbox" id="check16"> 
                <label for="check16"><span class="check"></span><span class="box"></span><img src="{{ url('public/images/java-script.png') }}" class="hoverb"> Javascript </label>
                </div>
                
                <!--<div class="checkbox-group">
                  <input type="checkbox" id="check17">
                  <label for="check17"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Programming & Develop </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check18">
                  <label for="check18"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Digital Marketing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check19">
                  <label for="check19"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Writing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check20">
                  <label for="check20"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Business </label>
                </div>
                
                
                
                <div class="checkbox-group"> 
                <input type="checkbox" id="check21"> 
                <label for="check21"><span class="check"></span><span class="box"></span><img src="images/megaphone.png" class="hoverb"> Design & Art </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check22">
                  <label for="check22"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Programming & Develop </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check23">
                  <label for="check23"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Digital Marketing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check24">
                  <label for="check24"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Writing </label>
                </div>
                
                <div class="checkbox-group">
                  <input type="checkbox" id="check25">
                  <label for="check25"> <span class="check"></span> <span class="box"></span><img src="images/megaphone.png" class="hoverb"> Business </label>
                </div>-->
                    
                    


                
                </div>
                
              </div>
              
              <div class="col-sm-12">
                <div class="uplodimg">
                  <div class="uplodimgfil">
                    <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple>
                    <label for="file-1">Upload Your CV <img src="images/clickhe.png" alt=""></label>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="boirder"></div>
          <div class="dash_btns_sec"> <a href="#" >Submit </a> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script src="{{asset('public/js/counter.js')}}"></script>
<script>
 $(document).ready(function(){
    var curroute = "{{Route::is('what_is_our_mission')}}";
    if(curroute){
        $('html, body').animate({
            'scrollTop' : $(".mission").position().top+150
        });
    }
});
</script>
@endsection