@extends('admin.layouts.app')

@section('title')
    Reseller {{ isset($reseller) ? 'Edit' : 'Create' }}
@endsection

@section('pageName')
    Reseller {{ isset($reseller) ? 'Edit' : 'Create' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.resellers.index') }}">Reseller</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ isset($reseller) ? 'Edit' : 'Create' }}</li>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title text-uppercase">Reseller {{ isset($reseller) ? 'Edit' : 'Create' }}</h5>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.resellers.index') }}" type="button" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Back to list</a>
                    </div>
                </div>
                <hr class="mb-5">

                <form class="form-material" method="post" action="{{ isset($reseller) ? route('admin.resellers.update', $reseller->id) : route('admin.resellers.store') }}" novalidate>
                    @csrf

                    @if(isset($reseller))
                        @method('put')
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ isset($reseller) ? $reseller->name : old('name') }}" required data-validation-required-message="This field is required">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ isset($reseller) ? $reseller->email : old('email') }}" required data-validation-required-message="This field is required">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" @if (!isset($reseller)) required data-validation-required-message="This field is required" @endif>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" @if (!isset($reseller)) required data-validation-required-message="This field is required" @endif>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <div class="custom-control custom-radio custom-control-inline mt-1">
                                        <input type="radio" name="status" class="custom-control-input" id="customControlValidation2" value="approved" required="" {{ isset($reseller) && $reseller->status == 'approved' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customControlValidation2">Approved</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="status" class="custom-control-input" id="customControlValidation3" value="denied" required="" {{ isset($reseller) && $reseller->status == 'denied' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customControlValidation3">Denied</label>
                                    </div>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
