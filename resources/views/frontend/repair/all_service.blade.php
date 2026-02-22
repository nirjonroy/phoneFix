@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 10)->first();
    $metaTitle = $SeoSettings ? ($SeoSettings->meta_title ?: $SeoSettings->seo_title) : 'All Services';
    $metaDescription = $SeoSettings ? ($SeoSettings->meta_description ?: $SeoSettings->seo_description) : '';
    $metaImage = $SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '';
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'All Services')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush

@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $SeoSettings ? $SeoSettings->seo_title : 'All Services' }}">
    <meta name="description" content="{{ $SeoSettings ? $SeoSettings->seo_description : '' }}">
    @if($SeoSettings && $SeoSettings->keywords)
        <meta name="keywords" content="{{ $SeoSettings->keywords }}">
    @endif
    @if($SeoSettings && $SeoSettings->author)
        <meta name="author" content="{{ $SeoSettings->author }}">
    @endif
    @if($SeoSettings && $SeoSettings->publisher)
        <meta name="publisher" content="{{ $SeoSettings->publisher }}">
        <meta property="article:publisher" content="{{ $SeoSettings->publisher }}">
    @endif
    @if($SeoSettings && $SeoSettings->copyright)
        <meta name="copyright" content="{{ $SeoSettings->copyright }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($siteName)
        <meta property="og:site_name" content="{{ $siteName }}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
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
            <h1>All Services </h1>
            <p> </p>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li><span>//</span></li>
                <li>All Services</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--About Two Start-->
<section class="about-one">
    <div class="about-one__bg float-bob-y" style="background-image: url({{asset('frontend/assets/images/backgrounds/about-one-bg-img-1.jpg')}});">
    </div>
    <div class="container">
        <div class="section-title text-center">

            <h2 class="section-title__title">Welcome To DC Phone
                <br>All Services</h2>
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
                        @foreach ($all_service as $key => $item)
                        <li>
                            <a href="{{ route('front.services.category', ['category' => $item->slug]) }}">
                            <div class="about-one__points-single">
                                <div class="about-one__points-icon">
                                    <span class="">
                                        @if(!empty($item->image))
                                        <img src="{{ asset($item->image) }}" alt="" class="img-fluid" width="40px" height="50px">
                                        @endif
                                    </span>
                                </div>
                                <div class="about-one__points-text">
                                    <h3 class="about-one__points-title">{{ $item->name }}</h3>
                                    <p class="about-one__points-subtitle">{!! Str::limit($item->short_description, 80, ' ...') !!}
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
@endsection
