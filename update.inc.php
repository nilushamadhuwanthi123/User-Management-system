<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check duplicate email
    $check = "SELECT * FROM user_details
              WHERE userGmail='$email'
              AND id != '$id'";

    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "This email is already used by another account!";
        exit();
    }

    // Update query
    $sql = "UPDATE user_details
            SET userName='$name',
                userGmail='$email',
                userPassword='$password'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success message
        header("Location: display.php?update=success");
        exit();
    } else {
        echo "Error updating record : " . $conn->error;
    }

} else {
    echo "Invalid request";
}
?>