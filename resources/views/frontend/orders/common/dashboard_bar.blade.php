<!-- ============================================================== -->
<!-- Card Group  -->
<!-- ============================================================== -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card order-dashboard">
                <div class="card-body table">
                    <div class="table-cell">
                        <div class="icon rounded-circle">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="content-box">
                            <div class="title">Total Orders on TSMG</div>
                            <div class="numbers">154258</div>
                            <div class="des-sec">5+ years experience providing SMM services! 🥇</div>
                        </div>
                    </div>

                </div>
                <a href="/orders" class="btn btn-overlay bg-green">View your Orders!️️</a>
            </div>
        </div>
        <div class="col">
            <div class="card order-dashboard">
                <div class="card-body table">
                    <div class="table-cell">
                        <div class="icon rounded-circle">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="content-box">
                            <div class="title">Current Balance</div>
                            <div class="numbers">42874511454</div>
                            <div class="des-sec">Spend your balance and enjoy our services! 🤗</div>

                        </div>
                    </div>
                </div>
                <a href="/addfunds" class="btn btn-overlay bg-green">Deposit now!</a>
            </div>
        </div>


        <div class="col">
            <div class="card order-dashboard">
                <div class="card-body table">
                    <div class="table-cell">
                        <div class="icon rounded-circle" >

                            <i class="fa fa-child"></i>
                        </div>
                    </div>
                    <div class="table-cell">
                        <div class="content-box" style="cursor: pointer;" onclick="openAccountStatus();" >
                            <div class="title" >Click to view Account Status</div>
                            <div class="numbers">{{ Auth::user()->astatus }}</div>
                            <div class="des-sec">Your total spending:  458744558 💰</div>

                        </div>
                    </div>
                </div>
                <a href="#" data-toggle="modal" data-target="#exampleModal"class="btn btn-overlay bg-green">View your Account Status!</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col pt-3">
                    @if (Session::has('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Message! </strong>{{Session::get('success')}}.
                        </div>
                    @elseif (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Error! </strong>{{Session::get('error')}}.
                        </div>
                    @elseif ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>Warning! </strong>{{$error}}.
                            </div>
                        @endforeach
                        
                    @else
                        <div style="height: 80px; width: 100%"></div>
                    @endif
                    
                </div>
            </div>
        </div>
        
        {{-- <script src="https://cdn.logwork.com/widget/countdown.js"></script>
        <a href="https://logwork.com/countdown-jgd" class="countdown-timer" data-timezone="Europe/Belgrade" data-date="2020-04-11 22:00" data-background="#77b243" data-digitscolor="#ededed">
            10% Deposit Bonus Ends In:
        </a> --}}

    </div>
</div>
