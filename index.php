<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/free-photo/blur-hospital_1203-7972.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
            width: 400px;
        }
        .btn-custom { margin: 10px 0; width: 100%; padding: 12px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="main-card">
        <h2 class="mb-4 text-primary">🏥 City Hospital</h2>
        <p>Please select your role to login:</p>
        
        <a href="admin_login.php" class="btn btn-danger btn-custom">Admin Login 🔒</a>
        <a href="doctor_login.php" class="btn btn-primary btn-custom">Doctor Login 👨‍⚕️</a>
        <a href="patient_login.php" class="btn btn-success btn-custom">Patient Login 🤒</a>
    </div>

</body>
</html>