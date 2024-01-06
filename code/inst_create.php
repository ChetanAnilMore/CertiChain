<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$username = "root";
$password = "";
$database = "certicain";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $pnumber = mysqli_real_escape_string($conn, $_POST['pname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "INSERT INTO `institution`(`fname`, `lname`, `cname`, `pnumber`,`username`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $fname, $lname, $cname, $pnumber, $username, $email, $password);
        if ($stmt->execute()) {
            $createTableQuery = "CREATE TABLE IF NOT EXISTS `$username` (id INT AUTO_INCREMENT PRIMARY KEY, file LONGBLOB)";
            if ($conn->query($createTableQuery) === TRUE) {
                $_SESSION['success'] = 'Registration success.';
                header("location: login.php");
            } else {
                echo "Error creating user-specific table: " . $conn->error;
            }
        } else {
            echo "Error inserting data into the database: " . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    echo "Form data: ";
    print_r($_POST);

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
        <form class="flip-card__form" action="" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="fname" placeholder="First Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="lname" placeholder="Last Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="username" placeholder="Username" type="text" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="cname" placeholder="Company Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="pname" placeholder="Phone Number" type="text" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="email" placeholder="Email" type="email" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" name="password" placeholder="Password" type="password" required>
                <span class="input-border input-border-alt"></span>
            </div><br>
        </form>
        <button class="btn" id="submit" type="submit">
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
        <div id="warning" style="display:none;color:white;">Please Enter all Fields</div>
    </div>
    <script>
        let input =document.getElementsByTagName('input');
        let submit = document.getElementById('submit');
        let warning =document.getElementById('warning');
        submit.addEventListener('click',()=>{
            for(let i=0;i<7;i++){
            if(input[i].value.trim() === ""){
                warning.style.display = 'block';
                return;
            }
        }
            document.querySelector('form').submit();
        })
    </script> 
</body>
</html>