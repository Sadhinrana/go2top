@extends('layouts.app_consumer')
@section('content')
<section class="mt-5">
    <div class="container">
        <div class="row justify-content-center register-panel" id="register-frontEnd">
            <div class="col-lg-7">
                <div class="card bg-white">
                    <div class="card-header">
                        <div class="card-title">
                            Register
                            <small>Get started With The Social Media Growth!</small>
                        </div>
                    </div>
                    <div class="card-body" >
                        <form  method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Username:</label>
                                <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Enter Username">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email:</label>
                                <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label>WhatsApp (optional):</label>
                                <input type="text" class="form-control" id="skype_id"  value="{{ old('skype_id') }}" name="skype_id" placeholder="Enter WhatsApp">
                            </div> --}}
                            <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Confirm password:</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm password">
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="agreement" required> I agree to the Terms of Service & to receive emails and updates
                                </label>
                                @if ($errors->has('agreement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agreement') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-green">Register Here</button>
                            <span class="bottom-link">Already have an account? <a href="/login">Sign in</a> </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <h2 class="sec-heading">Learn How To Use <span class="blue">The Social Media Growth Panel</span></h2>
        <div class="row">
            <div class="col-md-4">
                <h1 class="sec-heading"><small><b>Watch How to Deposit Money:</b></small></h1>
                <iframe width="100%" height="320" src="https://www.youtube.com/embed/ORGwVWbC4uo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-4">
                <h1 class="sec-heading"><small><b>Watch How to Order Followers:</b></small></h1>
                <iframe width="100%" height="320" src="https://www.youtube.com/embed/xHL3QGCNwPg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-4">
                <h1 class="sec-heading"><small><b>Watch How to Order Likes:</b></small></h1>
                <iframe width="100%" height="320" src="https://www.youtube.com/embed/WSSRHABdWzs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
@endsection


{{-- <!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Go2Top register</title>
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
        <div class="auth-box">
            <div>
                <div class="logo">
                    <span class="db"><img src="{{ asset('assets/images/logos/logo-icon.png') }}" alt="logo" /></span>
                    <h5 class="font-medium mb-3">Sign Up to Go2Top</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row ">
                                <div class="col-12 ">
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 ">
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 ">
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 ">
                                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 ">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="terms_of_service" id="customCheck1" required>
                                        <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>

                                        @error('terms_of_service')
                                        <span class="invalid-feedback" role="alert" style="display: block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center ">
                                <div class="col-xs-12 pb-3 ">
                                    <button class="btn btn-block btn-lg btn-info " type="submit ">SIGN UP</button>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-2 ">
                                <div class="col-sm-12 text-center ">
                                    Already have an account? <a href="{{ route('login') }}" class="text-info ml-1 "><b>Sign In</b></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
</script>
</body>

</html> --}}
