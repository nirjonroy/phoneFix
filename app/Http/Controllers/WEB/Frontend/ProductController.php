<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;
use App\Models\FeaturedCategory;
use App\Models\FooterLink;
use App\Models\Footer;
use App\Models\FooterSocialLink;
class ProductController extends Controller
{

    public function index()
    {
        //
    }
  
  	public function shop_single($slug){
      
      	 $product = Product::with('variantItems', 'category', 'subCategory', 'childCategory', 'gallery')
                            ->where('slug', $slug)->first();
        // dd($product);                    
      	
      	  $firstColumns  = FooterLink::where('column', 1)->get();
        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();
        $title         = Footer::first();
      	$social_links = FooterSocialLink::all();
      	
    	return view('frontend.product.shop-single-product', compact('product', 'firstColumns', 'secondColumns', 'thirdColumns', 'title', 'social_links'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {      
        $firstColumns  = FooterLink::where('column', 1)->get();
        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();
        $title         = Footer::first();
        
        $product = Product::with('variantItems', 'category', 'subCategory', 'childCategory')
                            ->findOrFail($id);

        // dd($product);
      $social_links = FooterSocialLink::all();

        return view('frontend.product.show', compact('product', 'firstColumns', 'secondColumns', 'thirdColumns', 'title', 'social_links'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function searchProduct(Request $request)
    {
        $services  = Product::with('category', 'subCategory', 'childCategory')
                                ->where('name', 'like', '%'.$request->get('query').'%')
                                ->orWhere('slug','like', '%'.$request->get('query').'%')
                                ->latest()
                                ->get();
        

        return view('frontend.shop.search', compact('services'));

    }    
    
    
    public function brandWiseProduct()
    {
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')
                                ->whereHas('brand', function($q){
                                    $q->whereSlug(request('slug'));
                                })                      
                                ->get();

        return view('frontend.product.brand-wise-product', compact('products'));

    }
    
}
