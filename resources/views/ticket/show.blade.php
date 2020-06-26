@extends('layouts.app')

@section('title', 'Ticket show')

@section('pageName', 'Ticket show')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Ticket</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ticket show</li>
@stop

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
                        <div class="col-md-6"><h4 class="mb-0 text-white">Ticket show</h4></div>
                        <div class="col-md-6"><a href="{{ route('tickets.index') }}" type="button" class="btn btn-dark pull-right"><i class="fa fa-backward"></i> Back to list</a></div>
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
                                        <label class="control-label text-right col-md-3">Status:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                @if($ticket->status == 1)
                                                    Pending
                                                @elseif($ticket->status == 2)
                                                    Resolved
                                                @elseif($ticket->status == 3)
                                                    Answer
                                                @else
                                                    User Replay
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Created at:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">{{ $ticket->created_at->format('M d, Y h:iA') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h4 class="card-title">Message</h4>
                        </div>
                        <hr class="mt-0 mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="control-label col-md-1"></label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                {!! nl2br($ticket->message) !!}
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
                                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-danger"> <i class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('tickets.index') }}" class="btn btn-dark">Cancel</a>
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
