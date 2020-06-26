@extends('reseller.layouts.app')

@section('title')
    Page {{ isset($cmsBlog) ? 'Edit' : 'Create' }}
@endsection

@section('pageName')
    Page {{ isset($cmsBlog) ? 'Edit' : 'Create' }}
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
.appearance-seo__block {position: relative;padding: 5px 0;}
.appearance-seo__block-title {font-size: 15px;font-weight: bold;}
.appearance-seo__block .other_services {top: 7px;}
.other_services {font-size: 12.5px;display: inline-block;position: absolute;right: 0;font-weight: 400;border-bottom: 1px dashed #337ab7;}
.seo-preview {margin-top: 10px;}
.seo-preview .seo-preview__title {min-height: 21px;display: block;font-size: 18px;color: #1a0dab;line-height: 21px;margin-bottom: 2px;overflow-wrap: break-word;word-wrap: break-word;}
.seo-preview .seo-preview__url {display: block;word-wrap: break-word;color: #006621;font-size: 13px;line-height: 16px;margin-bottom: 2px;}
.seo-preview .seo-preview__description { display: block;color: #545454;line-height: 18px;font-size: 13px;}
.appearance-seo__block-collapse {padding-top: 10px;}
.setting-block__image {position: relative;}
.setting-block__image-remove {position: absolute;top: -7px;right: -7px;}
.setting-block__image-remove a {display: block;width: 18px;height: 18px;position: relative;border: 1px solid #ddd;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;background-color: #fff;outline: 0;color: #333;}
.setting-block__image-remove span {font-size: 11px;position: absolute;top: 2px;left: 2px;line-height: 12px;}
.setting-block__image-remove a:hover {border: 1px solid #333;background-color: #333;color: #fff;}
.popover{ width: 126px !important;}
</style>

@include('reseller.blog.nav')

<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ isset($cmsBlog) ? route('reseller.blog.update', $cmsBlog->id) : route('reseller.blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if(isset($cmsBlog))
                        @method('PUT')
                    @endif

                    <div id="createPageError" class="error-summary alert alert-danger hidden"></div>

                    <div class="relative">

                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-10">
                                    <label class="control-label" for="post_image">Post image</label>
                                    <input type="file" id="post_image" name="post_image">
                                    <p class="help-block">800 x 450px recommended</p>
                                </div>

                                @if (isset($cmsBlog))
                                    @if ($cmsBlog->image !="")
                                        @php
                                            $img = file_get_contents(public_path('uploads/blog/thumbnail/thumb-'.$cmsBlog->image)); 
                                            $data = 'data:image/jpeg;base64,'.base64_encode($img); 
                                        @endphp
                                    @endif
                                @endif

                                <div class="col-md-2">
                                    <div class="image_container" id="image_container" style="display: {{ isset($cmsBlog) && $cmsBlog->image !='' ? 'block' : 'none' }}">
                                        <div class="modal-loader hidden"></div>
                                        <div class="setting-block__image">
                                            <img id="img_preview" class="img-thumbnail" src="{{ isset($cmsBlog) && $cmsBlog->image !='' ?  $data : ''}}">
                                            <div class="setting-block__image-remove">
                                                    <a href="javascript:void(0)" onclick="resetImage()" class="delete_image_action" data-blog-id="" id="delete-image-section">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="blog_category">Blog Category</label>    
                            <select class="form-control is-public" name="blog_category" id="blog_category">
                                <option value="">Select Category</option>
                                @if (!$get_cms_category->isEmpty())
                                    @foreach ($get_cms_category as $key => $category)
                                        <option value="{{ $category->id }}"  {{ old('blog_category', isset($cmsBlog) ? $cmsBlog->category_id : '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label class="control-label" for="post_title">Post title</label>    
                            <input type="text" id="post_title" class="form-control default-page-name page-name" name="post_title" value="{{ old('post_title', isset($cmsBlog) ? $cmsBlog->title : '') }}" onchange="string_to_slug(this.value)">
                            @error('post_title')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="post_content">Body</label>  
                            <textarea name="post_content" id="post_content" class="form-control" required>
                                {{ old('post_content', isset($cmsBlog) ? $cmsBlog->content : '') }}
                            </textarea>      
                            
                            @error('post_content')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="control-label" for="createpageform-url">URL</label>                        
                        <div class="input-group">
                            <span class="input-group-addon" for="page_url">{{ URL::to('/blog') }}/</span>
                            <input type="text" class="form-control" id="page_url" name="page_url" value="{{ old('page_url', isset($cmsBlog) ? $cmsBlog->slug : '') }}" required>   
                            @error('page_url')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="createpageform-url">Type</label>                        
                        <div class="input-group">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="blog_type" id="blog_type" {{ old('blog_type', isset($cmsBlog) ? $cmsBlog->type : '') == '1' ? 'checked' : '' }} required>Trending
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="2" name="blog_type" id="blog_type" {{ old('blog_type', isset($cmsBlog) ? $cmsBlog->type : '') == '2' ? 'checked' : '' }} required>Popular
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="0" name="blog_type" id="blog_type" {{ old('blog_type', isset($cmsBlog) ? $cmsBlog->type : '') == '0' ? 'checked' : '' }} required>None
                            </label>
                        </div>
                        @error('blog_type')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="is_visibility">Visibility</label>    
                        <select class="form-control is-public" name="is_visibility" id="is_visibility" required>
                            <option value="0" {{ old('is_visibility', isset($cmsBlog) ? $cmsBlog->visibility : '') == '0' ? 'selected' : '' }}>Not published</option>
                            <option value="1" {{ old('is_visibility', isset($cmsBlog) ? $cmsBlog->visibility : '') == '1' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('is_visibility')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                <hr>
                <button type="submit" class="btn btn-primary" name="save-button">Save changes</button>                    
                <a class="btn btn-default" href="{{ route('reseller.blog.index') }}">Cancel</a>
                               
            </form>                

            @if (isset($cmsBlog))
            <a class="btn btn-default waves-effect pull-right"  data-toggle="confirmation">
                <i class="material-icons">delete</i>
            </a>
            <form id="delete-form-submit" action="{{ route('reseller.blog.destroy', $cmsBlog->id) }}" method="POST" style="display:none">
                @csrf
                @method('DELETE')
            </form>
            @endif
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/nav-priority.js') }}"></script>
@if (isset($cmsBlog))
<script src="{{ asset('js/bootstrap-tooltip.js') }}"></script>
<script src="{{ asset('js/bootstrap-confirmation.js') }}"></script>
@endif
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace('post_content');

@if(isset($cmsBlog))
    $('#delete-image-section').hide();
@endif 

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
        $('#img_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#post_image").change(function() {
  $('#image_container').attr('style', 'display:block');  
  readURL(this);
});

function resetImage(){
    $('#post_image').val('');
    $('#img_preview').val('');
    $('#image_container').attr('style', 'display:none');
}

function string_to_slug (str) 
{
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    var slug = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

   $('#page_url').val(slug);
}

@if (isset($cmsBlog))
!function ($) {

$(function(){

  $('[data-toggle="confirmation"]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  onConfirm: function() {
    //event.preventDefault();
    document.getElementById('delete-form-submit').submit();
  },
  popout: true
});

})

}(window.jQuery)
@endif
</script>
@endsection