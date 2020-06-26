@extends('reseller.layouts.app')

@section('title', 'Users')

@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- basic table -->
<div class="row">
    <div class="col-12">
        <div class="material-card card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-9">
                        <a href="javascript:void(0)" type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#userModal" onclick="addUser()"><i class="fa fa-plus"></i> </a>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-primary" href="{{ route('reseller.users.export') }}">Export</a>
                    </div>
                    <div class="col-md-2">
                        <form class="text-right" id="search-form">
                            <input type="hidden" name="order_by" value="{{ request()->query('order_by') }}">
                            <input type="hidden" name="sort_by" value="{{ request()->query('sort_by') }}">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" aria-label="Text input with checkbox" placeholder="Search users">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped border table-hover dataTable" id="users">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="select_all" onchange="checkAllUser()"></th>
                            <th colspan="11" style="display: none">
                                <span id="user-no"></span> users selected
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <form method="post" id="global-update" action="{{ route('reseller.users.suspend_or_activate') }}">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="type">
                                        </form>
                                        <form method="post" id="custom-rate-reset" action="{{ route('reseller.users.services.rate.reset') }}">
                                            @csrf
                                            @method('put')
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="suspendOrActivateUsers('inactive')">Suspend all</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="suspendOrActivateUsers('active')">Activate all</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="resetCustomRates()">Reset custom rates</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="bulkUpdateCustomRates()">Copy rates from user</a>
                                    </div>
                                </div>
                            </th>
                            <th @if(!request()->query('sort_by')) onclick="sortUsers('id', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') != 'id') onclick="sortUsers('id', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'id' && request()->query('order_by') == 'desc') onclick="sortUsers('id', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'id' && request()->query('order_by') == 'asc') onclick="sortUsers('id', 'desc')" class="sorting_asc" @endif>
                                ID
                            </th>
                            <th @if(request()->query('sort_by') != 'username') onclick="sortUsers('username', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'username' && request()->query('order_by') == 'desc') onclick="sortUsers('username', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'username' && request()->query('order_by') == 'asc') onclick="sortUsers('username', 'desc')" class="sorting_asc" @endif>
                                Username
                            </th>
                            <th @if(request()->query('sort_by') != 'email') onclick="sortUsers('email', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'email' && request()->query('order_by') == 'desc') onclick="sortUsers('email', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'email' && request()->query('order_by') == 'asc') onclick="sortUsers('email', 'desc')" class="sorting_asc" @endif>
                                Email
                            </th>
                            <th @if(request()->query('sort_by') != 'skype_name') onclick="sortUsers('skype_name', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'skype_name' && request()->query('order_by') == 'desc') onclick="sortUsers('skype_name', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'skype_name' && request()->query('order_by') == 'asc') onclick="sortUsers('skype_name', 'desc')" class="sorting_asc" @endif>
                                Skype
                            </th>
                            <th @if(request()->query('sort_by') != 'balance') onclick="sortUsers('balance', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'balance' && request()->query('order_by') == 'desc') onclick="sortUsers('balance', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'balance' && request()->query('order_by') == 'asc') onclick="sortUsers('balance', 'desc')" class="sorting_asc" @endif>
                                Balance
                            </th>
                            <th @if(request()->query('sort_by') != 'spent') onclick="sortUsers('spent', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'spent' && request()->query('order_by') == 'desc') onclick="sortUsers('spent', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'spent' && request()->query('order_by') == 'asc') onclick="sortUsers('spent', 'desc')" class="sorting_asc" @endif>
                                Spent
                            </th>
                            <th>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('reseller.users.index') }}">All ({{ auth()->guard('reseller')->user()->users->count() }})</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="searchUser('status', 'active')">Active ({{ auth()->guard('reseller')->user()->users->where('status', 'active')->count() }})</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="searchUser('status', 'inactive')">Inactive ({{ auth()->guard('reseller')->user()->users->where('status', 'inactive')->count() }})</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="searchUser('status', 'pending')">Inactive ({{ auth()->guard('reseller')->user()->users->where('status', 'pending')->count() }})</a>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th @if(request()->query('sort_by') != 'created_at') onclick="sortUsers('created_at', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'created_at' && request()->query('order_by') == 'desc') onclick="sortUsers('created_at', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'created_at' && request()->query('order_by') == 'asc') onclick="sortUsers('created_at', 'desc')" class="sorting_asc" @endif>
                                Created
                            </th>
                            <th @if(request()->query('sort_by') != 'last_login_at') onclick="sortUsers('last_login_at', 'asc')" class="sorting" @elseif(request()->query('sort_by') == 'last_login_at' && request()->query('order_by') == 'desc') onclick="sortUsers('last_login_at', 'asc')" class="sorting_desc" @elseif(request()->query('sort_by') == 'last_login_at' && request()->query('order_by') == 'asc') onclick="sortUsers('last_login_at', 'desc')" class="sorting_asc" @endif>
                                Last auth
                            </th>
                            <th>
                                Rates
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="users[]" data-name="{{ $user->username }}" value="{{ $user->id }}" class="user_check" onchange="checkUser()"></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->skype_name }}</td>
                                <td>{{ $user->balance }}</td>
                                <td>{{ $user->spent }}</td>
                                <td>
                                    @if($user->status == 'active')
                                        <button type="button" class="btn btn-success btn-rounded"><i class="fa fa-check"></i> Active</button>
                                    @elseif($user->status == 'pending')
                                        <button type="button" class="btn btn-warning btn-rounded"><i class="fa fa-question"></i> Pending</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-rounded"><i class="fa fa-times"></i> Inactive</button>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->last_login_at }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info btn-rounded" title="Services custom rates" onclick="showCustomRate('{{ $user->id }}')">custom rates ({{ $user->servicesList->count() }})</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <form class="d-none" action="{{ route('reseller.users.suspend', $user->id) }}" method="post" id="suspend-user{{ $user->id }}">
                                                @csrf
                                                @method('patch')
                                            </form>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="editUser('{{ $user->id }}')">Edit user</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="updatePassword('{{ route('reseller.users.password.update', $user->id) }}')">Set password</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="copyRate('{{ $user->id }}', '{{ $user->username }}')">Copy rates</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="suspendUser('{{ $user->id }}', '{{ $user->status == 'active' ? 'Suspend' : 'Activate' }}')">{{ $user->status == 'active' ? 'Suspend' : 'Activate' }} user</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($users->total())
                <div class="row mt-4">
                    <div class="col-md-6">
                        {{ $users->links() }}
                    </div>
                    <div class="col-md-6 text-right">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    </div>
                </div>
                @else
                    <div class="text-center mt-4">No data available in table</div>
                @endif
                <div class="modal bs-example-modal-lg" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form class="form-material" id="user-form" method="post" action="{{ route('reseller.users.store') }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="userModalLabel">Add user</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" required data-validation-required-message="This field is required">

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required data-validation-required-message="This field is required">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}">

                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" name="skype_name" class="form-control @error('skype_name') is-invalid @enderror" placeholder="Skype" value="{{ old('skype_name') }}">

                                                    @error('skype_name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="">Allowed payment methods</label><br>
                                                    @foreach(auth()->guard('reseller')->user()->paymentMethods as $paymentMethod)
                                                    <input type="checkbox" name="payment_methods[]" value="{{ $paymentMethod->id }}" checked> {{ $paymentMethod->method_name }}
                                                    @endforeach

                                                    @error('payment_methods')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <div class="custom-control custom-radio custom-control-inline mt-1">
                                                        <input type="radio" name="status" class="custom-control-input" id="customControlValidation1" value="pending" required="" {{ old('status') == 'pending' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customControlValidation1">Pending</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline mt-1">
                                                        <input type="radio" name="status" class="custom-control-input" id="customControlValidation2" value="active" required="" {{ old('status') == 'active' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customControlValidation2">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="status" class="custom-control-input" id="customControlValidation3" value="inactive" required="" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customControlValidation3">Inactive</label>
                                                    </div>

                                                    @error('status')
                                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal bs-example-modal-lg" id="passwordUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form class="form-material" id="password-update-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Update password</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required data-validation-required-message="This field is required">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal bs-example-modal-lg" id="customRateAddModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="custom-rate-add-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Edit custom rates</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <select id="service_id" name="service_id" class="form-control" required data-validation-required-message="This field is required" onchange="addCustomRate()">
                                                        <option disabled selected>Choose service</option>
                                                        @foreach(auth()->guard('reseller')->user()->categories as $category)
                                                        <optgroup label="{{ $category->name }}">
                                                            @foreach($category->services as $service)
                                                            <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped border table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Price update</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                    <button type="button" onclick="if (confirm('Are you sure want to delete all custom rates of this user?')) $('#deleteCustomRates').submit()" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete all</button>
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            <form class="d-none" method="post" id="deleteCustomRates">
                                @csrf
                                @method('delete')
                            </form>
                            <form class="d-none" method="post" id="deleteCustomRate">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal bs-example-modal-lg" id="customRateUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="custom-rate-update-form" method="post" novalidate>
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Copy custom rates</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group user-from">
                                                <div class="controls">
                                                    <select id="from" name="from" class="form-control @error('from') is-invalid @enderror" required data-validation-required-message="This field is required">
                                                        <option disabled selected>Choose from user</option>
                                                        @foreach(\Illuminate\Support\Facades\Auth::guard('reseller')->user()->users()->has('servicesList')->get() as $user)
                                                        <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->servicesList->count() }})</option>
                                                        @endforeach
                                                    </select>

                                                    @error('from')
                                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"><i class="fa fa-arrow-right"></i></div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" id="to" class="form-control" placeholder="To user" required data-validation-required-message="This field is required" readonly>
                                                    <input type="hidden" name="to" class="form-control" placeholder="To user" required data-validation-required-message="This field is required" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal bs-example-modal-lg" id="customRateBulkUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="custom-rate-bulk-update" action="{{ route('reseller.users.services.rate.update.bulk') }}" method="post" novalidate>
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Copy custom rates</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group user-from">
                                                <div class="controls">
                                                    <select id="fromBulk" name="from" class="form-control @error('from') is-invalid @enderror" required data-validation-required-message="This field is required">
                                                        <option disabled selected>Choose from user</option>
                                                        @foreach(\Illuminate\Support\Facades\Auth::guard('reseller')->user()->users()->has('servicesList')->get() as $user)
                                                        <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->servicesList->count() }})</option>
                                                        @endforeach
                                                    </select>

                                                    @error('from')
                                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"><i class="fa fa-arrow-right"></i></div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <textarea rows="10" disabled></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script !src="">
        function addUser() {
            let form = $('#user-form');
            $('#userModalLabel').text('Add user');
            form.find('input[name^=payment_methods]').prop('checked', true);
            form.attr('action', '{{ route('reseller.users.store') }}').trigger('reset').find('input[name=_method]').remove();
        }

        function editUser(id) {
            let form = $('#user-form');
            $('#userModalLabel').text('Edit user');
            form.attr('action', window.location.origin + '/reseller/users/' + id).prepend('<input type="hidden" name="_method" value="put">');

            $.ajax({
                type: 'get',
                url: window.location.origin + '/reseller/users/' + id + '/edit',
                success: function (response) {
                    if (response.status === 200) {
                        form.find('input[name=name]').val(response.data.name);
                        form.find('input[name=email]').val(response.data.email);
                        form.find('input[name=username]').val(response.data.username);
                        form.find('input[name=skype_name]').val(response.data.skype_name);

                        if (response.data.status == 'pending') {
                            $('#customControlValidation1').prop('checked', true);
                        } else if (response.data.status == 'active') {
                            $('#customControlValidation2').prop('checked', true);
                        } else {
                            $('#customControlValidation3').prop('checked', true);
                        }

                        form.find('input[name^=payment_methods]').each(function () {
                            if (response.data.payment_methods.some(element => element.id == $(this).val())) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });

                        $('#userModal').modal('show');
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: '500 Internal Server Error!',
                            html: 'Something went wrong! <br> <span class="error-message text-danger d-none">' + response.msg + '</span>',
                            footer: '<a href="javascript:void(0)" onclick="document.querySelector(\'.error-message\').classList.remove(\'d-none\');">Why do I have this issue?</a>'
                        });
                        console.log(response.msg);
                    }
                }
            });
        }

        function updatePassword(route) {
            $('#password-update-form').attr('action', route);
            $('#passwordUpdateModal').modal('show');
        }

        function suspendUser(id, status) {
            Swal.fire({
                title: 'Are you sure want to '+status+' this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, '+status+'!'
            }).then((result) => {
                if (result.value) {
                    $('#suspend-user' + id).submit();
                }
            });
        }

        function copyRate(id, name) {
            let form = $('#custom-rate-update-form');
            $('#to').val(name);
            form.find('input[name=to]').val(id);
            $("#from option").show();
            $("#from option[value='"+id+"']").hide();
            form.attr('action', window.location.origin + '/reseller/users/services/update');

            $('#customRateUpdateModal').modal('show');
        }

        function showCustomRate(id) {
            $.ajax({
                type: 'get',
                url: window.location.origin + '/reseller/users/' + id + '/services',
                success: function (response) {
                    if (response.status == 200) {
                        let data = '';
                        $('#zero_config').DataTable().destroy();

                        response.data.forEach(function (value, index, array) {
                            data += `<tr data-id="${value.id}">
                                        <td>${value.name}</td>
                                        <td>${value.price}</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="number" name="price[${value.id}]" id="price${value.id}" class="form-control" placeholder="Price" value="${value.pivot.price}" required>
                                                <input type="hidden" name="percentage[${value.id}]" id="percentage${value.id}" value="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="cursor: pointer" onclick="toggleSpan(this, ${value.pivot.price}, ${value.id})">$</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><button type="button" onclick="if (confirm('Are you sure want to delete this custom rate?')) $('#deleteCustomRate').submit()" class="btn btn-danger"> <i class="fa fa-trash"></i> </button></td>
                                    </tr>`;
                            $('#deleteCustomRate').attr('action', window.location.origin + '/reseller/users/' + id + '/services/' + value.id);
                        });

                        $('#zero_config tbody').html(data);
                        $('#zero_config').DataTable();
                        $('#custom-rate-add-form').attr('action', window.location.origin + '/reseller/users/' + id + '/services/custom-rate');
                        $('#deleteCustomRates').attr('action', window.location.origin + '/reseller/users/' + id + '/services');
                        $('#customRateAddModal').modal('show');
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: '500 Internal Server Error!',
                            html: 'Something went wrong! <br> <span class="error-message text-danger d-none">' + response.msg + '</span>',
                            footer: '<a href="javascript:void(0)" onclick="document.querySelector(\'.error-message\').classList.remove(\'d-none\');">Why do I have this issue?</a>'
                        });
                        console.log(response.msg);
                    }
                }
            });
        }

        function toggleSpan(_this, price, id) {
            if ($(_this).text() == '$') {
                $(_this).text('%');
                $(_this).closest('.input-group-append').siblings('#price' + id).val(100);
                $(_this).closest('.input-group-append').siblings('#percentage' + id).val(1);
            } else {
                $(_this).text('$');
                $(_this).closest('.input-group-append').siblings('#price' + id).val(price);
                $(_this).closest('.input-group-append').siblings('#percentage' + id).val(0);
            }
        }

        function addCustomRate() {
            let add = true;
            $('#zero_config').DataTable().destroy();
            let name = $('#service_id option:selected').text();
            let price = $('#service_id option:selected').data('price');

            Promise.all($('#zero_config tbody > tr').each(function () {
                if ($(this).data('id') == $('#service_id option:selected').val()) {
                    $(this).focus();
                    add = false;
                    return false;
                }
            })).then(function () {
                if (add) {
                    data = `<tr data-id="${$('#service_id option:selected').val()}">
                            <td>${name}</td>
                            <td>${price}</td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="number" name="price[${$('#service_id option:selected').val()}]" id="price${$('#service_id option:selected').val()}" class="form-control" placeholder="Price" value="${price}" required>
                                    <input type="hidden" name="percentage[${$('#service_id option:selected').val()}]" id="percentage${$('#service_id option:selected').val()}" value="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor: pointer" onclick="toggleSpan(this, ${price}, ${$('#service_id option:selected').val()})">$</span>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>`;

                    $('#zero_config tbody').prepend(data);
                }

                $('#zero_config').DataTable();
            });
        }

        function sortUsers(sort_by, order_by) {
            let form = $('#search-form');
            form.find('input[name=order_by]').val(order_by);
            form.find('input[name=sort_by]').val(sort_by);
            form.submit();
        }

        function checkAllUser() {
            if (event.target.checked) {
                $('.user_check').prop('checked', true);
                $('#users thead > tr > th:not(:first-child)').hide();
                $('#users thead > tr').children().eq(1).show();
                $('#user-no').text($('.user_check').length);
            } else {
                $('.user_check').prop('checked', false);
                $('#users thead > tr > th').show();
                $('#users thead > tr').children().eq(1).hide();
            }
        }

        function checkUser() {
            let count = 0;

            $('.user_check').each(function () {
                if (this.checked) {
                    count += 1;
                }
            });

            if (count) {
                $('input[name=select_all]').prop('checked', true);
                $('#users thead > tr > th:not(:first-child)').hide();
                $('#users thead > tr').children().eq(1).show();
                $('#user-no').text(count);
            } else {
                $('input[name=select_all]').prop('checked', false);
                $('#users thead > tr > th').show();
                $('#users thead > tr').children().eq(1).hide();
            }
        }

        function suspendOrActivateUsers(type) {
            let msg = type === 'active' ? 'activate' : 'suspend';

            Swal.fire({
                title: 'Are you sure want to ' + msg + ' all these users?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + msg + '!'
            }).then((result) => {
                if (result.value) {
                    let form = $('#global-update');
                    form.find("input[name=type]").val(type);
                    form.append($('.user_check'));
                    form.submit();
                }
            });
        }

        function resetCustomRates() {
            Swal.fire({
                title: 'Are you sure want to reset custom rates of all these users?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset!'
            }).then((result) => {
                if (result.value) {
                    let form = $('#custom-rate-reset');
                    form.append($('.user_check'));
                    form.submit();
                }
            });
        }

        function bulkUpdateCustomRates() {
            let users = '';
            let form = $('#custom-rate-bulk-update');
            $('.users').remove();
            $("#fromBulk option").show();

            $('.user_check').each(function () {
                if (this.checked) {
                    $("#fromBulk option[value='"+this.value+"']").hide();
                    users += $(this).data('name') + '\n';
                    form.append(`<input type="hidden" class="users" name="users[]" value="${this.value}">`);
                }
            });

            form.find('textarea').val(users);

            $('#customRateBulkUpdateModal').modal('show');
        }

        function searchUser(column, value) {
            let form = $('#search-form');
            form.prepend(`<input type="hidden" name="columns[${column}]" value="${value}">`);
            form.submit();
        }

        @if($errors->any())
        Swal.fire({
            type: 'error',
            title: 'Error!',
            html: '@if ($errors->any())\n' +
                '    <div class="alert alert-danger">\n' +
                '        <ul>\n' +
                '            @foreach ($errors->all() as $error)\n' +
                '                <li>{{ $error }}</li>\n' +
                '            @endforeach\n' +
                '        </ul>\n' +
                '    </div>\n' +
                '@endif',
        });
        @endif
    </script>
@endsection
