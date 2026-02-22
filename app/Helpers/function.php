<?php
use App\Models\Category;
use App\Models\PopularCategory;
use App\Models\FeaturedCategory;
use App\Models\Setting;
use App\Models\Brand;

function custom_sanitize($content)
{
    $replace = array('<p>', '</p>');
    $response = str_replace($replace, '', $content);
    return $response;
}

function getOrderStatus($type=""){

    if($type != "")
      {
       return [''=> 'All', '0'=>'Pending','1'=>'Process','2'=>'Courier','5'=>'On Hold','3'=>'Complete','4'=>'Cancelled','6' => 'Return']; 
      }
    
      return ['0'=>'Pending','1'=>'Process','2'=>'Courier','5'=>'On Hold','3'=>'Complete','4'=>'Cancelled','6' => 'Return'];
  
  }

function categories()
{
    $categories = Category::with('activeSubCategories')->where('status', 1)->orderBy('priority', 'ASC')->get();

    return $categories;
}

function featuredCategories()
{
    $feateuredCategories = FeaturedCategory::with('category')->orderBy('priority', 'ASC')->get();

    return $feateuredCategories;
}

function popularCategories()
{
    $popularCategories = PopularCategory::with('category')->orderBy('priority', 'ASC')->get();

    return $popularCategories;
}

function deleteImage($folder=null, $file=null){

    if (!empty($folder) && !empty($file)) {
        $path = public_path($folder.'/'.$file);
        $isExists = file_exists($path);
        if ($isExists) {
            unlink($path);
        }
    }
    return true;
}

function siteInfo()
{
    $setting = Setting::first();

    return $setting;
}

function calculateDiscountPercent($product)
{
    if(!empty($product->offer_price) && $product->price > $product->offer_price)
    {
        return (int) ( ( ($product->price - $product->offer_price) / $product->price) * 100 );
    }

    return 0;
}

function cartItems()
{
    $cart = session()->get('cart', []);

    return $cart;
}

function getCartProductArray(){
    $carts = session()->get('cart', []);
    $product_id=[];
    foreach($carts as $key=>$cart){
        $product_id[]=$key;
        
    }

    return $product_id;
}


function totalCartItems()
{
    $cart = cartItems();

    return count($cart);
}

function cartTotalAmount()
{
    $cart = cartItems();
    $total = 0;
    $total_qty = 0;
    foreach($cart as $key => $item)
    {
        $total += ($item['price'] * $item['quantity']);
        $total_qty += $item['quantity'];
    }

    return ['total_qty' => $total_qty, 'total'=> $total];
}

function brands()
{
    $brands = Brand::with('products')->where('status', 1)->get();
    
    return $brands;
}

function BanglaText($index)
{      
  $bangla_text = array(
    "order"                 => "অর্ডার করুন",
    "do_order"              => "অর্ডার করতে ক্লিক করুন",
    "cart"                  => "কার্টে রাখুন",
    "free"                  => "ফ্রি শিপিং",
    'tk'                    => "টাকা",
    "offer"                 => "অফার প্রাইস",
    "cart_add"              => "কার্টে যোগ করুন",
    "cust_info"             =>"কাস্টমার ইনফরমেশন",
    "instruction"           =>"অর্ডার কনফার্ম করতে আপনার নাম, ঠিকানা, মোবাইল নাম্বার লিখে অর্ডার কনফার্ম করুন বাটনে ক্লিক করুন",
    "name"                  => "আপনার নাম",
    "placeholder_name"      => "আপনার নাম লিখুন",
    "mobile"                => "আপনার মোবাইল নাম্বার",
    "placeholder_mobile"    => "আপনার  মোবাইল নাম্বার লিখুন",
    "address"               => "আপনার সম্পূর্ন ঠিকানা",
    "placeholder_address"   => "",
    "delivery_zone"         => "ডেলিভারি এলাকা নির্বাচন করুন",
    "confirm_order"         => "অর্ডার  কনফার্ম  করুন",
    "order_information"     => "অর্ডার ইনফরমেশন",
    "land_instruction"      => "অর্ডার করতে নিচের ফর্মটি সঠিক তথ্য দিয়ে পূরন করুন",
    "login_account"         => "অ্যকাউন্ট থাকলে লগিন করুন",
    "coupon_apply"          => "কূপন থাকলে এপ্লাই করুন",
    "order_ensure"          => "১০০% শিউর হয়ে অর্ডার করুন"
    );
  return $bangla_text[$index]; 
}
