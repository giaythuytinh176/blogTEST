<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from sb-admin-pro.startbootstrap.com/auth-password-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Mar 2021 08:49:40 GMT -->
<head>
    <meta charset="utf-8"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
    <meta content name="description"/>
    <meta content name="author"/>
    <title>Forgot Password - Blog TEST</title>
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
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                        <!-- Social forgot password form-->
                        <div class="card my-5">
                            <div class="card-body p-5 text-center">
                                <div class="h3 font-weight-light mb-0">Change Password</div>
                            </div>
                            <hr class="my-0"/>
                            <div class="card-body p-5">
                                <div class="text-center small text-muted mb-4">
                                    @isset($message)
                                        <div class="alert-danger">
                                            {{ $message }}
                                        </div>
                                    @endisset
                                    @isset($success)
                                        <div class="alert-success">
                                            {{ $success }}
                                        </div>
                                    @endisset
                                </div>
                                @empty($message)
                                    <form method="post" action="{{ route('password.reset', $token ?? '') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="small mb-1" for="newPassword">New Password</label>
                                            <input class="form-control" id="newPassword" placeholder="Enter new password" name="password" type="password"/>
                                            @if($errors->any() && $errors->first('password'))
                                                <div>
                                                    <p class="alert-danger">{{ $errors->first('password') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- Form Group (confirm password)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                            <input class="form-control" id="confirmPassword" placeholder="Confirm new password" name="password_confirmation" type="password"/>
                                            @if($errors->any() && $errors->first('password_confirmation'))
                                                <div>
                                                    <p class="alert-danger">{{ $errors->first('password_confirmation') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-0 text-center">
                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                        </div>
                                    </form>
                                @endempty
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
<script data-cf-beacon='{"version":"2021.2.0","rayId":"62e385bbdfead96a","si":10}' defer src="https://static.cloudflareinsights.com/beacon.min.js"></script>
</body>

<!-- Mirrored from sb-admin-pro.startbootstrap.com/auth-password-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Mar 2021 08:49:40 GMT -->
</html>
