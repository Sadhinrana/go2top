@extends('admin.layouts.app')

@section('title', 'Profile')

@section('pageName', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
@stop

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Profile update</h5>

                <form class="form-material" method="post" action="{{ route('admin.profile.update') }}" novalidate>
                    @csrf

                    @method('put')

                    <div class="form-group">
                        <div class="controls">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name }}" required data-validation-required-message="This field is required">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Email update</h5>

                <form class="form-material" method="post" action="{{ route('admin.email.update') }}" novalidate>
                    @csrf

                    @method('put')

                    <div class="form-group">
                        <div class="controls">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Current Email" required data-validation-required-message="This field is required">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <input type="email" name="new_email" class="form-control @error('new_email') is-invalid @enderror" placeholder="New Email" required data-validation-required-message="This field is required">

                            @error('new_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <input type="email" name="new_email_confirmation" class="form-control" placeholder="Confirm New Email" required data-validation-required-message="This field is required">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Password update</h5>

                <form class="form-material" method="post" action="{{ route('admin.password.update') }}" novalidate>
                    @csrf

                    @method('put')

                    <div class="form-group">
                        <div class="controls">
                            <input type="password" name="password" min="8" class="form-control @error('password') is-invalid @enderror" placeholder="Current Password" required data-validation-required-message="This field is required">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <input type="password" name="new_password" min="8" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password" required data-validation-required-message="This field is required">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <input type="password" name="new_password_confirmation" min="8" class="form-control" placeholder="Confirm New Password" required data-validation-required-message="This field is required">
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
