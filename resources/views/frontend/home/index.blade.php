@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 1)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'DC-Phone-Repair-Home')
@push('css')

@endpush
@section('seos')

    

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta name="title" content="{{$SeoSettings->seo_title}}">

    <meta name="description" content="{{$SeoSettings->seo_description}}">
    @if($SeoSettings->keywords)
        <meta name="keywords" content="{{$SeoSettings->keywords}}">
    @endif
    @if($SeoSettings->author)
        <meta name="author" content="{{$SeoSettings->author}}">
    @endif
    @if($SeoSettings->publisher)
        <meta name="publisher" content="{{$SeoSettings->publisher}}">
        <meta property="article:publisher" content="{{$SeoSettings->publisher}}">
    @endif
    @if($SeoSettings->copyright)
        <meta name="copyright" content="{{$SeoSettings->copyright}}">
    @endif
    
    <meta property="og:title" content="{{$metaTitle}}">
    <meta property="og:description" content="{{$metaDescription}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="{{$siteName}}">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    @if($metaImage)
        <meta property="og:image" content="{{$metaImage}}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="article:modified_time" content="2023-03-01T12:33:34+00:00">
    <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{$metaTitle}}">
    <meta name="twitter:description" content="{{$metaDescription}}">
    <meta name="twitter:url" content="">
    @if($metaImage)
        <meta name="twitter:image" content="{{$metaImage}}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
