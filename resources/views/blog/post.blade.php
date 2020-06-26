@extends('blog.layouts.app')
{{--@section('title', getOption('app_name') . ' - All Post')--}}
@section('content')

<!-- Page Content -->
			<div class="container-fluid no-left-padding no-right-padding page-content blog-single">
				<!-- Container -->
				<div class="container">
					<div class="row">
						<!-- Content Area -->
						<div class="col-xl-8 col-lg-8 col-md-6 col-12 content-area">
							<article class="type-post">
								<div class="entry-cover">
									<img src="/{{$post->image}}" alt="Post" />
								</div>
								<div class="entry-content">
									<div class="entry-header">
										<span class="post-category"><a href="#" >{{$post->category->name}}</a></span>
										<h3 class="entry-title">{{$post->title}}</h3>
										<div class="post-meta">

											<span class="post-date">{{$post->created_at->format('l j F Y') }}</span>
										</div>
									</div>

								    {!! $post->content !!}


									<div class="entry-footer">

										<ul class="social">
											<li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
										<li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
										 <li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
										<li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
										</ul>
									</div>
								</div>
							</article>
							<!-- About Author -->
							<div class="about-author-box">

								<div class="author">

									<h4>The Social Media Growth</h4>
									<p>The Social Media Growth is a company that helps grow your popularity online. Since our establishment in 2015, we help companies market their products and services more efficiently, to a broader market, for less.<br><br> For individuals, we aim to help you make money as you interact with the world on social media. If you dream of growing your social media presence to become a social media marketer, influencer or brand ambassador, we are here to help you actualize your vision.</p>
								</div>
							</div><!-- About Author /- -->
						</div><!-- Content Area /- -->

					<!-- Widget Area -->
						<div class="col-lg-4 col-md-6 widget-area">
							<!-- Widget : Latest Post -->
                  @include('blog.components.category_sidebar')
                  @include('blog.components.category_popular')


						<!-- Widget : Follow Us -->

							{{-- 	<h3 class="widget-title">FOLLOW US ON INSTAGRAM</h3>
<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
<iframe src="https://cdn.lightwidget.com/widgets/632de326016252c2ad7e7fc50844dda2.html" 
scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;">
</iframe> --}}

					<!-- Begin Sendinblue Form -->
<!-- START - We recommend to place the below code in head tag of your website html  -->
<style>
  @font-face {
    font-display: block;
    font-family: Roboto;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/7529907e9eaf8ebb5220c5f9850e3811.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/25c678feafdc175a70922a116c9be3e7.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 600;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/6e9caeeafb1f3491be3e32744bc30440.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/71501f0d8d5aa95960f6475d5487d4c2.woff) format("woff")
  }

  @font-face {
    font-display: fallback;
    font-family: Roboto;
    font-weight: 700;
    src: url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/3ef7cf158f310cf752d5ad08cd0e7e60.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/ece3a1d82f18b60bcce0211725c476aa.woff) format("woff")
  }

  #sib-container input:-ms-input-placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
    border-width: px;
  }

  #sib-container input::placeholder {
    text-align: left;
    font-family: "Helvetica", sans-serif;
    color: #c0ccda;
    border-width: px;
  }
</style>
<link rel="stylesheet" href="https://assets.sendinblue.com/component/form/2ef8d8058c0694a305b0.css">
<link rel="stylesheet" href="https://assets.sendinblue.com/component/clickable/b056d6397f4ba3108595.css">
<link rel="stylesheet" href="https://assets.sendinblue.com/component/progress-indicator/f86d65a4a9331c5e2851.css">
<link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
<!--  END - We recommend to place the above code in head tag of your website html -->

<!-- START - We recommend to place the below code where you want the form in your website html  -->
<div class="sib-form" style="text-align: center;
         background-color: #ffffff;                                 ">
  <div id="sib-form-container" class="sib-form-container">
    <div id="error-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-width:px; border-color:#ff4949;max-width:350px; border-width:px;">
      <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
        <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
          <path d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z"
          />
        </svg>
        <span class="sib-form-message-panel__inner-text">
                          Your subscription could not be saved. Please try again.
                      </span>
      </div>
    </div>
    <div></div>
    <div id="success-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#085229; background-color:#e7faf0; border-radius:3px; border-width:px; border-color:#13ce66;max-width:350px; border-width:px;">
      <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
        <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
          <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z"
          />
        </svg>
        <span class="sib-form-message-panel__inner-text">
                          Your subscription has been successful.
                      </span>
      </div>
    </div>
    <div></div>
    <div id="sib-container" class="sib-container--medium sib-container--vertical" style="text-align:center; background-color:rgba(255,255,255,1); max-width:350px; border-radius:3px; border-width:1px; border-color:#C0CCD9; border-style:solid;">
          @include('blog.components.newletter_form')
    </div>
  </div>
</div>
<!-- END - We recommend to place the below code where you want the form in your website html  -->

<!-- START - We recommend to place the below code in footer or bottom of your website html  -->
<script>
  window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';

  window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

  window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

  window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";




  window.translation = {
    common: {
      selectedList: '{quantity} list selected',
      selectedLists: '{quantity} lists selected'
    }
  };

  var AUTOHIDE = Boolean(0);
</script>
<script src="https://sibforms.com/forms/end-form/build/main.js">
</script>
<script src="https://www.google.com/recaptcha/api.js?hl=en"></script>
<!-- END - We recommend to place the above code in footer or bottom of your website html  -->
<!-- End Sendinblue Form -->

						</div><!-- Widget Area /- -->

					</div>
				</div><!-- Container /- -->
			</div><!-- Page Content /- -->

		@endsection
