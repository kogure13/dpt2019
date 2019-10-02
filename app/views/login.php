<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <title>Login e-DPT</title>

    <link rel="shortcut icon" href="<?= BASE_URL ?>public/assets/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/ripples.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/MaterialAdminLTE.min.css">

    <link rel="stylesheet" href="<?=BASE_URL?>public/dist/css/login.css" />
</head>

<body>
    <div class="col-lg-4 col-md-6 col-lg-offset-4 col-md-offset-3 form-login">
        <div class="outter-form-login">
            <form id="loginForm" name="loginForm" class="inner-login" novalidate="novalidate">
                <input type="hidden" name="loginSubmit" value="login">
                <div class="text-center logo-login">
                    <img src="dist/img/logo.png" alt="" class="img-circle">
                </div>
                <h3 class="text-center title-login">Please Login To Start Session</h3>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                </div>

                <button type="submit" class="btn btn-block bg-aqua">
                    <div class="">
                        <i class="fa fa-sign-in fa-fw"></i>
                        <span>Login</span>
                    </div>
                </button>

            </form>
        </div>
    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="dist/js/jquery.validate.min.js"></script>
    <script src="application/login/script.js"></script>
</body>

</html>
