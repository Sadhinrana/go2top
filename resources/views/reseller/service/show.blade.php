@extends('reseller.layouts.app')

@section('title', 'Service show')

@section('pageName', 'Service show')

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-6"><h4 class="mb-0 text-white">Service show</h4></div>
                        <div class="col-md-6"><a href="{{ route('services.index') }}" type="button" class="btn btn-dark pull-right"><i class="fa fa-backward"></i> Back to list</a></div>
                    </div>
                </div>
                <form class="form-horizontal">
                    <div class="form-body">
                        <div class="card-body">
                            <h4 class="card-title">Info</h4>
                        </div>
                        <hr class="mt-0 mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Name:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->name }} </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Star:</label>
                                        <div class="col-md-9">
                                            <div class="form-control-static"><div class="{{ $service->crown }}-star"></div></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Category:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->category->name }} </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Number:</label>
                                        <div class="col-md-9">
                                            <div class="form-control-static">{{ $service->number }}</div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Type:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->type == 1 ? 'Per Thousand' : 'Package' }} </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Price:</label>
                                        <div class="col-md-9">
                                            <div class="form-control-static">{{ $service->price }}</div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Short name:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->shortname }} </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Drip feed:</label>
                                        <div class="col-md-9">
                                            <div class="form-control-static">
                                                @if($service->drip_feed)
                                                    <button type="button" class="btn btn-success btn-rounded"><i class="fa fa-check"></i> Yes</button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-rounded"><i class="fa fa-times"></i> No</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Min quantity:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->min_quantity }} </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Max quantity:</label>
                                        <div class="col-md-9">
                                            <div class="form-control-static">{{ $service->max_quantity }}</div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Icon:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                @if($service->icon)
                                                    <img src="{{ asset('storage/'.$service->icon) }}" alt="" height="25px" width="25px">
                                                @else
                                                    <button type="button" class="btn btn-danger btn-rounded"><i class="fa fa-times"></i></button>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Status:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                @if($service->status == 'active')
                                                    <button type="button" class="btn btn-success btn-rounded"><i class="fa fa-check"></i> Active</button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-rounded"><i class="fa fa-times"></i> Inactive</button>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h4 class="card-title">Short description</h4>
                        </div>
                        <hr class="mt-0 mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="control-label col-md-1"></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                {!! $service->short_description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title">Description</h4>
                        </div>
                        <hr class="mt-0 mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="control-label col-md-1"></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                {!! $service->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-danger"> <i class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('services.index') }}" class="btn btn-dark">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
@endsection
