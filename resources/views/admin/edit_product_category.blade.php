@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Product Category')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Product Category')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.product-category.index') }}">{{__('admin.Product Category')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit Product Category')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product-category.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Product Category')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product-category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Current Image')}}</label>
                                    <div>
                                        <img src="{{ asset($category->image) }}" alt="" width="100px">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="image">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Icon')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-icon-picker"  name="icon" value="{{ $category->icon }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ $category->name }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" class="form-control"  name="slug" value="{{ $category->slug }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>Short Description <span class="text-danger">*</span></label>
                                    
                                    <textarea name="short_description" class="form-control" id="" cols="80" rows="50">{{ $category->short_description }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title" value="{{ $category->seo_title }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" class="form-control" rows="3">{{ $category->seo_description }}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Image</label>
                                    <input type="file" class="form-control-file" name="meta_image">
                                    @if($category->meta_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($category->meta_image) }}" alt="" width="120px">
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_meta_image" value="1" id="removeMetaImage">
                                            <label class="form-check-label" for="removeMetaImage">
                                                Remove Meta Image
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Author</label>
                                    <input type="text" class="form-control" name="author" value="{{ $category->author }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Publisher</label>
                                    <input type="text" class="form-control" name="publisher" value="{{ $category->publisher }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Copyright</label>
                                    <input type="text" class="form-control" name="copyright" value="{{ $category->copyright }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control" name="site_name" value="{{ $category->site_name }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="keywords" class="form-control" rows="3">{{ $category->keywords }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>priority <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" class="form-control"  name="priority" value="{{ $category->priority }}">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $category->status==1 ? 'selected': '' }} value="1">{{__('admin.Active')}}</option>
                                        <option {{ $category->status==0 ? 'selected': '' }}  value="0">{{__('admin.InActive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })
        });
    })(jQuery);

    function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
        }
</script>
@endsection
