<?php

// Assuming you have a MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $username = $_POST["username"];
    
    // File handling
    $file = $_FILES["pdf_file"]["name"];
    $file_tmp = $_FILES["pdf_file"]["tmp_name"];
    
    // Move the uploaded file to a desired directory
    $upload_dir = "uploads/"; // Change this to your desired directory
    move_uploaded_file($file_tmp, $upload_dir . $file);

    // Insert data into the database
    $sql = "INSERT INTO $username (file) VALUES ('$upload_dir$file')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>