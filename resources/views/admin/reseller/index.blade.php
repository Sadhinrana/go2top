@extends('admin.layouts.app')

@section('title', 'Resellers')

@section('pageName', 'Resellers')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Resellers</li>
@stop

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->
<div class="row">
    <div class="col-12">
        <div class="material-card card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4 class="card-title text-uppercase">Resellers</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.resellers.create') }}" type="button" class="btn btn-success btn-circle pull-right"><i class="fa fa-plus"></i> </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped border table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email verified</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resellers as $reseller)
                        <tr>
                            <td>{{ $reseller->name }}</td>
                            <td>{{ $reseller->email }}</td>
                            <td>
                                @if($reseller->email_verified_at)
                                    <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i> </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i> </button>
                                @endif
                            </td>
                            <td>
                                @if($reseller->status == 'approved')
                                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Approved</button>
                                @else
                                    <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Denied</button>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.resellers.destroy', $reseller->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('admin.resellers.edit', $reseller->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i> </a>
                                    <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure want to delete this data?')"><i class="fa fa-trash"></i> </button>
                                </form>
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
@endsection
