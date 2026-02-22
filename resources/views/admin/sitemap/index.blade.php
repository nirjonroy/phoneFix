@extends('admin.master_layout')
@section('title')
<title>Sitemap</title>
@endsection
@section('admin-content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sitemap</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Sitemap</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sitemap Settings</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sitemap.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Default Changefreq</label>
                                    <input type="text" class="form-control" name="default_changefreq" value="{{ $settings->default_changefreq }}">
                                </div>
                                <div class="form-group">
                                    <label>Default Priority (0.0 - 1.0)</label>
                                    <input type="text" class="form-control" name="default_priority" value="{{ $settings->default_priority }}">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_home" name="include_home" {{ $settings->include_home ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_home">Include Home</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_services_page" name="include_services_page" {{ $settings->include_services_page ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_services_page">Include Services Page</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_categories" name="include_categories" {{ $settings->include_categories ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_categories">Include Categories</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_sub_categories" name="include_sub_categories" {{ $settings->include_sub_categories ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_sub_categories">Include Sub Categories</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_child_categories" name="include_child_categories" {{ $settings->include_child_categories ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_child_categories">Include Child Categories</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_products" name="include_products" {{ $settings->include_products ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_products">Include Products/Services</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_blogs" name="include_blogs" {{ $settings->include_blogs ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_blogs">Include Blogs</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_pages" name="include_pages" {{ $settings->include_pages ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_pages">Include Custom Pages</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="include_manual" name="include_manual" {{ $settings->include_manual ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="include_manual">Include Manual URLs</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary">Update Settings</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manual URLs</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sitemap.urls.store') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>URL</label>
                                        <input type="text" class="form-control" name="loc" placeholder="https://example.com/page">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label>Changefreq</label>
                                        <input type="text" class="form-control" name="changefreq" placeholder="weekly">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label>Priority</label>
                                        <input type="text" class="form-control" name="priority" placeholder="0.7">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label>Lastmod</label>
                                        <input type="date" class="form-control" name="lastmod">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="status_new" name="status" checked>
                                            <label class="custom-control-label" for="status_new">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button class="btn btn-primary">Add URL</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>URL</th>
                                            <th>Changefreq</th>
                                            <th>Priority</th>
                                            <th>Lastmod</th>
                                            <th>Status</th>
                                            <th style="width: 140px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($urls as $url)
                                            <tr>
                                                <form action="{{ route('admin.sitemap.urls.update', $url->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td><input type="text" class="form-control" name="loc" value="{{ $url->loc }}"></td>
                                                    <td><input type="text" class="form-control" name="changefreq" value="{{ $url->changefreq }}"></td>
                                                    <td><input type="text" class="form-control" name="priority" value="{{ $url->priority }}"></td>
                                                    <td><input type="date" class="form-control" name="lastmod" value="{{ $url->lastmod }}"></td>
                                                    <td class="text-center">
                                                        <input type="checkbox" name="status" {{ $url->status ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-success">Save</button>
                                                        <a href="{{ route('admin.sitemap.urls.destroy', $url->id) }}"
                                                           class="btn btn-sm btn-danger"
                                                           onclick="event.preventDefault(); document.getElementById('delete-sitemap-{{ $url->id }}').submit();">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </form>
                                                <form id="delete-sitemap-{{ $url->id }}" action="{{ route('admin.sitemap.urls.destroy', $url->id) }}" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No URLs added</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
