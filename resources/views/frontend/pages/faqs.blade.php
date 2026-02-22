@extends('frontend.app')
@section('title', 'FAQ')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="landingPage2" style="margin-left:2%; margin-right:2%; text-align:justify">
                  <h1 style="text-align:center">FAQ</h1>
                  @foreach($faqs as $faq)
                  <div class="container-fluid">
                    <h3>{{$faq->question}}</h3>
					<p>{!!$faq->answer!!}</p>
                  </div>
                  @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
