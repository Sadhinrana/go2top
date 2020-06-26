@extends('reseller.layouts.app')

@section('title')
    Page {{ 'Edit' }}
@endsection

@section('pageName')
    Page {{ 'Edit' }}
@endsection

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
.round { color: #fff;width: 34px;height: 18px;display: inline-block;text-align: center;line-height: 28px;}
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
.appearance-seo__block {
    position: relative;
    padding: 5px 0;
}
.appearance-seo__block-title {
    font-size: 15px;
    font-weight: bold;
}
.appearance-seo__block .other_services {
    top: 7px;
}
.other_services {
    font-size: 12.5px;
    display: inline-block;
    position: absolute;
    right: 0;
    font-weight: 400;
    border-bottom: 1px dashed #337ab7;
}
.seo-preview {
    margin-top: 10px;
}
.seo-preview .seo-preview__title {
    min-height: 21px;
    display: block;
    font-size: 18px;
    color: #1a0dab;
    line-height: 21px;
    margin-bottom: 2px;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.seo-preview .seo-preview__url {
    display: block;
    word-wrap: break-word;
    color: #006621;
    font-size: 13px;
    line-height: 16px;
    margin-bottom: 2px;
}
.seo-preview .seo-preview__description {
    display: block;
    color: #545454;
    line-height: 18px;
    font-size: 13px;
}
.appearance-seo__block-collapse {
    padding-top: 10px;
}
</style>

@include('reseller.settings.nav')

<div class="col-md-8">
    <div class="panel">
        <div class="panel-body panel-default">
            <form action="{{ route('reseller.setting.notification.update', $cms_notification->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div id="createPageError" class="error-summary alert alert-danger hidden"></div>
                    
                    <div class="relative">
                
                        <div class="form-group">
                            <label class="control-label" for="subject">Subject</label>    
                            <input type="text" id="subject" class="form-control" name="subject" value="{{ old('subject', isset($cms_notification) ? $cms_notification->subject : '') }}" required>
                            @error('subject')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="status">Status</label>   
                            <select class="form-control" name="status" id="status" required>
                                <option value="0" {{ old('status', isset($cms_notification) ? $cms_notification->status : '') == '0' ? 'selected' : '' }}>Disabled</option>
                                <option value="1" {{ old('status', isset($cms_notification) ? $cms_notification->status : '') == '1' ? 'selected' : '' }}>Enabled</option>
                            </select>    
                            @error('status')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="body">Body</label>            
                            <textarea id="body" class="form-control" name="body" rows="5" required>{{ old('body', isset($cms_notification) ? $cms_notification->body : '') }}</textarea> 
                        </div> 

                        <div class="btn-group" role="group">
                            <a href="#" id="btn-test" class="btn btn-default">
                                Send test            
                            </a>
                            <a href="# id="btn-reset" class="btn btn-default disabled">
                                Reset            
                            </a>
                        </div>   

                    </div>
                                                        
                    <hr>
                    <button type="submit" class="btn btn-primary" name="save-button">Save changes</button>                    
                    <a class="btn btn-default" href="{{ route('reseller.setting.notification.index') }}">Cancel</a>
                               
            </form>                
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>

<script>


</script>
@endsection