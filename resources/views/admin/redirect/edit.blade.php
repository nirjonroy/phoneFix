@extends('admin.master_layout')
@section('title')
<title>Edit Redirect</title>
@endsection
@section('admin-content')
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Redirect</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item active"><a href="{{ route('admin.redirect.index') }}">Redirects</a></div>
              <div class="breadcrumb-item">Edit Redirect</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.redirect.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> Redirects</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.redirect.update', $redirect->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Source URL <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="source_url" value="{{ $redirect->source_url }}" placeholder="/old-path">
                                </div>

                                <div class="form-group col-12">
                                    <label>Match Type <span class="text-danger">*</span></label>
                                    <select name="match_type" class="form-control">
                                        <option value="exact" {{ $redirect->match_type === 'exact' ? 'selected' : '' }}>Exact Match</option>
                                        <option value="starts_with" {{ $redirect->match_type === 'starts_with' ? 'selected' : '' }}>Starts With</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="ignore_case" id="ignore_case" {{ $redirect->ignore_case ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ignore_case">Ignore Case</label>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Destination URL</label>
                                    <input type="text" class="form-control" name="destination_url" value="{{ $redirect->destination_url }}" placeholder="https://example.com/new-path">
                                </div>

                                <div class="form-group col-12">
                                    <label>Redirect Type <span class="text-danger">*</span></label>
                                    <div>
                                        <label class="mr-3"><input type="radio" name="redirect_type" value="301" {{ $redirect->redirect_type == 301 ? 'checked' : '' }}> 301 Permanent Move</label>
                                        <label class="mr-3"><input type="radio" name="redirect_type" value="302" {{ $redirect->redirect_type == 302 ? 'checked' : '' }}> 302 Temporary Move</label>
                                        <label class="mr-3"><input type="radio" name="redirect_type" value="307" {{ $redirect->redirect_type == 307 ? 'checked' : '' }}> 307 Temporary Redirect</label>
                                        <label class="mr-3"><input type="radio" name="redirect_type" value="410" {{ $redirect->redirect_type == 410 ? 'checked' : '' }}> 410 Content Deleted</label>
                                        <label class="mr-3"><input type="radio" name="redirect_type" value="451" {{ $redirect->redirect_type == 451 ? 'checked' : '' }}> 451 Unavailable For Legal Reasons</label>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <div>
                                        <label class="mr-3"><input type="radio" name="status" value="1" {{ $redirect->status ? 'checked' : '' }}> Active</label>
                                        <label class="mr-3"><input type="radio" name="status" value="0" {{ !$redirect->status ? 'checked' : '' }}> Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
