@extends('frontend.app')
@section('title', 'Privacy Policy')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="landingPage2" style="margin-left:2%; margin-right:2%; text-align:justify">
                  
					<p>{!!$tarms->privacy_policy!!}</p>
                </div>
            </div>
        </section>
    </div>
@endsection