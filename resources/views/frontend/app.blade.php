
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


    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
    @include('frontend.partials.footer')

    @include('sweetalert::alert')

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
