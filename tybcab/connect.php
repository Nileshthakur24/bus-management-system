<?php
$connect = mysqli_connect("localhost", "root", "", "db_car_b");
if (!$connect)
    echo "Connection Error" or die(mysqli_connect_error());
?>