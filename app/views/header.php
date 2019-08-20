<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="cache-control" content="no-cache"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> | <?= CP_NAME ?></title>

    <link rel="shortcut icon" href="<?= BASE_URL ?>public/assets/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/plugins/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/style.css">
</head>

<body class="sidebar-mini layout-footer-fixed wysihtml5-supported skin-blue-light fixed">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo hidden-xs">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">

                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <img src="<?= BASE_URL ?>public/assets/images/unnur-dark-logo.png" style="height: 43px">
                </span>
            </a>

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <div class="nav navbar-nav hidden-lg hidden-md hidden-sm" style="color: #fff; font-weight: 600;">
                        <a href="index.php" class="navbar-brand custom-brand">

                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span>
                                    <i class="username-detail text-user-detail" id="username-detail"></i>
                                    <i class="fa fa-caret-down"></i>
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