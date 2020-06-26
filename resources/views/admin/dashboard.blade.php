@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('pageName', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@stop

@section('content')
<!-- ============================================================== -->
<!-- Card Group  -->
<!-- ============================================================== -->
<div class="card-group">
    <div class="card p-2 p-lg-3">
        <div class="p-lg-3 p-2">
            <div class="d-flex align-items-center">
                <button class="btn btn-circle btn-danger text-white btn-lg" href="javascript:void(0)">
                <i class="ti-clipboard"></i>
            </button>
                <div class="ml-4" style="width: 38%;">
                    <h4 class="font-light">Total Projects</h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                    </div>
                </div>
                <div class="ml-auto">
                    <h2 class="display-7 mb-0">23</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2 p-lg-3">
        <div class="p-lg-3 p-2">
            <div class="d-flex align-items-center">
                <button class="btn btn-circle btn-cyan text-white btn-lg" href="javascript:void(0)">
                <i class="ti-wallet"></i>
            </button>
                <div class="ml-4" style="width: 38%;">
                    <h4 class="font-light">Total Earnings</h4>
                    <div class="progress">
                        <div class="progress-bar bg-cyan" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                    </div>
                </div>
                <div class="ml-auto">
                    <h2 class="display-7 mb-0">76</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2 p-lg-3">
        <div class="p-lg-3 p-2">
            <div class="d-flex align-items-center">
                <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                <i class="fas fa-dollar-sign"></i>
            </button>
                <div class="ml-4" style="width: 38%;">
                    <h4 class="font-light">Total Earnings</h4>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                    </div>
                </div>
                <div class="ml-auto">
                    <h2 class="display-7 mb-0">83</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
