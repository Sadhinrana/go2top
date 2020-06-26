@extends('reseller.layouts.app')

@section('title', 'Payment')

@section('pageName', 'Payment')

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
.disable-keystroke{opacity: 0.5; pointer-events: none}
.modal-backdrop {z-index: 999;}
.payment-method-list > .row-disable {background: #e2e2e2;color: #c5c5c5;}
.ui-sortable-handle svg {width: 12px;height: 14px;vertical-align: -2px;cursor: move;cursor: grab; cursor: -moz-grab;cursor: -webkit-grab;}
.ui-sortable-handle {margin-right: 4px;}
.ui-sortable-handle svg {width: 12px;height: 14px;vertical-align: -2px;cursor: move;cursor: grab;cursor: -moz-grab;cursor:-webkit-grab;}
</style>

@include('reseller.settings.nav')

    <div class="col-md-8">
        @if (!empty($success))
            <h1>{{$success}}</h1>
        @endif
        <button type="button" class="btn btn-default m-b add-page"  data-toggle="modal" data-target="#cmsPaymentMethodAddPopUp">Add Method</button>

        <table class="table">
            <thead>
                <tr>
                    <th class="p-l">Method</th>
                    <th>Name</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>New users</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="payment-method-list ui-sortable-handle">
                @if (!empty($reseller_payment_method_list))
                    @php $count = 0; @endphp
                    @foreach ($reseller_payment_method_list as $key => $value)
                        @php
                            $disable = '';
                            if ($value->visibility == '0') :
                                $disable = 'class="row-disable"';
                            endif
                        @endphp
                        <tr <?=$disable?>  id="{{ $value->id }}">
                            <td class="p-l">
                                <div class="table__drag">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Drag-Handle</title><path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path></svg>
                                    {{ $value->method_name }}
                                </div>

                            </td>
                            <td>{{ $value->method_name }}</td>
                            <td>{{ $value->minimum }}</td>
                            <td>{{ $value->maximum }}</td>
                            <td>{{ $value->new_user_status == '1' ? 'Allowed' : 'Not Allowed' }}</td>
                            <td>
                                <div class="switch-custom switch-custom__table">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-page-visibility" name="page_status" id="page_status_{{ $count }}" value="{{ $value->visibility }}"  {{ $value->visibility == '1' ? 'Checked' : '' }} onclick="isActiveInactive({{ $count }},{{ $value->id }})">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </td>
                            <td class="p-r text-right">
                                <a class="btn btn-default btn-xs" href="javascript:void(0)" onclick="EditPaymentMethod('{{ $value->id }}')">Edit</a>
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!--Start:Edit Modal-->
    <div class="modal fade in" id="cmsPaymentMethodAddPopUp" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <form class="form-material" id="moduleEditForm" method="post" action="{{ route('reseller.setting.payment.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Add payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="payment_method">Payment method</label>
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="">Select Payment Method</option>
                                @if (!empty($global_payment_list))
                                    @foreach ($global_payment_list as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('payment_method')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12 submit-update-section">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Add Method</button>
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
    <!--End:Edit Modal-->

    <!--Start:Edit Modal-->
    <div class="modal fade in" id="cmsPaymentMethodEditPopUp" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <form class="form-material" id="moduleEditForm" method="post" action="{{ route('reseller.setting.payment.updatePaymentMethod') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalEditLabel">Add payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">

                        <div class="form-group form-group__languages">
                            <label class="control-label" for="payment_method">Method name</label>
                            <input type="text" name="method_name" id="method_name" class="form-control" value="" required/>
                        </div>

                        <div class="form-group form-group__languages">
                            <label class="control-label" for="minimum">Minimal payment</label>
                            <input type="number" name="minimum" id="minimum" class="form-control" value="" min="0" max="1000" step="0.01" required/>
                        </div>

                        <div class="form-group form-group__languages">
                            <label class="control-label" for="maximum">Maximal payment</label>
                            <input type="number" name="maximum" id="maximum" class="form-control" value="" min="0" max="1000" step="0.01" required/>
                        </div>

                        <div class="form-group form-group__languages">
                            <label class="control-label" for="New users">New users</label>
                            <select class="form-control" name="new_users" id="new_users" required>
                                <option value="">Selete New Users</option>
                            </select>
                        </div>
                        <hr>
                        <div id="payment_parameters">
                        </div>
                        <input type="hidden" id="id" name="id" value=""/>
                        <input type="hidden" id="global_methods_id" name="global_methods_id" value=""/>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12 submit-update-section">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Add Method</button>
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
    <!--End:Edit Modal-->

@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>

<script>
@if ($errors->any())
    //$('#cmsPaymentMethodAddPopUp').modal("show");
@endif

$( function() {
    $( ".ui-sortable-handle" ).sortable({
		update: updatePublicPostSort
	});
});

function updatePublicPostSort() {
    var arr = [];
    $(".ui-sortable-handle tr").each(function () {
        arr.push($(this).attr('id'));
    });
	sortArrUpdate(arr);
}

function sortArrUpdate(sortArr) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'payment/sortArrUpdate',
        data: {'sortArr': sortArr, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            console.log(data);
        }
    });
}

function isActiveInactive(sl, id) {
    var status_value = '';
    let status = $('#page_status_'+sl).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'payment/updateStatus',
        data: {'status': status, 'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            if (data.status == 1 ){
                if (status == '1') {
                    status_value = '0';
                } else if (status == '0') {
                    status_value = '1';
                }
                $('#page_status_'+sl).val(status_value);
                location.reload();
            }
        }
    });
}

//reseller.setting.payment.show
function EditPaymentMethod(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'payment/editPaymentMethod',
        data: {'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            console.log(data);

            var newUser = '<option value="">Selete New Users</opton>';
            if (data[0].new_user_status == '1') {
                newUser += '<option value="1" selected>Allowed</option>'+
                           '<option value="0">Not Allowed</option>';
            } else {
                newUser += '<option value="1">Allowed</option>'+
                           '<option value="0" selected>Not Allowed</option>';
            }

            var parametersHTMl = '';
            for (var i = 0; i < data[0].parameters.length; i++) {
                var parameter_value = data[0].parameters[i].value != null ? data[0].parameters[i].value : '';
                parametersHTMl +='<div class="form-group form-group__languages">'+
                                    '<label class="control-label" for="input_'+i+'">'+data[0].parameters[i].form_label+'</label>'+
                                    '<input type="text" name="parameters[payment]['+i+'][value]" id="input_'+i+'" class="form-control" value="'+parameter_value+'" required/>'+
                                '</div>';
                parametersHTMl +='<input type="hidden" name="parameters[payment]['+i+'][key]" value="'+data[0].parameters[i].key+'">';
            }

            $('#payment_parameters').html(parametersHTMl);
            $('#new_users').html(newUser);
            $('#ModalEditLabel').html(data[0].method_name+' (ID: '+data[0].id+')');
            $('#method_name').val(data[0].method_name);
            $('#minimum').val(data[0].minimum);
            $('#maximum').val(data[0].maximum);
            $('#id').val(data[0].id);
            $('#global_methods_id').val(data[0].global_payment_method_id);
            $('#cmsPaymentMethodEditPopUp').modal("show");
        }
    });
}
</script>
@endsection
