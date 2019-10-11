<?php
    session_start();
    require("../php/config.php");

    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
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
    <title>myLife - Dashboard</title>

    <script>if (typeof (fg_widgets) === "undefined") fg_widgets = new Array(); fg_widgets.push("fgid_4ce1c6051896d3eeb7bb3808d");</script>
            <script async src="https://www.feedgrabbr.com/widget/fgwidget.js"></script>
</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="height: 85px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenav" aria-controls="responsivenav" aria-expanded="false" aria-label="Toggle navigation" onclick="document.getElementById('content').style.paddingTop = getElementById('content').style.paddingTop === '300px' ? '5%' : '300px'">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="responsivenav">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="agenda.php">Agenda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="mydrive.php">myDrive</a>
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

<div class="container px-5" id="content" style="background-color: white; padding-top: 5%; ">
    <div class="row">
      <div class="col-sm-12">
        <h1 style="font-size: 50px;">Hello, <?php echo $_SESSION['firstname']; ?></h1>
        </div>
        <div class="col-sm-12">
        <h3 style="font-size: 30px;">Today is <?php $query = "SELECT NOW()"; 
                                  $result=mysqli_query($link, $query); 
                                  if(!$result){
                                    die('Error: ' . mysqli_error($link));
                                  } 
                                  list($sdate) = mysqli_fetch_array($result); 
                                  $ndate=substr($sdate, 5, 6); 
                                  $year=substr($sdate, 0, 4); 
                                  $date=substr($ndate, 0, 5);
                                  echo $date . '-' . $year;?></h3>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="card border-success mb-5" style="border-width: 4px;">
            <div class="card-header">
                <h2>Daily Rundown</h2>
              </div>
            <div class="card-body" style="border-bottom: 1px solid grey;  max-height:500px; overflow-y: auto;">
              <?php $query="SELECT taskname, purpose, description, user, public, day, month, year, hour FROM tasks WHERE user='$username' ORDER BY year, month, day ASC";
                    $result = mysqli_query($link, $query);
                    if(!$result){
                      die('error: ' . mysqli_error($link));
                    }
                    $numtasks=mysqli_num_rows($result);
                    if($numtasks > 0){
                      $count = 0;
                      while(list($taskname, $purpose, $description, $user, $public, $day, $month, $year, $hour)=mysqli_fetch_array($result)){
                        if($count < 5){
                      ?>
                      <div class="card mb-5">
                        <div class="card-header bg-success">
                          <div class="row">
                            <div class="col-sm-12">
                          <h5 style="color: white;"><?php echo $taskname; ?></h5>
                          <?php if($day != 0 && $month != 0 && $year !=0){?>
                          <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day . '/' . $year; ?></p>
                          <?php } 
                                elseif($day != 0 && $month != 0){?>
                                  <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day; ?></p>

                                <?php } 
                                elseif($day != 0){?>
                                  <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day; ?></p>

                              <?php } ?>
                           </div>
                           </div>
                        </div>
                        <div class="card-body border-success">
                          <div class="row">
                            <div class="col-sm-7">
                              <?php if($description != ''){?>
                              <p><?php echo 'Description: ' . $description ?></p>
                              <?php } ?>
                              <?php if($purpose != ''){?>
                              <p><?php echo 'Activity: ' . $purpose ?></p>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php $count++;}}
                    }
                    else{
                     ?>
                    <h4 class="text-danger">You currently have no tasks!</h4>
                    <?php } ?> 
            </div>
          </div> 
        </div>
        <div class="col-lg-6">
          <div class="card border-success mb-5" style="border-width: 4px;">
            <div class="card-header">
                <h2>Social Schedule</h2>
              </div>
            <div class="card-body" style="max-height: 500px; overflow-y: auto;">
              <?php 
              $query1 = "SELECT user FROM shared_tasks WHERE shareduser = '$username'";
              $result1 = mysqli_query($link, $query1);
              if(!$result1){
                die('error: ' . mysqli_error($link));
              }
              $sharedtasks = false;
              //For all users sharing their schedule, display their public tasks
              while(list($masterusers) = mysqli_fetch_array($result1)){
                $sharedtasks = true;
                $query="SELECT taskname, purpose, description, user, public, day, month, year, hour FROM tasks WHERE user='$masterusers' AND public = 'yes' ORDER BY year, month, day ASC";
                $result = mysqli_query($link, $query);
                if(!$result){
                  die('error: ' . mysqli_error($link));
                }
                $numtasks=mysqli_num_rows($result);
                //If that particular user has tasks shared, show them
                if($numtasks > 0){
                  $count = 0;
                  while(list($taskname, $purpose, $description, $user, $public, $day, $month, $year, $hour)=mysqli_fetch_array($result)){
                      ?>
                      <div class="card mb-5">
                        <div class="card-header bg-success">
                          <div class="row">
                            <div class="col-sm-7">
                          <h5 style="color: white;"><?php echo $taskname; ?></h5>
                          <?php 
                              $query2 = "SELECT firstname, lastname FROM users WHERE UName = '$masterusers'";
                              $result2 = mysqli_query($link, $query2);
                              if(!$result){
                                die('error: ' . mysqli_error($link));
                              }
                              list($masterfirst, $masterlast) = mysqli_fetch_array($result2);
                              ?>

                              <p style="color: white;">User: <?php echo $masterfirst . ' ' . $masterlast; ?> </p>

                          <?php if($day != 0 && $month != 0 && $year !=0){?>
                          <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day . '/' . $year; ?></p>
                          <?php } 
                                elseif($day != 0 && $month != 0){?>
                                  <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day; ?></p>

                                <?php } 
                                elseif($day != 0){?>
                                  <p style="color: white;"><?php echo 'Due: ' . $month . '/' . $day; ?></p>

                              <?php } ?>
                           </div>
                           </div>
                        </div>
                        <div class="card-body border-success">
                          <div class="row">
                            <div class="col-sm-7">
                              <?php
                              if($description != ''){?>
                                <p><?php echo 'Description: ' . $description ?></p>
                              <?php } ?>
                              <?php if($purpose != ''){?>
                                <p><?php echo 'Activity: ' . $purpose ?></p>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php }
                    }
                  }
                  if(!$sharedtasks){
                     ?>
                    <h4 class="text-danger">You currently have no tasks!</h4>
                    <?php } ?> 
            </div>
          </div> 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 mb-5">
          <div class="card border-success" style="border-width: 4px;">
            <div class="card-body">
          <a class="weatherwidget-io" href="https://forecast7.com/en/40d71n74d01/new-york/?unit=us" data-label_1="NEW YORK" data-label_2="WEATHER" data-theme="pure" >NEW YORK WEATHER</a>
          <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
          </script>
            </div>
         </div>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card border-success mb-5" style="border-width: 4px;">
          <div class="card-header">
            <h2>Current News</h2>
          </div>
          <div class="card-body">
            <div class="feedgrabbr_widget" id="fgid_4ce1c6051896d3eeb7bb3808d"></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

    <footer class="page-footer bg-success" style="height:70px;">
      
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