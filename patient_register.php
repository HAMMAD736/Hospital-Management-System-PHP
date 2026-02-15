<?php
include 'db.php';
$message = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];

    // Check karo ke ye email pehle se to nahi hai?
    $check = $conn->query("SELECT * FROM patients WHERE email='$email'");
    if($check->num_rows > 0){
        $message = "<div class='alert alert-danger'>Email already exists! Try Login.</div>";
    } else {
        // Naya Patient banao
        $sql = "INSERT INTO patients (name, email, password, phone) VALUES ('$name', '$email', '$pass', '$phone')";
        if ($conn->query($sql) === TRUE) {
            $message = "<div class='alert alert-success'>Account Created! <a href='patient_login.php'>Login Now</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center text-success mb-3">🤒 New Patient</h3>
        <?php echo $message; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
            <p class="text-center mt-2"><a href="patient_login.php">Already have an account? Login</a></p>
        </form>
    </div>

</body>
</html>