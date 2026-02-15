<?php
session_start();
include 'db.php'; // Database se connect karo

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database mein check karo
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Agar sahi hai to dashboard par bhejo
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Username ya Password ghalat hai!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Shifa Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f4f4; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 350px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center text-danger mb-4">Admin Login 🔒</h3>
        
        <?php if($error){ echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-danger w-100">Login</button>
            <a href="index.php" class="d-block text-center mt-3">Back to Home</a>
        </form>
    </div>
</body>
</html>