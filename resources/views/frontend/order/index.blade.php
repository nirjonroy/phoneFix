@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="order-history-page">
                    <div class="page-title">
                        <span>My Orders</span>
                    </div>
                    <div class="order-list">
                        <div class="separator-line"></div>
                        <div class="order-items border-radius-small">
                        @forelse($orders as $order)
                        <div class="order-summary">
                                <div class="left-order-info">
                                    <div class="order-status">
                                        <div class="status-block">
                                            <span class="text border-radius-small processing">
                                                @php $s = $order->order_status; @endphp
                                                @if($s == 0)
                                                Pending                                                
                                                @elseif($s == 1)
                                                Progress                                                
                                                @elseif($s == 2)
                                                Delivered                                                
                                                @elseif($s == 3)
                                                Completed                                                
                                                @elseif($s == 4)
                                                Declined
                                                @endif
                                            </span>
                                            <div class="total-shipment-number">
                                                <span class="d-none">
                                                    <span>1</span> 
                                                    Shipments
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-id">
                                        <span class="the-id">                                        
                                            <span>Order ID :</span>
                                            <span>{{ $order->order_id }}</span>
                                        </span>
                                    </div>
                                    <div class="total-price">
                                    <span>Total :</span>
                                        <span class="tk-symbol">৳</span><span>{{ $order->total_amount }}</span>
                                    </div>
                                </div>
                                <div class="right-order-actions">
                                    <div class="actions-btns mouse-hover-cursor-pointer">
                                        <a href="{{ route('front.order.show', [$order->id] ) }}" class="view-details-btn btn">
                                            <span class="text">View Details</span>
                                            <span class="icon arrow-down">
                                                <svg width="10px" height="10px" style="fill:#000000;stroke:#000000;display:inline-block;vertical-align:middle;" viewBox="0 0 100 100">
                                                    <path transform="translate(0 -952.36)" d="m31.918 1045.4l36.164-31.684 12.918-11.316-12.918-11.316-36.164-31.684-12.918 11.316 36.168 31.684-36.168 31.684zm0 0" stroke="#000" stroke-linecap="round" stroke-width="2"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                   
                        @empty
                        <div>
                            <strong class="text-danger text-center">No orders are available!</strong>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="order-details" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">

    </div>
@endsection