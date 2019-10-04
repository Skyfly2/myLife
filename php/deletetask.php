<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Delete taskname
	if(null !== 'taskname'){
		$taskname = $_POST['taskname'];
		$query = "DELETE FROM tasks WHERE taskname='$taskname' AND user='$username'";
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