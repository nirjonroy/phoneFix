@extends('frontend.app')
@section('title', 'Home')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('content')
<style>
    /* Add any additional styling here */
    button {
      margin: 5px;
      padding: 10px;
      cursor: pointer;
      background-color:  #cf1f1f  !important;
      color: white !important;
    }

    button.selected {
      background-color: #000000 !important;
      color: white /* Change to your desired color */
    }
  </style>
<div class="stricky-header stricked-menu main-menu main-menu-two">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->

<!--Page Header Start-->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url({{asset('frontend/assets/images/appoinment.webp')}})">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h1>Appoinment</h1>
            <p>{{$service->name}} </p>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{route('front.home')}}">Home</a></li>
                <li><span>//</span></li>
                <li>Appoinment</li>
            </ul>
        </div>
    </div>
</section>
<!--Page Header End-->

<!--Contact Page Start-->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="contact-page__left">
                    <div class="contact-page__shape-1">
                        <img src="assets/images/shapes/contact-page-shape-1.png" alt="">
                    </div>
                    <h3 class="contact-page__title">Appoinment</h3>
                    <form action="{{ route('front.repair.submit') }}" method="post">

                        @csrf
                         <input type="hidden" class="form-control" name="service_name" value="{{$service->short_name}}">

                        <div class="form-group">
                            <!--<label for="usr">Schedule Date:</label>-->
                           <input type="hidden" class="form-control" name="appoinment_date" id="selected_date" readonly>

                            <p>Schedule Date:</p>
                            <div id="dateButtons"></div>

                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="appoinment_time" id="selected_time" readonly>

                            <p>Schedule Time:</p>
                            <div id="timeButtons"></div>
                        </div>

                        <div class="form-group">
                            <label for="usr">Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control" name="email">
                          </div>

                          <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone">
                          </div>

                          <div class="form-group">
                            <label for="email">Address:</label>
                            <textarea class="form-control" rows="5" id="comment" name="address"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="email">Tell Us About Your Device's Problem:</label>
                            <textarea class="form-control" rows="5" id="comment" name="short_notes"></textarea>
                          </div>

                          {{-- <div class="form-group">
                            <label for="image">Upload Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div> --}}


                          <div class="form-group float-right" style="padding: 5px">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="contact-page__right">
                    <div class="section-title text-left">
                        <span class="section-title__tagline"></span>
                        <h2 class="section-title__title">{{$service->name}}</h2>
                        <img src="{{ asset($service->thumb_image) }}" alt="" width="50px" height="50px" class="img-thumb">

                    </div>
                    {{-- <p class="contact-page__right-text">Duis aute irure dolor in repreh enderit in volup tate cillum dolore eu fugiat nulla dolor atur with Lorem ipsum is simply free market web bites eius mod ut labore duis</p> --}}
                    <div class="contact-page__points-box-inner">
                        <div class="contact-page__points-box">

                            {!!$service->long_description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page End-->

<script>
    // Function to get the current date in YYYY-MM-DD format
    function getCurrentDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
      var yyyy = today.getFullYear();

      return yyyy + '-' + mm + '-' + dd;
    }

    // Function to dynamically generate date buttons
    function generateDateButtons(numDays) {
      var currentDate = new Date();
      var endDate = new Date();
      endDate.setDate(currentDate.getDate() + numDays); // Set end date as current date + numDays
      var dateButtons = document.getElementById('dateButtons');

      while (currentDate <= endDate) {
        var button = document.createElement('button');
        button.textContent = currentDate.toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        button.value = currentDate.toISOString().split('T')[0];

        button.classList.add('btn', 'btn-outline-success');

        if (currentDate.getDay() === 0) { // Sunday
          button.disabled = true;
        } else {
          button.onclick = function(event) {
            event.preventDefault();
            selectDate(this);
          };
        }

        dateButtons.appendChild(button);

        currentDate.setDate(currentDate.getDate() + 1);
      }
    }

    // Function to handle date selection
    function selectDate(button) {
      // Remove the 'selected' class from all buttons
      var dateButtons = document.querySelectorAll('#dateButtons button');
      dateButtons.forEach(function(dateButton) {
        dateButton.classList.remove('selected');
      });

      // Add the 'selected' class to the clicked button
      button.classList.add('selected');

      // Update the selected date in the input field
      document.getElementById('selected_date').value = button.value;
    }

    // Function to dynamically generate time buttons
    // Function to generate time buttons from 8 AM to 10 PM with a specified interval
// Function to generate time buttons from 8:00 AM to 10:00 PM with a specified interval
function generateTimeButtons(intervalMinutes) {
  var startTime = new Date();
  startTime.setHours(10, 0, 0); // Set start time to 8:00 AM
  var endTime = new Date();
  endTime.setHours(20, 0, 0); // Set end time to 10:00 PM
  var timeButtons = document.getElementById('timeButtons');

  while (startTime <= endTime) {
    var button = document.createElement('button');
    button.textContent = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    button.value = startTime.toTimeString().split(' ')[0];

    button.classList.add('btn', 'btn-outline-success');

    button.onclick = function(event) {
      event.preventDefault();
      selectTime(this);
    };

    timeButtons.appendChild(button);

    startTime.setMinutes(startTime.getMinutes() + intervalMinutes);
  }
}



    // Function to handle time selection
    function selectTime(button) {
      // Remove the 'selected' class from all buttons
      var timeButtons = document.querySelectorAll('#timeButtons button');
      timeButtons.forEach(function(timeButton) {
        timeButton.classList.remove('selected');
      });

      // Add the 'selected' class to the clicked button
      button.classList.add('selected');

      // Update the selected time in the input field
      document.getElementById('selected_time').value = button.value;
    }

    // Call the function to generate date buttons for the next 7 days
    generateDateButtons(7);

    // Call the function to generate time buttons from the current time to 8:00 PM with a 60-minute interval
    generateTimeButtons(60); // Generates time buttons with a 60-minute interval

  </script>


@endsection
