@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Invoice')}}</title>
@endsection
<style>
    @media print {
        .section-header,
        #sidebar-wrapper,
        .print-area,
        .main-footer,
        .additional_info {
            display:none!important;
        }
        .status_section {
            display:none!important;
        }
        }
</style>
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Invoice')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Invoice')}}</div>
            </div>
          </div>
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">



                    <hr>
                    @php
                        $orderAddress = $order->orderAddress;
                    @endphp
                    <div class="container">
                    <div class="row" >

                        <table class="table table-bordered" border="1">

                        <tbody>
                          <tr>
                            <td>
                                Name :     {{$order->name}} <br>
                                Email :     {{$order->email}} <br>
                                Phone :     {{$order->phone}} <br>
                                service Name :     {{$order->service_name}} <br>
                                service Name :     {{$order->short_notes}} <br>
                                servic Date :     {{$order->appoinment_date}} <br>
                                servic Time :     {{$order->appoinment_time}} <br>
                            </td>



                                </div>





@endsection
