<?php
session_start();
include 'db.php';

if (!isset($_SESSION['patient_logged_in'])) {
    header("Location: patient_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-success p-3">
        <div class="container">
            <span class="navbar-brand">🤒 Welcome, <?php echo $_SESSION['patient_name']; ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Find a Doctor & Book Appointment</h2>
        
        <div class="row">
            <?php
            // Saare Doctors ko Database se bulao
            $sql = "SELECT * FROM doctors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100 border-0">
                        <div class="card-body text-center">
                            <h3 class="card-title">👨‍⚕️ <?php echo $row['name']; ?></h3>
                            <p class="text-muted"><?php echo $row['specialty']; ?></p>
                            <h5 class="text-success">Fee: Rs. <?php echo $row['consultancy_fees']; ?></h5>
                            <hr>
                            <a href="book_appointment.php?doc_id=<?php echo $row['id']; ?>" class="btn btn-outline-success w-100">Book Appointment 📅</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p class='text-center'>No doctors available right now.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>