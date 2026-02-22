<style>
   /* Styles for the slider container */
   .slider-container {
   width: 100%;
   overflow: hidden;
   position: relative;
   margin-left: 6%;
   
   }
   /* Styles for the big image */
   .slider-image {
    width: 88%;
    height: auto;
    display: block;
   }
   /* Styles for the mini image thumbnails */
   .thumbnail-container {
   /*display: flex;*/
   justify-content: center;
   /*margin-top : 3%;*/
   }
   .thumbnail {
   width: 50px;
   height: 50px;
   margin: 5px;
   cursor: pointer;
   }
   
   iframe{
       width: 100%;
   }
   
   @media only screen and (min-width: 320px) and (max-width: 375px) {
       iframe {
           width: 100% !important;
           height: 220px !important;
       }
   }
   
   @media only screen and (min-width: 376px) and (max-width: 425px) {
       iframe {
           width: 100% !important;
           height: 250px !important;
       }
   }
   
   @media only screen and (min-width: 426px) and (max-width: 500px) {
       iframe {
           width: 100% !important;
           height: 260px !important;
       }
   }
   
   .testslide-image {
       margin-left: 10px;
       margin-top: 10px;
   }
   
   .img-thumbnail:hover {
       box-shadow: 0px 0px 10px -4px green !important;
   }
   .img-thumbnail {
       box-shadow: 0px 0px 10px -4px gray !important;
   }
   .testslide-image img {
       box-shadow: 3px 4px 13px -3px gray !important;
   }
   .testslide-image img:hover {
       box-shadow: 0px 2px 13px -3px green !important;
   }
   
   .accordion-body .btn-info {
       background: #1F8C40 !important;
   } 
   
