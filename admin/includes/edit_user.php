<?php

    if (isset($_GET['edit'])) {
        $the_user_id = $_GET['edit'];
        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $user_result = mysqli_query($connection, $query);
        if (!$user_result) {
            die('Query FAILED ' . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($user_result)) {
            $old_user_id = $row['user_id'];
            $old_username = $row['username'];
            $old_user_password = $row['user_password'];
            $old_user_firstname = $row['user_firstname'];
            $old_user_lastname = $row['user_lastname'];
            $old_user_email = $row['user_email'];
            $old_user_image = $row['user_image'];
            $old_user_role = $row['user_role']; 
        }
    }

    if (isset($_POST['edit_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', 
        user_role = '$user_role', username = '$username', user_email = '$user_email', 
        user_password = '$user_password' WHERE user_id = $the_user_id";

        $change_user_result = mysqli_query($connection, $query);
        confirm($change_user_result);
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value= "<?php 
        echo $old_user_firstname?>">
    </div>
    
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php
        echo $old_user_lastname ?>">
    </div>

    <div class="form-group">
        <select name="user_role">
            <option value="<?php echo $old_user_role?>"><?php echo $old_user_role?></option>
            <?php
                if ($old_user_role == 'admin') {
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
        echo $old_username ?>">
    </div>

    <div class="form-group">
        <label for="status">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php
        echo $old_user_email?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password" 
        value="<?php echo $old_user_password ?>">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>

</form>

<?php
    if (isset($_POST['edit_user'])) {
        if ($change_user_result) {
            echo "<h4>Data have been updated succesfully</h4>";
        }
    }
?>