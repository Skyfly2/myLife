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
    <title>myLife - Agenda</title>
    


</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light ban-mylife" style="height: 85px; background-color: <?php echo $color; ?>">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenav" aria-controls="responsivenav" aria-expanded="false" aria-label="Toggle navigation" onclick="document.getElementById('content').style.paddingTop = getElementById('content').style.paddingTop === '300px' ? '5%' : '300px'">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="responsivenav">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mb-auto">
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 25px;" href="agenda.php">Agenda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px;" href="mydrive.php">myDrive</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px;" href="settings.php">Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px;" href="../php/logout.php">Logout</a>
      </li>
    </ul>
    
  </div>
</nav>

<div class="container px-5" id="content" style="background-color: white; padding-top: 5%;">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="ml-3 mb-5" style="font-size: 50px;">Agenda</h1>
      </div>
        <div class="col-sm-12">
          <div class="card mb-5" style="border-width: 4px; border-color: <?php echo $color; ?>">
            <div class="card-header">
                <h2>Personal Tasks</h2>
                <?php if(@$_GET['InvalidTask']){ ?>
                <div class="alert-light text-danger text-center"><?php echo $_GET['InvalidTask']; ?></div>
               <?php } ?>
               <?php if(@$_GET['SuccessTask']){ ?>
              <div class="alert-light text-success text-center"><?php echo $_GET['SuccessTask']; ?></div>
              <?php } ?>
              </div>
            <div class="card-body" style="border-bottom: 1px solid grey;  max-height: 700px; overflow-y: auto;">
              <?php $query="SELECT taskname, purpose, description, user, public, day, month, year, hour FROM tasks WHERE user='$username' ORDER BY year, month, day ASC";
                    $result = mysqli_query($link, $query);
                    if(!$result){
                      die('error: ' . mysqli_error($link));
                    }
                    $numtasks=mysqli_num_rows($result);
                    if($numtasks > 0){
                      while(list($taskname, $purpose, $description, $user, $public, $day, $month, $year, $hour)=mysqli_fetch_array($result)){
                      ?>
                      <div class="card mb-5">
                        <div class="card-header" style="background-color: <?php echo $taskcolor; ?>">
                          <div class="row">
                            <div class="col-sm-10">
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
                        <div class="col-sm-2">
                          <form action="../php/deletetask.php" method="post">
                            <button id="submit" type="submit" name="taskname" value="<?php echo $taskname ?>" class="btn btn-mylife" style="background-color: <?php echo $buttoncolor; ?>">Complete</button>
                         </form>

                        </div>
                           </div>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-10">
                              <?php if($description != ''){?>
                              <p><?php echo 'Description: ' . $description ?></p>
                              <?php } ?>
                              <?php if($purpose != ''){?>
                              <p><?php echo 'Activity: ' . $purpose ?></p>
                              <?php } ?>
                            </div>
                            <div class="col-sm-2">
                              <form action="edittask.php" method="post">
                              <button type="submit" name="taskedit" value="<?php echo $taskname ?>" class="btn btn-danger" data-toggle="modal" data-target="#edittask">Edit Task</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php }
                    }
                    else{
                     ?>
                    <h4 class="text-danger">You currently have no tasks!</h4>
                    <?php } ?> 
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-mylife" data-toggle="modal" style="background-color: <?php echo $buttoncolor; ?>"data-target="#addtask">Create Task</button>
            </div>

            <div id="addtask" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5>Create a new task</h5>
                  </div>
                  <div class="modal-body">
                    <form action="../php/createtask.php" method="post">
                      <input type="text" name="taskname" placeholder="Task Name*" class="mb-4 form-control">
                      <input type="text" name="description" placeholder="Task Description" class="mb-4 form-control">
                      <select name="time" class="form-control mb-4">
                        <option value=0>Hour due</option>
                        <?php $count=1;
                              while($count <= 12){
                                ?> <option value=<?php echo $count?>><?php echo $count?></option>
                                <?php
                                $count++;
                              }
                        ?>
                      </select>
                      <select name="month" class="form-control mb-4">
                        <option value=0>Select Month</option>
                        <option value=1>January</option>
                        <option value=2>February</option>
                        <option value=3>March</option>
                        <option value=4>April</option>
                        <option value=5>May</option>
                        <option value=6>June</option>
                        <option value=7>July</option>
                        <option value=8>August</option>
                        <option value=9>September</option>
                        <option value=10>October</option>
                        <option value=11>November</option>
                        <option value=12>December</option>
                      </select>
                      <select name="day" class="form-control mb-4">
                        <option value=0>Day Due</option>
                        <?php $count=1;
                              while($count <= 31){
                                ?> <option value=<?php echo $count?>><?php echo $count?></option>
                                <?php
                                $count++;
                              }
                        ?>
                      </select>
                      <select name="purpose" class="mb-4 form-control">
                        <option value="none">Select Activity</option>
                        <?php $query="SELECT purpose FROM purposes WHERE user='$username'";
                              $result=mysqli_query($link, $query);
                              if(!$result){
                                die('error: ' . mysqli_error($link));
                              }
                              $numpurposes=mysqli_num_rows($result);
                              if($numpurposes > 0){
                                while(list($purposes)=mysqli_fetch_array($result)){
                               ?>
                               <option value="<?php echo $purposes;?>"><?php echo $purposes;?></option>
                             <?php }
                           }?>
                      </select>
                      <select name="publicize" class="mb-4 form-control"> 
                        <option value="no">Make Task Public?</option>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                      </select>
                      <button class="btn btn-mylife" style="background-color: <?php echo $buttoncolor; ?>" name="createtask">Create Task</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>

        <?php //Determine if there are any requests
              $query = "SELECT mainuser FROM shared_task_hold WHERE holduser = '$username' AND requestuser = '$username'";
              $result = mysqli_query($link, $query);
              if(!$result){
                die('error: ' . mysqli_error($link));
              }
              $q1 = "SELECT mainuser FROM shared_task_hold WHERE holduser = '$username' AND requestuser = mainuser";
              $r1 = mysqli_query($link, $q1);
              if(!$r1){
                die('error: ' . mysqli_error($link));
              }
              $numresults1 = mysqli_num_rows($result);
              $numresults2 = mysqli_num_rows($r1);

              //If there are any requests, display the request inteface
              if($numresults1 > 0 || $numresults2 > 0){
        ?>
        <div class="col-sm-12">
          <div class="card mb-5" style="border-width: 4px; max-height: 300px; overflow-y: auto; border-color: <?php echo $color; ?>">
            <div class="card-header">
              <h2>Shared Schedule Requests</h2>
            </div>
            <div class="card-body" style="overflow-y: auto;">
              <?php if($numresults1 > 0){ ?>
              <p>These users want to share their public schedule with you!</p>
              <?php 
                    while(list($mainuser) = mysqli_fetch_array($result)){ ?>
                      <div class="card mb-5" style="border-color: <?php echo $color; ?>">
                          <div class="card-body">
                            <div class="row">
                            <div class="col-sm-8">
                            <h2><?php $query2 = "SELECT firstname, lastname FROM users WHERE UName = '$mainuser'";
                                      $result2 = mysqli_query($link, $query2);
                                      if(!$result2){
                                        die('error: ' . mysqli_error($link));
                                      }
                                      list($sharedfirst, $sharedlast) = mysqli_fetch_array($result2);
                                      echo $sharedfirst . ' ' . $sharedlast;
                                ?>
                            <h6>Username: <?php echo $mainuser; ?></h6>
                          </div>
                          <div class="col-sm-2">
                            <form method="post" action="../php/acceptuser.php">
                              <button name="useraccept" class="btn btn-mylife m-auto" type="submit" style="background-color: <?php echo $buttoncolor; ?>" value="<?php echo $mainuser; ?>">Accept Request</button>
                            </form>
                          </div>
                          <div class="col-sm-2">
                            <form method="post" action="../php/denyuser.php">
                              <button name="userdeny" class="btn btn-danger m-auto" type="submit" value="<?php echo $mainuser; ?>">Deny Request</button>
                            </form>
                          </div>
                        </div>
                          </div>
                        </div>
                      <?php} 
                    ?>
              
              
            <?php   }} ?>
            <?php if($numresults2 > 0){ ?>
              <p>These users want you to share your public schedule with them!</p>
              <?php 
                    while(list($mainuser) = mysqli_fetch_array($r1)){ ?>
                      <div class="card mb-5" style="border-color: <?php echo $color; ?>">
                          <div class="card-body">
                            <div class="row">
                            <div class="col-sm-8">
                            <h2><?php $query2 = "SELECT firstname, lastname FROM users WHERE UName = '$mainuser'";
                                      $result2 = mysqli_query($link, $query2);
                                      if(!$result2){
                                        die('error: ' . mysqli_error($link));
                                      }
                                      list($sharedfirst, $sharedlast) = mysqli_fetch_array($result2);
                                      echo $sharedfirst . ' ' . $sharedlast;
                                ?>
                            <h6>Username: <?php echo $mainuser; ?></h6>
                          </div>
                          <div class="col-sm-2">
                            <form method="post" action="../php/acceptuser.php">
                              <button name="useraccept" class="btn btn-mylife m-auto" type="submit" style="background-color: <?php echo $buttoncolor; ?>" value="<?php echo $mainuser; ?>">Accept Request</button>
                            </form>
                          </div>
                          <div class="col-sm-2">
                            <form method="post" action="../php/denyuser.php">
                              <button name="userdeny" class="btn btn-danger m-auto" type="submit" value="<?php echo $mainuser; ?>">Deny Request</button>
                            </form>
                          </div>
                        </div>
                          </div>
                        </div>
                      <?php} 
                    ?>
              
              
            <?php   }} ?>
                    
            </div>
          </div>
        </div>
      <?php } ?>
        <div class="col-sm-6">
          <div class="card mb-5" style="border-width: 4px; height: 260px; border-color: <?php echo $color; ?>">
            <div class="card-header">
                <h2>Share Your Schedule</h2>
              </div>
            <div class="card-body" style="overflow-y: auto;">
              <?php if(@$_GET['InvalidPurpose']){ ?>
              <div class="alert-light text-danger text-center"><?php echo $_GET['InvalidPurpose']; ?></div>
              <?php } ?>
              <?php if(@$_GET['SuccessPurpose']){ ?>
                <div class="alert-light text-center text-success"><?php echo $_GET['SuccessPurpose']; ?></div>
              <?php } ?>
              <form action="../php/shareschedule.php" method="post">
                <input type="text" placeholder="User" name="shareduser" class="mb-4 form-control">
                <button class="btn btn-mylife" style="background-color: <?php echo $buttoncolor; ?>" name="shareuser">Share Schedule</button>
              </form>
            </div>
          </div> 
        </div>
        <div class="col-sm-6">
          <div class="card mb-5" style="border-width: 4px; height: 260px; border-color: <?php echo $color; ?>">
            <div class="card-header">
                <h2>Request A Schedule</h2>
              </div>
            <div class="card-body" style="overflow-y: auto;">
              <form action="../php/shareschedule.php" method="post">
                <input type="text" placeholder="User" name="requesteduser" class="mb-4 form-control">
                <button class="btn btn-mylife" style="background-color: <?php echo $buttoncolor; ?>" name="requestuser">Request Schedule</button>
              </form>
            </div>
          </div> 
        </div>
        <div class="col-sm-6">
          <div class="card mb-5" style="border-width: 4px; height: 420px; border-color: <?php echo $color; ?>">
            <div class="card-header">
              <h2>Manage Shedule Sharing</h2>
            </div>
            <div class="card-body" style="overflow-y: auto;">
              <form method="post" action="../php/removefromaccess.php">
                <label>Remove User From Viewing Your Schedule</label>
                <select name="removefromaccess" class="form-control">
                  <option value="none">Select User</option>
                  <?php 
                  //Show other users that can view the user's current public tasks
                  $q = "SELECT shareduser FROM shared_tasks WHERE user = '$username'";
                  $r = mysqli_query($link, $q);
                  if(!$r){
                    die('error: ' . mysqli_error($link));
                  }
                  while(list($sharedusers) = mysqli_fetch_array($r)){
                  ?>
                  <option value="<?php echo $sharedusers ?>"><?php echo $sharedusers ?></option>
                <?php } ?>
                </select>
                <button type="submit" style="background-color: <?php echo $buttoncolor; ?>" class="btn btn-mylife mt-4 mb-4">Remove User</button>
              </form>
              <form method="post" action="../php/stopviewinguser.php">
                <label>Stop Viewing Other User's Schedule</label>
                <select name="stopviewinguser" class="form-control">
                  <option value="none">Select User</option>
                  <?php 
                  //Show other users that can view the user's current public tasks
                  $q = "SELECT user FROM shared_tasks WHERE shareduser = '$username'";
                  $r = mysqli_query($link, $q);
                  if(!$r){
                    die('error: ' . mysqli_error($link));
                  }
                  while(list($sharedusers) = mysqli_fetch_array($r)){
                  ?>
                  <option value="<?php echo $sharedusers ?>"><?php echo $sharedusers ?></option>
                <?php } ?>
                </select>
                <button type="submit" style="background-color: <?php echo $buttoncolor; ?>" class="btn btn-mylife mt-4">Stop Viewing</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card mb-5" style="border-width: 4px; height: 420px; border-color: <?php echo $color; ?>">
            <div class="card-header">
                <h2>Edit Activities</h2>
              </div>
            <div class="card-body" style="overflow-y: auto;">
              <?php if(@$_GET['InvalidPurpose']){ ?>
              <div class="alert-light text-danger text-center"><?php echo $_GET['InvalidPurpose']; ?></div>
              <?php } ?>
              <?php if(@$_GET['SuccessPurpose']){ ?>
                <div class="alert-light text-center text-success"><?php echo $_GET['SuccessPurpose']; ?></div>
              <?php } ?>
              
              <form action="../php/createpurpose.php" method="post">
                <input type="text" placeholder="Activity Name" name="purposename" class="mb-4 form-control">
                <button class="btn btn-mylife mb-4" style="background-color: <?php echo $buttoncolor; ?>" name="createpurpose">Create Activity</button>
              </form>
              <form action="../php/deletepurpose.php" method="post">
                <label>Select Activity to Delete</label>
                <select name="deletepurpose" class="form-control mb-4">
                  <option value="none">Select Activity</option>
                  <?php //Retrieve Purposes
                        $query = "SELECT purpose FROM purposes WHERE user = '$username'";
                        $result = mysqli_query($link, $query);
                        if(!$result){
                          die('error: ' . mysqli_error($link));
                        }
                        //Loop through purposes
                        while(list($allpurposes) = mysqli_fetch_array($result)){
                          ?>
                          <option value="<?php echo $allpurposes; ?>"><?php echo $allpurposes;?></option>
                        <?php } ?>
                </select>
                <button class="btn btn-mylife" style="background-color: <?php echo $buttoncolor; ?>" type="submit">Delete Activity</button>
              </form>
            </div>
          </div> 
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