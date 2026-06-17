<?php
session_start();

// If already logged in, redirect to display
if (isset($_SESSION['user_id'])) {
    header("Location: display.php");
    exit();
}

require_once 'connection.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user in database
    $sql = "SELECT * FROM user_details WHERE userGmail='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password (if using plain text)
        if ($password == $row['userPassword']) {
            // Set session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['userName'];
            $_SESSION['user_email'] = $row['userGmail'];
            
            header("Location: display.php");
            exit();
        } else {
            $error = "❌ Incorrect password!";
        }
    } else {
        $error = "❌ Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Css/login.css">
</head>
<body>

<div class="login-container">

    <div class="login-box">
        <h1>🔐 Login</h1>
        
        <?php if($error) { ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php } ?>

        <form action="login.php" method="POST">

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit">Login</button>

        </form>

        <p class="register-link">
            Don't have an account? <a href="insert.php">Register here</a>
        </p>
    </div>

</div>

</body>
</html>