@extends('layouts.app_consumer')
@section('content')


    @include('frontend/orders/common/dashboard_bar')

    <section style="margin-bottom:10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link @if(Request::is('new_order')) active @endif"" href="{{url(route('single-order'))}}" aria-controls="new-order" aria-selected="true">
                                        <i class="fa fa-clone"></i> New Order
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @if(Request::is('mass_order')) active @endif" href="{{url(route('mass-order'))}}" aria-controls="mass-order" aria-selected="false">
                                        <i class="fa fa-sitemap"></i> Mass Order
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active">
                                    @include('orders/mass_order')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend/orders/common/news_layout')
            </div>
        </div>
    </section>
@endsection
