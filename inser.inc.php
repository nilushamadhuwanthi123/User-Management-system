<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user_details (userName, userGmail, userPassword)
            VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php?insert=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>