<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "connection.php";

// Check ID exists
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Get user data
    $sql = "SELECT * FROM user_details WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $name = $row['userName'];
        $email = $row['userGmail'];
        $password = $row['userPassword'];

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
    <title>Update User</title>
    <link rel="stylesheet" href="./Css/update.css">
    <style>
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="update.inc.php" method="POST">

    <h2>✏️ Update User</h2>

    <!-- Hidden ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label>Password</label>
    <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>" required>

    <button type="submit">Update</button>

    <a href="display.php" class="back-link">← Back to Display</a>

</form>

</body>
</html>