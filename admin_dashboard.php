<?php
session_start();
include 'db.php';

// Check Login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// --- DELETE LOGIC (Doctor ya Patient ko delete karne ke liye) ---
if (isset($_GET['delete_doc'])) {
    $id = $_GET['delete_doc'];
    $conn->query("DELETE FROM doctors WHERE id='$id'");
    header("Location: admin_dashboard.php"); // Refresh
}
if (isset($_GET['delete_pat'])) {
    $id = $_GET['delete_pat'];
    $conn->query("DELETE FROM patients WHERE id='$id'");
    header("Location: admin_dashboard.php"); // Refresh
}

// --- COUNTERS (Ginti karo) ---
$doc_count = $conn->query("SELECT * FROM doctors")->num_rows;
$pat_count = $conn->query("SELECT * FROM patients")->num_rows;
$app_count = $conn->query("SELECT * FROM appointments")->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-box { color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
        .bg-doc { background: #0d6efd; }
        .bg-pat { background: #198754; }
        .bg-app { background: #ffc107; color: black; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark p-3 mb-4">
        <div class="container">
            <span class="navbar-brand">🏥 Hospital Admin Control</span>
            <div>
                <a href="index.php" class="btn btn-outline-light btn-sm me-2">View Website</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card-box bg-doc shadow">
                    <h3>👨‍⚕️ <?php echo $doc_count; ?></h3>
                    <p>Total Doctors</p>
                    <a href="add_doctor.php" class="btn btn-light btn-sm text-primary fw-bold">Add New +</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box bg-pat shadow">
                    <h3>🤒 <?php echo $pat_count; ?></h3>
                    <p>Total Patients</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box bg-app shadow">
                    <h3>📅 <?php echo $app_count; ?></h3>
                    <p>Appointments</p>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <h4 class="text-primary">📅 All Appointments</h4>
        <div class="table-responsive bg-white p-3 rounded shadow mb-4">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // JOIN query taake Doctor aur Patient dono ka naam dikhe
                    $sql = "SELECT appointments.*, doctors.name AS doc_name, patients.name AS pat_name 
                            FROM appointments 
                            JOIN doctors ON appointments.doctor_id = doctors.id
                            JOIN patients ON appointments.patient_id = patients.id
                            ORDER BY id DESC";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo "<tr>
                                <td>Dr. ".$row['doc_name']."</td>
                                <td>".$row['pat_name']."</td>
                                <td>".$row['appointment_date']." (" . $row['appointment_time'] . ")</td>
                                <td><span class='badge bg-info text-dark'>".$row['status']."</span></td>
                            </tr>";
                        }
                    } else { echo "<tr><td colspan='4'>No appointments found.</td></tr>"; }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary">👨‍⚕️ Manage Doctors</h5>
                <ul class="list-group shadow-sm">
                    <?php
                    $d_res = $conn->query("SELECT * FROM doctors");
                    while($doc = $d_res->fetch_assoc()){
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                <span>Dr. ".$doc['name']." <small class='text-muted'>(".$doc['specialty'].")</small></span>
                                <a href='admin_dashboard.php?delete_doc=".$doc['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this doctor?\")'>Delete 🗑️</a>
                              </li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="col-md-6">
                <h5 class="text-success">🤒 Registered Patients</h5>
                <ul class="list-group shadow-sm">
                    <?php
                    $p_res = $conn->query("SELECT * FROM patients");
                    while($pat = $p_res->fetch_assoc()){
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                <span>".$pat['name']." <small class='text-muted'>(".$pat['phone'].")</small></span>
                                <a href='admin_dashboard.php?delete_pat=".$pat['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this patient?\")'>Delete 🗑️</a>
                              </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
    <br><br>
</body>
</html>