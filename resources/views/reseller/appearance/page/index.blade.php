@extends('reseller.layouts.app')

@section('title', 'Page')

@section('pageName', 'Page')

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
</style>

@include('reseller.appearance.nav')


    <div class="col-md-8">
        @if (!empty($success))
            <h1>{{$success}}</h1>
        @endif
        <a class="btn btn-default m-b add-page" href="{{ route('reseller.appearance.create') }}">Add page</a>

        <table class="table">
            <thead>
                <tr>
                    <th width="45%" class="p-l">Name</th>
                    <th>Visibility</th>
                    <th>Public</th>
                    <th>Last modified</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    @if(!$cms_page->isEmpty())
                        <?php $count = 1; ?>
                        @foreach($cms_page as $key => $page)
                            <tr  class="@if($page->non_editable == 1) disable-keystroke @endif" >
                                <td class="p-l">{{ $page->page_name }}</td>
                                <td>
                                    <div class="switch-custom switch-custom__table">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-page-visibility" name="page_status" id="page_status_{{ $count }}" value="{{ $page->status }}"  {{ $page->status == 'ACTIVE' ? 'Checked' : '' }} onclick="isActiveInactive({{ $count }},{{ $page->id }})">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $page->public }}</td>
                                <td>{{ $page->created_at }}</td>
                                <td class="p-r text-right">
                                    <a class="btn btn-default btn-xs" href="{{ route('reseller.appearance.edit', $page->id) }}">Edit</a>
                                </td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                    @endif
            </tbody>
        </table>
    </div>
@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>
<script src="{{ asset('js/underscore.js') }}"></script>
<script src="{{ asset('js/appearance.js') }}"></script>

<script>
function isActiveInactive(sl, id) {
    var status_value = '';
    let status = $('#page_status_'+sl).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'appearance/status',
        data: {'status': status, 'id': id, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            if (data.status == 1 ){
                if (status == 'ACTIVE') {
                    status_value = 'INACTIVE';
                } else if (status == 'INACTIVE') {
                    status_value = 'ACTIVE';
                }
                $('#page_status_'+sl).val(status_value);
            }
        }
    });
}

</script>
@endsection
