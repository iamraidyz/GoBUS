<?php
//This file contains logout page and also carries out the logout process
include 'head.php';
	session_start();
	//reset session data and logout
	session_unset();
	?>
	
	<body>	
		<form method="POST" action=''>
		
		<?php include 'top.php';?>
		
		<main>
			<h1>Logout</h1>
			<p>You have successfully logged out.<br>Good bye!</p>
			</form>		
		</main>
	</body>
		<?php include 'footer.php';?>
