@extends('frontend.app')
@section('title', 'Terms and Condition')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="landingPage2" style="margin-left:2%; margin-right:2%; text-align:justify">
                  
					<p>{!!$tarms->terms_and_condition!!}</p>
                </div>
            </div>
        </section>
    </div>
@endsection