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
				//Set username everywhere
				$query2 = "UPDATE users SET UName='$newusername' WHERE UName='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE messages SET user='$newusername' WHERE user='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE messages SET fromuser='$newusername' WHERE fromuser='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE purposes SET user='$newusername' WHERE user='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE shared_tasks SET user='$newusername' WHERE user='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE shared_tasks SET shareduser='$newusername' WHERE shareduser='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE shared_task_hold SET mainuser='$newusername' WHERE mainuser='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE shared_task_hold SET holduser='$newusername' WHERE holduser='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE shared_task_hold SET requestuser='$newusername' WHERE requestuser='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE tasks SET user='$newusername' WHERE user='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$query2 = "UPDATE user_colors SET user='$newusername' WHERE user='$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('Error: ' . mysqli_error($link));
				}
				$_SESSION['username'] = $newusername;
				header("location:../pages/settings.php?SuccessUser= Username successfully updated!");
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

	//Delete User
	elseif(null !== 'deleteaccount'){
		$q = "SELECT Password FROM users WHERE UName = '$username'";
		$r = mysqli_query($link, $q);
		if(!$r){
			die('error: ' . mysqli_error($link));
		}
		$pass = $_POST['deleteuser'];
		list($passhash) = mysqli_fetch_array($r);
		if($_POST['confirmation'] != 'YesDelete' || !(password_verify($pass, $passhash))){
			echo '$pass';
			header("location:../pages/settings.php?InvalidDelete= You must fill out all confirmation fields properly");
		}
		else{
			//Delete Everything
			$query = "DELETE FROM users WHERE UName = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM messages WHERE user = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM messages WHERE fromuser = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM purposes WHERE user = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM shared_tasks WHERE user = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM shared_tasks WHERE shareduser = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM shared_task_hold WHERE mainuser = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM shared_task_hold WHERE requestuser = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM tasks WHERE user = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			$query = "DELETE FROM user_colors WHERE user = '$username'";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('Error: ' . mysqli_error($link));
			}
			session_destroy();
			header("location:../index.php?Success= You have successfully deleted your account. We are sorry to see you go.");
		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>