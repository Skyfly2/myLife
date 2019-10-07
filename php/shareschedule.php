<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Create Purpose
	if(isset($_POST['shareduser'])){
		if(empty($_POST['shareduser'])){
			header("location:../pages/agenda.php?InvalidTask= Your must enter a user");
		}
		else{
			$shareduser = $_POST['shareduser'];

			$query = "INSERT INTO shared_task_hold (mainuser, holduser) VALUES ('$username', '$shareduser')";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('error:'  .mysqli_error($link));
			}
			header("location:../pages/agenda.php?SuccessTask= Your share request has been sent!");

		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>