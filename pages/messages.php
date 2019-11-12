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
      <h1 style="font-size: 50px;">Messages</h1>
    </div>
    <div class="col-sm-12">
      <a href="compose.php"><button style="margin-bottom: 20px;" class="btn-mylife btn">Compose</button></a>
    </div>
    <div class="col-sm-12">
      <?php //Display unread messages if the user has them
            $query = "SELECT user FROM messages WHERE user = '$username' AND viewed = 'no'";
            $result = mysqli_query($link, $query);
            if(!$result){
              die('error: ' . mysqli_error($link));
            }
            if(mysqli_num_rows($result) > 0){
              ?>
      <div class="card mb-3" style="border-color: <?php echo $color; ?>; border-width:4px;">
        <div class="card-header">
          <h2>Unread Messages</h2>
        </div>
        <div class="card-body" style="min-height: 40px; max-height: 300px; overflow-y: auto;">
          <?php $query2 = "SELECT fromuser, timesent, subject FROM messages WHERE user = '$username' AND viewed = 'no'";
                $result2 = mysqli_query($link, $query2);
                if(!$result2){
                  die('error: ' . mysqli_error($link));
                }

                while(list($fromuser, $timesent, $subject) = mysqli_fetch_array($result2)){ ?>

                  <div class="card mb-3" style="border-color: <?php echo $color; ?>; border-width: 3px;">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-sm-5">
                          <h2><?php echo $subject; ?></h1>
                        </div>
                        <div class="col-sm-4">
                          <h2 style="float: center;">From: <?php echo $fromuser; ?></h2>
                        </div>
                        <div class="col-sm-3">
                          <h3 style="float: right;">Sent: <?php  
                                      $ndate=substr($timesent, 5, 6); 
                                      $year=substr($timesent, 0, 4); 
                                      $date=substr($ndate, 0, 5);
                                      echo $date . '-' . $year; ?></h3>
                                    </div>
                        <div class="col-sm-12">
                          <form method="post" action="viewmessage.php">
                            <button style="float: right;" class="btn btn-mylife" name="message" type="submit" value="<?php echo $subject?>">View</button>
                            <input style="display: none;" name="fromuser" value="<?php echo $fromuser; ?>">
                            <input style="display: none;" name="timesent" value="<?php echo $timesent; ?>">
                          </form>
                        </div>
                        </div>
                    </div>
                  </div>
                <?php } ?>
        </div>
      </div>
    <?php }
    ?>
      <div class="card mb-3" style="border-color: <?php echo $color; ?>; border-width: 4px;">
        <div class="card-header">
          <h2>Messages</h2>
        </div>
        <div class="card-body" style="min-height: 40px; max-height: 300px; overflow-y: auto;">
          <?php $query3 = "SELECT fromuser, timesent, subject FROM messages WHERE user = '$username' AND viewed = 'yes'";
                $result3 = mysqli_query($link, $query3);
                if(!$result3){
                  die('error: ' . mysqli_error($link));
                }

                if(mysqli_num_rows($result3) == 0){
                  ?>
                  <div class="alert-light text-danger text-center">You have no messages!</div>
                <?php }
                else{

                while(list($fromuser, $timesent, $subject) = mysqli_fetch_array($result3)){ ?>

                  <div class="card mb-3" style="border-color: <?php echo $color; ?>; border-width: 3px;">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-sm-5">
                          <h2><?php echo $subject; ?></h1>
                        </div>
                        <div class="col-sm-4">
                          <h2 style="float: center;">From: <?php echo $fromuser; ?></h2>
                        </div>
                        <div class="col-sm-3">
                          <h3 style="float: right;">Sent: <?php  
                                      $ndate=substr($timesent, 5, 6); 
                                      $year=substr($timesent, 0, 4); 
                                      $date=substr($ndate, 0, 5);
                                      echo $date . '-' . $year; ?></h3>
                                    </div>
                          <div class="col-sm-12">
                          <form method="post" action="viewmessage.php">
                            <button style="float: right;" class="btn btn-mylife" type="submit">View</button>
                            <input style="display: none;" name="subject" value="<?php echo $subject; ?>">
                            <input style="display: none;" name="fromuser" value="<?php echo $fromuser; ?>">
                            <input style="display: none;" name="timesent" value="<?php echo $timesent; ?>">
                            
                          </form>
                        </div>
                                </div>
                    </div>
                  </div>
                <?php } }?>
        </div>
      </div>
      </div>
    </div>
    <div class="col-sm-12">
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