<?php

$hostname     = "localhost";
$username     = "root";
$password     = "password2$";
$databasename = "photosharingwebapp";
// Create connection 
$conn = new mysqli($hostname, $username, $password, $databasename);
// Check connection 
if ($conn->connect_error) {
    die("Unable to Connect to photo gallery database: " . $conn->connect_error);
}
