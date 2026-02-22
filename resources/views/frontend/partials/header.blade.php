@php
    $setting = siteInfo();
    $headerPhone = $setting->topbar_phone ?? '';
    $headerTel = $headerPhone ? preg_replace('/[^0-9+]/', '', $headerPhone) : '';
    $headerEmail = $setting->topbar_email ?: ($setting->contact_email ?? '');
@endphp

<!-- preloader -->
<div class="preloader">
    <div class="loader-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<!-- preloader end -->

<!-- header area -->
<header class="header">

    <!-- header-top -->
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrap">
                <div class="header-top-left">
                    <div class="header-top-social">
                        <span>Follow Us:</span>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-contact">
                        <ul>
                            @if($headerPhone)
                                <li>
                                    <div class="header-top-contact-info">
                                        <a href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}"><i class="far fa-phone-volume"></i> {{ $headerPhone }}</a>
                                    </div>
                                </li>
                            @endif
                            @if($headerEmail)
                                <li>
                                    <div class="header-top-contact-info">
                                        <a href="mailto:{{ $headerEmail }}"><i class="far fa-envelopes"></i> {{ $headerEmail }}</a>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="header-top-contact-info">
                                    <a href="#"><i class="far fa-clock"></i> Sun - Fri (08AM - 10PM)</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top end -->

    <!-- navbar -->
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ route('front.home') }}">
                    <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name ?? 'Logo' }}">
                </a>
                <div class="mobile-menu-right">
                    <div class="mobile-menu-btn">
                        <a href="#" class="nav-right-link search-box-outer"><i class="far fa-search"></i></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a href="{{ route('front.home') }}" class="offcanvas-brand" id="offcanvasNavbarLabel">
                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name ?? 'Logo' }}">
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('front.about-us') ? 'active' : '' }}" href="{{ route('front.about-us') }}">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Services</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('front.repair.all') }}">All Services</a></li>
                                    @foreach(categories() as $item)
                                        <li><a class="dropdown-item" href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('front.blog') ? 'active' : '' }}" href="{{ route('front.blog') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}" href="{{ route('front.contact') }}">Contact</a>
                            </li>
                        </ul>
                        <!-- nav-right -->
                        <div class="nav-right">
                            <div class="search-btn">
                                <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
                            </div>
                            <div class="nav-btn">
                                <a href="{{ route('front.contact') }}" class="theme-btn">Let's Talk <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

</header>
<!-- header area end -->

<!-- popup search -->
<div class="search-popup">
    <button class="close-search"><span class="far fa-times"></span></button>
    <form action="{{ route('front.product.search') }}">
        <div class="form-group">
            <input type="search" name="query" placeholder="Search Here..." required>
            <button type="submit"><i class="far fa-search"></i></button>
        </div>
    </form>
</div>
<!-- popup search end -->
