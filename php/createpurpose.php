<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Create Purpose
	if(isset($_POST['createpurpose'])){
		if(empty($_POST['purposename'])){
			header("location:../pages/agenda.php?InvalidPurpose= You must enter a valid name");
		}
		else{
			$purposename=$_POST['purposename'];
			$query = "INSERT INTO purposes (user, purpose) VALUES ('$username', '$purposename')";
			$result=mysqli_query($link, $query);
			if(!$result){
				die('error:' . mysqli_error($link));
			}

			header("location:../pages/agenda.php?SuccessPurpose= Purpose successfully created!");
		}
		


	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>