@extends('frontend.app')
@section('title', 'Home')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('content')
<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{asset('frontend/assets/images/contact-one-bg.jpg')}})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h1>Contact Us</h1>
            <p>Professional Smartphone Laptop Repair Services </p>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{route('front.home')}}">Home</a></li>
                <li><span>//</span></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Contact Page Start-->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__left">
                    <div class="contact-page__shape-1">
                        <img src="assets/images/shapes/contact-page-shape-1.png" alt="">
                    </div>
                    <h3 class="contact-page__title">Leave a message</h3>
                    <form action="{{route('front.direct-message')}}"  method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="contact-page__form-input-box">
                                    <input type="text" placeholder="Name" name="name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact-page__form-input-box">
                                    <input type="email" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact-page__form-input-box">
                                    <input type="text" placeholder="Subject" name="subject">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact-page__form-input-box">
                                    <input type="text" placeholder="Phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-page__form-input-box text-message-box">
                                    <textarea name="message" placeholder="Comment"></textarea>
                                </div>
                                <div class="contact-form__btn-box">
                            <button type="submit" class="thm-btn contact-form__btn">Send Message</button>
                        </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__right">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">GET IN TOUCH</span>
                        <h2 class="section-title__title">{{$contacts->title}}</h2>
                    </div>
                    {{-- <p class="contact-page__right-text">Duis aute irure dolor in repreh enderit in volup tate cillum dolore eu fugiat nulla dolor atur with Lorem ipsum is simply free market web bites eius mod ut labore duis</p> --}}
                    <div class="contact-page__points-box-inner">
                        <div class="contact-page__points-box">

                           {!!$contacts->description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page End-->

<!--Google Map Start-->
<section class="google-map">
    <div class="container">
        <iframe src="{{$contacts->map}}"
            class="google-map__one" allowfullscreen></iframe>
    </div>
</section>
<!--Google Map End-->


@endsection
