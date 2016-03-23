<?php
//This file contains error message, which is displayed in case that DB is not accessible.
include 'head.php';

?>	
	<body>
		<?php include 'top.php';?>

		<main>
			<?php 
			$db = new mysqli( "emps-sql.ex.ac.uk"
			, "pv232"
			, "pv232"
			, "pv232" );
			
			$db->close();

			?>
			<div id="error">
			<b><font size="10">Our system is currently down for maintenance.<br>We apologize, please come back later.</font></b>
			</div>
		</main>
	</body>
			<?php  		
			include 'footer.php';?>
