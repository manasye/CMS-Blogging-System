<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change To Admin</th>
            <th>Change To Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
            <!-- Display all User -->
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
                    echo "<td><a href='users.php?change_to_admin=$user_id'>ADMIN</a></td>";
                    echo "<td><a href='users.php?change_to_subscriber=$user_id'>SUBSCRIBER</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit=$user_id'>EDIT</a></td>";
                    echo "<td><a href='users.php?delete=$user_id'>DELETE</a></td>";
                    echo "</tr>";
                }
            
            ?>

            <!-- Delete User -->
            <?php
            
                if (isset($_GET['delete'])) {
                    $user_id = $_GET['delete'];
                    $query = "DELETE FROM users WHERE user_id = $user_id ";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: users.php');
                    }
                }
            
            ?>

            <!-- Change role to admin -->
            <?php
            
                if (isset($_GET['change_to_admin'])) {
                    $user_id = $_GET['change_to_admin'];
                    $query = "UPDATE users SET user_role = 'admin' 
                    WHERE user_id = $user_id";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: users.php');
                    }
                }
            
            ?>

            <!-- Change role to subscriber -->
            <?php
            
                if (isset($_GET['change_to_subscriber'])) {
                    $user_id = $_GET['change_to_subscriber'];
                    $query = "UPDATE users SET user_role = 'subscriber' 
                    WHERE user_id = $user_id";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        header('Location: users.php');
                    }
                }
            
            ?>
    </tbody>
</table>