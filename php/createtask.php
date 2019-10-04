<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Create Purpose
	if(null !== 'createtask'){
		if(empty($_POST['taskname'])){
			header("location:../pages/agenda.php?InvalidTask= Your task must have a name");
		}
		else{
			$taskname = $_POST['taskname'];
			$description = $_POST['description'];
			$purpose = $_POST['purpose'];
			$hour = $_POST['time'];
			$public = $_POST['publicize'];
			$day = $_POST['day'];
			$month = $_POST['month'];

			$query = "INSERT INTO tasks (user, purpose, public, taskname, description, hour, day, month) VALUES ('$username', '$purpose', '$public', '$taskname', '$description', '$hour', '$day', '$month')";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('error:'  .mysqli_error($link));
			}
			header("location:../pages/agenda.php?SuccessTask= Your task has been successfully created!");

		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>