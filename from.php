<?php	

		//This file contains starting destination form	
		$sql = "SELECT DISTINCT city FROM destinations";
		$result = $db->query($sql);
		
		//if start destination is set, save to session and return
		if( isset( $_POST[ 'stop_from' ])&&isset($_POST['submit_stop_from'])&&$_POST['stop_from']!="empty") {
		$_SESSION['stop_from']=$_POST['stop_from'];
			return;
		}



		?>

		<form action="<?php echo $_SERVER['PHP_SELF'];?>"
		method="post">
		<p><b>City: </b> <select name="city_from">
		<option value="empty">Select start point</option>';
		<?php
		while ( $row = $result->fetch_assoc() ) {
		echo '<option value='.$row['city'].'>'.$row['city'].'</option>';}
		
		echo'</select>
		<input type="submit" name="submit_city_from"/>
			</form></p>';
		
		//if city is selected reset stop values and save to sesion
		if( isset( $_POST[ 'submit_city_from' ])&&$_POST['city_from']!="empty") {
		unset($_SESSION['stop_from']);
		unset($_SESSION['city_to']);
		unset($_SESSION['stop_to']);
		$_SESSION['city_from']=$_POST['city_from'];
		echo 'You have selected <font color="red"><b>'.$_SESSION['city_from'].'</b></font> Please select the station from dropdown below';
		} else {	
		  //user left default value for dropdown, tell him that	
		  echo "Please select city your start destination from dropdown list and click on Submit";
		}?>

		<form action="<?php echo $_SERVER['PHP_SELF'];?>"
		method="post">Station: <select name="stop_from">
		<option value="empty">Select start stop</option>';
		



		<?php
		//show only stops corresponding to selected city
		$sqlStop = "SELECT stop FROM destinations WHERE	city='{$_SESSION['city_from']}'";
		$sqlStop2 = "SELECT stop FROM destinations";
		$resultStops = $db->query($sqlStop);
		while ( $row = $resultStops->fetch_assoc() ) {
		
		echo '<option value="'.$row['stop'].'">'.$row['stop'].'</option>';}
		
		echo'</select>


		<input type="submit" name="submit_stop_from"/>
			</form>';
		

		
		?>
