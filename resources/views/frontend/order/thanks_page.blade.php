@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endpush
@section('content')

<div class="container mt-10" style="padding-top: 150px">
  <div class="row">
      <div class="mt-4 p-5 bg-primary text-white rounded text-center" style="margin-bottom: 5%; box-shadow: 10px 10px 5px gray;">
    <h1>Thanks For Appoinment</h1> 
    <p>Your Appoinment Has Been Received </p> 
    <p> We Will contact you, to ensure this Appoinment </p> 
    
    <a class="btn bg-dark" href="{{route('front.home')}}" style="color:white"> Back To Home  </a>
    
  </div>
  </div>
  
</div>

@endsection