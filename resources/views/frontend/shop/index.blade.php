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

@endpush
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
    $heroImage = $contextCategory?->image ? asset($contextCategory->image) : ($firstService?->thumb_image ? asset($firstService->thumb_image) : $phoneFixAsset . '/img/service/single.jpg');
    $detailImageOne = ($services instanceof \Illuminate\Support\Collection && $services->count()) ? asset($services->first()->thumb_image) : $phoneFixAsset . '/img/service/01.jpg';
    $detailImageTwo = ($services instanceof \Illuminate\Support\Collection && $services->count() > 1) ? asset($services->skip(1)->first()->thumb_image) : $phoneFixAsset . '/img/service/02.jpg';
    $primaryDescription = $headerDescription ?: 'We provide fast, reliable repairs for phones, tablets, and computers using quality parts and expert technicians.';
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
                                <div class="service-details-img mb-30">
                                    <img src="{{ $heroImage }}" alt="{{ $headerTitle }}">
                                </div>
                                <div class="service-details">
                                    <h3 class="mb-30">{{ $headerTitle }}</h3>
                                    <p class="mb-20">{{ $primaryDescription }}</p>
                                    <p class="mb-20">
                                        We handle diagnostics, parts replacement, and full repairs with clear communication and quick turnaround times. Book an appointment and we will guide you through the best solution for your device.
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <img src="{{ $detailImageOne }}" alt="{{ $headerTitle }}">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <img src="{{ $detailImageTwo }}" alt="{{ $headerTitle }}">
                                        </div>
                                    </div>
                                    <p class="mb-20">
                                        Our technicians use tested parts and proven repair methods to restore performance and protect your data. We focus on quality and transparency so you know exactly what is being fixed.
                                    </p>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <h3 class="mb-3">Our Work Process</h3>
                                            <p>We start with a full diagnosis, confirm the repair scope, complete the fix with quality parts, then test and clean your device before pickup.</p>
                                        </div>
                                        <ul class="service-single-list">
                                            <li><i class="far fa-check"></i>Free or low-cost initial diagnosis</li>
                                            <li><i class="far fa-check"></i>Clear estimate before work begins</li>
                                            <li><i class="far fa-check"></i>Quality parts and expert technicians</li>
                                            <li><i class="far fa-check"></i>Full testing and cleanup</li>
                                            <li><i class="far fa-check"></i>Fast turnaround and support</li>
                                        </ul>
                                    </div>
                                    <div class="my-4">
                                        <h3 class="mb-3">Service Features</h3>
                                        <p>Explore the repair options available for this service category.</p>
                                        <ul class="service-single-list">
                                            @forelse($services as $service)
                                                <li><i class="far fa-check"></i>{{ $service->name }}</li>
                                            @empty
                                                <li><i class="far fa-check"></i>Screen replacement</li>
                                                <li><i class="far fa-check"></i>Battery replacement</li>
                                                <li><i class="far fa-check"></i>Diagnostics and troubleshooting</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service-single end-->

</main>
@endsection
