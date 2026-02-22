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
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
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
<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{asset('frontend/assets/images/about_bg.webp')}})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h1>About Us</h1>
            <p>{{$about_us->description_three}} </p>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li><span>//</span></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--About Two Start-->
<section class="about-two about-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="about-two__left">
                    <div class="about-two__main-progress-box">
                        <div class="about-two__progress-single">
                            <div class="about-two__progress-box">
                                <div class="circle-progress" data-options='{ "value": 0.8,"thickness": 10,"emptyFill": "#f1f1f1","lineCap": "square", "size": 110, "fill": { "color": "#cf1f1f" } }'>
                                </div>
                                <!-- /.circle-progress -->
                                <div class="about-two__pack">
                                    <p>85%</p>
                                </div>
                            </div>
                            <div class="about-two__progress-content">
                                <p>Repair Device</p>
                            </div>
                        </div>
                        <div class="about-two__progress-single">
                            <div class="about-two__progress-box">
                                <div class="circle-progress" data-options='{ "value": 0.9,"thickness": 10,"emptyFill": "#f1f1f1","lineCap": "square", "size": 110, "fill": { "color": "#cf1f1f" } }'>
                                </div>
                                <!-- /.circle-progress -->
                                <div class="about-two__pack">
                                    <p>95%</p>
                                </div>
                            </div>
                            <div class="about-two__progress-content">
                                <p>Replace Device</p>
                            </div>
                        </div>
                    </div>
                    <div class="about-two__img-box">
                        <div class="about-two__img">
                            <img src="{{ asset('frontend/assets/images/resources/about-2-1.jpg') }}" alt="">
                        </div>
                        <div class="about-two__img-two">
                            <img src="{{ asset($about_us->video_background) }}" alt="">
                            {{-- <div class="about-two__video-link">
                                <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">
                                    <div class="about-two__video-icon">
                                        <span class="fa fa-play"></span>
                                        <i class="ripple"></i>
                                    </div>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="about-two__shape-1 shapeMover">
                        <img src="{{ asset('frontend/assets/images/shapes/about-two-shape-1.png') }}" alt="">
                    </div>
                    <div class="about-two__shape-2 float-bob-y">
                        <img src="{{ asset('frontend/assets/images/shapes/about-two-shape-2.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="about-two__right">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">Quality Repair</span>
                        <h2 class="section-title__title">We Can Fix It Almost As Fast As You Can Break It.</h2>
                    </div>
                    <p class="about-two__text-1">{!!$about_us->about_us!!}</p>
                    {{-- <ul class="list-unstyled about-two__points">
                        <li>
                            <div class="icon">
                                <span class="icon-award"></span>
                            </div>
                            <div class="text">
                                <p>WE ALWAYS PUT QUALITY FIRST</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-community"></span>
                            </div>
                            <div class="text">
                                <p>CUSTOMER SATISFACTION IS ABSOLUTE</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-warranty"></span>
                            </div>
                            <div class="text">
                                <p>FAST AND QUALITY WORK</p>
                            </div>
                        </li>
                    </ul>
                    <p class="about-two__text-2">Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore eu fugiat nulla dolor atur with Lorem ipsum is simply free text market web bites eius mod ut labore duis aute irure pari</p> --}}
                    <a href="{{route('front.contact')}}" class="thm-btn">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About Two End-->
@endsection
