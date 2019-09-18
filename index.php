
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>

</head>
<body style="background: #CFGD">
    <div class ="container">
        <div class = "row">
            <div class = "col-lg-6 m-auto">
                <div class = "card bg-dark mt-5">
                    <div class="card-title bg-primary text-white mt-5">
                        <h3 class="text-center py-3">Login to myLife</h3>
                    </div>

                    <?php
                        if($_GET['Invalid'] == true)
                        {
                    ?>
                        <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Invalid']?></div>
                    <?php
                     }
                    ?>
                    

                    <div class="card-body">
                        <form action="php/process.php" method="post">
                            <input type="text" name="UName" placeholder="Username" class="form-control mb-5">
                            <input type="password" name="Password" placeholder="Password" class="form-control mb-5">
                            <button class="btn btn-success" name="Login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>