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
<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{asset('frontend/assets/images/single_serv.jpg')}});">
    </div>
    @php
        $heroPhone = siteInfo()->topbar_phone;
        $heroTel = $heroPhone ? preg_replace('/[^0-9+]/', '', $heroPhone) : '';
    @endphp
    <div class="container">
        <div class="page-header__inner text-center">
            <h1>{{ $headerTitle }}</h1>
            @if($headerDescription)
                <p>{{ $headerDescription }}</p>
            @endif
            <div class="page-header__btn-box text-center" style="margin-top: 18px;">
                <a href="{{route('front.contact')}}" class="thm-btn d-none d-md-inline-block">Schedule An Appointment Today</a>
                <a href="{{ $heroTel ? 'tel:' . $heroTel : '#' }}" class="thm-btn d-inline-block d-md-none">Schedule An Appointment Today</a>
            </div>
            <ul class="thm-breadcrumb list-unstyled" style="justify-content:center;">
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
                    <li>{{ $childCategory->name }}</li>
                @endif
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Fixing One Start-->
<section class="fixing-one">
    <div class="fixing-one__bg float-bob-y" style="background-image: url({{asset('frontend/assets/images/service-bg.jpg')}});"></div>
    <div class="container">
        <div class="section-title section-title--two text-center">
            <span class="section-title__tagline">WHAT WE FIXING</span>
            <h2 class="section-title__title">Providing device solutions</h2>
            <!--<p class="section-title__text">Duis aute irure dolor in repreh enderit in volup tate velit esse cillum dolore <br> eu fugiat nulla dolor atur with Lorem ipsum is simply</p>-->
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="fixing-one__left">
                    <div class="fixing-one__img">

                        @if($childCategory?->image)
            <img src="{{ asset($childCategory->image) }}" class="shadow p-3 mb-5 rounded" style="display: block; margin:0 auto;">
             @elseif($subCategory?->image)
            <img src="{{ asset($subCategory->image) }}" class="shadow p-3 mb-5 rounded" style="display: block; margin:0 auto;">
            @elseif($category?->image)
            <img src="{{ asset($category->image) }}" class="shadow p-3 mb-5 rounded" style="display: block; margin:0 auto;">
            @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="fixing-one__right">
                    <div class="fixing-one__points-box">
                        <ul class="fixing-one__points list-unstyled">
                            @forelse ($services as $key => $item)

                                <li>

                                    <div class="icon">
                                        <img class="img-fluid" aria-hidden="true" width="50px" height="50px" src="{{asset($item->thumb_image)}}" alt="
                      iPhone Repair Services
                      " id="image_home_card_2" style="background: rgb(255, 255, 255); width:50px; height: 50px">
                                    </div>
                                    <a href="{{route('front.single.service', $item->slug)}}">
                                    <div class="content">
                                        <h3>{{ $item->name }}</h3>
                                        <p>{!! Str::limit($item->short_description, 80, ' ...') !!}</p>
                                    </div>
                                </a>
                                </li>


                            @endforeach

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Fixing One End-->
@endsection
