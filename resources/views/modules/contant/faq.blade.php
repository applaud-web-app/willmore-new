@extends('layouts.app')
@section('title','Faq')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content') 
<section class="about_us_ban">
         <div class="back_imgs"><img src="{{asset('public/images/faq_banner.png')}}" alt=""><div class="oberflow_bac"></div></div>
         <div class="about_ban_text">
            <div class="container">
               <div class="abt_ban_text_bx">
                  <h2>Frequently Asked Question</h2>
                  <ul>
                     <li><a href="#">Home</a></li>
                     <li class="breadcrumb-sep">//</li>
                     <li>FAQ</li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <div class="gig-details-pg-inr prvc-pg-inr faq-pg-inr">
         
         <div class="container">
            <div class="tab faq-tab">
               <button class="tablinks faq-tab-btn" onclick="openCity(event, 'London')" id="defaultOpen"><span>For </span>Employers</button>
               <button class="tablinks faq-tab-btn" onclick="openCity(event, 'Paris')"><span>For </span>Freelancers</button>
             </div>
             
             <!-- Tab content -->
             <div id="London" class="tabcontent faq-tab-cntnt">
               <div class="gig-sec-1 faq-gig">
                  <div class="giger-faq">
                     <div class="abbtex2">  
  
  
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="1"><p>Lorem ipsum dolor sit amet the consectetur it incididunt? </p><span class="plusminus plusminus1">+</span></div>
                              <div class="accordion_body aa1" style="display: block;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>      
                             
                        <div class="accordion_container">
                           <div class="accordion_head"  data-id="2"><p>Lorem ipsum dolor sit amet the consectetur? </p><span class="plusminus plusminus2">+</span></div>
                              <div class="accordion_body aa2" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>  
                        
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="3"><p>Lorem ipsum dolor sit amet the consectetur it adipiscing the eiusmod tempor the? </p><span class="plusminus plusminus3">+</span></div>
                              <div class="accordion_body aa3" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>
                        
                        <div class="accordion_container">
                           <div class="accordion_head"  data-id="4"><p>Consectetur it adipiscing the eiusmod tempor incididunt the caption? </p><span class="plusminus plusminus4">+</span></div>
                              <div class="accordion_body aa4" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>
                        
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="5"><p>Lorem ipsum dolor sit amet the consectetur? </p><span class="plusminus plusminus5">+</span></div>
                              <div class="accordion_body aa5" style="display: none;">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique sed orci vitae semper. Integer congue semper arcu in ultricies. In at bibendum turpis.
                              </p>
                           </div>
                        </div>
                           
                        <div class="accordion_container">
                          <div class="accordion_head" data-id="6"><p>Lorem ipsum dolor sit amet the consectetur it adipiscing the eiusmod tempor the?</p><span class="plusminus plusminus6">+</span></div>
                             <div class="accordion_body aa6" style="display: none;">
                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique sed orci vitae semper. Integer congue semper arcu in ultricies. In at bibendum turpis.
                             </p>
                          </div>
                       </div>                                
                        </div>
                  </div>
               </div>
             </div>
             
             <div id="Paris" class="tabcontent faq-tab-cntnt">
               <div class="gig-sec-1 faq-gig">
                  <div class="giger-faq">
                     <div class="abbtex2">  
  
  
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="1"><p>Lorem ipsum dolor sit amet the consectetur it incididunt? </p><span class="plusminus plusminus1">+</span></div>
                              <div class="accordion_body aa1" style="display: block;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>      
                             
                        <div class="accordion_container">
                           <div class="accordion_head"  data-id="2"><p>Lorem ipsum dolor sit amet the consectetur? </p><span class="plusminus plusminus2">+</span></div>
                              <div class="accordion_body aa2" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>  
                        
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="3"><p>Lorem ipsum dolor sit amet the consectetur it adipiscing the eiusmod tempor the? </p><span class="plusminus plusminus3">+</span></div>
                              <div class="accordion_body aa3" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>
                        
                        <div class="accordion_container">
                           <div class="accordion_head"  data-id="4"><p>Consectetur it adipiscing the eiusmod tempor incididunt the caption? </p><span class="plusminus plusminus4">+</span></div>
                              <div class="accordion_body aa4" style="display: none;">
                              <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                              </p>
                           </div>
                        </div>
                        
                        <div class="accordion_container">
                           <div class="accordion_head" data-id="5"><p>Lorem ipsum dolor sit amet the consectetur? </p><span class="plusminus plusminus5">+</span></div>
                              <div class="accordion_body aa5" style="display: none;">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique sed orci vitae semper. Integer congue semper arcu in ultricies. In at bibendum turpis.
                              </p>
                           </div>
                        </div>
                           
                        <div class="accordion_container">
                          <div class="accordion_head" data-id="6"><p>Lorem ipsum dolor sit amet the consectetur it adipiscing the eiusmod tempor the?</p><span class="plusminus plusminus6">+</span></div>
                             <div class="accordion_body aa6" style="display: none;">
                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique sed orci vitae semper. Integer congue semper arcu in ultricies. In at bibendum turpis.
                             </p>
                          </div>
                       </div>                                
                        </div>
                  </div>
               </div>
             </div>
         </div>
      </div>
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script src="{{asset('public/js/thumbnail-slider.js')}}"></script>
<script src="{{asset('public/js/ninja-slider.js')}}"></script>
<script src="{{asset('public/js/jquery.com_ui_1.11.4_jquery-ui.js')}}"></script>
<script>
	$(document).ready(function(){
		$(".mobile_filter").click(function(){
			$(".searchh_left").slideToggle();
			});
		});
</script>

<script type="text/javascript">
   $(document).ready(function() {
     $(".read_about").click(function() {
         $(".more_about").slideToggle("slow");
     });
 });
</script>
<script type="text/javascript">
   $(document).ready(function() {
     $(".read_giger").click(function() {
         $(".more_giger").slideToggle("slow");
     });
 });
</script>   
<script type="text/javascript">
   $(document).ready(function() {
     $(".read_revs").click(function() {
         $(".more_rev").slideToggle("slow");
     });
 });
</script> 
<script>
   $(document).ready(function(){
  //toggle the componenet with class accordion_body
  $(".accordion_head").click(function(){
     var id=$(this).data('id');
     if ($('.aa'+id).is(':visible')) {
        $(".aa"+id).slideUp(600);
        $(".plusminus"+id).text('+');
     }
     else
     {
        $(".accordion_body").slideUp(600);
        
        $(".plusminus").text('+');
        $(this).next(".accordion_body").slideDown(600); 
        $(this).children(".plusminus"+id).text('-');
     }
     if ($('.plusminus'+id).text('-')) {
    $(this).css("color","#37b6ff")
  } else {
    $(this).css("color","#c4c4c4")
  }
  });
});
   </script>

   <script>
      function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
};
document.getElementById("defaultOpen").click();
   </script>
   <script>
      $(document).ready(function() {

$(window).scroll(function() {

  if ($(document).scrollTop() > 0) {

    $(".gig_prc").addClass("marg_t02");

  } else {

    $(".gig_prc").removeClass("marg_t02");

  }

});

});
   </script>
@endsection