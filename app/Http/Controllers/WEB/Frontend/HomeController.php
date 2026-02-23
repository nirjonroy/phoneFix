<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;
use App\Models\FlashSaleProduct;
use App\Models\FooterLink;
use App\Models\AboutUs;
use App\Models\TermsAndCondition;
use App\Models\Faq;
use App\Models\ContactPage;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Footer;
use App\Models\CustomPage;
use App\Models\ContactMessage;
// use App\Models\AboutUs;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\FooterSocialLink;
use Image;
use File;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendmail;
use App\Mail\ReciveMail;
class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::select(['id', 'title_one', 'title_two', 'image'])->where('status', 1)->first();
        // dd($slider);
		 $sliders = Slider::where('status', 1)->get();

        $feateuredCategories = featuredCategories();
        // dd($feateuredCategories);
        $products = Product::with(['category', 'subCategory', 'childCategory'])
                                        ->where('is_recomended', 1)
                                        ->where('status', 1)
                                        ->latest()
                                        ->take(12)
                                        ->get();
        $flash_sale_products = flashSaleProduct::with('product')->where('status', 1)->latest()->get();

        $firstColumns  = FooterLink::where('column', 1)->get();

        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();
        $title         = Footer::first();
      	$social_links = FooterSocialLink::all();
        $about = AboutUs::first();
        $faqs = Faq::all();
        $galleryCategories = Category::with([
                "subCategories" => function ($query) {
                    $query->where("status", 1)->orderBy("id", "ASC");
                },
                "subCategories.childCategories" => function ($query) {
                    $query->where("status", 1)->orderBy("id", "ASC");
                },
            ])
            ->where("status", 1)
            ->orderBy("id", "ASC")
            ->get();
        $galleryLimit = 10;
        $galleryItems = collect();
        $allGalleryItems = collect();

        foreach ($galleryCategories as $galleryCategory) {
            $categoryItems = collect();

            if (!empty($galleryCategory->image)) {
                $categoryItems->push([
                    "category_id" => $galleryCategory->id,
                    "name" => $galleryCategory->name,
                    "image" => $galleryCategory->image,
                ]);
            }

            foreach ($galleryCategory->subCategories as $gallerySubCategory) {
                if (!empty($gallerySubCategory->image)) {
                    $categoryItems->push([
                        "category_id" => $galleryCategory->id,
                        "name" => $gallerySubCategory->name,
                        "image" => $gallerySubCategory->image,
                    ]);
                }

                foreach ($gallerySubCategory->childCategories as $galleryChildCategory) {
                    if (!empty($galleryChildCategory->image)) {
                        $categoryItems->push([
                            "category_id" => $galleryCategory->id,
                            "name" => $galleryChildCategory->name,
                            "image" => $galleryChildCategory->image,
                        ]);
                    }
                }
            }

            if ($categoryItems->isNotEmpty()) {
                $galleryItems->push($categoryItems->first());
            }

            $allGalleryItems = $allGalleryItems->merge($categoryItems);
        }

        $galleryItems = $galleryItems->unique("image")->values();
        $allGalleryItems = $allGalleryItems->unique("image")->values();

        if ($galleryItems->count() < $galleryLimit) {
            $remaining = $allGalleryItems->reject(function ($item) use ($galleryItems) {
                return $galleryItems->contains("image", $item["image"]);
            });
            $galleryItems = $galleryItems->merge($remaining);
        }

        $galleryItems = $galleryItems->take($galleryLimit)->values();
      	// dd($products);

        return view('frontend.home.index', compact(
                'slider', 'feateuredCategories', 'products',
                'firstColumns',
                'secondColumns',
                'thirdColumns',
                'title',
          		'social_links',
          		'sliders',
          		'flash_sale_products',
                'about',
                'faqs',
                'galleryCategories',
                'galleryItems'));
    }

  	public function about_us_page(){
    	$about_us = AboutUs::first();
      	return view('frontend.pages.about_us', compact('about_us'));
    }
  	public function privacy_policy(){
    	$tarms = TermsAndCondition::first();
      	return view('frontend.pages.terms_and_condition', compact('tarms'));
    }

  	public function faq(){
    	$faqs = Faq::get();
      	return view('frontend.pages.faqs', compact('faqs'));
    }
  	public function terms_condition(){
    	$tarms = TermsAndCondition::first();
      	return view('frontend.pages.terms_condition', compact('tarms'));
    }

  	public function contact_us(){
    	$contact = contactPage::first();
      	return view('frontend.pages.contact', compact('contact'));
      	//dd($contact);
    }

  	public function blog(){
    	$blog = Blog::latest()->get();
      	//dd($blog);
      	return view('frontend.pages.blog', compact('blog'));
      	//dd($contact);
    }

    public function blog_details($slug){
        $blog = Blog::where('slug', $slug)->first();
        //dd($blog);
        return view('frontend.pages.blog_details', compact('blog'));
    }

    public function servicesCategory($category)
    {
        $categoryModel = Category::whereSlug($category)->firstOrFail();
        $categories = SubCategory::where(['category_id' => $categoryModel->id])
            ->orderBy('serial', 'ASC')
            ->where('status', 1)
            ->latest()
            ->get();

        if ($categories->count() <= 0) {
            $services = $categoryModel->products;
            $feateuredCategories = featuredCategories();
            return view('frontend.shop.index', compact('services', 'feateuredCategories'));
        }

        return view('frontend.category.sub-category', compact('categories'));
    }

    public function servicesSubCategory($category, $subcategory)
    {
        $categoryModel = Category::whereSlug($category)->firstOrFail();
        $subCategory = SubCategory::where('slug', $subcategory)
            ->where('category_id', $categoryModel->id)
            ->firstOrFail();

        $categories = ChildCategory::where(['sub_category_id' => $subCategory->id])
            ->orderBy('serial', 'ASC')
            ->orderBy('id', 'DESC')
            ->get();

        if ($categories->count() <= 0) {
            $services = $subCategory->products;
            $feateuredCategories = featuredCategories();
            return view('frontend.shop.index', compact('services', 'feateuredCategories'));
        }

        return view('frontend.category.child-category', compact('categories'));
    }

    public function servicesChildCategory($category, $subcategory, $child)
    {
        $categoryModel = Category::whereSlug($category)->firstOrFail();
        $subCategory = SubCategory::where('slug', $subcategory)
            ->where('category_id', $categoryModel->id)
            ->firstOrFail();
        $childCategory = ChildCategory::where('slug', $child)
            ->where('sub_category_id', $subCategory->id)
            ->firstOrFail();

        $services = $childCategory->products;
        $feateuredCategories = featuredCategories();
        return view('frontend.shop.index', compact('services', 'feateuredCategories'));
    }

    public function repairIndex(Request $request, $slug = null)
    {
        if (!$slug) {
            return $this->shop($request, $slug);
        }

        $category = Category::whereSlug($slug)->first();
        $subCategory = SubCategory::whereSlug($slug)->first();
        $childCategory = ChildCategory::whereSlug($slug)->first();

        if ($category || $subCategory || $childCategory) {
            return $this->shop($request, $slug);
        }

        $service = Product::where('slug', $slug)->first();
        if ($service) {
            return redirect()->route('front.repair', ['slug' => $slug], 301);
        }

        return $this->shop($request, $slug);
    }

    public function subCategoriesByCategory(Request $request)
    {
        if($request->type == 'subcategory')
        {
            $id = Category::whereSlug($request->slug)->first()->id;
            $categories = SubCategory::where(['category_id' => $id])->orderBy('serial', 'ASC')->where('status',1)->latest()->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }

            return view('frontend.category.sub-category', compact('categories'));
        }
        else if($request->type == 'childcategory')
        {
            $id = SubCategory::whereSlug($request->slug)->first()->id;
            $categories = ChildCategory::where(['sub_category_id' => $id])->orderBy('serial', 'ASC')->orderBy('id', 'DESC')->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }

            return view('frontend.category.child-category', compact('categories'));
        }

    }



    public function shop(Request $request, $slug)
    {
        // dd('ok');
         $data = [];
        $slug = $slug ?: $request->slug;

        if(empty($data))
        {
            $data = Category::with('products')->whereSlug($slug)->first();
        }

        if(empty($data))
        {
            $data = SubCategory::with('products')->whereSlug($slug)->first();
        }

        if(empty($data))
        {
            $data = ChildCategory::with('products')->whereSlug($slug)->first();
        }

        if(empty($slug))
        {
            $services = Product::with(['category', 'subCategory', 'childCategory'])->orderBy('id', 'DESC')->where('status', 1)->take(30)->get();
            // dd($services);
        }

        else if($data){
            // dd($data);
            $services = $data->products;
        }

        else{
            $services = [];
        }

        // dd($services);
        // $slider = Slider::select(['id', 'title_one', 'title_two', 'image'])->where('status', 1)->first();
        $feateuredCategories = featuredCategories();
        // $category = Category::where('slug', $slug)->first();
        // $sub_category = SubCategory::with('products')->whereSlug($request->slug)->first();
        // // dd($category);
        // $services = Product::where('category_id', $sub_category->id)->get();
        // dd($services);

        return view('frontend.shop.index', compact('services', 'feateuredCategories'));
    }

    public function single_service($slug){
        $service = Product::where('slug', $slug)->first();
        $cat = Category::where('id', $service->category_id)->first();
        $subcat = subCategory::where('id', $service->sub_category_id)->first();
        $childcat = childCategory::where('id', $service->child_category_id)->first();
        
        
        if($service->child_category_id > 0){
            $related_product = Product::where('child_category_id', $childcat->id)
                                        
                                        ->latest()
                                        ->limit(12)->get();
        // dd($related_product);
        }
        elseif($service->sub_category_id > 0){
             $related_product = Product::where('sub_category_id', $subcat->id)
                                        
                                        ->latest()
                                        ->limit(12)->get();
        // dd($related_product);
        }
        else{
                 $related_product = Product::where('category_id', $cat->id)
                                        
                                        ->latest()
                                        ->limit(12)->get();
        // dd($related_product);
        }
        
        return view('frontend.shop.single_service', compact('service', 'related_product'));
    }

    public function mostSellingProducts()
    {
        $products = Product::with(['category', 'subCategory', 'childCategory'])
                            ->leftJoin('order_products as op','products.id','=','op.product_id')
                            ->selectRaw('products.*, COALESCE(sum(op.qty),0) total')
                            ->groupBy('products.id')
                            ->orderBy('total','desc')
                            ->take(50)
                            ->get();

        return view('frontend.shop.most-selling', compact('products'));
    }

    public function flashSellProducts()
    {
        $flashSell = FlashSaleProduct::with('product')->latest()->get();

        return view('frontend.shop.flash-sell', compact('flashSell'));
    }

    public function repair_page(Request $request, $slug){
        $service = Product::where('slug', $slug)->first();
        // $category = Category()
        // dd($service);

        return view('frontend.repair.index', compact('service'));
    }
    public function all_service(){
        $all_service = Category::where('status', 1)->get();
        return view('frontend.repair.all_service', compact('all_service'));
    }


    public function repair_submit(Request $request){
        // dd($request->all());
        $rules = [
            'service_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'short_notes' => 'required',
            'appoinment_date' => '',
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),

            'email.required' => trans('admin_validation.Slug is required'),


        ];
        $this->validate($request, $rules,$customMessages);

        $order = new Order();
        if ($request->hasFile('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $order_image = 'service_order'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $order_image_path = 'uploads/custom-images/'.$order_image;

            // Save the image
            Image::make($request->file('image'))->save(public_path($order_image_path));

            // Assign the image path to the 'image' property of the $order instance
            $order->image = $order_image_path;
        }

        $order->service_name = $request->service_name;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->short_notes = $request->short_notes;
        $order->appoinment_date = $request->appoinment_date;
        $order->appoinment_time = $request->appoinment_time;
        $order->save();
        // $mailData = [
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'service_name' => $request->service_name,
        //     'short_notes' => $request->short_notes,
        // ];

        // Mail::to($request->input('email'))
        //     ->send(new sendmail($mailData));

        // // Send email to receiver
        // Mail::to('roynirjon18@gmail.com') // Receiver's email address
        //     ->send(new ReciveMail($mailData));
        Alert::toast('Message', 'Successfully sent message');
        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('front.order-thanks-page')->with($notification);

    }
    public function contact(){
        $contacts = ContactPage::first();
        return view('frontend.contact.index', compact('contacts'));
    }

    public function customPages($slug){
        $customPage=CustomPage::where('slug', $slug)->first();

        // dd($customPage);
        return view('frontend.pages', compact('customPage'));
    }

    public function message(Request $request){
        // dd($request->all());
        $rules = [

            'name' => 'required',
            'email' => '',
            'phone' => '',
            'address' => '',
            'subject' => '',
            'message' => '',
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),

            'email.required' => trans('admin_validation.Slug is required'),


        ];
        $this->validate($request, $rules,$customMessages);

        $order = new ContactMessage();
       


        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->subject = $request->subject;
        $order->message = $request->message;
        $order->save();
       
        Alert::toast('Message', 'Successfully sent message');
        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
