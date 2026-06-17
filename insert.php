<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Insert</title>
    <link rel="stylesheet" href="Css/insert.css?v=1">
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
        .error-msg {
            background: #ef4444;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>➕ Insert User Details</h1>

    <?php if(isset($error)) { ?>
        <div class="error-msg">❌ <?php echo $error; ?></div>
    <?php } ?>

    <form action="insert.php" method="POST">

        <label>User Name:</label>
        <input type="text" name="name" placeholder="Enter your name" required>

        <label>User Gmail:</label>
        <div class="input-box">
            <span class="icon">📧</span>
            <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>

        <label>Password:</label>
        <div class="input-box">
            <span class="icon">🔒</span>
            <input type="password" name="password" placeholder="Enter strong password" required>
        </div>

        <button type="submit">Submit</button>
        
        <a href="display.php" class="back-link">← Back to Display</a>

    </form>

</div>

</body>
</html>