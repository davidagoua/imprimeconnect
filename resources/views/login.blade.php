<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Printxi</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <!-- Start GA -->


<body  style="background-color: #333">
<div id="app bg-dark">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">


                    <div class="card card-primary">
                        <div class="card-header"><h4 class="w-100 text-center">Se connecter</h4></div>

                        <div class="card-body">
                            @if(session('error'))
                            <div class="alert alert-danger border-left ">{{ session('error') }}</div>
                            @endif
                            <form method="POST" action="{{ route('login') }}" class="needs-validatio">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                    @error('email')
                                    <div class="invalid-feedback">
                                       {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Mot de passe</label>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="float-right">
                                            <a href="auth-forgot-password.html" class="text-small">
                                                Mot de passe oublié ?
                                            </a>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Se souvenir de moi</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Se connecter
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="/assets/modules/jquery.min.js"></script>
<script src="/assets/modules/popper.js"></script>
<script src="/assets/modules/tooltip.js"></script>
<script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="/assets/modules/moment.min.js"></script>
<script src="/assets/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="/assets/js/scripts.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>
