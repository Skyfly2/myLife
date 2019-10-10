<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Remove some other user from accessing current User's schedule
	if($_POST['removefromaccess'] !== 'none'){
		$removeduser = $_POST['removefromaccess'];
		$query = "DELETE FROM shared_tasks WHERE user = '$username' AND shareduser = '$removeduser'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}

		header("location:../pages/agenda.php?SuccessTask= You have successfully removed $removeduser from viewing your schedule");
	}
	elseif($_POST['removefromaccess'] == 'none'){
		header("location:../pages/agenda.php?InvalidTask= You must select a user to remove");
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>