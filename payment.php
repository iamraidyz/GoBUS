<?php 
//This page contains payment form with input validation
include 'head.php'; include 'functions.php';
	session_start();

?>
	
	<body>
		<form action="<?php echo https_php_self(); ?>" method="post">
		<?php include 'top.php';?>

		<main>
			<?php 
			
			//When payment details are submitted, check them and if valid continue to confirmation, otherwise report errors
			if (isset($_POST['submit_payment'])) 
			{ 
				if(checkCard($_POST['card_number'])&&dateCheck($_POST['exp_date'])&&checkName($_POST['fname'])&&checkName($_POST['lname'])){
			$_SESSION['booking_reference']=createBooking($_SESSION['service_no'],$_SESSION['disabled'],$_SESSION['username'],$_POST['fname'],$_POST['lname']);
			header( "location: confirmation.php" );

			}
			}  

			?>
			<p>Welcome,<b> <?php echo $_SESSION['username'];?></b><br>You have uccessfully logged in, you can now complete your booking!</p>
			<h1>Please enter your payment details below</h1>
			Card number: <input class="textbox" type="text" name="card_number"><br/>
			Card expiration year and month: <input type="month" name="exp_date"><br/>
			First name: <input class="textbox" type="text" name="fname"><br/>
			Last name: <input class="textbox" type="text" name="lname"><br/>
			<br><h2>Amount to be payed: <?php echo getPrice($_SESSION['service_no']);?></h2>
	
			<input type="submit" value="Make payment" name="submit_payment"><br>
			</form><br>	
		</main>
	</body>
<?php include 'footer.php';?>
