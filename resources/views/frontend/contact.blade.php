@extends('frontend.master')

@section('title')
    Contact - Blog TEST
@endsection

@section('content')

    <body>

    <!-- Navigation -->
    @include('frontend.nav')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('frontend/img/contact-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon
                    as
                    possible!</p>
                <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
                <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
                <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
                <form id="contactForm" name="sentMessage" novalidate>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Name</label>
                            <input class="form-control" data-validation-required-message="Please enter your name." id="name" placeholder="Name" required type="text">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email Address</label>
                            <input class="form-control" data-validation-required-message="Please enter your email address." id="email" placeholder="Email Address" required type="email">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input class="form-control" data-validation-required-message="Please enter your phone number." id="phone" placeholder="Phone Number" required type="tel">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message</label>
                            <textarea class="form-control" data-validation-required-message="Please enter a message." id="message" placeholder="Message" required rows="5"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <button class="btn btn-primary" id="sendMessageButton" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; CodeGym 2021</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ asset('frontend/js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('frontend/js/contact_me.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('frontend/js/clean-blog.min.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    </body>

@endsection
