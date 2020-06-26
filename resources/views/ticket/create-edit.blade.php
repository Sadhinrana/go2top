@extends('layouts.app')

@section('title')
    Ticket {{ isset($ticket) ? 'Edit' : 'Create' }}
@endsection

@section('pageName')
    Ticket {{ isset($ticket) ? 'Edit' : 'Create' }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Ticket</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ isset($ticket) ? 'Edit' : 'Create' }}</li>
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
                        <h5 class="card-title text-uppercase">Ticket {{ isset($ticket) ? 'Edit' : 'Create' }}</h5>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('tickets.index') }}" type="button" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Back to list</a>
                    </div>
                </div>
                <hr class="mb-5">

                <form class="form-material" method="post" action="{{ isset($ticket) ? route('tickets.update', $ticket->id) : route('tickets.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    @if(isset($ticket))
                        @method('put')
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    <select name="subject" class="form-control @error('subject') is-invalid @enderror" required data-validation-required-message="This field is required">
                                        <option value="" selected>Choose type</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Order' ? 'selected' : '' }} value="Order">Order</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Payment' ? 'selected' : '' }} value="Payment">Payment</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Request' ? 'selected' : '' }} value="Request">Request</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Point' ? 'selected' : '' }} value="Point">Point</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Verification ' ? 'selected' : '' }} value="Verification ">Verification (Blue Badge)</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'ChildPanel' ? 'selected' : '' }} value="ChildPanel">ChildPanel</option>
                                        <option {{ old('subject', isset($ticket) ? $ticket->subject : '') == 'Other' ? 'selected' : '' }} value="Other">Other</option>
                                    </select>

                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    <textarea style="height: 200px" name="message" class="form-control summernote @error('message') is-invalid @enderror" placeholder="Message" required data-validation-required-message="This field is required">{{ isset($ticket) ? $ticket->message : old('message') }}</textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
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
