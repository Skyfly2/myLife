<?php
    session_start();
    require("../php/config.php");

    if(isset($_SESSION['username'])){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>myLife - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/styles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Source+Sans+Pro&display=swap" rel="stylesheet">
    


</head>
<body style="background-color: #CCC;">
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="height: 85px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mt-auto" style="font-family: 'Manjari', sans-serif; font-size: 42px; color: white;" href="dashboard.php">myLife</a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" style="font-size: 25px;" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="font-size: 25px;" href="agenda.php">Agenda</a>
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

<div class="content" style="background-color: white; margin-left: 15%; margin-right: 15%; padding-top: 5%;">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="ml-5">Hello, <?php echo $_SESSION['firstname']; ?></h1>
        </div>
        <div class="col-sm-12">
        <h3 class="ml-5">Today is <?php $query = "SELECT NOW()"; $result=mysqli_query($link, $query); if(!$result){die('Error: ' . mysqli_error($link));} list($sdate) = mysqli_fetch_array($result); $date=substr($sdate, 5, 6); $year=substr($sdate, 0, 4); echo $date; echo '-'; echo $year;?></h3>
    </div>
    </div>

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