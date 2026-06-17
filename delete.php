<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connection.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM user_details WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $name = $row['userName'];
        $email = $row['userGmail'];

    } else {

        echo "No record found";
        exit();
    }

} else {

    echo "ID parameter missing";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>

    <link rel="stylesheet" href="./Css/delete.css">

</head>
<body>

<div class="container">

    <h1>🗑️ Delete User</h1>

    <p class="warning">
        ⚠️ Are you sure you want to delete this user?
    </p>

    <br>

    <div class="user-info">
        <p><strong>Name :</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
    </div>

    <br>

    <a href="delete.inc.php?id=<?php echo $id; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to permanently delete this user?')">
        ✅ Delete
    </a>

    <a href="display.php" class="btn cancel-btn">
        ❌ Cancel
    </a>

</div>

</body>
</html>