<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PopularCategory;
use App\Models\FeaturedCategory;
use App\Models\MegaMenuSubCategory;
use App\Models\MegaMenuCategory;
use Illuminate\Http\Request;
use Image;
use File;
use Str;
class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!auth()->user()->can('category.index')){
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::with('subCategories','products')->get();


        return view('admin.product_category',compact('categories'));

    }


    public function create()
    {
         if(!auth()->user()->can('category.create')){
            abort(403, 'Unauthorized action.');
        }
        return view('admin.create_product_category');
    }


    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:categories',
            'slug'=>'required|unique:categories',
            'status'=>'required',
            'priority'=>'',
            'short_description'=>'',
            'icon'=>'',
            'image'=>'required',
            'meta_image' => 'nullable|image',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),

        ];
        $this->validate($request, $rules,$customMessages);

        $category = new Category();
        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $category->image = $category_image;
        }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->icon = $request->icon;
        $category->priority = $request->priority;
        $category->short_description = $request->short_description;
        $category->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $category->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->author = $request->author;
        $category->publisher = $request->publisher;
        $category->copyright = $request->copyright;
        $category->site_name = $request->site_name;
        $category->keywords = $request->keywords;
        $category->save();

        if ($request->meta_image) {
            $image = $request->meta_image;
            $extention = $image->getClientOriginalExtension();
            $image_name = 'category-meta-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($image)->save(public_path().'/'.$image_name);
            $category->meta_image = $image_name;
            $category->save();
        }

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }


    public function show($id){
        $category = Category::find($id);
        return response()->json(['category' => $category],200);
    }

    public function edit($id)
    {
        if(!auth()->user()->can('category.edit')){
            abort(403, 'Unauthorized action.');
        }
        $category = Category::find($id);
        return view('admin.edit_product_category',compact('category'));
    }


    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $rules = [
            'name'=>'required|unique:categories,name,'.$category->id,
            'slug'=>'required|unique:categories,name,'.$category->id,
            'status'=>'required',
            'priority'=>'',
            'icon'=>'',
            'short_description'=>'',
            'meta_image' => 'nullable|image',
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),

        ];
        $this->validate($request, $rules,$customMessages);

        if($request->image){
            $existing_image = $category->image;
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $category->image = $category_image;
            $category->save();

            if($existing_image){
                if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
            }

        }

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->priority = $request->priority;
        $category->short_description = $request->short_description;
        $category->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $category->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->author = $request->author;
        $category->publisher = $request->publisher;
        $category->copyright = $request->copyright;
        $category->site_name = $request->site_name;
        $category->keywords = $request->keywords;
        $category->save();

        if ($request->meta_image) {
            $old_image = $category->meta_image;
            $image = $request->meta_image;
            $extention = $image->getClientOriginalExtension();
            $image_name = 'category-meta-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($image)->save(public_path().'/'.$image_name);
            $category->meta_image = $image_name;
            $category->save();
            if($old_image && File::exists(public_path().'/'.$old_image)) unlink(public_path().'/'.$old_image);
        } elseif ($request->remove_meta_image) {
            $old_image = $category->meta_image;
            $category->meta_image = null;
            $category->save();
            if($old_image && File::exists(public_path().'/'.$old_image)) unlink(public_path().'/'.$old_image);
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }

    public function destroy($id)
    {
        if(!auth()->user()->can('category.destroy')){
            abort(403, 'Unauthorized action.');
        }
        $category = Category::find($id);
        $category->delete();
        $megaMenuCategory = MegaMenuCategory::where('category_id',$id)->first();
        if($megaMenuCategory){
            $cat_id = $megaMenuCategory->id;
            $megaMenuCategory->delete();
            MegaMenuSubCategory::where('mega_menu_category_id',$cat_id)->delete();
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = Category::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
