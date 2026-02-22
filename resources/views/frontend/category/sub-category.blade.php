@extends('frontend.app')
@php
    $currentCategory = $categories[0]->category ?? null;
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $currentCategory?->meta_title ?: ($currentCategory?->seo_title ?: ($currentCategory?->name ?? 'Services'));
    $metaDescription = $currentCategory?->meta_description ?: ($currentCategory?->seo_description ?: strip_tags($currentCategory?->short_description ?? ''));
    $metaImage = $currentCategory?->meta_image ? asset($currentCategory->meta_image) : ($currentCategory?->image ? asset($currentCategory->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $currentCategory?->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
@endphp
@section('title', $metaTitle)

@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $metaTitle }}">
    <meta name="description" content="{{ $metaDescription }}">
    @if($currentCategory?->keywords)
        <meta name="keywords" content="{{ $currentCategory->keywords }}">
    @endif
    @if($currentCategory?->author)
        <meta name="author" content="{{ $currentCategory->author }}">
    @endif
    @if($currentCategory?->publisher)
        <meta name="publisher" content="{{ $currentCategory->publisher }}">
        <meta property="article:publisher" content="{{ $currentCategory->publisher }}">
    @endif
    @if($currentCategory?->copyright)
        <meta name="copyright" content="{{ $currentCategory->copyright }}">
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
    <div class="page-header-bg" style="background-image: url(https://unicktheme.com/demo2023/fixnix/assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h1>{{ $categories[0]->category->name }}</h1>
            <p>{{ $categories[0]->category->short_description }} </p>

            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="">Home</a></li>
                <li><span>//</span></li>
                <li>Services</li>
                <li><span>//</span></li>
                <li>{{ $categories[0]->category->name }}</li>


            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Services Two Start-->
<section class="services-two">
    <div class="container">
        {{-- <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">OUR SERVICES</span>
            <h2 class="section-title__title">Our Efficient Solution</h2>
            <p class="section-title__text">Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore <br> eu fugiat nulla dolor atur with Lorem ipsum is simply</p>
        </div> --}}
        <div class="row">

            <!--Services Two Single Start-->
            @forelse($categories as $key => $subCategory)
            
            <div class="col-xl-3 col-lg-3 col-md-3 wow fadeInUp" data-wow-delay="100ms">
                <a href="{{ route('front.services.subcategory', ['category' => $subCategory->category->slug, 'subcategory' => $subCategory->slug]) }}">
                <div class="services-two__single">
                    <div class="services-two__single-inner">
                        <div class="">
                            <span class="">
                                @if($subCategory)
                                                    <img src="{{ asset($subCategory->image) }}" class="img-responsive" style="width: auto; height: 160px; display: block; margin: 0 auto;">
                                                    @else
                                                    <!--<img class="img-responsive" src="img_chania.jpg" alt="Chania" />-->
                                                    <img src="{{ asset('frontend/nothing.png') }}" class="img-responsive" style="width: 61px; height: 71px; display: block; margin: 0 auto;">
                                                    @endif
                            </span>
                        </div>
                        <h3 class="services-two__title"><a href="{{ route('front.services.subcategory', ['category' => $subCategory->category->slug, 'subcategory' => $subCategory->slug]) }}">
                            {{ $subCategory->name }}
                        </a></h3>
                        {{-- <p class="services-two__text">Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore fugiat nulla dolor atur</p> --}}
                    </div>
                </div>
                </a>
            </div>
            
            @endforeach
            <!--Services Two Single End-->
        </div>
    </div>
</section>
@endsection

@push('js')
    <!--<script src="{{ asset('frontend/silck/slick.min.js') }}"></script>-->
@endpush
