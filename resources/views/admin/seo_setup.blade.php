@extends('admin.master_layout')
@section('title')
<title>{{__('admin.SEO Setup')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.SEO Setup')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.SEO Setup')}}</div>
            </div>
          </div>

          <div class="section-body">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    @foreach ($pages as $index => $page)
                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link {{ $index == 0  ? 'active' : '' }}" id="error-tab-{{ $page->id }}" data-toggle="tab" href="#errorTab-{{ $page->id }}" role="tab" aria-controls="errorTab-{{ $page->id }}" aria-selected="true">{{ $page->page_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9">
                                <div class="border rounded">
                                    <div class="tab-content no-padding" id="settingsContent">
                                        @foreach ($pages as $index => $page)
                                            <div class="tab-pane fade {{ $index == 0  ? 'show active' : '' }}" id="errorTab-{{ $page->id }}" role="tabpanel" aria-labelledby="error-tab-{{ $page->id }}">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-seo-setup',$page->id) }}" method="POST" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.SEO Title')}}</label>
                                                                        <input type="text" name="seo_title" class="form-control" value="{{ $page->seo_title }}">
                                                                    </div>
                                                                </div>



                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.SEO Description')}}</label>
                                                                        <textarea name="seo_description" id="" cols="30" rows="5" class="form-control text-area-5">{{ $page->seo_description }}</textarea>

                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Title</label>
                                                                        <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Description</label>
                                                                        <textarea name="meta_description" id="" cols="30" rows="5" class="form-control text-area-5">{{ $page->meta_description }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Image</label>
                                                                        <input type="file" name="meta_image" class="form-control">
                                                                        @if ($page->meta_image)
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset($page->meta_image) }}" alt="Meta image" style="max-height: 160px;">
                                                                            </div>
                                                                            <div class="form-check mt-2">
                                                                                <input class="form-check-input" type="checkbox" name="remove_meta_image" id="removeMetaImage-{{ $page->id }}" value="1">
                                                                                <label class="form-check-label" for="removeMetaImage-{{ $page->id }}">
                                                                                    Remove Meta Image
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Author</label>
                                                                        <input type="text" name="author" class="form-control" value="{{ $page->author }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Publisher</label>
                                                                        <input type="text" name="publisher" class="form-control" value="{{ $page->publisher }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Copyright</label>
                                                                        <input type="text" name="copyright" class="form-control" value="{{ $page->copyright }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Site Name</label>
                                                                        <input type="text" name="site_name" class="form-control" value="{{ $page->site_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">Meta Keywords</label>
                                                                        <textarea name="keywords" id="" cols="30" rows="3" class="form-control text-area-5">{{ $page->keywords }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
