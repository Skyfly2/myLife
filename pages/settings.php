<?php
    session_start();
    require("../php/config.php");

    if(isset($_SESSION['username'])){
      $color = $_SESSION['color'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>myLife - Settings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Source+Sans+Pro&display=swap" rel="stylesheet">
    


</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light" style="height: 85px; background-color: <?php echo $color; ?>">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenav" aria-controls="responsivenav" aria-expanded="false" aria-label="Toggle navigation" onclick="document.getElementById('content').style.paddingTop = getElementById('content').style.paddingTop === '300px' ? '5%' : '300px'">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="responsivenav">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="agenda.php">Agenda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="mydrive.php">myDrive</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="settings.php">Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="../php/logout.php">Logout</a>
      </li>
    </ul>
    
  </div>
</nav>

<div class="container px-5" id="content" style="background-color: white; padding-top: 5%; padding-bottom: 5%;">
    <div class="row">
      <div class="col-sm-12" style="padding-bottom: 3%;">
        <h1 style="font-size: 50px;">Account Settings</h1>
      </div>

      <div class="col-lg-4" style="padding-bottom: 10%;">
       <div class="card" style="border-width: 4px; height: 270px; border-color: <?php echo $color; ?>">
          <div class="card-header">
            <h4>Update Email</h4>
          </div>
          <div class="card-body">

          <?php if(@$_GET['SuccessEmail']){ ?>
            <div class="alert-light text-center text-success"><?php echo $_GET['Success']; ?></div>
          <?php } ?>

          <?php if(@$_GET['InvalidEmail']){ ?>
            <div class="alert-light text-center text-danger"><?php echo $_GET['Invalid']; ?></div>
          <?php } ?>
            <form action="../php/updateuser.php" method="post">
              <input type="text" name="newemail" placeholder="New Email" class="form-control mb-4">
              <button class="btn btn-success" name="updateemail">Update Email</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4" style="padding-bottom: 10%;">
       <div class="card" style="border-width: 4px; height: 270px; border-color: <?php echo $color; ?>">
          <div class="card-header">
            <h4>Change Username</h4>
          </div>
          <div class="card-body">

          <?php if(@$_GET['SuccessUser']){ ?>
            <div class="alert-light text-center text-success"><?php echo $_GET['SuccessUser']; ?></div>
          <?php } ?>

          <?php if(@$_GET['InvalidUser']){ ?>
            <div class="alert-light text-center text-danger"><?php echo $_GET['InvalidUser']; ?></div>
          <?php } ?>
            <form action="../php/updateuser.php" method="post">
              <input type="text" name="newusername" placeholder="New Username" class="form-control mb-4">
              <button class="btn btn-success" name="updateusername">Change Username</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
       <div class="card" style="border-width: 4px;  height: 270px; border-color: <?php echo $color; ?>">
          <div class="card-header">
            <h4>Change Name</h4>
          </div>
          <div class="card-body">

          <?php if(@$_GET['SuccessName']){ ?>
            <div class="alert-light text-center text-success"><?php echo $_GET['SuccessName']; ?></div>
          <?php } ?>

          <?php if(@$_GET['InvalidName']){ ?>
            <div class="alert-light text-center text-danger"><?php echo $_GET['InvalidName']; ?></div>
          <?php } ?>
            <form action="../php/updateuser.php" method="post">
              <input type="text" name="newfirst" placeholder="New Firstname" class="form-control mb-4">
              <input type="text" name="newlast" placeholder="New Lastname" class="form-control mb-4">
              <button class="btn btn-success" name="updatename">Change Name</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-4" style="padding-bottom: 10%;">
      <div class="card border-danger" style="border-width: 4px; height: 330px;">
        <div class="card-header">
          <h4>Change Password</h4>
      </div>
      <div class="card-body">
        <?php if(@$_GET['SuccessPass']){?>
          <div class="alert-light text-success text-center"><?php echo $_GET['SuccessPass']; ?></div>
        <?php } ?>
        <?php if(@$_GET['InvalidPass']){ ?>
          <div class="alert-light text-danger text-center"><?php echo $_GET['InvalidPass']; ?></div>
        <?php } ?>
        <form action="../php/updateuser.php" method="post">
          <input type="password" name="newpass" placeholder="New Password" class="form-control mb-4">
          <input type="password" name="confirmnewpass" placeholder="Confirm New Password" class="form-control mb-4">
          <button class="btn btn-danger" name="changepassword">Change Password</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
      <div class="card border-danger" style="border-width: 4px; height: 330px; overflow-y: auto;">
        <div class="card-header">
          <h4>Delete Account</h4>
      </div>
      <div class="card-body">
          <div class="alert-light text-danger text-center" style="font-size: 12px;">By deleting your account, you will no longer have access to myLife. This action cannot be undone</div>

          <?php if(@$_GET['InvalidDelete']){ ?>
            <div class="alert-light text-center text-danger"><?php echo $_GET['InvalidDelete']; ?></div>
          <?php } ?>
        <form action="../php/updateuser.php" method="post">
          <select name="confirmation" class="mb-4 form-control">
            <option value="confirmdeletion">Confirm Deletion</option>
            <option value="NoDelete">No</option>
            <option value="YesDelete">Yes</option>
          </select>
          <input type="password" name="deleteuser" placeholder="Enter your password" class="form-control mb-4">
          <button class="btn btn-danger" name="deleteaccount">Delete Account</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card" style="border-color: <?php echo $color; ?>; border-width: 4px; height: 330px;">
      <div class="card-header"><h2>Edit myLife Colors</h2></div>
      <div class="card-body">
        <form method="post" action="../php/editcolors.php">
          <input type="color" name="newcolor" value="<?php echo $color ?>">
          <button type="submit" class="btn btn-success">Change Colors</button>
        </form>
      </div>
    </div>
  </div>
</div>
  </div>

    <footer class="page-footer" style="height:70px; background-color: <?php echo $color; ?>">
      
        <div class="container-fluid text-center">
        <center>
          <p class="mt-auto" style="color: white; padding-top: 20px;">Copyright &copy Asher Hamrick 2019</p>
        </center>
      </div>
    
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../bootstrap-4.1.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
}
else{
  header("location:../index.php?Invalid= You must login to access myLife");
}
?>