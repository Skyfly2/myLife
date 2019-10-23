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

			//Verify there is only one user
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
					$user = $_SESSION['username'];
					$_SESSION['firstname'] = $first;
					$_SESSION['lastname'] = $last;
					$_SESSION['email'] = $email;
					$query3 = "SELECT maincolor, buttoncolor, taskcolor FROM user_colors WHERE user = '$user'";
					$result3 = mysqli_query($link, $query3);
					if(!$result3){
						die('error: ' . mysqli_error($link));
					}
					//Set color palat
					list($color, $buttoncolor, $taskcolor) = mysqli_fetch_array($result3);
					$_SESSION['color'] = $color;
					$_SESSION['buttoncolor'] = $buttoncolor;
					$_SESSION['taskcolor'] = $taskcolor;
					header("location:../pages/dashboard.php");
				}
				else{
					header("location:../index.php?Invalid= Please Enter Correct Username or Password");
				}
			}
			else{
				header("location:../index.php?Invalid= Please Enter Correct Username or Password");
			}
		}
	}
	else
	{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}
	
?>