@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $firstService = null;
    if (isset($services)) {
        if ($services instanceof \Illuminate\Support\Collection && $services->count()) {
            $firstService = $services->first();
        } elseif (is_array($services) && count($services)) {
            $firstService = $services[0];
        }
    }
    $category = $firstService?->category;
    $subCategory = $firstService?->subCategory;
    $childCategory = $firstService?->childCategory;
    $contextCategory = $childCategory ?: ($subCategory ?: $category);
    $metaBaseTitle = $contextCategory?->name ?? 'Services';
    $metaTitle = $contextCategory?->meta_title ?: ($contextCategory?->seo_title ?: ($metaBaseTitle !== 'Services' ? $metaBaseTitle . ' Repair Services' : 'Device Repair Services'));
    $metaDescription = $contextCategory?->meta_description ?: ($contextCategory?->seo_description ?: strip_tags($contextCategory?->short_description ?? ''));
    $metaImage = $contextCategory?->meta_image ? asset($contextCategory->meta_image) : ($contextCategory?->image ? asset($contextCategory->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $contextCategory?->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
    $metaKeywords = $contextCategory?->keywords ?: ($SeoSettings?->keywords ?? '');
    $metaAuthor = $contextCategory?->author ?: ($SeoSettings?->author ?? '');
    $metaPublisher = $contextCategory?->publisher ?: ($SeoSettings?->publisher ?? '');
    $metaCopyright = $contextCategory?->copyright ?: ($SeoSettings?->copyright ?? '');
    $headerTitleParts = [];
    if ($category) {
        $headerTitleParts[] = $category->name;
    }
    if ($subCategory) {
        $headerTitleParts[] = $subCategory->name;
    }
    if ($childCategory) {
        $headerTitleParts[] = $childCategory->name;
    }
    $headerTitle = $headerTitleParts ? implode(' / ', $headerTitleParts) : ($contextCategory?->name ?? 'Services');
    $headerDescription = $contextCategory?->short_description ?: ($contextCategory?->seo_description ?: '');
@endphp
@section('title', $metaTitle)
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
    @if($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
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
@push('css')
    <style>
        .solutions-image img {
            width: 100%;
            border-radius: 20px;
        }
        .solutions-image {
            margin-top: 0;
        }
        .solutions-list .solution-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            background: #fff;
            margin-bottom: 16px;
        }
        .solutions-list .solution-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--theme-color);
            color: #fff;
            font-size: 26px;
            flex-shrink: 0;
            overflow: hidden;
        }
        .solutions-list .solution-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: none;
        }
        .solutions-list .solution-content h5 {
            margin-bottom: 6px;
        }
        .solutions-list .solution-content p {
            margin-bottom: 0;
        }
    </style>
@endpush
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
    $heroImage = $contextCategory?->image ? asset($contextCategory->image) : ($firstService?->thumb_image ? asset($firstService->thumb_image) : $phoneFixAsset . '/img/service/single.jpg');
    $descriptionText = $headerDescription ?: 'We provide fast, reliable repairs for phones, tablets, and computers using quality parts and expert technicians.';
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $headerTitle }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">{{ $headerTitle }}</li>
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
                                    <h3 class="mb-2">{{ $headerTitle }}</h3>
                                </div>
                                <div class="row align-items-start g-4">
                                    <div class="col-lg-5">
                                        <div class="solutions-image">
                                            <img src="{{ $heroImage }}" alt="{{ $headerTitle }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="site-heading mb-3">
                                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> What We Fixing</span>
                                            <h2 class="site-title">Providing Device <span>Solutions</span></h2>
                                        </div>
                                        <div class="solutions-list">
                                            @forelse($services as $service)
                                                @php
                                                    $solutionImage = $service->thumb_image ? asset($service->thumb_image) : ($phoneFixAsset . '/img/icon/repair.svg');
                                                    $solutionLink = route('front.single.service', ['slug' => $service->slug]);
                                                @endphp
                                                <div class="solution-item">
                                                    <div class="solution-icon">
                                                        <img src="{{ $solutionImage }}" alt="{{ $service->name }}">
                                                    </div>
                                                    <div class="solution-content">
                                                        <h5><a href="{{ $solutionLink }}">{{ $service->name }}</a></h5>
                                                        <p>{{ Str::limit(strip_tags($service->short_description ?? $service->long_description ?? ''), 120) }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No solutions available yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                @if($descriptionText)
                                    <div class="mt-4">
                                        <h4 class="mb-2">About {{ $headerTitle }}</h4>
                                        <p>{{ strip_tags($descriptionText) }}</p>
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
