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

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/login.css" />
</head>

<body>
    <div class="form-login">
        <div class="outter-form-login">
            <div class="logo-login">
                <img src="<?= BASE_URL ?>public/assets/images/logo.png" alt="" class="img-circle">
            </div>
            <form id="loginForm" name="loginForm" class="inner-login" novalidate="novalidate">
                <input type="hidden" name="action" id="action" value="login">
                <h3 class="text-center title-login">Login e-DPT</h3>
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
            <div class="text-center">
                <?= date("Y") ?> @ <?= CP_NAME ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= BASE_URL ?>public/dist/js/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL ?>app/js/login.js"></script>

</body>

</html>