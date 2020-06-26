@extends('layouts.app_consumer')
@section('content')
   {{--  <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> @lang('menus.dashboard')</a></li>
                <li><a href="{{ url('/payment/add-funds') }}"> @lang('menus.payment_methods')</a></li>
                <li class="active">Bitcoin</li>
            </ol>
        </div>
    </div> --}}
    <div id="bitcoin_id">
        <div class="container d-flex justify-content-center align-items-center" style="height: calc(100vh - 300px)">
            <div class="login-form">
                <div style="text-align: left;">
                    <a href="https://www.coinpayments.net/" rel="noopener noreferrer" target="_new"><img src="https://www.coinpayments.net/images/pub/buynow-grey.png" width="250" alt="CoinPayments Logo"></a>
                </div>
                <form id="payment-form"
                      role="form"
                      method="POST"
                      action="{{ url('/payment/add-funds/bitcoin') }}">
                    {{ csrf_field() }}
                    <fieldset class="scheduler-border">
                        <div class="form-group">
                            <p id="card-errors" style="color:red"></p>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}" style="padding-bottom: 0;margin-bottom:0">
                            <label class="control-label" for="amount">@lang('forms.amount') (USD)</label>
                            <input class="form-control"
                                   name="amount"
                                   id="amount"
                                   data-validation="number"
                                   type="text">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top:15px;">
                           <button type="submit" class="btn btn-green">Pay</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function () {
        $.validate({
            form: '#payment-form',
            modules: 'date',
            validateOnBlur: false,
            onSuccess: function (e) {
                $('.submit-btn')
                    .attr('disabled',true)
                    .empty()
                    .html(spinner);
            }
        });
    });
</script>
@endpush