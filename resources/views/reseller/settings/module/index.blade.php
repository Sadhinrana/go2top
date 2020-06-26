@extends('reseller.layouts.app')

@section('title', 'Module')

@section('pageName', 'Module')

@section('content')

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>

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
@media only screen and (min-width: 700px){
.dd {float: left;width: 100%;}
}
</style>

@include('reseller.settings.nav')

@if (!empty($success))
    <h1>{{$success}}</h1>
@endif
<div class="col-md-8">

    @if(!$cms_active_module->isEmpty())
    <div class="settings-emails__block">
        <div class="settings-emails__block-title">
            Active
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
                    @foreach ($cms_active_module as $active_module)
                        <tr class="settings-emails__row">
                            <td>
                                <div class="settings-emails__row-name">{{ $active_module->title }}</div>
                                <div class="settings-emails__row-description">
                                    {{ $active_module->description }}
                                </div>
                            </td>
                            <td class="settings-emails__td-actions">
                                <a href="javascript:void(0)" onclick="editModule('{{ route('reseller.setting.module.update', $active_module->id) }}',{{ $active_module->id }},{{ $active_module->type }})" class="btn btn-xs btn-default edit-module" data-title="Affiliate system" data-module="1">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if(!$cms_inactive_module->isEmpty())
    <div class="settings-emails__block">

        <div class="settings-emails__block-title">
            Other
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
                    @foreach ($cms_inactive_module as $inactive_module)
                        <tr class="settings-emails__row">
                            <td>
                                <div class="settings-emails__row-name">{{ $inactive_module->title }}</div>
                                <div class="settings-emails__row-description">
                                    {{ $inactive_module->description }}
                                </div>
                            </td>
                            <td class="settings-emails__td-actions">
                                <a href="javascript:void(0)" onclick="editModule('{{ route('reseller.setting.module.update', $inactive_module->id) }}',{{ $inactive_module->id }},{{ $inactive_module->type }})" class="btn btn-xs btn-default edit-module" data-title="Affiliate system" data-module="1">
                                    Activate
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endif

</div>

<!--Start:Edit Modal-->
<div class="modal fade in" id="cmsModuleEditPopUp" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form class="form-material" id="moduleEditForm" method="post" action="#" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">Update menu item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body" id="modalBody">


                </div>

                <div class="modal-footer">
                    <div class="col-md-6 submit-update-section">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" >Close</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-actions" id="deactive-btn" style="display: none">
                            <input type="hidden" id="edit_id" value=""/>
                            <a class="btn btn-default waves-effect text-left" data-toggle="confirmation" data-original-title="" title="">Deactivate</a>
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
<script src="{{ asset('js/bootstrap-tooltip.js') }}"></script>
<script src="{{ asset('js/bootstrap-confirmation.js') }}"></script>

<script>
@if($errors->any())
$('#cmsModuleEditPopUp').modal('show');
@endif

!function ($) {

$(function(){

  $('[data-toggle="confirmation"]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  onConfirm: function() {
    var id = $('#edit_id').val();
    $.ajax({
        type: "POST",
        url: 'module/statusUpdate',
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

function editModule(route, id, type){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'module/getModuleData',
        data: {'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data)
        {
            var html = '';
            if (type == 1) {

                html += '<div class="form-group form-group__languages">'+
                            '<label class="control-label" for="commission_rate">Commission rate, %</label>'+
                            '<input type="number" id="commission_rate" class="form-control" name="commission_rate" value="'+ data.commission_rate +'" min="0" max="10" step="0.01" required>'+
                        '</div>' +
                        '<div class="form-group form-group__languages">'+
                            '<label class="control-label" for="amount">Minimum payout</label>'+
                            '<input type="number" id="amount" class="form-control" name="amount" value="'+data.amount+'" min="0" max="10" step="0.01" required>'+
                        '</div>' +
                        '<div class="form-group form-group__languages">'+
                            '<label class="control-label" for="approve_payouts">Approve payouts</label>'+
                            '<select class="form-control" name="approve_payouts" id="approve_payouts" required>';

                            if (data.approve_payout == 1) {
                                html += '<option value="1" selected>Auto</option>' +
                                        '<option value="0">Manual</option>';
                            } else if (data.approve_payout == 0) {
                                html += '<option value="1">Auto</option>' +
                                        '<option value="0" selected>Manual</option>';
                            }

                        html +='</select></div>' +
                                '<input type="hidden" name="status" value="'+data.status+'">';

                $('#ModalLabel').html('Affiliate system');
            }else if (type == 2) {

                html += '<div class="form-group form-group__languages">'+
                            '<label class="control-label" for="amount">Price per month</label>'+
                            '<input type="number" id="amount" class="form-control" name="amount" value="'+ data.amount +'" min="0" max="10" step="0.01" required>'+
                        '</div>' +
                        '<input type="hidden" name="commission_rate" value="0">' +
                        '<input type="hidden" name="approve_payouts" value="0">'+
                        '<input type="hidden" name="status" value="'+data.status+'">';

                $('#ModalLabel').html('Child panels selling');
            }else if (type == 3) {
                html += '<div class="form-group form-group__languages">'+
                            '<label class="control-label" for="amount">Amount</label>'+
                            '<input type="number" id="amount" class="form-control" name="amount" value="'+ data.amount +'" min="0" max="10" step="0.01" required>'+
                        '</div>' +
                        '<input type="hidden" name="commission_rate" value="0">' +
                        '<input type="hidden" name="approve_payouts" value="0">'+
                        '<input type="hidden" name="status" value="'+data.status+'">';

                $('#ModalLabel').html('Free balance');
            }

            html +='<input type="hidden" name="type" value="'+data.type+'">';

            if (data.status > 0) {
                $('#deactive-btn').css('display', 'block');
                $('#edit_id').val(data.type);
            }

            $('#modalBody').html(html);
            $('#moduleEditForm').attr('action', route);
            $('#cmsModuleEditPopUp').modal("show");
        }
    });
}
</script>

@endsection
