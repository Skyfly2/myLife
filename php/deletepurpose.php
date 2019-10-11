<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Delete purpose
	if(isset($_POST['deletepurpose'])){
		if($_POST['deletepurpose'] == 'none'){
			header("location:../pages/agenda.php?InvalidPurpose= You must select an Activity to delete it");
		}
		else{
			$purposename=$_POST['deletepurpose'];
			$query = "DELETE FROM purposes WHERE purpose = '$purposename' AND user = '$username'";
			$result=mysqli_query($link, $query);
			if(!$result){
				die('error:' . mysqli_error($link));
			}

			header("location:../pages/agenda.php?SuccessPurpose= $purposename successfully deleted!");
		}
		


	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>