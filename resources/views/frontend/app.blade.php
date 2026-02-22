
<!DOCTYPE html>
<html lang="en">
    @include('frontend.partials.head')
    <body class="custom-cursor">

        <div class="custom-cursor__cursor"></div>
        <div class="custom-cursor__cursor-two"></div>





        {{-- <div class="preloader">
            <div class="preloader__image" style=""></div>
        </div> --}}
        <!-- /.preloader -->


        <div class="page-wrapper">


    @include('frontend.partials.header')

    @yield('content')


@php
    $faqs = DB::table('faqs')->get();
@endphp
    <!--FAQ One Start-->
<section class="faq-one">
    <div class="faq-one-shape-1 shapeMover" style="background-image: url({{ asset('frontend/assets/images/shapes/faq-one-shape.png') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="faq-one__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">Have Question?</span>
                        <h2 class="section-title__title">Frequently Asked Question</h2>
                    </div>
                    <p class="faq-one__text-1">Welcome to our FAQ section! Here, we've compiled a list of commonly asked questions to provide you with quick answers and assistance. If you don't find the answer you're looking for, feel free to contact us directly, and we'll be happy to help.</p>
                    
                    <div class="faq-one__btn-box" style="margin-top: 18px;">
                        <a href="{{route('front.contact')}}" class=" thm-btn faq-one__btn">Ask Questions Here</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="faq-one__right">
                    <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                       @foreach ($faqs as $faq)
                       <div class="accrodion ">
                        <div class="accrodion-title">
                            <h4>{{$faq->question}}</h4>
                        </div>
                        <div class="accrodion-content">
                            <div class="inner">
                                <p>{!!$faq->answer!!}</p>
                            </div>
                            <!-- /.inner -->
                        </div>
                    </div>
                       @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--FAQ One End-->

<!--Counter One Start-->
<section class="counter-one">
    <div class="counter-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%" style="background-image: url({{asset('frontend/assets/images/backgrounds/counter-one-bg.jpg')}});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <ul class="counter-one__list list-unstyled">
                    <li class="counter-one__single">
                        <h3 class="odometer" data-count="20">00</h3>
                        <span class="counter-one__plus">+</span>
                        <p class="counter-one__text">Glorious Years</p>
                    </li>
                    <li class="counter-one__single">
                        <h3 class="odometer" data-count="2">00</h3>
                        <span class="counter-one__plus">k+</span>
                        <p class="counter-one__text">Happy Customer</p>
                    </li>
                    <li class="counter-one__single">
                        <h3 class="odometer" data-count="5">00</h3>
                        <span class="counter-one__plus">k+</span>
                        <p class="counter-one__text">Service Complete</p>
                    </li>
                    <li class="counter-one__single">
                        <h3 class="odometer" data-count="99">00</h3>
                        <span class="counter-one__plus">%</span>
                        <p class="counter-one__text">Satisfactions</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--Counter One End-->

<!--Testimonial One Start-->
<section class="testimonial-one">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
              <div class="elfsight-app-a61bd2a5-3ade-497e-aeb9-7c300a7aa16f" data-elfsight-app-lazy></div>
            </div>
        </div>
    </div>
</section>

    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
    @include('frontend.partials.footer')

    @include('sweetalert::alert')

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
