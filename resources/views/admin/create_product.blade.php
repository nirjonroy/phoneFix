@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Products')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>All Services</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Services</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> Add Services</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>{{__('admin.Thumbnail Image Preview')}}</label>
                                    <div>
                                        <img id="preview-img" class="admin-img" src="{{ asset('uploads/website-images/preview.png') }}" alt="">
                                    </div>

                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('admin.Thumnail Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="thumb_image" onchange="previewThumnailImage(event)">
                                </div>

                                <!--<div class="form-group col-4">-->
                                <!--    <label>upload images <span class="text-danger">*</span></label>-->
                                    <!--<input type="file" name="images[]" multiple>-->
                                <!--    <input type="file" class="form-control-file"  name="images[]" onchange="previewThumnailImage(event)" multiple>-->
                                <!--</div>-->

                                <div class="form-group col-6">
                                    <label>{{__('admin.Short Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="short_name" class="form-control"  name="short_name" value="{{ old('short_name') }}">
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ old('name') }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" class="form-control"  name="slug" value="{{ old('slug') }}">
                                </div>

                                <div class="form-group col-4">
                                    <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control select2" id="category">
                                        <option value="">{{__('admin.Select Category')}}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label>{{__('admin.Sub Category')}}</label>
                                    <select name="sub_category" class="form-control select2" id="sub_category">
                                        <option value="">{{__('admin.Select Sub Category')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label>{{__('admin.Child Category')}}</label>
                                    <select name="child_category" class="form-control select2" id="child_category">
                                        <option value="">{{__('admin.Select Child Category')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('admin.Brand')}} </label>
                                    <select name="brand" class="form-control select2" id="brand">
                                        <option value="">{{__('admin.Select Brand')}}</option>
                                        @foreach ($brands as $brand)
                                            <option {{ old('brand') == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--<div class="form-group col-6">-->
                                <!--    <label>{{__('admin.SKU')}} </label>-->
                                <!--   <input type="text" class="form-control" name="sku">-->
                                <!--</div>-->

                                {{-- <div class="form-group col-4">
                                    <label>{{__('admin.Price')}} <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>

                                <div class="form-group col-4">
                                    <label>{{__('admin.Offer Price')}}</label>
                                   <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                                </div> --}}



                                {{-- <div class="form-group col-4">
                                    <label>{{__('admin.Stock Quantity')}} <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                </div> --}}

                              {{-- <div class="col-md-12">
                                <div class="row">

                                        <div class="col-md-6">

                                                  <div class="form-group col-12">
                                                    <label>{{__('admin.Weight')}} <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                                                </div>

                                        </div>
                                  <div class="col-md-6">

                                  <div class="form-group col-12" style="margin-bottom: 7px;">
                                    <label></label>
                                  <!-- <input type="text" class="form-control" name="weight" value="{{ old('weight') }}"> -->
                                </div>

                              <select name="measure" class="form-control form-select shadow-none" id="">
                                            <option value="Grm">Grm</option>
                                            <option value="Ltr">Ltr</option>

                              </select>
                                </div>

                                  </div>

                              </div> --}}



                                {{-- <div class="form-group col-12">
                                    <label>{{__('admin.Tag')}} <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control tags" name="tags" value="{{ old('tags') }}">
                                </div> --}}



                                <div class="form-group col-12">
                                <label>{{__('admin.Short Description')}} <span class="text-danger">*</span></label>
                                <textarea name="short_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ old('short_description') }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Long Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="long_description" id="" cols="30" rows="10" class="summernote">{{ old('long_description') }}</textarea>
                                </div>

                                {{-- <div class="form-group col-12">
                                    <label>{{__('admin.Highlight')}}</label>
                                    <div>
                                        <input type="checkbox"name="top_product" id="top_product"> <label for="top_product" class="mr-3" >{{__('admin.Top Product')}}</label>

                                        <input type="checkbox" name="new_arrival" id="new_arrival"> <label for="new_arrival" class="mr-3" >{{__('admin.New Arrival')}}</label>

                                        <input type="checkbox" name="best_product" id="best_product"> <label for="best_product" class="mr-3" >{{__('admin.Best Product')}}</label>

                                        <input type="checkbox" name="is_featured" id="is_featured"> <label for="is_featured" class="mr-3" >{{__('admin.Featured Product')}}</label>
                                    </div>
                                </div> --}}

                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">{{__('admin.Active')}}</option>
                                        <option value="0">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>SEO Title</label>
                                    <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>SEO Description</label>
                                    <textarea name="seo_description" cols="30" rows="5" class="form-control text-area-5">{{ old('seo_description') }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" cols="30" rows="5" class="form-control text-area-5">{{ old('meta_description') }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>Meta Image</label>
                                    <input type="file" class="form-control-file" name="meta_image">
                                </div>

                                <div class="form-group col-6">
                                    <label>Meta Author</label>
                                    <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                                </div>

                                <div class="form-group col-6">
                                    <label>Meta Publisher</label>
                                    <input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}">
                                </div>

                                <div class="form-group col-6">
                                    <label>Meta Copyright</label>
                                    <input type="text" class="form-control" name="copyright" value="{{ old('copyright') }}">
                                </div>

                                <div class="form-group col-6">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control" name="site_name" value="{{ old('site_name') }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>Meta Keywords</label>
                                    <textarea name="keywords" cols="30" rows="3" class="form-control text-area-5">{{ old('keywords') }}</textarea>
                                </div>



                                <!--<div class="form-group col-12">-->
                                <!--    <label>SEO Enable</label>-->
                                <!--    <div>-->
                                <!--        <a href="javascript::void()" id="manageSpecificationBox">-->
                                <!--            <input name="is_specification" id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-onstyle="success" data-offstyle="danger">-->
                                <!--        </a>-->
                                <!--    </div>-->
                                <!--</div>-->



                                <!--<div class="form-group col-12" id="specification-box">-->
                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.SEO Title')}}</label>-->
                                <!--   <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">-->
                                <!--</div>-->

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.SEO Description')}}</label>-->
                                <!--    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ old('seo_description') }}</textarea>-->
                                <!--</div>-->
                                <!--</div>-->

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.Specifications')}}</label>-->
                                <!--    <div>-->
                                <!--        <a href="javascript::void()" id="manageSpecificationBox">-->
                                <!--            <input name="is_specification" id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="Enable" data-off="Disabled" data-onstyle="success" data-offstyle="danger">-->
                                <!--        </a>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <!--<div class="form-group col-12" id="specification-box">-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-md-5">-->
                                <!--            <label>{{__('admin.Key')}} <span class="text-danger">*</span></label>-->
                                <!--            <select name="keys[]" class="form-control">-->
                                <!--                @foreach ($specificationKeys as $specificationKey)-->
                                <!--                    <option value="{{ $specificationKey->id }}">{{ $specificationKey->key }}</option>-->
                                <!--                @endforeach-->
                                <!--            </select>-->
                                <!--        </div>-->
                                <!--        <div class="col-md-5">-->
                                <!--            <label>{{__('admin.Specification')}} <span class="text-danger">*</span></label>-->
                                <!--            <input type="text" class="form-control" name="specifications[]">-->
                                <!--        </div>-->
                                <!--        <div class="col-md-2">-->
                                <!--            <button type="button" class="btn btn-success plus_btn" id="addNewSpecificationRow"><i class="fas fa-plus"></i></button>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->


                                <!--<div id="hidden-specification-box" class="d-none">-->
                                <!--    <div class="delete-specification-row">-->
                                <!--        <div class="row mt-2">-->
                                <!--            <div class="col-md-5">-->
                                <!--                <label>{{__('admin.Key')}} <span class="text-danger">*</span></label>-->
                                <!--                <select name="keys[]" class="form-control">-->
                                <!--                    @foreach ($specificationKeys as $specificationKey)-->
                                <!--                        <option value="{{ $specificationKey->id }}">{{ $specificationKey->key }}</option>-->
                                <!--                    @endforeach-->
                                <!--                </select>-->
                                <!--            </div>-->
                                <!--            <div class="col-md-5">-->
                                <!--                <label>{{__('admin.Specification')}} <span class="text-danger">*</span></label>-->
                                <!--                <input type="text" class="form-control" name="specifications[]">-->
                                <!--            </div>-->
                                <!--            <div class="col-md-2">-->
                                <!--                <button type="button" class="btn btn-danger plus_btn deleteSpeceficationBtn"><i class="fas fa-trash"></i></button>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
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
        var specification = true;
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $("#category").on("change",function(){
                var categoryId = $("#category").val();
                if(categoryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/admin/subcategory-by-category/')}}"+"/"+categoryId,
                        success:function(response){
                            $("#sub_category").html(response.subCategories);
                            var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                            $("#child_category").html(response);
                        },
                        error:function(err){
                            console.log(err);

                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select Sub Category')}}</option>";
                    $("#sub_category").html(response);
                    var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                    $("#child_category").html(response);
                }


            })

            $("#sub_category").on("change",function(){
                var SubCategoryId = $("#sub_category").val();
                if(SubCategoryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/admin/childcategory-by-subcategory/')}}"+"/"+SubCategoryId,
                        success:function(response){
                            $("#child_category").html(response.childCategories);
                        },
                        error:function(err){
                            console.log(err);

                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                    $("#child_category").html(response);
                }

            })

            $("#is_return").on('change',function(){
                var returnId = $("#is_return").val();
                if(returnId == 1){
                    $("#policy_box").removeClass('d-none');
                }else{
                    $("#policy_box").addClass('d-none');
                }

            })

            $("#addNewSpecificationRow").on('click',function(){
                var html = $("#hidden-specification-box").html();
                $("#specification-box").append(html);
            })

            $(document).on('click', '.deleteSpeceficationBtn', function () {
                $(this).closest('.delete-specification-row').remove();
            });


            $("#manageSpecificationBox").on("click",function(){
                if(specification){
                    specification = false;
                    $("#specification-box").addClass('d-none');
                }else{
                    specification = true;
                    $("#specification-box").removeClass('d-none');
                }


            })

        });
    })(jQuery);

    function convertToSlug(Text){
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
    }

    function previewThumnailImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview-img');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    };

</script>


@endsection
