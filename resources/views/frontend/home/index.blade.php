@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 1)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'DC-Phone-Repair-Home')
@push('css')

@endpush
@section('seos')

    

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta name="title" content="{{$SeoSettings->seo_title}}">

    <meta name="description" content="{{$SeoSettings->seo_description}}">
    @if($SeoSettings->keywords)
        <meta name="keywords" content="{{$SeoSettings->keywords}}">
    @endif
    @if($SeoSettings->author)
        <meta name="author" content="{{$SeoSettings->author}}">
    @endif
    @if($SeoSettings->publisher)
        <meta name="publisher" content="{{$SeoSettings->publisher}}">
        <meta property="article:publisher" content="{{$SeoSettings->publisher}}">
    @endif
    @if($SeoSettings->copyright)
        <meta name="copyright" content="{{$SeoSettings->copyright}}">
    @endif
    
    <meta property="og:title" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$metaDescription}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="{{$siteName}}">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    @if($metaImage)
        <meta property="og:image" content="{{$metaImage}}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="article:modified_time" content="2023-03-01T12:33:34+00:00">
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{$metaTitle}}">
    <meta name="twitter:description" content="{{$metaDescription}}">
    <meta name="twitter:url" content="">
    @if($metaImage)
        <meta name="twitter:image" content="{{$metaImage}}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
@endsection
@section('content')
<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Main Slider Start-->
<section class="main-slider clearfix">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
        "effect": "fade",
        "pagination": {
        "el": "#main-slider-pagination",
        "type": "bullets",
        "clickable": true
        },
        "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
        },
        "autoplay": {
        "delay": 5000
        }}'>
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider )
            <div class="swiper-slide">
                <div class="image-layer" style="background-image: url({{asset($slider->image)}});"></div>
                <!-- /.image-layer -->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-slider__content">
                                <h1 class="main-slider__title">
                                    {{$slider->title_one}}
                                </h1>
                                <p class="main-slider__text">
                                    {{$slider->title_two}}
                                </p>
                                @php
                                    $heroPhone = siteInfo()->topbar_phone;
                                    $heroTel = $heroPhone ? preg_replace('/[^0-9+]/', '', $heroPhone) : '';
                                @endphp
                                <div class="main-slider__btn-box">
                                    <a href="{{route('front.contact')}}" class="thm-btn main-slider__btn d-none d-md-inline-block">Schedule an Appointment Today</a>
                                    <a href="{{ $heroTel ? 'tel:' . $heroTel : '#' }}" class="thm-btn main-slider__btn d-inline-block d-md-none">Schedule an Appointment Today</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- If we need navigation buttons -->
        <div class="main-slider__nav">
            <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                <i class="fa-solid fa-arrow-left"></i>
            </div>
            <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>


    </div>
</section>
<!--Main Slider End-->



<!--About One Start-->
<section class="about-one">
    <div class="about-one__bg float-bob-y" style="background-image: url({{asset('frontend/assets/images/backgrounds/about-one-bg-img-1.jpg')}});">
    </div>
    <div class="container">
        <div class="section-title text-center">

            <h2 class="section-title__title">Welcome To
                <br>Smartphone & Laptop Repair Service Center</h2>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="about-one__left">
                    <div class="about-one__img wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <img src="{{asset('frontend/assets/images/resources/about-1-1.jpg')}}" alt="">
                        <div class="about-one__our-goal">
                            <p class="about-one__our-goal-sub-title">What You Wanna Fix:</p>
                            <h3 class="about-one__our-goal-title">"Smartphone or Laptop"</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about-one__right">
                    {{-- <div class="section-title text-left">
                        <span class="section-title__tagline">OUR INTRODUCTION</span>
                        <h2 class="section-title__title">Welcome To Smartphone & Laptop Repair Service Center</h2>
                    </div>
                    <p class="about-one__right-text-1">Black Tech Black Tech</p> --}}
                    <ul class="about-one__points list-unstyled">
                        @foreach ($feateuredCategories->take(6) as $key => $item)
                        <li>
                            <a href="{{ route('front.services.category', ['category' => $item->category->slug]) }}">
                            <div class="about-one__points-single">
                                <div class="about-one__points-icon">
                                    <span class="">
                                        <img src="{{ asset($item->category->image) }}" alt="" class="img-fluid" >
                                    </span>
                                </div>
                                <div class="about-one__points-text">
                                    <h3 class="about-one__points-title">{{ $item->category->name }}</h3>
                                    <p class="about-one__points-subtitle">{!! Str::limit($item->category->short_description, 80, ' ...') !!}
                                    </p>
                                </div>
                            </div>
                            </a>
                        </li>
                        @endforeach


                    </ul>
                    <a href="{{route('front.contact')}}" class="thm-btn">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About One End-->

