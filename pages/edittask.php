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
    <title>myLife - Edit Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Source+Sans+Pro&display=swap" rel="stylesheet">
    


</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="height: 85px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenav" aria-controls="responsivenav" aria-expanded="false" aria-label="Toggle navigation" onclick="document.getElementById('content').style.paddingTop = getElementById('content').style.paddingTop === '300px' ? '5%' : '300px'">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="responsivenav">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mb-auto">
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px; font-family: 'Manjari', sans-serif;" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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

  <?php
  if(null !== 'edittask'){ 
    $task = $_POST['taskedit'];
    $query = "SELECT taskname, description, hour, month, day, purpose, public FROM tasks WHERE taskname='$task'";
    $result = mysqli_query($link, $query);
    list($taskname, $description, $hour, $month, $day, $purpose, $public) = mysqli_fetch_array($result);?>
    <div class="container px-5" id="content" style="background-color: white; padding-top: 5%; padding-bottom: 5%;">
      <div class="card border-success" style="border-width: 4px;">  
        <div class="card-header">     
          <h2>Edit <?php echo $taskname; ?></h2>
        </div>
        <div class="card-body">
          <form action="../php/updatetask.php" method="post">
            <label for="taskname">Edit Taskname</label>
            <input id="taskname" type="text" name="newtaskname" value="<?php echo $taskname; ?>" class="mb-4 form-control">
            <label for="desc">Edit Description</label>
            <input id="desc" type="text" name="newdesc" value="<?php echo $description; ?>" class="mb-4 form-control">
            <label for="month">Edit Month Due</label>
            <select id="month" name="newmonth" class="form-control mb-4">
              <option value="<?php echo $month; ?>"><?php if($month == 1){
                                                            echo 'January';
                                                          } 
                                                          elseif($month == 2){
                                                            echo 'February';
                                                          } 
                                                          elseif($month == 3){
                                                            echo 'March';
                                                          } 
                                                          elseif($month == 4){
                                                            echo 'April';
                                                          } 
                                                          elseif($month == 5){
                                                            echo 'May';
                                                          } 
                                                          elseif($month == 6){
                                                            echo 'June';
                                                          } 
                                                          elseif($month == 7){
                                                            echo 'July';
                                                          } 
                                                          elseif($month == 8){
                                                            echo 'August';
                                                          } 
                                                          elseif($month == 9){
                                                            echo 'September';
                                                          } 
                                                          elseif($month == 10){
                                                            echo 'October';
                                                          } 
                                                          elseif($month == 11){
                                                            echo 'November';
                                                          } 
                                                          elseif($month == 12){
                                                            echo 'December';
                                                          } 
                                                          else{
                                                            echo 'Month';
                                                          }
                                                          ?>
                                                            
              </option>
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
            <label for="day">Edit Day Due</label>
            <select id="day" name="newday" class="form-control mb-4">
              <option value="<?php echo $day; ?>"><?php echo $day ?></option>
                <?php $counter=1;
                  while($counter <= 31){
                    if($counter !== $day){
                ?> <option value=<?php echo $counter?>><?php echo $counter;?></option>
                <?php
                  $counter++;
                    }}
                ?>
            </select>
            <label for="hour">Edit Hour Due</label>
            <select id="hour" name="newtime" class="form-control mb-4">
              <option value="<?php echo $hour ?>"><?php if((int)$hour !== 0){
                                                          echo $hour;
                                                        }
                                                        else{
                                                          echo 'Hour Due';
                                                        }
                                                        ?>
                </option>
                <?php $counter=1;
                  while($counter <= 12){
                  ?> <option value=<?php echo $counter?>><?php echo $counter?></option>
                  <?php
                  $counter++;
                      }
                  ?>
            </select>
            <label for="purpose">Edit Activity Tag</label>
            <select id="purpose" name="newpurpose" class="mb-4 form-control">
              <option value="<?php echo $purpose; ?>"><?php echo $purpose; ?></option>
                <?php $query="SELECT purpose FROM purposes WHERE user='$username'";
                              $result=mysqli_query($link, $query);
                              if(!$result){
                                die('error: ' . mysqli_error($link));
                              }
                              $numpurposes=mysqli_num_rows($result);
                              if($numpurposes > 0){
                                while(list($purposes)=mysqli_fetch_array($result)){
                                  if($purposes !== $purpose){
                               ?>

                               <option value="<?php echo $purposes;?>"><?php echo $purposes;?></option>
                             <?php }}
                           }?>
            </select>
            <label for="public">Make Public?</label>
            <select id="public" name="newpublic" class="mb-4 form-control"> 
              <option value="<?php echo $public ?>"><?php echo $public; ?></option>
              <option value="no">No</option>
              <option value="yes">Yes</option>
            </select>
              <button type="submit" value="<?php echo $taskname; ?>" class="btn btn-success" name="updatetask">Update Task</button>
        </form>
      </div>
    </div>
  </div>

<?php }
  else{
    header("location:../pages/agenda.php");
  }
       ?>                     
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