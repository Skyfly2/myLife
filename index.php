<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>myLife - Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">


</head>
<body style="background-image: ">
    <div class ="container">
        <div class = "row">
            <div class = "col-lg-6 m-auto">
                <div class = "card bg-light mt-5">
                    <div class="card-title bg-success text-white mt-5">
                        <h3 class="text-center py-3" style="font-family: 'Manjari', sans-serif;">Login to myLife</h3>
                    </div>

                    <?php
                        if(@$_GET['Invalid'] == true)
                        {
                    ?>
                        <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Invalid']?></div>
                    <?php
                     }

                        if(@$_GET['Success'] == true){
                    ?>
                        <div class="alert-light text-success text-center py-3"><?php echo $_GET['Success']?></div>
                    <?php
                        }
                    ?>
                    

                    <div class="card-body">
                        <form action="php/login.php" method="post">
                            <input type="text" name="UName" placeholder="Username" class="form-control mb-4">
                            <input type="password" name="Password" placeholder="Password" class="form-control mb-4">
                            <button class="btn btn-success" name="Login">Login</button>
                            <br/>
                            <a href="pages/registration.php">Don't have an account? Sign up here</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="bootstrap-4.1.0/js/bootstrap.min.js"></script>
</body>
</html>