<p></h2><font color="grey">To complete your booking, please login or register below.<br>Thank you, for cooperation!</font></p>
<h2>Login</h2>
			<form method="POST" action="<?php echo https_php_self(); ?>">
			Username: <input type="text" class="textbox" name="username">
			<br/>
			Password: <input type="password" class="textbox" name="password">
			<br/>
			<input type="submit" value="Login" name="submit_login"><br><input type="submit" value="Register" name="submit_register"><br>
			<?php
			if (isset($_POST['submit_login'])) 
			{
				$username = htmlentities($_POST[ 'username' ]);
				$password = htmlentities($_POST[ 'password' ]);
				if(verifyLogin($password,$username)){login($username); header("location: payment.php");
			}else
			{echo '<b><font color="red">Wrong username or password.</b></font>';}
			}

			if (isset($_POST['submit_register'])) 
			{ 
				header( "location: registration.php" ); 	
			}  		

			?>
