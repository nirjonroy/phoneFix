@extends('frontend.app')
@section('title', 'Home')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}"> --}}
@endpush
@section('content')
@php
    $phoneFixAsset = asset('phone-fix/assets');
    $serviceImage = $service->thumb_image ? asset($service->thumb_image) : ($phoneFixAsset . '/img/service/single.jpg');
    $serviceName = $service->name ?? 'Appointment';
@endphp
@push('css')
    <style>
        .schedule-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .schedule-btn {
            border: 1px solid var(--theme-color);
            background: #ffffff;
            color: var(--color-dark);
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
        }
        .schedule-btn.is-selected {
            background: var(--theme-color);
            color: #ffffff;
        }
        .schedule-btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }
        .appointment-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: var(--box-shadow);
            padding: 25px;
        }
        .appointment-service img {
            width: 100%;
            border-radius: 16px;
        }
    </style>
@endpush
<main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ $phoneFixAsset }}/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Appointment</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="active">Appointment</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="contact-area py-120">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="contact-form appointment-card">
                            <div class="contact-form-header">
                                <h2>Appointment</h2>
                                <p>{{ $serviceName }}</p>
                            </div>
                            <form action="{{ route('front.repair.submit') }}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" name="service_name" value="{{ $service->short_name ?: $serviceName }}">
                                <input type="hidden" class="form-control" name="appoinment_date" id="selected_date" readonly>
                                <input type="hidden" class="form-control" name="appoinment_time" id="selected_time" readonly>

                                <div class="form-group">
                                    <label class="mb-2">Schedule Date:</label>
                                    <div id="dateButtons" class="schedule-group"></div>
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">Schedule Time:</label>
                                    <div id="timeButtons" class="schedule-group"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="4" name="address"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Tell Us About Your Device's Problem</label>
                                    <textarea class="form-control" rows="4" name="short_notes"></textarea>
                                </div>

                                <button type="submit" class="theme-btn">Submit <i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="appointment-card appointment-service">
                            <h4 class="mb-3">{{ $serviceName }}</h4>
                            <img src="{{ $serviceImage }}" alt="{{ $serviceName }}">
                            <div class="mt-3">
                                {!! $service->long_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>

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
      if (!dateButtons) {
        return;
      }

      while (currentDate <= endDate) {
        var button = document.createElement('button');
        button.textContent = currentDate.toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
        button.value = currentDate.toISOString().split('T')[0];
        button.type = 'button';
        button.classList.add('schedule-btn');

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
        dateButton.classList.remove('is-selected');
      });

      // Add the 'selected' class to the clicked button
      button.classList.add('is-selected');

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
  if (!timeButtons) {
    return;
  }

  while (startTime <= endTime) {
    var button = document.createElement('button');
    button.textContent = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    button.value = startTime.toTimeString().split(' ')[0];
    button.type = 'button';
    button.classList.add('schedule-btn');

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
        timeButton.classList.remove('is-selected');
      });

      // Add the 'selected' class to the clicked button
      button.classList.add('is-selected');

      // Update the selected time in the input field
      document.getElementById('selected_time').value = button.value;
    }

    // Call the function to generate date buttons for the next 7 days
    generateDateButtons(7);

    // Call the function to generate time buttons from the current time to 8:00 PM with a 60-minute interval
    generateTimeButtons(60); // Generates time buttons with a 60-minute interval

  </script>


@endsection
