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
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="all">
                                        <button type="submit" class="btn btn-link">All</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn btn-link">PENDING</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" class="btn btn-link">PROCESSING</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="success">
                                        <button type="submit" class="btn btn-link">SUCCESSS</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-link">REJECTED</button>
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-link">CANCELED</button>
                                    </form>
                                </li>
                                
                                <li class="list-group-item">
                                    <form action="{{route('reseller.order.tasks')}}" method="GET">
                                        <input type="hidden" name="status" value="error">
                                        <button type="submit" class="btn btn-link">ERROR</button>
                                    </form>
                                </li>
                            </ul>
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline pull-right" method="get" action="{{ route('reseller.orders.index') }}">
                            <a href="#" class="btn btn-link">Export</a>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" name="seach" class="form-control" placeholder="search...">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
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
