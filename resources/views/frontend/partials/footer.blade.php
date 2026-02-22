<!--Site Footer Start-->
<footer class="site-footer">
    <div class="site-footer-shape-1 float-bob-y" style="background-image: url({{ asset('frontend/assets/images/shapes/site-footer-shape-1.png') }});"></div>
    <div class="site-footer__top">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column footer-widget__about">
                        <div class="footer-widget__logo">
                            <a href="{{route('front.home')}}"><img src="{{ asset(siteInfo()->logo) }}" alt="" width="100px" height="80px" style="background:white"></a>
                        </div>
                        <div class="footer-widget__about-text-box">
                            {{-- <p class="footer-widget__about-text">Some Text Here</p> --}}
                        </div>
                        <div class="footer-widget__social-box">
                            <h4 class="footer-widget__social-title">Stay Connected</h4>
                            <div class="site-footer__social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                    <div class="footer-widget__column footer-widget__links">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Quick Links</h3>
                        </div>
                        <ul class="footer-widget__Explore-list list-unstyled">
                            <li><a href="{{route('front.home')}}">Home</a></li>
                            <li><a href="{{route('front.about-us')}}">About Us</a></li>
                            <li><a href="{{route('front.repair.all')}}">Services</a></li>
                            <li><a href="{{url('blog')}}">Blog</a></li>
                            <li><a href="{{route('front.contact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                    <div class="footer-widget__column footer-widget__services">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Our Services</h3>
                        </div>
                        <ul class="footer-widget__services-list list-unstyled">
                            @foreach(categories()->take(5) as $key => $item)
                            <li><a href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                    <div class="footer-widget__column footer-widget__Contact">
                        <div class="footer-widget__title-box">
                            <h3 class="footer-widget__title">Contact Us</h3>
                        </div>
                        <ul class="footer-widget__Contact-list list-unstyled">

                            <li>
                                <div class="icon">
                                    <span class="fas fa-map"></span>
                                </div>
                                <div class="text">
                                    <p>
                                        <a href="https://www.google.com/maps/place/Dc+Phone+Repair/@40.617918,-73.101379,3z/data=!4m6!3m5!1s0x89b7b9f7c32eef75:0x8da6eed6ae71af09!8m2!3d38.860888!4d-76.9685663!16s%2Fg%2F11vplbh6jk?hl=en&entry=ttu&g_ep=EgoyMDI2MDEyOC4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">2704 Marion Barry Ave SE, Washington, DC 20020 <br> United States</a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="fas fa-headphones"></span>
                                </div>
                                <div class="text">
                                    <p>
                                        <a href="{{ siteInfo()->topbar_phone ? 'tel:' . preg_replace('/[^0-9+]/', '', siteInfo()->topbar_phone) : '#' }}">{{ siteInfo()->topbar_phone }}</a>
                                        <!--<a href="tel:4448880000">444 888 0000</a>-->
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="fas fa-envelope"></span>
                                </div>
                                <div class="text">
                                    <p>
                                        <a href="mailto:phonerepairdc@gmail.com">phonerepairdc@gmail.com</a>
                                        
                                    </p>
                                </div>
                            </li>
                            
                            <li>
                                <div class="icon">
                                    <span class="fas fa-clock"></span>
                                </div>
                                <div class="text">
                                    <p>
                                        10:00 AM - 10:00 PM
                                        
                                    </p>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner">
                <p class="site-footer__bottom-text">Design By <a href="http://blacktechcorp.com/" target="_blank" rel="noopener noreferrer">Black Tech</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->


</div>
<!-- /.page-wrapper -->


<div class="mobile-nav__wrapper">
<div class="mobile-nav__overlay mobile-nav__toggler"></div>
<!-- /.mobile-nav__overlay -->
<div class="mobile-nav__content">
    <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

    <div class="logo-box">
        <a href="index.html" aria-label="logo image"><img src="{{ asset(siteInfo()->logo) }}" width="143" alt="" /></a>
    </div>
    <!-- /.logo-box -->
    <div class="mobile-nav__container"></div>
    <!-- /.mobile-nav__container -->

    <ul class="mobile-nav__contact list-unstyled">
        <li>
            <i class="fa fa-envelope"></i>
            <a href="mailto:phonerepairdc@gmail.com">phonerepairdc@gmail.com </a>
        </li>
        <li>
            <i class="fa fa-phone-alt"></i>
            <a href="{{ siteInfo()->topbar_phone ? 'tel:' . preg_replace('/[^0-9+]/', '', siteInfo()->topbar_phone) : '#' }}">{{ siteInfo()->topbar_phone }}</a>
        </li>
        <li>
            <i class="fa fa-clock">
               
            </i>
            10:00AM - 10:00 PM
            
        </li>
    </ul>
    <!-- /.mobile-nav__contact -->
    <div class="mobile-nav__top">
        <div class="mobile-nav__social">
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-facebook-square"></a>
            <a href="#" class="fab fa-pinterest-p"></a>
            <a href="#" class="fab fa-instagram"></a>
        </div>
        <!-- /.mobile-nav__social -->
    </div>
    <!-- /.mobile-nav__top -->



</div>
<!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<div class="search-popup">
<div class="search-popup__overlay search-toggler"></div>
<!-- /.search-popup__overlay -->
<div class="search-popup__content">
    <form class="searchArea my-0 my-lg-0" action="{{ route('front.product.search') }}">
        <label for="search" class="sr-only">search here</label>
        <!-- /.sr-only -->
        <input type="text" id="search" name="query" placeholder="Search Here..." />
        <button type="submit" aria-label="search submit" class="thm-btn">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<!-- /.search-popup__content -->
</div>
<!-- /.search-popup -->


<!--<a href="tel:+12024784799" data-target="html" class="cell_phone">-->
    
<!--   <i class="fa-solid fa-phone"></i>-->
<!--</a>-->

<a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    
    <svg version="1.1" id="icons" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 128 128; height: 40px" xml:space="preserve"><style>.st0,.st1{display:none;fill:#191919}.st1,.st3{fill-rule:evenodd;clip-rule:evenodd}.st3,.st4{display:inline;fill:#191919}</style><g id="row1"><path id="nav:2_3_" d="M64 1 17.9 127 64 99.8l46.1 27.2L64 1zm0 20.4 32.6 89.2L64 91.3V21.4z" style="fill:#191919"/></g></svg>
</a>


<script src="{{asset('frontend/assets/vendors/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jarallax/jarallax.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-appear/jquery.appear.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/nouislider/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/odometer/odometer.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/swiper/swiper.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/tiny-slider/tiny-slider.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/wnumb/wNumb.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/wow/wow.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/isotope/isotope.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/countdown/countdown.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bxslider/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/vegas/vegas.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/timepicker/timePicker.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/circleType/jquery.circleType.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/circleType/jquery.lettering.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendors/nice-select/jquery.nice-select.min.js')}}"></script>




<!-- template js -->
<script src="{{asset('frontend/assets/js/fixnix.js')}}"></script>
</body>

</html>
