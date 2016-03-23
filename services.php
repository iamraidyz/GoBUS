<?php
//This file contains information about GoBUS services
include 'head.php';?>

	<body> 
		<?php session_start(); include 'top.php';?>


		<main>
		<h1>Our bus services</h1>

		<?php
		
		$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232");
		
		$sql = "SELECT * FROM services";

		$result= $db->query( $sql );

		echo '<p><span id="service"><b>Code</b></span> <span id="from"> <b>FROM</b></span>
		<span id="to"> <b>TO</b></span></p>';
		
		//Get service details from DB and print them out
		while ( $row = $result->fetch_assoc() ) {
			$sqlStops = "SELECT * FROM destinations WHERE stop_code='{$row['start_point']}' ";
			$resultStops= $db->query( $sqlStops )->fetch_assoc();

			$sqlStopFinal = "SELECT * FROM destinations WHERE stop_code='{$row['end_point']}' ";
			$resultStopsFin= $db->query( $sqlStopFinal )->fetch_assoc();

		echo '<p><span id="service">'.$row['code'].'</span> <span id="from">'.$resultStops['city'].', '.$resultStops['stop'].'
		</span> <span id="to">'.$resultStopsFin['city'].', '.$resultStopsFin['stop'].'</span></p>';
		}
		$db->close();
		?>
		</main>
	</body>
	<?php include 'footer.php';?>