<!--Experience One Start-->
<section class="experience-one">
    <div class="experience-one-shape-1 shapeMover" style="background-image: url({{ asset('frontend/assets/images/shapes/experience-one-shape-1.png') }});"></div>
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">About Experience</span>
            <h2 class="section-title__title">We Have  5 Years Experience in
                <br>Smartphone & Laptop Repair Services</h2>
        </div>
        <div class="row">
            <!--Experience One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                <div class="experience-one__single">
                    <div class="experience-one__icon">
                        <span class="">
                            <i class="fa fa-wrench" aria-hidden="true"></i>

                        </span>
                    </div>
                    <div class="experience-one__content">
                        <h3 class="experience-one__title"><a href="">Quality Services</a>
                        </h3>
                        <p class="experience-one__text">DC Phone Repair </p>
                    </div>
                </div>
            </div>
            <!--Experience One Single End-->
            <!--Experience One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                <div class="experience-one__single">
                    <div class="experience-one__icon">
                        <span class="">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="experience-one__content">
                        <h3 class="experience-one__title"><a href="team.html">Professional Team</a></h3>
                        <p class="experience-one__text"> DC Phone Repair </p>
                    </div>
                </div>
            </div>
            <!--Experience One Single End-->
            <!--Experience One Single Start-->
            <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                <div class="experience-one__single">
                    <div class="experience-one__icon">
                        <span class="">
                            <i class="fa fa-wrench" aria-hidden="true"></i>

                        </span>
                    </div>
                    <div class="experience-one__content">
                        <h3 class="experience-one__title"><a href="contact.html">24 Hour Support</a></h3>
                        <p class="experience-one__text"> DC Phone Repair </p>
                    </div>
                </div>
            </div>
            <!--Experience One Single End-->
        </div>
    </div>
</section>
<!--Experience One End-->

<!--Services One Start-->
<section class="services-one">
    <div class="services-one-shape-1 float-bob-x">
        <img src="{{asset('frontend/assets/images/shapes/services-one-shape-1.png')}}" alt="">
    </div>
    <div class="services-one-shape-2 float-bob-y">
        <img src="{{asset('frontend/assets/images/shapes/services-one-shape-2.png')}}" alt="">
    </div>
    <div class="container">
        <div class="section-title section-title--two text-center services-one__section-title">
            <span class="section-title__tagline">OUR SERVICES</span>
            <h2 class="section-title__title">Our Efficient Solution</h2>
            <p class="section-title__text">DC Phone Repair</p>
        </div>
        <div class="row">
            @foreach($products as $key=>$product)
            <!--Services One Single Start-->
            
            <div class="col-xl-2 col-lg-2 col-sm-6 col-6 wow fadeInUp" data-wow-delay="100ms">
                <a href="{{route('front.repair', $product->slug)}}">
                <div class="services-one__single">
                    <div class="services-one__img">
                        <img src="{{asset($product->thumb_image)}}" alt="" style="width: 40%; display: block; margin: 0 auto">

                    </div>
                    <div class="services-one__content">
                        <p class="services-one__title" style="font-size: 18px;font-weight: bold;">{{$product->name}}</p>
                        {{-- <p class="services-one__text">Black Tech</p> --}}
                        <!--<div class="services-one__btn-box">-->
                        <!--    <a href="{{route('front.repair', $product->slug)}}" class="thm-btn services-one__btn">Repair Now</a>-->
                        <!--</div>-->
                    </div>
                </div>
                </a>
            </div>
            
            <!--Services One Single Start-->
            @endforeach
        </div>
    </div>
</section>
<!--Services One End-->

<!--Why Choose One Start-->
<section class="why-choose-one">
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">Why Choose Us</span>
            <h2 class="section-title__title">Phone Repair For Everyone</h2>
            <p class="section-title__text">DC Phone Repair</p>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                <!--Why Choose One Single Start-->
                <div class="why-choose-one__single">
                    <div class="why-choose-one__icon">
                        <span class="">
                            <i class="fa-solid fa-certificate"></i>
                        </span>
                    </div>
                    <div class="why-choose-one__content">
                        <h3 class="why-choose-one__title"><a href="services-details.html">Quality Repair</a>
                        </h3>
                        <p class="why-choose-one__text">Discover excellence in repairs at Phone Repair Stop.</p>
                    </div>
                </div>
                <!--Why Choose One Single Start-->
            </div>
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="200ms">
                <!--Why Choose One Single Start-->
                <div class="why-choose-one__single">
                    <div class="why-choose-one__icon">
                        <span class="">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <div class="why-choose-one__content">
                        <h3 class="why-choose-one__title"><a href="">Customer Service</a>
                        </h3>
                        <p class="why-choose-one__text">we are ready to give our best to our customers</p>
                    </div>
                </div>
                <!--Why Choose One Single Start-->
            </div>
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="300ms">
                <!--Why Choose One Single Start-->
                <div class="why-choose-one__single">
                    <div class="why-choose-one__icon">
                        <span class="">
                            <i class='fas fa-lock'></i>
                        </span>
                    </div>
                    <div class="why-choose-one__content">
                        <h3 class="why-choose-one__title"><a href="services-details.html">Secured Device</a>
                        </h3>
                        <p class="why-choose-one__text">We always try to secure Device</p>
                    </div>
                </div>
                <!--Why Choose One Single Start-->
            </div>
            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="400ms">
                <!--Why Choose One Single Start-->
                <div class="why-choose-one__single">
                    <div class="why-choose-one__icon">
                        <span class="">
                            <i class='fas fa-bug'></i>
                        </span>
                    </div>
                    <div class="why-choose-one__content">
                        <h3 class="why-choose-one__title"><a href="services-details.html">No Virus Threat</a>
                        </h3>
                        <p class="why-choose-one__text">We Protect your device from virus</p>
                    </div>
                </div>
                <!--Why Choose One Single Start-->
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xl-12">
                <div class="why-choose-one__bottom">
                    <p class="why-choose-one__bottom-text">Get proper services from us <a href="about.html">guideline and
                            knowledge</a></p>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!--Why Choose One End-->




