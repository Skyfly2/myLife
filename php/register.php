<?php
	session_start();
	require_once('config.php');
	if(isset($_POST['Register']))
	{
		//Catch if user doesn't fill out all data fields
		if(empty($_POST['UName']) || empty($_POST['Password']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['ConfirmPassword']))
		{
			header("location:../pages/registration.php?Invalid= Please Fill in the Required Fields");
		}

		//Assuming all fields are filled out
		else
		{
			//Confirm passwords match
			$password = $_POST['Password'];
			$confirmpass = $_POST['ConfirmPassword'];
			
			if($password!=$confirmpass){
				header("location:../pages/registration.php?Invalid= Passwords did not match");
			}
			else{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$username = $_POST['UName'];
			
			$password = password_hash($password, PASSWORD_DEFAULT);

			$query = "INSERT INTO users (firstname, lastname, UName, Password, email) VALUES ('$firstname', '$lastname', '$username', '$password', '$email')";
			$result = mysqli_query($link, $query);
				if (!$result){
        			die('Error: ' . mysqli_error($link));
      			}
      			//Successfully Registered
      			else{
      				header("location:../index.php");
      			}
			}
		}
	}
	else
	{
		echo 'Not working now';
	}
	
?>