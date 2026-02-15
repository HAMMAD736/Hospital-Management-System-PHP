<?php
session_start();
include 'db.php';

// Check: Agar login nahi hai to bhaga do
if (!isset($_SESSION['doctor_logged_in'])) {
    header("Location: doctor_login.php");
    exit();
}

// Doctor ki ID pakdo (Jo login hai)
$doctor_id = $_SESSION['doctor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary p-3">
        <div class="container">
            <span class="navbar-brand">👨‍⚕️ Welcome, <?php echo $_SESSION['doctor_name']; ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">📅 My Appointments</h3>
        
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Symptoms</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 <tbody>
    <?php
    $sql = "SELECT appointments.*, patients.name AS patient_name, patients.phone 
            FROM appointments 
            JOIN patients ON appointments.patient_id = patients.id 
            WHERE doctor_id = '$doctor_id'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row['patient_name']."<br><small class='text-muted'>".$row['phone']."</small></td>
                <td>".$row['appointment_date']."</td>
                <td>".$row['appointment_time']."</td>
                <td>".$row['symptoms']."</td>
                <td><span class='badge bg-warning text-dark'>".$row['status']."</span></td>
                <td>
                    <a href='approve_appointment.php?id=".$row['id']."' class='btn btn-success btn-sm'>Approve ✅</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center text-muted'>No appointments yet. Relax! ☕</td></tr>";
    }
    ?>
</tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>