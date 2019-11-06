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
			$username = $_POST['UName'];
			$password = $_POST['Password'];
			$confirmpass = $_POST['ConfirmPassword'];

			//Confirm Username does not already exist
			$q = "SELECT UName FROM users WHERE UName = '$username'";
			$result1 = mysqli_query($link, $q);
			if(!$result1){
				die('Error: ' . mysqli_error($link));
			}
			$numusers = mysqli_num_rows($result1);

			if($numusers != 0){
				header("location:../pages/registration.php?Invalid= Username already taken");
			}
			//Confirm passwords match
			elseif($password!=$confirmpass){
				header("location:../pages/registration.php?Invalid= Passwords did not match");
			}
			else{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			
			
			$password = password_hash($password, PASSWORD_DEFAULT);

			$query = "INSERT INTO users (firstname, lastname, UName, Password, email) VALUES ('$firstname', '$lastname', '$username', '$password', '$email')";
			$result = mysqli_query($link, $query);
				if (!$result){
        			die('Error: ' . mysqli_error($link));
      			}
      			$query = "INSERT INTO user_colors (user, maincolor, buttoncolor, taskcolor) VALUES ('$username', '#3c6948', '#6ec24f', '#3c6948') ";
      			$result = mysqli_query($link, $query);
      			if(!$result){
      				die('error: ' . mysqli_error($link));
      			}
      			//Successfully Registered
      			else{
      				header("location:../pages/loginpage.php?Success= You have successfully registered!");
      			}
			}
		}
	}
	else
	{
		echo 'Not working now';
	}
	
?>