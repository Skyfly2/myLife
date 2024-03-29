<?php
    session_start();
    require("../php/config.php");

    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $color = $_SESSION['color'];
      $taskcolor = $_SESSION['taskcolor'];
      $buttoncolor = $_SESSION['buttoncolor'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Source+Sans+Pro&display=swap" rel="stylesheet">
    <style>
      .btn-mylife{
        background-color: <?php echo $buttoncolor;?>;
        color:white;
      }
      .btn-mylife:hover{
        background-color: #6e706c;
      }
    </style>
    <title>myDrive</title>

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
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="messages.php">Messaging</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="settings.php">Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="../php/logout.php">Logout</a>
      </li>
    </ul>
    
  </div>
</nav>
<?php if(isset($_POST['fromuser'])){ ?>
  <div class="container px-5" id="content" style="background-color: white; padding-top: 5%;">
  <div class="row">
    <div class="col-sm-12">
      <h1 style="font-size: 50px;">Compose Message</h1>
    </div>
    <?php if(@$_GET['InvalidMessage']){
      ?>
      <div class="alert-light text-center text-danger"><?php echo $_GET['InvalidMessage']; ?></div>
      <?php
    }?>
    <div class="col-sm-12">
      <form method="post" action="../php/sendmessage.php">
        <label>To</label>
        <input class="form-control mb-3" type="text" name="sendto" value="<?php echo $_POST['fromuser']; ?>">
        <label>Subject</label>
        <input class="form-control mb-3" type="text" name="subject" value="<?php echo $_POST['subject']; ?>">
        <label>Message</label>
        <input class="form-control mb-3" type="text" name="message" placeholder="Enter your message here...">
        <button type="submit" class="btn btn-mylife mb-3">Send</button>
      </form>
    </div>

  </div>
    
</div>
  ?>
<?php } else{ ?>
<div class="container px-5" id="content" style="background-color: white; padding-top: 5%;">
  <div class="row">
    <div class="col-sm-12">
      <h1 style="font-size: 50px;">Compose Message</h1>
    </div>
    <?php if(@$_GET['InvalidMessage']){
      ?>
      <div class="alert-light text-center text-danger"><?php echo $_GET['InvalidMessage']; ?></div>
      <?php
    }?>
    <div class="col-sm-12">
      <form method="post" action="../php/sendmessage.php">
        <label>To</label>
        <input class="form-control mb-3" type="text" name="sendto" placeholder="Username">
        <label>Subject</label>
        <input class="form-control mb-3" type="text" name="subject" placeholder="Ex: Tonight's Meeting">
        <label>Message</label>
        <input class="form-control mb-3" type="text" name="message" placeholder="Enter your message here...">
        <button type="submit" class="btn btn-mylife mb-3">Send</button>
      </form>
    </div>

  </div>
    
</div>
<?php } ?>

    <footer class="page-footer" style="height:70px; width:100%; background-color: <?php echo $color; ?>">
      
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