
<style>
    .service_type_tags{
        padding: 5px;
        background: #d6d6d6;
        color: #000;
        border-radius: 5px;
        font-size: 10px;
    }
    .top-caret-bar .dropdown-submenu .dropdown-menu{
       left: 100% !important;
    } 
</style>
<div class="overlay-loader" id="loader-page" style="display: none">
    <div class="loader-holder">
        <img src="{{asset('loader.gif')}}" alt="">
    </div>
</div>
<div class="tab-content table-responsive-xl" id="orders_tble">
    <div class="d-flex top-caret-bar">
        <div v-if="service_checkbox.length >0" class="d-flex service-checkbox-action bg-danger">
            <div>
                <span style="color:#fff; padding: 0px 5px">Order Selected @{{ service_checkbox.length }}</span>
            </div>
            <div class="dropdown show">
                <a class="btn btn-sm dropdown-toggle" style="background: #fff; border: 1px solid #d4d4d4" href="#" role="button" id="dropdownMenuLink" 
                data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Actions
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" @click="bulkStatusChange('cancel_refund')">Cancal and refund</a></li>
                    <li><a class="dropdown-item" @click="bulkStatusChange('pending')">Pending</a></li>
                    <li><a class="dropdown-item" @click="bulkStatusChange('inprogress')">In Progress</a></li>
                    <li><a class="dropdown-item" @click="bulkStatusChange('processing')">Processing</a></li>
                    <li><a class="dropdown-item" @click="bulkStatusChange('completed')">Completed</a></li>
                </ul>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                @if($role=='admin')
                    <th> <input type="checkbox" @click="bulkSelect" /></th>
                @endif
                <th scope="col">ID</th>
                @if($role=='admin')
                    <th>
                        <form action="{{route('reseller.orders.index')}}" method="get" class="__service_th_type__form">
                            <select name="user" class="form-control service_type_filter"
                                    onchange="this.form.submit()">
                                <option value="">Users</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"> {{$user->username}} </option>
                                @endforeach
                            </select>
                        </form>
                    </th>
                @endif
                <th scope="col">Charge</th>
                <th scope="col">Link</th>
                <th scope="col" width="150">Start count</th>
                <th scope="col">Quantity</th>
                <th scope="col">
                    @if($role=='admin')
                        <form action="{{route('reseller.orders.index')}}" method="get" class="__service_th_type__form">
                            <select name="services" class="form-control service_type_filter"
                                    onchange="this.form.submit()">
                                <option value="">Services</option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}"> {{$service->name}} </option>
                                @endforeach
                            </select>
                        </form>
                        @else
                        Service
                        @endif
                </th>
                <th scope="col" width="120">Status</th>
                @if($role=='admin')
                    <th>Remains</th>
                @endif
                <th scope="col" width="100">Created</th>
                @if($role=='admin')
                    <th>Mode</th>
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                @if($role=='admin')
                    <td> <input type="checkbox" name="service_checkbox" class="service_checkbox" v-model="service_checkbox"
                        value="{{$order->id}}" /> </td>
                @endif
                <td>{{$order->order_id}}</td>
                @if($role=='admin')
                    <td>{{$order->username}}
                        @if($order->drip_feed_id != null)
                            <span class="badge badge-secondary">Drip Feed</span>
                            @endif
                    </td>
                @endif
                <td> {{$order->charges}}</td>
                <td>
                    <a href="#" target="_blank" class="link"><i class="fa fa-link"></i>  {{$order->link}}</a>
                    @if ($order->service_type == 'SEO')
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Keywords</a>
                    @elseif ($order->service_type == 'SEO2')
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Keywords</a>
                        <a  class="service_type_tags" @click="modalVIsible('additional_comment_owner_username_visible', {{$order}} )">Email</a>
                    @elseif($order->service_type == 'Custom Comments' || $order->service_type == 'Custom Comments Package')
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Comments</a>
                    @elseif($order->service_type == 'Comment Likes' || $order->service_type == 'Mentions Users Followers' )
                        <a  class="service_type_tags" @click="modalVIsible('additional_comment_owner_username_visible', {{$order}} )">Username</a>
                    @elseif($order->service_type == 'Mentions Custom List' || $order->service_type == 'Mentions')
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Username</a>
                    @elseif($order->service_type == 'Mentions with Hashtags')
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Username</a>
                        <a  class="service_type_tags" @click="modalVIsible('text_area_2', {{$order}} )">Hastags</a>
                    @elseif($order->service_type == 'Comment Replies')
                        <a  class="service_type_tags" @click="modalVIsible('additional_comment_owner_username_visible', {{$order}} )">Username</a>
                        <a  class="service_type_tags" @click="modalVIsible('text_area_1', {{$order}} )">Comments</a>
                    @elseif($order->service_type == 'Mentions Hashtag')
                        <a  class="service_type_tags" @click="modalVIsible('additional_comment_owner_username_visible', {{$order}} )">Hastags</a>
                    @elseif($order->service_type == 'Mentions Media Likers')
                        <a  class="service_type_tags" @click="modalVIsible('additional_comment_owner_username_visible', {{$order}} )">Mediua URLs</a>
                    @endif
                </td>
                <td>{{$order->start_counter}}</td>
                <td> {{$order->quantity}}</td>
                <td>{{$order->service->name}}</td>
                <td class="status-value">
                    @if ($page_name == 'tasks')
                        <span class="status">{{$order->refill_order_status}}</span>
                    @else
                         <span class="status">
                                 @if (array_key_exists($order->order_id, $auto_order_statuss))
                                        {{$auto_order_statuss[$order->order_id]}}
                                 @else
                                     {{$order->status}}
                                 @endif
                             
                            </span>
                    @endif
                </td>
                @if($role=='admin')
                    <td>{{$order->remains}}</td>
                @endif
                <td>
                    {{$order->created_at}}
                </td>
                <td> 
                    {{ ucfirst($order->mode) }}
                    @if($role=='user')
                        @if ($order->status == 'completed' && $order->refill_order_status == null)
                        <form action="{{route('user.changeRefillStatus')}}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="order_table_id" value="{{$order->id}}">
                            <input type="hidden" name="order_id" value="{{$order->order_id}}">
                            <input type="hidden" name="refill_order_status" value="processing">
                            <button type="submit" style="background: #77b243;
                            color: white;
                            border: none;
                            padding: 0 10px;
                            cursor: pointer;">Refill</button>
                        </form>
                        @elseif ($order->status == 'completed' && ($order->refill_order_status == 'success' || $order->refill_order_status == 'pending'))
                            <span class="badge badge-primary">refilling</span>
                        @endif
                    @endif
                </td>
                @if($role=='admin' && $page_name == 'order_index')
                <td>
                    <div class="dropdown show goTopDropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @if ($order->mode != 'auto' && $order->status != 'cancelled')
                                <li><a class="dropdown-item" onclick="popModal('link','{{$order->link}}', {{$order->id}})">Edit Link</a></li>
                                <li><a class="dropdown-item" onclick="popModal('start_count','{{$order->start_counter}}',{{$order->id}})">Set Start Count</a></li>
                                <li><a class="dropdown-item" onclick="popModal('remain','{{$order->remains}}',{{$order->id}})">Set Remain</a></li>
                                <li><a class="dropdown-item" onclick="popModal('partial','{{$order->remains}}',{{$order->id}})">Set Partial</a></li>
                                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Change status</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" onclick="changeStatus('inprogress',{{$order->id}})">In Progress</a></li>
                                        <li><a class="dropdown-item" onclick="changeStatus('processing',{{$order->id}})">Processing</a></li>
                                        <li><a class="dropdown-item" onclick="changeStatus('completed',{{$order->id}})">Completed</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item"  onclick="changeStatus('cancel_refund',{{$order->id}})">Cancel and refund</a></li>
                            @else
                                <li><a class="dropdown-item" href="#">Detail</a></li>
                            @endif
                            
                         
                        </ul>
                    </div>
                </td>
                @elseif($role=='admin' && $page_name=='tasks')
                    <td>
                        <div class="dropdown show goTopDropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if($order->refill_order_status == 'pending')
                                    <li>
                                        <form action="{{route('reseller.task.change.status')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_table_id"  value="{{$order->id}}" />
                                            <input type="hidden" name="order_id"  value="{{$order->order_id}}" />
                                            <input type="hidden" name="refill_order_status"  value="success" />
                                            <button class="dropdown-item">Success</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{route('reseller.task.change.status')}}" method="post">
                                            @csrf
                                        <input type="hidden" name="order_table_id"  value="{{$order->id}}" />
                                        <input type="hidden" name="order_id"  value="{{$order->order_id}}" />
                                        <input type="hidden" name="refill_order_status"  value="rejected" />
                                                <button class="dropdown-item">Reject</button>
                                        </form>
                                    </li>
                                @else
                                <li>
                                    <form action="#" method="post">
                                        @csrf
                                            <button type="button" class="dropdown-item">Details</button>
                                    </form>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                @endif
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>

