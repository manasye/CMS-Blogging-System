<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update categories</label>

        <?php
            if (isset($_GET['edit'])) {
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    ?>

                    <input value="<?php
                        if (isset($cat_title)) echo $cat_title;
                    ?>" type="text" class="form-control" name="cat_title">

                <?php } ?>
        <?php } ?>

        <?php
            if (isset($_POST['update_cat'])) {
                $cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die('Query FAILED ' . mysqli_error($connection));
                }
            }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_cat" value="Update category">
    </div>
</form>