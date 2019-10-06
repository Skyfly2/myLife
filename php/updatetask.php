<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];

	if(null !== 'updatetask'){
		$oldtaskname = $_POST['updatetask'];
		$taskname = $_POST['newtaskname'];
		$description = $_POST['newdesc'];
		$public = $_POST['newpublic'];
		$day = $_POST['newday'];
		$month = $_POST['newmonth'];
		$purpose = $_POST['newpurpose'];
		$hour = $_POST['newtime'];

		if(!empty($taskname)){
			$query1 = "UPDATE tasks SET taskname='$taskname' WHERE user='$username' AND taskname='$oldtaskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($description)){
			$query1 = "UPDATE tasks SET description='$description' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($public)){
			$query1 = "UPDATE tasks SET public='$public' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($purpose)){
			$query1 = "UPDATE tasks SET purpose='$purpose' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($month)){
			$query1 = "UPDATE tasks SET month='$month' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($day)){
			$query1 = "UPDATE tasks SET day='$day' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}
		if(!empty($hour)){
			$query1 = "UPDATE tasks SET hour='$hour' WHERE user='$username' AND taskname='$taskname'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}
		}

		header("location:../pages/agenda.php");
	}

	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>