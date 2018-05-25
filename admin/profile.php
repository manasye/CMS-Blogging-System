<?php include "includes/admin_header.php" ?>

    <!-- Get user's info -->
    <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $query = "SELECT * FROM users WHERE username = '$username'";
            $profile_query = mysqli_query($connection, $query);
            confirm($profile_query);

            while ($row = mysqli_fetch_assoc($profile_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role']; 
            }
        }
    ?>

    <!-- Update profile -->
    <?php
        if (isset($_POST['edit_profile'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            $query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', 
            user_role = '$user_role', username = '$username', user_email = '$user_email', 
            user_password = '$user_password' WHERE username = '$username'";

            $change_profile_result = mysqli_query($connection, $query);
            confirm($change_profile_result);
        }
    ?>

    <div id="wrapper"> 

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small>Panel</small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="title">First Name</label>
                                <input type="text" class="form-control" name="user_firstname" value= "<?php 
                                echo $user_firstname?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="title">Last Name</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php
                                echo $user_lastname ?>">
                            </div>

                            <div class="form-group">
                                <select name="user_role">
                                    <option value="subscriber"><?php echo $user_role?></option>
                                    <?php
                                        if ($user_role == 'admin') {
                                            echo "<option value='subscriber'>Subscriber</option>";
                                        } else {
                                            echo "<option value='admin'>Admin</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="author">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php
                                echo $username ?>">
                            </div>

                            <div class="form-group">
                                <label for="status">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php
                                echo $user_email?>">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input type="password" class="form-control" name="user_password" 
                                value="<?php echo $user_password ?>">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="edit_profile" value="Update Profile">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"?>

<?php 
    if ($change_profile_result) {
        echo "<h4>Data have been updated successfully</h4>";
    }
?>