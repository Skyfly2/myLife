<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	if(isset($_POST['newcolor'])){
		//Change Color!
		$_SESSION['color'] = $_POST['newcolor'];
		$color = $_POST['newcolor'];
		$query = "UPDATE user_colors SET maincolor = '$color' WHERE user = '$username'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}
		header("location:../pages/settings.php");
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>