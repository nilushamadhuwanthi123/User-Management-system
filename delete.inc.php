<?php

require_once "connection.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM user_details WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {

        header("Location: display.php");
        exit();

    } else {

        echo "Error deleting record : " . $conn->error;
    }

} else {

    echo "ID parameter missing";
}

$conn->close();

?>