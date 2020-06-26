@extends('reseller.layouts.app')

@section('title', 'Services')

@section('pageName', 'Services')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Services</li>
@stop

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.10.3/dist/vue-select.css">
    <style>
        .style-chooser .vs__search::placeholder,
        .style-chooser .vs__dropdown-toggle,
        .style-chooser .vs__dropdown-menu {
            background: #ffffff;
            border: 1px solid #d3d3d3;
            color: #000;
        }
        .style-chooser .vs__dropdown-menu li{
            border: 1px solid #d3d3d331;
            padding: 8px 5px;
        }
        .style-chooser .vs__dropdown-menu li:hover{
            background-color: #337AB7;
        }

        .style-chooser .vs__clear,
        .style-chooser .vs__open-indicator {
            fill: #394066;
        }
        .style-chooser .vs__selected-options{
            flex-wrap: nowrap;
        }
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
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu a::after {
            transform: rotate(270deg);
            position: absolute;
            top: 18px;
        }
        .dropdown-submenu .dropdown-menu {
            top: -12px;
            left: 100%;
            margin-left: .1rem;
            margin-right: .1rem;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <div class="__table-container" id="serviceApp">
        <div class="overlay-loader" v-if="loader.page">
            <div class="loader-holder">
                <img src="{{asset('loader.gif')}}" alt="">
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered __modal_dialog_custom" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Category Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="overlay-loader" v-if="loader.category">
                            <div class="loader-holder">
                                <img src="{{asset('loader.gif')}}" alt="">
                            </div>
                        </div>
                        <form method="post"
                              id="category_form"
                              @submit="submitCategoryForm"
                              enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                   v-model="category.name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                        <div v-if="errors.category.length != 0" class="error-display">
                            <p class="error-display-item" v-for="errC in errors.category"> @{{ errC.desc }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end category modal --}}
        {{--        Service Modal--}}
        <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog"
             aria-labelledby="serviceModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered __modal_dialog_custom" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> <strong>Add Services</strong> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="overlay-loader" v-if="loader.service">
                            <div class="loader-holder">
                                <img src="{{asset('loader.gif')}}" alt="">
                            </div>
                        </div>
                        <form method="post"
                              id="service_form"
                              @submit="submitServiceForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="name"> <strong>Service Name <span class="badge badge-pill badge-dark"> English </span> </strong>  </label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                   placeholder="Service Name" v-model="services.form_fields.name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="name"> <strong>Category</strong>  </label>
                                            <select name="category_id" class="form-control"
                                                    v-model="services.form_fields.category_id">
                                                <option value="" selected>Choose category</option>
                                                @foreach(\Illuminate\Support\Facades\Auth::guard('reseller')->user()->categories as $category)
                                                    <option
                                                        {{ old('category_id', isset($service) ? $service->category_id : '') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="form-group">
                                                <label for="name"> <strong>Mode</strong>  </label>
                                                <select name="mode" id="mode" class="form-control"
                                                        v-model="service_mode">
                                                    <option>Auto</option>
                                                    <option>Manual</option>
                                                </select>
                                            </div>
                                            <div class="form-group" v-if="services.visibility.provider">
                                                <label for=""><strong>Provider</strong></label>
                                                <v-select :options="providers_lists"
                                                          v-model="services.form_fields.provider_id"
                                                          class="style-chooser"
                                                          :reduce="domain => domain.id" label="domain"></v-select>
                                                <input type="hidden" name="provider_id" v-model="services.form_fields.provider_id">

                                                {{-- <select name="provider_id" id="provider_id" class="form-control"
                                                        v-model="services.form_fields.provider_id" @change="getProviderServices">
                                                    <option value="">Choose a provider</option>
                                                    @foreach ($providers as $provider)
                                                        <option value="{{$provider->id}}">{{$provider->domain}}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            {{-- <div class="form-group" v-if="services.visibility.provider">
                                            <label for=""><strong>testing @{{services.form_fields.provider_service_id}}</strong></label>
                                                <v-select :options="options" v-model="services.form_fields.provider_service_id" :reduce="country => country.code" label="country"></v-select>
                                            </div> --}}
                                            <span style="color: red" v-if="service_mode == 'Auto' && services.validations.provider_service_not_found !==''">@{{services.validations.provider_service_not_found}}</span>
                                            <div class="form-group" v-if="services.visibility.service_id_by_provider">
                                                <label for=""><strong>Services</strong></label>
                                                <v-select :options="provider_services_computed"
                                                          class="style-chooser"
                                                          v-model="services.form_fields.provider_service_id"
                                                          :reduce="services => services.id" label="display_name"></v-select>
                                                <input type="hidden" name="provider_service_id" v-model="services.form_fields.provider_service_id">
                                                {{-- <select name="provider_service_id" id="provider_service_id"
                                                        class="form-control provider_get_services"
                                                        v-model="services.form_fields.provider_service_id"
                                                        @change="changeSelected"
                                                        >
                                                    <option>Select a service</option>
                                                    <option  v-for="ps in provider_services" :value="ps.service">   @{{ps.service}} - @{{ps.name}}</option>
                                                </select> --}}
                                            </div>
                                            <input type="hidden" name="service_type"  v-if="!services.visibility.service_type" v-model="service_type_selected">
                                            <input type="hidden" name="provider_selected_service_data" :value="JSON.stringify(this.provider_service_selected)">
                                            <div class="form-group" v-if="services.visibility.service_type">
                                                <label for=""><strong>Service Type</strong></label>
                                                <select name="service_type" id="service_type"
                                                        class="form-control" v-model="service_type_selected">
                                                    <option v-for="st in service_type">@{{ st }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group" v-if="services.visibility.drip_feed">
                                                <label for=""><strong>Drip Feed</strong></label>
                                                <select name="drip_feed_status" id="drip_feed_status"
                                                        class="form-control"
                                                        v-model="services.form_fields.drip_feed_status">
                                                    <option>Allow</option>
                                                    <option>Disallow</option>
                                                </select>
                                            </div>
                                            <div class="form-group" v-if="services.visibility.re_fill">
                                                <label for=""><strong>Re-Fill</strong></label>
                                                <select name="refill_status" id="refill_status" class="form-control"
                                                        v-model="services.form_fields.refill_status">
                                                    <option>Allow</option>
                                                    <option>Disallow</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for=""> <strong>Rate Per 1000</strong></label>
                            <div class="row auto-mode-input-field" v-if="service_mode == 'Auto'  && services.form_fields.provider_service_id != null">
                                <div class="col-11 d-flex" v-if="services.visibility.auto_per_rate">
                                    <div class="form-group">
                                        <label for=""> Fixed 1.0</label>
                                        <input type="text" v-model="auto_price_plus" class="form-control" placeholder="0" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Percent, %</label>
                                        <input type="text"  v-model="auto_price_percent" class="form-control" placeholder="0" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <div class="price_box">
                                            <span>@{{services.form_fields.price}}</span>
                                            <span>@{{services.form_fields.price_original}} USD</span>
                                            <input type="hidden" name="price" v-model="services.form_fields.price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-11" v-else>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="price" v-model="services.form_fields.price">
                                        <label for="">@{{services.form_fields.price_original}} USD</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="switch-custom switch-custom__table">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-page-visibility"  v-model="auto_per_rate_toggler" >
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-else>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="price" class="form-control"
                                               v-model="services.form_fields.price" placeholder="Price">
                                    </div>
                                    <div class="price_validation_messages" v-if='services.validations.price.visibility' >
                                        <p class="text-danger">@{{services.validations.price.msg}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-md-6">
                                    <label for=""><strong>Min Order</strong></label>
                                    <div class="row order_limit" v-if="service_mode == 'Auto'  && services.form_fields.provider_service_id != null">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="min_quantity" v-model='services.form_fields.min_quantity'>
                                                <label for="">@{{services.form_fields.auto_min_quantity}} USD</label>
                                            </div>
                                            <div class="overlay" v-if="auto_min_rate_toggler"></div>
                                        </div>
                                        <div class="col-1">
                                            <div class="switch-custom switch-custom__table">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-page-visibility"  v-model="auto_min_rate_toggler" >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div  v-else >
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="text" name="min_quantity"
                                                       class="form-control"
                                                       placeholder="Min quantity"
                                                       v-model="services.form_fields.min_quantity"
                                                       :class="{disabled :services.disable.min}"
                                                       :disabled="services.disable.min"
                                                />
                                            </div>
                                        </div>
                                        <div class="price_validation_messages" v-if='services.validations.minQuantity.visibility' >
                                            <p class="text-danger">@{{services.validations.minQuantity.msg}}</p>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <label for=""><strong>Max Order</strong></label>
                                    <div class="row order_limit" v-if="service_mode == 'Auto'  && services.form_fields.provider_service_id != null">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model='services.form_fields.max_quantity' name="max_quantity">
                                                <label for="">@{{services.form_fields.auto_max_quantity}} USD</label>
                                            </div>
                                            <div class="overlay" v-if="auto_max_rate_toggler"></div>
                                        </div>
                                        <div class="col-1">
                                            <div class="switch-custom switch-custom__table">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-page-visibility"  v-model="auto_max_rate_toggler" >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="form-group">
                                            <div class="controls">

                                                <input type="text" name="max_quantity"
                                                       class="form-control"
                                                       placeholder="Max quantity"
                                                       v-model="services.form_fields.max_quantity"
                                                       :class="{disabled :services.disable.max}"
                                                       :disabled="services.disable.max"
                                                />
                                            </div>
                                        </div>
                                        <div class="price_validation_messages" v-if='services.validations.maxQuantity.visibility' >
                                            <p class="text-danger">@{{services.validations.maxQuantity.msg}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-3" v-if="service_mode == 'Auto'">
                                <div class="col-12">
                                    <div class="switch-custom switch-custom__table">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-page-visibility" name="provider_sync_status"  v-model="provider_sync_status" >
                                            <span class="slider round"></span>
                                        </label>
                                        <p class="d-inline"><strong> Sync service status with provider </strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""> <strong>Link duplicates</strong></label>
                                        <select name="link_duplicates" id="link_duplicates" class="form-control"
                                                v-model="link_duplicate_selected">
                                            <option>Allow</option>
                                            <option>Disallow</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label > <strong>Increment</strong>    <span class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="Restricted to accept quantity. Multiple of setted value"></span></label>
                                        {{-- <label for=""> Increment <i class="fas fa-info-circle"></i> </label> --}}
                                        <input type="text" class="form-control" name="increment"
                                               v-model="services.form_fields.increment">
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="services.visibility.overflow">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""> <strong>Overflow</strong>  </label>
                                        <input type="text"
                                               v-model="services.form_fields.auto_overflow"
                                               class="form-control" name="auto_overflow">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                        <div v-if="errors.category.length != 0" class="error-display">
                            <p class="error-display-item" v-for="errC in errors.category"> @{{ errC.desc }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{--       end Service Modal--}}
        <div class="modal fade" id="serviceDescription" tabindex="-1" role="dialog"
             aria-labelledby="serviceDescriptionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered __modal_dialog_custom" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Descrtiopn Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="overlay-loader" v-if="loader.description">
                            <div class="loader-holder">
                                <img src="{{asset('loader.gif')}}" alt="">
                            </div>
                        </div>
                        <form method="post"
                              id="formDescription"
                              @submit="updateServiceDescription"
                              enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="id" v-model="service_edit_id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description"
                                                  id="serviceDescription_edit"
                                                  class="form-control summernote"
                                                  v-model="services.form_fields.description"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                        <div v-if="errors.category.length != 0" class="error-display">
                            <p class="error-display-item" v-for="errC in errors.category"> @{{ errC.desc }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="bulkCategoryAssgin" tabindex="-1" role="dialog"
             aria-labelledby="bulkCategoryAssginTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered __modal_dialog_custom" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Bulk Category Assign</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="overlay-loader" v-if="loader.description">
                            <div class="loader-holder">
                                <img src="{{asset('loader.gif')}}" alt="">
                            </div>
                        </div>
                        <form method="post"
                              id="formBulkCategory"
                              @submit="service_bulk_category"
                              enctype="multipart/form-data" novalidate>
                            <input type="hidden" name="id" v-model="service_edit_id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="bulk_category_id" id="bulk_category_id" class="form-control">
                                            <option value="">Select a category</option>
                                            @foreach($cate_services as $cate)
                                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="import" tabindex="-1" role="dialog"
             aria-labelledby="serviceModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> <strong>Import services</strong> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="overlay-loader" v-if="loader.service">
                            <div class="loader-holder">
                                <img src="{{asset('loader.gif')}}" alt="">
                            </div>
                        </div>
                        <form method="post" action="{{ route('reseller.provider.services.import') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><strong>Provider</strong></label>
                                        <v-select :options="providers_lists"
                                                  v-model="provider_id"
                                                  class="style-chooser"
                                                  :reduce="domain => domain.id"
                                                  label="domain"
                                                  @input="getProviderServicesByCategory"
                                        >
                                        </v-select>
                                    </div>
                                    <div class="form-group" v-if="categories.length">
                                        <label for=""><strong>Services</strong></label>
                                        <div class="card" style="height: 400px; overflow: auto">
                                            <div class="material-card card" v-for="(category, index) in categories">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        @{{ category.category }}
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="dropdown show goTopDropdown">
                                                                            <a class="btn btn-secondary dropdown-toggle" :class="'cat' + index" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                Create category
                                                                            </a>
                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                                <li @click="selectDropDown(index, 'Create category')"><a class="dropdown-item">Create category</a></li>
                                                                                <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Add to category</a>
                                                                                    <ul class="dropdown-menu">
                                                                                        @foreach(auth()->guard('reseller')->user()->categories as $category)
                                                                                            <li @click="selectDropDown(index, '{{ $category->name }}', '{{ $category->id }}')"><a class="dropdown-item">{{ $category->name }}</a></li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <label>
                                                                    <input type="checkbox" @click="checkUncheckAll(index, $event)"> Select all
                                                                </label>
                                                            </td>
                                                            <td class="text-right">
                                                                Rate, USD
                                                            </td>
                                                        </tr>
                                                        <tr v-for="service in category.services">
                                                            <td>
                                                                <label>
                                                                    <input type="checkbox" name="categories[]" class="d-none" :class="'catControl' + index" value="create">
                                                                    <input @change="checkSibling($event)" type="checkbox" name="services[]" :value="JSON.stringify(service)" :class="'category' + index"> @{{ service.name }}
                                                                </label>
                                                            </td>
                                                            <td class="text-right">
                                                                @{{ service.rate }}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="__control_panel">
            <div class="__left_control_panel">
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#serviceModal">Add Service
                </button>
                <button class="btn btn-outline-secondary disabled">Add Subscription</button>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModalCenter">Create
                    Category
                </button>
                <div v-if="service_checkbox.length >0" class="d-inline service-checkbox-action">
                    <span>service selected @{{ service_checkbox.length }}</span>
                    <div class="dropdown __dropdown_buttons service_action">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" @click="bulkEnable">Enable All</a>
                            <a class="dropdown-item" href="#" @click="bulkDisable">Disable All</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bulkCategoryAssgin">Assign
                                Category</a>
                            <a class="dropdown-item" href="#" @click="resetCustomRates">Reset Custom rates</a>
                            <a class="dropdown-item" href="#" @click="bulkDelete">Delete All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="__right_control_panel">
                <button class="btn btn-link" data-target="#import" data-toggle="modal">Import</button>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                    <input type="text" id="searchmyInput" class="form-control" placeholder="Search Services">
                </div>
            </div>
        </div>
        <div class="__table_header __table_header_dropdown">
            <div class="__th no-drop-down"><input type="checkbox" id="selectAllService"></div>
            <div class="__th no-drop-down">ID</div>
            <div class="__th __service_th no-drop-down">Service</div>
            <div class="__th __service_th_type">
                <form action="{{route('reseller.services.index')}}" method="get" class="__service_th_type__form">
                    <select name="serviceTypefilter" id=""
                            class="form-control service_type_filter"
                            onchange="this.form.submit()">
                        <option value="">Type</option>
                        @foreach($service_type_counts as $key => $count)
                            <option value="{{$key}}">{{$key}} ({{$count}})</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="__th no-drop-down __service_th_type">Provider</div>
            <div class="__th no-drop-down">Rate</div>
            <div class="__th no-drop-down">Min</div>
            <div class="__th no-drop-down">Max</div>
            <div class="__th">
                <form action="{{route('reseller.services.index')}}" method="get" class="__service_th_type__form">
                    <select name="serviceTypefilter" id=""
                            class="form-control service_type_filter">
                        <option value="">Status</option>
                        <option value="#">All (4260)</option>
                        <option value="#">Disabled (561)</option>
                        <option value="#">Enabled (3699)</option>
                    </select>
                </form>
            </div>
            <div class="__th no-drop-down" style="text-align:right;padding-right:4px;">
                <div style="cursor: pointer" onclick="toggleAllcategory()">
                    <i class="fas fa-expand-arrows-alt" id="expand" style="display: none"></i>
                    <i class="fas fa-compress" id="compress" ></i>
                </div>

            </div>
        </div>
        <div class="__table_body category-sortable">
            @foreach ($cate_services as $category)
                <div class="__row_wrapper">
                    <div class="__cate_service_wrapper">
                        <div class="__category_row">
                            <div class="__catename_action">
                                <svg xmlns="http://www.w3.org/2000/svg" class="category-handle" viewBox="0 0 20 20"><title>Drag-Handle</title>
                                    <path
                                        d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                                </svg>

                                <span class="category_title" style="font-weight: 500;color: rgba(0, 0, 0, 0.79);">
                                {{$category->name}}
                            <input type="hidden" class="category_hidden_id" value="{{$category->id}}">
                            </span>
                                <span class="category_action">
                            <div class="dropdown __dropdown_buttons">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"
                                       @click="categoryEdit({{$category->id}})">Edit Category</a>
                                    <a class="dropdown-item" href="{{route('reseller.category.status.change', ['id'=>$category->id ])}}"> @if($category->status == 'active')
                                            Disabled @else Enable @endif Category</a>
                                </div>
                            </div>
                            </div>
                            <div class="__cate_toggler">
                                <div class="service-block__collapse-block" onclick="hideService(this)">
                                    <div class="service-block__collapse-button ">
                                        <i class="fa fa-caret-down ml-1" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service_rows">
                            @if (!empty($category->services))
                                @foreach ($category->services as $service)
                                    <div class="__service_row {{ $category->status=='inactive'? "__service_row-services-disable __service_row-overlay": "" }} {{$service->status == 'inactive'?"__service_row-services-disable __service_row-overlay": " "}}" id="sortable">
                                        <div class="__service_td drag-handler-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="service-handle" viewBox="0 0 20 20"><title>Drag-Handle</title>
                                                <path
                                                    d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                                            </svg>
                                            <input type="checkbox" class="service_checkbox" v-model="service_checkbox"
                                                   value="{{$service->id}}">
                                        </div>
                                        <div class="__service_td">
                                            {{$service->id}}
                                        </div>
                                        <div class="__service_td __service_th_td">
                                            {{$service->name}}
                                        </div>
                                        <div class="__service_td __service_td_span">
                                            {{$service->service_type}}
                                        </div>
                                        <div class="__service_td __service_td_span">
                                            {{ ucfirst($service->mode) }}
                                        </div>
                                        <div class="__service_td">
                                            {{$service->price}}
                                        </div>
                                        <div class="__service_td">
                                            {{$service->min_quantity}}
                                        </div>
                                        <div class="__service_td">
                                            {{$service->max_quantity}}
                                        </div>
                                        <div class="__service_td">
                                            @if($service->status == 'active')
                                                Enabled
                                            @else
                                                Disabled
                                            @endif
                                        </div>
                                        <div class="__service_td">
                                            <div class="dropdown __dropdown_buttons">
                                                <button class="btn btn-default dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" @click="serviceEdit({{$service->id}})">Edit
                                                        service</a>
                                                    <a class="dropdown-item" href="#"
                                                       @click="serviceDescription({{$service->id}})">Edit description</a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('reseller.service.change.status', ['id'=>$service->id])}}"> @if($service->status == 'active')
                                                            Disable @else Enable @endif service</a>
                                                    <a class="dropdown-item" href="{{route('reseller.service.custom.rate.reset',['service_id'=>$service->id ])}}" onclick="return confirm('Are you sure?')">Reset custom rates</a>
                                                    <a class="dropdown-item" href="{{ route('reseller.service.delete', ['id'=>$service->id ])}}">Delete
                                                        service</a>
                                                    <a class="dropdown-item" href="{{route('reseller.service.duplicate',['service_id'=>$service->id ])}}" >Duplicate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-select@3.10.3/dist/vue-select.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        const capitalize = (s) => {
            if (typeof s !== 'string') return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
        }
        Vue.component('v-select', VueSelect.VueSelect);

        const App = new Vue({
            el: '#serviceApp',
            data: {
                options: [ {country: 'atik', code: 1}, {country: 'sudip', code: 2},],
                providers_lists: [],
                errors: {
                    category: [],
                },
                success: {
                    category: '',
                },
                loader: {
                    category: false,
                    service: false,
                    page: false,
                    description: false,
                },
                service_edit: false,
                service_edit_id: null,
                category_edit: false,
                category_edit_id: null,
                auto_per_rate_toggler: true,
                auto_min_rate_toggler: true,
                auto_max_rate_toggler: true,
                auto_price_plus: null,
                auto_price_percent: null,
                provider_sync_status: true,
                services: {
                    visibility: {
                        drip_feed: false,
                        re_fill: false,
                        service_id_by_provider: false,
                        provider: false,
                        service_type: false,
                        overflow: false,
                        auto_per_rate: false,
                    },
                    disable: {
                        min: false,
                        max: false,
                    },
                    form_fields: {
                        name: '',
                        score: 0,
                        category_id: null,
                        number: 0,
                        mode: null,
                        provider_id: null,
                        provider_service_id: null,
                        service_type: null,
                        drip_feed_status: null,
                        refill_status: null,
                        short_name: '',
                        price: null,
                        price_original: null,
                        min_quantity: null,
                        auto_min_quantity: null,
                        auto_max_quantity: null,
                        link_duplicates: null,
                        increment: null,
                        auto_overflow: null,
                    },
                    validations: {
                        price :{
                            visibility: false,
                            msg: ''
                        },
                        minQuantity :{
                            visibility: false,
                            msg: ''
                        },
                        maxQuantity :{
                            visibility: false,
                            msg: ''
                        },
                        provider_service_not_found: '',
                    }

                },
                link_duplicate_selected: 'Allow',
                service_mode: 'Auto',
                service_type: [
                    'Default',
                    'SEO',
                    'SEO2',
                    'Custom Comments',
                    'Custom Comments Package',
                    'Comment Likes',
                    'Mentions',
                    'Mentions with Hashtags',
                    'Mentions Custom List',
                    'Mentions Hashtag',
                    'Mentions Users Followers',
                    'Mentions Media Likers',
                    'Package',
                    'Poll',
                    'Comment Replies',
                    'Invites From Groups',
                ],
                service_type_selected: 'Default',
                category: {
                    name: null,
                    star: null,
                    short_description: '',
                    description: '',
                    icon: null,
                    status: null,
                },
                category_services: null,
                service_checkbox: [],
                provider_services: [],
                categories: [],
                provider_service_selected: null,
                provider_id: null,
            },
            computed: {
                provider_services_computed()
                {
                    if (this.provider_services===null) return null;
                    return this.provider_services.map(item=>{
                        return {
                            id: item.service,
                            name: item.name,
                            display_name: item.service+" - "+item.name,
                        }
                    })
                },
            },
            watch: {
                service_mode(newval, oldval) {
                    this.manipulateInputs();
                },
                service_type_selected(newval, oldval) {
                    this.manipulateInputs();
                },
                'services.form_fields.price': {
                    handler: function(oldval,newval)
                    {
                        if (isNaN(oldval)) {
                            this.services.validations.price.visibility = true;
                            this.services.validations.price.msg = 'Please, Input Numbers Only';
                        }
                        else
                        {
                            this.services.validations.price.visibility = false;
                            this.services.validations.price.msg = ' ';
                        }
                    },
                    deep: true,
                },
                'services.form_fields.min_quantity': {
                    handler: function(oldval,newval)
                    {
                        if (isNaN(oldval)) {
                            this.services.validations.minQuantity.visibility = true;
                            this.services.validations.minQuantity.msg = 'Please, Input Numbers Only';
                        }
                        else
                        {
                            this.services.validations.minQuantity.visibility = false;
                            this.services.validations.minQuantity.msg = ' ';
                        }
                    },
                    deep: true,
                },
                'services.form_fields.max_quantity': {
                    handler: function(oldval,newval)
                    {
                        if (isNaN(oldval)) {
                            this.services.validations.maxQuantity.visibility = true;
                            this.services.validations.maxQuantity.msg = 'Please, Input Numbers Only';
                        }
                        else
                        {
                            this.services.validations.maxQuantity.visibility = false;
                            this.services.validations.maxQuantity.msg = ' ';
                        }
                    },
                    deep: true,
                },
                'services.form_fields.provider_id': {
                    handler: function(oldval,newval)
                    {
                        this.getProviderServices(oldval);
                    },
                    deep: true,
                },
                'services.form_fields.provider_service_id': {
                    handler: function(oldval,newval)
                    {
                        this.changeSelected();
                    },
                    deep: true,
                },
                auto_per_rate_toggler(newval, oldval)
                {
                    this.services.visibility.auto_per_rate = newval;
                },
                auto_min_rate_toggler(newval, oldval){
                    if (newval===true) {
                        this.services.form_fields.min_quantity = this.services.form_fields.auto_min_quantity;
                    }
                },
                auto_max_rate_toggler(newval, oldval){
                    if (newval===true) {
                        this.services.form_fields.max_quantity = this.services.form_fields.auto_max_quantity;
                    }
                },
                auto_price_plus(newval, oldval){
                    if (newval !== null) {
                        // price +(percent*price/100)+fixed
                        this.services.form_fields.price = parseFloat(Number(this.services.form_fields.price_original)  +  Number(newval) + (Number(this.services.form_fields.price_original) * Number(this.auto_price_percent) / 100 ));
                    }
                },
                auto_price_percent(newval, oldval){
                    if (newval !== null) {
                        //this.services.form_fields.price = Number(this.services.form_fields.price)  +  (Number(newval)/100) * Number(this.services.form_fields.price);
                        this.services.form_fields.price = parseFloat(Number(this.services.form_fields.price_original)  +  Number(this.auto_price_plus) + (Number(this.services.form_fields.price_original) * Number(newval) / 100 ));
                    }
                },
            },
            created() {
                this.manipulateInputs();
                this.service_edit = false;
                if (this.service_edit === false) {
                    this.services.form_fields.name = '';
                    this.services.form_fields.score = 0;
                    this.services.form_fields.category_id = '';
                    this.services.form_fields.number = 0;
                    this.services.form_fields.mode = this.service_mode;
                    this.services.form_fields.provider_id = '';
                    this.services.form_fields.provider_service_id = null;
                    this.services.form_fields.service_type = null;
                    this.services.form_fields.drip_feed_status = 'Allow';
                    this.services.form_fields.refill_status = 'Allow';
                    this.services.form_fields.short_name = '';
                    this.services.form_fields.price = null;
                    this.services.form_fields.min_quantity = null;
                    this.services.form_fields.max_quantity = null;
                    this.services.form_fields.link_duplicates = this.link_duplicate_selected;
                    this.services.form_fields.increment = null;
                    this.services.form_fields.auto_overflow = null;
                    this.services.form_fields.description = '';
                }
                this.providers_lists = <?=$providers?>;

                this.services.visibility.auto_per_rate = this.auto_per_rate_toggler;
            },
            methods: {
                submitCategoryForm(evt) {
                    this.loader.category = true;
                    evt.preventDefault();

                    let categoryForm = new FormData(document.getElementById('category_form'));
                    if (this.category_edit) {
                        categoryForm.append('edit_id', this.category_edit_id);
                        categoryForm.append('edit_mode', true);
                    }
                    fetch('{{route('reseller.categories.store')}}', {
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        credentials: "same-origin",
                        method: "POST",
                        body: categoryForm
                    })
                        .then(res => {
                            if (!res.ok) {
                                throw res.json();
                            }
                            return res.json();
                        })
                        .then(res => {
                            if (res.status === 200) {
                                this.category_edit = false;
                                this.category_edit_id = null;
                                setTimeout(() => {
                                    this.loader.category = false;
                                    toastr["success"](res.message);
                                    document.getElementById('category_form').reset();
                                    $('#exampleModalCenter').modal('hide');
                                    window.location.reload();
                                }, 2000);
                            }

                        })
                        .catch(err => {
                            setTimeout(() => {
                                this.loader.category = false;
                                let prepare = [];
                                err.then(erMesg => {
                                    let errMsgs = Object.entries(erMesg.errors);
                                    for (let i = 0; i < errMsgs.length; i++) {
                                        let obj = {};
                                        obj.name = errMsgs[i][0];
                                        obj.desc = errMsgs[i][1][0];
                                        prepare.push(obj);
                                    }
                                    this.errors.category = prepare;
                                });
                            }, 2000);
                        });


                },
                manipulateInputs() {
                    if (this.service_mode === 'Auto') {
                        this.services.visibility.provider = true;
                        this.services.visibility.drip_feed = false;
                        this.services.visibility.re_fill = false;
                        this.services.visibility.service_type = false;
                        this.services.visibility.overflow = true;
                    } else {
                        this.services.visibility.provider = false;
                        this.services.visibility.drip_feed = true;
                        this.services.visibility.re_fill = true;
                        this.services.visibility.service_type = true;
                        this.services.visibility.overflow = false;
                    }

                    if ((this.service_mode === 'Manual' && this.service_type_selected === 'Default')
                        || (this.service_mode === 'Manual' && this.service_type_selected === 'Invites From Groups')
                    )
                    {
                        this.services.visibility.drip_feed = true;
                        this.services.visibility.re_fill = true;
                    } else if (this.service_mode === 'Manual' && this.service_type_selected === 'Comment Likes') {
                        this.services.visibility.drip_feed = false;
                        this.services.visibility.re_fill = false;
                    } else {
                        this.services.visibility.re_fill = false;
                        this.services.visibility.drip_feed = false;
                    }

                    if ((this.service_mode === 'Manual' && this.service_type_selected === 'Custom Comments Package') || (this.service_mode === 'Manual' && this.service_type_selected === 'Package')) {
                        this.services.disable.min = true;
                        this.services.disable.max = true;
                    } else {
                        this.services.disable.min = false;
                        this.services.disable.max = false;
                    }

                },
                submitServiceForm(evt) {
                    this.loader.service = true;
                    evt.preventDefault();
                    let service_form = new FormData(document.getElementById('service_form'));
                    if (this.service_edit) {
                        service_form.append('edit_id', this.service_edit_id);
                        service_form.append('edit_mode', true);
                    }
                    fetch('{{route('reseller.services.store')}}', {
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        credentials: "same-origin",
                        method: "POST",
                        body: service_form
                    })
                        .then(res => {
                            if (!res.ok) {
                                throw res.json();
                            }
                            return res.json();
                        })
                        .then(res => {
                            if (res.status === 200) {
                                this.service_edit = false;
                                this.service_edit_id = null;
                                setTimeout(() => {
                                    this.loader.service = false;
                                    toastr["success"](res.message);
                                    document.getElementById('service_form').reset();
                                    $('#serviceModal').modal('hide');
                                    window.location.reload();
                                }, 2000);
                            }

                        })
                        .catch(err => {
                            setTimeout(() => {
                                this.loader.service = false;
                                let prepare = [];
                                err.then(erMesg => {
                                    let errMsgs = Object.entries(erMesg.errors);
                                    for (let i = 0; i < errMsgs.length; i++) {
                                        let obj = {};
                                        obj.name = errMsgs[i][0];
                                        obj.desc = errMsgs[i][1][0];
                                        prepare.push(obj);
                                    }
                                    this.errors.category = prepare;
                                });
                            }, 2000);
                        });

                },
                editHelper() {
                    this.service_mode = capitalize(this.services.form_fields.mode);
                    this.services.form_fields.drip_feed_status = capitalize(this.services.form_fields.drip_feed_status);
                    this.services.form_fields.refill_status = capitalize(this.services.form_fields.refill_status);
                    this.link_duplicate_selected = capitalize(this.services.form_fields.link_duplicates);
                },
                serviceEdit(service_id) {
                    this.loader.page = true;
                    this.service_edit_id = service_id;
                    fetch('showService/' + service_id).then(res => res.json())
                        .then(res => {
                            this.loader.page = false;
                            this.loader.service = true;
                            this.service_edit = true;
                            $('#serviceModal').modal('show');
                            this.services.form_fields = {...res.data};
                            this.service_mode = this.services.form_fields.mode;
                            this.service_type_selected = this.services.form_fields.service_type;
                            this.manipulateInputs();
                            this.editHelper();
                            this.loader.service = false;
                        })
                },
                serviceDescription(service_id) {
                    this.loader.page = true;
                    fetch('showService/' + service_id).then(res => res.json())
                        .then(res => {
                            this.loader.page = false;
                            this.loader.description = true;
                            $('#serviceDescription').modal('show');
                            this.services.form_fields.description = res.data.description;
                            $("#serviceDescription_edit").summernote('code', res.data.description);
                            this.loader.description = false;
                            this.service_edit_id = service_id;
                        })
                },
                updateServiceDescription(evt) {
                    evt.preventDefault();
                    this.loader.description = true;
                    evt.preventDefault();
                    let service_form = new FormData(document.getElementById('formDescription'));
                    fetch('updateService/' + this.service_edit_id, {
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        credentials: "same-origin",
                        method: "POST",
                        body: service_form
                    })
                        .then(res => {
                            if (!res.ok) {
                                throw res.json();
                            }
                            return res.json();
                        })
                        .then(res => {
                            console.log(res);
                            if (res.status === 200) {
                                this.service_edit = false;
                                setTimeout(() => {
                                    this.loader.description = false;
                                    toastr["success"](res.message);
                                    document.getElementById('formDescription').reset();
                                    $('#serviceDescription').modal('hide');
                                    window.location.reload();
                                }, 2000);
                            }

                        })
                        .catch(err => {
                            console.log(err);
                            setTimeout(() => {
                                this.loader.description = false;
                                let prepare = [];
                                err.then(erMesg => {
                                    let errMsgs = Object.entries(erMesg.errors);
                                    for (let i = 0; i < errMsgs.length; i++) {
                                        let obj = {};
                                        obj.name = errMsgs[i][0];
                                        obj.desc = errMsgs[i][1][0];
                                        prepare.push(obj);
                                    }
                                    this.errors.category = prepare;
                                });
                            }, 2000);
                        });
                },
                categoryEdit(category_id) {
                    this.loader.page = true;
                    this.category_edit = true;
                    this.category_edit_id = category_id;
                    fetch('showCategory/' + category_id).then(res => res.json())
                        .then(res => {
                            this.loader.page = false;
                            this.loader.category = true;
                            this.category = {...res.data};
                            $('#exampleModalCenter').modal('show');
                            if (this.category_edit) {
                                $("#cate_short_desc").summernote('code', res.data.short_description);
                                $("#cate_long_desc").summernote('code', res.data.description);
                            }
                            this.loader.category = false;
                        });

                },
                bulkEnable() {
                    this.loader.page = true;
                    if (this.service_checkbox.length !== 0) {
                        //console.log(this.service_checkbox);
                        let forD = new FormData();
                        forD.append('service_ids', this.service_checkbox);
                        fetch('service_bulk_enable', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body: forD,
                        }).then(res => res.json())
                            .then(res => {

                                if (res.status === 200) {
                                    setTimeout(() => {
                                        this.loader.page = false;
                                        toastr["success"](res.message);
                                        window.location.reload();
                                    }, 2000);
                                }

                                console.log(res);
                            })
                    } else {
                        alert('No check box is selected');
                    }
                },
                bulkDisable() {
                    this.loader.page = true;
                    if (this.service_checkbox.length !== 0) {
                        //console.log(this.service_checkbox);
                        let forD = new FormData();
                        forD.append('service_ids', this.service_checkbox);
                        fetch('service_bulk_disable', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body: forD,
                        }).then(res => res.json())
                            .then(res => {

                                if (res.status === 200) {
                                    setTimeout(() => {
                                        this.loader.page = false;
                                        toastr["success"](res.message);
                                        window.location.reload();
                                    }, 2000);
                                }

                                console.log(res);
                            })
                    } else {
                        alert('No check box is selected');
                    }
                },
                resetCustomRates() {
                    this.loader.page = true;
                    if (this.service_checkbox.length !== 0) {
                        //console.log(this.service_checkbox);
                        let forD = new FormData();
                        forD.append('service_ids', this.service_checkbox);
                        fetch('{{route("reseller.service.custom.rate.reset.all")}}', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body: forD,
                        }).then(res => res.json())
                            .then(res => {

                                if (res.status === 200) {
                                    setTimeout(() => {
                                        this.loader.page = false;
                                        toastr["success"](res.message);
                                        window.location.reload();
                                    }, 2000);
                                }

                                console.log(res);
                            })
                    } else {
                        alert('No check box is selected');
                    }
                },
                bulkDelete() {
                    if (confirm('Are you sure?')) {
                        this.loader.page = true;
                        if (this.service_checkbox.length !== 0) {
                            //console.log(this.service_checkbox);
                            let forD = new FormData();
                            forD.append('service_ids', this.service_checkbox);
                            fetch('service_bulk_delete', {
                                headers: {
                                    "Accept": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                credentials: "same-origin",
                                method: "POST",
                                body: forD,
                            }).then(res => res.json())
                                .then(res => {

                                    if (res.status === 200) {
                                        setTimeout(() => {
                                            this.loader.page = false;
                                            toastr["success"](res.message);
                                            window.location.reload();
                                        }, 2000);
                                    }

                                    console.log(res);
                                })
                        } else {
                            alert('No check box is selected');
                        }
                    }

                },
                service_bulk_category(evt) {
                    evt.preventDefault();
                    this.loader.page = true;
                    if (this.service_checkbox.length !== 0) {
                        //console.log(this.service_checkbox);
                        let forD = new FormData(document.getElementById('formBulkCategory'));
                        forD.append('service_ids', this.service_checkbox);
                        fetch('service_bulk_category', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body: forD,
                        }).then(res => res.json())
                            .then(res => {

                                if (res.status === 200) {
                                    setTimeout(() => {
                                        this.loader.page = false;
                                        toastr["success"](res.message);
                                        $("#serviceDescription").modal('hide');
                                        window.location.reload();
                                    }, 2000);
                                }

                                console.log(res);
                            })
                    } else {
                        alert('No check box is selected');
                    }
                },
                getProviderServices() {
                    if (this.services.form_fields.provider_id !== null && this.services.form_fields.provider_id !== '') {
                        this.loader.page = true;
                        let forD = new FormData();
                        forD.append('provider_id', this.services.form_fields.provider_id);
                        fetch('{{route("reseller.service.get.provider.data")}}', {
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            credentials: "same-origin",
                            method: "POST",
                            body:forD,
                        })
                            .then(res => {
                                if (!res.ok) {
                                    throw res;
                                }
                                return res.json();
                            })
                            .then(res => {
                                if (res.status) {
                                    if (res.data !==null) {
                                        this.loader.page = false;
                                        this.provider_services = res.data;
                                        this.services.visibility.service_id_by_provider = true;
                                        this.services.validations.provider_service_not_found= '';
                                    }
                                    else
                                    {
                                        this.loader.page = false;
                                        this.services.visibility.service_id_by_provider = false;
                                        this.services.validations.provider_service_not_found= 'Nothing found';
                                        this.services.form_fields.provider_service_id = null;

                                    }
                                }
                            })
                            .catch(err=> {
                                err.text().then(errMessage=>{
                                    this.services.validations.provider_service_not_found= errMessage;
                                    this.services.form_fields.provider_service_id = null;
                                })
                            });
                    }

                },
                getProviderServicesByCategory() {
                    if (!this.provider_id) {
                        return false;
                    }

                    this.loader.page = true;

                    fetch(window.location.origin + '/reseller/providers/' + this.provider_id + '/services', {
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        credentials: "same-origin",
                        method: "POST",
                    })
                        .then(res => {
                            if (!res.ok) {
                                throw res;
                            }

                            return res.json();
                        })
                        .then(response => {
                            this.loader.page = false;

                            if (response.status == 200) {
                                this.categories = response.data;

                                setTimeout(function () {
                                    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                                        if (!$(this).next().hasClass('show')) {
                                            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                                        }
                                        var $subMenu = $(this).next(".dropdown-menu");
                                        $subMenu.toggleClass('show');


                                        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                                            $('.dropdown-submenu .show').removeClass("show");
                                        });

                                        return false;
                                    });
                                }, 1000);
                            } else {
                                alert(response.msg);
                            }
                        })
                        .catch(err => {
                            alert(err);
                        });
                },
                changeSelected() {

                    this.provider_services.forEach(item => {
                        if (item.service  == this.services.form_fields.provider_service_id) {
                            this.provider_service_selected = item;
                        }
                    });

                    if (this.provider_service_selected !== null) {

                        if (this.provider_service_selected.dripfeed === true) {
                            this.services.visibility.drip_feed = true;
                        }
                        else
                        {
                            this.services.visibility.drip_feed = false;
                        }

                        this.services.form_fields.price = this.provider_service_selected.rate;
                        this.services.form_fields.price_original = this.provider_service_selected.rate;

                        this.services.form_fields.min_quantity = this.provider_service_selected.min;
                        this.services.form_fields.max_quantity = this.provider_service_selected.max;
                        this.services.form_fields.auto_min_quantity = this.provider_service_selected.min;
                        this.services.form_fields.auto_max_quantity = this.provider_service_selected.max;
                        this.service_type_selected = this.provider_service_selected.type;
                        console.log(this.service_type_selected);
                        
                    }

                },
                checkUncheckAll(index, event) {
                    if (event.target.checked) {
                        $('.category' + index).prop('checked', true);
                        $('.catControl' + index).prop('checked', true);
                    } else {
                        $('.category' + index).prop('checked', false);
                        $('.catControl' + index).prop('checked', false);
                    }
                },
                selectDropDown(index, value, id) {
                    $('.cat' + index).text(value);

                    if (value == 'Create category') {
                        $('.catControl' + index).val('create');
                    } else {
                        $('.catControl' + index).val(id);
                    }
                },
                checkSibling(e) {
                    $(e.target).siblings().prop('checked', e.target.checked);
                }
            },
        });
        function categorysortable() {
            let allcategory_ids = [];
            $(".category_hidden_id").each(function(i,v){
                allcategory_ids.push($(this).val());
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{route("reseller.category.sort.data")}}',
                data: {'category_ids': allcategory_ids, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    console.log(data);
                }
            });
            console.log(allcategory_ids);
        }
        function serviceSortable() {
            let allservice_ids = [];
            $(".service_checkbox").each(function(i,v){
                allservice_ids.push($(this).val());
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{route("reseller.service.sort.data")}}',
                data: {'services_ids': allservice_ids, "_token": "{{ csrf_token() }}"},
                success: function (data) {
                    console.log(data);
                }
            });
            console.log(allservice_ids);
        }
        $(document).ready(function () {

            $('#selectAllService').click(function () {
                let allids = [];
                if ($(this).prop('checked')) {
                    $('.service_checkbox').each(function (i, v) {
                        allids.push($(this).val());
                    });
                    App.service_checkbox = allids;
                } else {
                    App.service_checkbox = [];
                }

            });
            $("#searchmyInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                console.log(value);
                $(".__table_body .__service_row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            /* jquery UI sortable start here */
            $('.category-sortable').sortable({
                placeholder: "highlight",
                handle: '.category-handle',
                connectWith: ".category-sortable",
                update: categorysortable,
            });
            //$('.__category_row').sortable('disable');
            $('.service_rows').sortable({
                placeholder: "highlight",
                handle: '.service-handle',
                connectWith: ".service_rows",
                update: serviceSortable,
            });

            //$( "#sortable" ).sortable({placeholder: "ui-state-highlight",helper:'clone'});
        });

        function hideService(current)
        {
            let serviceRow = $(current).closest('.__category_row').next('.service_rows');
            if ($(serviceRow).is(':visible'))
            {
                $(serviceRow).hide();
            }
            else
            {
                $(serviceRow).show();
            }

        }
        let allcategoryToggler = false;
        function toggleAllcategory()
        {
            if (allcategoryToggler==false) {
                $("#expand").show();
                $("#compress").hide();
                $('.__category_row').each(function(i,v){
                    $(this).next('.service_rows').hide();
                });
                allcategoryToggler = true;
            }
            else
            {
                $("#expand").hide();
                $("#compress").show();
                $('.__category_row').each(function(i,v){
                    $(this).next('.service_rows').show();
                });
                allcategoryToggler = false;
            }

        }
    </script>
@endsection
