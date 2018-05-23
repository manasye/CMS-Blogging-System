<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
            <!-- Display all comment -->
            <?php
            
                $query = "SELECT * FROM comments";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";

                    // Get title of in respond to in comment
                    $query = "SELECT post_title, post_id FROM posts WHERE post_id = $comment_post_id";
                    $title_result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($title_result);
                    $comment_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_title</a></td>";

                    echo "<td>$comment_date</td>";
                    echo "<td><a href='comments.php?approved=$comment_id'>APPROVE</a></td>";
                    echo "<td><a href='comments.php?unapproved=$comment_id'>UNAPPROVE</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id'>DELETE</a></td>";
                    echo "</tr>";
                }
            
            ?>

            <!-- Delete comment -->
            <?php
            
                if (isset($_GET['delete'])) {
                    $comment_del_id = $_GET['delete'];
                    $query = "DELETE FROM comments WHERE comment_id = $comment_del_id ";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: comments.php');
                    }
                }
            
            ?>

            <!-- Approve comment -->
            <?php
            
                if (isset($_GET['approved'])) {
                    $comment_approved_id = $_GET['approved'];
                    $query = "UPDATE comments SET comment_status = 'approved' 
                    WHERE comment_id = $comment_approved_id";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: comments.php');
                    }
                }
            
            ?>

            <!-- Unapprove comment -->
            <?php
            
                if (isset($_GET['unapproved'])) {
                    $comment_unapproved_id = $_GET['unapproved'];
                    $query = "UPDATE comments SET comment_status = 'unapproved' 
                    WHERE comment_id = $comment_unapproved_id";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: comments.php');
                    }
                }
            
            ?>
    </tbody>
</table>