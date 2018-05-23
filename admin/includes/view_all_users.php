<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
            <!-- Display all comment -->
            <?php
            
                $query = "SELECT * FROM users";
                $user_result = mysqli_query($connection, $query);
                if (!$user_result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($user_result)) {
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role']; 

                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";
                    echo "<td><a href='comments.php?approved='>APPROVE</a></td>";
                    echo "<td><a href='comments.php?unapproved='>UNAPPROVE</a></td>";
                    echo "<td><a href='comments.php?delete='>DELETE</a></td>";
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