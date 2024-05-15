<?php
// Connection parameters
$servername = "localhost";
$username = "root";
$password = '';
$database = "job";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data

$companyName = $_POST['companyName'];
$jobRole = $_POST['jobRole'];
$jobQualifications = $_POST['jobQualifications'];
$skillsRequired = $_POST['skillsRequired'];
$experience = $_POST['experience'];
$basicSalary = $_POST['basicSalary'];

// Insert data into database
$sql = "INSERT INTO jobs (companyName, jobRole, jobQualifications, skillsRequired, experience, basicSalary)
        VALUES ('$companyName', '$jobRole', '$jobQualifications', '$skillsRequired', '$experience', '$basicSalary')";

if ($conn->query($sql) === TRUE) {
    echo "New job listing created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
