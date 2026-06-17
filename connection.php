<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "useracc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$connection_status = "Connection succeeded";

?>