@endsection
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
@endphp
<main class="main">

        <!-- hero slider -->
        <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme">
                @forelse($sliders as $slider)
                    <div class="hero-single" style="background-image: url({{ asset($slider->image) }})">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-lg-7">
                                    <div class="hero-content">
                                        <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Your Trusted Partner</h6>
                                        <h1 class="hero-title" data-animation="fadeInUp" data-delay=".50s">
                                            {{ $slider->title_one }}
                                        </h1>
                                        <p data-animation="fadeInUp" data-delay=".75s">
                                            {{ $slider->title_two }}
                                        </p>
                                        <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                            <a href="{{ route('front.about-us') }}" class="theme-btn">About More <i class="fas fa-arrow-right"></i></a>
                                            <a href="{{ route('front.contact') }}" class="theme-btn theme-btn2">Contact Us <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="hero-single" style="background-image: url({{ $phoneFixAsset }}/img/slider/slider-1.jpg)">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-lg-7">
                                    <div class="hero-content">
                                        <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Your Trusted Partner</h6>
                                        <h1 class="hero-title" data-animation="fadeInUp" data-delay=".50s">
                                            Computer & Mobile <span>Repair</span> Services
                                        </h1>
                                        <p data-animation="fadeInUp" data-delay=".75s">
                                            There are many variations of passages orem psum available but the majority have suffered alteration in some form by injected humour or randomised.
                                        </p>
                                        <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                            <a href="{{ route('front.about-us') }}" class="theme-btn">About More <i class="fas fa-arrow-right"></i></a>
                                            <a href="{{ route('front.contact') }}" class="theme-btn theme-btn2">Contact Us <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- hero slider end -->


        <!-- appointment -->
        <div class="appointment">
            <div class="col-lg-8">
                <div class="appointment-form">
                    <form action="{{ route('front.direct-message') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="form-select" name="subject">
                                        <option value="">Choose Service</option>
                                        @foreach(categories()->take(6) as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="message">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <button type="submit" class="theme-btn theme-btn2">Get Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- appointment end -->


        <!-- feature area -->
        <div class="feature-area pt-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-item">
                            <span class="count">01</span>
                            <div class="feature-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/repair.svg" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Best Electronics Repair Service</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-item">
                            <span class="count">02</span>
                            <div class="feature-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/team.svg" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>Repair With Experience Team</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-item">
                            <span class="count">03</span>
                            <div class="feature-icon">
                                <img src="{{ $phoneFixAsset }}/img/icon/secure.svg" alt="">
                            </div>
                            <div class="feature-content">
                                <h4>100% Secure Repair Service For You</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable content</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature area end -->


        <!-- about area -->
        <div class="about-area py-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="about-img-1">
                                    <img src="{{ $phoneFixAsset }}/img/about/01.jpg" alt="">
                                </div>
                                <div class="about-img-2">
                                    <img src="{{ $phoneFixAsset }}/img/about/02.jpg" alt="">
                                </div>
                            </div>
                            <div class="about-shape"><img src="{{ $phoneFixAsset }}/img/shape/01.png" alt=""></div>
                            <div class="about-experience">
                                <h1>25+</h1>
                                <div class="about-experience-text">
                                    Years Of <br> Experience
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> About Us</span>
                                <h2 class="site-title">
                                    We Provide Quality <span>Repair</span> Services
                                </h2>
                            </div>
                            <p class="about-text">
                                There are many variations of passages available randomised words which the majority have suffered alteration in some form, by injected humour look page when looking at its layout even slightly believable.
                            </p>
                            <div class="about-list-wrap">
                                <ul class="about-list list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <img src="{{ $phoneFixAsset }}/img/icon/money.svg" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>Our Affordable Price</h4>
                                            <p>There are many variations of passage majority have suffered some form injected humour.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ $phoneFixAsset }}/img/icon/trusted.svg" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>Trusted Repair Service</h4>
                                            <p>There are many variations of passage majority have suffered some form injected humour.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('front.about-us') }}" class="theme-btn mt-4">Discover More <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->


        <!-- service-area -->
        <div class="service-area sa-bg pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="site-heading">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Services</span>
                            <h2 class="site-title text-white">Let's Check Our Best Repair <span>Services</span> In City</h2>
                            <p class="text-white">
                                There are many variations of passages available injected humour randomised words which don't look majority have suffered alteration in some form even slightly believable the majority have suffered alteration in some form repeat predefined chunks as necessary
                                injected humour.
                            </p>
                        </div>
                    </div>
                    @forelse($products->take(6) as $product)
                        <div class="col-md-6 col-lg-3">
                            <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                                <div class="service-icon">
                                    <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="service-content">
                                    <h3 class="service-title">
                                        <a href="{{ route('front.repair', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="service-text">
                                        {{ Str::limit($product->short_description ?? '', 90) }}
                                    </p>
                                    <div class="service-arrow">
                                        <a href="{{ route('front.repair', $product->slug) }}" class="service-btn"><i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-6 col-lg-3">
                            <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                                <div class="service-icon">
                                    <img src="{{ $phoneFixAsset }}/img/icon/tab.svg" alt="">
                                </div>
                                <div class="service-content">
                                    <h3 class="service-title">
                                        <a href="{{ route('front.repair.all') }}">Repair Services</a>
                                    </h3>
                                    <p class="service-text">
                                        Explore our full list of smartphone and device repair services.
                                    </p>
                                    <div class="service-arrow">
                                        <a href="{{ route('front.repair.all') }}" class="service-btn"><i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- service-area -->


        <!-- video area -->
        <div class="video-area py-100">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-4">
                        <div class="site-heading mb-0 wow fadeInLeft" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Latest Video</span>
                            <h2 class="site-title">What makes us <span>different</span> check our video</h2>
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words look even going to use a passage believable.
                            </p>
                            <a href="{{ route('front.contact') }}" class="theme-btn mt-20">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="video-content wow fadeInRight" data-wow-delay=".25s" style="background-image: url({{ $phoneFixAsset }}/img/video/01.jpg);">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="video-wrap"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- video area end -->


        <!-- choose area -->
        <div class="choose-area py-120">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="choose-content wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Why Choose Us</span>
                                <h2 class="site-title">
                                    When You Need Repair <span>We Are</span> Always Here
                                </h2>
                            </div>
                            <p>
                                There are many variations of passages of Lorem Ipsum available but the randomised words which don't look even slightly believable.
                            </p>
                            <div class="choose-wrapper mt-4">
                                <div class="choose-item">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/team-2.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Skilled Technicians</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                                <div class="choose-item active">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/quality.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Quality Guarantee</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                                <div class="choose-item">
                                    <div class="choose-icon">
                                        <img src="{{ $phoneFixAsset }}/img/icon/trusted.svg" alt="">
                                    </div>
                                    <div class="choose-item-content">
                                        <h4>Your Trusted Partner</h4>
                                        <p>It is a long established fact that a reader will distracted the readable content page when looking its layout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="choose-img wow fadeInRight" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="row g-4">
                                <div class="col-6">
                                    <img class="img-1" src="{{ $phoneFixAsset }}/img/choose/01.jpg" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-2" src="{{ $phoneFixAsset }}/img/choose/02.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose area end -->


        <!-- cta-area -->
        <div class="cta-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto text-center">
                        <div class="cta-text">
                            <h1>We Provide <span>Quality</span> Services</h1>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout have suffered in some form by injected humour.
                            </p>
                        </div>
                        <div class="mb-20 mt-10">
                            <a href="#" class="cta-border-btn"><i class="fal fa-headset"></i>+2 123 654 7898</a>
                        </div>
                        <a href="{{ route('front.contact') }}" class="theme-btn">Contact Now <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- cta-area end -->


        <!-- gallery-area -->
        <div class="gallery-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Photo Gallery</span>
                            <h2 class="site-title">Explore Photo <span>Gallery</span></h2>
                            <div class="heading-divider"></div>
                        </div>
                        <div class="filter-controls wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <ul class="filter-btns">
                                <li class="active" data-filter="*"><i class="far fa-layer-group"></i> All</li>
                                @foreach ($galleryCategories as $galleryCategory)
                                    <li data-filter=".cat-{{ $galleryCategory->id }}"><i class="far fa-folder"></i> {{ $galleryCategory->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 filter-box popup-gallery wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                    @forelse ($galleryItems as $galleryItem)
                        <div class="col-md-4 filter-item cat-{{ $galleryItem['category_id'] }}">
                            <div class="gallery-item">
                                <div class="gallery-img">
                                    <img src="{{ asset($galleryItem['image']) }}" alt="{{ $galleryItem['name'] }}">
                                </div>
                                <div class="gallery-content">
                                    <a class="popup-img gallery-link" href="{{ asset($galleryItem['image']) }}"><i class="far fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center mb-0">No gallery images available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- gallery-area end -->


        <!-- faq area -->
        <div class="faq-area py-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="faq-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="faq-img">
                                <img src="{{ $phoneFixAsset }}/img/faq/01.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Faq's</span>
                                <h2 class="site-title my-3">General <span>frequently</span> asked questions</h2>
                            </div>
                            <p class="about-text">Find quick answers to the most common questions about our repair services.</p>
                            <div class="mt-4">
                                <div class="accordion" id="accordionExample">
                                    @forelse($faqs as $index => $faq)
                                        @php
                                            $headingId = 'headingFaq' . $index;
                                            $collapseId = 'collapseFaq' . $index;
                                            $isOpen = $index === 0;
                                        @endphp
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="{{ $headingId }}">
                                                <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                                    <span><i class="far fa-question"></i></span> {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFaqEmpty">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqEmpty" aria-expanded="true" aria-controls="collapseFaqEmpty">
                                                    <span><i class="far fa-question"></i></span> No FAQs available yet
                                                </button>
                                            </h2>
                                            <div id="collapseFaqEmpty" class="accordion-collapse collapse show" aria-labelledby="headingFaqEmpty" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Check back soon or contact us for more information.
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- faq area end -->


        <!-- blog-area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="fas fa-bring-forward"></i> Our Blog</span>
                            <h2 class="site-title">Latest News & <span>Blog</span></h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($homeBlogs as $blog)
                        @php
                            $blogImage = $blog->image ? asset($blog->image) : $phoneFixAsset . '/img/blog/01.jpg';
                            $blogDate = $blog->created_at ? $blog->created_at->format('M d, Y') : '';
                            $blogAuthor = $blog->author ?: (optional($blog->admin)->name ?: 'Admin');
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ number_format(0.25 + (0.25 * ($loop->index % 3)), 2) }}s">
                                @if($blogDate)
                                    <span class="blog-date"><i class="far fa-calendar-alt"></i> {{ $blogDate }}</span>
                                @endif
                                <div class="blog-item-img">
                                    <img src="{{ $blogImage }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="blog-item-info">
                                    <h4 class="blog-title">
                                        <a href="{{ route('front.blog_details', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h4>
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By {{ $blogAuthor }}</a></li>
                                            <li><a href="#"><i class="far fa-comments"></i> {{ $blog->comments_count }} Comments</a></li>
                                        </ul>
                                    </div>
                                    <p>
                                        {{ Str::limit(strip_tags($blog->description ?? ''), 120) }}
                                    </p>
                                    <a class="theme-btn" href="{{ route('front.blog_details', $blog->slug) }}">Read More<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center mb-0">No blog posts found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- blog-area end -->


</main>
@endsection
