<?php
session_start();
include 'db.php';

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Doctor Table mein check karo
    $sql = "SELECT * FROM doctors WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Session mein Doctor ki ID aur Name save kar lo (Taake Dashboard par dikha sakein)
        $_SESSION['doctor_logged_in'] = true;
        $_SESSION['doctor_id'] = $row['id'];
        $_SESSION['doctor_name'] = $row['name'];
        
        header("Location: doctor_dashboard.php");
        exit();
    } else {
        $error = "Email ya Password ghalat hai!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e3f2fd; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 10px; width: 350px; border-top: 5px solid #0d6efd; }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center text-primary mb-4">Doctor Login 👨‍⚕️</h3>
        
        <?php if($error){ echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="doctor@hospital.com" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            <a href="index.php" class="d-block text-center mt-3">Back to Home</a>
        </form>
    </div>
</body>
</html>