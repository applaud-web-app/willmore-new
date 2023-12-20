<footer>
    <div class="container">
        <div class="top-footer">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="widget widget-about">
                        <img src="{{asset('public/images/logo.png')}}" alt="">
                        <p> Office No 1111, Maker Chamber V Nariman Point,<br> Mumbai 400 021</p>
                        <ul>
                            <li><span><a href="tel:+91 2235564357">+91 2235564357</a> / <a href="tel:+91 7777076298">+91 7777076298</a></span></li>
                            <li><a href="mailto:assistance@willandmore.com">assistance@willandmore.com</a></li>
                        </ul>
                    </div>
                    <!--widget-about end-->
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="widget widget-links">
                        <h4 class="widget-title">SOCIAL MEDIA</h4>
                        <ul>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Linkedin</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Telegram</a></li>
                        </ul>
                    </div>
                    <!--widget-links end-->
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="widget widget-links">
                        <h4 class="widget-title">COMPANY</h4>
                        <ul>
                            <li><a href="{{route('about_us')}}">About Us</a></li>
                            <li><a href="{{route('team')}}">Our team</a></li>
                            {{--<li><a href="{{route('prices')}}">Prices</a></li>--}}
                            <li><a href="{{route('contact_us')}}">Contact</a></li>
                            <li><a href="{{route('blog')}}">Blogs </a></li>
                            <li><a href="{{route('faq')}}">FAQ</a></li>
                        </ul>
                    </div>
                    <!--widget-links end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-links">
                        <h4 class="widget-title">SERVICES</h4>
                        <ul>
                            <li><a href="{{route('service_detail',[1])}}">Will Creation</a></li>
                            <li><a href="{{route('service_detail',[2])}}">Will Location Registry</a></li>
                            <li><a href="{{route('service_detail',[3])}}">Letter of Instruction</a></li>
                            <li><a href="{{route('service_detail',[4])}}">Legacy Guardian</a></li>
                            <li><a href="{{route('service_detail',[5])}}">Advance Medical Directive</a></li>
                            <li><a href="{{route('service_detail',[6])}}">Consult with us</a></li>
                        </ul>
                    </div>
                    <!--widget-links end-->
                </div>
            </div>
        </div>
        <div class="bottom-strip">
            <ul class="bt-links">
                <li><a href="{{route('terms_and_conditions')}}">Terms and Conditions</a></li>
                <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                <li><a href="{{route('terms_of_services')}}">Terms of Services</a></li>
                <li><a href="{{route('disclaimer_policy')}}">Disclaimer Policy</a></li>
            </ul>
            <!--bt-links end-->
        </div>
    </div>
</footer>
<!--footer end-->
