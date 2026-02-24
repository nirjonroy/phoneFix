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
    <style>
        .service-area2 .service-img img {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }
    </style>
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
@php
    $phoneFixAsset = asset('phone-fix/assets');
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Services</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- service-area -->
        <div class="service-area2 bg py-120">
            <div class="container">
                <div class="row">
                    @forelse($all_service as $item)
                        @php
                            $delay = number_format(0.25 + (0.25 * ($loop->index % 3)), 2);
                            $serviceImageIndex = str_pad((($loop->index % 6) + 1), 2, '0', STR_PAD_LEFT);
                            $serviceImage = $item->image ? asset($item->image) : ($phoneFixAsset . '/img/service/' . $serviceImageIndex . '.jpg');
                            $serviceIcon = $item->image ? asset($item->image) : ($phoneFixAsset . '/img/icon/repair.svg');
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ $delay }}s">
                                <div class="service-img">
                                    <a href="{{ route('front.services.category', ['category' => $item->slug]) }}">
                                        <img src="{{ $serviceImage }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                                <div class="service-item-wrap">
                                    <div class="service-icon">
                                        <img src="{{ $serviceIcon }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="service-content">
                                        <h3 class="service-title">
                                            <a href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
                                        </h3>
                                        <p class="service-text">
                                            {{ Str::limit($item->short_description ?? '', 120) }}
                                        </p>
                                        <div class="service-arrow">
                                            <a href="{{ route('front.services.category', ['category' => $item->slug]) }}" class="theme-btn"> Read More<i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <p class="text-center">No services found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- service-area -->

</main>
@endsection
