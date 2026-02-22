<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\LandingPage;
use App\Models\LandingPageSlider;
use App\Models\reviewProductImage;
use App\Models\Shipping;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
    //   if(auth()->user()->can('landingPage.index')){
    //         abort(403, 'Unauthorized action.');
    //     } 
        $items=LandingPage::with('product')->get();
        return view('admin.LandingPage.index', compact('items'));
    }
    
    public function create(){

    //   if(auth()->user()->can('landingPage.create')){
    //         abort(403, 'Unauthorized action.');
    //     } 

        return view('admin.LandingPage.create');
    }
    
    
    public function store(Request $request)
    {
    //   if(auth()->user()->can('product.landingPage.store')){
    //         abort(403, 'Unauthorized action.');
    //     } 
        // dd($request->all());
        $data=$request->validate([
             'title1'=> 'required',
            //  'title2'=> 'required',
             'video_url'=> '',
             'landing_bg'=> '',
            //  'des1' => 'required',
            //  'feature' => 'required',
             'old_price' => '',
             'new_price' => '',
             'phone' => '',
            //  'des3' => '',
             'pay_text' => '',
             'product_id' => '',
             'regular_price_text' => '',
             'offer_price_text' => '',
             'call_text' => '',
             'left_side_title' => '',
             'left_side_desc' => '',
             'right_side_title' => '',
             'right_side_desc' => '',
             'top_heading_text' => '',
             'left_product_details' => ''
        ]);
        
            if($request->hasFile('image'))
            {
                $originName = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('image')->move(public_path('landing_pages'), $fileName);
                $data['image']=$fileName;
            }
            
            if($request->hasFile('landing_bg'))
            {
                $originName = $request->file('landing_bg')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('landing_bg')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('landing_bg')->move(public_path('landing_pages'), $fileName);
                $data['landing_bg']=$fileName;
            }
            
            if($request->hasFile('right_product_image'))
            {
                
                $originName = $request->file('right_product_image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('right_product_image')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('right_product_image')->move(public_path('landing_pages'), $fileName);
                $data['right_product_image']=$fileName;
            }

            $landPage = LandingPage::create($data);
            if(isset($request->sliderimage)) {

            $image_data=[];
            $fileName='';
            foreach ($request->sliderimage as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;

                $image->move(public_path('landing_sliders'), $fileName);
                $image_data[]=['image'=>$fileName];
            }

            if (!empty($image_data)) {
                   $landPage->images()->createMany($image_data);
            }
        }
        
        if(isset($request->review_product_image)) {

            $review_image_data=[];
            $fileName='';
            foreach ($request->review_product_image as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;

                $image->move(public_path('review_landing_sliders'), $fileName);
                $review_image_data[]=['review_image'=>$fileName];
            }

            if (!empty($review_image_data)) {
                   $landPage->review_images()->createMany($review_image_data);
            }
        }

        $notification=trans('admin_validation.Landing Page Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

        // return response()->json([
        //     'status' => true,
        //     'msg'    => 'Landing Page Created Successfully..!!'
        // ]);

    }


     public function getOrderProduct(Request $request)
    {
        $data = Product::
                    
        where('products.name', 'LIKE', '%'. $request->get('search'). '%')
        ->get();

        return response()->json($data);
    }
    
    public function getOrderProduct2(Request $request){

        $data = Product::where('products.name', 'LIKE', '%'. $request->get('search'). '%')->get();

        return response()->json($data);

    }
    
    public function orderProductEntry(Request $request){ 

        $id=$request->id;
        $variation=Product::find($id);
        $data=Product::all;

        if ($variation) { 
            $html='<tr><td><img src="/products/'.$variation->thumb_image.'" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    
                  
                    <td class="row_total">'.$data['price'].'</td>
                    <td>
                        <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Note Found !!']);
        }
    }
    
    public function landingProductEntry(Request $request){

        $id=$request->id;
        $variation=Product::find($id);
        $pr_id = $variation->id;
        $data=Product::all();
      	$image_source = asset('public/'.$variation->thumb_image);

        if ($variation) {
            $html = '<table class="table table-centered table-nowrap mb-0" id="product_table">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>price</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                       <tr><td><img src="'.$image_source.'" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    <td>'.$variation->price.'</td>
                    <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr>
                    </tbody>
                    </table>';

            $htmldfhgdf='<tr><td><img src="$variation->thumb_image" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    
                    <td>
                        <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html,'pr_id' => $pr_id]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Note Found !!']);
        }
    }


    public function fileUpload(Request $request){

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('ck-images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ck-images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }

    }

    public function landing_page($id)
    {
        $ln_pg = LandingPage::with('product')->where('id', $id)->first();
        $title = $ln_pg->title1;
        $shippings = Shipping::with('city')->orderBy('id', 'asc')->get();
        return view('admin.LandingPage.land_page', compact('ln_pg', 'shippings','title'));
    }


    public function landing_page_edit($id)
    {
      if(!auth()->user()->can('landingPage.edit')){
            abort(403, 'Unauthorized action.');
        } 
        $item=LandingPage::with('product','review_images')->find($id);
        foreach($item->review_images() as $image) {
            dd($image);
        }
        
        $review_images = reviewProductImage::where('landing_page_id', $id)->get();
        $single_product = Product::find($item->product_id);
        // dd($single_product);
        return view('admin.LandingPage.edit', compact('item', 'single_product','review_images'));
    }

    

    public function update(Request $request, $id)
    {
    //   if(!auth()->user()->can('product.landingPage.update')){
    //         abort(403, 'Unauthorized action.');
    //     } 

        $updatePage = LandingPage::find($id);
      
      	$data=$request->validate([
             'title1'=> 'required',
            //  'title2'=> 'required',
             'video_url'=> '',
             'landing_bg'=> '',
            //  'des1' => 'required',
            //  'feature' => 'required',
             'old_price' => '',
             'new_price' => '',
             'phone' => '',
            //  'des3' => '',
             'pay_text' => '',
             'product_id' => '',
             'regular_price_text' => '',
             'offer_price_text' => '',
             'call_text' => '',
             'left_side_title' => '',
             'left_side_desc' => '',
             'right_side_title' => '',
             'right_side_desc' => '',
             'top_heading_text' => '',
             'left_product_details' => ''
        ]);
       
       if($request->new_product_id != null)
      {
          $data['product_id'] = $request->new_product_id;
      }
      
      
      if($request->hasFile('landing_bg'))
            {
                $originName = $request->file('landing_bg')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('landing_bg')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('landing_bg')->move(public_path('landing_pages'), $fileName);
                $data['landing_bg']=$fileName;
            }
      
      if($request->hasFile('right_product_image'))
            {
                
                $originName = $request->file('right_product_image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('right_product_image')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('right_product_image')->move(public_path('landing_pages'), $fileName);
                $data['right_product_image']=$fileName;
            }
      

           if(isset($request->sliderimage)) {

           $image_data=[];
           $fileName='';
           foreach ($request->sliderimage as $key => $image) {
               $originName = $image->getClientOriginalName();
               $fileName = pathinfo($originName, PATHINFO_FILENAME);
               $extension = $image->getClientOriginalExtension();
               $fileName =$fileName.time().'.'.$extension;

               $image->move(public_path('landing_sliders'), $fileName);
               $image_data[]=['image'=>$fileName];
           }

           if (!empty($image_data)) {
                $updatePage->images()->createMany($image_data);
           }

       }
       
       if(isset($request->review_product_image)) {

            $review_image_data=[];
            $fileName='';
            foreach ($request->review_product_image as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;

                $image->move(public_path('review_landing_sliders'), $fileName);
                $review_image_data[]=['review_image'=>$fileName];
            }

            if (!empty($review_image_data)) {
                   $landPage->review_images()->createMany($review_image_data);
            }
        }

       $updatePage->update($data);
       
       $notification = trans('admin_validation.Update Successfully');
       $notification = array('messege'=>$notification,'alert-type'=>'success');
       return redirect()->back()->with($notification);
    }


    public function destroy(Request $request, $id)
    {
          if(!auth()->user()->can('landingPage.destroy')){
            abort(403, 'Unauthorized action.');
        } 
      
        $single_page = LandingPage::with('images')->find($id);

        if($single_page)
        {
            deleteImage('landing_pages', $single_page->image);
        }

        if ($single_page->images()->count() >= 1) {
            foreach ($single_page->images as $key => $slider_image) {
               deleteImage('landing_sliders', $slider_image);
            }
        }

        $single_page->delete();
        
        $notification = trans('admin_validation.Deleted Successfully');
       $notification = array('messege'=>$notification,'alert-type'=>'success');
       return redirect()->back()->with($notification);
    }
    
}
