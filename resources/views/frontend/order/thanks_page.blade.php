@extends('frontend.app')
@section('title', 'Appointment Confirmed')
@push('css')
    <style>
        .thank-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: var(--box-shadow);
            text-align: center;
        }
        .thank-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--theme-color);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 36px;
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
@endphp
<main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Appointment Confirmed</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">Appointment Confirmed</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="contact-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="thank-card">
                            <div class="thank-icon">
                                <i class="far fa-check"></i>
                            </div>
                            <h2>Thanks For Your Appointment</h2>
                            <p>Your appointment has been received.</p>
                            <p>We will contact you soon to confirm the details.</p>
                            <a href="{{ route('front.home') }}" class="theme-btn mt-3">Back To Home <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
