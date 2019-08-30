<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel hidden-xs">
            <div class="pull-left image">
                <img src="<?= BASE_URL ?>public/assets/images/logo.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= APPS_NAME ?></p>
                <a href="#">
                    <?= APPS_VER ?>
                </a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php

            $db = new DBobj;
            $connString = $db->getConnString();

            $crud = new Crud($connString);
            $field = ['*'];
            $from = "tabel_menu";
            $join = "";
            $where = "$from.is_main_menu = 0 ";
            $where .= "and (role = 0 or role = " . $_SESSION['role'] . ") ";
            // $where .= "and role = 4";
            $order = "urutan asc";

            $main_menu = $crud->read($field, $from, $join, $where, $order);
            while ($row = mysqli_fetch_assoc($main_menu)) {
                $where = "is_main_menu = " . $row['id'];
                $sub_menu = $crud->read($field, $from, $join, $where, $order);
                $num_row_sub = mysqli_num_rows($sub_menu);
                $judul = "<span>" . $row['judul_menu'] . "</span>";
                if ($num_row_sub > 0) {
                    $judul .= '<span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>';
                    echo '<li class="treeview">';
                    anchor(
                        $anchor = [
                            'href=' => $row['link'],
                            'id=' => $row['id'],
                        ],
                        $data = [
                            $row['icon'] => $judul
                        ]
                    );
                    echo '<ul class="treeview-menu">';
                    while ($row_sub = mysqli_fetch_assoc($sub_menu)) {
                        echo '<li>';
                        anchor(
                            $anchor = [
                                'href=' => $row_sub['link'],
                                'id=' => $row_sub['id'],
                            ],
                            $data = [
                                $row_sub['icon'] => $row_sub['judul_menu']
                            ]
                        );
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li>';
                    anchor(
                        $anchor = [
                            'href=' => $row['link'],
                            'id=' => $row['id'],
                        ],
                        $data = [
                            $row['icon'] => $judul
                        ]
                    );
                    echo '</li>';
                }
            }

            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
