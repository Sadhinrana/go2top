


@extends('layouts.app_consumer')
@section('content')


    <!-- Main variables *content* -->
    <div class="inner-page" style="padding: 0">
        <section>
            <div class="container">


                <div class="servie-data-panel" data-category=" 糸晶 Cheapest Promotion (By Social Army)">
                    <div class="title social-title">
                        <i></i>Services List
                    </div>
                    <div class="table-responsive-xl">
                        <table class="table table-striped  ">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col width-40">Service</th>
                                <th scope="col">Rate per 1000</th>
                                <th scope="col">Min order</th>
                                <th scope="col">Max order</th>
                                <th scope="col">Average Time <i class="fas fa-info-circle"
                                                                title="Average time taken by Last 10 Completed Orders Per 1000 Quantity"></i></th>
                                <th class="hidden-xs hidden-sm width-40">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( ! empty($cate_services) )
                                @php
                                    $serviceId=null;
                                @endphp
                                @foreach($cate_services as $category)
                                        <tr style="display: table-row">
                                            <td> <b> {{$category->name}}</b></td>
                                            <td> .</td>
                                            <td> .</td>
                                            <td> .</td>
                                            <td> .</td>
                                            <td> .</td>
                                            <td> .</td>

                                        </tr>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col width-40">Service</th>
                                            <th scope="col">Rate per 1000</th>
                                            <th scope="col">Min order</th>
                                            <th scope="col">Max order</th>
                                            <th scope="col">Average Time <i class="fas fa-info-circle"
                                                                            title="Average time taken by Last 10 Completed Orders Per 1000 Quantity"></i></th>
                                            <th class="hidden-xs hidden-sm width-40">Description</th>
                                        </tr>

                                        @if (!empty($category->services))
                                            @foreach ($category->services as $service)
                                                <tr style="display: table-row;">

                                                    <td>

                                                        <b> {{ $service->name }}</b>
                                                    </td>

                                                    <td> .</td>
                                                    <td> .</td>
                                                    <td>. </td>
                                                    <td> .</td>
                                                    <td> .</td>
                                                    <td> .</td>


                                                </tr>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col width-40">Service</th>
                                                    <th scope="col">Rate per 1000</th>
                                                    <th scope="col">Min order</th>
                                                    <th scope="col">Max order</th>
                                                    <th scope="col">Average Time <i class="fas fa-info-circle"
                                                                                    title="Average time taken by Last 10 Completed Orders Per 1000 Quantity"></i></th>
                                                    <th class="hidden-xs hidden-sm width-40">Description</th>
                                                </tr>

                                                <tr>
                                                    <td>{{ $service->id }}</td>
                                                    <td>{{ $service->name }}
                                                        <div class="rw-ui-container"></div>
                                                    </td>


                                                    <td>
                                                        <span class="badge" style="color: #8272E5">${{$service->price}}</span>
                                                    </td>
                                                    <td><span class="badge"
                                                              style="background:#4ede80; color: #fff">{{$service->min_quantity}}</span></td>
                                                    <td><span class="badge"
                                                              style="background:#2272d6; color: #fff">{{$service->max_quantity}}</span></td>
                                                    <td><span class="badge" style="background:#ff44ff; color: #fff">NOT ENOUGH DATA</span>
                                                    </td>
                                                    <td> <a href="javascript:void(0)" class="btn btn-blue icon viewMore" data-toggle="modal"
                                                            pdesc="{{ $service->description }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a> </td>
                                                </tr>
                                            @endforeach
                                    @endif

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- kraj table -->


                </div>
        </section>
    </div>
@endsection
@section('page_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script type="text/javascript">
        $(document).on("click", ".viewMore", function (e) {
            $service = $(this);
            console.log($service.attr('desc'));
            bootbox.dialog({
                title: $service.attr('pname'),
                message: $service.attr('pdesc'),
                closeButton : false,
                buttons: {
                    ok: {
                        label: "Close",
                        className: 'btn-blue',
                    }
                }
            });
        });
    </script>
@endsection


