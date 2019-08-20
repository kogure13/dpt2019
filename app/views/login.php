<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title id='thetitle'>Login to Siakad UNNUR 2019</title>

    <link rel="shortcut icon" href="<?= BASE_URL ?>public/assets/images/logo.png" type="image/x-icon">

    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" type="text/css" /> -->

    <link rel="stylesheet" href="<?= BASE_URL ?>public/assets/login/ap3login1.css" type="text/css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>public/plugins/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?= BASE_URL ?>public/plugins/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dist/css/style.css">

</head>

<body>
    <div class="container">

        <div class="top_login">
            <div class="title_top_login">
                <div class="pwform">
                    <!-- <div id='school_motto'>University</div> -->
                    <img height='60px' src='<?= BASE_URL ?>public/assets/images/unnur-dark-logo.png'>
                </div>
            </div>
        </div>

        <div class="sub_container">
            <div class="login_form">
                <div id='top_message'></div>
                <form action="app/api/login/ajax.php" name="loginForm" id="loginForm" role="form"
                    novalidate="novalidate">
                    <input type="hidden" name="action" value="login">
                    <div class="login_new">
                        <input class='textbox' type="text" id="username" name="username" autocomplete="off"
                            placeholder="Username" />
                    </div>

                    <div class="pass_new">
                        <input class='textbox' type="password" id="password" name="password" placeholder="Password" />
                        <div id='forget'><a id='forgetpassword' href='#'>Forget Password</a></div>
                        <div class='e8hidden' id='forget_email'>
                            <div id='forget_email_message'>New password will be sent to your email</div>
                            <div id='forget_email_email'><input size='35' type='email' id='forget_email_email_input'
                                    placeholder="Enter your email address"></div>
                        </div>

                    </div>

                    <div class="submit">
                        <div id='submitbutton'>
                            <button type="submit" id="submit">
                                Log-in <i class="fa fa-sign-in fa-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class='hidden' id='message'></div>
            </div>

            <img src="<?= BASE_URL ?>public/assets/images/final2.png" />
        </div>
        <!------------------------------ footer -------------------------->
        <div class="footer">
            <div class="box_educa_top">
                <a link href="#" target="">
                    <span class="extra-link"><i class="fa fa-youtube-play"></i> UNNURTV
                </a>
            </div>
            <div class="box_educa">
                <a link href="#" target=""> <?= APPS_NAME ?> </a> | <i class="fa fa-copyright" aria-hidden="true"></i>
                copyright 2019
            </div>
            <div class="box_footer">
            </div>
        </div>
    </div>
    <!-- container -->
    <script src="<?= BASE_URL ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?= BASE_URL ?>public/plugins/jQuery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>public/plugins/sweetalert/sweetalert2.min.js"></script>
    <script src="<?= BASE_URL ?>public/dist/js/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL ?>public/js/login.js"></script>
</body>