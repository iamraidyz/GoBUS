<?php 
//This file contains main page with "Find a trip" forms.
include 'head.php'; include 'functions.php';session_start();
	
	?>
	
	<body>	
		<form method="POST" action=''>

		<?php include 'top.php';?>
		

		<?php
				if (isset($_POST['button_continue']))//check trip values. Continue if valid, report if not. 
			{	
				$_SESSION['date_out']=$_POST['date'];
				if(isset($_POST['dis'])){$_SESSION['disabled']='Y';}else{$_SESSION['disabled']='N';}
				if(!isset($_SESSION['city_from'])) {echo'<font color=red>Please select start city of your journey.<br></font>';}
				elseif(!isset($_SESSION['stop_from'])) {echo'<font color=red>Please select start stop of your journey.<br></font>';}
				elseif(!isset($_SESSION['city_to'])) {echo'<font color=red>Please select end city of your journey.<br></font>';}
				elseif(!isset($_SESSION['stop_to'])) {echo'<font color=red>Please select end stop of your journey.<br></font>'; }
				elseif(!serviceFree($_SESSION['service_no'])){}
				elseif(dateCheck($_SESSION['date_out'])) { header( "location: login.php" ); }
			}	
				//reset trip values and start again
				elseif (isset($_POST['button_reset'])){ session_unset(); header('location:index.php');}
			?>

		<main>
			<?php if($_SESSION['user_created']==1){echo '<h2> User successfuly registered!</h2>';$_SESSION['user_created']=0;}?>
			<h1>Find your trip:</h1>
			<div id="trip">
		<?php 
		
		$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232" );
		
		//if DB is down, show error page.
		if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}
		//include station forms and info text only when needed
		if(!isset($_SESSION['stop_from']))include 'from.php';
		if(isset($_SESSION['stop_from']))echo '<h2>Your trip starts at <font color="red"><b>'.$_SESSION['city_from'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_from'].'</b></font> station.</h2>';
		if(!isset($_SESSION['stop_to'])&&isset($_SESSION['stop_from'])) include 'to.php';
		if(isset($_SESSION['stop_to'])){
		echo '<h2>Your trip ends at <font color="red"><b>'.$_SESSION['city_to'].'</b></font>,<font color="green"><b> '.$_SESSION['stop_to'].'</b></font> station.</h2>';
		echo'<h2>Number of your service is:<font color="green"> '.$_SESSION['service_no'].'</font></h2>
		<h2><font color=red>Please select date of your journey.</font></h2>';}

		$db->close();

		?>
		<div id="down">

			<p>Select date <input type="date" value="<?php echo date('o').'-'.date('m').'-'.date('d');?>" name="date"><br/></p>
	
			<p>Need assistance (Disabled person) <input type="checkbox" name="dis"/></p>
			</div>
			<input type="submit" value="Continue" name="button_continue">
			<input type="submit" value="Reset" name="button_reset">
			
			</div>
		</main>
	</form>
	</body>
		<?php include 'footer.php';?>
