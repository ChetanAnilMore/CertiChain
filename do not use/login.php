<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "certicain");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
    $username = @$_POST ['email'];
    $password = @$_POST ['password'];
if (isset ($_POST ['submit'])) {
  if ($username && $password) {
    $check = mysql_query ("SELECT * FROM certicain WHERE email='".$username."' AND password= '".$password."'");
    $rows = mysql_num_rows ($check);
    if (mysql_num_rows ($check)!=0) {
      header ("location: indi_create.php");
      exit ();
    } else {
      $error = "Couldn't find username.";
    }
  } else {
    echo "Please fill all the fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>LOGIN PAGE</title>
    <style>
        .radio-button-container {
          display: flex;
          align-items: center;
          gap: 24px;
          margin-left: 20px;
        }

        .radio-button {
          display: inline-block;
          position: relative;
          cursor: pointer;
          margin-left: 20px;
        }

        .radio-button__input {
          position: absolute;
          opacity: 0;
          width: 0;
          height: 0;
        }

        .radio-button__label {
          display: inline-block;
          padding-left: 30px;
          margin-bottom: 10px;
          position: relative;
          font-size: 15px;
          color: #f2f2f2;
          font-weight: 600;
          cursor: pointer;
          text-transform: uppercase;
          transition: all 0.3s ease;
        }

        .radio-button__custom {
          position: absolute;
          top: 0;
          left: 0;
          width: 20px;
          height: 20px;
          border-radius: 50%;
          border: 2px solid #555;
          transition: all 0.3s ease;
        }

        .radio-button__input:checked + .radio-button__label .radio-button__custom {
          background-color: #4c8bf5;
          border-color: transparent;
          transform: scale(0.8);
          box-shadow: 0 0 20px #4c8bf580;
        }

        .radio-button__input:checked + .radio-button__label {
          color: #4c8bf5;
        }

        .radio-button__label:hover .radio-button__custom {
          transform: scale(1.2);
          border-color: #4c8bf5;
          box-shadow: 0 0 20px #4c8bf580;
        }
    </style>
</head>
<body>
    <div class="container1">
        <h1 style="text-align:center;">Login</h1><br>
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
        <div class="radio-button-container">
              <div class="radio-button">
                <input type="radio" class="radio-button__input" id="radio1" name="radio-group">
                <label class="radio-button__label" for="radio1">
                <span class="radio-button__custom"></span>
                INDIVIDUAL
                </label>
            </div>
            <div class="radio-button">
              <input type="radio" class="radio-button__input" id="radio2" name="radio-group">
              <label class="radio-button__label" for="radio2">
                <span class="radio-button__custom"></span>
                INSTITUTIONAL
              </label>
            </div>
        </div><br>
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
            <p>Don't have an account? <a href="option.html">Create New Account</a></p>
        </div>
    </div>
</body>