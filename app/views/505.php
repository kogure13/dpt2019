<?php
// require '../config/class.php';

$main = new main();
if($main->is_connected()) {
    echo '<meta http-equiv="refresh" content="0;url=index.php>';
    exit();
}

?>

<section class="content-header">
    <h1>
        505 :: No Internet Connection
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"> 505</h2>

        <div class="error-content">
            <h3><i class="fa fa-danger text-yellow"></i> Oops! You're offline</h3>

            <form class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- /.input-group -->
            </form>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>