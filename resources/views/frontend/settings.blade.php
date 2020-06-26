@extends('layouts.app_consumer')
@section('content')
<section>
   <div class="container" id="account-setting">
      <div class="row">
         <div class="col-lg">
            <div class="card bg-white">
               <div class="card-header">
                  <div class="card-title">Account details</div>
               </div>
               <div class="card-body">
                  <form class="pt-0" method="post" action="{{ url('/account/password') }}">
                     {{ csrf_field() }}
                     <input type="hidden" name="_method" value="PUT">
                     <div class="form-group">
                        <label for="name" class="control-label">username</label>
                        <input type="text"
                           class="form-control"
                           value="{{ Auth::user()->username }}"
                           data-validation="required"
                           id="name"
                           name="name"  readonly="">
                        @if ($errors->has('username'))
                        <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="email" class="control-label">@lang('forms.email')</label>
                        <input type="text"
                           class="form-control"
                           value="{{ Auth::user()->email }}"
                           disabled
                           id="email">
                     </div>
                     <div class="form-group">
                        <label for="skype_id" class="control-label">SkypeID</label>
                        <input type="text"
                           class="form-control"
                           value="{{ Auth::user()->skype_name }}"
                           disabled
                           id="skype_id">
                     </div>
                     <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                        <label for="old">Current password</label>
                        <input type="password"
                           name="old"
                           placeholder="@lang('forms.password')"
                           id="old"
                           class="form-control"
                           data-validation="required">
                        @if ($errors->has('old'))
                        <span class="help-block">
                        <strong>{{ $errors->first('old') }}</strong>
                        </span>
                        @endif
                     </div>
                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">New password</label>
                        <input id="password"
                           type="password"
                           class="form-control"
                           placeholder="@lang('forms.password')"
                           name="password"
                           data-validation="required">
                        @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                     </div>
                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Confirm new password</label>
                        <input id="password-confirm"
                           type="password"
                           class="form-control"
                           name="password_confirmation"
                           placeholder="@lang('forms.confirm_password')"
                           data-validation="required">
                     </div>
                     <button type="submit" class="btn btn-green">Change password</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg">
            <div class="card bg-white">
               <div class="card-header">
                  <div class="card-title">Timezone Settings</div>
               </div>
               <div class="card-body">
                  <form class="pt-0" action="{{ url('/account/config') }}" method="post">
                     {{ csrf_field() }}
                     <input type="hidden" name="_method" value="PUT">
                     <div class="form-group">
                        <label for="timezone">Timezone</label>
                        <select class="form-control" name="timezone" id="timezone">
                        @foreach($tzlist as $item)
                        <option value="{{$item}}" {{ ( Auth::user()->timezone == $item) ? 'selected' : '' }}>{{$item}}</option>
                        @endforeach
                        </select>
                        </select>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-green">Save</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="card bg-white mt-4">
               <div class="card-header">
                  <div class="card-title">API Key Settings</div>
               </div>
               <div class="card-body">
                  <form class="pt-0" action="{{ url('/account/api') }}" method="post">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="key">API key</label>
                        @if( ! is_null( Auth::user()->api_key ))
                        <input type="text"
                           class="form-control"
                           value="{{ Auth::user()->api_key }}"
                           id="api_key"
                           onClick="this.setSelectionRange(0, this.value.length)"
                           readonly
                           name="api_key"><br>
                        <button type="submit" class="btn btn-green">Generate new</button>
                     </div>
                     @else
                     <div class="form-group">
                        <button type="submit" class="btn btn-green">Generate new</button>
                        @endif
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection