<?php include "includes/admin_header.php" ?>

    <div id="wrapper"> 

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administration
                            <small>Panel</small>
                        </h1>

                        <?php
                                                    
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }

                            switch ($source) {
                                case 'add_user':
                                    include 'includes/add_user.php';
                                    break;
                                case 'edit_user':
                                    include 'includes/edit_user.php';
                                    break;
                                default:
                                    include 'includes/view_all_users.php';
                            }

                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>