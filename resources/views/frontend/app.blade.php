
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
