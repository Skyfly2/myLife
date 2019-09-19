<?php
	session_start();
	require('config.php');
	if(isset($_POST['Login']))
	{
		//Make user fills out all fields
		if(empty($_POST['UName']) || empty($_POST['Password']))
		{
			header("location:../index.php?Invalid= Please Fill in the Required Fields");
		}

		//Assuming they use all fields, log them in
		else
		{
			$username = $_POST['UName'];
			
			$query = "SELECT UName FROM users WHERE UName='$username'";
			$result = mysqli_query($link,$query);

			if(!$result){
				die('Error1: ' . mysqli_error($link));
			}
			$num = mysqli_num_rows($result);

			//Verify that there is only one username
			if($num==1){
				$query2 = "SELECT firstname, lastname, UName, Password, email FROM users WHERE UName = '$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error2: ' . mysqli_error($link));
				}
				list($first, $last, $userval, $passval, $email) = mysqli_fetch_array($result2);
				$password = $_POST['Password'];
				if(password_verify($password, $passval)){
					$_SESSION['username'] = $userval;
					$_SESSION['firstname'] = $first;
					$_SESSION['lastname'] = $last;
					$_SESSION['email'] = $email;
					header("location:../pages/dashboard.php");
				}
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