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
    <title>myLife - Agenda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Source+Sans+Pro&display=swap" rel="stylesheet">
    


</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="height: 85px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenav" aria-controls="responsivenav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="responsivenav">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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

<div class="container px-5" id="content" style="background-color: white; padding-top: 5%;">
    <div class="row">
      <div class="col-sm-12">
        <h1>Agenda</h1>
      </div>
        <div class="col-sm-12">
          <div class="card border-success mb-5" style="border-width: 4px;">
            <div class="card-header">
                <h2>Personal Tasks</h2>
              </div>
            <div class="card-body" style="border-bottom: 1px solid grey;">
              <?php $query="SELECT task FROM tasks WHERE user='$username'";
                    $result = mysqli_query($link, $query);
                    if(!$result){
                      die('error: ' . mysqli_error($link));
                    }
                    $numtasks=mysqli_num_rows($result);
                    if($numtasks > 0){
                      $tasks = mysqli_fetch_array($result);
                      for($count=0; $count<$numtasks; $count++){
                      ?>
                      <div class="card border-primary mb-5">
                        <div class="card-body">
                          <h5><?php echo $tasks[$count] ?></h5>
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
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addtask">Create Task</button>
            </div>

            <div id="addtask" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5>Create a new task</h5>
                  </div>
                  <div class="modal-body">
                    <form action="../php/createtask.php" method="post">
                      <input type="text" name="description" placeholder="Task Description" class="mb-4 form-control">
                      <input type="text" name="date" placeholder="Date Due" class="mb-4 form-control">
                      <select name="purpose" class="mb-4 form-control">
                        <option>Select Purpose</option>
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
                      <button class="btn btn-success" name="createtask">Create Task</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-sm-6">
          <div class="card border-success mb-5" style="border-width: 4px;">
            <div class="card-header">
                <h2>Create New Purpose</h2>
              </div>
            <div class="card-body">
              <?php if(@$_GET['InvalidPurpose']){ ?>
              <div class="alert-light text-danger text-center"><?php echo $_GET['InvalidPurpose']; ?></div>
              <?php } ?>
              <?php if(@$_GET['SuccessPurpose']){ ?>
                <div class="alert-light text-center text-success"><?php echo $_GET['SuccessPurpose']; ?></div>
              <?php } ?>
              <form action="../php/createpurpose.php" method="post">
                <input type="text" placeholder="Purpose Name" name="purposename" class="mb-4 form-control">
                <button class="btn btn-success" name="createpurpose">Create Purpose</button>
              </form>
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