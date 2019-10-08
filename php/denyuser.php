<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Action when user denies a shared schedule request
	if(null !== $_POST['userdeny']){
		$shareduser = $_POST['userdeny'];
		//Remove users from hold
		$query = "DELETE FROM shared_task_hold WHERE mainuser = '$shareduser' AND holduser = '$username'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}

		header("location:../pages/agenda.php");
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>