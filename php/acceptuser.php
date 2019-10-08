<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Action when user accepts a shared schedule request
	if(null !== $_POST['useraccept']){
		$shareduser = $_POST['useraccept'];
		//Remove users from hold
		$query = "DELETE FROM shared_task_hold WHERE mainuser = '$shareduser' AND holduser = '$username'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}
		//Insert data into proper table
		$query2 = "INSERT INTO shared_tasks (user, shareduser) VALUES ('$shareduser', '$username')";
		$result2 = mysqli_query($link, $query2);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}

		header("location:../pages/agenda.php");
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>