<head>
    @php 
        $seo = DB::table('settings')->first();
        $SeoSettings = DB::table('seo_settings')->where('id', 1)->first();
        $googleAnalytic = DB::table('google_analytics')->first();
    @endphp
    <title> @yield('title', $SeoSettings->seo_title ?? 'DC Phone Repair')</title>
   
    
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <!--<meta name="description" content="Black Tech HTML 5 Template " />-->
     
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
    <meta charset="UTF-8">
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    
    <!-- favicons Icons -->
    <!--<link rel="apple-touch-icon" sizes="180x180" href="{{asset($seo->favicon)}}" />-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset($seo->favicon)}}" />
    <!--<link rel="icon" type="image/png" sizes="16x16" href="{{asset($seo->favicon)}}" />-->
    <!--<link rel="manifest" href="{{asset($seo->favicon)}}" />-->
    

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/animate/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/animate/custom-animate.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/jarallax/jarallax.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/nouislider/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/nouislider/nouislider.pips.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/odometer/odometer.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/swiper/swiper.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/jetly-icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/tiny-slider/tiny-slider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/reey-font/stylesheet.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/owl-carousel/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/bxslider/jquery.bxslider.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/bootstrap-select/css/bootstrap-select.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/vegas/vegas.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/jquery-ui/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/timepicker/timePicker.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/vendors/nice-select/nice-select.css')}}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fixnix.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fixnix-responsive.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>
