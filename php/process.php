<?php
	session_start();
	require_once('config.php');
	if(isset($_POST['Login']))
	{
		if(empty($_POST['UName']) || empty($_POST['Password']))
		{
			header("location:../index.php?Invalid= Please Fill in the Required Fields");
		}
		else
		{
			$username = $_POST['UName'];
			$password = $_POST['Password'];
			$query = "SELECT FROM users WHERE UName='$username' AND Password='$password'";
			$result = mysqli_query($link,$query);
			if(mysqli_fetch_assoc($result)){
				$_SESSION['username'] = $_POST['UName'];
				header("location:../pages/dashboard.php");
			}
			else{
				header("location:../index.php?Invalid= Please Enter Correct Username or Password");
			}
		}
		

	}
	else
	{
		echo 'Not working now';
	}
	
?>