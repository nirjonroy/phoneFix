
@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 4)->first();
    $metaTitle = $blog->meta_title ?: ($blog->seo_title ? $blog->seo_title : $blog->title);
    $metaDescription = $blog->meta_description ?: ($blog->seo_description ? $blog->seo_description : Str::limit(strip_tags($blog->description), 160, ''));
    $metaImage = $blog->meta_image ? asset($blog->meta_image) : ($blog->image ? asset($blog->image) : ($SeoSettings && $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : ''));
    $siteName = $blog->site_name ?: ($SeoSettings ? ($SeoSettings->site_name ?: $SeoSettings->seo_title) : '');
    $metaKeywords = $blog->keywords ?: ($SeoSettings && $SeoSettings->keywords ? $SeoSettings->keywords : '');
    $metaAuthor = $blog->author ?: ($SeoSettings && $SeoSettings->author ? $SeoSettings->author : '');
    $metaPublisher = $blog->publisher ?: ($SeoSettings && $SeoSettings->publisher ? $SeoSettings->publisher : '');
    $metaCopyright = $blog->copyright ?: ($SeoSettings && $SeoSettings->copyright ? $SeoSettings->copyright : '');
@endphp
@section('title', $metaTitle)
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
    <style>
        .blog-share {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .blog-share-list {
            position: absolute;
            top: 100%;
            right: 0;
            display: none;
            gap: 8px;
            padding: 8px 10px;
            margin-top: 8px;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            z-index: 10;
            white-space: nowrap;
        }
        .blog-share-list.is-open {
            display: inline-flex;
        }
        .blog-share-list a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.04);
            color: var(--color-dark);
        }
        .blog-share-list a:hover {
            background: var(--theme-color);
            color: #fff;
        }
        @media (max-width: 991px) {
            .blog-share-list {
                right: auto;
                left: 0;
            }
        }
    </style>
@endpush

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
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
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
    $blogImage = $blog->image ? asset($blog->image) : $phoneFixAsset . '/img/blog/single.jpg';
    $blogDate = $blog->created_at ? $blog->created_at->format('M d, Y') : '';
    $blogAuthor = $blog->author ?: (optional($blog->admin)->name ?: 'Admin');
    $recentPosts = \App\Models\Blog::latest()->where('id', '!=', $blog->id)->take(3)->get();
    $shareUrl = url()->current();
    $shareTitle = $blog->title;
    $shareUrlEncoded = urlencode($shareUrl);
    $shareTitleEncoded = urlencode($shareTitle);
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li><a href="{{ route('front.blog') }}">Blog</a></li>
                    <li class="active">{{ $blog->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- blog single area -->
        <div class="blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-wrap">
                            <div class="blog-single-content">
                                <div class="blog-thumb-img">
                                    <img src="{{ $blogImage }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li><i class="far fa-user"></i><a href="#">{{ $blogAuthor }}</a></li>
                                                @if($blogDate)
                                                    <li><i class="far fa-clock"></i>{{ $blogDate }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <div class="blog-share">
                                                <a href="#" class="share-link js-share-toggle" data-title="{{ $shareTitle }}" data-url="{{ $shareUrl }}">
                                                    <i class="far fa-share-alt"></i>Share
                                                </a>
                                                <div class="blog-share-list">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrlEncoded }}" target="_blank" rel="noopener" title="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                                                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrlEncoded }}&text={{ $shareTitleEncoded }}" target="_blank" rel="noopener" title="Share on X"><i class="fab fa-x-twitter"></i></a>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrlEncoded }}" target="_blank" rel="noopener" title="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                                    <a href="https://api.whatsapp.com/send?text={{ $shareTitleEncoded }}%20{{ $shareUrlEncoded }}" target="_blank" rel="noopener" title="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">{{ $blog->title }}</h3>
                                        <div class="mb-10 blog-details__content">
                                            {!! $blog->description !!}
                                        </div>
                                        <hr>
                                        @if($blog->tags)
                                            <div class="blog-details-tags pb-20">
                                                <h5>Tags : </h5>
                                                <ul>
                                                    @foreach(explode(',', $blog->tags) as $tag)
                                                        @php $tag = trim($tag); @endphp
                                                        @if($tag)
                                                            <li><a href="#">{{ $tag }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="blog-author">
                                    <div class="blog-author-img">
                                        <img src="{{ $phoneFixAsset }}/img/blog/author.jpg" alt="{{ $blogAuthor }}">
                                    </div>
                                    <div class="author-info">
                                        <h6>Author</h6>
                                        <h3 class="author-name">{{ $blogAuthor }}</h3>
                                        <p>Thanks for reading! We share repair tips, device care advice, and updates from our team.</p>
                                        <div class="author-social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-x-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar">
                            <!-- search-->
                            <div class="widget search">
                                <h5 class="widget-title">Search</h5>
                                <form class="search-form" action="{{ route('front.blog') }}">
                                    <input type="text" class="form-control" placeholder="Search Here...">
                                    <button type="submit"><i class="far fa-search"></i></button>
                                </form>
                            </div>
                            <!-- category removed -->
                            <!-- recent post -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent Post</h5>
                                @foreach($recentPosts as $recent)
                                    @php
                                        $recentImage = $recent->image ? asset($recent->image) : $phoneFixAsset . '/img/blog/bs-1.jpg';
                                        $recentDate = $recent->created_at ? $recent->created_at->format('M d, Y') : '';
                                    @endphp
                                    <div class="recent-post-single">
                                        <div class="recent-post-img">
                                            <img src="{{ $recentImage }}" alt="{{ $recent->title }}">
                                        </div>
                                        <div class="recent-post-bio">
                                            <h6><a href="{{ route('front.blog_details', $recent->slug) }}">{{ $recent->title }}</a></h6>
                                            @if($recentDate)
                                                <span><i class="far fa-clock"></i>{{ $recentDate }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <!-- social share -->
                            <div class="widget social-share">
                                <h5 class="widget-title">Follow Us</h5>
                                <div class="social-share-link">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>


                            <!-- Recent Post -->
                            <div class="widget sidebar-tag">
                                <h5 class="widget-title">Popular Tags</h5>
                                <div class="tag-list">
                                    @if($blog->tags)
                                        @foreach(explode(',', $blog->tags) as $tag)
                                            @php $tag = trim($tag); @endphp
                                            @if($tag)
                                                <a href="#">{{ $tag }}</a>
                                            @endif
                                        @endforeach
                                    @else
                                        <a href="#">Repair</a>
                                        <a href="#">Mobile</a>
                                        <a href="#">Phone</a>
                                        <a href="#">Desktop</a>
                                        <a href="#">Computer</a>
                                    @endif
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->

</main>
@push('js')
    <script>
        document.addEventListener('click', function (event) {
            var toggle = event.target.closest('.js-share-toggle');
            var shareLists = document.querySelectorAll('.blog-share-list');

            if (!toggle) {
                shareLists.forEach(function (list) {
                    list.classList.remove('is-open');
                });
                return;
            }

            event.preventDefault();
            var shareTitle = toggle.dataset.title || document.title;
            var shareUrl = toggle.dataset.url || window.location.href;

            if (navigator.share) {
                navigator.share({ title: shareTitle, url: shareUrl }).catch(function () {});
                return;
            }

            var list = toggle.parentElement.querySelector('.blog-share-list');
            if (list) {
                list.classList.toggle('is-open');
            }
        });
    </script>
@endpush
@endsection