setTimeout(function () {
     $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        //alert('dafs');
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });
     }, 5000);



    // order filter section

    let visiblelink = false;
    let visibleStartCount = false;
    let visiblePartical = false;
    let visibleRemain = false;

    let datalink = null;
    let dataStartCount = null;
    let dataRemain = null;
    let dataPartical = null;

    let editable_id = null;
    function popModal(field, data, id) {
        if (field === 'link')
        {
            $('#link_id').show();
            $('#start_count_id').hide();
            $('#remain_id').hide();
             visiblelink = true;
             visibleStartCount = false;
             visiblePartical = false;
             visibleRemain = false;
            $('#link_id').find('input').val(data);
        }
        else if (field === 'start_count')
        {
            $('#link_id').hide();
            $('#start_count_id').show();
            $('#remain_id').hide();
            visiblelink = false;
            visibleStartCount = true;
            visiblePartical = false;
            visibleRemain = false;
            $('#start_count_id').find('input').val(data);
        }
        else if (field === 'remain')
        {
            $('#link_id').hide();
            $('#start_count_id').hide();
            $('#partial_id').hide();
            $('#remain_id').show();
            visiblelink = false;
            visibleStartCount = false;
            visiblePartical = false;
            visibleRemain = true;
            $('#remain_id').find('input').val(data);
        }
        else if (field === 'partial')
        {
            $('#link_id').hide();
            $('#start_count_id').hide();
            $('#remain_id').hide();
            $('#partial_id').show();
            visiblelink = false;
            visibleStartCount = false;
            visiblePartical = true;
            visibleRemain = false;
            $('#partial_id').find('input').val(data);
        }
        editable_id = id;
        $('#orderEdit-modal').modal('show');
    }

    function  update_service (evt)
    {
        $('#loader-page').show();

        let statusForm = new FormData;
        if (visiblelink === true)
        {
            statusForm.append('link',$('input[name=link]').val());
        }
        else if (visibleStartCount === true)
        {
            statusForm.append('start_counter',$('input[name=start_counter]').val());
        }
        else if (visiblePartical === true)
        {
            statusForm.append('partial', $('input[name=partial]').val());
        }
        else if (visibleRemain === true)
        {
            statusForm.append('remains', $('input[name=remains]').val());
        }

        fetch('orders/update/'+editable_id, {
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
        fetch('orders/update/'+order_id, {
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
    function service_type_modal()
    {
        $("#order_service_type_detail").modal('hide');
    }
    const App = new Vue({
            el: '#orders_tble',
            data: {
                service_checkbox: [],
                bulk_select: false,
                text_area_1: '',
            },
            methods: {
                modalVIsible(type, obj){

                    $("#order_service_type_detail").modal('show');
                    let d = '';
                    if (type  === 'text_area_1') {
                        d = obj.text_area_1;
                    }
                    else if (type  === 'additional_comment_owner_username_visible') {
                        d = obj.additional_inputs;
                    }
                    else if (type  === 'text_area_2') {
                        d = obj.text_area_2;
                    }
                    $('#order-modal-detail').html(d);
                },
                bulkSelect()
                {
                    if (!this.bulk_select) {
                        let allids = [];
                        $('.service_checkbox').each(function (i, v) {
                            allids.push($(this).val());
                        });
                        this.service_checkbox = allids;
                        this.bulk_select = true;
                    }
                    else
                    {
                        this.service_checkbox = [];
                        this.bulk_select = false;
                    }
                },
                bulkStatusChange(status) {
                    $('#loader-page').show();
                    if (this.service_checkbox.length !== 0) {
                        let forD = new FormData();
                        forD.append('service_ids', this.service_checkbox);
                        forD.append('status', status);
                        fetch('{{route("reseller.order.reseller.update.status")}}', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body: forD,
                        }).then(res => res.json())
                            .then(res => {
                                if (res.status === 200) {
                                    setTimeout(() => {
                                        $('#loader-page').hide();
                                        toastr["success"](res.message);
                                        window.location.reload();
                                    }, 2000);
                                }

                                console.log(res);
                            })
                    } else {
                        alert('No check box is selected');
                    }
                },
            }
        });
</script>

<div class="modal fade" id="orderEdit-modal" tabindex="-1" role="dialog"
     aria-labelledby="orderEdit-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered __modal_dialog_custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post"
                      action="#"
                      id="formDescription"  >
                    <input type="hidden" name="id" >
                    <div class="row">
                        <div class="col-md-12" id="link_id" style="display: none">
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="url" class="form-control" name="link">
                            </div>
                        </div>
                        <div class="col-md-12" id="start_count_id" style="display: none">
                            <div class="form-group">
                                <label for="start_counter">Set Start Count</label>
                                <input type="number" class="form-control" name="start_counter" >
                            </div>
                        </div>
                        <div class="col-md-12" id="remain_id" style="display: none">
                            <div class="form-group">
                                <label for="remains">Remain</label>
                                <input type="number" class="form-control" name="remains" >
                            </div>
                        </div>
                        <div class="col-md-12" id="partial_id" style="display: none">
                            <div class="form-group">
                                <label for="partial">Partials</label>
                                <input type="number" class="form-control" name="partial" >
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" onclick="update_service()" class="btn btn-success"><i class="fa fa-check"></i> update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="order_service_type_detail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                Order Detail
            </div>
            <div class="modal-body">
                <p id="order-modal-detail">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, amet non 
                    ullam magni voluptatem illum id 
                    corrupti adipisci repellat veritatis, nemo vel! Incidunt laudantium ut nihil ullam repellendus rerum fuga?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="service_type_modal()">close</button>
            </div>
        </div>
    </div>
</div>
