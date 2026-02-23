@extends('frontend.app')
@php
    $currentCategory = $currentCategory ?? ($categories->first()->category ?? null);
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $currentCategory?->meta_title ?: ($currentCategory?->seo_title ?: ($currentCategory?->name ?? 'Services'));
    $metaDescription = $currentCategory?->meta_description ?: ($currentCategory?->seo_description ?: strip_tags($currentCategory?->short_description ?? ''));
    $metaImage = $currentCategory?->meta_image ? asset($currentCategory->meta_image) : ($currentCategory?->image ? asset($currentCategory->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $currentCategory?->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
@endphp
@section('title', $metaTitle)
@push('css')
    <style>
        .service-area2 .service-img img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        .service-area2 .service-item-wrap ul {
            margin-bottom: 0;
        }
    </style>
@endpush

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
@php
    $phoneFixAsset = asset('phone-fix/assets');
    $categoryName = $currentCategory?->name ?? 'Services';
    $categoryDescription = $currentCategory?->short_description ?: ($currentCategory?->seo_description ?: '');
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $categoryName }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">{{ $categoryName }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- service-single -->
        <div class="service-single-area py-120">
            <div class="container">
                <div class="service-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="service-sidebar">
                                <div class="widget category">
                                    <h4 class="widget-title">All Services</h4>
                                    <div class="category-list">
                                        @foreach(categories() as $item)
                                            <a href="{{ route('front.services.category', ['category' => $item->slug]) }}">
                                                <i class="far fa-angle-double-right"></i>{{ $item->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="widget service-download">
                                    <h4 class="widget-title">Need Help?</h4>
                                    <a href="{{ route('front.contact') }}"><i class="far fa-file-alt"></i> Contact Our Team</a>
                                    @php
                                        $servicePhone = siteInfo()->topbar_phone ?? '';
                                        $serviceTel = $servicePhone ? preg_replace('/[^0-9+]/', '', $servicePhone) : '';
                                    @endphp
                                    <a href="{{ $serviceTel ? 'tel:' . $serviceTel : '#' }}"><i class="far fa-phone"></i> Call Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="service-details">
                                <div class="mb-4">
                                    <h3 class="mb-2">{{ $categoryName }} Sub Categories</h3>
                                    <p>Select a sub category to see all available child services.</p>
                                </div>
                                <div class="service-area2">
                                    <div class="row">
                                        @forelse($categories as $subCategory)
                                            @php
                                                $subImage = $subCategory->image ? asset($subCategory->image) : ($phoneFixAsset . '/img/service/01.jpg');
                                                $subIcon = $phoneFixAsset . '/img/icon/repair.svg';
                                            @endphp
                                            <div class="col-md-6 col-lg-6">
                                                <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ number_format(0.25 + (0.25 * ($loop->index % 2)), 2) }}s">
                                                    <div class="service-img">
                                                        <img src="{{ $subImage }}" alt="{{ $subCategory->name }}">
                                                    </div>
                                                    <div class="service-item-wrap">
                                                        <div class="service-icon">
                                                            <img src="{{ $subIcon }}" alt="{{ $subCategory->name }}">
                                                        </div>
                                                        <div class="service-content">
                                                            <h3 class="service-title">
                                                                <a href="{{ route('front.services.subcategory', ['category' => $subCategory->category->slug, 'subcategory' => $subCategory->slug]) }}">{{ $subCategory->name }}</a>
                                                            </h3>
                                                            <p class="service-text">
                                                                {{ Str::limit(strip_tags($subCategory->short_description ?? ''), 110) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center">No sub categories available right now.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                @if($categoryDescription)
                                    <div class="mt-4">
                                        <h4 class="mb-2">About {{ $categoryName }}</h4>
                                        <p>{{ strip_tags($categoryDescription) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service-single end-->

</main>
@endsection

@push('js')
@endpush
