<?php
    $connection = mysqli_connect('localhost', 'root', '', 'cms');

    if (!$connection) {
        die("Unable to connect to databases");
    }

?>