<?php

ini_set("display_errors", 1);

session_start();
$dbHost = getenv("DB_HOST");
$dbUser = getenv("DB_USER");
$dbPassword = getenv("DB_PASSWORD");
$dbName = getenv("DB_NAME");

$connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName, 3306);
if ($connection !== false) {
    $connection->set_charset("utf8"); 
} else {
    die("Error in database connection");
}
