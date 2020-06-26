@extends('reseller.layouts.app')

@section('title', 'Blog')

@section('pageName', 'Blog')

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
a.link {
    color: #000;
}
a.link:hover {
    color: #000;
    text-decoration: none;
}
a.link span {
  color: #000;
  display: none;
}
a.link:hover span {
  opacity: 1;
  color: #000;
  display: inline-block;
}
</style>

@include('reseller.blog.nav')


    <div class="col-md-8">
        @if (!empty($success))
            <h1>{{$success}}</h1>
        @endif
        <a class="btn btn-default m-b add-page" href="{{ route('reseller.blog.create') }}">Add New Blog</a>            
        
        <table class="table">
            <thead>
                <tr>
                    <th width="45%" class="p-l">Post Title</th>
                    <th>Created</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (!$cms_blog->isEmpty())
                    @foreach ($cms_blog as $key => $blog)
                        <tr>
                            <td>
                                <a href="{{ URL::to('/blog/'.$blog->slug) }}" class="link" target="_blank">
                                    {{ $blog->title }} 
                                    <span class="someicon">
                                        <i class="fa fa-link" aria-hidden="true"></i>
                                    </span>
                                </a> 
                            </td>
                            <td>{{ $blog->created_at }}</td>
                            <td>{{ $blog->visibility == '0' ? 'Not published' : 'published' }}</td>
                            <td class="p-r text-right">
                                <a class="btn btn-default btn-xs" href="{{ route('reseller.blog.edit', $blog->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @else    
                    <tr><td>No Data found.</td></tr>
                @endif   
            </tbody>
        </table>
    </div>
@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>

@endsection