<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=pt154">
    <!-- Google Tag Manager -->
    <script>/*(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-MG6NCDC');*/
    </script>
    <!-- End Google Tag Manager -->
    <!-- Facebook Pixel Code -->
    <script>
        /*!function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2517393695046494');
        fbq('track', 'PageView');*/
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=2517393695046494&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0092/5998.js" async="async"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="snEa0FIM8o1WtBV3vrWc8F1KCSGwP8rkBjsz1EYR">
    <meta name="description" content="TheSocialMediaGrowth is the Worlds Best & Cheap SMM Panel With Highest Quality Services On The Market. Join Best Instagram SMM Panel With 24/7 Customer Support. Perfect For Resellers And Agencies.">
    <meta name="keywords" content="Cheap SMM panel, Best SMM panel USA, Cheapest smm panel, Best and cheap smm panel, cheapest smm panel paypal, Tiktok smm panel">
    <title>Best And reasonable SMM Panel - The Social Media Growth</title>
    <link rel="shortcut icon" href="{{asset('images/favicony.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('stp/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('stp/css/style2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist/reseller/frontend/css/main.css')}}">
    <!-- Font -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"  crossorigin="anonymous">
    <link rel = "dns-prefetch" href = "https://drive.google.com">
    <link rel = "dns-prefetch" href = "https://static.doubleclick.net">
    <!-- toastr CSS -->
    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".google-auto-placed").attr("style", "position: absolute; padding-right: 525px;");
        });
    </script>
</head>
<body style="overflow: visible;">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MG6NCDC"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+381 612141454", // WhatsApp number
            email: "info@thesocialmediagrowth.com", // Email
            call_to_action: "Hello, how may we help you?", // Call to action
            button_color: "#A8CE50", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "whatsapp,email", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
<div style="position:fixed;top:0px;left:0px;width:0;height:0;" id="scrollzipPoint"></div>
<header  @if (!Request::is('/') && !Request::is('login') ) style="position:inherit" @endif>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            <i class="fa fa-bars"></i>
            </span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{asset('/images/logo.png')}}" >
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        @foreach($public_menus as $p_menu)
                            <li class="nav-item topBotomBordersIn">
                                @php($page_url = $p_menu->menu_link_id == null? $p_menu->external_link: $p_menu->url);
                                <a class="nav-link" href="{{url($page_url)}}">
                                    {{ $p_menu->menu_name }}
                                </a>
                            </li>
                        @endforeach
                    @endguest
                        @auth
                            @foreach($signed_menus as $p_menu)
                                <li class="nav-item topBotomBordersIn">
                                    @php($page_url = $p_menu->menu_link_id == null? $p_menu->external_link: $p_menu->url);
                                    <a class="nav-link" href="{{url($page_url)}}">
                                        {{ $p_menu->menu_name }}
                                    </a>
                                </li>
                            @endforeach
                        @endauth

                    @if (Auth::guest())
                        <li class="nav-item topBotomBordersIn" @if(count($public_menus)>0) style="margin-top: 20px;" @endif>
                            <a class="nav-link" href="{{ URL::to('/login')}}">
                                Sign In
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            @if (Auth::guest())
                <div class="navbar-right">
                    <a class="btn btn-green hvr-bob" href="{{ URL::to('/register')}}">Register</a>
                </div>
            @else
            <a href="/addfunds" class="badge badge-green float-left hide-lg">${{auth()->user()->balance()}}</a>
                <div class="dropdown float-left">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" id="myAccount" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> </a>
                    <div class="dropdown-menu" aria-labelledby="myAccount">
                    <a href="{{url('account')}}" class=" dropdown-item">Account</a> <a href="/logout" class="dropdown-item"  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endif
        </nav>
    </div>
</header>
<div class="container-div">
    @yield('content')
