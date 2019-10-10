<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Remove User from accessing other user's schedule
	if($_POST['stopviewinguser'] !== 'none'){
		$otheruser = $_POST['stopviewinguser'];
		$query = "DELETE FROM shared_tasks WHERE user = '$otheruser' AND shareduser = '$username'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}

		header("location:../pages/agenda.php?SuccessTask= You have successfully removed yourself from viewing the schedule of $otheruser");
	}
	elseif($_POST['stopviewinguser'] == 'none'){
		header("location:../pages/agenda.php?InvalidTask= You must select a user to no longer view their schedule");
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>