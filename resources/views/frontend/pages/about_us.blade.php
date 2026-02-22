@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 2)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'About Us- DC Phone Repair')
@push('css')
@endpush
@section('seos')
    
    <meta charset="UTF-8">
    
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
    <link rel="canonical" href="{{url()->current()}}">
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
    <meta name="twitter:url" content="{{url()->current()}}">
    @if($metaImage)
        <meta name="twitter:image" content="{{$metaImage}}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
@endsection
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">About Us</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">About Us</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- about area -->
        <div class="about-area py-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="about-img-1">
                                    <img src="{{ $phoneFixAsset }}/img/about/01.jpg" alt="">
                                </div>
                                <div class="about-img-2">
                                    <img src="{{ $phoneFixAsset }}/img/about/02.jpg" alt="">
                                </div>
                            </div>
                            <div class="about-shape"><img src="{{ $phoneFixAsset }}/img/shape/01.png" alt=""></div>
                            <div class="about-experience">
                                <h1>25+</h1>
                                <div class="about-experience-text">
                                    Years Of <br> Experience
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> About Us</span>
                                <h2 class="site-title">
                                    We Provide Quality <span>Repair</span> Services
                                </h2>
                            </div>
                            <p class="about-text">
                                There are many variations of passages available randomised words which the majority have suffered alteration in some form, by injected humour look page when looking at its layout even slightly believable.
                            </p>
                            <div class="about-list-wrap">
                                <ul class="about-list list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <img src="{{ $phoneFixAsset }}/img/icon/money.svg" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>Our Affordable Price</h4>
                                            <p>There are many variations of passage majority have suffered some form injected humour.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ $phoneFixAsset }}/img/icon/trusted.svg" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>Trusted Repair Service</h4>
                                            <p>There are many variations of passage majority have suffered some form injected humour.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('front.about-us') }}" class="theme-btn mt-4">Discover More <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->


        <!-- counter area -->
        <div class="counter-area pt-100">
            <div class="container">
                <div class="counter-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="counter-box">
                                <div class="icon">
                                    <img src="{{ $phoneFixAsset }}/img/icon/repair-2.svg" alt="">
                                </div>
                                <div>
                                    <span class="counter" data-count="+" data-to="1200" data-speed="3000">1200</span>
                                    <h6 class="title">+ Projects Done </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="counter-box">
                                <div class="icon">
                                    <img src="{{ $phoneFixAsset }}/img/icon/happy.svg" alt="">
                                </div>
                                <div>
                                    <span class="counter" data-count="+" data-to="1500" data-speed="3000">1500</span>
                                    <h6 class="title">+ Happy Clients</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="counter-box">
                                <div class="icon">
                                    <img src="{{ $phoneFixAsset }}/img/icon/team-2.svg" alt="">
                                </div>
                                <div>
                                    <span class="counter" data-count="+" data-to="400" data-speed="3000">400</span>
                                    <h6 class="title">+ Experts Staffs</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="counter-box">
                                <div class="icon">
                                    <img src="{{ $phoneFixAsset }}/img/icon/award.svg" alt="">
                                </div>
                                <div>
                                    <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                                    <h6 class="title">+ Win Awards</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- counter area end -->


        <!-- choose area -->
        <div class="choose-area py-120">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="choose-content wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Why Choose Us</span>
                                <h2 class="site-title">
                                    When You Need Repair <span>We Are</span> Always Here
                                </h2>
                            </div>
                            <p>
                                There are many variations of passages of Lorem Ipsum available but the randomised words which don't look even slightly believable.
                            </p>
                            <div class="choose-wrapper mt-4">
                                <div class="choose-item">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/team-2.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Skilled Technicians</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                                <div class="choose-item active">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/quality.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Quality Guarantee</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                                <div class="choose-item">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/trusted.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Your Trusted Partner</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="choose-img wow fadeInRight" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="row g-4">
                                <div class="col-6">
                                    <img class="img-1" src="{{ $phoneFixAsset }}/img/choose/01.jpg" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-2" src="{{ $phoneFixAsset }}/img/choose/02.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose area end -->


        <!-- testimonial-area -->
        <div class="testimonial-area py-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Testimonials</span>
                            <h2 class="site-title text-white">What Client <span>Say's</span> About Us</h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                    <div class="testimonial-single">
                        <div class="testimonial-content">
                            <div class="testimonial-author-img">
                                <img src="{{ $phoneFixAsset }}/img/testimonial/01.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Sylvia H Green</h4>
                                <p>Clients</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected popularity belief believable.
                            </p>
                            <div class="testimonial-quote-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/quote.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-single">
                        <div class="testimonial-content">
                            <div class="testimonial-author-img">
                                <img src="{{ $phoneFixAsset }}/img/testimonial/02.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Gordo Novak</h4>
                                <p>Clients</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected popularity belief believable.
                            </p>
                            <div class="testimonial-quote-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/quote.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-single">
                        <div class="testimonial-content">
                            <div class="testimonial-author-img">
                                <img src="{{ $phoneFixAsset }}/img/testimonial/03.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Reid E Butt</h4>
                                <p>Clients</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected popularity belief believable.
                            </p>
                            <div class="testimonial-quote-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/quote.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-single">
                        <div class="testimonial-content">
                            <div class="testimonial-author-img">
                                <img src="{{ $phoneFixAsset }}/img/testimonial/04.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Parker Jimenez</h4>
                                <p>Clients</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected popularity belief believable.
                            </p>
                            <div class="testimonial-quote-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/quote.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-single">
                        <div class="testimonial-content">
                            <div class="testimonial-author-img">
                                <img src="{{ $phoneFixAsset }}/img/testimonial/05.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Heruli Nez</h4>
                                <p>Clients</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected popularity belief believable.
                            </p>
                            <div class="testimonial-quote-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/quote.svg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial-area end -->


        <!-- team-area -->
        <div class="team-area bg pt-80 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Our Team</span>
                            <h2 class="site-title">Meet Our Experts <span>Team</span></h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="team-img">
                                <img src="{{ $phoneFixAsset }}/img/team/01.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Chad Smith</a></h5>
                                    <span>Technician</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="team-img">
                                <img src="{{ $phoneFixAsset }}/img/team/02.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Arron Rodri</a></h5>
                                    <span>CEO & Founder</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="team-img">
                                <img src="{{ $phoneFixAsset }}/img/team/03.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Malissa Fie</a></h5>
                                    <span>Technician</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="team-img">
                                <img src="{{ $phoneFixAsset }}/img/team/04.jpg" alt="thumb">
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="#">Tony Pinto</a></h5>
                                    <span>Technician</span>
                                </div>
                            </div>
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team-area end -->


        <!-- partner area -->
        <div class="partner-area pt-50 pb-50">
            <div class="container">
                <div class="partner-wrapper partner-slider owl-carousel owl-theme">
                    <img src="{{ $phoneFixAsset }}/img/partner/01.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/02.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/03.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/04.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/05.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/06.png" alt="thumb">
                    <img src="{{ $phoneFixAsset }}/img/partner/03.png" alt="thumb">
                </div>
            </div>
        </div>
        <!-- partner area end -->

</main>
@endsection
