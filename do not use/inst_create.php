<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "certicain";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $pnumber = mysqli_real_escape_string($conn, $_POST['pnumber']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "INSERT INTO `institutional`(`fname`, `lname`,`cname`, `pnumber`, `email`, `password`) VALUES ('$fname','$lname','$cname','$pnumber','$email','$password')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = 'Registration success.';
            header("location: login.php");
        } else {
            throw new Exception("Error inserting data into the database.");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>INSTITUTIONAL</title>
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
                <input class="input input-alt" name="cname" placeholder="Company Name" type="name" required>
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