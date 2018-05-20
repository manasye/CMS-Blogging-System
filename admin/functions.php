<?php

    function insertCategories() {
        global $connection;

        if (isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title'];
            if (($cat_title == '') || (empty($cat_title))) {
                echo "Field can't be empty";
            } else {
                $query = "INSERT INTO categories(cat_title) VALUE ('$cat_title')";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }
            }
        }
    }

    function findAllCategories() {
        global $connection;

        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die('Query FAILED ' . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr>";
            echo "<td> $cat_id </td>";
            echo "<td> $cat_title </td>";
            echo "<td><a href='categories.php?delete=$cat_id'> DELETE </a></td>";
            echo "<td><a href='categories.php?edit=$cat_id'> EDIT </a></td>";
            echo "</tr>";
        }
    }

    function deleteCategory() {
        global $connection;
        
        if (isset($_GET['delete'])) {
            $cat_del_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = $cat_del_id";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die('Query FAILED ' . mysqli_error($connection));
            } else {
                header('Location: categories.php');
            }
        }
    }

?>