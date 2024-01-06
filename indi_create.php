<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


$server = "localhost";
$username = "root";
$password = "";
$database = "users";

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
        $pnumber = mysqli_real_escape_string($conn, $_POST['pname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "INSERT INTO `individual`(`fname`, `lname`, `pnumber`,`username`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $fname, $lname, $pnumber, $username, $email, $password);

        if ($stmt->execute()) {
            $createTableQuery = "CREATE TABLE IF NOT EXISTS `$username` (id INT AUTO_INCREMENT PRIMARY KEY, file LONGBLOB)";
            if ($conn->query($createTableQuery) === TRUE) {
                $_SESSION['success'] = 'Registration success.';
                header("location: login.php");
            } else {
                throw new Exception("Error creating user-specific table: " . $conn->error);
            }
        } else {
            throw new Exception("Error inserting data into the database: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    echo "Form submitted!";
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
        <form class="flip-card__form" action="" method="POST">
            <div class="form-control">
                <input class="input input-alt" id="fname" name="fname" placeholder="First Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" id="lname" name="lname" placeholder="Last Name" type="name" required>
                <span class="input-border input-border-alt"></span>
            <div class="form-control">
                <input class="input input-alt" id="pnumber" name="pname" placeholder="Phone Number" type="int" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" id="username" name="username" placeholder="Username" type="text" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" id="email" name="email" placeholder="Email" type="email" required>
                <span class="input-border input-border-alt"></span>
            </div>
            <div class="form-control">
                <input class="input input-alt" id="password" name="password" placeholder="Password" type="password" required>
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
            console.log("Button Clicked");
            for(let i=0;i<6;i++){
            console.log(input[i].id, input[i].value);
            if(input[i].value.trim() === ""){
                warning.style.display = 'block';
                return;
            }
        }
        })
    </script> 
</body>
</html>