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

	if(null !== 'updatetask'){
		$taskname = $_POST['newtask'];
		$description = $_POST['newdesc'];
		$public = $_POST['newpublic'];
		$date = $_POST['newdate'];
		$purpose = $_POST['newpurpose'];

		if(!empty($taskname)){
			$query1 = "UPDATE tasks SET taskname='$taskname' WHERE user='$username' AND taskname='$oldtaskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
	}

	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>