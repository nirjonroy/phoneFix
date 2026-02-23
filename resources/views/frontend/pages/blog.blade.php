@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 4)->first();
    $metaTitle = $SeoSettings ? ($SeoSettings->meta_title ?: $SeoSettings->seo_title) : 'Blog';
    $metaDescription = $SeoSettings ? ($SeoSettings->meta_description ?: $SeoSettings->seo_description) : '';
    $metaImage = $SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '';
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'Blog- DC Phone Repair')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('seos')
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $SeoSettings ? $SeoSettings->seo_title : 'Blog' }}">
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
@php
    $phoneFixAsset = asset('phone-fix/assets');
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Our Blog</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">Our Blog</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- blog-area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    @forelse($blog as $b)
                        @php
                            $blogImage = $b->image ? asset($b->image) : $phoneFixAsset . '/img/blog/01.jpg';
                            $blogDate = $b->created_at ? $b->created_at->format('M d, Y') : '';
                            $blogAuthor = optional($b->admin)->name ?: 'Admin';
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ number_format(0.25 + (0.25 * ($loop->index % 3)), 2) }}s">
                                @if($blogDate)
                                    <span class="blog-date"><i class="far fa-calendar-alt"></i> {{ $blogDate }}</span>
                                @endif
                                <div class="blog-item-img">
                                    <img src="{{ $blogImage }}" alt="{{ $b->title }}">
                                </div>
                                <div class="blog-item-info">
                                    <h4 class="blog-title">
                                        <a href="{{ route('front.blog_details', $b->slug) }}">{{ $b->title }}</a>
                                    </h4>
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By {{ $blogAuthor }}</a></li>
                                        </ul>
                                    </div>
                                    <p>
                                        {{ Str::limit(strip_tags($b->description ?? ''), 120) }}
                                    </p>
                                    <a class="theme-btn" href="{{ route('front.blog_details', $b->slug) }}">Read More<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No blog posts found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- blog-area end -->

</main>
@endsection
