<?php
//This file contains "TO" forms used to select final destination of a trip
		
		//if final destination is selected, save it to session
		//find and echo service operating selected destinations and price of a ticket
		if( isset( $_POST[ 'stop_to' ])&&isset($_POST['submit_stop_to'])&&$_POST['stop_to']!="empty") {
		$_SESSION['stop_to']=$_POST['stop_to'];
		$_SESSION['service_no']=findService($_SESSION['city_from'],$_SESSION['stop_from'],$_SESSION['city_to'],$_SESSION['stop_to']);
		$_SESSION['price']=getPrice($_SESSION['service_no']);
		
		} else {	
		  echo "Please select END stop from dropdown list and click on Submit";
		}
		?>


		<form action="<?php echo $_SERVER[’PHP_SELF’];?>" method="post">
		<p><b>City</b>: <select name="city_to">

		<option value="empty">Select end point</option>';

		<?php
		$sql = "SELECT DISTINCT city FROM destinations";
		$result = $db->query($sql);

		while ( $row = $result->fetch_assoc() ) {
		echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';}
		
		echo'</select>
		<input type="submit" name="submit_city_to"/>
		</form></p>';

		//if city is selected, print it out and save to session
		if(isset($_POST['city_to'])&&isset($_POST['submit_city_to'])&&$_POST['city_to']!="empty") {
		$_SESSION['city_to']=$_POST['city_to'];
		unset($_SESSION['stop_to']);
		echo 'You have selected <font color="red"><b>'.$_SESSION['city_to'].'</b></font> Please select the station from dropdown below'.$_SESSION[ 'stop_to' ];
		} else {	
		  //user left default value for dropdown, tell him that:	
		  echo "Please select END city destination from dropdown list and click on Submit";
		}
		?>
		<p>
		<form action="<?php echo $_SERVER[’PHP_SELF’];?>"
		method="post">Station: <select name="stop_to">
		<option value="empty">Select end stop</option>';
		

		<?php
		//disregard starting stop
		$sqlStop = "SELECT stop FROM destinations WHERE city='{$_SESSION['city_to']}' AND stop!='{$_SESSION['stop_from']}'";
		$resultStops = $db->query($sqlStop);
		while ( $row = $resultStops->fetch_assoc() ) {
		
		echo '<option value="'.$row['stop'].'">'.$row['stop'].'</option>';}
		?>
		</select>
		<input type="submit" name="submit_stop_to"/>
			</form></p>		
