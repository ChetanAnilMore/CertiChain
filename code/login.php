<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "certicain");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = isset($_POST['radio-group']) ? $_POST['radio-group'] : '';

    if (!empty($username) && !empty($password) && !empty($userType)) {
        // Use prepared statements to prevent SQL injection
        if ($userType === 'individual') {
            $stmt = $conn->prepare("SELECT * FROM individual WHERE username = ? AND password = ?");
            $redirectPage = "indihome.html"; // Change this to the desired page for individual users
        } elseif ($userType === 'institutional') {
            $stmt = $conn->prepare("SELECT * FROM institution WHERE username = ? AND password = ?");
            $redirectPage = "instihome.html"; // Change this to the desired page for institutional users
        } else {
            die("Invalid user type");
        }

        $stmt->bind_param("ss", $username, $password);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a row was returned
        if ($result->num_rows == 1) {
            // Login successful, redirect to the desired page
            header("location: $redirectPage");
            exit();
        } else {
            $error = "Incorrect username or password.";
        }

        // Close the statement
        $stmt->close();
    } else {
        $error = "Please fill in all the fields.";
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
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
          color: white;
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
    background-color: #4c8bf5; /* Change this to the desired blue color */
    border-color: transparent;
    transform: scale(0.8);
    box-shadow: 0 0 20px #4c8bf580;
}

.radio-button__input:checked + .radio-button__label {
    /* color: #4c8bf5; Change this to the desired blue color */
}

.radio-button__label:hover .radio-button__custom {
    transform: scale(1.2);
    border-color: #4c8bf5; /* Change this to the desired blue color */
    box-shadow: 0 0 20px #4c8bf580;
}

        input{
        accent-color: blue;
        }
    </style>
</head>

<body>
    <div class="container1">
        <h1 style="text-align:center;">Login</h1><br>
        <form class="flip-card__form" method="POST">
            <div class="form-control">
                <input class="input input-alt" name="username" placeholder="UserName" type="text" required>
                <span class="input-border input-border-alt"></span>
            </div>

            <div class="form-control">
                <input class="input input-alt" name="password" placeholder="Password" type="password" required>
                <span class="input-border input-border-alt"></span>
            </div>

            <div class="radio-button-container">
                <div class="radio-button">
                    <input type="radio" class="radio-button__input" id="radio1" name="radio-group" checked value="individual">
                    <label class="radio-button__label" for="radio1">
                        <span class="radio-button__custom"></span>
                        INDIVIDUAL
                    </label>
                </div>
                <div class="radio-button">
                    <input type="radio" class="radio-button__input" id="radio2" name="radio-group" value="institutional">
                    <label class="radio-button__label" for="radio2">
                        <span class="radio-button__custom"></span>
                        INSTITUTIONAL
                    </label>
                </div>
            </div><br>

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
        </form>

        <div class="create-account">
            <p>Don't have an account? <a href="option.html">Create New Account</a></p>
        </div>

        <div id="warning" style="display:none;color:white;">Please Enter all Fields</div>
    </div>

    <script>
        let submit = document.getElementById('submit');
        let input = document.getElementsByTagName('input');
        let warning = document.getElementById('warning');

        submit.addEventListener('click', (event) => {
            for (let i = 0; i < input.length; i++) {
                if (input[i].value.trim() === "") {
                    event.preventDefault(); // Prevent form submission
                    warning.style.display = 'block';
                    return;
                }
            }
            // Continue with form submission
        });
    </script>
</body>

</html>
