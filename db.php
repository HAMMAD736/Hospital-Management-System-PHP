<?php
// Screenshot se li gayi details:
$host = "localhost";  // Aapka Host Name (Screenshot se)
$user = "if0_41150668";             // Aapka Username (Screenshot se)
$dbname = "Enter Your Password Here";       // Aapka Database Name (Screenshot se)

// 🔴 DHYAAN DEIN: Password yahan likhein
// Ye wahi password hai jo aapne account banate waqt rakha tha (ya vPanel login wala)
$pass = "DmKhRIs01m2z0A"; 

// Connection banana
$conn = new mysqli($host, $user, $pass, $dbname);

// Agar connection fail ho to error dikhaye
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>