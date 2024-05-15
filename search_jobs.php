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

// Retrieve search keyword from the query string
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    
    // Prepare SQL statement to search for jobs
    $sql = "SELECT * FROM jobs WHERE jobRole LIKE '%$keyword%' OR jobQualifications LIKE '%$keyword%' OR skillsRequired LIKE '%$keyword%'";
    
    // Execute SQL statement
    $result = $conn->query($sql);
    
    // Display search results
    if ($result->num_rows > 0) {
        echo "<h2>Search Results</h2>";
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>Company Name:</strong> " . $row["companyName"] . "</p>";
            echo "<p><strong>Job Role:</strong> " . $row["jobRole"] . "</p>";
            echo "<p><strong>Qualifications:</strong> " . $row["jobQualifications"] . "</p>";
            echo "<p><strong>Skills Required:</strong> " . $row["skillsRequired"] . "</p>";
            echo "<p><strong>Experience:</strong> " . $row["experience"] . " years</p>";
            echo "<p><strong>Basic Salary:</strong> $" . $row["basicSalary"] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "No jobs found matching your search criteria.";
    }
} else {
    echo "No search keyword provided.";
}

$conn->close();
?>
