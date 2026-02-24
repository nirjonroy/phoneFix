@php
    $setting = siteInfo();
    $contactInfo = \App\Models\ContactPage::first();
    $footerPhone = $contactInfo->phone ?? ($setting->topbar_phone ?? '');
    $footerTel = $footerPhone ? preg_replace('/[^0-9+]/', '', $footerPhone) : '';
    $footerEmail = $contactInfo->email ?? ($setting->contact_email ?? $setting->topbar_email ?? '');
    $footerAddress = $contactInfo->address ?? '';
    $phoneFixAsset = asset('phone-fix/assets');
@endphp

<!-- footer area -->
<footer class="footer-area footer-bg">
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrap pt-100 pb-70">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="{{ route('front.home') }}" class="footer-logo">
                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name ?? 'Logo' }}" style="width: 50px;">
                        </a>
                        <ul class="footer-contact">
                            @if($footerPhone)
                                <li><a href="{{ $footerTel ? 'tel:' . $footerTel : '#' }}"><i class="far fa-phone"></i>{{ $footerPhone }}</a></li>
                            @endif
                            <li><i class="far fa-map-marker-alt"></i>{{ $footerAddress }}</li>
                            @if($footerEmail)
                                <li><a href="mailto:{{ $footerEmail }}"><i class="far fa-envelope"></i>{{ $footerEmail }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Quick Links</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('front.about-us') }}"><i class="fas fa-dot-circle"></i> About Us</a></li>
                            <li><a href="{{ route('front.faq') }}"><i class="fas fa-dot-circle"></i> FAQ's</a></li>
                            <li><a href="{{ route('front.terms_condition') }}"><i class="fas fa-dot-circle"></i> Terms Of Service</a></li>
                            <li><a href="{{ route('front.privacy_policy') }}"><i class="fas fa-dot-circle"></i> Privacy Policy</a></li>
                            <li><a href="{{ route('front.contact') }}"><i class="fas fa-dot-circle"></i> Contact</a></li>
                            <li><a href="{{ route('front.blog') }}"><i class="fas fa-dot-circle"></i> Latest Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Our Services</h4>
                        <ul class="footer-list">
                            @foreach(categories()->take(6) as $item)
                                <li><a href="{{ route('front.services.category', ['category' => $item->slug]) }}"><i class="fas fa-dot-circle"></i> {{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Newsletter</h4>
                        <div class="footer-newsletter">
                            <p>Subscribe Our Newsletter To Get Latest Update And News</p>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                    <button class="theme-btn" type="submit">
                                        Subscribe Now <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p class="copyright-text">
                        &copy; Copyright <span id="date"></span>
                        <a href="{{ route('front.home') }}"> Phone fix </a>
                        All Rights Reserved. Developed by
                        <a href="https://blacktechcorp.com/" target="_blank" rel="noopener">Blacktech</a>.
                    </p>
                </div>
                <div class="col-md-6 align-self-center">
                    @php
                        $socialLinks = \App\Models\FooterSocialLink::all();
                    @endphp
                    @if($socialLinks->count())
                        <ul class="footer-social">
                            @foreach($socialLinks as $socialLink)
                                <li>
                                    <a href="{{ $socialLink->link }}" target="_blank" rel="noopener">
                                        <i class="{{ $socialLink->icon }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->


<!-- scroll-top -->
<a href="#" id="scroll-top"><i class="far fa-angle-up"></i></a>
<!-- scroll-top end -->


</div>
<!-- /.page-wrapper -->

<!-- js -->
<script src="{{ $phoneFixAsset }}/js/jquery-3.7.1.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/modernizr.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/isotope.pkgd.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/jquery.appear.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/jquery.easing.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/owl.carousel.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/counter-up.js"></script>
<script src="{{ $phoneFixAsset }}/js/masonry.pkgd.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/wow.min.js"></script>
<script src="{{ $phoneFixAsset }}/js/main.js"></script>

@stack('js')
</body>

</html>
