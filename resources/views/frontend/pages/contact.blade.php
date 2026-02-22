@extends('frontend.app')
@php
    $SeoSettings = DB::table('seo_settings')->where('id', 3)->first();
    $metaTitle = $SeoSettings->meta_title ?: $SeoSettings->seo_title;
    $metaDescription = $SeoSettings->meta_description ?: $SeoSettings->seo_description;
    $metaImage = $SeoSettings->meta_image ? asset($SeoSettings->meta_image) : '';
    $siteName = $SeoSettings->site_name ?: $SeoSettings->seo_title;
@endphp
@section('title', $SeoSettings ? $SeoSettings->seo_title : 'Contact us | DC Phone Repair')
@push('css')
    <!--<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">-->
    <!--<link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">-->
@endpush
@section('seos')

    <meta charset="UTF-8">

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
    <link rel="canonical" href="{{url()->current()}}">
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
    <meta name="twitter:url" content="{{url()->current()}}">
    @if($metaImage)
        <meta name="twitter:image" content="{{$metaImage}}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
@endsection
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="landingPage2" style="margin-left:2%; margin-right:2%; text-align:justify">
                  <h2 style="text-align:center">{{$contact->title}} </h2>
                  <iframe src="{{$contact->map}} " width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  <p> Phone : {{$contact->phone}} </p>
                  <p> Email : {{$contact->email}} </p>
                  <p> Address : {{$contact->address}}</p>
                  <p>  {{$contact->description}}</p>


                </div>
            </div>
        </section>
    </div>
@endsection
