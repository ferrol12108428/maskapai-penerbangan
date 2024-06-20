<?php

$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "db_maskapai_penerbangan";

$connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$connection) {
    echo "connection failed!";
}
?>