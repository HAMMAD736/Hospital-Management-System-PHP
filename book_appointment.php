<?php
session_start();
include 'db.php';

// Check: Agar Patient login nahi hai to bhaga do
if (!isset($_SESSION['patient_logged_in'])) {
    header("Location: patient_login.php");
    exit();
}

// URL se Doctor ki ID pakdo (e.g. book_appointment.php?doc_id=5)
if (isset($_GET['doc_id'])) {
    $doctor_id = $_GET['doc_id'];
    
    // Doctor ka naam pata karo taake heading mein dikha sakein
    $sql_doc = "SELECT * FROM doctors WHERE id = '$doctor_id'";
    $result_doc = $conn->query($sql_doc);
    $doctor = $result_doc->fetch_assoc();
}

$message = "";

// Jab Form Submit ho
if (isset($_POST['book_now'])) {
    $patient_id = $_SESSION['patient_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $symptoms = $_POST['symptoms'];

    // Appointment Table mein entry karo
    $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, appointment_time, symptoms, status) 
            VALUES ('$doctor_id', '$patient_id', '$date', '$time', '$symptoms', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success'>Appointment Booked Successfully! Doctor will approve soon. <a href='patient_dashboard.php'>Go Back</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow p-4" style="width: 400px;">
        <h4 class="text-center text-primary mb-3">Book Appointment</h4>
        <h6 class="text-center text-muted">With Dr. <?php echo $doctor['name']; ?></h6>
        <hr>
        
        <?php echo $message; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Time</label>
                <input type="time" name="time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Symptoms (Kya masla hai?)</label>
                <textarea name="symptoms" class="form-control" placeholder="Fever, Headache..." rows="3" required></textarea>
            </div>
            <button type="submit" name="book_now" class="btn btn-primary w-100">Confirm Booking ✅</button>
            <a href="patient_dashboard.php" class="d-block text-center mt-3">Cancel</a>
        </form>
    </div>

</body>
</html>