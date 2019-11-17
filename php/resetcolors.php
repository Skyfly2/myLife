<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];

	//Reset Colors
	$query = "UPDATE user_colors SET maincolor = '#3c6948', buttoncolor = '#6ec24f', taskcolor = '#3c6948' WHERE user = '$username'";
	$result = mysqli_query($link, $query);
	if(!$result){
		die('error: ' . mysqli_error($link));
	}

	//Set session colors to take effect
	$_SESSION['color'] = '#3c6948';
	$_SESSION['buttoncolor'] =  '#6ec24f';
	$_SESSION['taskcolor'] = '#3c6948';

	header("location:../pages/settings.php");

	

	
?>