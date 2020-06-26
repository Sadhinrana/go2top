@extends('layouts.app_consumer')
@section('content')

    <section class="service-search-panel">
        <div class="container">
            <div class="search-panel">
                <form action="https://thesocialmediagrowth.com/orders" method="get" id="history-search" class="has-validation-callback">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" name="status" value="all">
                            <input type="text" name="keyword" class="form-control" value="" placeholder="Search orders">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-green"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="tabs-wrapper">
                        <ul class="nav nav-justified nav-tabs dragscroll horizontal ">
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('orderHistories')}}">
                                    <i class="fa fa-list-ul"></i> All
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'PENDING'])}}">
                                    <i class="fa fa-clock"></i> Pending
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'PROCESSING'])}}">
                                    <i class="fa fa-chart-line"></i> Processing
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'INPROGRESS'])}}">
                                    <i class="fa fa-spinner"></i> In progress
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'COMPLETED'])}}">
                                    <i class="fa fa-check"></i> Completed
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'PARTIAL'])}}">
                                    <i class="fa fa-hourglass-half"></i> Partial
                                </a>
                            </li>
                            <li class="nav-item " >
                                <a class="nav-link" href="{{route('orderHistories',['query'=>'CANCELLED'])}}">
                                    <i class="fa fa-times-circle"></i> Canceled
                                </a>
                            </li>
                        </ul>
                    </div>
                    @include('orders/_table')
                </div>
            </div>
        </div>
    </section>


@endsection
