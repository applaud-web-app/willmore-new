<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="The future of work is Remote, Flexible and Work from Anywhere"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://dignifiedme.com/preview/public/images/logo_icon.png" type="image/x-icon">
    <title>dignifiedme | Dignify Livlihood</title>
    <!--style-->
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all" />
    <link href="css/responsive.css" type="text/css" rel="stylesheet" media="all" />
    <!--bootstrape-->
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all" />
    <!--font-awesome-->
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all" />
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/3def92f7b2ad644bd382798ecc8ca4c7?family=Canela-Bold" rel="stylesheet"
        type="text/css" />

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Owl javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/owl.carousel.js"></script>

    <script>
        $(document).ready(function () {
            $("#prof").click(function () {
                if ($("#faq_1").is(':visible')) {
                    $("#faq_1").slideUp();
                } else {
                    $("#faq_1").slideDown(400, () => {
                        $("#faq_2").hide();
                        $('html,body').animate({
                            scrollTop: ($('#faq_1').offset().top - 15) + 'px'
                        }, 1000);
                    });
                }
            });
            $("#empl").click(function () {
                if ($("#faq_2").is(':visible')) {
                    $("#faq_2").slideUp();
                } else {
                    $("#faq_2").slideDown(400, () => {
                        $("#faq_1").hide();
                        $('html,body').animate({
                            scrollTop: ($('#faq_2').offset().top - 15) + 'px'
                        }, 1000);
                    });
                }
            });

            //body onload country dropdown
            $.ajax({
                url: "https://dignifiedme.com/preview/send-mail-landing-get-country",
                method: "GET",
                dataType:'json',
                success: function(res){
                    console.log("country", res);
                    var options = '<option value="">Select Country </option>';
                    if(res.country){
                        res.country.forEach(function(v, i){
                            options += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                    }
                    $('.country-drop').html(options);
                }
            });
        });

    </script>
    <style>
        .error{
            color: red !important;
        }
        .swal-button--confirm{
            background-color: #461f6d !important;
        }
    </style>
</head>

<body>

    <!--wrapper start-->
    <div class="wrapper">

        <section class="top-head">
            <div class="container">
                <a class="logos" href="javascript:void(0);"><img src="./images/logo.png" alt=""></a>
            </div>
        </section>
        <section class="upper-banner">
            <div class="container">
                <div class="middle-body">
                    <div class="one-box">
                        <span class="mob-ban-img"><img src="./images/banner-img.png" alt=""></span>
                        
                        <h5>The future of work is Remote, <br> Flexible and Work from Anywhere </h5>
                        <h2>We are Coming Soon!</h2>
                        <div class="all-sub-content">
                            <!-- <p>Dignifiedme is not just another Freelancer Platform, Job Portal or a Staffing Agency.</p>
                            <h6>We are an 'Enablement Platform'</h6> -->
                            <h6>Enabling the 'Future of Work'</h6>
                            <h6>एक कदम आत्मनिर्भरता की और </h6>
                        </div>
                        <div class="banner-btns">
                            <a id="prof" class="post-project faqs" href="javascript:void(0);" data-id="1">I
                            am a Professional </a>
                            <a id="empl" class="post-project faqs rev-btn" href="javascript:void(0);" data-id="2">I
                                am an Employer </a>
                        </div>
                    </div>
                </div>
                <div class="middle-banimg"><img src="./images/banner-img.png" alt=""></div>
            </div>
        </section>
        <section class="throute-area">
            <div class="container">
                <div class="register-maain">
                    <div class="one-box">
                        <h4>Are you a Professional having these thoughts? </h4>
                        <ul>
                            <li>In spite of my talent I lost my job during the pandemic and now I don’t have any
                                earning for a livelihood.</li>
                            <li>I tried freelancing platforms but didn’t get work. </li>
                            <li>I have sufficient bandwidth to take up extra projects, enhance my skills and
                                increase my net income.</li>
                            <li>I am ready to test my skills and be a Dignified Myself.</li>
                        </ul>
                    </div>
                </div>

                <div class="register-maain second-register">
                    <div class="one-box">
                        <h4>Are you an Employer having these thoughts? </h4>
                        <ul>
                            <li>My average hiring cost is killing my business. </li>
                            <li>Hiring is now-a-days risky, there’s no loyalty and no guarantee of quality.
                            </li>
                            <li>I hired &amp; trained candidates,they found other better opportunities.</li>
                            <li>Unwillingly I had to lay off candidates due to Pandemic!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="below-banners">
            <div class="container">
                <div class="below-body">
                    <div class="only-for-left">
                        <h4>Dignifiedme brings for the first time</h4>
                        <ul>
                            <li>
                                <img src="./images/icons1.png" alt=""> 
                                <p>100% qualified and vetted Professionals based on our proprietary AI/ML algorithms</p></li>
                            <li>
                                <img src="./images/icons2.png" alt=""> 
                                <p>Bracketed Pricing Structure which will help Employers select Professionals based on talent, skills and budget</p></li>
                            <li>
                                <img src="./images/icons3.png" alt=""> 
                                <p>100% risk free hiring for Employers </p></li>
                            <li>
                                <img src="./images/icons4.png" alt=""> 
                                <p>Dedicated personal knowledge base for Professionals</p> </li>
                            <li>
                                <img src="./images/icons5.png" alt=""> 
                                <p>Progressive and Curated learning path for Professionals </p></li>
                            <li>
                                <img src="./images/icons6.png" alt=""> 
                                <p>Opportunity to get permanently hired for Professionals</p></li>
                        </ul>
                    </div>
                </div>

                <div class="forms-filed">
                    <div class="row">
                        <form id="prof-from" name="prof-from" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_type" value="P">
                            <div class="col-lg-12 col-md-12" id="faq_1" style="display: none;">
                                <h3>I am a Professional</h3>
                                <div class="all-filds">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">First Name</label>
                                            <input type="text" name="fname" class="type-area" name="" placeholder="Type here ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Last Name</label>
                                            <input type="text" name="lname" class="type-area" name="" placeholder="Type here ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Email Address</label>
                                            <input type="text" name="email" class="type-area" name="" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 frm_grp">
                                            <label class="from-label">Primary Skills <span>(top 3 you are most confident about)</span></label>
                                            <input type="text" name="p_skill" class="type-area" name="" placeholder="Please enter skills separated by comma ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 frm_grp">
                                            <label class="from-label">Secondary Skills <span>(up to 5)</span></label>
                                            <input type="text" name="s_skill" class="type-area" name="" placeholder="Please enter skills separated by comma ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Industry Experience (Years)</label>
                                            <input type="text" name="ind_exp" class="type-area" name="" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">City</label>
                                            <input type="text" name="city" class="type-area" name="" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Country</label>
                                            <select class="type-area type-select country-drop" name="country">
                                                <option value="">Select Country </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label from-label2">Lost job due to Covid-19 Pandemic </label>
                                            <div class="all-radios">
                                                <p>
                                                    <input type="radio" id="test1" name="lost_job" value="Y">
                                                    <label for="test1">Yes</label>
                                                </p>
                                                <p>
                                                    <input type="radio" id="test2" name="lost_job" value="N" checked>
                                                    <label for="test2">No</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <button type="submit" class="post-project rev-btn sub-pro-frm">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="emp-from" name="prof-from" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_type" value="E">
                            <div class="col-lg-12 col-md-12" id="faq_2" style="display: none;">
                                <h3>I am an Employer </h3>
                                <div class="all-filds">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label" name="">First Name</label>
                                            <input type="text" class="type-area" name="fname" placeholder="Type here ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Last Name</label>
                                            <input type="text" class="type-area" name="lname" placeholder="Type here ">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Company Name </label>
                                            <input type="text" class="type-area" name="company_name" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Designation</label>
                                            <input type="text" class="type-area" name="designation" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Company Email Address </label>
                                            <input type="text" class="type-area" name="company_email" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">City</label>
                                            <input type="text" class="type-area" name="city" placeholder="Type here">
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label">Country</label>
                                            <select class="type-area type-select country-drop" name="country">
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label from-label2">We are a startup </label>
                                            <div class="all-radios">
                                                <p>
                                                    <input type="radio" id="test3" name="startup" value="Y">
                                                    <label for="test3">Yes</label>
                                                </p>
                                                <p>
                                                    <input type="radio" id="test4" name="startup" value="N" checked>
                                                    <label for="test4">No</label>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <label class="from-label from-label2">We normally hire remote talent on project basis
                                            </label>
                                            <div class="all-radios">
                                                <p>
                                                    <input type="radio" id="test5" name="normally_hire" value="Y" class="uncheck-cls">
                                                    <label for="test5">Yes</label>
                                                </p>
                                                <p>
                                                    <input type="radio" id="test6" name="normally_hire" value="N" class="uncheck-cls">
                                                    <label for="test6">No</label>
                                                </p>
                                            </div>

                                            <div class="one-radio">
                                                <label class="from-label from-label2">We want to try hiring remote talent on project basis
                                                </label>
                                                <div class="all-radios">
                                                    <p>
                                                        <input type="radio" id="test7" name="want_hiring" value="Y" class="uncheck-cls">
                                                        <label for="test7">Yes</label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" id="test8" name="want_hiring" value="N" class="uncheck-cls">
                                                        <label for="test8">No</label>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <button type="submit" class="post-project rev-btn sub-emp-frm">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="main-socials">
                    <p>Copyright © 2020 dignified.me | All rights reserved. <span>investors@dignified.me</span></p>
                    <ul class="fot-socials">
                        <li>Connect with us</li>
                        <li><a class="linkdin-icon" target="_blank" href="https://www.linkedin.com/company/dignifiedme"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" class="facebook-icon" href="https://www.facebook.com/dignifiedmetech"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" class="twitter-icon" href="https://twitter.com/dignifiedmetech"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" class="instra-icon" href="https://www.instagram.com/dignifiedmetech/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        
                    </ul>
                </div>

            </div>
        </section>






    <link rel="stylesheet" href="css/chosen.css">
  <script src="js/chosen.jquery.js" type="text/javascript"></script>
  <script src="js/init.js" type="text/javascript" charset="utf-8"></script>





    </div>
    <!--wrapper end-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");

        $('#prof-from').validate({
            rules:{
                fname:{ required:true },
                lname:{ required:true },
                email:{ required:true, validate_email:true },
                p_skill:{ required:true },
                s_skill:{ required:true },
                ind_exp:{ required:true, number:true },
                city:{ required:true },
                country:{ required:true }
            },
            submitHandler:function(form){
                $('.sub-pro-frm').prop('disabled', true);
                $('.sub-pro-frm').html('<i class="fa fa-spinner fa-spin"></i>');
                var f = $('#prof-from').serialize();
                var settings = {
                    url: "https://dignifiedme.com/preview/send-mail-landing",
                    method: "POST",
                    data: $('#prof-from').serialize(),
                    dataType:'json'
                };
                $.ajax(settings).done(function (res) {
                    console.log(res);
                    if(res.status=="success"){
                        swal("Success", "You have successfully subscribed Dignifiedme - Dignify Livelihood", "success");
                    }else{
                        swal("Warning!", "Something went wrong! Please try again.", "warning");
                    }
                    $('.sub-pro-frm').prop('disabled', false);
                    $('#prof-from')[0].reset();
                    $('.sub-pro-frm').html('Subscribe');
                });
            }
        });
        $('#emp-from').validate({
            rules:{
                fname:{ required:true },
                lname:{ required:true },
                company_email:{ required:true, validate_email:true },
                company_name:{ required:true },
                designation:{ required:true },
                city:{ required:true },
                country:{ required:true }
            },
            submitHandler:function(form){
                $('.sub-emp-frm').prop('disabled', true);
                $('.sub-emp-frm').html('<i class="fa fa-spinner fa-spin"></i>');
                var f = $('#emp-from').serialize();
                var settings = {
                    url: "https://dignifiedme.com/preview/send-mail-landing",
                    method: "POST",
                    data: $('#emp-from').serialize(),
                    dataType:'json'
                };
                $.ajax(settings).done(function (res) {
                    console.log(res);
                    if(res.status=="success"){
                        swal("Success", "You have successfully subscribed Dignifiedme - Dignify Livelihood", "success");
                    }else{
                        swal("Warning!", "Something went wrong! Please try again.", "warning");
                    }
                    $('.sub-emp-frm').prop('disabled', false);
                    $('#emp-from')[0].reset();
                    $('.sub-emp-frm').html('Subscribe');
                });
            }
        });
        $('.uncheck-cls').click(function(){
            $('.uncheck-cls').prop('checked',false);
            $(this).prop('checked',true);
        });
    });
</script>
</body>

</html>