@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Product Category')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Product Category')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.product-category.index') }}">{{__('admin.Product Category')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Create Product Category')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product-category.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Product Category')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product-category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="image">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Icon')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-icon-picker"  name="icon">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" class="form-control"  name="slug">
                                </div>

                                <div class="form-group col-12">
                                    <label>Short Description <span class="text-danger">*</span></label>
                                    {{-- <input type="text" id="slug" class="form-control"  name="slug"> --}}
                                    <textarea name="short_description" class="form-control" id="" cols="80" rows="50"></textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title">
                                </div>
                                <div class="form-group col-12">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title">
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Image</label>
                                    <input type="file" class="form-control-file" name="meta_image">
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Author</label>
                                    <input type="text" class="form-control" name="author">
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Publisher</label>
                                    <input type="text" class="form-control" name="publisher">
                                </div>
                                <div class="form-group col-6">
                                    <label>Meta Copyright</label>
                                    <input type="text" class="form-control" name="copyright">
                                </div>
                                <div class="form-group col-6">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control" name="site_name">
                                </div>
                                <div class="form-group col-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="keywords" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>priority <span class="text-danger"></span></label>
                                    <input type="text" id="slug" class="form-control"  name="priority">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">{{__('admin.Active')}}</option>
                                        <option value="0">{{__('admin.InActive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
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
