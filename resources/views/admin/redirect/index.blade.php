@extends('admin.master_layout')
@section('title')
<title>Redirects</title>
@endsection
@section('admin-content')
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Redirects</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Redirects</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.redirect.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Redirect</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('admin.SN')}}</th>
                                    <th width="20%">Source URL</th>
                                    <th width="10%">Match Type</th>
                                    <th width="10%">Case</th>
                                    <th width="25%">Destination URL</th>
                                    <th width="8%">Type</th>
                                    <th width="10%">{{__('admin.Status')}}</th>
                                    <th width="12%">{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($redirects as $index => $redirect)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $redirect->source_url }}</td>
                                        <td>{{ $redirect->match_type === 'starts_with' ? 'Starts With' : 'Exact Match' }}</td>
                                        <td>
                                            @if ($redirect->ignore_case)
                                                <span class="badge badge-info">Ignore Case</span>
                                            @else
                                                <span class="badge badge-secondary">Case Sensitive</span>
                                            @endif
                                        </td>
                                        <td>{{ $redirect->destination_url ?? '-' }}</td>
                                        <td>{{ $redirect->redirect_type }}</td>
                                        <td>
                                            <a href="javascript:;" onclick="changeRedirectStatus({{ $redirect->id }})">
                                                <input type="checkbox" {{ $redirect->status ? 'checked' : '' }} data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.redirect.edit',$redirect->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $redirect->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/redirect/") }}'+"/"+id)
    }

    function changeRedirectStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/redirect-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){
                console.log(err);
            }
        })
    }
</script>
@endsection
