<?php
//This file contains user registration form
include 'head.php'; include 'functions.php'; include 'testPass.php';
	session_start();
?>
	
	<body>
		<form action="<?php echo https_php_self(); ?>" method="post">
		<?php include 'top.php';?>


		<main>
			<?php 
			
			//when form is submitted inputs are validated and if correct, user is created, otherwise errors are printed out
			if (isset($_POST['submit_registration'])) 
			{

				if(checkUsername($_POST['username'])&&testPass($_POST['pass'])&&checkEmail($_POST['email'])){
				if($_POST['pass']!=$_POST['pass_verif']) echo '<br><b><font color=red>Passwords do not match!</font></b>';
				else{
				//html injection prevention
				createUser(htmlentities($_POST['username']),htmlentities($_POST['fname']),htmlentities($_POST['lname']),htmlentities($_POST['pass'],$_POST['email']));
				$_SESSION['user_created']=1;
				if(isset($_SESSION['service_no'])){
				header( "location: login.php" );}
				else{header("location: index.php");}
				}}
			}  		


			?>
			<!--Registration form wit text boxes, calendar and submit button-->
			<h1>Please register below</h1>
			Username: <input class="textbox" type="text" name="username"><br/>
			First name: <input class="textbox" type="text" name="fname"><br/>
			Last name: <input class="textbox" type="text" name="lname"><br/>
			Password: <input class="textbox" type="password" name="pass"><br/>
			<b>Verify your password,please:</b> <input type="password" class="textbox" name="pass_verif"><br/>
			Email address:  <input  type="email" class="textbox" name="email"><br/>
			<br/>
			<input type="submit" value="Register" name="submit_registration"><br>
			
			</form>
		</main>
	</body>
			<?php include 'footer.php';?>
