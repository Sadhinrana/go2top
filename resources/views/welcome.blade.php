@extends('layouts.app_consumer')
@section('content')
     <!-- Main variables *content* -->
     <div class="top-banner" style="padding-bottom: 175.714px;">
        <div class="container">
            <div class="row">
            <div class="col-md">
                    <h1 class="heading">The Social Media Growth, The Only Social Media Marketing Tool You Will Ever Need! </h1>
                    <p class="pera">Social Media Marketing is the use of social media platforms such as Instagram, Facebook, Twitter, YouTube and many more to promote yourself or your company.<br><br>
                            If you are looking for a way to boost your online presence, then your best choice is to use The Social Media Growth, best SMM panel USA, where we offer services to help you boost your online presence across ALL social media platforms using our cheapest SMM panel.<br><br>
                            We have a professional and cheap SMM Panel ready to serve you anytime you need with instant start and amazing speed delivery.<br><br>
                            The Best SMM Panel. The most user-friendly platform. First-class customer support. The greatest benefits on the web. Cheapest SMM panel for Youtube, Facebook, Instagram...etc. Become your own boss today!</p>
                    <a href="{{route('register')}}" class="btn btn-green mr-2 hvr-bob">Register</a>
                    <a href="{{route('login')}}" class="btn btn-white hvr-bob">Sign in</a>
                </div>
            <div class="col-md text-md-right">
                    <div class="card login-panel">
                    <div class="card-body">
                        <div class="title">Sign in</div>
                        <form  method="post" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="username" class="control-label">Email</label>
                                <input type="text" class="form-control" id="username" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group form-group__password {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                <a href="{{ url('/password/reset') }}" class="link float-right forgot-password">Forgot password?</a>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember me
                                </label>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-green hvr-bob">Sign in</button>
                            </div>
                            @if (Session::has('error'))
                                <p class="text-danger">{{Session::get('error')}}</p>
                            @endif
                            <p class="text-center">Do not have an account? <a href="{{ url('/register') }}">Register</a></p>
                            </div>
                            </form>
                            
                    </div>
                </div>
            </div>
            </div>
    </div>
    <div class="wave">
            <img src="{{asset('images/wave-overlay.png')}}">
    </div>
  <section class="advantage-sec">
     <div class="container">
        <h2 class="sec-heading">D means one <span class="blue">success story</span> after another! <small>You can join thousands of satisfied customers to reach major success as they did! </small>
        </h2>
        <div class="row">
           <div class="col-md">
              <div class="card bg-blue">
                 <div class="card-body">
                    <div class="label">Satisfied Clients</div>
                    <div class="numbers">
                      <span class="numscroller roller-title-number-1" data-min="1" data-max="12644" data-delay="5" data-increment="50" data-slno="1">0</span>+
                    </div>
                 </div>
              </div>
           </div>
           <div class="col-md">
              <div class="card bg-green">
                 <div class="card-body">
                    <div class="label">Complete Orders</div>
                    <div class="numbers">
                     <span class="numbers numscroller roller-title-number-2" data-min="1" data-max="185616" data-delay="5" data-increment="800" data-slno="2">0</span>+
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
   <section class="bg-light smm-services"> 
       <div class="container">
            <h2 class="sec-heading">We Offer All Kind Of Services: <span class="blue"></span>
            </h2>
            <div class="row">
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card youtube hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fab fa-instagram hvr-icon"></i> </span>
                            <h3 class="title">cheapest smm panel instagram followers</h3>
                            <p class="pera"><b>Instagram</b>  is one of the most popular social network. When you buy Instagram followers you add more visibility and credibility to your Instagram account and get more engagement without breaking a sweat. 📊<br> <br> 
                                        <b>Buy Ig followers from us and skyrocket your Instagram profile. 🚀</b> <br> <br> TSMG Instagram Panel offers you the Best Quality & opportunity to buy Instagram Followers cheap and get instant fame on Instagram. 🔥
                            </p>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card facebook hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fab fa-facebook hvr-icon"></i> </span>
                            <h3 class="title">best and cheap smm panel for facebook</h3>
                            <p class="pera">If you’re looking to buy Facebook page likes, shares, or promote a post, our website is able to provide you all kind of <b>Facebook</b>  related services. 📈<br> <br> 
                                <b>We have been the safest SMM Reseller Panel on the market from which you can buy Facebook Page likes for good price.</b>  A lot of businesses and brands have trusted us. ✋ <br> <br> Our likes are looking completely like organic likes. Facebook algorithms will recognize it as real like because we use the 'double tapping' method. 👥
                            </p>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card instagram hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fab fa-youtube hvr-icon"></i> </span>
                            <h3 class="title">Cheapest SMM panel for Youtube</h3>
                            <p class="pera">When you buy <b>YouTube</b>  subscribers & buy youtube views  for your channel, you instantly boost your audience, and YouTube will then suggest your video to more and more users. 📈<br> <br> 
                            <b>Those people will see your content and begin to engage with your videos and will follow your channel as well.</b> <br><br> As your subscriber base continues to increase, so do your business’s chances for new customers and higher profits. 🆕🙋‍♂‍</p>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card twitter hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fab fa-twitter hvr-icon"></i> </span>
                            <h3 class="title">Best SMM Panel for TWITTER</h3>
                            <p class="pera"><b>Twitter</b> - there are currently over a billion users worldwide, a lot of politicians and celebrities use Twitter regularly. We give you the opportunity to increase you exposure to by increasing the amount of Twitter followers you have. 📈<br> <br> 
                            <b>Buy Twitter followers to increase your exposure on the social media network and create a larger target audience for you or your brand.</b> <br> <br> Buy twitter followers cheapest today and reach wider audience! 🌐
                            </p>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card soundcloud hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fab fa-pinterest hvr-icon"></i> </span>
                            <h3 class="title">pinterest cheapest smm panel</h3>
                            <p class="pera"><b>Pinterest</b>  may not be as popular as Facebook or Instagram but that also makes the competition low and potential to market much higher.🚀 <b> <br> <br> I have mentioned a few key reasons to get Board followers on Pinterest below.</b>  👇<br> <br> 
                                ✔️ Buy Pinterest followers and increase visibility of your Board <br> 
                                ✔️ Your Board Pin will reach more eyes  <br> 
                                ✔️ Lower investment, higher return <br> 
                                ✔️ A stepping stone for Pinterest marketing. 
                            </p>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 cols">
                    <div class="card other hvr-icon-push">
                        <div class="card-body">
                            <span class="icon"> <i class="fas fa-globe-asia hvr-icon"></i> </span>
                            <h3 class="title">tiktok smm panel</h3>
                            <p class="pera"><b>TikTok</b>  is one of the most downloaded apps of 2019, it has 1 Billion downloads on Google Play store and many people become famous pretty fast. Would you like to become famous on TikTok? 🤔
                            <br> <br> 
                            <b>You can easily buy TikTok followers & likes to become famous within a minute!</b>  🔥
                            <br> <br> 
                            The more activity you have on your videos and profile, the higher TikTok will place your content in the search results and the more engagement you will get on your profile. 📊 
                            </p>   
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center wow zoomIn" data-wow-duration="1s" data-wow-delay="1.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 1.2s; animation-name: zoomIn;"><a href="https://thesocialmediagrowth.com/register" class="btn btn-primary tw-mt-80">Get 10% Bonus on First Deposit!</a>
            </div>
        </div>
    </section>
    <section> 
        <div class="container">
            <div class="row about-D-panel">
                <div class="col-lg-6">

                    <iframe width="100%" height="320" src="https://www.youtube.com/embed/SbsMf7TBHzU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                </div>
                <div class="col-lg-6">
                    <h4 class="title"><b>Why Should You Be Interested In our<span class="blue"> SMM Panel?</span></b></h4>
                    <p class="text">    We have been the leaders in the SMM Panel market for more than 5 years now. We know, what works and what doesn't. <b>We have an extensive list of services in our SMM Panel, at the best quality & cheapest rates</b>. <br><br>    <b>Facebook, Twitter, Instagram, Youtube, TikTok, Soundcloud, Spotify, Website Traffic, Pinterest,</b> and every other social media platform is available in our Cheap SMM Panel.<br>  <br>  <b> We guarantee the Best Quality amongst our competitors</b>. Not only this, but our followers and likes are targeted, have a low drop rate, and are real.<br>  <br>   You have a multitude of options when it comes to choosing the demographics for your audience, be it the <b>USA, Uk, or be it worldwide, be it, men or women, we have it all here</b>. You won't be able to find such quality SMM Panel services anywhere else. </p>
                </div>
            </div>
        </div> 
    </section>  
     
    <section class="bg-light"> 
        <div class="container">
            <h2 class="sec-heading">The Most Trusted And Admired Panel For<span class="blue">Social Media Marketing Services</span></h2>
            <div class="row compare-panel">
                <div class="cols col-lg">
                    <div class="card">
                        <div class="card-header bg-green">
                            <h3 class="card-title">
                            <span class="icon"><img src="futuretheme/img/security.svg"></span>Advantages of using <br>The Social Media Growth</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span>✅ Our team will help you <b>improve your development strategy</b> to drive traffic to your site.</span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span>✅ Our main goal is to <b>provide quality services</b> all over the world. At cheap SMM panel PayPal is also available. </span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span>✅ We provide our users with reliable and <b>efficient social media networks.</b> </span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span><b>✅ The Success and total satisfaction</b> of our customers are priorities on our best SMM panel cheap.</span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span>✅ On our site, you will find the <b>most profitable and affordable offers</b> for every wallet and taste. </span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span><b>✅ We work 24/7 to provide</b> you with all the necessary information and quick help. </span>
                                </li>
                                <li class="list-group-item hvr-icon-up">
                                    <span class="icon"><i class=""></i></span> <span>✅ Our team treats each client <b>with care and respect</b> and provides professional advice. </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <div class="wave" style="margin-top: -175.714px;">
        <img src="/images/wave-overlay.png">
    </div>
  {{-- social media growth --}}
    <section> 
        <div class="container">
            <h2 class="sec-heading">
            The Social Media Growth is a <span class="blue">mile</span> ahead of the competition! 
            </h2>
            <div class="row services-panel">
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fas fa-shipping-fast hvr-icon"></i> </span>
                        <h3 class="text">Delivered Within Minutes</h3>
                    </div>
                    <p class="pera">At D we are all about helping your business. Our dedicated team are taking care of your orders and are making sure you get everyone of them on time.<br><br> You just have to <b>select the social media marketing services</b>  you want and order it. Simple as that.<br><br> Our delivery is automated and usually, it <b>takes minutes if not seconds to deliver your order</b> .</p>
                </div>
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fas fa-phone"></i> </span>
                        <h3 class="text">Support 24/7</h3>
                    </div>
                    <p class="pera">We are so proud to have the best support in the SMM World, replying to your <b>Tickets, E-mails, WhatsApp & Skype 24/7.</b> <br><br>We are here for you only <b>24 hours a day and 7 times a week</b>  to help you and support you with all your demands and services around the day.<br><br> If you have any question or concern related to our Smm Panel or Business don't hesitate and feel free to contact us</b> . </p>
                </div>
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fab fa-cc-paypal"></i> </span>
                        <h3 class="text">Payment methods</h3>
                    </div>
                    <p class="pera">Our Cheap SMM Panel is always ready to take on every one of your orders and please have in mind that <b>we accept auto payments</b>.<br><br> We accept <b>PAYPAL, COINPAYMENTS, SKRILL and ANY CREDIT/DEBIT CARD</b> as payment methods.</p><br><br>The Social Media Growth is giving <b>10% Bonus on your First Deposit!</b> Find out more about Bonuses on Deposit page.</p>
                </div>
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fas fa-shopping-cart"></i> </span>
                        <h3 class="text">quick boost in Sales</h3>
                    </div>
                    <p class="pera">
                    It is true that SMM can play a vital role in <b>increasing your sales</b>. As mentioned above, there are over a billion IG and FB users.<br><br> These users regularly spend quality time on social networking. In this time they update status, they like posts and check new services. As they find something <b>interesting and innovative</b>, they approach the service provider.<br><br> If the services are cost-effective and useful, they can provide sales. <b>You can also be one of these services</b>, which gains the interest of social networking site users.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fas fa-bolt"></i> </span>
                        <h3 class="text">Quick Content Distribution</h3>
                    </div>
                    <p class="pera"><b>We will provide you with the likes and views you need to boost your social media marketing campaign</b>.<br><br> Suppose you have bought 1000 IG likes, those 1000 likes will shortly convert into 5000 and then 10000 likes. It happens because people check your content and share it. <br><br>Once they have shared it, many other social networking site users check the details related to your business. Therefore, <b>quick content distribution occurs on social networking sites</b>.<br> It can benefit any online business and offer a quick boost in sales.</p>
                </div>
                <div class="col-lg-4 col-md-6 cols hvr-icon-push">
                    <div class="title">
                        <span class="icon"> <i class="fas fa-users"></i> </span>
                        <h3 class="text">Quick Response From Clients</h3>
                    </div>
                    <p class="pera">You probably have a lot of active customers. Other companies regularly publish new offers and product details on social networking sites.<br><br> If the customers <b>are satisfied with the services</b>, they like published content. If the customers are <b>not satisfied</b>, they comment on their problems frequently.<br><br> It offers business owners an <b>awesome opportunity of knowing the areas where they lack to entertain the customers</b> .</p>
                </div>
            </div>
        </div> 
    </section>
    <h2 class="sec-heading">PAYMENT METHODS WE ACCEPT<span class="blue"></span> <small>At TSMG we want you to feel secure and comfortable when you purchase from us, you can be assured that processing your payments is <span class="blue">safe, fast and simple.</span><br> <br> We accept <b>PayPal</b>, <b>Stripe</b>, <b>PayOp</b>, <b>Cryptocurrency</b>, <b>Skrill</b>, and <b>Payoneer</b> as payment methods.</small>
    </h2>
    <section class="payment-icons"> 
        <div class="container">
            <ul>
                <li><img src="{{asset('futuretheme/img/pp-icon.png')}}"></li>
                <li><img src="{{asset('futuretheme/img/bit-cash-icon.png')}}"></li>
                <li><img src="{{asset('futuretheme/img/pp-icon.png')}}"></li>
                <li><img src="{{asset('futuretheme/img/bit-icon.png')}}"></li>
                <li><img src="{{asset('futuretheme/img/pm-icon.png')}}"></li>
                <li><img src="{{asset('futuretheme/img/payoneer-icon.png')}}"></li>
            </ul>
        </div> 
    </section>
    <section class="bg-light pb-0"> 
        <div class="container">
            <h2 class="sec-heading">HAPPY CLIENTS <span class="blue"></span> <small>At The Social Media Growth, your happiness is guaranteed.<br> <br>If the client is happy then the relationship with us can only get better therefore <span class="blue">we only care about YOU being HAPPY!</span></small>
            </h2>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row-title">Customer Feedback &amp; Reviews</div> 
                    <div class="rating style11">
                        <span class="active"></span> 
                        <span class="active"></span> 
                        <span class="active"></span> 
                        <span class="active"></span> 
                        <span class="active"></span>
                    </div> 
                    <div class="row-subtitle style12">
                        5 out of 5 stars (170 reviews)
                    </div> 
                    <div class="divider divider-center">
                        <div class="icon-circle"></div>
                    </div>
                </div>
            </div>
            <div id="testimonials" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto">
                    <div class="carousel-item col-lg-4 col-md-6 active">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/paris.jpg')}}">   </span>
                        <div class="title-panel">
                            <h4 class="card-title">@parris04</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">I've been using this panel for more than a month now. I got to say this is the best panel yet!👏 Every single service works and has a cheap price. Also, ticket support is very fast and helpful. I will definitely use these guys as my main source in the future.😃</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/winter.jpg')}}">     </span>
                        <div class="title-panel">
                            <h4 class="card-title">@winterevans1</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">Hey, I’d just like to say - your site is so easy to use! The color scheme makes it so easy to navigate! 10/10. It’s the best of any panel I’ve ever seen. Thank you so much for all the positive service throughout my experiences with The Social Media Growth.❤️</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/jp.jpg')}}">     </span>
                        <div class="title-panel">
                            <h4 class="card-title">@jpescala</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">I ordered IG followers, I received good quality followers. Highly recommended, and I'll definitely order again… I have been using The Social Media Growth for a week now and it is easily the best panel I have used. Great prices, easy to use and always updated. Great job!👍</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/2.jpg')}}">     </span>
                        <div class="title-panel">
                            <h4 class="card-title">@fitness_chick_uae</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">After using almost all of the big SMM panels I can confirm that The Social Media Growth is the best. Ordered huge volumes of Instagram likes & comments.🖤 Everything was delivered fast and steady with barely any drop. They looked organic and real. Thanks again!🙂</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/cometomeno.jpg')}}">     </span>
                        <div class="title-panel">
                            <h4 class="card-title">@cometomemo</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">Used this service for a week and made about 15 orders of different services. There was a pause in supplying likes, but eventually, everything was delivered at full. I was satisfied with the replies I had on skype support. It's a good service, I can only recommend.👏</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/crom.jpg')}}">    </span>
                        <div class="title-panel">
                            <h4 class="card-title">@cromwellliz</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">I like this panel, I actually face a problem with my first try but support was there, and they help me to fix that problem. It's one of the best panels.👍 I tried many panels and I can say now that The Social Media Growth is on top 5 panels with good prices and perfect support.</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                    <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/wudiam.jpg')}}">  </span>
                        <div class="title-panel">
                            <h4 class="card-title">@stevesandeds</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">I highly recommend his services and am very grateful for this seller. Once the followers are delivered they do stay on the account with minimal drop. Communication is good and delivery is usually prompt and on time. Thanks for everything you did for me.🖤🖤</p>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body"> <span class="avatar rounded-circle">        <img src="{{asset('futuretheme/img/brandon.jpg')}}">   </span>
                                <div class="title-panel">
                                    <h4 class="card-title">@brandonpprose</h4>
                                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p class="card-text">The Social Media Growth has changed my life. I use TSMG to boost my clients' exposure on YouTube and Facebook, TSMG has made this job 1000 times easier for me. I cannot thank them enough, I am spending here less than 1% of my earnings.😍</p>
                                </div>
                            </div>
                        </div>
                    <div class="carousel-item col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body"> <span class="avatar rounded-circle">        <img src="futuretheme/img/butik.jpg">   </span>
                        <div class="title-panel">
                            <h4 class="card-title">@nadinegeorgeboutique</h4>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text">The Social Media Growth has helped  my company a lot. Over the past 4 months, my company sales have increased  widely after I started using The Social Media Growth on my company’s Instagram to boost it. All recommendations! Thanks for all you do!❤️</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="controls-nav">
                    <div class="row">
                    <div class="col-12 text-center mt-4">
                        <a class="prev link hvr-icon-back" href="javascript:void(0)" title="Previous"> <i class="fa fa-arrow-left hvr-icon"></i> <span>Prev</span> </a> <a class="next link hvr-icon-forward" href="javascript:void(0)" title="Next"> <i class="fa fa-arrow-right hvr-icon"></i> <span>Next</span> </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="support-panel">
                {{-- <div class=" "></div>
                <div class="container position-relative">
                <h3 class="title">
                        <i class="fa fa-star"></i> <span> D is here 24/7 to help your SMM Business be up and running all the time!</span>
                    </h3>
                <div class="row">
                    <div class="col-md">
                    <div class="card"> <a href="support" class="card-body hvr-icon-pop"><i class="fa fa-comments"></i> Support Ticket</a>
                    </div>
                    </div>
                    <div class="col-md">
                    <div class="card"> <a href="mailto:support@yoursite.com" class="card-body hvr-icon-pop"><i class="fa fa-envelope hvr-icon"></i> support@yoursite.com</a>
                    </div>
                    </div>
                    <div class="col-md">
                    <div class="card"> <a href="skype:smmpanelbd?add" class="card-body hvr-icon-pop"><i class="fab fa-skype"></i> yoursite</a>
                    </div>
                    </div>
                </div>
                </div>  --}}
                <section id="work-process" class="work-process">
                <!-- End Work BG Pattern -->
                    <div class="container">
                        <div class="row text-center">
                            <div class="col section-heading wow fadeInDown" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInDown;">
                            <h2>
                                <b>The Working <span class="blue">Process:</span></b><br><br></h2>
                                <span class="animate-border ml-auto mr-auto tw-mt-20"></span>
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->
                        <link rel="stylesheet" type="text/css" href="home/work.css">
                        <div class="row">
                            <div class="col-md-3">
                            <div class="tw-work-process">
                                <div class="process-wrapper d-table wow zoomIn" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: zoomIn;">
                                    <div class="process-inner d-table-cell">
                                        <img src="/home/pr2.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <!-- End process wrapper -->
                                <p>01. Register On Our Panel</p>
                            </div>
                            <!-- End Tw work process -->
                            </div>
                            <!-- End Col -->
                            <div class="col-md-3">
                            <div class="tw-work-process">
                                <div class="process-wrapper bg-orange d-table wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: zoomIn;">
                                    <div class="process-inner d-table-cell">
                                        <img src="/home/pr1.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <!-- End Process Wrapper -->
                                <p>02. Choose any SMM Service<br><br><br></p>
                            </div>
                            <!-- End Word Process -->
                            </div>
                            <!-- End Col -->
                            <div class="col-md-3">
                            <div class="tw-work-process">
                                <div class="process-wrapper bg-blue d-table wow zoomIn" data-wow-duration="1s" data-wow-delay=".6s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.6s; animation-name: zoomIn;">
                                    <div class="process-inner d-table-cell">
                                        <img src="/home/pr3.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <!-- End Process Wrapper -->
                                <p>03. Buy the Service</p>
                            </div>
                            <!-- End Work Process -->
                            </div>
                            <!-- End Col -->
                            <div class="col-md-3">
                            <div class="tw-work-process">
                                <div class="process-wrapper bg-yellow d-table wow zoomIn" data-wow-duration="1s" data-wow-delay=".8s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.8s; animation-name: zoomIn;">
                                    <div class="process-inner d-table-cell">
                                        <img src="/home/krug.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <!-- End PRocess Wrapper -->
                                <p>04. Reach Your Target<br><br></p>
                            </div>
                            <!-- End Work Process -->
                            </div>
                            <!-- End Col -->
                            
                            <div class="col-md-12 text-center wow zoomIn" data-wow-duration="1s" data-wow-delay="1.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 1.2s; animation-name: zoomIn;"><a href="https://thesocialmediagrowth.com/register" class="btn btn-primary tw-mt-80">Start Reaching your Goals TODAY!</a></div>
                        </div>
                        <!-- End Row -->
                    </div>
                <!-- End Container -->
            </section>
        </div> 
    </section>

    <section> 
            <div class="container">
                <h2 class="sec-heading">How to become a <span class="blue">VIP member</span> of The Social Media Growth? <small><b>Receive an exclusive discount and save up to 30% on all services!</b> </small>
                </h2>
                <div class="row marketing-panel">
                    <div class="col-md-7 mb-3">
                        <p class="font-weight-bold">Join our VIP program and take advantage of lower fees, 24/7 support, special promotions, and extra security!</p>
                        <p>The entry rules are simple: the more you spend using your The Social Media Growth balance, the more benefits, and rewards you earn through membership of our exclusive VIP program. We have different Account Levels:</p>
                        <ul class="list">
                            <li><i class="fa fa-check-circle"></i> <b>Junior / 200$ Spent - 10% Discount!</b></li>
                            <li><i class="fa fa-check-circle"></i> <b>Elite / 500$ Spent - 15% Discount!</b></li>
                            <li><i class="fa fa-check-circle"></i> <b>Master / 1000$ Spent - 20% Discount!</b></li>
                            <li><i class="fa fa-check-circle"></i> <b>Vip / 2000$ Spent - 30% Discount!</b></li>
                        </ul>
                        <br>
                        <p>Account level depends on the total amount of money spent on our website since the account is created. Depend on the Account Level, you can achieve up to 30% Discount on all services and save your money! Take the first step, start ordering, become a VIP member, and  get exclusive discounts!</p>
                        <a href="https://thesocialmediagrowth.com/" taget="_blank" class="btn btn-green btn-custom hvr-bob">Start ordering and become VIP!!</a><br><br>
                        <h2 class="sec-heading">Join our <span class="blue">Premium WhatsApp Group!</span></h2><br>
                        <p>We are not just here to make money. We are also here to help you achieve your goals and make your dreams come true.<p>We created a Premium WhatsApp Group where all our customers can join. Every user who joins the group will be added to the list. <b>Every Sunday at 10 pm GMT we are doing Giveaway</b> where we will choose Random Winner from the list who will get <b>5$ For Free</b> on his balance.<p>Also, all users who are in groups will be notified about everything that is happening on the website:</p></p>
                        <ul class="list">
                            <li><i class="fa fa-check-circle"></i> <b>Best working services!</b></li>
                            <li><i class="fa fa-check-circle"></i> <b>Every time we add a new category or service!</b></li>
                            <li><i class="fa fa-check-circle"></i> <b>Every time we give Deposit Bonus!</b></li>
                        </ul>
                        <br>
                        <a href="https://chat.whatsapp.com/JiePvtsXX1k6BYBs9ni4pN" taget="_blank" class="btn btn-green btn-custom hvr-bob">You can join a group here!</a>
                    </div>
                    <div class="col-md-5">
                        <img src="futuretheme/img/vip.png" class="floating-left-right sticky-top">
                    </div>
                </div>
            </div> 
    </section>
@endsection