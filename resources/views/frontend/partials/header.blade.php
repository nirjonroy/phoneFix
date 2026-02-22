
<header class="main-header">
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{route('front.home')}}"><img src="{{ asset(siteInfo()->logo) }}" style="width:auto; height: 55px" alt=""></a>
                    </div>
                </div>
                <div class="main-menu__main-menu-box">
                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list">
                        <li class="dropdown current megamenu">
                            <a href="{{route('front.home')}}">Home </a>

                        </li>
                        <li>
                            <a href="{{route('front.about-us')}}">About</a>
                        </li>
                        <!-- <li class="dropdown">
                            <a href="#">Pages</a>
                            <ul class="shadow-box">
                                <li><a href="team.html">Team</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="appointment.html">Appointment</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="404.html">404 Error</a></li>
                            </ul>
                        </li> -->
                        <li class="dropdown">
                            <a href="{{route('front.repair.all')}}">Services</a>
                            <ul class="shadow-box">
                                @foreach(categories() as $key => $item)
                                <li><a href="{{ route('front.services.category', ['category' => $item->slug]) }}">{{$item->name}}</a></li>
                                @endforeach
                                <!-- <li><a href="services-details.html">Service Detail</a></li> -->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{route('front.blog')}}">Blog</a>
                            <!-- <ul class="shadow-box">
                                <li><a href="blog-v-1.html">Blog V-1</a></li>
                                <li><a href="blog-v-2.html">Blog V-2</a></li>
                                <li><a href="blog-details.html">Blog Details V-1</a></li>
                                <li><a href="blog-details-2.html">Blog Details V-2</a></li>
                                <li><a href="blog-details-3.html">Blog Details V-3</a></li>
                            </ul> -->
                        </li>
                        <!-- <li class="dropdown">
                            <a href="#">Shop</a>
                            <ul class="shadow-box">
                                <li><a href="products.html">Products</a></li>
                                <li><a href="product-details.html">Product Details</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a href="{{route('front.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__search-cart-call-box">
                        <div class="main-menu__search-cart-box">
                            <div class="main-menu__search-box">
                                <a href="#" class="main-menu__search search-toggler ">
                                    <i class="fas fa-search" style="color:#cf1f1f"></i>
                                </a>
                            </div>
                            <!-- <div class="main-menu__cart-box">
                                <a href="cart.html" class="main-menu__cart fas fa-shopping-cart"></a>
                            </div> -->
                        </div>
                        @php
                            $headerPhone = siteInfo()->topbar_phone;
                            $headerTel = $headerPhone ? preg_replace('/[^0-9+]/', '', $headerPhone) : '';
                        @endphp
                        <div class="main-menu__call">
                            <div class="main-menu__call-icon">
                              <a href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}">  <i class="fas fa-phone" style="color:#ffffff;"></i> </a>
                            </div>
                            <div class="main-menu__call-content">
                                <p class="main-menu__call-sub-title">Call Anytime</p>
                                <h5 class="main-menu__call-number"><a href="{{ $headerTel ? 'tel:' . $headerTel : '#' }}">{{ $headerPhone }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
