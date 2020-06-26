@extends('blog.layouts.app')
{{--@section('title', getOption('app_name') . ' - Contact Us')--}}
@section('content')
	<!-- Contact-Us Section -->
			<div class="container-fluid no-left-padding no-right-padding contact-section">
			</div>
			<!-- Page Content -->
			<div class="container-fluid no-left-padding no-right-padding page-content">
				<!-- Container -->
				<div class="container">
					<div class="contact-info">
						<img src="assets/images/contact-us.jpg" alt="contact">
						<div class="block-title">
							<h3>Contact Us</h3>
						</div>
						<p>We’d love to hear from you. We read through each and every e-mail we receive, and we try to answer every e-mail… although we frequently get behind so please be patient.</p><p>Have a comment, question or correction? Be sure to include your name, phone number and e-mail address so we can get back to you.</p><p>Use the form below to get in touch with the people at The Social Media Growth. Please fill in all of the required fields - because they're required!</p>
					</div>
					<div class="contact-form">
						<form class="row" method="POST" action="{{url('/mail')}}">

							<div class="col-md-6 form-group">
								<input type="text" class="form-control" placeholder="Your Name (required)" name="name" id="input_name" required>
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" placeholder="Your Email (required)" name="email" id="input_email" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" placeholder="Subject" name="subject" id="input_subject">
							</div>
							<div class="col-md-12 form-group">
								<textarea class="form-control" placeholder="Your message..." rows="5" name="message" id="textarea_message"></textarea>
							</div>
							<div class="col-md-12 form-group no-bottom-margin">
								<button id="btn_submit" name="submit" class="submit">Send</button>
							</div>
							<div id="alert-msg" class="alert-msg"></div>
						</form>
					</div>
				</div><!-- Container /- -->
			</div><!-- Page Content /- -->
@endsection
