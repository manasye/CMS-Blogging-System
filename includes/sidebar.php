<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">

        <h4>Search Here</h4>
        <!-- search form -->
        <form action="search.php" method="post">
            <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Search Well -->
    <div class="well">

        <h4>Login</h4>
        <!-- login form -->
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Go!</button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        
        <?php
            $query = "SELECT * FROM categories LIMIT 6";
            $result = mysqli_query($connection, $query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li><a href = 'category.php?category=$cat_id'> $cat_title </a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
</div>