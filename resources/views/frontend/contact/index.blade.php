@extends('frontend.app')
@section('title', 'Home')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
    $setting = siteInfo();
    $contactPhone = $setting->topbar_phone ?? '';
    $contactTel = $contactPhone ? preg_replace('/[^0-9+]/', '', $contactPhone) : '';
    $contactEmail = $setting->contact_email ?? $setting->topbar_email ?? '';
    $contactAddress = trim(($setting->address_1 ?? '') . ' ' . ($setting->address_2 ?? ''));
@endphp
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Contact Us</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->



        <!-- contact area -->
        <div class="contact-area py-120">
            <div class="container">
                <div class="contact-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-content">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-location-dot"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Office Address</h5>
                                        <p>{{ $contactAddress ?: '25/B Milford, New York, USA' }}</p>
                                    </div>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-phone-volume"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Call Us</h5>
                                        <p>{{ $contactPhone ?: '+2 123 4565 789' }}</p>
                                    </div>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Email Us</h5>
                                        @if($contactEmail)
                                            <p><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
                                        @else
                                            <p>info@example.com</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="contact-info border-0">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>Open Time</h5>
                                        <p>Mon - Sat (10.00AM - 05.30PM)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>{!! $contacts->description ?? 'It is a long established fact that a reader will be distracted by the readable content of a page.' !!}</p>
                                </div>
                                <form method="post" action="{{ route('front.direct-message') }}" id="contact-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Your Subject">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message" required></textarea>
                                    </div>
                                    <button type="submit" class="theme-btn">Send
                                        Message <i class="far fa-paper-plane"></i></button>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-messege text-success"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact area -->

        <!-- map -->
        <div class="contact-map">
            <iframe src="{{ $contacts->map ?? '' }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>


</main>
@endsection
