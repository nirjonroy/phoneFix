<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @php
      $siteInfo = DB::table('informations')->first();
      @endphp
      <title>{{$title}}</title>
     
      <meta property="og:url" content="{{ url()->current() }}"/>
      <meta property="og:title" content="{{ $title }}"/>
      <meta property="og:image" content="{{ url(asset('landing_pages/' . $ln_pg->landing_bg)) }}"/>
      <meta property="og:description" content="{{ $ln_pg->top_heading_text }}"/>
     
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <!--<link rel="stylesheet" href="{{ asset('backend/landing_page/css/owl.css') }}">-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <!--<link rel="stylesheet" href="{{ asset('backend/landing_page/css/owl.theme.min.css') }}">-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <link rel="stylesheet" href="{{ asset('backend/landing_page/css/style.css') }}">
      <!--<link rel="stylesheet" href="{{ asset('backend/landing_page/css/media.css') }}">-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;700&display=swap" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <style>
         @media screen and (max-width: 500px)
         {
         .discount_price {
         text-align: center;
         }
         .regular_price {
         text-align: center;
         }
         }
      </style>
      <style>
         .video-box iframe {
         width: 100% !important;
         }
         .simple-translate-result {
             display: none !important;
         }
         .simple-translate-candidate {
             display: none !important;
         }
         .ord_section {
             padding-left: 0px;
         }
         .billing-fields .form-group label {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         .product-name-td {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         ul {
         list-style: none;
         padding-left: 0px;
         }
         ul li {
         padding-left: 20px; 
         line-height: 1.5; 
         padding: 14px;
        border-bottom: 1px solid green;
        font-size: 20px;
         }
         
        ul li p {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         
         ul li::before {
         content: ""; 
         display: inline-block; 
         width: 20px; 
         height: 20px; 
         background-image: url({{ asset('frontend/images/arrow.png') }}); 
         background-size: cover; 
         background-repeat: no-repeat;
         margin-right: 10px;
         ine-height: 1.5;
         } 
         .top-heading-title {
         font-family: 'Hind Siliguri', sans-serif !important;
         }
         .top_div {
         position: relative;
         height: 70px;
         background: red;
         margin-top: 20px;
         height: 500px;
         }
         .shape{
         position: absolute;
         width: 50px;
         height: 50px;
         background: red;
         transform: rotate(45deg);
         right: -7%;
         top: 15%;
         }
         .another_div {
         position: relative;
         height: 70px;
         margin-top: 20px;
         border: 1px solid black;
         border-left: none;
         }
         
         .left_side_details ul li {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         .right_side_details ul li {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         
         .left_product_details ul li {
             font-family: 'Hind Siliguri', sans-serif !important;
         }
         
         @media screen and (min-width: 992px) and (max-width: 1199px) {
         .price_section {
         padding-left: 0px !important;
         }
         .shape {
         position: absolute;
         width: 48px !important;
         height: 48px !important;
         background: red;
         transform: rotate(45deg);
         right: -9% !important;
         top: 15% !important;
         }
         .top_div h3 {
         font-size: 30px !important;
         }
         .another_div h3 {
         font-size: 30px !important;
         }
         }
         @media screen and (min-width: 768px) and (max-width: 991px) {
         .top-div .container .element-width .top-box-weight .top-heading-title{
         font-size: 44px;
         }
         .top-div .container .text-info-box .top-heading-title{
         font-size: 24px;
         line-height: 1.3em;
         }
         /*Price Section*/
         .price_section {
         padding-left: 0px !important;
         }
         .shape {
         right: -12% !important;
         width: 48px !important;
         height: 48px !important;
         }
         .top_div h3 {
         font-size: 35px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 35px !important;
         float: none !important;
         }
         }
         @media screen and (min-width: 576px) and (max-width: 767px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         .video-box iframe {
         height: 210px !important;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .ord {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .address_section {
         width: 100% !important;
         }
         .order-col {
         width: 100% !important;
         }
         /*Price Section*/
         .price_section {
         padding-left: 0px !important;
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         .shape {
         right: -13% !important;
         width: 50px !important;
         height: 50px !important;
         }
         .top_div {
         width: 42% !important;
         }
         .another_div {
         width: 42% !important;
         }
         .top_div h3 {
         font-size: 30px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 30px !important;
         float: none !important;
         }
         }
         @media screen and (min-width: 484px) and (max-width: 575px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         .video-box iframe {
         height: 210px !important;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         
         .order_btn img {
             height: 10px !important;
         }
         
         #review_section .review_slider img{
             height: 95px !important;
         }
         
         .top_section {
             width: 90% !important;
         }
         
         .bottom_section {
             width: 90% !important;
         }
         
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .ord {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .address_section {
         width: 100% !important;
         }
         .order-col {
         width: 100% !important;
         }
         /*Price Section*/
         .price_section {
         padding-left: 38px !important;
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         .shape {
         right: -13% !important;
         width: 50px !important;
         height: 50px !important;
         }
         .top_div {
         width: 45% !important;
         }
         .another_div {
         width: 45% !important;
         }
         .top_div h3 {
         font-size: 30px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 30px !important;
         float: none !important;
         }
         .container .ani-btn-box .inner-padding .btn {
         font-size: 10px !important;
         }
         }
         @media screen and (min-width: 424px) and (max-width: 483px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         
         .first_section {
             width: 60% !important;
         }
         .ord_section {
             margin-bottom: 10px;
         }
         
         .top-div {
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: cover !important;
        }
        
        #review_section .review_slider img{
             height: 95px !important;
         }
         
         .order_btn img {
             height: 10px !important;
         }
         
         .top_section {
             width: 90% !important;
         }
         
         .top_heading_text {
            font-size: 20px !important;
            padding: 15px !important;
            width: 100% !important;
         }
         
         .bottom_section {
             width: 90% !important;
         }
         
         .video-box iframe {
         height: 210px !important;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .ord {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .address_section {
         width: 100% !important;
         }
         .order-col {
         width: 100% !important;
         }
         /*Price Section*/
         .price_section {
         padding-left: 38px !important;
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         .shape {
         right: -13% !important;
         width: 35px !important;
         height: 35px !important;
         }
         .top_div {
         width: 45% !important;
         height: 50px !important;
         }
         .another_div label {
         font-size: 12px !important;
         }
         .top_div label {
         font-size: 12px !important;
         }
         
         .top-div {
            width: 100% !important;
            height: auto !important;
         }
         
         .first_section {
            width: 100% !important;
            text-align: center !important;
            margin: 0 auto;
        }
        
        .ord_section {
            margin-bottom: 10px;
        }
        
        .top-div .container .element-width .top-box-weight {
            width: 100% !important;
        }
        
        .price_top_section {
            width: 70% !important;
            margin: 0 auto;
            padding: 8px;
        }
         
         .another_div {
         width: 45% !important;
         height: 50px !important;
         }
         .top_div h3 {
         font-size: 25px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 26px !important;
         float: none !important;
         }
         .container .ani-btn-box .inner-padding .btn {
         font-size: 22px !important;
         }
         }
         @media screen and (min-width: 400px) and (max-width: 423px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         
         .top-div {
            width: 100% !important;
            height: auto !important;
         }
         
         .top-div {
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: cover !important;
        }
        
        #review_section .review_slider img{
             height: 95px !important;
         }
         
         .top_heading_text {
            font-size: 20px !important;
            padding: 15px !important;
            width: 100% !important;
         }
         
         .first_section {
             width: 60% !important;
         }
         .ord_section {
             margin-bottom: 10px;
         }
         
         .order_btn img {
             height: 10px !important;
         }
         
         .top_section {
             width: 90% !important;
         }
         
         .bottom_section {
             width: 90% !important;
         }
         
         .top-div .container .element-width .top-box-weight {
             width: 100% !important;
         }
         
         .video-box iframe {
         height: 210px !important;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .ord {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .address_section {
         width: 100% !important;
         }
         .order-col {
         width: 100% !important;
         }
         
        .first_section {
            width: 100% !important;
            text-align: center !important;
            margin: 0 auto;
        }
        
        .ord_section {
            margin-bottom: 10px;
        }
        
        .price_top_section {
            width: 70% !important;
            margin: 0 auto;
            padding: 8px;
        }
         
         /*Price Section*/
         .price_section {
         padding-left: 38px !important;
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         .shape {
         right: -13% !important;
         width: 35px !important;
         height: 35px !important;
         }
         .top_div {
         width: 45% !important;
         height: 50px !important;
         }
         .another_div label {
         font-size: 12px !important;
         margin-left: 12px !important;
         }
         .top_div label {
         font-size: 12px !important;
         margin-left: 12px !important;
         }
         .another_div {
         width: 45% !important;
         height: 50px !important;
         }
         .top_div h3 {
         font-size: 25px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 26px !important;
         float: none !important;
         }
         .container .ani-btn-box .inner-padding .btn {
         font-size: 10px !important;
         }
         }
         @media screen and (min-width: 375px) and (max-width: 399px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .first_section {
             width: 100% !important;
             text-align: center !important;
             margin: 0 auto;
         }
         .ord_section {
             margin-bottom: 10px;
         }
         
         #review_section .review_slider img{
             height: 95px !important;
         }
         
         .top-div {
            width: 100% !important;
            height: auto !important;
         }
         
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         .video-box iframe {
         height: 210px !important;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         
         .order_btn img {
             height: 10px !important;
         }
         
         .top_section {
             width: 90% !important;
         }
         
         .bottom_section {
             width: 90% !important;
         }
         
         .top-div .container .element-width .top-box-weight {
             width: 100% !important;
         }
         
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .ord {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .address_section {
         width: 100% !important;
         }
         .order-col {
         width: 100% !important;
         }
         /*Price Section*/
         .price_section {
         padding-left: 38px !important;
         
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         
        .top-div {
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: cover !important;
        }
         
         .top_section {
             font-size: 13px !important;
         }
         
         .bottom_section p {
             font-size: 16px !important;
         }
         
         .price_top_section {
             width: 60% !important;
             margin: 0 auto;
             padding: 10px !important;
             font-size: 19px !important;
         }
         
         .ord_section .btn{
             font-size: 20px !important;
         }
         
         .left_side_details {
             padding: 10px !important;
         }
         
         .right_side_details {
             padding: 10px !important;
         }
         
         .top_heading_text {
            font-size: 20px !important;
            padding: 15px !important;
            width: 100% !important;
         }
         
         .shape {
         right: -13% !important;
         width: 35px !important;
         height: 35px !important;
         }
         .top_div {
         width: 45% !important;
         height: 50px !important;
        
         }
         .another_div label {
         font-size: 8px !important;
         margin-left: 12px !important;
         }
         .top_div label {
         font-size: 8px !important;
         margin-left: 12px !important;
         }
         .another_div {
         width: 45% !important;
         height: 50px !important;
         }
         .top_div h3 {
         font-size: 25px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 26px !important;
         float: none !important;
         }
         /*Price Section*/
         .container .ani-btn-box .inner-padding .btn {
         font-size: 17px !important;
         }
         }
         @media screen and (min-width: 320px) and (max-width: 374px) {
         .top-div .container .element-width {
         padding: 26px 0px 0px 0px !important;
         margin-bottom: 10px !important;
         }
         .first_section {
            width: 100% !important;
            text-align: center !important;
            margin: 0 auto;
         }
         
         #review_section .review_slider img{
             height: 95px !important;
         }
         
         .price_top_section {
            width: 70% !important;
            margin: 0 auto;
            padding: 8px;
            font-size: 19px !important;
         }
         .ord_section {
             margin-bottom: 10px;
         }
         
         .top-div .container .element-width .top-box-weight {
             width: 100% !important;
         }
         
         .order_btn {
             font-size: 10px !important;
         }
         
         .order_btn img {
             height: 10px !important;
         }
         
         .top_section {
             width: 90% !important;
         }
         
         .bottom_section {
             width: 90% !important;
         }
         
         .top-div .container .element-width .top-box-weight .top-heading-title {
         font-size: 15px !important;
         line-height: 1.3em;
         }
         .top-div .container .text-info-box .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em;
         }
         .overview {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px;
         }
         .slide_top {
         padding-left: 0px !important;
         }
         .feature-list {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget .top-heading-title {
         font-size: 17px !important;
         line-height: 1.3em !important;
         }
         ul {
         padding-left: 0px !important;
         }
         .feature-list ul li {
         padding-left: 0px !important;
         }
         .down-div .container .element-widget-wrap {
         padding: 10px !important;
         }
         .ord {
         padding-left: 0px !important;
         }
         .ord {
         padding-left: 0px !important;
         line-height: 1.3em !important;
         }
         .price_section {
         padding-left: 25px !important;
         }
         .phone img {
         height: 25px !important;
         width: 25px !important;
         }
         .shape {
         right: -13% !important;
         width: 35px !important;
         height: 35px !important;
         }
         .top-div {
         width: 100% !important;
         height: auto !important;
         }
         
         .top_section {
             font-size: 13px !important;
         }
         
         .bottom_section p {
             font-size: 16px !important;
         }
         
         .left_side_details {
             padding: 10px !important;
         }
         
         .right_side_details {
             padding: 10px !important;
         }
         
         .top_heading_text {
            font-size: 20px !important;
            padding: 15px !important;
            width: 100% !important;
         }
         
         .another_div label {
         font-size: 8px !important;
         margin-left: 5px !important;
         }
         .top_div label {
         font-size: 8px !important;
         margin-left: 5px !important;
         }
         .another_div {
         width: 45% !important;
         height: 50px !important;
         }
         .top_div h3 {
         font-size: 25px !important;
         float: none !important;
         }
         .another_div h3 {
         font-size: 26px !important;
         float: none !important;
         }
         .address_section {
         width: 100% !important;
         }
         .container .ani-btn-box .inner-padding .btn {
            font-size: 21px;
    font-weight: 700;
    background-color: #F1A415;
    border-style: solid;
    border-width: 3px 3px 3px 3px;
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
    padding: 25px 15px 25px 15px;
    transition: 0.3s;
    text-decoration: none;
        }
    .container .ani-btn-box .inner-padding #order_btn2 {
        font-size: 19px;
        font-weight: 700;
        background-color: #F1A415;
        border-style: solid;
        border-width: 3px 3px 3px 3px;
        border-radius: 10px 10px 10px 10px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        padding: 20px 6px 20px 6px;
        transition: 0.3s;
        text-decoration: none;
    }
    
    .container .ani-btn-box .inner-padding #order_btn2 img{
        height: 20px !important;
    }
         
         .main-wrapper {
             background: #F3FFED;
         }
         
         .top-div {
            background-repeat: no-repeat;
            height: 500px;
            background-position: center;
            background-size: cover;
         }
         
         @media screen and (min-width: 992px) {
            .top-div {
                background-repeat: no-repeat !important;
                height: 600px !important;
                background-position: center !important;
                background-size: cover !important;
             } 
         }
         
      </style>
     
   </head>
   <body>
      <div class="main-wrapper">
         <div class="top-div" style=" background-image: url({{asset('landing_pages/'. $ln_pg->landing_bg)}}); height: 650px;">
            <div class="container">
               <div class="element-width" data-aos="fade-down" data-aos-duration="1000">
                  <div class="top-box-weight">
                     <h2 class="top-heading-title">
                        {{ $ln_pg->title1 }}
                        <img src="" />
                       
                     </h2>
                  </div>
               </div>
               <div class="text-info-box qa" data-aos="fade-up">
                   <div class="row first_section" style="width: 33%;">
                       <div class="col-md-5 ord_section">
                           <a id="order_btn" class="btn" style="background: orange;
                           font-size: 20px;color: #ffffff;padding: 8px 16px;font-family: 'Hind Siliguri', sans-serif !important;"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;{{ BanglaText('order') }}</a>
                       </div>
                        <div class="col-md-7 price_top_section" style="border: 2px solid #FFA500;
    text-align: center;
    padding-top: 8px;
    color: #ffffff;
    border-radius: 5px;
    font-size: 20px;
    font-family: 'Hind Siliguri', sans-serif !important;
    background: #FFA500">
                            <div class="offer_price" style="font-family: 'Hind Siliguri', sans-serif !important;">
                               {{ BanglaText('offer') }} {{ $ln_pg->new_price }} {{ BanglaText('tk') }}
                            </div>
                           
                       </div>
                   </div>
                  
               </div>
            </div>
            <div class="element-shape"></div>
         </div>
         <div class="down-div">
            <div class="container">
               <div class="row">
                  <div class="video-box" data-aos="zoom-in">
                     {!! $ln_pg->video_url !!}
                  </div>
                  <div class="ani-btn-box" style="margin-top: 45px;">
                     <div class="inner-padding" data-aos="fade-up">
                        <button id="order_btn" class="btn btn-danger" style="border: 3px solid #AD7419;font-family: 'Hind Siliguri', sans-serif !important;">
                       {{ BanglaText('do_order') }} <img width="" src="{{ asset('frontend/images/hand.png') }}" class="" alt="" >
                        </button>
                     </div>
                  </div>
               </div>
               <div class="elementor-widget-wrap elementor-element-populated">
                  <div class="element-widget overview  py-5" style="margin-top: 40px;color: black;">
                      <div class="top_section" style="background: #FD003A;
                        background: #FD003A;
    width: 75%;
    border-radius: 10px;
    color: #ffffff; 
    font-size: 32px;
    font-family: 'Hind Siliguri', sans-serif !important;
    margin: 0 auto;
    padding: 15px;">
                           <p style="margin-bottom:0px;font-family: 'Hind Siliguri', sans-serif !important;">{{ $ln_pg->call_text }}</p>
                      <a href="tel: {{ $ln_pg->phone }}" style="margin-bottom: 0px;text-decoration: none;color: #fff;">{{  $ln_pg->phone }}</a>
                      </div>
                      <div class="bottom_section" style="background: #ffffff;
    width: 75%;
    margin: 32px auto;
    padding: 15px;
    border-radius: 10px;
    color: green;">
                         <p style="border-bottom: 2px dashed green;
                         font-family: 'Hind Siliguri', sans-serif !important;
    padding: 10px;
    font-size: 27px;"><del>{!! $ln_pg->regular_price_text !!}</del></p>
                        <p style="font-size: 27px;font-family: 'Hind Siliguri', sans-serif !important;">{!! $ln_pg->offer_price_text !!}</p>
                      </div>
                      
                      
                     <!--<h2 class="top-heading-title" style="color: white;">-->
                     <!--   {!! $ln_pg->des1 !!}-->
                     <!--</h2>-->
                  </div>
               </div>
               <div class="element-widget-cover">
                 
               <div class="element-widget feature-list" style="background: #ffffff;text-align: left;">
                    <div class="row">
                        <div class="col-md-6 left_sidebar_section">
                            <div class="left_side_text" style="border: 9px solid green;
    text-align: center;
    padding: 10px;
    border-radius: 10px;
    font-size: 25px;
    font-family: 'Hind Siliguri', sans-serif !important;
    font-weight: 600;">
                                {{ $ln_pg->left_side_title }}
                            </div>
                            <div class="left_side_details">
                                {!! $ln_pg->left_side_desc !!}
                            </div>
                        </div> 
                        <div class="col-md-6 left_sidebar_section">
                            <div class="right_side_text" style="border: 9px solid green;
    text-align: center;
    padding: 10px;
    border-radius: 10px;
    font-family: 'Hind Siliguri', sans-serif !important;
    font-size: 25px;
    font-weight: 600;">
                                {{ $ln_pg->right_side_title }}
                            </div>
                            <div class="right_side_details">
                                {!! $ln_pg->right_side_desc !!}
                            </div>
                        </div> 
                    </div>  
                </div>
              
               </div>
               <div class="element-widget-cover">
                  <div class="element-widget-wrap">
                     <div class="element-widget slide_top">
                        <h2 class="top-heading-title">
                           {{ $ln_pg->feature }}
                        </h2>
                     </div>
                     <div class="owl-carousel img-gallery">
                        @foreach($ln_pg->images as $slider)
                        <div class="">
                           <img src="{{ asset('landing_sliders/'.$slider->image) }}" alt="img">
                        </div>
                        @endforeach
                     </div>
                     <div class="ani-btn-box">
                        <div class="inner-padding" data-aos="fade-up">
                           <button id="order_btn" class="btn btn-danger" style="border: 3px solid #AD7419;font-family: 'Hind Siliguri', sans-serif !important;">
                       {{ BanglaText('do_order') }}  <img width="" src="{{ asset('frontend/images/hand.png') }}" class="" alt="" >
                        </button>
                        </div>
                     </div>
                  </div>
               </div>
               
               {{-- 
               <div class="element-widget p-widget">
                  <h2 class="top-heading-title text-vaiolat">
                     {{ $ln_pg->head1 }}
                  </h2>
                  <h2 class="top-heading-title text-light" style="text-align: left;padding-left: 58px;">
                     {!! $ln_pg->des2 !!}
                  </h2>
                  <br>
                  <div class="ani-btn-box">
                     <div class="inner-padding" data-aos="fade-up">
                         <button id="order_btn" class="btn btn-danger" style="border: 3px solid #AD7419;font-family: 'Hind Siliguri', sans-serif !important;">
                       {{ BanglaText('do_order') }} <img width="" src="{{ asset('frontend/images/hand.png') }}" class="" alt="" >
                        </button>
                     </div>
                  </div>
               </div>
               --}}
               
               <style>
                   .top_heading_text {
                       border: 7px solid green;
                        border-radius: 10px;
                        font-size: 29px;
                        text-align: center;
                        width: 70%;
                        margin: 0 auto;
                        font-family: 'Hind Siliguri', sans-serif !important;
                   }
               </style>
               
               <div class="element-widget-cover">
                  <div class="element-widget-wrap">
                     <div class="element-widget feature-list" style="background: #ffffff;text-align: left;padding-left: 0px;">
                        <h2 class="top-heading-title" style="color: #000000;">
                          <div class="top_heading_text">
                              {{ $ln_pg->top_heading_text }}
                          </div>
                          <div class="row" style="margin-top: 50px;">
                              <div class="col-md-6 left_product_details">
                                  {!! $ln_pg->left_product_details !!}
                              </div>
                              <div class="col-md-6">
                                  <img src="{{ asset('landing_pages/'.$ln_pg->right_product_image) }}" style="width: 100%;" alt="img">
                              </div>
                          </div>
                        </h2>
                     </div>
                     
                     
                     <!--<div class="element-widget price_section" style="background: #ffffff;text-align: left;padding-left: 58px;">-->
                     <!--   <div class="row text-center">-->
                     <!--      <div class="col-md-4 top_div offset-md-2 offset-sm-1">-->
                     <!--         <label style="font-size: 17px;float: left;color: white;margin-left: 25px;">Regular Price:</label> -->
                     <!--         <h3 style="float: left;margin-top: 5%;font-weight: 700;font-size: 40px;color: white;"><del>{{ $ln_pg->old_price }}</del>Tk</h3>-->
                     <!--         <div class="shape">-->
                     <!--         </div>-->
                     <!--      </div>-->
                     <!--      <div class="col-md-4 another_div">-->
                     <!--         <label style="font-size: 17px;float: left;color: green;margin-left: 25px;">Discount Price:</label> -->
                     <!--         <h3 style="float: left;margin-top: 5%;font-weight: 700;font-size: 40px;color: green;">{{ $ln_pg->new_price }}Tk</h3>-->
                     <!--      </div>-->
                     <!--      <div class="col-md-12 text-center phone">-->
                     <!--         <h2 class="top-heading-title" style="color: #000000;">-->
                     <!--            <label>Call Us:</label> <img width="40" class="phone_img" height="40" src="https://img.icons8.com/ios/50/000000/phone-disconnected.png" alt="phone-disconnected"/>-->
                     <!--            <a href="tel: {{ $ln_pg->phone }}" style="text-decoration: none;color: green;">{{ $ln_pg->phone }}</a>-->
                     <!--         </h2>-->
                     <!--      </div>-->
                     <!--   </div>-->
                     <!--</div>-->
                  </div>
               </div>
               <div class="">
                  <div class="">
                     <div class="element-widget slide_top">
                        <h2 class="top-heading-title">
                           {{ $ln_pg->feature }}
                        </h2>
                     </div>
                     <div class="owl-carousel img-gallery2">
                        <div id="review_section" class="row">
                            @foreach($ln_pg->review_images as $review_slider)
                            <div class="col-md-6 col-6 review_slider">
                                <img src="{{ asset('review_landing_sliders/'.$review_slider->review_image) }}" style="margin-bottom: 25px;height: 235px;" alt="img">
                            </div>
                            @endforeach
                        </div> 
                        
                     </div>
                     <div class="ani-btn-box">
                        <div class="inner-padding" data-aos="fade-up">
                           <button id="order_btn" class="btn btn-danger" style="border: 3px solid #AD7419;font-family: 'Hind Siliguri', sans-serif !important;">
                       {{ BanglaText('do_order') }} <img width="" src="{{ asset('frontend/images/hand.png') }}" class="" alt="" >
                        </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="element_widget" class="element-widget-cover">
                  <div class="element-widget-wrap">
                     <div class="element-widget ord" style="margin-bottom: 25px;">
                        <h2 class="top-heading-title bg-light-green">
                           {{ BanglaText('land_instruction') }}
                        </h2>
                     </div>
                     <div class="form-wrapper">
                        <form action="{{ route('front.storelandData') }}" method="POST" id="checkout_land_form">
                           <div class="row">
                              <div class="address_section col-md-6" style="width: 50%;float: left;">
                                 <div class="form-address">
                                    <div class="address-col">
                                       <h3 style="font-family: 'Hind Siliguri', sans-serif !important;">Billing Address</h3>
                                       <div class="billing-fields">
                                          <div class="form-group">
                                             <label for="">
                                                {{ BanglaText('name') }}
                                             <span>*</span></label>
                                             <input type="text" name="shipping_name" class="form-control">
                                             <input type="hidden" value="{{ $ln_pg->product->id }}" name="product_id" class="form-control">
                                          </div>
                                          <div class="form-group">
                                             <label for="">
                                                 {{ BanglaText('mobile') }}
                                                 <span>*</span></label>
                                             <input type="text" name="shipping_phone" class="form-control">
                                          </div>
                                      
                                          <div class="form-group">
                                                    <label for="exampleInputPassword1" style="float: left;">
                                                      {{ BanglaText('delivery_zone') }}
                                                        </label>
                                                    <select required name="shipping_method" style="min-height: 30px !important;" onchange="getCharge()" id="delivery_charge_id" class="form-control" style="font-size:12px !important;">
                                            
                                                      @foreach($shippings as $key=>$charge)
                                                            <option value="{{ $charge->id}}" id="charge" data-charge="{{ $charge->shipping_fee}}">{{ $charge->shipping_rule}} - {{ $charge->shipping_fee }}</option>
                                                      @endforeach
                                                    </select>
                                                    </div>

                                          <input type="hidden" id="variation_id" name="variation_id" value="{{ $ln_pg->product->id }}">
                                          <input type="hidden" id="total_price_val" name="total_amount" value="">
                                          <input type="hidden" id="shipping_cost" name="shipping_cost">
                                          @if($ln_pg->product->type != 'variable')       
                                          @if($ln_pg->product->offer_price != 0)
                                          <!--<input type="text" id="price_val" value="0">-->
                                          <input type="hidden" id="product_price" name="price" value="{{ $ln_pg->product->offer_price }}">
                                          @else
                                          <!--<input type="text" id="price_val" value="0">-->
                                          <input type="hidden" id="product_price" name="price" value="{{ $ln_pg->product->price }}">
                                         
                                          @endif
                                          @else
                                          <input type="text" id="price_val" name="price">
                                          <input type="text" id="size" name="variation_color_id">
                                          <input type="text" id="color" name="variation">
                                          @endif
                                          <input type="hidden" id="product_quantity" name="product_qty">
                                          <input type="hidden" id="product_name" value="{{ $ln_pg->product->name }}" name="product_name">
                                          <div class="form-group">
                                             <label for="">
                                                  {{ BanglaText('address') }}
                                                 <span>*</span></label>
                                             <input type="text" name="shipping_address" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <style>
                                 .sizes{
                                 display: flex;
                                 }
                                 .sizes .size {
                                 padding: 3px;
                                 margin: 5px;
                                 border: 1px solid #c2050b;
                                 width: auto;
                                 text-align: center;
                                 cursor: pointer;
                                 }
                                 .sizes .size.active{
                                 background: #c2050b;
                                 color: white;
                                 }
                                 
                                 .colors{
                                 display: flex;
                                 }
                                 .colors .color {
                                 padding: 3px;
                                 margin: 5px;
                                 border: 1px solid #c2050b;
                                 width: auto;
                                 text-align: center;
                                 cursor: pointer;
                                 }
                                 .colors .color.active{
                                 background: #c2050b;
                                 color: white;
                                 }
                                 
                                 .increase-qty {
                                 width: 32px;
                                 display: block;
                                 float: left;
                                 line-height: 26px;
                                 cursor: pointer;
                                 text-align: center;
                                 font-size: 16px;
                                 font-weight: 300;
                                 color: #000;
                                 height: 32px;
                                 background: #f6f7fb;
                                 border-radius: 50%;
                                 transition: .3s;
                                 border: 2px solid rgba(0,0,0,0);
                                 background: #ffffff;
                                 border: 1px solid #ddd;
                                 border-radius: 10%;
                                 }
                                 .decrease-qty {
                                 width: 32px;
                                 display: block;
                                 float: left;
                                 line-height: 26px;
                                 cursor: pointer;
                                 text-align: center;
                                 font-size: 16px;
                                 font-weight: 300;
                                 color: #000;
                                 height: 32px;
                                 background: #f6f7fb;
                                 border-radius: 50%;
                                 transition: .3s;
                                 border: 2px solid rgba(0,0,0,0);
                                 background: #ffffff;
                                 border: 1px solid #ddd;
                                 border-radius: 10%;
                                 }
                                 .product-name {
                                     font-family: 'Hind Siliguri', sans-serif !important;
                                 }
                                 .product-total {
                                     font-family: 'Hind Siliguri', sans-serif !important;
                                 }
                              </style>
                              <div class="col-md-6">
                                 <div class="order-col" style="width: 100%;">
                                    <h3 style="font-family: 'Hind Siliguri', sans-serif !important;">Your Order</h3>
                                    <div id="order_review" class="review-order">
                                       <table class="shop_table review-order-table">
                                          <thead>
                                             <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Subtotal</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr class="cart_item">
                                                <td class="product-name">
                                                   <div class="product-image">
                                                      <div class="product-thumbnail"><img width="100%" src="{{ asset($ln_pg->product->thumb_image) }}" class="" alt="" > </div>
                                                      <div class="product-name-td">{{ $ln_pg->product->name }}</div>
                                                   </div>
                                                </td>
                                                <td class="product-total">
                                                   <span id="price" class="price-amount amount">
                                                
                                                   @if($ln_pg->product->offer_price != 0)
                                                   {{ $ln_pg->product->offer_price }}
                                                   @else
                                                   {{ $ln_pg->product->price }}
                                                   @endif
                                                   <span class="price-currencySymbol">&nbsp;</span></span>
                                                   @if($ln_pg->product->offer_price != 0)
                                                   <!--<input type="hidden" id="price_val" value="{{ $ln_pg->product->offer_price }}">-->
                                                   @else
                                                   <!--<input type="hidden" id="price_val" value="{{ $ln_pg->product->sell_price }}">-->
                                                   @endif
                                               
                                                </td>
                                             </tr>
                                             <tr>
                                             </tr>
                                                 
                                             <tr>
                                                <td>
                                                   <span style="font-family: 'Hind Siliguri', sans-serif !important;">Select Quantity: </span>
                                                </td>
                                                <td style="width: 45%;">
                                                   <div style="display: flex;" class="pro-qty item-quantity">
                                                      <span class="decrease-qty quantity-button">-</span>
                                                      <input type="text" style="width: 25%;text-align: center;" class="inner_qty qty-input quantity-input" value="1" name="product_qty" />
                                                      <span class="increase-qty quantity-button">+</span>
                                                   </div>
                                                   <!--    <div class="sizes" id="sizes">-->
                                                   <!--    <div class="pro-qty item-quantity">-->
                                                   <!--    <span class="dec qtybtn">-</span>-->
                                                   <!--    <input type="number" class="quantity-input" value="1" name="quantity">-->
                                                   <!--    <span class="inc qtybtn">+</span>-->
                                                   <!--</div>-->
                                                   <!--</div>-->
                                                </td>
                                             </tr>
                                          </tbody>
                                          <tfoot>
                                             <tr class="cart-subtotal">
                                                <th style="font-family: 'Hind Siliguri', sans-serif !important;">Subtotal</th>
                                                <td><span class="final-price-amount amount">
                                                   @if($ln_pg->product->offer_price != 0)
                                                   {{ $ln_pg->product->offer_price }}
                                                   @else
                                                   {{ $ln_pg->product->price }}
                                                   @endif
                                                   <span class="price-currencySymbol">&nbsp;</span></span>
                                                </td>
                                             </tr>
                                             <tr class="shipping-totals shipping">
                                                <th style="font-family: 'Hind Siliguri', sans-serif !important;">Shipping</th>
                                                <td>
                                                   <li style="list-style: none;">
                                                      <span id="delvry_charge">0</span>
                                                   </li>
                                                </td>
                                             </tr>
                                             <tr class="order-total">
                                                <th style="font-family: 'Hind Siliguri', sans-serif !important;">Total</th>
                                                <td><strong><span id="total" class="Price-amount amount">
                                                   @if($ln_pg->product->offer_price != 0)
                                                   {{ $ln_pg->product->offer_price }}
                                                   @else
                                                   {{ $ln_pg->product->price }}
                                                   @endif
                                                   <span class="Price-currencySymbol">&nbsp;</span></span></strong> 
                                                </td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                       <div id="payment" class="checkout-payment">
                                          <ul class="payment_methods payment_methods methods">
                                             <li class="payment_method payment_method_cod">
                                                <label for="payment_method_cod" style="font-family: 'Hind Siliguri', sans-serif !important;">
                                                Cash on delivery 	</label>
                                                <div class="payment_box payment_method_cod">
                                                   <p style="font-family: 'Hind Siliguri', sans-serif !important;">Pay with cash on delivery.</p>
                                                </div>
                                             </li>
                                          </ul>
                                          <p style="color: green;font-family: 'Hind Siliguri', sans-serif !important;">
                                             {{ BanglaText('order_ensure') }}
                                          </p>
                                          <div class="form-row place-order">
                                             <button type="submit" style="font-family: 'Hind Siliguri', sans-serif !important;" class="button" name="" id="">
                                                 {{ BanglaText('order') }}
                                                 </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--<a href="https://wa.me/01303064267" target="_blank" class="whats_btn">-->
         <!--    <span>-->
         <!--<img width="45" height="45" src="https://img.icons8.com/windows/45/whatsapp--v1.png" alt="whatsapp--v1"/>-->
         <!--    </span>-->
         <!--</a>-->
         <div class="footer">
            <div class="copyright">
               <small> 2023 softitglobal.com | Developed By Softitglobal.</small>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <!--<link rel="stylesheet" href="{{ asset('backend/landing_page/js/carousel.min.js') }}">-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <!--<link rel="stylesheet" href="{{ asset('backend/landing_page/js/main.js') }}">-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
   </body>
</html>
<script>
   $(document).ready(function(){
       getCharge(); 
       
    $(".img-gallery").owlCarousel({
   		loop: true,
   		autoplay: true,
   		dots: false,
   		margin: 10,
   		nav: false,
   		responsive: {
   			0	: {
   				items: 1,
   			},
   			700: {
   				items: 3,
   			},
   			1200: {
   				items: 3,
   			},
   		},
   	});   
       
   	$(".img-gallery2").owlCarousel({
   		loop: true,
   		autoplay: true,
   		dots: false,
   		margin: 10,
   		nav: false,
   		responsive: {
   			0	: {
   				items: 1,
   			},
   			700: {
   				items: 1,
   			},
   			1200: {
   				items: 1,
   			},
   		},
   	});
     });
   
       function getCharge(){        
   
               let delivery_charge= $('#delivery_charge_id').find("option:selected");
               var crg_id = delivery_charge.val();               
               var testval = delivery_charge.data('charge');
               
               $('span#delvry_charge').text(testval);
            //   $('span#charge').text(Number(testval).toFixed(2));
               $('#shipping_cost').val(Number(testval).toFixed(2));
               var price = $('span.final-price-amount').text();
               let total=Number(testval)+Number(price);
               $('#total').text(total);
               $('#total_price_val').val(total);
           }
           
           $("button#order_btn").click(function() {
                   $('html,body').animate({
                       scrollTop: $("#element_widget").offset().top},
                       'slow');
               });
               
               $("a#order_btn").click(function() {
                   $('html,body').animate({
                       scrollTop: $("#element_widget").offset().top},
                       'slow');
               });
           
   
       $(document).on('submit','form#checkout_land_form', function(e) {
          
       e.preventDefault(); 
       $('span.textdanger').text('');
   
       let ele=$('form#checkout_land_form');
        
       var url=ele.attr('action');
       var method=ele.attr('method');
       var formData = ele.serialize();
       
       $.ajaxSetup({
   	    headers: {
   	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   	    }
   	});
   
       $.ajax({
           type: method,
           url: url,
           data: formData,
           success: function(res) {
               if(res.success==true){
                   toastr.success(res.msg);
                   if(res.url){                    
                       document.location.href = res.url;
                   }else{
                       window.location.reload();
                   }
                   
               }else if(res.success==false){
                   toastr.error(res.msg);
               }
               
           },
           error:function (response){
               $.each(response.responseJSON.errors,function(field_name,error){
                   $(document).find('[name='+field_name+']').after('<span class="textdanger" style="color:red">' +error+ '</span>');
               })
           }
       });
   });
   
   AOS.init({
   	duration: 1200,
   });
   
</script>
<script type="text/javascript">
   
   $('#colors .color').on('click', function() {
       $('#colors .color').removeClass('active');
       $(this).addClass('active');
       let color = $(this).data('colorname');
       $('#color').val(color);
   });
   
   $('#sizes .size').on('click', function(){
   $('#sizes .size').removeClass('active');
   $(this).addClass('active');
   
   let size = $(this).data('sizename');
  
   
   $('#size').val(size);
   let product_price = $(this).data('price');
   $('.price-amount').text(product_price);
   $('#price_val').val(product_price);
   let delivery_charge= $('#delivery_charge_id').find("option:selected");
   var testval = delivery_charge.data('charge');
   var total_price = Number(variation_price) + Number(testval);
   $('span#total').text(total_price);
   $('#total_price_val').val(total_price);
   $('#product_price').val(variation_price);
   
   $('span.final-price-amount').text(variation_price);
   $('#price_val').val(variation_price);
   $("#variation_id").val(value);
   }); 
      
      $('.increase-qty').on('click', function () {
       var sub_total_price = 0;   
       var product_price = $('input#product_price').val();
       if(product_price == '0') {
           var product_price = $('#product_price').val();
       }
       
       var qtyInput = $(this).siblings('.inner_qty');
       var newQuantity = parseInt(qtyInput.val()) + 1;
       
       $('input#product_quantity').val(newQuantity);
       $('#product_name').val();
       var delivery_charge = $('span#delvry_charge').text();
       
       var sub_total_price = Number(product_price) * Number(newQuantity);
       
       
       var total_with_delivery = Number(sub_total_price) + Number(delivery_charge);
       
       // $('span#price').text(sub_total_price);
       $('span.final-price-amount').text(sub_total_price);
       $('span#total').text(total_with_delivery);
       $('#total_price_val').val(total_with_delivery);
       qtyInput.val(newQuantity);
       });
   
       $('.decrease-qty').on('click', function () {
           var qtyInput = $(this).siblings('.inner_qty');
           $qnty = parseInt(qtyInput.val());
           var newQuantity = parseInt(qtyInput.val()) - 1;
           if (newQuantity > 0) {
               qtyInput.val(newQuantity);
               $('#product_quantity').val(newQuantity);
           }
           var product_price = $('input#price_val').val();
           var delivery_charge = $('span#delvry_charge').text();
           if(newQuantity != '0')
           {
              var sub_total_price = Number(product_price) * Number(newQuantity); 
              var total_with_delivery = Number(sub_total_price) + Number(delivery_charge);
           $('#total_price_val').val(total_with_delivery);
           $('span#total').text(total_with_delivery);
           $('span.final-price-amount').text(sub_total_price);
           }
           
       });
   
</script>