<!--Testimonial One End-->

<!--Skill One Start-->
<!-- <section class="skill-one">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="skill-one__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">Our Skills & Expertise</span>
                        <h2 class="section-title__title">We Specialize In Quick &
                            <br> Professional Repairs</h2>
                    </div>
                    <p class="skill-one__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some words which don't look even slightly believable.
                    </p>
                    <p class="skill-one__text-2">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some words which don't look even slightly believable.
                    </p>
                    <div class="skill-one__progress">
                        <div class="skill-one__progress-single">
                            <div class="bar">
                                <div class="bar-inner count-bar" data-percent="84%">
                                    <div class="count-text">84%</div>
                                    <h4 class="skill-one__progress-title">Diagnostics</h4>
                                </div>
                            </div>
                        </div>
                        <div class="skill-one__progress-single">
                            <div class="bar">
                                <div class="bar-inner count-bar" data-percent="95%">
                                    <div class="count-text">95%</div>
                                    <h4 class="skill-one__progress-title">Replacment</h4>
                                </div>
                            </div>
                        </div>
                        <div class="skill-one__progress-single">
                            <div class="bar marb-0">
                                <div class="bar-inner count-bar" data-percent="86%">
                                    <div class="count-text">86%</div>
                                    <h4 class="skill-one__progress-title">Device Repair</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="skill-one__right">
                    <div class="skill-one__right-img-box wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="skill-one__right-img">
                            <img src="assets/images/resources/skill-1-1.jpg" alt="">
                            <div class="skill-one__video-link">
                                <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">
                                    <div class="skill-one__video-icon">
                                        <span class="fa fa-play"></span>
                                        <i class="ripple"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="skill-one__video-content">
                            <p>Improve gadget smartphone laptop repair services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--Skill One End-->

<!--Contact One Start-->
<section class="contact-one">
    <div class="contact-one-bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url({{asset('frontend/assets/images/backgrounds/contact-one-bg.jpg')}});">
    </div>
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">Contact Us</span>
            <h2 class="section-title__title">Let Us Know Or Call Us At</h2>
            <p class=" section-title__text"></p>
        </div>
        <div class="contact-one__form-box">
            <form action="{{route('front.direct-message')}}"  method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="Your Name" name="name">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="contact-form__input-box">
                            <input type="email" placeholder="Email Address" name="email">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="Phone Number" name="phone">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="address" name="address">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="contact-form__input-box">
                            <input type="text" placeholder="Subject" name="subject">
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="contact-form__input-box text-message-box">
                            <textarea name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="contact-form__btn-box">
                            <button type="submit" class="thm-btn contact-form__btn">Send Message</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Contact One End-->

<!--Blog One Start-->

<!--Blog One End-->

<!--Newsletter One Start-->
<section class="newsletter-one">
    <div class="newsletter-one-bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url({{ asset('frontend/assets/images/backgrounds/newsletter-one-bg.jpg') }});"></div>
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">Contact Us</span>
            <h2 class="section-title__title">Let Us Know Or Call Us At</h2>
            @php
                $ctaPhone = siteInfo()->topbar_phone;
                $ctaTel = $ctaPhone ? preg_replace('/[^0-9+]/', '', $ctaPhone) : '';
            @endphp
            <a href="{{ $ctaTel ? 'tel:' . $ctaTel : '#' }}" class="btn btn-warning">Call Now</a>
            {{-- <p class=" section-title__text">Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore <br> eu fugiat nulla dolor atur with Lorem ipsum is simply </p> --}}
        </div>
        {{-- <form class="newsletter-one__form">
            <div class="newsletter-one__input-box">
                <input type="email" placeholder="Your Email" name="email">
                <button type="submit" class="thm-btn newsletter-one__btn">Subscribe Now</button>
            </div>
        </form> --}}
    </div>
</section>
<!--Newsletter One End-->


@endsection
