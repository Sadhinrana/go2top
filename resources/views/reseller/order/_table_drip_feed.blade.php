
<div class="overlay-loader" id="loader-page" style="display: none">
    <div class="loader-holder">
        <img src="{{asset('loader.gif')}}" alt="">
    </div>
</div>
<div class="tab-content table-responsive-xl">
    <table class="table table-striped">
        <thead>
        <tr>
                <th> <input type="checkbox" /> </th>
            <th scope="col">ID</th>
                <th>User</th>
                <th>Total Charges</th>
                <th scope="col">Link</th>
            <th scope="col">Quantity</th>
            <th scope="col">
                    {{--<form action="{{route('reseller.orders.index')}}" method="get" class="__service_th_type__form">
                        <select name="services" id="" class="form-control service_type_filter"
                                onchange="this.form.submit()">
                            <option value="">Services</option>
                            @foreach($services as $service)
                                <option value="{{$service->id}}"> {{$service->name}} </option>
                            @endforeach
                        </select>
                    </form>--}}
                Services
            </th>

            <th scope="col">Runs</th>
            <th scope="col" width="150">Interval</th>
            <th scope="col" width="100">Date</th>
            <th scope="col">Total Quantity</th>
            <th scope="col" width="120">Status</th>
            <th scope="col" width="120">Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach($drip_feeds as $drip_feed)
            <tr>
                <td> <input type="checkbox" /> </td>
                <td>{{$drip_feed->id}}</td>
                <td>{{$drip_feed->user_name}}</td>
                <td>{{$drip_feed->total_charges}}</td>
                <td>
                    <a href="#" target="_blank" class="link"><i class="fa fa-link"></i>  {{$drip_feed->orders_link}}</a>
                </td>
                <td> {{$drip_feed->service_quantity}}</td>
                <td>{{$drip_feed->service_name}}</td>
                <td>{{$drip_feed->runOrders}} / {{$drip_feed->totalOrders}}</td>
                <td>{{$drip_feed->interval}}</td>

                <td>{{$drip_feed->total_quantity}}</td>
                <td>{{$drip_feed->created_at}} </td>

                <td class="status-value">
                    <span class="status">{{$drip_feed->status}}</span>
                </td>
                <td>
                        <div class="dropdown show goTopDropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Change status</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" onclick="changeStatus('CANCELLED',{{$drip_feed->id}})">Canceled</a></li>
                                        <li><a class="dropdown-item" onclick="changeStatus('COMPLETED',{{$drip_feed->id}})">Completed</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item disabled" onclick="cancelRefund()">Cancel and refund</a></li>
                            </ul>
                        </div>
                </td>

            </tr>
        @endforeach


        </tbody>
    </table>
</div>

<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu a::after {
        transform: rotate(90deg);
        position: absolute;
        left: 0;
        top: 18px;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: -100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });
    // order filter section

    //change status section

    let orderStatus = '';
    let order_id = null;

    function changeStatus(status, id)
    {
        $("#mi-modal").modal('show');
        orderStatus = status;
        order_id = id;
    }
    function yes()
    {
        $('#loader-page').show();
        let statusForm = new FormData;
        statusForm.append('status',orderStatus);
        fetch('drip-feed/update/'+order_id, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            body:statusForm
        })
            .then(res=>{
                if(!res.ok)
                    throw res.json();

                return res.json()
            })
            .then(res=>{
                if (res.status===200)
                {
                    $("#mi-modal").modal('hide');
                    $('#loader-page').hide();
                    window.location.reload();

                }
            }).catch(err=>{
            console.log(err);
        });
    }

    function no()
    {
        $("#mi-modal").modal('hide');
    }
    function cancelRefund() {
        alert("hello world");
    }


</script>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="yes()" >Yes</button>
                <button type="button" class="btn btn-primary"  onclick="no()">No</button>
            </div>
        </div>
    </div>
</div>
