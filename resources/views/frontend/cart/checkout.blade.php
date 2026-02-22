@extends('frontend.app')
@section('title', 'Checkout')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
<section class="bodyTable">
<h1 style="text-align:center; margin: 12px 0 24px;">Checkout</h1>
<div>
<div class="checkoutExperience2">
<div class="loaded">
    <div>
        <form action="{{ route('front.checkout.store') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="text" value="{{ csrf_token() }}" name="_token" />
            <div class="checkoutDelivery">
                <div class="col-lg-6 col-12 p-1">
                    <div class="deliveryStep">
                        <div class="deliveryStepTitle">
                            <div class="titleLeft">
                                <div class="stepIcon">
                                    <svg style="fill:#214354;stroke:#214354;display:inline-block;vertical-align:middle;" width="25px" height="25px" x="0px" y="0px" viewBox="0 0 500 500">
                                        <g>
                                            <path d="M418.455,188.455C418.455,95.418,343.037,20,250.001,20   C156.964,20,81.546,95.418,81.546,188.455c0,33.983,10.074,65.614,27.383,92.079h-0.298l126.278,201.831h0.005   c2.759,5.539,8.479,9.349,15.087,9.349c6.607,0,12.327-3.811,15.085-9.349h0.006l126.279-201.831h-0.299   C408.382,254.068,418.455,222.438,418.455,188.455L418.455,188.455 M250.001,111.641c42.425,0,76.814,34.389,76.814,76.814   c0,42.426-34.389,76.814-76.814,76.814s-76.815-34.389-76.815-76.814C173.187,146.03,207.575,111.641,250.001,111.641   L250.001,111.641 M250.001,111.641L250.001,111.641z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <h2>Billing Address</h2>
                            </div>
                        </div>
                        <div class="deliveryStepContent">
                            <div class="addressComponent mui">
                                <div class="mb-3">
                                    <label for="" class="form-label">Billing Name</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="billing_name" id="" value="{{ $user->name }}" placeholder="">
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="" class="form-label">Billing Email</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="billing_email" id="" value="{{ $user->email }}" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Billing Phone</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="billing_phone" id="" value="{{ $user->phone }}" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Billing Address</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="billing_address" id="" placeholder="">
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="" class="form-label">Billing Country</label>
                                    <select name="billing_country" class="form-select shadow-none" id="">
                                        <option>Choose Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="" class="form-label">Billing State</label>
                                        <select name="billing_state" class="form-select shadow-none" id="">
                                    </select>
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="" class="form-label">Billing City</label>
                                        <select name="billing_city" class="form-select shadow-none" id="">
                                    </select>
                                </div>
                              
                                <div class="mb-3 d-none">
                                    <label for="" class="form-label">Billing Address Type</label>
                                        <select name="billing_address_type" class="form-select shadow-none" id="">
                                            <option value="home">Home</option>
                                            <option value="1">1</option>
                                        </select>
                                </div>
                              <!--
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Method</label>
                                        <input type="text" name="shipping_method" class="form-control border-0 shadow-none" readonly value="Home Delivery">
                                </div>
                              -->
                              <div class="mb-3">
                                    <label for="" class="form-label">Shipping Charge</label>
                                   <?php

                                     $shipping_value = [];

                                     foreach($cart as $key=>$item) {
                                       $shipping_value[] = $item['is_free_shipping'];
                                     }

                                   if(in_array(null, $shipping_value)) {
                                         ?>

                                  
                                  
                                  
                                  @foreach($shippings as $key=>$shipping)
                                      <div class="input-group">
                                          <input type="radio" value="{{ $shipping->shipping_rule}}" class="charge_radio delivery_charge_id" id="{{ $shipping->id}}" name="shipping_method" data-shipping="{{ $shipping->shipping_fee}}"> &nbsp;&nbsp;
                                            <label for="{{ $shipping->id}}">{{ $shipping->shipping_rule}} - {{ $shipping->shipping_fee }}{{ $setting->currency_icon }}</label>
                                            </div>
                                    @endforeach
                                  
                                </div>
                              
                               <?php
                                     } else {
                                         ?>
												@php
                                         $free_shippings = DB::table('shippings')->where('id', 25)->first();
                                         @endphp
                                          <!--<div class="input-group" style="margin-bottom: 25px;">-->
                                          <!--<input checked selected type="radio" value="{{ $free_shippings->id}}" class="charge_radio delivery_charge_id" id="ship_{{ $free_shippings->id}}" data-shippingid="{{ $free_shippings->id }}" name="shipping_method" data-shipping="{{ $free_shippings->shipping_fee}}"> &nbsp;&nbsp;-->
                                          <!--  <label for="ship_{{ $free_shippings->id}}">{{ $free_shippings->shipping_rule}} - {{ $free_shippings->shipping_fee }}{{ $setting->currency_icon }}</label>-->
                                          <!--  </div>-->
                                        
                                         <div class="input-group" style="margin-bottom: 25px;">
                                          <input selected type="radio" value="{{ $free_shippings->id}}" class="charge_radio delivery_charge_id" id="ship_{{ $free_shippings->id}}" data-shippingid="{{ $free_shippings->id}}" name="shipping_method" data-shipping="{{ $free_shippings->shipping_fee}}"> &nbsp;&nbsp;
                                            <label for="ship_{{ $free_shippings->id}}">{{ $free_shippings->shipping_rule}} - {{ $free_shippings->shipping_fee }}{{ $setting->currency_icon }}</label>
                                       </div>
                                         <?php
                                     }

                                   ?>
                              
                              
                              <div class="mb-3">
                                
                                <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-6">
                                
                                    <label for="" class="form-label">Delivery Date</label>
                                                                       
                                    
                                  
                                  <select id="day" name="ordered_delivery_date" style="border: 1px solid #C1C1C1;width: 230px;height: 37px;border-radius: 5px;">
                                    
									</select>
                                  
                                  <script>
                                  let today = new Date(); // get Today date
                                    let dropDownMenu = document.getElementById('day');

                                    for(let i = 0; i < 6; i++){ // Looping through 7 next days
                                        let newDate = new Date()
                                        newDate.setDate(today.getDate() + i); 
                                        if(newDate.getDay() === 0){ 
                                            continue; // Eliminating the Sunday
                                        }
                                        else{ 
                                          let dayText = document.createTextNode(Intl.DateTimeFormat('en-US', {weekday: 'long', month: 'long', day: 'numeric'}).format(newDate)); // Formating the date the way you want before appending into option Element
                                          let dayOption = document.createElement('option')
                                          dayOption.append(dayText);
                                          dropDownMenu.append(dayOption);
                                        }
                                    }                                    
                                  </script>
                     
                              </div>
                                <div class="col-md-6">                                
                                    <label for="" class="form-label">Delivery Time</label>
                                        <select name="ordered_delivery_time" class="form-select shadow-none" id="">
                                            <option value="8:00 AM - 9:00 AM">8:00 AM - 9:00 AM</option>
                                            <option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                                            <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                            <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                                            <option value="12:00 PM - 1:00 AM">12:00 PM - 1:00 AM</option>
                                            <option value="1:00 PM - 2:00 AM">1:00 PM - 2:00 AM</option>
                                            <option value="2:00 PM - 3:00 AM">2:00 PM - 3:00 AM</option>
                                            <option value="3:00 AM - 4:00 AM">3:00 AM - 4:00 AM</option>
                                            <option value="4:00 AM - 5:00 AM">4:00 AM - 5:00 AM</option>
                                            <option value="5:00 AM - 6:00 AM">5:00 AM - 6:00 AM</option>
                                            <option value="6:00 AM - 7:00 AM">6:00 AM - 7:00 AM</option>
                                            <option value="7:00 AM - 8:00 AM">7:00 AM - 8:00 AM</option>
                                            <option value="8:00 AM - 9:00 AM">8:00 AM - 9:00 AM</option>
                                            <option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                                            <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                        </select>
                              </div>
                                  
                                  
                                  
                                  </div>
                                </div>
                              </div>
                              
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method </label>
                                <select class="form-control shadow-none" name="payment_method" id="payment_method">
                                    <option value="Cash On Delivery" selected>Cash On Delivery</option>
                                    <option value="ssl_commerz" >Ssl Commerz</option>
                                    
                                </select>
                            </div>

                                
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 p-1 d-none">
                    <div class="deliveryStep">
                        <div class="deliveryStepTitle">
                            <div class="titleLeft">
                                <div class="stepIcon">
                                    <svg style="fill:#214354;stroke:#214354;display:inline-block;vertical-align:middle;" width="25px" height="25px" x="0px" y="0px" viewBox="0 0 500 500">
                                        <g>
                                            <path d="M418.455,188.455C418.455,95.418,343.037,20,250.001,20   C156.964,20,81.546,95.418,81.546,188.455c0,33.983,10.074,65.614,27.383,92.079h-0.298l126.278,201.831h0.005   c2.759,5.539,8.479,9.349,15.087,9.349c6.607,0,12.327-3.811,15.085-9.349h0.006l126.279-201.831h-0.299   C408.382,254.068,418.455,222.438,418.455,188.455L418.455,188.455 M250.001,111.641c42.425,0,76.814,34.389,76.814,76.814   c0,42.426-34.389,76.814-76.814,76.814s-76.815-34.389-76.815-76.814C173.187,146.03,207.575,111.641,250.001,111.641   L250.001,111.641 M250.001,111.641L250.001,111.641z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <h2>Shipping Address</h2>
                            </div>
                        </div>
                        <div class="deliveryStepContent">
                            <div class="addressComponent mui">
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Name</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="shipping_name" id="" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Email</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="shipping_email" id="" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Phone</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="shipping_phone" id="" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Address</label>
                                    <input type="text"
                                        class="form-control shadow-none" name="shipping_address" id="" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Country</label>
                                    <select name="shipping_country" class="form-select shadow-none" id="">
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping State</label>
                                    <select name="shipping_state" class="form-select shadow-none" id="">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping City</label>
                                    <select name="shipping_city" class="form-select shadow-none" id="">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Shipping Address Type</label>
                                    <select name="shipping_address_type" class="form-select shadow-none" id="">
                                        <option value="home">Home</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
             


              
                <div class="col-lg-6 col-12 p-1 mt-2">
                    <div class="checkoutConfirmComponent">
                        <div class="orderSectionsContainer">
                            <div class="orderSection left">
                              
                              <!--
                              
                              
                                <div class="orderSuccessContainer">
                                    <div class="orderSuccess">
                                        <div class="orderStatus">Order is scheduled</div>
                                        <input type="hidden" name="payment_method" value="Cash on Delivery">
                                        
                                        <input type="hidden" name="transection_id" value="cash_on_delivery">
                                        <div class="bagIconContainer">
                                            <svg style="display:inline-block;vertical-align:middle;" width="100px" height="100px" fill="none" viewBox="0 0 60 60">
                                                <path fill="#412569" d="M50.88 0H9.12A9.12 9.12 0 000 9.12v41.76A9.12 9.12 0 009.12 60h41.76A9.12 9.12 0 0060 50.88V9.12A9.12 9.12 0 0050.88 0z"></path>
                                                <path fill="#ED907A" d="M18.526 31.52l-.727 7.268-1.171.83a2.964 2.964 0 01-3.382.64L.019 34.121v-6.629l13.224 6.138a2.964 2.964 0 003.382-.64l1.901-1.47z"></path>
                                                <path fill="#F89C8D" d="M28.829 39.55a1.887 1.887 0 00-1.14.39 1.894 1.894 0 00-3.046 1.515c0 1.05.852 3.425 1.904 3.425a1.886 1.886 0 001.14-.39c.327.252.727.388 1.14.39 1.05 0 1.903-2.374 1.903-3.425a1.903 1.903 0 00-1.9-1.904h-.001z"></path>
                                                <path fill="#F8664F" d="M30.428 42.95c-.343.97-.929 1.93-1.596 1.93a1.896 1.896 0 01-1.14-.39c-.328.25-.728.387-1.14.39-1.05 0-1.904-2.376-1.904-3.426a1.904 1.904 0 011.545-1.869 3.806 3.806 0 004.24 3.364h-.005z"></path>
                                                <path fill="#A1D51C" d="M28.827 38.788h-1.14a1.52 1.52 0 011.52-1.52h1.14a1.52 1.52 0 01-1.52 1.52z"></path>
                                                <path fill="#7AB92D" d="M30.146 38.028a1.61 1.61 0 01-.24.316 1.532 1.532 0 01-1.079.444h-1.14c.001-.404.161-.79.446-1.077.051-.052.107-.1.167-.14a1.128 1.128 0 00.912.455l.934.002z"></path>
                                                <path fill="#7AB92D" d="M27.686 40.31a.38.38 0 01-.38-.38v-.151a2.178 2.178 0 00-.972-1.817.381.381 0 01.422-.634 2.939 2.939 0 011.31 2.45v.153a.38.38 0 01-.38.38z"></path>
                                                <path fill="#5EAE35" d="M35.715 31.727v-7.568h-2.364a2.364 2.364 0 110-4.729h2.364l-1.419-1.42a2.006 2.006 0 012.837-2.837l1.418 1.42V14.7a2.838 2.838 0 115.675 0v1.892l1.42-1.419a2.007 2.007 0 012.837 2.838l-1.419 1.419h2.364a2.364 2.364 0 110 4.73h-2.364v7.566H35.715z"></path>
                                                <path fill="#FB0200" d="M42.336 24.16a4.73 4.73 0 00-4.73 4.728v.946h9.459v-.946a4.73 4.73 0 00-4.729-4.729z"></path>
                                                <path fill="#FF8706" d="M21.528 30.78V14.701a4.73 4.73 0 119.459 0v16.08h-9.46z"></path>
                                                <path fill="#FFA646" d="M24.365 16.593h3.784v1.892h-3.784v-1.892zM24.365 20.376h3.784v1.892h-3.784v-1.892zM24.365 24.16h3.784v1.891h-3.784v-1.892z"></path>
                                                <path fill="#008C02" d="M37.607 21.322V19.43a1.894 1.894 0 001.892-1.892h1.891a3.788 3.788 0 01-3.783 3.784zM46.12 22.268a3.788 3.788 0 01-3.784-3.783h1.892a1.894 1.894 0 001.892 1.891v1.892z"></path>
                                                <path fill="#C53287" d="M34.944 23.145a3.357 3.357 0 01-.193.772l-.382.797.046.024c.4.203.748.494 1.017.852l.015.02.026.001a3.24 3.24 0 011.43.382l.054.029 1.141-2.978a3.01 3.01 0 00-3.154.1v.001z"></path>
                                                <path fill="#0ED290" d="M33.41 20.194c-.424.15-.797.417-1.075.772a.065.065 0 01-.058.024.065.065 0 01-.051-.036 3.103 3.103 0 00-1.913-1.649.065.065 0 00-.076.034 3.103 3.103 0 00-.052 2.524.064.064 0 01-.007.063.066.066 0 01-.057.027c-.45-.03-.899.068-1.294.285a.065.065 0 00-.03.077c.156.44.437.825.81 1.106.01.007.017.017.021.029a.064.064 0 01-.046.084c-.26.06-.51.157-.744.288a.066.066 0 00-.03.078l.004.009a2.944 2.944 0 011.895.075c.412.157.784.404 1.088.724a2.95 2.95 0 012.622.031l.382-.797.002-.006a3.125 3.125 0 00-.141-2.644.066.066 0 00-.078-.03 2.764 2.764 0 00-.708.363.064.064 0 01-.094-.023.065.065 0 01-.007-.035 2.375 2.375 0 00-.283-1.342.065.065 0 00-.08-.032z"></path>
                                                <path fill="#00C285" d="M31.953 23.113a5.226 5.226 0 01-1.825-1.16 2.368 2.368 0 00-1.301.285.067.067 0 00-.03.078c.156.44.437.824.81 1.105a.064.064 0 01.007.096.064.064 0 01-.032.017c-.26.06-.51.157-.744.288a.066.066 0 00-.03.078l.004.009a2.945 2.945 0 011.895.075c.412.157.784.404 1.088.724a2.95 2.95 0 012.622.031l.382-.797.002-.006a3.44 3.44 0 00.171-.613 4.816 4.816 0 01-3.019-.21z"></path>
                                                <path fill="#07B27B" d="M31.685 22.488a.405.405 0 00-.205.533l.686 1.538c.266-.086.542-.134.822-.143l-.77-1.724a.405.405 0 00-.533-.204z"></path>
                                                <path fill="#98246A" d="M27.834 26.75c.531.203.968.597 1.224 1.105l.022.043.046-.017c.3-.117.622-.17.944-.153l.063.004-.006-.063a2.953 2.953 0 011.72-2.985 3 3 0 00-2.524-.937 3.015 3.015 0 00-2.686 2.88 2.295 2.295 0 011.197.123z"></path>
                                                <path fill="#E03D9C" d="M30.776 27.877l.116.045.152-.036a3.426 3.426 0 001.828-1.121 3.29 3.29 0 012.645-1.152 3.014 3.014 0 00-5.438 2.116c.238.013.473.063.697.148z"></path>
                                                <path fill="#FB2B3A" d="M45.655 23.757a2.862 2.862 0 01-3.126.445.163.163 0 00-.228.094 2.862 2.862 0 01-.922 1.307.056.056 0 01-.07 0 2.86 2.86 0 01-.921-1.307.164.164 0 00-.228-.094 2.862 2.862 0 01-3.126-.445 4.065 4.065 0 00-1.152 3.367h10.925a4.065 4.065 0 00-1.151-3.368z"></path>
                                                <path fill="#E41F2D" d="M38.806 24.472a2.844 2.844 0 01-1.77-.718 4.066 4.066 0 00-1.151 3.367h2.337a4.058 4.058 0 01.584-2.65z"></path>
                                                <path fill="#0ED290" d="M41.752 22.253v-1.08a.405.405 0 00-.81 0v1.08h.81z"></path>
                                                <path fill="#00C285" d="M43.755 22.196H38.94a2.911 2.911 0 00-2.28 1.099.11.11 0 000 .136 2.916 2.916 0 003.529.817.112.112 0 01.09-.002.111.111 0 01.062.065c.18.524.506.986.94 1.332a.11.11 0 00.136 0 2.92 2.92 0 00.94-1.332.11.11 0 01.106-.074c.016 0 .031.005.045.011a2.915 2.915 0 003.529-.817.11.11 0 000-.136 2.91 2.91 0 00-2.28-1.099z"></path>
                                                <path fill="#07B27B" d="M38.94 23.434a.11.11 0 010-.136 2.91 2.91 0 012.28-1.099h-2.28a2.91 2.91 0 00-2.28 1.099.11.11 0 000 .136 2.913 2.913 0 003.42.866 2.926 2.926 0 01-1.14-.866z"></path>
                                                <path fill="#FE9901" d="M39.268 30.264a4.116 4.116 0 00-2.718-4.465 4.208 4.208 0 01-2.084-1.596l-.228-.333a.201.201 0 00-.334 0l-.228.333a4.208 4.208 0 01-2.085 1.596 4.117 4.117 0 00-2.717 4.465h10.394z"></path>
                                                <path fill="#FB8801" d="M37.176 30.264c.016-.187.024-.38.024-.572 0-1.79-.69-3.325-1.647-3.893a3.205 3.205 0 01-1.245-1.596l-.136-.332c-.047-.118-.152-.118-.199 0l-.135.332a3.206 3.206 0 01-1.245 1.596c-.957.568-1.648 2.103-1.648 3.893 0 .194.009.385.025.572h6.206z"></path>
                                                <path fill="#FE9901" d="M35.112 30.264c.005-.187.008-.378.008-.572a10.127 10.127 0 00-.55-3.893 4.94 4.94 0 01-.417-1.596l-.045-.332c-.016-.118-.051-.118-.067 0l-.045.332a4.94 4.94 0 01-.416 1.596 10.127 10.127 0 00-.551 3.893c0 .194.002.385.008.572h2.075z"></path>
                                                <path fill="#A1D51C" d="M36.06 38.41a1.133 1.133 0 00-1.663-1.01 1.52 1.52 0 00-2.764 0 1.134 1.134 0 00-1.532 1.53 1.512 1.512 0 00-.367 2.525 1.52 1.52 0 102.25 2.004 1.14 1.14 0 002.1-.874c.025 0 .047.007.072.007a1.135 1.135 0 00.846-1.9 1.123 1.123 0 00.212-1.186 1.14 1.14 0 00.846-1.096z"></path>
                                                <path fill="#7AB92D" d="M35.299 41.454a1.14 1.14 0 01-1.14 1.14c-.023 0-.05-.008-.072-.008.047.124.071.256.072.389a1.14 1.14 0 01-2.173.483 1.518 1.518 0 01-2.272.286 1.52 1.52 0 01.023-2.29 1.512 1.512 0 01.366-2.523 1.135 1.135 0 011.533-1.534c.113-.249.29-.463.516-.618a1.507 1.507 0 00.251 2.01 1.519 1.519 0 102.247 2.004c.128.274.36.487.643.59a.401.401 0 01.006.07z"></path>
                                                <path fill="#5BA006" d="M31.51 42.455a.38.38 0 01-.334-.561 3.664 3.664 0 00.329-2.631.382.382 0 01.424-.47.382.382 0 01.314.284 4.425 4.425 0 01-.398 3.177.38.38 0 01-.334.2z"></path>
                                                <path fill="#5BA006" d="M31.35 42.753a.38.38 0 01-.333-.562l.161-.299a4.712 4.712 0 012.394-2.138.381.381 0 01.283.708 3.946 3.946 0 00-2.007 1.791l-.16.299a.38.38 0 01-.339.2z"></path>
                                                <path fill="#A1D51C" d="M36.495 43.816a1.135 1.135 0 00-1.242-1.498 1.52 1.52 0 00-2.614-.9 1.133 1.133 0 00-1.947.95 1.512 1.512 0 00-1.169 2.266 1.52 1.52 0 101.475 2.627 1.14 1.14 0 002.27-.14c.023.008.042.023.066.03a1.135 1.135 0 001.418-1.524 1.121 1.121 0 00.587-1.051 1.14 1.14 0 001.156-.76z"></path>
                                                <path fill="#7AB92D" d="M34.784 46.446a1.14 1.14 0 01-1.45.707c-.02-.007-.043-.023-.065-.03.004.132-.015.264-.058.39a1.14 1.14 0 01-2.212-.25 1.518 1.518 0 01-2.246-.467 1.52 1.52 0 01.773-2.16 1.511 1.511 0 011.167-2.268 1.135 1.135 0 011.947-.951c.187-.199.424-.342.686-.416a1.507 1.507 0 00-.417 1.982 1.52 1.52 0 101.475 2.627c.032.301.183.578.42.768a.424.424 0 01-.02.068z"></path>
                                                <path fill="#5BA006" d="M30.876 46.158a.38.38 0 01-.133-.64 3.664 3.664 0 001.167-2.38.38.38 0 01.757.069 4.426 4.426 0 01-1.41 2.874.38.38 0 01-.381.08v-.003z"></path>
                                                <path fill="#5BA006" d="M30.627 46.388a.38.38 0 01-.132-.638l.25-.23a4.712 4.712 0 012.957-1.243.38.38 0 01.301.637.381.381 0 01-.263.125 3.947 3.947 0 00-2.482 1.04l-.25.23a.38.38 0 01-.381.08z"></path>
                                                <path fill="#A1D51C" d="M44.911 42.257a1.816 1.816 0 00-1.992-2.4 2.432 2.432 0 00-4.189-1.442 1.816 1.816 0 00-3.12 1.522 2.424 2.424 0 00-1.873 3.633 2.432 2.432 0 102.362 4.213 1.824 1.824 0 003.638-.223c.036.012.068.035.106.048a1.823 1.823 0 002.274-2.442 1.8 1.8 0 00.94-1.686 1.825 1.825 0 001.854-1.223z"></path>
                                                <path fill="#7AB92D" d="M42.17 46.474a1.83 1.83 0 01-2.326 1.134c-.035-.012-.068-.036-.106-.05a1.76 1.76 0 01-.093.627 1.83 1.83 0 01-3.545-.402 2.43 2.43 0 01-3.854-1.75 2.433 2.433 0 011.491-2.462 2.422 2.422 0 011.87-3.633 1.825 1.825 0 013.125-1.525c.3-.317.68-.548 1.1-.666a2.414 2.414 0 00-.667 3.177 2.432 2.432 0 102.363 4.214c.052.483.294.925.672 1.23a.656.656 0 01-.03.106z"></path>
                                                <path fill="#5BA006" d="M35.904 46.013a.608.608 0 01-.21-1.024 5.872 5.872 0 001.876-3.813.609.609 0 111.208.102 7.092 7.092 0 01-2.26 4.608.608.608 0 01-.614.127z"></path>
                                                <path fill="#5BA006" d="M35.504 46.382a.608.608 0 01-.21-1.023l.399-.368A7.551 7.551 0 0140.434 43a.61.61 0 01.293 1.163.61.61 0 01-.231.059 6.325 6.325 0 00-3.979 1.668l-.4.369a.607.607 0 01-.613.123z"></path>
                                                <path fill="#A1D51C" d="M24.248 41.28a1.133 1.133 0 00-1.181 1.547 1.52 1.52 0 00-.29 2.75 1.132 1.132 0 001.362 1.683 1.511 1.511 0 002.471.63 1.52 1.52 0 102.23-2.027 1.14 1.14 0 00-.647-2.18c.003-.025.013-.047.015-.072a1.136 1.136 0 00-1.804-1.04 1.123 1.123 0 00-1.156-.336 1.14 1.14 0 00-1-.955z"></path>
                                                <path fill="#7AB92D" d="M27.195 42.356a1.14 1.14 0 011.014 1.254c-.002.022-.013.048-.015.07a1.14 1.14 0 01.646 2.18 1.52 1.52 0 11-2.228 2.026 1.511 1.511 0 01-2.472-.628 1.136 1.136 0 01-1.365-1.683 1.501 1.501 0 01-.559-.576 1.507 1.507 0 002.025-.038 1.52 1.52 0 102.229-2.027c.287-.1.522-.309.654-.581.024-.001.048 0 .071.003z"></path>
                                                <path fill="#5BA006" d="M27.792 46.229a.38.38 0 01-.594.273 3.664 3.664 0 00-2.58-.603.38.38 0 01-.105-.753 4.425 4.425 0 013.118.729.38.38 0 01.164.354h-.003z"></path>
                                                <path fill="#5BA006" d="M28.072 46.42a.38.38 0 01-.592.272l-.28-.192a4.712 4.712 0 01-1.875-2.602.379.379 0 01.13-.403.383.383 0 01.422-.034.381.381 0 01.18.229c.253.89.809 1.663 1.572 2.184l.28.192a.38.38 0 01.163.355z"></path>
                                                <path fill="#A1D51C" d="M42.15 36.888a1.132 1.132 0 00-1.663-1.011 1.52 1.52 0 00-2.765 0 1.133 1.133 0 00-1.532 1.531 1.512 1.512 0 00-.367 2.524 1.521 1.521 0 001.785 2.45 1.52 1.52 0 00.465-.446 1.14 1.14 0 002.1-.873c.025 0 .047.007.072.007a1.136 1.136 0 00.846-1.9 1.123 1.123 0 00.212-1.186 1.14 1.14 0 00.846-1.096z"></path>
                                                <path fill="#7AB92D" d="M41.388 39.932a1.14 1.14 0 01-1.14 1.14c-.023 0-.05-.008-.072-.008.047.124.071.256.072.388a1.14 1.14 0 01-2.173.484 1.519 1.519 0 11-2.249-2.004 1.51 1.51 0 01.366-2.524 1.135 1.135 0 011.533-1.533c.113-.25.29-.463.516-.618a1.507 1.507 0 00.251 2.01 1.519 1.519 0 102.247 2.003c.128.275.36.487.644.592a.41.41 0 01.005.07z"></path>
                                                <path fill="#5BA006" d="M37.6 40.932a.38.38 0 01-.335-.56 3.663 3.663 0 00.329-2.632.38.38 0 11.738-.185 4.426 4.426 0 01-.398 3.177.38.38 0 01-.334.2z"></path>
                                                <path fill="#5BA006" d="M37.438 41.23a.38.38 0 01-.332-.561l.161-.299a4.712 4.712 0 012.394-2.138.381.381 0 01.284.708 3.947 3.947 0 00-2.008 1.791l-.16.299a.38.38 0 01-.339.2z"></path>
                                                <path fill="#F89C8D" d="M31.169 49.466a2.505 2.505 0 100-5.01 2.505 2.505 0 000 5.01z"></path>
                                                <path fill="#F8664F" d="M33.777 46.972a2.474 2.474 0 11-3.033-2.409 2.477 2.477 0 002.462 2.218c.188 0 .376-.023.56-.067.004.086.011.175.011.258z"></path>
                                                <path fill="#A1D51C" d="M31.873 46.022a.379.379 0 01-.326-.577 2.702 2.702 0 011.96-1.292l.218-.03a.38.38 0 01.102.755l-.217.03a1.944 1.944 0 00-1.41.93.38.38 0 01-.327.186v-.002z"></path>
                                                <path fill="#F89C8D" d="M43.194 43.119a2.505 2.505 0 100-5.01 2.505 2.505 0 000 5.01z"></path>
                                                <path fill="#F8664F" d="M45.575 40.502a2.474 2.474 0 11-3.034-2.409 2.477 2.477 0 002.462 2.219c.189-.001.377-.024.56-.068.005.087.012.175.012.258z"></path>
                                                <path fill="#A1D51C" d="M43.67 39.552a.38.38 0 01-.326-.577 2.702 2.702 0 011.96-1.291l.218-.03a.38.38 0 11.103.754l-.218.03a1.945 1.945 0 00-1.41.93.38.38 0 01-.327.186v-.002z"></path>
                                                <path fill="#A2E62E" d="M22.711 29.98l4.48-7.165a2.91 2.91 0 00-3.422-2.791 2.91 2.91 0 00-3.314-2.073 2.91 2.91 0 00-5.114-.973 2.91 2.91 0 10-3.063 4.897 2.91 2.91 0 003.111 4.176 2.91 2.91 0 003.314 2.072 2.91 2.91 0 004.008 1.856z"></path>
                                                <path fill="#97D729" d="M22.711 29.98l1.854-2.965a2.912 2.912 0 01-3.926-1.605.34.34 0 00-.348-.217 2.911 2.911 0 01-2.964-1.854.34.34 0 00-.347-.217 2.91 2.91 0 01-2.972-3.93.346.346 0 00-.145-.421l-.037-.023a2.904 2.904 0 01-1.359-2.219 2.911 2.911 0 00-.19 5.349 2.91 2.91 0 003.112 4.173 2.91 2.91 0 003.314 2.072 2.91 2.91 0 004.008 1.856z"></path>
                                                <path fill="#8BC727" d="M18.104 22.706l1.49.932-1.882.347a.502.502 0 10.182.987l2.962-.546 1.464.917-.943.164a.502.502 0 10.174.989l2.043-.357 1.096.685.532-.85-3.835-2.398-.805-2.901a.502.502 0 00-.967.268l.512 1.844-1.491-.932-.78-2.882a.502.502 0 10-.97.26l.498 1.836-2.1-1.313a.502.502 0 10-.532.851l2.1 1.314-1.868.355a.503.503 0 00.19.986l2.93-.556z" ></path>
                                                <path fill="#84D2F4" d="M23.78 19.871l-1.688-3.465-4.02 1.959 1.689 3.465a5.092 5.092 0 01.236 3.889 5.092 5.092 0 00.236 3.887L25.51 40.44l9.381-4.57-5.279-10.834a5.092 5.092 0 00-2.917-2.583 5.092 5.092 0 01-2.915-2.582z"></path>
                                                <path fill="#57B7EB" d="M30.681 27.228l4.211 8.642-9.38 4.57-5.279-10.833a5.092 5.092 0 01-.237-3.887 5.092 5.092 0 00-.236-3.891l-1.688-3.464 4.02-1.959.657 1.347a2.356 2.356 0 00-.979 3.097 5.092 5.092 0 01.237 3.887 5.091 5.091 0 00.237 3.892 8.317 8.317 0 008.336 4.636 7.86 7.86 0 01-.978-1.447 3.724 3.724 0 011.081-4.59h-.002z"></path>
                                                <path fill="#D0D8DA" d="M16.096 16.011l5.36-2.612 1.307 2.68-5.36 2.612-1.307-2.68zM20.942 31.061l9.38-4.57 2.286 4.69-9.381 4.57-2.285-4.69z"></path>
                                                <path fill="#93999A" d="M27.013 32.853c.468.164.95.282 1.44.352l-5.226 2.547-2.285-4.69 2.157-1.052a8.263 8.263 0 003.914 2.843zM30.681 27.228l1.927 3.954-2.626 1.28a5.657 5.657 0 01-.381-.645 3.724 3.724 0 011.082-4.59l-.002.001zM22.11 14.74l.653 1.34-5.36 2.611-1.307-2.68 1.702-.83a2.964 2.964 0 002.971.212l1.34-.653z"></path>
                                                <path fill="#F89C8D" d="M28.067 37.267a1.887 1.887 0 00-1.14.39 1.895 1.895 0 00-3.046 1.514c0 1.05.852 3.425 1.904 3.425a1.886 1.886 0 001.14-.389c.327.25.728.387 1.14.39 1.051 0 1.904-2.375 1.904-3.426a1.904 1.904 0 00-1.9-1.904h-.002z"></path>
                                                <path fill="#F8664F" d="M29.666 40.666c-.342.97-.928 1.93-1.596 1.93a1.895 1.895 0 01-1.14-.389c-.327.25-.727.386-1.14.388-1.05 0-1.903-2.375-1.903-3.425a1.904 1.904 0 011.545-1.869 3.806 3.806 0 004.239 3.365h-.005z"></path>
                                                <path fill="#A1D51C" d="M28.066 36.504h-1.14a1.52 1.52 0 011.52-1.52h1.14a1.52 1.52 0 01-1.52 1.52z"></path>
                                                <path fill="#7AB92D" d="M29.384 35.744a1.61 1.61 0 01-.24.316 1.532 1.532 0 01-1.078.444h-1.14c0-.404.16-.79.445-1.077.052-.052.107-.099.167-.14a1.128 1.128 0 00.912.456l.934.001z"></path>
                                                <path fill="#7AB92D" d="M26.924 38.027a.38.38 0 01-.38-.38v-.152a2.179 2.179 0 00-.972-1.816.384.384 0 01-.162-.391.383.383 0 01.585-.244 2.94 2.94 0 011.31 2.451v.152a.38.38 0 01-.38.38z"></path>
                                                <path fill="#4981F8" d="M40.271 28.613v1.181h-14.51v-1.181h-4.279v21.312h23.07V28.613h-4.28zM28.672 46.145a.524.524 0 01-.524.524h-3.295a.524.524 0 01-.524-.524v-2.209a.524.524 0 01.524-.524h3.295a.524.524 0 01.524.524v2.209zm0-5.43a.524.524 0 01-.524.524h-3.295a.524.524 0 01-.524-.524v-2.208a.524.524 0 01.524-.525h3.295a.524.524 0 01.524.525v2.208zm6.514 5.43a.524.524 0 01-.524.524h-3.293a.524.524 0 01-.524-.524v-2.209a.524.524 0 01.524-.524h3.295a.524.524 0 01.524.524l-.002 2.209zm0-5.43a.524.524 0 01-.524.524h-3.293a.524.524 0 01-.524-.524v-2.208a.524.524 0 01.524-.525h3.295a.524.524 0 01.524.525l-.002 2.208zm6.514 5.43a.524.524 0 01-.524.524h-3.293a.524.524 0 01-.524-.524v-2.209a.524.524 0 01.524-.524h3.295a.524.524 0 01.524.524l-.002 2.209zm0-5.43a.524.524 0 01-.524.524h-3.293a.524.524 0 01-.524-.524v-2.208a.524.524 0 01.524-.525h3.295a.524.524 0 01.524.525l-.002 2.208z"></path>
                                                <path fill="#62A4FB" d="M43.874 28.919h4.342V49.4h-4.342V28.92z"></path>
                                                <path fill="#5392F9" d="M46.71 28.919h1.507V49.4H46.71V28.92z"></path>
                                                <path fill="#62A4FB" d="M17.814 28.919h4.343V49.4h-4.343V28.92z"></path>
                                                <path fill="#5392F9" d="M20.65 28.919h1.508V49.4H20.65V28.92z"></path>
                                                <path fill="#80B6FC" d="M40.28 31.468H25.75a.542.542 0 01-.486-.305l-.784-1.567a.543.543 0 00-.485-.304H17.27a.543.543 0 01-.543-.54v-1.085a.543.543 0 01.543-.543h8.064a.542.542 0 01.486.304l.787 1.566a.543.543 0 00.486.305h11.844a.543.543 0 00.486-.305l.788-1.569a.543.543 0 01.486-.304h8.062a.542.542 0 01.542.543v1.089a.542.542 0 01-.542.543h-6.724a.542.542 0 00-.486.303l-.785 1.57a.543.543 0 01-.486.305l.002-.006zM48.794 35.81H17.238a.51.51 0 01-.51-.508v-1.154a.51.51 0 01.51-.51h31.556a.51.51 0 01.51.51v1.154a.51.51 0 01-.51.509zM23.82 51.011h-6.582a.51.51 0 01-.51-.508V49.35a.509.509 0 01.51-.508h6.582a.51.51 0 01.509.51v1.153a.51.51 0 01-.51.508zM48.793 51.011H42.21a.51.51 0 01-.51-.509V49.35a.51.51 0 01.51-.51h6.582a.51.51 0 01.51.51v1.153a.51.51 0 01-.508.51z"></path>
                                                <path fill="#62A4FB" d="M48.76 27.124h-1.508a.543.543 0 01.542.543v1.086a.542.542 0 01-.542.543h1.508a.542.542 0 00.542-.543v-1.086a.543.543 0 00-.542-.543zM48.778 33.639H47.27a.525.525 0 01.524.524v1.123a.524.524 0 01-.524.525h1.508a.525.525 0 00.524-.525v-1.123a.525.525 0 00-.524-.524zM48.778 48.84H47.27a.525.525 0 01.524.525v1.123a.525.525 0 01-.524.524h1.508a.525.525 0 00.524-.524v-1.123a.525.525 0 00-.524-.525zM23.805 48.84h-1.508a.525.525 0 01.524.525v1.123a.525.525 0 01-.524.524h1.508a.525.525 0 00.524-.524v-1.123a.525.525 0 00-.524-.525z"></path>
                                                <path fill="#FCBFA9" d="M26.93 53.6l-1.37.932a2.279 2.279 0 01-2.005.274L13.09 51.25.019 46.551v-12.54l13.44 6.167a2.75 2.75 0 003.245-.64l.83-1.108 2.27-2.029 5.541-1.245a1.66 1.66 0 011.976 1.245 1.693 1.693 0 01-1.091 2.03l-2.384.806a1.136 1.136 0 00-.76 1.074 1.152 1.152 0 00.677 1.05l13.731 5.993c.355.154.65.421.836.76a1.824 1.824 0 01.054 1.724 1.765 1.765 0 01-2.16.912l-2.484-.836-.83 1.692a1.529 1.529 0 01-1.869.784l-.407-.141-.747 1.142a1.531 1.531 0 01-1.769.618l-1.188-.41z"></path>
                                                <path fill="#ED907A" d="M21.315 52.828a1.082 1.082 0 00.624 1.51l1.41.469a2.349 2.349 0 002.033-.273l.174-.116-4.241-1.59zM36.193 50.771a1.803 1.803 0 002.249-1.04.143.143 0 01-.007-.017L27.858 46.01a1.344 1.344 0 00.57 2.176l5.247 1.748 2.518.837zM30.94 52.4a1.557 1.557 0 001.893-.777l.173-.345-6.237-1.891a1.453 1.453 0 00.889 1.919l2.867.954.416.14zM27.98 54.013a1.567 1.567 0 001.793-.616l.026-.039-6.748-2.423a1.612 1.612 0 001.08 1.792l2.642.88 1.208.406z"></path>
                                            </svg>
                                        </div>
                                        <div class="estimatedDeliveryText">Selected Delivery Slot</div>
                                        <div class="deliveryTimeWithDate">
                                            <div class="estimatedDeliveryTime"><span><span>2:00 PM</span><span> - </span><span>3:00 PM</span><span>, </span><span>26/06/23</span></span></div>
                                        </div>
                                        <div class="cardContainer">
                                            <div class="paymentStatusCard">
                                                <div class="intro emphasize">Pay with</div>
                                                <div class="iconContainer">
                                                    <svg style="display:inline-block;vertical-align:middle;" width="17px" height="14px" viewBox="0 0 16.818 14.362">
                                                        <path id="Path_67335" data-name="Path 67335" d="M14.433,34.015V37.8l2.385-.907-3.305-8.3L0,34.015" transform="translate(0 -28.588)" fill="#6f9935"></path>
                                                        <path id="Path_67336" data-name="Path 67336" d="M30.433,143.146V138.94H17.024L16,139.351v.276H29.746v3.78Z" transform="translate(-15.313 -134.2)" fill="#658b30"></path>
                                                        <path id="Path_67337" data-name="Path 67337" d="M0,154.94H14.433v8.935H0Z" transform="translate(0 -149.513)" fill="#79a73a"></path>
                                                        <path id="Path_67338" data-name="Path 67338" d="M32,188.559a2.411,2.411,0,0,0,1.619-1.619h8.447a2.41,2.41,0,0,0,1.619,1.619v2.948a2.41,2.41,0,0,0-1.619,1.619H33.618A2.411,2.411,0,0,0,32,191.507Z" transform="translate(-30.625 -180.138)" fill="#aac16b"></path>
                                                        <circle id="Ellipse_784" data-name="Ellipse 784" cx="1.718" cy="1.718" r="1.718" transform="translate(5.498 8.177)" fill="#79a73a"></circle>
                                                        <path id="Path_67339" data-name="Path 67339" d="M98.415,86.033l-.815-2.1-.037-.092a2.411,2.411,0,0,1-2.1-.9l-.092.037L88,86.033Z" transform="translate(-84.22 -80.605)" fill="#aac16b"></path>
                                                        <path id="Path_67340" data-name="Path 67340" d="M89.657,138.94,88,139.627H98.415l-.267-.687Z" transform="translate(-84.22 -134.2)" fill="#89b140"></path>
                                                        <g id="Group_41642" data-name="Group 41642" transform="translate(3.093 9.551)">
                                                            <circle id="Ellipse_785" data-name="Ellipse 785" cx="0.344" cy="0.344" r="0.344" transform="translate(0 0)" fill="#79a73a"></circle>
                                                            <circle id="Ellipse_786" data-name="Ellipse 786" cx="0.344" cy="0.344" r="0.344" transform="translate(7.56 0)" fill="#79a73a"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div ><span>Cash On Delivery</span><span class="amount emphasize"><span></span><span>35</span></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                              -->
                              
                              
                              <!--
                              
                                <div class="orBlockContainer">
                                    <div class="orBlock">
                                        <div class="divider"></div>
                                        <div class="blockText">Or</div>
                                        <div class="divider"></div>
                                    </div>
                                </div>
                              
                              -->
                              
                              
                                <div class="paymentMethodsContainer">
                                    <div class="paymentMethodsBlock">
                                        <div class="paymentMethods">
                                          <!--
                                            <div class="inlinePaymentComponent">
                                                <div>
                                                    <section class="paymentMethods">
                                                        <div class="paymentMethodItem">
                                                            <div class="paymentMethodItemContent">
                                                                <span>Credit / Debit Card</span>
                                                                <div class="imageContainer">
                                                                    <div>
                                                                        <svg style="display:inline-block;vertical-align:middle;" width="22px" height="17px" viewBox="0 0 21.816 16.944">
                                                                            <path id="XMLID_1775_" d="M52.667,661.811v-1.124a.66.66,0,0,0-.712-.712.737.737,0,0,0-.638.319.658.658,0,0,0-.6-.319.6.6,0,0,0-.524.262v-.225H49.8v1.8h.393v-.993c0-.319.168-.469.43-.469s.393.168.393.469v.993h.393v-.993a.415.415,0,0,1,.43-.469c.262,0,.393.168.393.469v.993Zm5.83-1.8h-.638v-.544h-.393v.544H57.11v.356h.356v.826c0,.413.168.655.618.655a1.057,1.057,0,0,0,.487-.131l-.114-.338a.627.627,0,0,1-.338.094c-.188,0-.262-.114-.262-.3v-.806h.638v-.356Zm3.336-.039a.533.533,0,0,0-.469.262v-.225H60.97v1.8h.393V660.8c0-.3.131-.469.376-.469a1.207,1.207,0,0,1,.245.037l.114-.375a1.554,1.554,0,0,0-.264-.015Zm-5.041.188a1.289,1.289,0,0,0-.731-.188c-.45,0-.749.225-.749.581,0,.3.225.469.618.524l.188.02c.205.037.319.094.319.188,0,.131-.151.225-.413.225a1.035,1.035,0,0,1-.6-.188l-.188.3a1.317,1.317,0,0,0,.769.225c.524,0,.825-.245.825-.581,0-.319-.245-.487-.618-.544l-.188-.02c-.168-.02-.3-.057-.3-.168,0-.131.131-.205.338-.205a1.352,1.352,0,0,1,.563.151l.166-.319Zm10.456-.188a.533.533,0,0,0-.469.262v-.225h-.393v1.8h.393V660.8c0-.3.131-.469.376-.469a1.207,1.207,0,0,1,.245.037l.114-.371a1.2,1.2,0,0,0-.264-.02Zm-5.022.939a.9.9,0,0,0,.956.937.942.942,0,0,0,.638-.205l-.188-.319a.751.751,0,0,1-.469.168.532.532,0,0,1-.544-.581.551.551,0,0,1,.544-.581.768.768,0,0,1,.469.168l.188-.319a.931.931,0,0,0-.638-.205.9.9,0,0,0-.956.937Zm3.635,0v-.9h-.393v.225a.679.679,0,0,0-.563-.262.938.938,0,0,0,0,1.874.636.636,0,0,0,.563-.262v.225h.393v-.9Zm-1.443,0a.545.545,0,1,1,1.087,0,.545.545,0,1,1-1.087,0Zm-4.7-.939a.937.937,0,0,0,.02,1.873,1.141,1.141,0,0,0,.731-.245l-.188-.281a.892.892,0,0,1-.524.188.507.507,0,0,1-.544-.43h1.33v-.151a.83.83,0,0,0-.825-.954Zm0,.339a.438.438,0,0,1,.45.43h-.937a.474.474,0,0,1,.487-.43Zm9.764.6V659.3h-.393v.937a.679.679,0,0,0-.563-.262.938.938,0,0,0,0,1.874.636.636,0,0,0,.563-.262v.225h.393v-.9Zm-1.443,0a.545.545,0,1,1,1.087,0,.545.545,0,1,1-1.087,0Zm-13.157,0v-.9h-.393v.225a.679.679,0,0,0-.563-.262.938.938,0,0,0,0,1.874.636.636,0,0,0,.563-.262v.225h.393v-.9Zm-1.461,0a.545.545,0,1,1,1.087,0,.545.545,0,1,1-1.087,0Z" transform="translate(-48.713 -644.905)"></path>
                                                                            <g id="Group_41637" data-name="Group 41637">
                                                                                <rect id="rect19" width="5.904" height="10.607" transform="translate(7.947 1.443)" fill="#ff5a00"></rect>
                                                                                <path id="XMLID_330_" d="M8.34,6.747a6.766,6.766,0,0,1,2.568-5.3,6.744,6.744,0,1,0-4.161,12.05,6.71,6.71,0,0,0,4.161-1.443A6.733,6.733,0,0,1,8.34,6.747Z" transform="translate(0 0)" fill="#eb001b"></path>
                                                                                <path id="path22" d="M510.508,6.747a6.74,6.74,0,0,1-10.908,5.3,6.761,6.761,0,0,0,0-10.607,6.74,6.74,0,0,1,10.908,5.3Z" transform="translate(-488.692 0)" fill="#f79e1b"></path>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <div class="imageContainer">
                                                                    <div>
                                                                        <svg style="display:inline-block;vertical-align:middle;" width="25.006px" height="8.093px" viewBox="0 0 25.006 8.093">
                                                                            <path id="polygon9" d="M435.533,118.561h-2.026l1.267-7.834H436.8Z" transform="translate(-424.697 -110.585)" fill="#00579f"></path>
                                                                            <path id="path11" d="M571.255,105.381a4.992,4.992,0,0,0-1.817-.334c-2,0-3.409,1.067-3.418,2.592-.016,1.125,1.009,1.75,1.775,2.125.784.383,1.05.634,1.05.975-.008.525-.633.767-1.217.767a4.032,4.032,0,0,1-1.9-.417l-.267-.125-.284,1.759a6.166,6.166,0,0,0,2.259.417c2.126,0,3.509-1.05,3.526-2.676.008-.892-.533-1.575-1.7-2.134-.708-.358-1.142-.6-1.142-.967.008-.333.367-.675,1.167-.675a3.442,3.442,0,0,1,1.509.3l.183.083.275-1.692Z" transform="translate(-553.076 -105.048)" fill="#00579f"></path>
                                                                            <path id="path13" d="M793.656,115.786c.167-.45.809-2.192.809-2.192-.008.017.167-.458.266-.75l.142.675s.383,1.875.467,2.267Zm2.5-5.059h-1.567a1,1,0,0,0-1.059.65l-3.009,7.184h2.125l.425-1.175h2.6c.058.275.242,1.175.242,1.175h1.875l-1.634-7.834Z" transform="translate(-772.785 -110.585)" fill="#00579f"></path>
                                                                            <path id="path15" d="M170.837,110.727l-1.984,5.342-.217-1.083a6,6,0,0,0-2.8-3.284l1.817,6.851h2.142l3.184-7.826Z" transform="translate(-163.718 -110.585)" fill="#00579f"></path>
                                                                            <path id="path17" d="M84.458,110.727H81.2l-.033.158a6.778,6.778,0,0,1,4.918,4.1l-.708-3.6a.838.838,0,0,0-.917-.659Z" transform="translate(-81.166 -110.585)" fill="#faa61a"></path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <div class="imageContainer">
                                                                    <div>
                                                                        <svg style="display:inline-block;vertical-align:middle;" width="19.289px" height="19.242px" viewBox="0 0 19.289 19.242">
                                                                            <path id="path3078" d="M55.5,1002.35H74.741v10.387l-.952,1.488.952,1.324v6.042H55.5V1011.8l.6-.685-.6-.655Z" transform="translate(-55.5 -1002.35)" fill="#016fd0"></path>
                                                                            <path id="path3082" d="M249.14,1543.852v-3.021h3.2l.343.447.355-.447h11.61v2.813a1.343,1.343,0,0,1-.655.208h-6.429l-.387-.476v.476h-1.268v-.813a1.063,1.063,0,0,1-.548.114h-.432v.7h-1.92l-.343-.457-.348.457Z" transform="translate(-245.405 -1530.444)" fill="#fff"></path>
                                                                            <path id="path3080" d="M55.5,1337.3l.721-1.681h1.247l.409.942v-.942h1.551l.244.681.236-.681h6.961v.342a1.5,1.5,0,0,1,.967-.342l2.258.008.4.93v-.937h1.3l.357.534v-.534h1.31v3.021h-1.31l-.342-.536v.536H69.9l-.192-.476H69.2l-.189.476H67.717a1.278,1.278,0,0,1-.848-.335v.335H64.919l-.387-.476v.476H57.283l-.192-.476h-.511l-.19.476H55.5Z" transform="translate(-55.5 -1329.195)" fill="#fff"></path>
                                                                            <path id="path3046" d="M56.666,1354.93l-.973,2.262h.633l.179-.453h1.044l.179.453h.647l-.972-2.262Zm.36.526.318.792h-.637Z" transform="translate(-55.689 -1348.129)" fill="#016fd0"></path>
                                                                            <path id="path3048" d="M198.223,1357.168v-2.262l.9,0,.523,1.458.511-1.461h.893v2.262h-.565V1355.5l-.6,1.667h-.5l-.6-1.667v1.667Z" transform="translate(-195.47 -1348.106)" fill="#016fd0"></path>
                                                                            <path id="path3050" d="M364.861,1357.168v-2.262h1.845v.506h-1.274v.387h1.244v.476h-1.244v.4h1.274v.491Z" transform="translate(-358.894 -1348.106)" fill="#016fd0"></path>
                                                                            <path id="path3052" d="M477.5,1354.93v2.262h.565v-.8h.238l.678.8h.691l-.744-.833a.689.689,0,0,0,.62-.695.732.732,0,0,0-.791-.734Zm.565.506h.646a.26.26,0,0,1,.268.238.256.256,0,0,1-.259.238h-.655Z" transform="translate(-469.357 -1348.129)" fill="#016fd0"></path>
                                                                            <path id="path3054" d="M596.264,1357.168h-.578v-2.262h.578Z" transform="translate(-585.267 -1348.106)" fill="#016fd0"></path>
                                                                            <path id="path3056" d="M640.986,1357.168h-.125a1,1,0,0,1-.969-1.122,1.036,1.036,0,0,1,1.123-1.14h.625v.536h-.648a.544.544,0,0,0-.528.61.554.554,0,0,0,.61.622h.149Z" transform="translate(-628.62 -1348.106)" fill="#016fd0"></path>
                                                                            <path id="path3058" d="M710.925,1354.93l-.973,2.262h.633l.18-.453h1.043l.179.453h.647l-.972-2.262Zm.36.526.318.792h-.637Z" transform="translate(-697.328 -1348.129)" fill="#016fd0"></path>
                                                                            <path id="path3060" d="M852.433,1357.168v-2.262h.719l.918,1.421v-1.421h.566v2.262h-.7L853,1355.71v1.458Z" transform="translate(-837.061 -1348.106)" fill="#016fd0"></path>
                                                                            <path id="path3062" d="M269.2,1562.388v-2.262h1.845v.506h-1.274v.387h1.244v.476h-1.244v.4h1.274v.491Z" transform="translate(-265.076 -1549.367)" fill="#016fd0"></path>
                                                                            <path id="path3064" d="M737.947,1562.388v-2.262h1.845v.506h-1.274v.387h1.238v.476h-1.238v.4h1.274v.491Z" transform="translate(-724.783 -1549.367)" fill="#016fd0"></path>
                                                                            <path id="path3066" d="M367.486,1562.388l.9-1.117-.92-1.145h.712l.548.708.55-.708h.685l-.908,1.131.9,1.131h-.712l-.532-.7-.519.7Z" transform="translate(-361.448 -1549.367)" fill="#016fd0"></path>
                                                                            <path id="path3068" d="M499.869,1560.14v2.262h.58v-.714h.6a.782.782,0,0,0,.885-.787.744.744,0,0,0-.812-.761Zm.58.512h.627a.255.255,0,0,1,.279.26.261.261,0,0,1-.281.26h-.625Z" transform="translate(-491.298 -1549.38)" fill="#016fd0"></path>
                                                                            <path id="path3072" d="M619.448,1560.12v2.262h.565v-.8h.238l.678.8h.691l-.744-.833a.689.689,0,0,0,.62-.695.732.732,0,0,0-.791-.734Zm.565.506h.646a.26.26,0,0,1,.268.238.256.256,0,0,1-.26.238h-.655Z" transform="translate(-608.57 -1549.36)" fill="#016fd0"></path>
                                                                            <path id="path3074" d="M843.536,1562.388v-.491h1.132c.167,0,.24-.091.24-.19s-.072-.191-.24-.191h-.511a.632.632,0,0,1-.692-.677c0-.363.227-.713.887-.713h1.1l-.238.509h-.953c-.182,0-.238.1-.238.187a.2.2,0,0,0,.208.2h.536a.621.621,0,0,1,.711.649.678.678,0,0,1-.738.72Z" transform="translate(-828.266 -1549.366)" fill="#016fd0"></path>
                                                                            <path id="path3076" d="M951.133,1562.388v-.491h1.132c.167,0,.24-.091.24-.19s-.072-.191-.24-.191h-.511a.632.632,0,0,1-.692-.677c0-.363.227-.713.887-.713h1.1l-.238.509h-.952c-.182,0-.238.1-.238.187a.2.2,0,0,0,.208.2h.536a.621.621,0,0,1,.711.649.678.678,0,0,1-.737.72Z" transform="translate(-933.787 -1549.366)" fill="#016fd0"></path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="paymentMethodItem">
                                                            <div class="paymentMethodItemContent">
                                                                <span>International Credit / Debit Card</span>
                                                                <div class="imageContainer">
                                                                    <div>
                                                                        <svg style="display:inline-block;vertical-align:middle;" width="28px" height="17px" viewBox="0 0 28.038 17.142">
                                                                            <g id="master-card" transform="translate(0 0.74)">
                                                                                <path id="Path_1224" data-name="Path 1224" d="M25.195,93.77a1.422,1.422,0,0,1-1.489,1.342H1.489A1.422,1.422,0,0,1,0,93.77V80.793a1.422,1.422,0,0,1,1.489-1.342H23.705a1.422,1.422,0,0,1,1.489,1.342V93.77Z" transform="translate(0 -79.451)" fill="#4b849e"></path>
                                                                                <path id="Path_1225" data-name="Path 1225" d="M.842,93.77V80.793a1.271,1.271,0,0,1,1.184-1.342H1.184A1.271,1.271,0,0,0,0,80.793V93.77a1.271,1.271,0,0,0,1.184,1.342h.842A1.271,1.271,0,0,1,.842,93.77Z" transform="translate(0 -79.451)" fill="#202121" opacity="0.15"></path>
                                                                                <path id="Path_1226" data-name="Path 1226" d="M265.207,179.37a2.244,2.244,0,0,1,.833-1.747,2.248,2.248,0,1,0,0,3.494A2.243,2.243,0,0,1,265.207,179.37Z" transform="translate(-248.874 -172.544)" fill="#ea001b"></path>
                                                                                <path id="Path_1227" data-name="Path 1227" d="M357.4,177.123a2.239,2.239,0,0,0-1.415.5,2.248,2.248,0,0,1,0,3.494,2.248,2.248,0,1,0,1.415-4Z" transform="translate(-336.895 -172.545)" fill="#f79f1a"></path>
                                                                                <path id="Path_1228" data-name="Path 1228" d="M336.354,191.675a1.072,1.072,0,1,0-.833,1.747A2.244,2.244,0,0,0,336.354,191.675Z" transform="translate(-317.912 -184.832)" fill="#ff5f01"></path>
                                                                                <path id="Path_1229" data-name="Path 1229" d="M64.664,186.288a.286.286,0,0,1-.286.286H60.83a.286.286,0,0,1-.286-.286v-2.765a.286.286,0,0,1,.286-.286h3.548a.286.286,0,0,1,.286.286v2.765Z" transform="translate(-58.175 -178.461)" fill="#f36920"></path>
                                                                                <g id="Group_794" data-name="Group 794" transform="translate(2.042 10.631)">
                                                                                    <path id="Path_1230" data-name="Path 1230" d="M56.681,315.063h-4.16a.327.327,0,1,1,0-.653h4.16a.327.327,0,1,1,0,.653Z" transform="translate(-52.195 -314.41)" fill="#34495e"></path>
                                                                                    <path id="Path_1231" data-name="Path 1231" d="M56.681,349.876h-4.16a.327.327,0,0,1,0-.653h4.16a.327.327,0,0,1,0,.653Z" transform="translate(-52.195 -347.861)" fill="#34495e"></path>
                                                                                </g>
                                                                                <g id="Group_795" data-name="Group 795" transform="translate(2.369 4.776)">
                                                                                    <path id="Path_1232" data-name="Path 1232" d="M61.652,186.573h.653v-3.337h-.653v.786H60.543v.653h1.109v.459H60.543v.653h1.109v.786Z" transform="translate(-60.543 -183.236)" fill="#ffa617"></path>
                                                                                    <path id="Path_1233" data-name="Path 1233" d="M126.156,184.675h.327v-.653h-.95v-.786h-.653v2.225a.327.327,0,0,0,.327.327h1.276v-.653h-.95v-.459Z" transform="translate(-122.362 -183.236)" fill="#ffa617"></path>
                                                                                </g>
                                                                                <path id="Path_1234" data-name="Path 1234" d="M61.146,186.288v-2.765a.286.286,0,0,1,.286-.286h-.6a.286.286,0,0,0-.286.286v2.765a.286.286,0,0,0,.286.286h.6A.286.286,0,0,1,61.146,186.288Z" transform="translate(-58.175 -178.461)" fill="#202121" opacity="0.15"></path>
                                                                            </g>
                                                                            <g id="earth-globe" transform="translate(10.895 0)">
                                                                                <ellipse id="Ellipse_678" data-name="Ellipse 678" cx="8.32" cy="8.32" rx="8.32" ry="8.32" transform="translate(0.251 0.251)" fill="#87dcff"></ellipse>
                                                                                <path id="Path_57320" data-name="Path 57320" d="M18.549,57a8.32,8.32,0,0,1-7.087-12.679A8.32,8.32,0,1,0,22.907,55.771,8.28,8.28,0,0,1,18.549,57Z" transform="translate(-7.249 -42.841)" fill="#00c3ff"></path>
                                                                                <path id="Path_57321" data-name="Path 57321" d="M9.833,281.212l.232-2.11a.537.537,0,0,0-.161-.446l-1.432-1.339A8.271,8.271,0,0,0,9.833,281.212Z" transform="translate(-8.188 -268.032)" fill="#afd755"></path>
                                                                                <path id="Path_57322" data-name="Path 57322" d="M114.4,7.5l-.061,0-.453,1.922h-1.778a.268.268,0,0,0-.266.233l-.148,1.109-.824.043a.268.268,0,0,0-.254.257l-.029.716a.268.268,0,0,0,.29.278l.771-.064.637-.889,1.879-.067.405.614a.537.537,0,0,0,.591.221l.692-.192.17-.45a.537.537,0,0,1,.394-.336l.336-.069a.375.375,0,1,1,.118.739l-1.018.117-.011.347.822.419-.285.419h-2.516L111.653,12l-1.982,1.831a.537.537,0,0,0-.157.523l.366,1.487a.537.537,0,0,0,.492.408l2.028.109a.805.805,0,0,1,.759.73l.171,1.857.681,1.78a.78.78,0,0,0,1.254.3l1.811-1.649a.805.805,0,0,0,.255-.479l.193-1.325,1.309-1.443a.268.268,0,0,0-.157-.446l-.245-.038.043-.086,1.834-1.23-.425-.581.756-.091a.537.537,0,0,1,.536.278l.535.99.374.691a.537.537,0,0,0,.308.256l.327.128c0-.057,0-.114,0-.172A8.32,8.32,0,0,0,114.4,7.5Z" transform="translate(-105.833 -7.249)" fill="#bee86e"></path>
                                                                                <path id="Path_57323" data-name="Path 57323" d="M14.632,2.51A8.571,8.571,0,0,0,2.51,14.632,8.571,8.571,0,0,0,14.632,2.51Zm-13,8.532-.154,1.374A7.978,7.978,0,0,1,.612,9.909l.929.9A.288.288,0,0,1,1.627,11.042Zm12.649,3.234a8.069,8.069,0,0,1-11.411,0A8.158,8.158,0,0,1,1.9,13.114L2.126,11.1a.793.793,0,0,0-.236-.655L.521,9.123C.509,8.94.5,8.756.5,8.571A8.081,8.081,0,0,1,6.218.849l-.163.432a.251.251,0,1,0,.47.177L6.813.693A8.1,8.1,0,0,1,8.093.517L7.739,1.9l-.1.026H6.279a.521.521,0,0,0-.515.451l-.12.9-.615.032a.517.517,0,0,0-.492.5l-.029.716a.519.519,0,0,0,.562.538l.044,0L4.6,5.528a.251.251,0,0,0,.341.369l.929-.859,2.067.814a.251.251,0,0,0,.092.017H10.55a.251.251,0,0,0,.208-.11h0l.284-.418a.251.251,0,0,0-.094-.365l-.633-.323.755-.087a.626.626,0,1,0-.2-1.235l-.336.069a.784.784,0,0,0-.578.494l-.125.331-.569.158a.285.285,0,0,1-.315-.118l-.405-.614a.251.251,0,0,0-.218-.113l-1.879.067a.251.251,0,0,0-.2.1l-.57.795-.655.055a.016.016,0,0,1-.013,0,.016.016,0,0,1-.005-.013l.029-.716a.017.017,0,0,1,.016-.017l.824-.043a.251.251,0,0,0,.236-.218l.148-1.109a.017.017,0,0,1,.017-.015h1.4a.251.251,0,0,0,.066-.009l1.387-.38A.251.251,0,0,0,9.3,1.88l.179-.492a.251.251,0,0,0-.472-.172l-.135.37L8.3,1.744,8.615.5a8.068,8.068,0,0,1,8.022,7.873h0a.284.284,0,0,1-.164-.136L16.1,7.548a.251.251,0,1,0-.442.239l.374.691a.786.786,0,0,0,.456.376l.147.045A8.012,8.012,0,0,1,14.277,14.277Zm-6.343-9.2a.251.251,0,0,0,.247-.206c.018-.06.1-.283.21-.548l.142.214a.786.786,0,0,0,.868.325l.363-.1v.005A.251.251,0,0,0,9.9,5l.568.29-.05.074H8.082l-1.87-.737L6.59,4.1l1.369-.049a2.955,2.955,0,0,0-.276.775A.251.251,0,0,0,7.934,5.082ZM10.4,4.137l.025-.065a.284.284,0,0,1,.21-.179l.336-.069.026,0a.124.124,0,0,1,.013.246Z" transform="translate(0 0)" fill="none"></path>
                                                                                <path id="Path_57324" data-name="Path 57324" d="M357.835,346.756a.251.251,0,0,0-.354.031l-.7.839a.251.251,0,1,0,.385.323l.7-.839A.251.251,0,0,0,357.835,346.756Z" transform="translate(-344.775 -335.089)" fill="none"></path>
                                                                                <path id="Path_57325" data-name="Path 57325" d="M113.359,166.271l-1.224.145-.766-.685a.251.251,0,0,0-.375.045.257.257,0,0,0,.046.335l.843.755a.251.251,0,0,0,.2.062l.436-.05.184.252-1.6,1.072a.1.1,0,0,1-.141-.03l-1.049-1.664a.251.251,0,0,0-.353-.074.258.258,0,0,0-.067.351l1.137,1.806a.251.251,0,0,0,.174.114l.582.091a.017.017,0,0,1,.01.029l-1.309,1.443a.251.251,0,0,0-.063.132l-.193,1.325a.555.555,0,0,1-.175.33l-1.811,1.649a.529.529,0,0,1-.85-.2l-.668-1.748-.168-1.822a1.062,1.062,0,0,0-1-.958l-2.028-.109a.284.284,0,0,1-.262-.217l-.366-1.487a.286.286,0,0,1,.083-.278l.2-.181a.258.258,0,0,0,.027-.356.251.251,0,0,0-.36-.02l-.2.188a.788.788,0,0,0-.23.767l.366,1.487a.784.784,0,0,0,.723.6l2.028.109a.557.557,0,0,1,.522.5l.171,1.857a.253.253,0,0,0,.016.067l.681,1.78a1.031,1.031,0,0,0,1.657.394l1.811-1.649a1.059,1.059,0,0,0,.334-.629l.182-1.249,1.258-1.386a.519.519,0,0,0-.065-.758l1.489-1a.261.261,0,0,0,.076-.075.252.252,0,0,0-.008-.285l-.172-.235.33-.04a.284.284,0,0,1,.285.148.251.251,0,0,0,.368.084.256.256,0,0,0,.07-.332A.784.784,0,0,0,113.359,166.271Z" transform="translate(-98.582 -160.12)" fill="none"></path>
                                                                                <path id="Path_57326" data-name="Path 57326" d="M360.659,108.769a.251.251,0,1,0,.416-.281l-.559-.828a.251.251,0,1,0-.416.281Z" transform="translate(-348.002 -103.948)" fill="none"></path>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="paymentMethodItem" data-payment="2" >
                                                            <div class="paymentMethodItemContent">
                                                                <span>bKash</span>
                                                                <div class="imageContainer">
                                                                    <div>
                                                                        <svg style="display:inline-block;vertical-align:middle;" width="20px" height="20px" viewBox="0 0 56 56" x="0" y="0">
                                                                            <g data-name="Group 64" transform="translate(3291 1301)">
                                                                                <rect width="56" height="56" fill="#e3106e" data-name="Rectangle 90" rx="6" transform="translate(-3291 -1301)"></rect>
                                                                                <g fill="#fff" data-name="Group 39" transform="translate(-3282.108 -1290.146)">
                                                                                    <path d="M112.03 125.46l12.189-6.06-.41 1.429z" data-name="Path 28" transform="translate(-93.375 -99.517)"></path>
                                                                                    <g data-name="Group 6">
                                                                                        <path d="M1.23 0l17.227 2.246-4.086 14.3z" data-name="Path 24" transform="translate(-1.025)"></path>
                                                                                        <path d="M88.525 13.9l12.449 16.43-16.409-1.117a6.917 6.917 0 01.425-3.532z" data-name="Path 25" transform="translate(-70.481 -11.585)"></path>
                                                                                        <path d="M164.236 75.095l-4.766-6.675 8.035-1.36z" data-name="Path 26" transform="translate(-132.915 -55.893)"></path>
                                                                                        <path d="M204.581 67.06l3 3.2h-4.361z" data-name="Path 27" transform="translate(-169.38 -55.893)"></path>
                                                                                        <path d="M54.586 108.36l-5.106 17.158 7.762-6.13z" data-name="Path 29" transform="translate(-41.241 -90.316)"></path>
                                                                                        <path d="M6.877 23.5l-4.97-6.33L0 17.238z" data-name="Path 30" transform="translate(0 -14.311)"></path>
                                                                                        <path d="M84.81 108c.043.573.108.946.108.946l1.832 7.493 14.775-7.082-.137-.18z" data-name="Path 31" transform="translate(-70.687 -90.016)"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="oldBkashContainer">
                                                            <button class="linkButton">
                                                                <div><span>bKash (TrxID method)</span></div>
                                                            </button>
                                                        </div>
                                                        <form id="braintreeCheckout">
                                                            <div id="payment-container"></div>
                                                        </form>
                                                    </section>
                                                    <br>
                                                </div>
                                            </div>
										-->
                                        </div>
                                    </div>
                                </div>
                              
                             
                              
                                <div class="discount-section-container d-none">
                                    <div class="discount-savings-icon-container">
                                        <svg style="display:inline-block;vertical-align:middle;" width="67px" height="70px" viewBox="0 0 66.665 71.467">
                                            <g id="Group_46413" data-name="Group 46413" transform="translate(-14 -469.767)">
                                                <path id="Path_70930" data-name="Path 70930" d="M22-11.926c12.15,0,22,22.968,22,35.119a22,22,0,0,1-44,0C0,11.043,9.85-11.926,22-11.926Z" transform="translate(19.963 502.096) rotate(-30)" fill="#fff"></path>
                                                <g id="savings" transform="translate(-26.044 477)">
                                                    <path id="Path_70874" data-name="Path 70874" d="M396.016,104.482c-.185-.179-.555-2.684-.892-2.664s-.63,2.5-.788,2.669c-.316.328-2.625.56-2.606.879s2.287.468,2.607.778c.179.173.555,2.685.891,2.665s.625-2.5.788-2.667c.3-.317,2.632-.562,2.613-.881S396.324,104.782,396.016,104.482Z" transform="translate(-297.959 -90.681)" fill="#00afff"></path>
                                                    <path id="Path_70875" data-name="Path 70875" d="M61.465,412.062c-.185-.179-.555-2.684-.891-2.664s-.631,2.5-.788,2.669c-.315.328-2.625.56-2.606.879s2.287.468,2.607.778c.179.173.555,2.685.891,2.665s.625-2.5.788-2.667c.3-.317,2.633-.562,2.614-.882S61.774,412.362,61.465,412.062Z" transform="translate(0 -364.62)" fill="#00afff"></path>
                                                    <path id="Path_70876" data-name="Path 70876" d="M156.047,149.166q-7.7-.017-15.392-.034c-4.244.007-7.713,3.054-7.708,6.771q0,2.116,0,4.233.006,6.338.011,12.686,0,5.9.01,11.816a3.812,3.812,0,0,0,3.409,3.489,103.607,103.607,0,0,0,24-.006,3.8,3.8,0,0,0,3.415-3.468q-.006-5.877-.011-11.762-.006-6.328-.012-12.665,0-2.117,0-4.235C163.767,152.271,160.29,149.192,156.047,149.166Z" transform="translate(-67.481 -132.821)" fill="#a989e7" ></path>
                                                    <path id="Path_70877" data-name="Path 70877" d="M206.161,101.347c.006.467-.521.852-1.177.861l-15.578.213c-.656.009-1.194-.362-1.2-.829l-.06-4.367c-.006-.467.521-.852,1.177-.861l.949-.008.433.352.35-.363,1.785-.024.3.311.484-.322,1.783-.024.433.295.35-.305,1.785-.024.405.223.377-.234,1.785-.024.39.253.393-.264,1.784-.024.368.229.414-.241,1.012-.019c.656-.009,1.194.362,1.2.829Z" transform="translate(-116.643 -85.635)" fill="#00afff"></path>
                                                    <g id="Group_46398" data-name="Group 46398" transform="translate(71.766 19.605)">
                                                        <g id="Group_46396" data-name="Group 46396" transform="translate(13.414 2.641)">
                                                            <path id="Path_70878" data-name="Path 70878" d="M317.664,208.568a2.212,2.212,0,0,1-.165-.682c-.144-1.105-.083-3.238-1.69-3.2-1.195.03-1.19,1.962-1.213,2.773a4.488,4.488,0,0,1-.128,1.4c-.149.345-.7.33-1,.12-.329-.229-.3-.933-.288-1.273a7.953,7.953,0,0,1,.661-3.166,2.367,2.367,0,0,1,2.72-1.066,2.949,2.949,0,0,1,1.958,2.3c.1.428.728,3.028-.157,3.122A.617.617,0,0,1,317.664,208.568Z" transform="translate(-313.177 -203.39)" fill="#004587"></path>
                                                        </g>
                                                        <g id="Group_46397" data-name="Group 46397" transform="translate(0 3.268)">
                                                            <path id="Path_70879" data-name="Path 70879" d="M195.026,214.3a2.211,2.211,0,0,1-.164-.682c-.144-1.105-.083-3.238-1.69-3.2-1.2.031-1.19,1.963-1.212,2.774a4.491,4.491,0,0,1-.129,1.4c-.149.346-.7.331-1,.121-.328-.229-.3-.933-.287-1.273a7.935,7.935,0,0,1,.661-3.166,2.367,2.367,0,0,1,2.721-1.066,2.945,2.945,0,0,1,1.957,2.3c.1.428.728,3.028-.157,3.122A.618.618,0,0,1,195.026,214.3Z" transform="translate(-190.539 -209.118)" fill="#004587"></path>
                                                        </g>
                                                        <path id="Path_70880" data-name="Path 70880" d="M261.244,261.338l-.088,0c-.947-.052-1.634-.731-1.933-1.912a.429.429,0,0,1,.049-.345.361.361,0,0,1,.3-.164.373.373,0,0,1,.353.3c.12.475.439,1.273,1.224,1.279h.027a1.375,1.375,0,0,0,1.448-1.3A.374.374,0,0,1,263,258.8a.356.356,0,0,1,.27.129.436.436,0,0,1,.093.3,2.158,2.158,0,0,1-2.115,2.11Z" transform="translate(-251.697 -250.099)" fill="#004587"></path>
                                                        <path id="Path_70881" data-name="Path 70881" d="M213.08,269.738c.01.591-.685,1.081-1.552,1.1s-1.577-.454-1.587-1.044.685-1.082,1.552-1.1S213.071,269.147,213.08,269.738Z" transform="translate(-207.819 -258.91)" fill="#00eee4"></path>
                                                        <path id="Path_70882" data-name="Path 70882" d="M320.386,266.336c.01.591-.685,1.081-1.552,1.1s-1.577-.453-1.587-1.044.685-1.082,1.552-1.1S320.376,265.745,320.386,266.336Z" transform="translate(-303.388 -255.879)" fill="#00eee4"></path>
                                                        <path id="Path_70883" data-name="Path 70883" d="M201.326,184.2a2.794,2.794,0,0,0-2.878.181c-.44.3.06.958.5.659a1.963,1.963,0,0,1,2.052-.081C201.479,185.2,201.8,184.436,201.326,184.2Z" transform="translate(-197.431 -183.38)" fill="#004587"></path>
                                                        <path id="Path_70884" data-name="Path 70884" d="M326.118,179.558a2.793,2.793,0,0,0-2.878.182c-.44.3.06.958.5.659a1.963,1.963,0,0,1,2.053-.081C326.27,180.552,326.594,179.791,326.118,179.558Z" transform="translate(-308.574 -179.244)" fill="#004587"></path>
                                                    </g>
                                                    <rect id="Rectangle_5477" data-name="Rectangle 5477" width="0.782" height="6.057" transform="matrix(1, -0.013, 0.013, 1, 73.631, 10.723)" fill="#00eee4"></rect>
                                                    <rect id="Rectangle_5478" data-name="Rectangle 5478" width="0.783" height="6.057" transform="translate(76.197 10.687) rotate(-0.774)" fill="#00eee4"></rect>
                                                    <rect id="Rectangle_5479" data-name="Rectangle 5479" width="0.783" height="6.057" transform="translate(78.763 10.652) rotate(-0.785)" fill="#00eee4"></rect>
                                                    <rect id="Rectangle_5480" data-name="Rectangle 5480" width="0.782" height="6.057" transform="matrix(1, -0.013, 0.013, 1, 81.331, 10.618)" fill="#00eee4"></rect>
                                                    <rect id="Rectangle_5481" data-name="Rectangle 5481" width="0.782" height="6.057" transform="translate(83.897 10.581) rotate(-0.796)" fill="#00eee4"></rect>
                                                    <rect id="Rectangle_5482" data-name="Rectangle 5482" width="0.783" height="6.057" transform="translate(86.464 10.545) rotate(-0.785)" fill="#00eee4"></rect>
                                                    <path id="Path_70885" data-name="Path 70885" d="M148.6,170.1a4.142,4.142,0,0,0-2.815,1.865,6.4,6.4,0,0,0-.737,3.426.417.417,0,0,0,.833-.013,5.965,5.965,0,0,1,.537-2.841,3.3,3.3,0,0,1,2.416-1.637C149.363,170.8,149.125,170,148.6,170.1Z" transform="translate(-78.258 -151.49)" fill="#fff"></path>
                                                    <path id="Path_70886" data-name="Path 70886" d="M190.491,166.226a.417.417,0,0,0,.013.833A.417.417,0,0,0,190.491,166.226Z" transform="translate(-118.377 -148.045)" fill="#fff"></path>
                                                    <path id="Path_70887" data-name="Path 70887" d="M144.3,229.945a.417.417,0,0,0,.013.833A.417.417,0,0,0,144.3,229.945Z" transform="translate(-77.242 -204.795)" fill="#fff"></path>
                                                    <path id="Path_70888" data-name="Path 70888" d="M394.421,225.719c-.039-.579-.941-.567-.9.015.157,2.323.2,4.652.234,6.979a.452.452,0,0,0,.9-.015C394.618,230.37,394.579,228.042,394.421,225.719Z" transform="translate(-299.55 -200.649)" fill="#00eee4"></path>
                                                    <path id="Path_70889" data-name="Path 70889" d="M396.664,307.106a.452.452,0,0,0,.015.9A.452.452,0,0,0,396.664,307.106Z" transform="translate(-301.97 -273.516)" fill="#00eee4"></path>
                                                    <g id="Group_46400" data-name="Group 46400" transform="translate(84.011 40.273)" data-reactid=".1x65q2ckui8.b.2.0.0.0.0.2.0.3.0.0.0.1.g">
                                                        <path id="Path_70890" data-name="Path 70890" d="M312.667,376.447A5.929,5.929,0,0,1,304.9,379.6c-.2-.084-.454-.215-.638-.317,0,0-2.654-4.3-1.464-7.122.417-.987.017-2.132.812-2.738a5.93,5.93,0,0,1,9.059,7.022Z" transform="translate(-302.488 -368.209)" fill="#ffd548"></path>
                                                        <path id="Path_70891" data-name="Path 70891" d="M313.818,389.149a4.436,4.436,0,1,1-2.36-5.812A4.436,4.436,0,0,1,313.818,389.149Z" transform="translate(-304.988 -381.37)" fill="#ff6086"></path>
                                                        <g id="Group_46399" data-name="Group 46399" transform="translate(2.851 2.824)">
                                                            <path id="Path_70892" data-name="Path 70892" d="M332.215,395.973c-.021.215-.246.3-.434.329a1.092,1.092,0,0,1-.672-.188,1.256,1.256,0,0,0-.93-.171c-.112.038-.216.1-.229.229-.01.252.3.386.51.544a6.409,6.409,0,0,1,.979.708,1.756,1.756,0,0,1,.356.472,1.094,1.094,0,0,1-.059,1.029c-.252.346-.712.363-1.1.421-.026,0-.043.03-.052.083a2.645,2.645,0,0,1-.128.656.4.4,0,0,1-.657.082c-.154-.134-.084-.328-.061-.5,0-.015,0-.043.01-.084,0-.092.03-.253-.033-.322a2.578,2.578,0,0,1-1.052-.542.407.407,0,0,1,.066-.605.591.591,0,0,1,.6,0,2.447,2.447,0,0,0,1.048.359c.217.013.561-.157.358-.4a1.852,1.852,0,0,0-.526-.349,2.817,2.817,0,0,1-1.267-1.126,1.266,1.266,0,0,1,1.409-1.665c.071-.23.115-.472.206-.7a.361.361,0,0,1,.565-.116.187.187,0,0,1,.078.184c-.02.2-.1.453-.138.651a1.857,1.857,0,0,1,1.127.838A.4.4,0,0,1,332.215,395.973Z" transform="translate(-328.555 -394.033)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <g id="Group_46402" data-name="Group 46402" transform="translate(70.934 33.164)">
                                                        <path id="Path_70893" data-name="Path 70893" d="M193.526,308.617c.11,3.053-1.815,5.547-4.869,5.657a5.532,5.532,0,1,1,3.538-9.617A12.375,12.375,0,0,1,193.526,308.617Z" transform="translate(-182.926 -303.214)" fill="#ffd548"></path>
                                                        <path id="Path_70894" data-name="Path 70894" d="M204.592,320.786a4.138,4.138,0,1,1-4.285-3.986A4.138,4.138,0,0,1,204.592,320.786Z" transform="translate(-194.854 -315.312)" fill="#ff854a"></path>
                                                        <g id="Group_46401" data-name="Group 46401" transform="translate(3.709 2.694)">
                                                            <path id="Path_70895" data-name="Path 70895" d="M219.716,328.992c.066.19-.088.355-.237.449a1.021,1.021,0,0,1-.642.106,1.335,1.335,0,0,0-.71.121c-.265.121-.4.453-.031.559.467.129,1.059.125,1.536.3a1.629,1.629,0,0,1,.487.259,1.02,1.02,0,0,1,.355.893c-.077.392-.46.587-.768.791-.021.012-.025.042-.011.091.058.245.242.553.095.8-.128.209-.572.22-.654-.053a1.948,1.948,0,0,0-.189-.505c-.019-.029-.037-.043-.052-.043a2.4,2.4,0,0,1-1.1-.044.389.389,0,0,1,.054-.729c.423-.123.888.066,1.3-.152.189-.076.413-.354.143-.483a1.721,1.721,0,0,0-.582-.088,2.633,2.633,0,0,1-1.515-.453,1.181,1.181,0,0,1,.536-1.963c-.031-.223-.088-.444-.1-.671a.336.336,0,0,1,.431-.32.175.175,0,0,1,.139.124c.061.179.1.422.139.605a1.727,1.727,0,0,1,1.283.265.8.8,0,0,1,.06.067A.246.246,0,0,1,219.716,328.992Z" transform="translate(-216.834 -327.848)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <g id="Group_46404" data-name="Group 46404" transform="translate(66.443 39.644)">
                                                        <path id="Path_70896" data-name="Path 70896" d="M151.215,367.928a19.912,19.912,0,0,1-1.076,5.9,6.4,6.4,0,0,1-2.125.477,5.93,5.93,0,0,1-.428-11.851A6.338,6.338,0,0,1,152.1,364.3,9.956,9.956,0,0,0,151.215,367.928Z" transform="translate(-141.871 -362.455)" fill="#ffd548"></path>
                                                        <path id="Path_70897" data-name="Path 70897" d="M165.1,381.285a4.436,4.436,0,1,1-4.593-4.273A4.436,4.436,0,0,1,165.1,381.285Z" transform="translate(-154.657 -375.417)" fill="#ff6086"></path>
                                                        <g id="Group_46403" data-name="Group 46403" transform="translate(3.975 2.888)">
                                                            <path id="Path_70898" data-name="Path 70898" d="M181.305,390.082c.072.2-.095.38-.254.482-.4.249-.864.01-1.3.177a.694.694,0,0,0-.411.314c-.115.372.4.39.685.443a6.377,6.377,0,0,1,1.187.229,1.745,1.745,0,0,1,.522.278,1.1,1.1,0,0,1,.381.957c-.084.42-.493.629-.824.848-.023.013-.026.046-.012.1a2.62,2.62,0,0,1,.161.649.4.4,0,0,1-.561.352c-.2-.057-.214-.262-.267-.427a1.866,1.866,0,0,0-.075-.2c-.03-.054-.063-.144-.116-.156a2.578,2.578,0,0,1-1.184-.047.407.407,0,0,1-.2-.577.592.592,0,0,1,.542-.252,2.448,2.448,0,0,0,1.1-.116c.2-.08.444-.38.154-.517a1.845,1.845,0,0,0-.623-.095,2.82,2.82,0,0,1-1.624-.486,1.266,1.266,0,0,1,.575-2.1c-.033-.239-.1-.476-.108-.719a.361.361,0,0,1,.462-.343.187.187,0,0,1,.149.133c.066.192.1.452.149.649a1.856,1.856,0,0,1,1.375.284A.389.389,0,0,1,181.305,390.082Z" transform="translate(-178.216 -388.855)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <path id="Path_70899" data-name="Path 70899" d="M258.676,316.4a5.561,5.561,0,0,0,.79,7.506,5.56,5.56,0,0,0-.79-7.506Z" transform="translate(-178.473 -281.796)" fill="#004587"></path>
                                                    <path id="Path_70900" data-name="Path 70900" d="M205.2,383.2a5.907,5.907,0,0,0-1.628-3.869,5.56,5.56,0,0,0-1.959,9.532A5.93,5.93,0,0,0,205.2,383.2Z" transform="translate(-126.905 -337.84)" fill="#004587"></path>
                                                    <path id="Path_70901" data-name="Path 70901" d="M295.361,398.05a5.56,5.56,0,0,0-2.9-6.744,5.93,5.93,0,0,0,1.909,8.55A5.548,5.548,0,0,0,295.361,398.05Z" transform="translate(-208.589 -348.506)" fill="#004587"></path>
                                                    <g id="Group_46406" data-name="Group 46406" transform="translate(75.888)">
                                                        <path id="Path_70902" data-name="Path 70902" d="M237.47,4.624A4.624,4.624,0,1,1,232.846,0,4.624,4.624,0,0,1,237.47,4.624Z" transform="translate(-228.222)" fill="#ffd548"></path>
                                                        <path id="Path_70903" data-name="Path 70903" d="M246.309,14.834a3.459,3.459,0,1,1-3.459-3.459A3.459,3.459,0,0,1,246.309,14.834Z" transform="translate(-238.169 -10.131)" fill="#ff6086"></path>
                                                        <g id="Group_46405" data-name="Group 46405" transform="translate(3.121 2.233)">
                                                            <path id="Path_70904" data-name="Path 70904" d="M259.192,21.424a.224.224,0,0,1,0,.148c-.186.388-.622.287-.973.283a.808.808,0,0,0-.5.166.209.209,0,0,0,.081.386c.529.163,1.224.139,1.674.527a.852.852,0,0,1,.27.757c-.076.324-.4.477-.665.637-.018.01-.022.035-.013.075.041.206.185.469.054.673a.318.318,0,0,1-.567-.154c-.03-.1-.065-.316-.162-.375a2.006,2.006,0,0,1-.921-.07.325.325,0,0,1,.067-.608c.357-.09.74.082,1.088-.088.16-.057.356-.284.134-.4a1.428,1.428,0,0,0-.483-.091,2.2,2.2,0,0,1-1.252-.424.988.988,0,0,1,.507-1.623c-.019-.187-.061-.374-.064-.563a.282.282,0,0,1,.37-.255.147.147,0,0,1,.113.108c.046.151.068.355.1.51a1.447,1.447,0,0,1,1.064.26A.313.313,0,0,1,259.192,21.424Z" transform="translate(-256.753 -20.415)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <g id="Group_46408" data-name="Group 46408" transform="translate(74.232 40.757)">
                                                        <path id="Path_70905" data-name="Path 70905" d="M224.908,379.248a5.93,5.93,0,1,1-5.207-6.573A5.93,5.93,0,0,1,224.908,379.248Z" transform="translate(-213.087 -372.635)" fill="#ffd548"></path>
                                                        <path id="Path_70906" data-name="Path 70906" d="M236.147,392.237a4.436,4.436,0,1,1-3.9-4.917A4.436,4.436,0,0,1,236.147,392.237Z" transform="translate(-225.75 -385.687)" fill="#ff854a"></path>
                                                        <g id="Group_46407" data-name="Group 46407" transform="translate(4.09 2.807)">
                                                            <path id="Path_70907" data-name="Path 70907" d="M253.72,399.8c.039.212-.15.361-.324.437a1.094,1.094,0,0,1-.7.009,1.254,1.254,0,0,0-.94.1.287.287,0,0,0-.155.284c.061.245.393.288.642.38a6.339,6.339,0,0,1,1.139.405,1.737,1.737,0,0,1,.474.353,1.094,1.094,0,0,1,.232,1c-.145.4-.582.548-.941.714-.025.01-.034.041-.027.094a2.62,2.62,0,0,1,.062.666.4.4,0,0,1-.607.263c-.187-.086-.172-.291-.2-.463a1.92,1.92,0,0,0-.043-.211c-.021-.058-.041-.152-.092-.172a2.583,2.583,0,0,1-1.163-.225.407.407,0,0,1-.105-.6c.219-.269.582-.165.878-.117a1.357,1.357,0,0,0,.968-.074c.16-.085.251-.3.063-.413a1.848,1.848,0,0,0-.6-.187,2.823,2.823,0,0,1-1.532-.726,1.267,1.267,0,0,1,.886-1.993c0-.241-.022-.485,0-.727a.361.361,0,0,1,.509-.27.187.187,0,0,1,.127.154c.036.2.034.462.049.664a1.855,1.855,0,0,1,1.317.488A.391.391,0,0,1,253.72,399.8Z" transform="translate(-250.483 -398.301)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <path id="Path_70908" data-name="Path 70908" d="M273.438,204.894a.543.543,0,0,0,0,1.085A.543.543,0,0,0,273.438,204.894Z" transform="translate(-192.137 -182.483)" fill="#fff"></path>
                                                    <path id="Path_70909" data-name="Path 70909" d="M156.5,253.839a.543.543,0,0,0,0,1.085A.543.543,0,0,0,156.5,253.839Z" transform="translate(-87.99 -226.075)" fill="#fff"></path>
                                                    <path id="Path_70910" data-name="Path 70910" d="M391.962,356.785a.543.543,0,0,0,0,1.085A.543.543,0,0,0,391.962,356.785Z" transform="translate(-297.698 -317.761)" fill="#fff"></path>
                                                    <path id="Path_70911" data-name="Path 70911" d="M149.98,300.65c-.1-.1-.306-1.479-.492-1.469s-.347,1.381-.434,1.471c-.174.181-1.447.309-1.437.484s1.261.258,1.437.429c.1.1.306,1.48.492,1.469s.344-1.376.434-1.47c.169-.175,1.451-.309,1.441-.486S150.149,300.815,149.98,300.65Z" transform="translate(-80.546 -266.458)" fill="#fff"></path>
                                                    <path id="Path_70912" data-name="Path 70912" d="M293.019,433.261c-.07-.068-.212-1.023-.339-1.015s-.241.955-.3,1.017c-.12.125-1,.214-.993.335s.871.178.994.3c.068.066.212,1.023.339,1.016s.238-.952.3-1.016c.116-.121,1-.214,1-.336S293.136,433.375,293.019,433.261Z" transform="translate(-208.589 -384.968)" fill="#fff"></path>
                                                    <g id="Group_46409" data-name="Group 46409" transform="translate(68.511 53.049)">
                                                        <path id="Path_70913" data-name="Path 70913" d="M174.871,487.064c-.429-.084-.565.674-.129.76a43.437,43.437,0,0,0,8.609.637c.444-.005.447-.776.011-.77A42.832,42.832,0,0,1,174.871,487.064Z" transform="translate(-172.976 -486.834)" fill="#fff"></path>
                                                        <path id="Path_70914" data-name="Path 70914" d="M267.523,492.94a.343.343,0,1,0,.682-.031A.343.343,0,1,0,267.523,492.94Z" transform="translate(-255.847 -491.728)" fill="#fff"></path>
                                                        <path id="Path_70915" data-name="Path 70915" d="M160.783,485.309a.344.344,0,1,0,.668.153A.344.344,0,1,0,160.783,485.309Z" transform="translate(-160.773 -485.013)" fill="#fff"></path>
                                                    </g>
                                                    <path id="Path_70916" data-name="Path 70916" d="M151.56,388.067a4.534,4.534,0,0,0-.794,2.153c-.038.228.31.326.349.1a4.238,4.238,0,0,1,.7-1.994C151.958,388.141,151.7,387.884,151.56,388.067Z" transform="translate(-83.347 -345.565)" fill="#fff"></path>
                                                    <path id="Path_70917" data-name="Path 70917" d="M164.126,381.361a.184.184,0,0,0-.248-.065c-.093.049-.172.12-.265.169a.181.181,0,0,0,.183.313c.093-.049.171-.12.265-.169A.182.182,0,0,0,164.126,381.361Z" transform="translate(-94.713 -339.571)" fill="#fff"></path>
                                                    <path id="Path_70918" data-name="Path 70918" d="M225.2,444.543a4.093,4.093,0,0,1-1.14-1.864c-.093-.213-.4-.029-.312.182a4.3,4.3,0,0,0,1.27,1.994C225.215,444.986,225.4,444.673,225.2,444.543Z" transform="translate(-148.337 -394.176)" fill="#fff"></path>
                                                    <path id="Path_70919" data-name="Path 70919" d="M242.7,466.363c-.076-.049-.165-.072-.241-.12a.181.181,0,0,0-.182.312c.076.049.165.072.241.121a.181.181,0,0,0,.182-.312Z" transform="translate(-164.77 -415.224)" fill="#fff"></path>
                                                    <path id="Path_70920" data-name="Path 70920" d="M227.634,308.984a3.559,3.559,0,0,0-1.977-.193c-.229.041-.132.39.1.349a3.219,3.219,0,0,1,1.785.193C227.754,309.421,227.847,309.071,227.634,308.984Z" transform="translate(-149.933 -274.964)" fill="#fff"></path>
                                                    <path id="Path_70921" data-name="Path 70921" d="M253.266,315.413c-.111-.083-.22-.169-.338-.241-.2-.122-.381.191-.182.312.118.072.227.158.337.241a.181.181,0,0,0,.248-.065A.186.186,0,0,0,253.266,315.413Z" transform="translate(-174.099 -280.675)" fill="#fff"></path>
                                                    <g id="Group_46411" data-name="Group 46411" transform="translate(79.865 32.493)" data-reactid=".1x65q2ckui8.b.2.0.0.0.0.2.0.3.0.0.0.1.10">
                                                        <path id="Path_70922" data-name="Path 70922" d="M275.429,304.358a5.56,5.56,0,1,1-3.562-7.01A5.561,5.561,0,0,1,275.429,304.358Z" transform="translate(-264.58 -297.072)" fill="#ffd548"></path>
                                                        <path id="Path_70923" data-name="Path 70923" d="M285.828,316.354a4.16,4.16,0,1,1-2.665-5.244A4.159,4.159,0,0,1,285.828,316.354Z" transform="translate(-276.276 -309.391)" fill="#ff854a"></path>
                                                        <g id="Group_46410" data-name="Group 46410" transform="translate(3.92 2.623)">
                                                            <path id="Path_70924" data-name="Path 70924" d="M303.65,322.76c0,.2-.205.3-.38.342a1.023,1.023,0,0,1-.643-.122,1.342,1.342,0,0,0-.711-.131c-.292.022-.533.29-.222.517.4.283.956.484,1.347.814a1.63,1.63,0,0,1,.37.413,1.026,1.026,0,0,1,.026.966c-.209.343-.637.395-1,.481-.024,0-.038.032-.042.082-.03.251.037.605-.188.789-.192.153-.617.01-.6-.276a3.394,3.394,0,0,0,.014-.426c-.009-.058-.009-.148-.053-.175a2.411,2.411,0,0,1-1.027-.424.382.382,0,0,1,.014-.57.555.555,0,0,1,.559-.047,2.285,2.285,0,0,0,1.007.253c.2-.005.513-.191.3-.406a1.731,1.731,0,0,0-.518-.284,2.646,2.646,0,0,1-1.274-.952,1.188,1.188,0,0,1,1.185-1.667c.048-.221.07-.45.137-.668a.338.338,0,0,1,.518-.153.177.177,0,0,1,.088.166c0,.19-.054.431-.078.619a1.74,1.74,0,0,1,1.12.694c.013.03.024.058.033.084A.23.23,0,0,1,303.65,322.76Z" transform="translate(-300.424 -321.052)" fill="#ffd548"></path>
                                                        </g>
                                                    </g>
                                                    <path id="Path_70925" data-name="Path 70925" d="M345.181,299.216c-.1-.1-.306-1.479-.491-1.468s-.348,1.38-.434,1.471c-.174.181-1.447.309-1.437.484s1.261.258,1.437.429c.1.1.306,1.48.492,1.469s.344-1.376.434-1.47c.168-.175,1.451-.31,1.441-.486S345.351,299.381,345.181,299.216Z" transform="translate(-254.396 -265.181)" fill="#fff"></path>
                                                    <path id="Path_70926" data-name="Path 70926" d="M348.7,354.345a4.5,4.5,0,0,1-.93,2.162c-.15.177.1.433.256.256a4.836,4.836,0,0,0,1.023-2.322C349.091,354.213,348.743,354.115,348.7,354.345Z" transform="translate(-258.766 -315.471)" fill="#fff"></path>
                                                    <path id="Path_70927" data-name="Path 70927" d="M355.907,339.236c-.035-.195-.075-.388-.126-.579a.181.181,0,0,0-.349.1c.051.191.091.384.127.578C355.6,339.561,355.949,339.464,355.907,339.236Z" transform="translate(-265.624 -301.502)" fill="#fff"></path>
                                                    <path id="Path_70928" data-name="Path 70928" d="M284.957,8.7a3.852,3.852,0,0,0-1.6-1.217c-.219-.077-.369.253-.149.33a3.474,3.474,0,0,1,1.458,1.1C284.819,9.092,285.112,8.88,284.957,8.7Z" transform="translate(-201.21 -6.658)" fill="#fff"></path>
                                                    <path id="Path_70929" data-name="Path 70929" d="M269.77,5.82h-.711a.181.181,0,0,0,0,.362h.711A.181.181,0,0,0,269.77,5.82Z" transform="translate(-188.549 -5.183)" fill="#fff"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="discount-section"><span>Congratulations on saving <span>4</span></span></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="placeOrderFooter">
                    <div class="paymentMethodInstruction d-none">
                        <span>Payment options available on the next page</span>
                    </div>
                    <div class="confirmBtnContainer">
                        <p class="footNote d-none">
                            <span>
                                <span></span>
                                <span>0</span>
                                <span> </span>
                            </span>
                            <span>Delivery charge included</span>
                        </p>
                        
                        <button class="confirmBtn confirmOrder" type="submit">
                            <div>
                                <div class="placeOrderText">Proceed</div>
                                <div class="placeOrderPrice">
                                    <span> </span>
                                    <span class="totalAmount">{{ cartTotalAmount()['total'] ?? 0 }}</span>
                                </div>
                            </div>
                        </button>
                        <p class="termConditionText">
                            <span>By clicking/tapping proceed, I agree to Chaldal's 
                                <a href="/t/TermsOfUse" target="_blank">Terms of Services</a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </form>
        
        <!--<section class="discountCodeContainer expanded notEligible">-->
        <!--                    <div class="main-discount-container">-->
        <!--                        <div class="discountCodeHeader">-->
        <!--                            <button class="btnDiscount">-->
        <!--                                <span class="arrow-icon arrow-down">-->
        <!--                                    <i class="fas fa-circle-chevron-down"></i>-->
        <!--                                </span>-->
        <!--                                <span>Have a special code?</span>-->
        <!--                            </button>-->
        <!--                        </div>-->
        <!--                        <div class="discountCodeContent" >-->
        <!--                            <form method="POST" action="{{ route('front.cart.apply-coupon') }}" id="ajaxForm">-->
        <!--                                @csrf-->
        <!--                                <span class="inputNbtn">-->
        <!--                                    <input required maxlength="100" type="text" name="code" placeholder="Referral/Discount Code">-->
        <!--                                    <button class="discountSubmitBtn">-->
        <!--                                        <span>-->
                                                    
        <!--                                            <span >Go</span>-->
                                                    
        <!--                                        </span>-->
        <!--                                    </button>-->
        <!--                                    <button type="submit" class="discountCloseBtn">Close</button>-->
        <!--                                </span>-->
        <!--                            </form>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </section>-->
        
    </div>
