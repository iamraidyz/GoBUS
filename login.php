<?php
//This file contains login page, when booking is in progress also contains trip details
 include 'head.php'; include 'functions.php';
	session_start();
?>
	
	<body>
		
		<?php include 'top.php';
		if (isset($_POST['submit_continue'])) 
			{	//continue to payment
				header( "location: payment.php" ); 	
			}  	
		?>

		<main>
			<?php 

			function getAction(){
			echo '<?php echo https_php_self(); ?>';
			}

			//if booking is in progress, show details
			if(isset($_SESSION['stop_from'])){
			if($_SESSION['user_created']==1){echo '<h2> User successfuly registered!</h2>';$_SESSION['user_created']=0;}
			echo '<h2>Your trip starts at <font color="red"><b>'.$_SESSION['city_from'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_from'].'</b></font> station.</h4>
			<h4>Your trip ENDS at <font color="red"><b>'.$_SESSION['city_to'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_to'].'</b></font> station.<br>Date of your journey is:
			<font color="red"> '.$_SESSION['date_out'].'</font><br>Service number:<font color="green"> '.$_SESSION['service_no'].'</font></h4>
			<h2>Price: '.$_SESSION['price'].' GPB
			';}
			
			//if user is alread logged in, view booking details and continue (no login/register options)
			if(!isset($_SESSION['username'])){
			include 'login_form.php';}
			else{

			echo'<p>Continue to payment
			<form method="POST" action="'.getAction().'">
			<input type="submit" value="Continue" name="submit_continue"></p>';}?>

			</form>
		</main>
	</body>
		<?php include 'footer.php';?>
