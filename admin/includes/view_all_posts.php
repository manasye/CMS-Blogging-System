<?php

    if (isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $check_box_value) {
            $bulk_option = $_POST['bulk_option'];
            switch($bulk_option) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '$bulk_option' WHERE post_id = $check_box_value";
                    $publish_query = mysqli_query($connection, $query);
                    confirm($publish_query);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '$bulk_option' WHERE post_id = $check_box_value";
                    $draft_query = mysqli_query($connection, $query);
                    confirm($draft_query);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $check_box_value";
                    $delete_query = mysqli_query($connection, $query);
                    confirm($delete_query);
                    break;
            }
        }
    }

?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div style="padding:0px" class="col-xs-4">
            <select name="bulk_option" id="" class="form-control">
                <option value="">Select Type</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply" style="margin-left:10px">
            <a href="posts.php?source=add_post" class="btn btn-primary"  style="margin-left:10px">Add new</a>
        </div>
        <br><br><br>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
                <?php
                
                    $query = "SELECT * FROM posts";
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

                        echo "<tr>"; ?>

                        <td><input class='checkBoxes' type='checkbox' 
                        name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
                        
                        <?php
                        echo "<td>$post_id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";

                        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                        $category_result = mysqli_query($connection, $query);
                        if (!$category_result) {
                            die('Query FAILED ' . mysqli_error($connection));
                        }
                        
                        while ($row2 = mysqli_fetch_assoc($category_result)) {
                            $cat_id = $row2['cat_id'];
                            $cat_title = $row2['cat_title'];
                        }

                        echo "<td>$cat_title</td>";
                        
                        
                        echo "<td>$post_status</td>";
                        echo "<td>
                            <img width='200' src='../images/$post_image' alt='image'>
                            </td>";
                        echo "<td>$post_tags</td>";
                        echo "<td>$post_comment_count</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a href='posts.php?delete=$post_id'>DELETE</a></td>";
                        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>EDIT</a></td>";
                        echo "</tr>";
                    }
                
                ?>

                <?php
                
                    if (isset($_GET['delete'])) {
                        $post_del_id = $_GET['delete'];
                        $query = "DELETE FROM posts WHERE post_id = $post_del_id ";
                        $result = mysqli_query($connection, $query);

                        if ($result) {
                            header('Location: posts.php');
                        }
                    }
                
                ?>
        </tbody>
    </table>
</form>
