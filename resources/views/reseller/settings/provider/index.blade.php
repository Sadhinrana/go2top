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
        <button type="button" class="btn btn-default m-b add-page"  data-toggle="modal" data-target="#cmsPaymentMethodAddPopUp">Add Provider</button>

        <table class="table">
            <thead>
                <tr>
                    <th class="p-l">Provider</th>
                    <th>Balance</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="payment-method-list ui-sortable-handle">
                @if (!empty($providers))
                    @php $count = 0; @endphp
                    @foreach ($providers as $key => $provider)
                        @php
                            $disable = '';
                            if ($provider->status == 'inactive') :
                                $disable = 'class="row-disable"';
                            endif
                        @endphp
                        <tr <?=$disable?>  id="{{ $provider->id }}">
                            <td class="p-l">
                                <div class="table__drag">
                                   {{--  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Drag-Handle</title>
                                        <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z">
                                        </path>
                                    </svg> --}}
                                    {{ $provider->domain }}
                                </div>

                            </td>
                            <td>0</td>
                            <td class="p-r text-right">
                                <a class="btn btn-default btn-xs" href="javascript:void(0)" onclick="EditPaymentMethod('{{ $provider->id }}')">Edit</a>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form class="form-material" id="moduleEditForm" method="post" action="{{ route('reseller.setting.provider.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Add Provider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="domain">Domain </label>
                            <input type="text" class="form-control" name="domain" id="domain">
                            @error('domain')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="url">URL </label>
                            <input type="text" class="form-control" name="url" id="url">
                            @error('url')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="api_key">API Key </label>
                            <input type="text" class="form-control" name="api_key" id="api_key">
                            @error('api_key')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 submit-update-section">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Add Provider</button>
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
            <form class="form-material" id="moduleEditForm" method="post" action="{{ route('reseller.setting.provider.updateProvider') }}">
                @method('put')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalEditLabel">Update Provider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body" id="modalBody">
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="edit_domain">Domain </label>
                            <input type="text" class="form-control" name="edit_domain" id="edit_domain">
                        </div>
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="edit_url">URL </label>
                            <input type="text" class="form-control" name="edit_url" id="edit_url">
                        </div>
                        <div class="form-group form-group__languages">
                            <label class="control-label" for="edit_api_key">API Key </label>
                            <input type="text" class="form-control" name="edit_api_key" id="edit_api_key">
                        </div>
                        <input type="hidden" name="provider_domain_id" id="provider_domain_id">
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-10 submit-update-section">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Update Provider</button>
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" >Cancel</button>
                            </div>
                        </div>
                </form>
                        <div class="col-md-2 submit-update-section">
                            <div class="form-actions">
                                <form action="{{ route('reseller.setting.provider.delProvider')}}" onsubmit="return confirm('Are you sure?')" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="provider_domain_del_id" id="provider_domain_del_id">
                                    <button type="submit" class="btn btn-default waves-effect text-left">Delete</button>
                                </form>
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

<script>
@if ($errors->any())
    //$('#cmsPaymentMethodAddPopUp').modal("show");
@endif

/* $( function() {
    $( ".ui-sortable-handle" ).sortable({
		update: updatePublicPostSort
	});
}); */

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
        url: '{{ route("reseller.setting.provider.editProvider")}}',
        data: {'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            console.log(data);
            $('#edit_api_key').val(data.data.api_key);
            $('#edit_url').val(data.data.api_url);
            $('#edit_domain').val(data.data.domain);
            $('#provider_domain_id').val(data.data.id);
            $('#provider_domain_del_id').val(data.data.id);
            $('#cmsPaymentMethodEditPopUp').modal("show");
        }
    });
}
</script>
@endsection
