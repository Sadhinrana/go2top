@extends('blog.layouts.app')
{{--@section('title', getOption('app_name') . ' - All Post')--}}
@section('content')
<div class="container-fluid no-left-padding no-right-padding page-content">
				<!-- Container -->
				<div class="container">
					<div class="row">
						<!-- Content Area -->
						<div class=" col-lg-8 col-md-6 content-area">
							<!-- Row -->
							<div class="row">
							    	@foreach  ($items as $post)
								<div class="col-lg-6 col-md-12 col-sm-6">
									<div class="type-post">
										<div class="entry-cover">
											<div class="post-meta">
												<span class="post-date"><a href="{{ URL::to('blog/post/'.$post->slug) }}">{{$post->created_at->format('l j F Y') }}</a></span>
											</div>
											<a href="{{ URL::to('blog/post/'.$post->slug) }}"><img src="/{{$post->image}}"  style="height: 250px; width: 370px;" alt="Post" /></a>
										</div>
										<div class="entry-content">
											<div class="entry-header">
												<span class="post-category"><a href="{{ URL::to('blog/post/'.$post->slug) }}" title="Technology">{{$post->category}}</a></span>
												<h3 class="entry-title"><a href="{{ URL::to('blog/post/'.$post->slug) }}" title="Traffic Jams Solved">{{$post->title }} </a></h3>
											</div>
											<p>{{ str_limit(strip_tags($post->description), 100) }}</p>
											<a href="{{ URL::to('blog/post/'.$post->slug) }}" title="Read More">Read More</a>
										</div>
									</div>
								</div>
							@endforeach
							</div><!-- Row /- -->
							<!-- Pagination -->
						        <div class="d-flex justify-content-center font-weight-bold">

                              {{$items->links()}}

                                </div>


						</div><!-- Content Area /- -->

						<!-- Widget Area -->
						<div class="col-lg-4 col-md-6 widget-area">

                            <!-- Widget : Latest Post -->
                          	@include('blog.components.category_sidebar')
							              @include('blog.components.category_popular')



						<!-- Widget : Follow Us -->

								<h3 class="widget-title">FOLLOW US ON INSTAGRAM</h3>
<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/632de326016252c2ad7e7fc50844dda2.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>

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
      <form id="sib-form" method="POST" action="https://2d78b886.sibforms.com/serve/MUIEAKLwXl2WZtp4Ev3alogSNN2fkWAx7LOliJoDkwvZm4rz9j9_pDI9q-aq1F9pMGg6xkFba3lCCwgJxagEAVaOVDpwE3lmIrh8RrxP10tWXvxHjudA6f-QvivBIOnsWxbq1p6DiJDA3vDGwddMF6pbnKnsnS3FdjVTOJ5fN5L3EPt5SoH7zJh8s89n56mhfuk8KIYeJlZHAqXO"
        data-type="subscription">
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="font-size:32px; text-align:center; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent; border-width:px;">
            <p>Newsletter</p>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="font-size:16px; text-align:center; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent; border-width:px;">
            <div class="sib-text-form-block">
              <p>Subscribe to our newsletter and stay updated.</p>
            </div>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-input sib-form-block">
            <div class="form__entry entry_block">
              <div class="form__label-row ">
                <div class="entry__field">
                  <input class="input" maxlength="200" type="text" id="FIRSTNAME" name="FIRSTNAME" autocomplete="off" placeholder="FIRSTNAME" data-required="true" required />
                </div>
              </div>
              <label class="entry__error entry__error--primary" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-width:px; border-color:#ff4949;">
              </label>
            </div>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-input sib-form-block">
            <div class="form__entry entry_block">
              <div class="form__label-row ">

                <div class="entry__field">
                  <input class="input" type="text" id="EMAIL" name="EMAIL" autocomplete="off" placeholder="EMAIL" data-required="true" required />
                </div>
              </div>

              <label class="entry__error entry__error--primary" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-width:px; border-color:#ff4949;">
              </label>
            </div>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-optin sib-form-block">
            <div class="form__entry entry_mcq">
              <div class="form__label-row ">
                <div class="entry__choice">
                  <label>
                    <input type="checkbox" class="input_replaced" value="1" id="OPT_IN" name="OPT_IN" />
                    <span class="checkbox checkbox_tick_positive"></span><span style="font-size:14px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent; border-width:px;"><p>I agree to receive your newsletters and to terms and conditions.</p></span>                    </label>
                </div>
              </div>
              <label class="entry__error entry__error--primary" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-width:px; border-color:#ff4949;">
              </label>
            </div>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="text-align: center">
            <button class="sib-form-block__button sib-form-block__button-with-loader" style="font-size:16px; text-align:center; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#FFFFFF; background-color:#77b243; border-radius:3px; border-width:0px;"
              form="sib-form" type="submit">
              <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon" viewBox="0 0 512 512">
                <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z"
                />
              </svg>
              SUBSCRIBE NOW
            </button>
          </div>
        </div>
        <div style="padding: 8px 0;">
          <div class="sib-form-block" style="font-size:16px; text-align:center; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent; border-width:px;">
            <div class="sib-text-form-block">
              <p>&nbsp;
                <a href="https://thesocialmediagrowth.com/terms" target="_blank">
                  <u>Terms &amp; Privacy policy</u>
                </a>&nbsp;</p>
            </div>
          </div>
        </div>

        <input type="text" name="email_address_check" value="" class="input--hidden">
        <input type="hidden" name="locale" value="en">
      </form>
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
