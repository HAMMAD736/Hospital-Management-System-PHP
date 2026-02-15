<?php
session_start();
include 'db.php';
$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM patients WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['patient_logged_in'] = true;
        $_SESSION['patient_id'] = $row['id'];
        $_SESSION['patient_name'] = $row['name'];
        
        header("Location: patient_dashboard.php");
        exit();
    } else {
        $error = "Email or Password incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center text-success mb-3">Patient Login 🏥</h3>
        <?php if($error){ echo "<div class='alert alert-danger'>$error</div>"; } ?>
        
        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-success w-100">Login</button>
            <p class="text-center mt-2"><a href="patient_register.php">Create New Account</a></p>
            <a href="index.php" class="d-block text-center text-muted">Back to Home</a>
        </form>
    </div>

</body>
</html>