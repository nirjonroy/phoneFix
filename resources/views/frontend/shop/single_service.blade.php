@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $service->meta_title ?: ($service->seo_title ? $service->seo_title : $service->name);
    $metaDescription = $service->meta_description ?: ($service->seo_description ? $service->seo_description : strip_tags($service->short_description));
    $metaImage = $service->meta_image ? asset($service->meta_image) : ($service->thumb_image ? asset($service->thumb_image) : ($SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $service->site_name ?: ($SeoSettings->site_name ?: $SeoSettings->seo_title);
    $metaKeywords = $service->keywords ?: ($SeoSettings->keywords ?: '');
    $metaAuthor = $service->author ?: ($SeoSettings->author ?: '');
    $metaPublisher = $service->publisher ?: ($SeoSettings->publisher ?: '');
    $metaCopyright = $service->copyright ?: ($SeoSettings->copyright ?: '');
    $metaModifiedTime = $service->updated_at ? $service->updated_at->toAtomString() : null;
    $category = $service->category;
    $subCategory = $service->subCategory;
    $childCategory = $service->childCategory;
    $heroDescription = $service->short_description
        ? Str::limit(strip_tags($service->short_description), 140)
        : ($service->seo_description ?: ($category?->short_description ?: ($SeoSettings->seo_description ?? '')));
@endphp
@section('title', $metaTitle . ' - DC-Phone-Repair')
@push('css')

@endpush
@section('seos')


    <meta charset="UTF-8">

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta name="title" content="{{$metaTitle}}">

    <meta name="description" content="{{$metaDescription}}">
    @if($metaKeywords)
        <meta name="keywords" content="{{$metaKeywords}}">
    @endif
    @if($metaAuthor)
        <meta name="author" content="{{$metaAuthor}}">
    @endif
    @if($metaPublisher)
        <meta name="publisher" content="{{$metaPublisher}}">
        <meta property="article:publisher" content="{{$metaPublisher}}">
    @endif
    @if($metaCopyright)
        <meta name="copyright" content="{{$metaCopyright}}">
    @endif
    <link rel="canonical" href="{{url()->current()}}">
    <meta property="og:title" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$metaDescription}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="{{$siteName}}">

    @if($metaImage)
        <meta property="og:image" content="{{$metaImage}}">
    @endif
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    
    
    @if($metaModifiedTime)
        <meta property="article:modified_time" content="{{ $metaModifiedTime }}">
    @endif
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
    $serviceImage = $service->thumb_image ? asset($service->thumb_image) : ($phoneFixAsset . '/img/service/single.jpg');
    $serviceShort = $service->short_description ?: ($service->seo_description ?: '');
    $serviceLong = $service->long_description ?: '';
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $service->name }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li><a href="{{ route('front.repair.all') }}">Services</a></li>
                    @if($category)
                        <li><a href="{{ route('front.services.category', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                    @endif
                    @if($category && $subCategory)
                        <li><a href="{{ route('front.services.subcategory', ['category' => $category->slug, 'subcategory' => $subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
                    @endif
                    @if($category && $subCategory && $childCategory)
                        <li><a href="{{ route('front.services.childcategory', ['category' => $category->slug, 'subcategory' => $subCategory->slug, 'child' => $childCategory->slug]) }}">{{ $childCategory->name }}</a></li>
                    @endif
                    <li class="active">{{ $service->name }}</li>
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
                                    <img src="{{ $serviceImage }}" alt="{{ $service->name }}">
                                </div>
                                <div class="service-details">
                                    <h3 class="mb-20">{{ $service->name }}</h3>
                                    @if($serviceShort)
                                        <p class="mb-20">{!! $serviceShort !!}</p>
                                    @endif
                                    @if($serviceLong)
                                        <div class="mb-20">{!! $serviceLong !!}</div>
                                    @endif
                                    <div class="my-4">
                                        <a href="{{ route('front.repair', $service->slug) }}" class="theme-btn">Book An Appointment <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service-single end -->

        @if($related_product->count())
            <div class="service-area2 bg py-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="site-heading text-center">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Related</span>
                                <h2 class="site-title">Related <span>Services</span></h2>
                                <div class="heading-divider"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($related_product as $product)
                            @php
                                $relatedImage = $product->thumb_image ? asset($product->thumb_image) : ($phoneFixAsset . '/img/service/01.jpg');
                                $relatedIcon = $product->thumb_image ? asset($product->thumb_image) : ($phoneFixAsset . '/img/icon/repair.svg');
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ number_format(0.25 + (0.25 * ($loop->index % 3)), 2) }}s">
                                    <div class="service-img">
                                        <img src="{{ $relatedImage }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="service-item-wrap">
                                        <div class="service-icon">
                                            <img src="{{ $relatedIcon }}" alt="{{ $product->name }}">
                                        </div>
                                        <div class="service-content">
                                            <h3 class="service-title">
                                                <a href="{{ route('front.single.service', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <p class="service-text">
                                                {{ Str::limit(strip_tags($product->short_description ?? ''), 120) }}
                                            </p>
                                            <div class="service-arrow">
                                                <a href="{{ route('front.single.service', ['slug' => $product->slug]) }}" class="theme-btn"> Read More<i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

</main>
@endsection
