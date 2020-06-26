@extends('reseller.layouts.app')

@section('title', 'FAQ')

@section('pageName', 'FAQ')

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
.modal-backdrop {
    z-index: 999;
}
.submit-update-section { text-align: left; }
.popover.fade.top.in { width: 128px;}
@media only screen and (min-width: 700px){
.dd {float: left;width: 100%;}
}
</style>

@include('reseller.settings.nav')

    <div class="col-md-8">
        @if (!empty($success))
            <h1>{{$success}}</h1>
        @endif         
        <a class="btn btn-default m-b add-page" href="{{ route('reseller.setting.faq.create') }}">Add FAQ</a>
        <div class="panel panel-default">
				<div class="panel-body">

					<div class="row settings-menu__row">

						<div class="col-md-12">
							<div class="dd">
								<ol class="dd-list ui-sortable" id="public_menu">
                                    @if (!$cms_faq->isEmpty())	
                                        @foreach ($cms_faq as $key => $faq)	
								
                                            <li class="dd-item ui-sortable-handle" id="{{ $faq->id }}">
                                                <div class="dd-handle">

                                                    <div class="settings-menu__drag">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Drag-Handle</title><path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path></svg>
                                                    </div>

                                                    {{ $faq->question }} 
                                                </div>

                                                <div class="settings-menu__action">

                                                    <div class="col-md-6 text-right">{{ $faq->status == '1' ? 'Active' : 'Inactive' }}</div>
                                                    <div class="col-md-6 text-right">
                                                        <a href="{{ route('reseller.setting.faq.edit', $faq->id) }}" class="btn btn-default btn-xs edit-modal-menu">Edit</a>
                                                    </div>

                                                </div>
                                            </li>

                                        @endforeach
                                    @endif
								</ol>
							</div>

						</div>

					</div>

				</div>
			</div>
    </div>

</div>

@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>
<script>
$( function() {
    $( "#public_menu" ).sortable({
		update: updatePublicPostSort
	});
});

function updatePublicPostSort() {
    var arr = [];
    $("#public_menu li").each(function () {
        arr.push($(this).attr('id'));
    });
    //console.log(arr);
	sortArrUpdate(arr);
}

function sortArrUpdate(sortArr) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'faq/sortArrUpdate',
        data: {'sortArr': sortArr, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            console.log(data);
        }
    });
}

</script>

@endsection