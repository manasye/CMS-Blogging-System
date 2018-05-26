<?php

    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query FAILED ' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

    if (isset($_POST['update_post'])) {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_title = '$post_title', post_category_id = '$post_category_id', ";
        $query .= "post_date = now(), post_author = '$post_author', post_status = '$post_status', ";
        $query .= "post_tags = '$post_tags', post_content = '$post_content', post_image = '$post_image' ";
        $query .= "WHERE post_id = $the_post_id";

        $result = mysqli_query($connection, $query);
        confirm($result);
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category_id">Post Category</label>
        <br>
        <select name="post_category" id="">
            <?php
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author ?>"type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <br>
        <select name="post_status">
            <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php
                if ($post_status == 'published') {
                    echo "<option value='draft'>draft</option>";
                } else {
                    echo "<option value='published'>published</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width='200' src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>"type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
            <?php echo $post_content ?>
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>

<?php
    if (isset($_POST['create_post'])) {
        if ($result) {
            echo "<h4>Data have been saved succesfully</h4>";
        }
    }
?>