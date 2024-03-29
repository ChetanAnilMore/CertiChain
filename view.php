<?php
session_start();

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

// Get the logged-in username from the session
$loggedInUsername = $_SESSION['username']; // Adjust this based on your actual session variable

// Validate and sanitize the input to prevent SQL injection
$validatedUsername = $conn->real_escape_string($loggedInUsername);

// Construct the query using the validated username
$sql = "SELECT file FROM $validatedUsername";

$result = $conn->query($sql);

$images = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

$conn->close();

// Return images as JSON
header('Content-Type: application/json');
echo json_encode($images);
?>



<!DOCTYPE html>
<html>
<head>
<title>VIEWER</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" >
  <link rel="stylesheet" href="vg.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
body{
  margin: 0;
  padding: 0;
}
.top{
      background: #6da5c0;
    }
    .footer{
      background: #bd83b6;
    }
    .section {
      background: #6da5c0;
    }
    .sec6{
      background: #bd83b6;
      margin-bottom: 50px;
    }
.upl{
  background-color: #f5d7db;
  box-shadow: 12px 12px 6px rgba(0, 0, 0, 0.2);
  margin: 50px 30px;
  padding: 10px 50px 20px 50px;
  border-radius: 8px;
}
.row{
  --bs-gutter-x: 0rem;
}
.upl img{
  margin: 20px 50px 20px 50px;
}
.icn{
  margin: 0px 0px 0px 20px;
}
</style>
</head>
<body>
  <div class="section">
    <div class="container">
      <div class="top">
        <div class="logo">
          <img src="photos\logo.png" width="35%">
        </div>
        <div class="toplogo">
          <h2>Certichain</h2>
          <p>E-Certificate Generation,<br> Validation, and Issuance</p>
        </div>
        <div class="nav">
          <a href="indihome.html">Home</a>
          <a href="view.php">Viewer</a>
          <a href="index1.html">Logout</a>
          <img src="icons\person-square.svg" alt="User Icon">
        </div>
      </div>
    </div>
  </div>
  <div class="section-2">
    <div class="row">
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo1.png" width="40%">
              <p><b>Certificate Name:</b>job ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>   
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo2.png" width="40%">
              <p><b>Certificate Name:</b>lab ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo3.png" width="40%">
              <p><b>Certificate Name:</b>lab ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="section-2">
    <div class="row">
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo1.png" width="40%">
              <p><b>Certificate Name:</b>job ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>   
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo2.png" width="40%">
              <p><b>Certificate Name:</b>lab ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="upl">
            <center>
              <img src="photos\photo3.png" width="40%">
              <p><b>Certificate Name:</b>lab ceri</p>
            </center>
            <div class="icn">
              <img src="icons\download.svg">
              <img src="icons\share.svg">
            </div>
          </div>
        </div>
    </div>
  </div>
 <div class="section-5">
  <div class="footer">
    <div class="butm">
      <div class="flogo">
        <img src="photos\logo.png" width="35%">
      </div>
      <div class="btmlogo">
        <h2>Certichain</h2>
        <p>E-Certificate Generation, Validation, and Issuance</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="cont1">
          <h3>Contact Us</h3>
          <p>Email : certichain29@gmail.com</p>
          <p>Mobile : +91 8709193759</p>
          <p>Location : Surat, India</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cont2">
          <h3>Follow Us</h3>
          <p><a href="https://youtube.com/@reverbaddiction?si=1AD08jXae7yzCkiN" style="color:black;">Youtube</a></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cont3">
          <p>Subscribe to our newsletter and stay updated<br> with the latest news and updates.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    offset: 20,
  }); 
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
  document.querySelector('.menu-toggle').addEventListener('click', function () {
    document.querySelector('.nav-links').classList.toggle('active');
  });
  
</script>
<!-- Add this script to your existing HTML file -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
      fetch('view.php', {
         method: 'GET',
         credentials: 'include', // Include credentials (cookies) in the request
      })
         .then(response => response.json())
         .then(data => {
            // Loop through the fetched images and update img tags
            data.forEach(image => {
               const imgElement = document.createElement('img');
               imgElement.src = image.image_path;
               imgElement.width = '40%';

               const certificateName = image.certificate_name;

               const uplDiv = document.createElement('div');
               uplDiv.classList.add('upl');

               const centerElement = document.createElement('center');
               centerElement.appendChild(imgElement);

               centerElement.appendChild(pElement);
               uplDiv.appendChild(centerElement);

               // Append the new div to your existing container
               document.querySelector('.row').appendChild(uplDiv);
            });
         })
         .catch(error => console.error('Error fetching images:', error));
   });
</script>

</body>

</html>