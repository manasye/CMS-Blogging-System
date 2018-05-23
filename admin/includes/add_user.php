<?php

    global $connection;
    if (isset($_POST['create_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password']

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date
        , post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', 
        '$post_content', '$post_tags', '$post_status')";

        $add_user_result = mysqli_query($connection, $query);
        confirm($add_user_result);
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role">
            <option value="subscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="status">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>

<?php
    if (isset($_POST['create_post'])) {
        if ($result) {
            echo "<h4>Data have been saved succesfully</h4>";
        }
    }
?>