<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "certicain";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $pnumber = mysqli_real_escape_string($conn, $_POST['pnumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);

    // Sanitize email and create a valid table name
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = str_replace(array("@", "."), "_", $email);

    // Query to insert user information into a common 'individual' table
    $insertUserQuery = "INSERT INTO `individual`(`fname`, `lname`, `pnumber`, `email`, `password`) VALUES ('$fname','$lname','$pnumber','$email','$password')";

    if ($conn->query($insertUserQuery) === TRUE) {
        // Query to create a new table based on user's email
        $createTableQuery = "CREATE TABLE IF NOT EXISTS `$email` (
            id INT(11) AUTO_INCREMENT PRIMARY KEY, 
            institute VARCHAR(50) NOT NULL, 
            description VARCHAR(50) NOT NULL, 
            certificate LONGBLOB NOT NULL, 
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($createTableQuery) === TRUE) {
            $_SESSION['success'] = 'Registration successful.';
            header("location: login.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error creating user-specific table: ' . $conn->error;
        }
    } else {
        $_SESSION['error'] = 'Error inserting user data: ' . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>INDIVIDUAL</title>
    <style type="text/css">
    </style>
</head>
<body>
    <div class="container1">
        <h1 style="text-align:center;">Create account</h1><br>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="fname" placeholder="First Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
        </form>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="lname" placeholder="Last Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
        </form>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="pname" placeholder="Phone Number" type="int" required>
                <span class="input-border input-border-alt"></span>
            </div>
        </form>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="email" placeholder="Email" type="email" required>
                <span class="input-border input-border-alt"></span>
            </div>
        </form>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="password" placeholder="Password" type="password" required>
                <span class="input-border input-border-alt"></span>
            </div><br>
        </form>
        <button class="btn" type="button">
            <strong>SUBMIT</strong>
            <div id="container-stars">
                <div id="stars"></div>
            </div>
            <div id="glow">
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        </button>
        <div class="create-account">
            <p>Already have an account? <a href="login.php">Sign in</a></p>
        </div>
    </div>
</body>