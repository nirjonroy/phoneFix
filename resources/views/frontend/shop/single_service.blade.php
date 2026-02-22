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
<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{asset('frontend/assets/images/features1.jpg')}})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h1>{{ $service->name }}</h1>
            @if($heroDescription)
                <p>{{ $heroDescription }}</p>
            @endif
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li><span>//</span></li>
                <li><a href="{{ route('front.repair.all') }}">Services</a></li>
                @if($category)
                    <li><span>//</span></li>
                    <li><a href="{{ route('front.services.category', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                @endif
                @if($category && $subCategory)
                    <li><span>//</span></li>
                    <li><a href="{{ route('front.services.subcategory', ['category' => $category->slug, 'subcategory' => $subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
                @endif
                @if($category && $subCategory && $childCategory)
                    <li><span>//</span></li>
                    <li><a href="{{ route('front.services.childcategory', ['category' => $category->slug, 'subcategory' => $subCategory->slug, 'child' => $childCategory->slug]) }}">{{ $childCategory->name }}</a></li>
                @endif
                <li><span>//</span></li>
                <li>{{ $service->name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Product Details Start-->
<section class="product-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="product-details__img">
                    <img src="{{asset($service->thumb_image)}}" alt="" />
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="product-details__top">
                    <h3 class="product-details__title"> {{$service->name}}  </h3>
                </div>

                <div class="product-details__content">
                    <p class="product-details__content-text1">{!!$service->short_description!!}</p>
                </div>

                    <div class="product-details__buttons-2">
                        <a href="{{ route('front.repair', $service->slug) }}" class="thm-btn">Book An Appointment</a>
                    </div>
                </div>
                {{-- <div class="product-details__social">
                    <div class="title">
                        <h3>Share with friends</h3>
                    </div>
                    <div class="product-details__social-link">
                        <a href="#"><span class="fab fa-twitter"></span></a>
                        <a href="#"><span class="fab fa-facebook"></span></a>
                        <a href="#"><span class="fab fa-pinterest-p"></span></a>
                        <a href="#"><span class="fab fa-instagram"></span></a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>


<!--Services One Start-->
<section class="services-one">
    <div class="services-one-shape-1 float-bob-x">
        <img src="{{asset('frontend/assets/images/shapes/services-one-shape-1.png')}}" alt="">
    </div>
    <div class="services-one-shape-2 float-bob-y">
        <img src="{{asset('frontend/assets/images/shapes/services-one-shape-2.png')}}" alt="">
    </div>
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">Related</span>
            <h2 class="section-title__title">Related Services</h2>
            <p class="section-title__text">DC Phone Repair</p>
        </div>
        <div class="row">
            @foreach($related_product as $key=>$product)
            <!--Services One Single Start-->
            
            <div class="col-xl-2 col-lg-2 col-sm-6 col-6 wow fadeInUp" data-wow-delay="100ms">
                <a href="{{route('front.repair', $product->slug)}}">
                <div class="services-one__single">
                    <div class="services-one__img">
                        <img src="{{asset($product->thumb_image)}}" alt="" style="width: 40%; display: block; margin: 0 auto">

                    </div>
                    <div class="services-one__content">
                        <p class="services-one__title" style="font-size: 18px;font-weight: bold;">{{$product->name}}</p>
                        {{-- <p class="services-one__text">Black Tech</p> --}}
                        <!--<div class="services-one__btn-box">-->
                        <!--    <a href="{{route('front.repair', $product->slug)}}" class="thm-btn services-one__btn">Repair Now</a>-->
                        <!--</div>-->
                    </div>
                </div>
                </a>
            </div>
            <!--Services One Single Start-->
            @endforeach
        </div>
    </div>
</section>
<!--Services One End-->

@endsection
