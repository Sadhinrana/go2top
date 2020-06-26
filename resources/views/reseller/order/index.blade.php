@extends('reseller.layouts.app')

@section('title', 'Orders')

@section('pageName', 'Orders')

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
                            <ul class="list-group d-flex flex-row reseller_order_filter_lists">
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="all">
                                        <button type="submit" class="btn btn-link">All</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="PENDING">
                                        <button type="submit" class="btn btn-link">Pending</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="INPROGRESS">
                                        <button type="submit" class="btn btn-link">In Progress</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="COMPLETED">
                                        <button type="submit" class="btn btn-link">Completed</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="PARTIAL">
                                        <button type="submit" class="btn btn-link">Partial</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-link">Cancelled</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="PROCESSING">
                                        <button type="submit" class="btn btn-link">Processing</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="FAILED">
                                        <button type="submit" class="btn btn-link">Failed</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('reseller.orders.index') }}" method="GET">
                                        <input type="hidden" name="status" value="ERROR">
                                        <button type="submit" class="btn btn-link">Error</button>
                                    </form>
                                </li>
                            </ul>
                    </div>
                    <div class="col-md-6">
                        <form class="d-flex pull-right" method="get" action="{{ route('reseller.orders.index') }}">
                            <div>
                                <a href="{{ route('reseller.exported_orders.index') }}" class="btn btn-link">Export</a>
                            </div>
                            <div class="form-group mb-2 mr-0">
                                <input type="search" name="search" class="form-control" placeholder="search...">
                            </div>
                            <div class="form-group mb-2 ml-0">
                                <select name="filter_type" id="filter_type" class="form-control">
                                    <option value="order_id">Order ID</option>
                                    <option value="link">Link</option>
                                    <option value="username">Username</option>
                                    <option value="service_id">Service ID</option>
                                    <option value="null">External ID</option>
                                    <option value="null">Provider</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default mb-2" style="border:1px solid #eeeff0;"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    @include('orders._table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script !src="">
        function updateOrder(id) {
            $('#quantity').val($('input[name=quantity' + id + ']').val()).attr('name', 'quantity' + id);
            $('#start_counter').val($('input[name=start_counter' + id + ']').val()).attr('name', 'start_counter' + id);
            $('#remains').val($('input[name=remains' + id + ']').val()).attr('name', 'remains' + id);
            $('#status').val($('#status' + id).val()).attr('name', 'status' + id);

            $('#order-update-form').attr('action', 'orders/' + id).submit();
        }
    </script>
@endsection
