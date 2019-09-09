<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="cache-control" content="no-cache"> -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title> | <?= CP_NAME ?></title>

    <link rel="shortcut icon" href="<?= BASE_URL ?>public/assets/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>public/bower_components/datatables.net-bs/css/dataTables.bootstrap.css"> -->
    <link rel="stylesheet"
        href="<?= BASE_URL ?>public/bower_components/datatables.net-bs/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>public/bower_components/datatables.net-bs/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/ripples.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/MaterialAdminLTE.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/skins/all-md-skins.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/style.css">

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>

<body class="fixed hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo hidden-xs">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <b>e-DPT</b>
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <!-- <img src="<?= BASE_URL ?>public/assets/images/logo-lg.png" style="height: 43px"> -->
                    <b>Aplikasi</b> e-<b>DPT</b>
                </span>
            </a>

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span>
                                    <i class="username-detail text-user-detail" id="username-detail"></i>
                                    User
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <p>
                                        <span id="userA" class="text-user-detail"></span> - <span id="userD"></span>
                                        <small id="userT"></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Inbox</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Outbox</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Info</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>