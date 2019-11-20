<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>myLife</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <style>
      .btn-mylife{
        background-color: #3c6948;
        color:white;
      }
      .btn-mylife:hover{
        background-color: #6e706c;
      }
    </style>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="height: 85px; background-color:#3c6948;">
        <a class="navbar-brand" href="#" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;">myLife</a>
    </nav>
    <div class="container" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: black; margin-top: 50px;">
            <center>
                <h1>Personal schedule management</h1>
                <h1>Intelligent social collaboration</h1>
                <h1>Seamless multi-platform use</h1>
                <br/>
                <a class="btn btn-mylife" style="height: 50px; width: 275px; font-size: 30px;" href="pages/loginpage.php">Login</a>
                <br/>
                <a class="btn btn-primary" style="height: 50px; width: 275px; font-size: 30px;" href="pages/registration.php">Register</a>
                </center>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="bootstrap-4.1.0/js/bootstrap.min.js"></script>
</body>
</html>