</style>
<div class="lightbox">
            <button class="close"></button>
            <div class="lightboxContent">
                <article class="productDetails">
                    <section class="left">
             
              <div class="slider-container">
               <!-- Big Image -->
              <div class="">
                <div class="testslide-image"> 
                 <a href="{{asset($product->thumb_image)}}" class="popup-link">
                  <img class="slider-image img-thumbnail" id="big-image" src="{{asset($product->thumb_image)}}" alt="Image 1">
                 </a>
               </div>
			   </div>
              @foreach($product->gallery as $key => $img_gals)
                <div class="">
                    <a href="{{ asset($img_gals->image) }}" class="popup-link">
                        <img src="{{ asset($img_gals->image) }}" alt="" class="img-fluid" style="display:none">
                   </a>
                </div>
              @endforeach
             
             
             
               <!-- Mini Image Thumbnails -->
               <div class="thumbnail-container">
                  <br/>
                  <img class="thumbnail img-thumbnail" src="{{asset($product->thumb_image)}}" alt="" class="img-fluid" onclick="changeImage('{{asset($product->thumb_image)}}')">
                  @forelse($product->gallery as $key => $img_gals)
                  <img class="thumbnail img-thumbnail" src="{{ asset($img_gals->image) }}" onclick="changeImage('{{ asset($img_gals->image) }}')">
                 
                 	
                  @empty
                  @endforelse
               </div>
            </div>
             
             
                       
                    </section>
                    <section class="right">
                        <div class="nameAndSubtext">
                            <h1>{{ $product->name }}</h1>
                            @if($product->qty > 0)
                            <span>{{ $product->weight }} Grm</span>
                            @else
                            <strong class="text-danger">Stock not available!</strong>
                            @endif
                            
                        </div>
                        <div class="quantityContainer">
                            <div class="discountedPriceSection">
                                @if(!empty($product->offer_price))
                                <div class="discountedPrice">
                                    <span>৳</span>
                                    <span>
                                        <span>{{ $product->offer_price }}</span>
                                    </span>
                                </div>
                                <div class="fullPrice">
                                    <span>MRP ৳ </span>
                                    <span>{{ $product->price }}</span>
                                </div>
                                @else
                                <div class="discountedPrice">
                                    <span></span>
                                    <span>
                                        <span>{{ $product->price }}</span>
                                    </span>
                                </div>
                                @endif
                                @if(calculateDiscountPercent($product) > 0)
                                <div class="discount">
                                    <a class="discount">
                                        <span>{{ calculateDiscountPercent($product) }}% OFF</span>
                                    </a>
                                </div>
                                @endif
                            </div>
                            @if($product->variantItems->count() > 0)
                            <div>
                                <strong>Choose Size</strong><br>
                                @foreach($product->variantItems as $key => $v)
                                <label for="v_{{$key}}">
                                    <input type="radio" value="{{ $v->id }}" name="variation" class="variation" id="v_{{$key}}"> {{ $v->name }}
                                </label>
                                @endforeach
                            </div>
                            @else
                            <input type="hidden" class="variation" name="variation" value="">
                            @endif
                            <input type="hidden" class="isVariation" value="{{ $product->variantItems->count() }}">
                            <section>
                                <div class="quantityEditor">
                                    <button class="removeButton outer">–</button>
                                    <div class="QuantityTextContainer">
                                        <div class="quantity"><span>1</span></div>
                                        <div class="inBag">in bag</div>
                                        <input type="hidden" name="qty" value="1">
                                    </div>
                                    <button class="addButton outer">+</button>
                                </div>
                              <p class="btn  add-to-cart-show" id="buyNowButton"  data-id="{{ $product->id }}" data-url="{{ route('front.cart.store') }}">Buy Now</p>   
                         		 
							
                        
                          </section>
                        </div>
                        <div class="actionButtons">
                            <button class="">
                                <svg version="1.1" x="0px" y="0px" viewBox="0 0 100 100">
                                    <path d="M50,86c-0.5,0-1-0.2-1.4-0.6L15.7,52.8c-1.4-1.3-2.5-2.8-3.5-4.4c-5.4-8.9-4-20.3,3.5-27.7C20,16.4,25.8,14,31.9,14 c4.1,0,8.2,1.1,11.7,3.2c1.6,0.9,3.1,2.1,4.5,3.5c0.7,0.7,1.3,1.4,1.9,2.1c0.6-0.7,1.2-1.4,1.9-2.1c1.4-1.3,2.9-2.5,4.5-3.5 c3.5-2.1,7.6-3.2,11.7-3.2c6.1,0,11.9,2.4,16.2,6.7c7.4,7.4,8.9,18.8,3.5,27.7c-1,1.6-2.1,3.1-3.5,4.4L51.4,85.4 C51,85.8,50.5,86,50,86z M31.9,18c-5.1,0-9.8,2-13.4,5.5c-6.1,6.1-7.3,15.5-2.9,22.8c0.8,1.3,1.8,2.6,2.9,3.7L50,81.2L81.5,50 c1.1-1.1,2.1-2.3,2.9-3.7c4.4-7.4,3.3-16.8-2.9-22.8C77.9,20,73.1,18,68.1,18c-3.4,0-6.8,0.9-9.7,2.6c-1.3,0.8-2.6,1.7-3.7,2.9 c-1.2,1.2-2.2,2.5-3,3.8c-0.4,0.6-1,1-1.7,1h0c-0.7,0-1.4-0.4-1.7-1c-0.8-1.4-1.8-2.7-3-3.8c-1.1-1.1-2.4-2.1-3.7-2.8  C38.7,18.9,35.3,18,31.9,18z" ></path>
                                </svg>
                                <span> </span><span>Favourite</span>
                            </button>
                            <button>
                                <svg version="1.1" x="0px" y="0px" viewBox="0 0 100 100">
                                    <g>
                                        <path d="M81,15.5c-4.719,0-6.938-1.268-9.508-2.736C68.815,11.234,65.78,9.5,59.999,9.5s-8.816,1.734-11.493,3.264 c-2.569,1.468-4.789,2.736-9.508,2.736s-6.938-1.268-9.507-2.736C26.814,11.234,23.78,9.5,18,9.5v4v32v4v41h4V49.889 c2.239,0.484,3.797,1.371,5.507,2.348c2.677,1.529,5.711,3.264,11.491,3.264c5.781,0,8.815-1.734,11.492-3.264 c2.57-1.469,4.789-2.736,9.509-2.736s6.938,1.268,9.509,2.736c2.171,1.24,4.577,2.615,8.492,3.09V55.5h4v-40H81z M71.492,48.764 C68.815,47.234,65.78,45.5,59.999,45.5s-8.816,1.734-11.493,3.264c-2.569,1.469-4.789,2.736-9.508,2.736s-6.938-1.268-9.507-2.736 c-1.979-1.131-4.156-2.371-7.491-2.942V13.889c2.239,0.485,3.797,1.371,5.507,2.348c2.677,1.53,5.711,3.264,11.491,3.264 c5.781,0,8.815-1.734,11.492-3.263c2.57-1.469,4.789-2.737,9.509-2.737s6.938,1.268,9.509,2.737c2.171,1.24,4.577,2.614,8.492,3.09 v31.968C75.199,50.879,73.445,49.88,71.492,48.764z"></path>
                                    </g>
                                </svg>
                                <span> </span><span>Incorrect Info?</span>
                            </button>
                        </div>
                        <div class="divider"></div>
                        
                        <div class="social-section">
                       <ul style="display: flex; list-style: none;">
                            <li>
                            
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('front.product.shop-single', $product->slug)}}&display=popup" target="_blank">
                                    <img src="{{ asset('frontend/images/others/Facebook.webp') }}" style="width:60%">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" target="_blank">
                                    <img src="{{ asset('frontend/images/others/Youtube.webp') }}" style="width:60%">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" target="_blank">
                                    <img src="{{ asset('frontend/images/others/twitter.webp') }}" style="width:60%">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" target="_blank">
                                    <img src="{{ asset('frontend/images/others/Instagram.webp') }}" style="width:60%">
                                </a>
                            </li>
                       </ul>
                    </div>
                    
                    
                        <div class="details">
                            @if(!empty($product->long_description))
                                {!! $product->long_description !!}
                            @else
                            <div align="center">
                                <strong class="text-danger text-center">
                                    No description found!
                                </strong>
                            </div>
                            @endif
                        </div>
                        <div class="productFooterButtons"><button>Back</button></div>
                    </section>
                </article>
            </div>
            <footer id="footer">
                        <section class="footer-banner d-none">
                            <div class="banner">
                               <div class="wrap">
                                  <div class="left-area">
                                     <ul class="mb-0">
                                        <li>
                                            <span class="icon">
                                                <img src="{{ asset('frontend/images/others/1-hour.webp') }}" >
                                            </span>
                                            <span class="text">
                                                <span>30 minute delivery</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="icon">
                                                <img src="{{ asset('frontend/images/others/cash-on-delivery.webp') }}" >
                                            </span>
                                            <span class="text">
                                                <span>Cash on delivery</span>
                                            </span>
                                        </li>
                                     </ul>
                                  </div>
                                  <div class="right-area">
                                     <ul class="mb-0">
                                        <li class="text">Pay with</li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/Amex.webp') }}" >
                                        </li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/mastercard.webp') }}" >
                                        </li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/VIsa.webp') }}" >
                                        </li>
                                        <li class="icon bkash">
                                            <img src="{{ asset('frontend/images/others/bkash.webp') }}" >
                                        </li>
                                        <li class="icon bkash">
                                            <img src="{{ asset('frontend/images/others/NagadLogo.webp') }}" >
                                        </li>
                                        <li class="icon cod">
                                            <img src="{{ asset('frontend/images/others/COD.webp') }}" >
                                        </li>
                                     </ul>
                                  </div>
                               </div>
                            </div>
                         </section>
                         <div class="footer-left pt-4">

                            <div class="footerBottom">
                                <div class="list-type customer-service">
                                    <p>
                                        <span>{{ $title->first_column }}</span></p>
                                    <ul>
                                         <li><a href="{{route('front.about-us')}}">About Us</a></li>
                                      	<li><a href="{{route('front.privacy_policy')}}">Privacy Policy</a></li>
                                      	<li><a href="{{route('front.faq')}}">FAQ</a></li>
                                      <li><a href="{{route('front.terms_condition')}}">Terms and Condition</a></li>
                                    </ul>
                                </div>
                                <div class="list-type customer-service">
                                    <p><span>{{ $title->second_column }}</span></p>
                                    <ul>
                                            <li><a href="{{route('front.blog')}}">Blog</a></li>
                                      		<li><a href="">Shop</a></li>
                                      		<li><a href="">Support</a></li>
                                      		<li><a href="">Best Deal</a></li>
                                    </ul>
                                </div>
                                <div class="list-type customer-service">
                                    <p><span>{{ $title->third_column }}</span></p>
                                    <ul>
                                       
                                            <li><a href="">Track Order</a></li>
                                      		<li><a href="">Delivery & Returns</a></li>
                                      		<li><a href="{{route('front.contact_us')}}">Contact Us</a></li>
                                      		<li><a href="{{url('flash-selling-product')}}">Flash Sale</a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-right">
                            <div class="app-download-section d-none">
                               <div class="wrap">
                                    <div class="google_play_store">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/images/others/google_play_store.webp') }}">
                                        </a>
                                    </div>
                                    <div class="app_store">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/images/others/app_store.webp') }}">
                                        </a>
                                    </div>
                               </div>
                            </div>
                            <div class="contact-section">
                               <div class="phone-number">
                                    <div class="wrap">
                                        <h2 class="footerLogo">
                                            <img class="chaldal_logo" style="background-image:url();background-repeat:no-repeat;" src="{{ asset(siteInfo()->logo) }}" alt="">
                                        </h2>
                                        <span class="phone-icon">
                                            <img src="{{ asset('frontend/images/others/phone_icon.webp') }}">
                                        </span>
                                        <span class="number" style="font-size:15px !important">
                                            <span>{{ siteInfo()->topbar_phone }}</span><br>
                                            <span class="email">{{ siteInfo()->contact_email }}</span><br>
                                            <span>{{ siteInfo()->address_1 }} {{ siteInfo()->address_2 }}</span>
                                        </span>
                                    </div>
                               </div>
                            </div>
                            <div class="social-section">
                               <ul>
                                 @foreach($social_links as $sl)  
                                 <li>
                                        <a href="{{$sl->link}}" target="_blank">
                                          <i class="{{$sl->icon}}" style="font-size:35px; padding: 5px"></i>
                                        </a>
                                   </li>
                                  @endforeach 
                               </ul>
                            </div>
                         </div>
                    </footer>
        </div>
        
        <script>
        //      $(document).ready(function() {
        //       $('.popup-link').magnificPopup({
        //           type: 'image', // Set the content type to 'image'
        //           gallery: {
        //               enabled: true // Enable gallery mode
        //           }
        //       });
        //   });
          
          let imageClick = false; 
           $(document).on('click', '.slider-container', function() {
      if (imageClick) {
      
      }
   });
    
    
   // JavaScript function to change the big image
    function changeImage(imageUrl) {
       
        document.getElementById('big-image').src = imageUrl;
    }
    
   
    function changeImage(newImageSrc) {
        // Get the "big-image" element by its ID
        var bigImage = document.getElementById("big-image");

        // Update the source of the big image with the new image source
        bigImage.src = newImageSrc;
    }
        </script>