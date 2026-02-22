<head>
    @php
        $seo = DB::table('settings')->first();
        $SeoSettings = DB::table('seo_settings')->where('id', 1)->first();
        $googleAnalytic = DB::table('google_analytics')->first();
        $phoneFixAsset = asset('phone-fix/assets');
    @endphp
    <title>@yield('title', $SeoSettings->seo_title ?? 'DC Phone Repair')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

@hasSection('seos')
    @yield('seos')
@else
    @php
        $defaultTitle = $SeoSettings->seo_title ?? 'DC Phone Repair';
        $metaTitle = $SeoSettings->meta_title ?: $defaultTitle;
        $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
        $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
        $siteName = $SeoSettings->site_name ?: $defaultTitle;
    @endphp
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="title" content="{{ $defaultTitle }}">
    <meta name="description" content="{{ $SeoSettings->seo_description }}">
    @if($SeoSettings->keywords)
        <meta name="keywords" content="{{ $SeoSettings->keywords }}">
    @endif
    @if($SeoSettings->author)
        <meta name="author" content="{{ $SeoSettings->author }}">
    @endif
    @if($SeoSettings->publisher)
        <meta name="publisher" content="{{ $SeoSettings->publisher }}">
        <meta property="article:publisher" content="{{ $SeoSettings->publisher }}">
    @endif
    @if($SeoSettings->copyright)
        <meta name="copyright" content="{{ $SeoSettings->copyright }}">
    @endif
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">
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
    @if($metaImage)
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif
@endif
    @if($googleAnalytic && $googleAnalytic->status == 1)
        @php
            $analyticPayload = $googleAnalytic->analytic_script ?: $googleAnalytic->analytic_id;
            $hasScriptTag = $analyticPayload && stripos($analyticPayload, '<script') !== false;
        @endphp
        @if($analyticPayload)
            @if($hasScriptTag)
                {!! $analyticPayload !!}
            @else
                <script type="application/ld+json">{!! $analyticPayload !!}</script>
            @endif
        @endif
    @endif

    <link rel="icon" type="image/x-icon" href="{{ asset($seo->favicon) }}">

    <!-- css -->
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ $phoneFixAsset }}/css/style.css">

    @stack('css')
</head>
