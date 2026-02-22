
@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 4)->first();
    $metaTitle = $blog->meta_title ?: ($blog->seo_title ? $blog->seo_title : $blog->title);
    $metaDescription = $blog->meta_description ?: ($blog->seo_description ? $blog->seo_description : Str::limit(strip_tags($blog->description), 160, ''));
    $metaImage = $blog->meta_image ? asset($blog->meta_image) : ($blog->image ? asset($blog->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $blog->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
    $metaKeywords = $blog->keywords ?: ($SeoSettings && $SeoSettings->keywords ? $SeoSettings->keywords : '');
    $metaAuthor = $blog->author ?: ($SeoSettings && $SeoSettings->author ? $SeoSettings->author : '');
    $metaPublisher = $blog->publisher ?: ($SeoSettings && $SeoSettings->publisher ? $SeoSettings->publisher : '');
    $metaCopyright = $blog->copyright ?: ($SeoSettings && $SeoSettings->copyright ? $SeoSettings->copyright : '');
@endphp
@section('title', $metaTitle)
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush

@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $metaTitle }}">
    <meta name="description" content="{{ $metaDescription }}">
    @if($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    @if($metaAuthor)
        <meta name="author" content="{{ $metaAuthor }}">
    @endif
    @if($metaPublisher)
        <meta name="publisher" content="{{ $metaPublisher }}">
        <meta property="article:publisher" content="{{ $metaPublisher }}">
    @endif
    @if($metaCopyright)
        <meta name="copyright" content="{{ $metaCopyright }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($siteName)
        <meta property="og:site_name" content="{{ $siteName }}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
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
            <h1>{{ $blog->title }}</h1>

            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{route('front.home')}}">Home</a></li>
                <li><span>//</span></li>
                <li>Blog Us</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--About Two Start-->
<section class="about-two about-page">
    <div class="container">
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <div class="about-two__right">
                    <div class="section-title text-left">
                        <img src="{{asset($blog->image)}}" alt="" class="img-fluid rounded float-left" style="width: 100%; height: auto">
                        <h2 class="section-title__title">{{$blog->title}}</h2>
                    </div>
                    <div class="about-two__text-1 blog-details__content">
                        {!! $blog->description !!}
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>
<!--About Two End-->
@endsection
