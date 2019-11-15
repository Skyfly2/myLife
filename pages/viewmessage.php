<?php
    session_start();
    require("../php/config.php");

    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $color = $_SESSION['color'];
      $taskcolor = $_SESSION['taskcolor'];
      $buttoncolor = $_SESSION['buttoncolor'];
      $fromuser = $_POST['fromuser'];
      $timesent = $_POST['timesent'];
      $q = "UPDATE messages SET viewed = 'yes' WHERE fromuser = '$fromuser' AND user = '$username' AND timesent = '$timesent'";
      $r = mysqli_query($link, $q);
      if(!$r){
        die('error: ' . mysqli_error($link));
      }
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
      footer{
        bottom: 0;
        position: absolute;
      }
      .btn-mylife{
        background-color: <?php echo $buttoncolor;?>;
        color:white;
      }
      .btn-mylife:hover{
        background-color: #6e706c;
      }
    </style>
    <title>myLife - Messages</title>

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

<div class="container px-5" id="content" style="background-color: white; padding-top: 5%;">
  <div class="row">
    <div class="col-sm-12">
      <?php 
      //Get message info
      $query = "SELECT subject,message FROM messages WHERE timesent = '$timesent' AND fromuser = '$fromuser' AND user = '$username'";
      $result = mysqli_query($link, $query);
      if(!$result){
        die('error: ' . mysqli_error($link));
      }
      list($subject,$message) = mysqli_fetch_array($result);
      //Get info about the user who sent
      $query2 = "SELECT firstname, lastname FROM users WHERE UName = '$fromuser'";
      $result2 = mysqli_query($link, $query2);
      if(!$result2){
        die('error: ' . mysqli_error($link, $query2));
      }
      list($firstname, $lastname) = mysqli_fetch_array($result2);
      ?>

      <h1 style="font-size: 50px;"><?php echo $subject; ?></h1>
      <h2>From: <?php echo $firstname . ' ' . $lastname . ' (' . $fromuser . ')'; ?></h2>
      <?php  
            //Display date in cool format
            $ndate=substr($timesent, 5, 6);
            $year=substr($timesent, 0, 4); 
            $date=substr($ndate, 0, 5); ?>
      
      
      <p><?php echo $message; ?></p>

      
    </div>
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-1">
          <form method="post" action="compose.php">
            <button class="btn btn-mylife" type="submit">Reply</button>
            <input style="display: none;" name="fromuser" value="<?php echo $fromuser;?>">
            <input style="display: none;" name="subject" value="<?php echo 'Re: ' . $subject;?>">
            <input style="display: none;" name="timesent" value="<?php echo $timesent;?>">
          </form>
        </div>
        <div class="col-sm-2">
          <form method="post" action="../php/deletemessage.php">
            <button class="btn btn-danger" type="submit">Delete Message</button> 
            <input style="display: none;" name="fromuser" value="<?php echo $fromuser;?>">
            <input style="display: none;" name="touser" value="<?php echo $username;?>">
            <input style="display: none;" name="subject" value="<?php echo $subject;?>">
            <input style="display: none;" name="timesent" value="<?php echo $timesent;?>">
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <p style="font-size: 13px;">Sent: <?php echo $date . '-' . $year; ?></p>
    </div>
    

  </div>
    
</div>

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