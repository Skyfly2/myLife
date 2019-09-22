<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Update email
	if(isset($_POST['updateemail'])){
		if(empty($_POST['newemail'])){
			header("location:../pages/settings.php?InvalidEmail= Please enter a valid email address.");
		}
		else{
			$newemail = $_POST['newemail'];
			$query = "UPDATE users SET email='$newemail' WHERE UName='$username'";
			$result = mysqli_query($link, $query);

			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			else{
				$_SESSION['email'] = $newemail;
				header("location:../pages/settings.php?SuccessEmail= Email successfully updated!");
			}
		}
	}

	//Update Username
	elseif(isset($_POST['updateusername'])){
		if(empty($_POST['newusername'])){
			header("location:../pages/settings.php?InvalidUser= Please enter a valid username.");
		}
		else{
			$newusername = $_POST['newusername'];
			$query1 = "SELECT UName FROM users WHERE UName='$newusername'";
			$result1 = mysqli_query($link, $query1);
			$numnames = mysqli_num_rows($result1);

			if($numnames == 0){
				$query2 = "UPDATE users SET UName='$newusername' WHERE UName='$username'";
				$result2 = mysqli_query($link, $query2);

				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				else{
					$_SESSION['username'] = $newusername;
					header("location:../pages/settings.php?SuccessUser= Username successfully updated!");
				}
			}
			else{
				header("location:../pages/settings.php?InvalidUser= Username already taken.");
			}
		}
	}

	//Update Name
	elseif(isset($_POST['updatename'])){
		if(empty($_POST['newfirst'] || empty($_POST['newlast']))){
			header("location:../pages/setting.php?InvalidName= Please fill out a firstname and a lastname");
		}
		else{
			$newfirst = $_POST['newfirst'];
			$newlast = $_POST['newlast'];
			$query = "UPDATE users SET firstname='$newfirst' WHERE UName='$username'";
			$result = mysqli_query($link, $query);

			if(!$result){
				die('Error: ' . mysqli_error($link));
			}

			$query2 = "UPDATE users SET lastname='$newlast' WHERE UName='$username'";
			$result2 = mysqli_query($link, $query2);
			if(!$result2){
				die('Error: ' . mysqli_error($link));
			}

			else{
				$_SESSION['firstname'] = $newfirst;
				$_SESSION['lastname'] = $newlast;
				header("location:../pages/settings.php?SuccessName= Name successfully changed!");
			}
		}
	}

	//Change Password
	elseif(isset($_POST['changepassword'])){
		if(empty($_POST['newpass']) || empty($_POST['confirmnewpass'])){
			header("location:../pages/settings.php?InvalidPass= You must fill out both fields.");
		}
		elseif($_POST['newpass'] != $_POST['confirmnewpass']){
			header("location:../pages/settings.php?InvalidPass= The passwords do not match.");
		}
		else{
			$newpass = $_POST['newpass'];
			$newpass = password_hash($newpass, PASSWORD_DEFAULT);

			$query = "UPDATE users SET password='$newpass' WHERE UName='$username'";
			$result = mysqli_query($link, $query);

			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			else{
				header("location:../pages/settings.php?SuccessPass= Password successfully changed!");
			}
		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>