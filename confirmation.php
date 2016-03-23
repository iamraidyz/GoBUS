<?php include 'head.php'; include 'functions.php'; session_start();
//include common phps and start a session
	

?>
	
	<body>
		<!--Booking summary with logout button-->
		<form action="<?php echo $_SERVER[’PHP_SELF’];?>" method="post">
		<?php include 'top.php';?>

		<main>

			<h1>Payment was successful, Thank you!<br>Details of your booking are below</h1>

			<?php 
			$db = new mysqli( "emps-sql.ex.ac.uk"
			, "pv232"
			, "pv232"
			, "pv232" );
		
			if ( $db->connect_error ) {
				header( "location: system_down.php" ); 
			}
			
			$db->close();
			
			//print out booking info
			echo '
			<h4>Your trip starts at <font color="red"><b>'.$_SESSION['city_from'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_from'].'</b></font> station.</h4>
			<h4>Your trip ENDS at <font color="red"><b>'.$_SESSION['city_to'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_to'].'</b></font> station.</h4>
			<h4>Date of your journey is:<font color="red"> '.$_SESSION['date_out'].'</font>
			<br>Service number:<font color="green"> '.$_SESSION['service_no'].'</font></h4>
			<h2>Booking reference: '.$_SESSION['booking_reference'].'</h2>
			';
			
			?>


			<input type="submit" value="Logout" name="logout"><br>
			</form><br>			
			
		</main>

	</body>
			<?php

			if (isset($_POST['logout'])) 
			{
				//go to logout page
				header( "location: logout.php"); 	
			}  		

			include 'footer.php';?>

