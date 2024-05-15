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

// File upload handling
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["resume"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
    echo "Sorry, only PDF, DOC, DOCX files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["resume"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Form data
$name = $_POST['name'];
$qualification = $_POST['qualification'];
$address = $_POST['address'];
$resume = $target_file;

// Insert data into database
$sql = "INSERT INTO users (name, qualification, address, resume)
        VALUES ('$name', '$qualification', '$address', '$resume')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
