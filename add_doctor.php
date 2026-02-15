<?php
session_start();
include 'db.php';

// Check: Sirf Admin hi Doctor bana sakta hai
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['add_doctor'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $specialty = $_POST['specialty'];
    $fees = $_POST['fees'];

    // Database mein Doctor ko save karo
    $sql = "INSERT INTO doctors (name, email, password, specialty, consultancy_fees) 
            VALUES ('$name', '$email', '$pass', '$specialty', '$fees')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success'>Doctor Added Successfully! ✅</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-danger p-3 mb-4">
        <div class="container">
            <span class="navbar-brand">🏥 Admin Panel</span>
            <a href="admin_dashboard.php" class="btn btn-light btn-sm">Back to Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>👨‍⚕️ Register New Doctor</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $message; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label>Doctor Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Dr. Ali Khan" required>
                            </div>
                            <div class="mb-3">
                                <label>Email (Login ID)</label>
                                <input type="email" name="email" class="form-control" placeholder="ali@hospital.com" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Set Login Password" required>
                            </div>
                            <div class="mb-3">
                                <label>Specialty</label>
                                <select name="specialty" class="form-control">
                                    <option value="General Physician">General Physician (Aam Amraz)</option>
                                    <option value="Cardiologist">Cardiologist (Dil)</option>
                                    <option value="Dentist">Dentist (Daant)</option>
                                    <option value="Neurologist">Neurologist (Dimagh)</option>
                                    <option value="Orthopedic">Orthopedic (Haddiyan)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Consultancy Fees (Rs)</label>
                                <input type="number" name="fees" class="form-control" placeholder="2000" required>
                            </div>
                            <button type="submit" name="add_doctor" class="btn btn-success w-100">Add Doctor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>