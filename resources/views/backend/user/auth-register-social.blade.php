<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from sb-admin-pro.startbootstrap.com/auth-register-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Mar 2021 08:49:40 GMT -->
<head>
    <meta charset="utf-8"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
    <meta content name="description"/>
    <meta content name="author"/>
    <title>Register - Blog TEST</title>
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon" type="image/x-icon"/>
    <script crossorigin="anonymous" data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    <script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9">
                        <!-- Social registration form-->
                        <div class="card my-5">
                            <div class="card-body p-5 text-center">
                                <div class="h3 font-weight-light mb-3">Create an Account</div>
                                <div class="small text-muted mb-2">Sign in using...</div>
                                <!-- Social registration links-->
                                <a class="btn btn-icon btn-facebook mx-1" href="#!"><i class="fab fa-facebook-f fa-fw fa-sm"></i></a>
                                <a class="btn btn-icon btn-github mx-1" href="#!"><i class="fab fa-github fa-fw fa-sm"></i></a>
                                <a class="btn btn-icon btn-google mx-1" href="#!"><i class="fab fa-google fa-fw fa-sm"></i></a>
                                <a class="btn btn-icon btn-twitter mx-1" href="#!"><i class="fab fa-twitter fa-fw fa-sm"></i></a>
                            </div>
                            <hr class="my-0"/>
                            <div class="card-body p-5">
                                <div class="text-center small text-muted mb-4">...or enter your information below.</div>
                                <!-- Login form-->
                                <form method="post" action="{{ route('admin.checkRegister') }}">
                                @csrf
                                <!-- Form Group (email address)-->
                                    <div class="form-group">
                                        <label class="text-gray-600 small" for="emailExample">Email address</label>
                                        <input aria-describedby="emailExample" aria-label="Email Address" class="form-control form-control-solid" name="email" placeholder type="text"/>
                                        @if($errors->any() && $errors->first('email'))
                                            <div>
                                                <p class="alert-danger">{{ $errors->first('email') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Form Row-->
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <!-- Form Group (choose password)-->
                                            <div class="form-group">
                                                <label class="text-gray-600 small" for="passwordExample">Password</label>
                                                <input aria-describedby="passwordExample" aria-label="Password" class="form-control form-control-solid" name="password" placeholder type="password"/>
                                                @if($errors->any() && $errors->first('password'))
                                                    <div>
                                                        <p class="alert-danger">{{ $errors->first('password') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Form Group (confirm password)-->
                                            <div class="form-group">
                                                <label class="text-gray-600 small" for="confirmPasswordExample">Confirm
                                                    Password</label>
                                                <input aria-describedby="confirmPasswordExample" aria-label="Confirm Password" class="form-control form-control-solid" placeholder name="password_confirmation" type="password"/>
                                                @if($errors->any() && $errors->first('password_confirmation'))
                                                    <div>
                                                        <p class="alert-danger">{{ $errors->first('password_confirmation') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Form Group (form submission)-->
                                    <div class="form-group d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-control-solid custom-checkbox">
                                            <input class="custom-control-input small" id="customCheck1" type="checkbox"/>
                                            <label class="custom-control-label mr-3" for="customCheck1">
                                                I accept the
                                                <a href="#!">terms &amp; conditions</a>
                                                .
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create Account</button>
                                    </div>
                                </form>
                            </div>
                            <hr class="my-0"/>
                            <div class="card-body px-5 py-4">
                                <div class="small text-center">
                                    Have an account?
                                    <a href="{{ route('admin.showLogin') }}">Sign in!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="footer mt-auto footer-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 small">Copyright &#xA9; CodeGym 2021</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="#!">Privacy Policy</a>
                        &#xB7;
                        <a href="#!">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>

<script src="{{ asset('backend/js/sb-customizer.js') }}"></script>
<sb-customizer project="sb-admin-pro"></sb-customizer>
</body>

<!-- Mirrored from sb-admin-pro.startbootstrap.com/auth-register-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Mar 2021 08:49:40 GMT -->
</html>
