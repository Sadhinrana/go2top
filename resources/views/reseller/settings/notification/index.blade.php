@extends('reseller.layouts.app')

@section('title', 'Notification')

@section('pageName', 'Notification')

@section('content')

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
.switch-custom .switch{position:relative;display:inline-block;width:34px;height:18px;margin-bottom:0;padding-bottom:0}
.switch-custom .switch input{display:none}
.switch-custom .slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:#e6e6e6;-webkit-transition:.4s;transition:.4s}
.switch-custom .slider:before{position:absolute;content:"";height:14px;width:14px;bottom:2px;left:2px;background-color:#fff;-webkit-transition:.4s;transition:.4s;border-radius: 10px}
.switch-custom input:checked+.slider{background-color:#3479b7}
.switch-custom input:focus+.slider{box-shadow:0 0 1px #3479b7}
.switch-custom input:checked+.slider:before{-webkit-transform:translateX(16px);-ms-transform:translateX(16px);transform:translateX(16px)}
.switch-custom input:disabled+.slider{opacity:.3;cursor:no-drop}
.switch-custom .slider.round{border-radius:34px}
.switch-custom__table .switch{vertical-align:-6px}
.round { color: #fff; width: 34px !important;height: 18px !important;display: inline-block;text-align: center;line-height: 28px !important;}
.table {border: 1px solid #ddd;margin-bottom: 10px;}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;}
.p-l {padding-left: 15px!important;}
.btn-xs, .ticket-btn-group>.btn {padding: 1px 7px;}
.btn-group-xs>.btn, .btn-xs { padding: 1px 5px;font-size: 12px;line-height: 1.5;border-radius: 3px;}
.btn-default {color: #333;border-color: #ccc;}
.btn {display: inline-block;padding: 3px 8px;margin-bottom: 0;text-align: center;-ms-touch-action: manipulation;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;border-radius: 4px;}
ul.list-group {background: none;}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {z-index: 2; color: #fff; background-color: #ededed;border-color: #dddddd; } 
.list-group-item:hover{ background-color: #ededed; color: #dddddd; cursor: pointer; text-decoration: none; }
.list-group-item a:active{ color: #dddddd;}
li.list-group-item { background: none; }
.add-page{ margin-bottom: 8px;}
.settings-menu__description { font-size: 12px; color: #adadad;}
.settings-menu__row {margin-bottom: 15px;}
.settings-menu__row:first-child {margin-top: 9px;}
.settings-menu__drag svg {width: 12px;height: 14px;vertical-align: -2px;cursor: move;cursor: grab; cursor: -moz-grab;cursor: -webkit-grab;}
.dd {position: relative;display: block;margin-bottom: 10px;padding: 0;list-style: none;font-size: 13px;line-height: 20px;}
.dd-list {display: block;position: relative;margin: 0;padding: 0;list-style: none;}
.dd-list .dd-item:first-child .dd-handle {-webkit-border-top-left-radius: 4px;-webkit-border-top-right-radius: 4px;-moz-border-radius-topleft: 4px;-moz-border-radius-topright: 4px;border-top-left-radius: 4px;border-top-right-radius: 4px;}
.dd-handle {background: #fff;display: block;height: 40px;padding: 5px 10px;color: #333;line-height: 2;text-decoration: none;font-size: 14px;border-bottom: 1px solid #ccc;box-sizing: border-box;-moz-box-sizing: border-box;cursor: move;cursor: grab;cursor: -moz-grab;cursor: -webkit-grab;}
.settings-menu__drag {margin-right: 4px;display: inline-block;}
.settings-menu__drag svg {width: 12px;height: 14px;vertical-align: -2px;cursor: move;cursor: grab;cursor: -moz-grab;cursor:-webkit-grab;}
.dd-empty, .dd-item, .dd-placeholder {display: block;position: relative;height: 40px;margin: 0;padding: 0;min-height: 20px;font-size: 13px;line-height: 20px;}
.dd-list {border: 1px solid #ccc;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
.dd-list .dd-item:last-child .dd-handle {border-bottom: none;-webkit-border-bottom-right-radius: 4px;-webkit-border-bottom-left-radius: 4px;-moz-border-radius-bottomright: 4px;-moz-border-radius-bottomleft: 4px;border-bottom-right-radius: 4px;border-bottom-left-radius: 4px;}
.settings-menu__action {position: absolute;z-index: 3;top: 9px;right: 15px;}
.settings-emails__block {position: relative;margin-bottom: 25px;}
.settings-emails__block-body {border: 1px solid #ddd; border-radius: 4px;overflow: hidden;}
.settings-emails__block-title {font-size: 18px;font-weight: 500;padding-bottom: 8px;}
.settings-emails__block-body thead {height: 0;}
.settings-emails__th-name {width: 800px;}
.settings-emails__block-body thead th {height: 0;}
.settings-emails__row {border-bottom: 1px solid #ddd;}
.settings-emails__row td {padding: 10px 12px;}
.settings-emails__row-description {font-size: 12px;color: #777;}
.modal-backdrop {z-index: 999;}
.module-table{width: 100%;}
.settings-emails__td-actions{ text-align:  right;}
.submit-update-section { text-align: left; }
.popover.fade.top.in { width: 128px;}
.settings-emails__list-body {-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;border: 1px solid #ddd;}
.settings-emails__list-row {border-bottom: 1px solid #ddd;position: relative;padding: 8px 12px;}
.settings-emails__list-row-action {position: absolute;right: 12px;top: 6px;}
.settings-emails__list-title {font-weight: 700;margin-bottom: 5px;}
@media only screen and (min-width: 700px){
.dd {float: left;width: 100%;}
}
</style>

@include('reseller.settings.nav')

@if (!empty($success))
    <h1>{{$success}}</h1>
@endif         
<div class="col-md-8">

    @if(!$cms_notification->isEmpty())
    <div class="settings-emails__block">
        <div class="settings-emails__block-title">
            Users notifications    
        </div>
    
        <div class="settings-emails__block-body">
            <table class="module-table">
                <thead>
                    <tr>
                        <th class="settings-emails__th-name"></th>
                        <th class="settings-emails__th-actions"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cms_notification as $user_notification)
                        @if ($user_notification->type == 1)
                            <tr class="settings-emails__row">
                                <td>
                                    <div class="settings-emails__row-name">{{ $user_notification->title }}</div>
                                    <div class="settings-emails__row-description">
                                        {{ $user_notification->description }}                       
                                    </div>
                                </td>
                                <td>{{ $user_notification->status == '1' ? 'Enabled' : 'Disabled' }}</td>
                                <td class="settings-emails__td-actions">
                                    <a href="{{ route('reseller.setting.notification.edit', $user_notification->id) }}"  class="btn btn-xs btn-default edit-module">
                                        Edit                        
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if(!$cms_notification->isEmpty())
    <div class="settings-emails__block">

        <div class="settings-emails__block-title">
            Staff notifications        
        </div>

        <div class="settings-emails__block-body">
            <table class="module-table">
                <thead>
                    <tr>
                        <th class="settings-emails__th-name"></th>
                        <th class="settings-emails__th-actions"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cms_notification as $staff_notification)
                        @if ($staff_notification->type == '2')
                            <tr class="settings-emails__row">
                                <td>
                                    <div class="settings-emails__row-name">{{ $staff_notification->title }}</div>
                                    <div class="settings-emails__row-description">
                                        {{ $staff_notification->description }}                       
                                    </div>
                                </td>
                                <td>{{ $staff_notification->status == '1' ? 'Enabled' : 'Disabled' }}</td>
                                <td class="settings-emails__td-actions">
                                    <a href="{{ route('reseller.setting.notification.edit', $staff_notification->id) }}" class="btn btn-xs btn-default edit-module">
                                        Edit                        
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endif

    <div class="settings-emails__block">

        <div class="settings-emails__block-title">
            Staff Email        
        </div>

        <div class="settings-emails__block-body">
            <table class="module-table">
                <thead>
                    <tr>
                        <th class="settings-emails__th-name"></th>
                        <th class="settings-emails__th-actions"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cms_staff_email as $staff_email)
                        @php
                            $count_notification = 0;
                        @endphp

                        @if ($staff_email->payment_received == 1) 
                            @php
                                $count_notification++;
                            @endphp
                        @endif

                        @if ($staff_email->new_manual_orders == 1)
                            @php
                                $count_notification++;
                            @endphp
                        @endif

                        @if ($staff_email->fail_orders == 1)
                            @php
                                $count_notification++;
                            @endphp
                        @endif

                        @if ($staff_email->new_messages == 1)
                            @php
                                $count_notification++;
                            @endphp
                        @endif

                        @if ($staff_email->new_manual_payout == 1)
                            @php
                                $count_notification++;
                            @endphp
                        @endif
                        
                        <tr class="settings-emails__row">
                            <td>
                                <div class="settings-emails__row-name">{{ $staff_email->email }}</div>
                            </td>
                            <td>{{ $count_notification }} notifications</td>
                            <td class="settings-emails__td-actions">
                                <a href="javascript:void(0)"  onclick="editStaffEmail({{ $staff_email->id }})" class="btn btn-xs btn-default edit-module">
                                    Edit                        
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="settings-emails__block-acitons">
        <a class="btn btn-default" href="javascript:void();" data-toggle="modal" data-target="#cmsStaffEmailModal">
            Add email        
        </a>
    </div>

</div>

    <!--Start:create Modal-->
    <div class="modal fade in" id="cmsStaffEmailModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form class="form-material" id="moduleEditForm" method="post" action="{{ route('reseller.setting.staff.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Add email</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">

                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>            
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" />
                            @error('email')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="settings-emails__list">
                            <div class="settings-emails__list-title">
                                Notifications
                            </div>
                            <div class="settings-emails__list-body">
                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">Payment received</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="payment_received" id="payment_received" @if (old('payment_received')) checked @endif>        
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New manual orders</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="new_manual_orders" id="new_manual_orders"  @if (old('new_manual_orders')) checked @endif>  
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">Fail orders</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="fail_orders" id="fail_orders" @if (old('fail_orders')) checked @endif> 
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New messages</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="new_messages" id="new_messages" @if (old('new_messages')) checked @endif>   
                                                 <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New manual payout</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="new_manual_payout" id="new_manual_payout" @if (old('new_manual_payout')) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                           </div>

                        </div>
                        <input type="hidden" name="add_email_popup" value="1"/>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="col-md-6 submit-update-section">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save Changes</button>
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" >Cancel</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--End:create Modal-->

    <!--Start:Edit Modal-->
    <div class="modal fade in" id="cmsStaffEmailEditPopUp" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Update menu item</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">

                        <div class="form-group">
                            <label class="control-label" for="edit_email">Email</label>            
                            <input type="email" name="edit_email" id="edit_email" value="{{ old('edit_email') }}" class="form-control" required/>
                            <span role="alert">
                                <strong id="error-email"></strong>
                            </span>

                        </div>

                        <div class="settings-emails__list">
                            <div class="settings-emails__list-title">
                                Notifications
                            </div>
                            <div class="settings-emails__list-body">
                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">Payment received</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="edit_payment_received" id="edit_payment_received" @if (old('edit_payment_received')) checked @endif>        
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New manual orders</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="edit_new_manual_orders" id="edit_new_manual_orders"  @if (old('edit_new_manual_orders')) checked @endif>  
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">Fail orders</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="edit_fail_orders" id="edit_fail_orders" @if (old('edit_fail_orders')) checked @endif> 
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New messages</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="edit_new_messages" id="edit_new_messages" @if (old('edit_new_messages')) checked @endif>   
                                                 <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="settings-emails__list-row">
                                    <div class="settings-emails__list-row-title">New manual payout</div>
                                    <div class="settings-emails__list-row-action">
                                        <div class="switch-custom switch-custom__table">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" name="edit_new_manual_payout" id="edit_new_manual_payout" @if (old('edit_new_manual_payout')) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="col-md-6 submit-update-section">
                            <div class="form-actions">
                                <button type="button" class="btn btn-success" onclick="updateStaffEmail()"> <i class="fa fa-check"></i> Update</button>
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" >Close</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-actions" id="deactive-btn">
                                <input type="hidden" id="edit_id" value=""/>
                                <input type="hidden" id="edit_prev_email" value=""/>
                                <a href="javascript:void(0)" class="btn btn-default waves-effect text-left" data-toggle="confirmation" data-original-title="" title="">Deactivate</a>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--End:Edit Modal-->
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>
<script src="{{ asset('js/bootstrap-tooltip.js') }}"></script>
<script src="{{ asset('js/bootstrap-confirmation.js') }}"></script>

<script>
@if($errors->has('email'))
$('#cmsStaffEmailModal').modal('show');
@endif


!function ($) {

$(function(){

  $('[data-toggle="confirmation"]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  onConfirm: function() {
    var id = $('#edit_id').val();
    $.ajax({
        type: "POST",
        url: 'staff/delete',
        dataType: "json",
        data: {"id": id, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            if (data.status == 1) {
                location.reload();
            }
        }
    });

  },
  popout: true
});

})

}(window.jQuery)

function editStaffEmail(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'staff/getStaffData',
        data: {'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data) 
        {
            $('#edit_email').val(data.email);

            if (data.payment_received > 0) {
                $('#edit_payment_received').attr("checked", "checked")
            }

            if (data.new_manual_orders > 0) {
                $('#edit_new_manual_orders').attr("checked", "checked")
            }

            if (data.fail_orders > 0) {
                $('#edit_fail_orders').attr("checked", "checked")
            }

            if (data.new_messages > 0) {
                $('#edit_new_messages').attr("checked", "checked")
            }

            if (data.new_manual_payout > 0) {
                $('#edit_new_manual_payout').attr("checked", "checked")
            }

            $('#ModalLabel').html('Update Staff Email');
            $('#edit_id').val(data.id);
            $('#edit_prev_email').val(data.email);
            $('#cmsStaffEmailEditPopUp').modal("show");
        }
    });
}

function updateStaffEmail() {

    var id = $('#edit_id').val();
    var email = $('#edit_email').val();
    var payment_received = $('#edit_payment_received').prop("checked");
    var manual_orders = $('#edit_new_manual_orders').prop("checked");
    var fail_orders = $('#edit_fail_orders').prop("checked");
    var new_messages = $('#edit_new_messages').prop("checked");
    var manual_payout = $('#edit_new_manual_payout').prop("checked");
    var prev_email = $('#edit_prev_email').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'staff/staffEmailUpdate/'+id,
        data: { "id" : id, "email" : email, "payment_received" : payment_received, "manual_orders" : manual_orders, "fail_orders" : fail_orders, "new_messages" : new_messages, "manual_payout" : manual_payout, "prev_email" : prev_email, "_token" : "{{ csrf_token() }}", "_method": "PUT" },
        success: function (data) 
        {
            if (data.status == 2){
                $('#error-email').html(data.mess);
            } else if (data.status == 0) {
                $('#error-email').html(data.errors.email[0]);
            } else if (data.status == 1) {
                location.reload();
            }
            
        }
    });
}

</script>

@endsection