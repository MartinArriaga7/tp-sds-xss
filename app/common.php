<?php

ini_set("display_errors", 1);

session_start();
$dbHost = getenv("DB_HOST");
$dbUser = getenv("DB_USER");
$dbPassword = getenv("DB_PASSWORD");
$dbName = getenv("DB_NAME");

echo $dbHost;
echo $dbUser;
echo $dbPassword;
echo $dbName;

if (mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName)) {
    $connection->set_charset("utf-8");
} else {
    die("Error in database connection");
}