</div>
</div>
</div>
</section>
</div>
    <!-- Modal -->

    @endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript">
  
  $(document).ready(function () {
  		$('.charge_radio').click(function(){
          getCharge();
        // alert('hi');
        });
    
        function getCharge(){getCharge

            var testval = $('input:radio:checked.charge_radio').map(function(){
                return Number($(this).data('shipping')); }).get().join(",");
            
            let sub_total = '{{cartTotalAmount()['total']}}';                     
            let total=Number(testval)+Number(sub_total);                     
            $('span.totalAmount').text(total.toFixed(2));
                         
        }
    
    $(document).on('submit', 'form#checkoutForm', function(e){
  	e.preventDefault();
    $('span.error').text('');
    let url = $(this).attr('action');
    let method = $(this).attr('method');  
    let data =$(this).serialize();    
    $.ajax({
      type:method,
      url:url,
      data:data,
      success: function(res)
      {
        if(res.status)
        {
           toastr.success(res.msg);
           if(res.url)
           {
              document.location.href = res.url;
           }
           else{
             // $('#optver').modal('show');
             window.location.reload();
           }
        }
        else{
          toastr.error(res.msg);
        }
      },
      error: function(response)
      {
        $.each(response.responseJSON.errors, function(name, error){
          $(document).find('[name='+name+']').closest('div').after('<span class="error text-danger">'+error+'</span>');
          toastr.error(error);
        });
      }
    });  
  
  });
    
  });   
  
  
  
  
</script>

<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