</div>
<footer class="bg-blue" style="margin-top: 61.5px;">
    @if (Request::is('/') || Request::is('login'))
        <div class="wave">
            <img src="/images/wavee.jpg">
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                  <span class="logo">
                  <img src="{{asset('images/logo.png')}}" alt="Cheapest SMM Panel - Best SMM Reseller Panel D" title="Cheapest SMM Panel - Best SMM Reseller Panel D">
                  </span>
                <p class="font-italc">D is a company that helps grow your popularity online. Since our establishment in 2015, we help companies market their products and services more efficiently, to a broader market, for less. For individuals, we aim to help you make money as you interact with the world on social media. If you dream of growing your social media presence to become a social media marketer, influencer or brand ambassador, we are here to help you actualize your vision. </p>
            </div>
            <div class="col-md-6 text-center-md">
                <div class="footer-support-panel">
                    <h3 class="title">Support</h3>
                    <ul>
                        <li>
                            <a href="/support">
                                <i class="fa fa-comments"></i> Support Ticket
                            </a>
                        </li>
                        <li>
                            <a href="mailto:info@thesocialmediagrowth.com">
                                <i class="fa fa-envelope"></i> info@thesocialmediagrowth.com
                            </a>
                        </li>
                        <li>
                            <a href="skype:live:socialmediagrowthh">
                                <i class="fab fa-skype"></i> socialmediagrowthh
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                © D Copyright 2020 - All right reserved.
                <a class="link" href="/terms">Terms of Service</a>
            </div>
            <div class="footer-links" target="_blank">
                <a href="https://www.instagram.com/the_socialmedia_growth/" target="_blank">
                    <i class="fab fa-instagram"></i>
                    <a href="https://www.facebook.com/TheSocialMediaGrowth/" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                </a>
                <a href="https://www.youtube.com/channel/UCSjQ0UUBZeQm7FZqP4yMzPA?view_as=subscriber&fbclid=IwAR1sohTLDh-f048YkFXotGWMZdtgXyj5RdS1otuMb8czmpWXaRFCkk7XXCc">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://twitter.com/SMM_Growth" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.pinterest.com/thesocialmediagrowth/" target="_blank">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Preloader -->
<script>
    $(window).on('load', function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow':'visible'});
    })
</script>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{{asset('stp/js/underscore-min.js')}}"></script>
<script type="text/javascript" src="{{asset('stp/js/main85fd.js?v=1553413629')}}"></script>
<script type="text/javascript" src="{{asset('stp/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('stp/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="https://res.cloudinary.com/dgf0nrkpr/raw/upload/v1545347702/panel_styles/snow.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Snowstorm/20131208/snowstorm-min.js"></script>
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
    var snowStorm = (function(window, document) {
        this.zIndex = 999;
        this.flakeWidth = 20;
        this.snowColor = '#d1dff1';
        freezeOnBlur = false;
    }(window, document));
</script>
<script>
    function init() {
        var imgDefer = document.getElementsByTagName('img');
        for (var i = 0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute('data-src')) {
                imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
            }
        }
        var vidDefer = document.getElementsByTagName('iframe');
        for (var i = 0; i < vidDefer.length; i++) {
            if (vidDefer[i].getAttribute('data-src')) {
                vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
            }
        }
    }
    window.onload = init;
</script>
<script>
    var beamer_config = {
        product_id : 'inkofzca14330' //DO NOT CHANGE: This is your product code on Beamer
    };


    $(function(){
        @if (session('success'))
            toastr["success"]('{{ session('success') }}');
        @endif

        @error('error')
        Swal.fire({
            type: 'error',
            title: '500 Internal Server Error!',
            html: 'Something went wrong! <br> <span class="error-message text-danger d-none">{{ $message }}</span>',
            footer: '<a href="javascript:void(0)" onclick="document.querySelector(\'.error-message\').classList.remove(\'d-none\');">Why do I have this issue?</a>'
        });
        @enderror
    });
</script>
<script type="text/javascript" src="https://app.getbeamer.com/js/beamer-embed.js" defer="defer"></script>
@yield('page_js')
</body>
</html>
