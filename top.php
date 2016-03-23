<?php
//This file contains welcome message, header and navigation bar common for all GoBUS pages

//when user is logged in, display his username
if($_SESSION['username']!=""){$name=',<font color="red"><b> '.$_SESSION['username'];}
echo '		<header>
			GO<br>BUS
		</header>
		<div id="welcome">
			<p>Welcome to GoBus'.$name.'</font></b></p>
			';
			if($_SESSION['username']!=""){echo '<p><a href="logout.php">Click here to logout</a></p>';}
echo'
		</div>


		<nav>
			<span><a href="index.php">Home</a></span>
			<span><a href="services.php">Services</a></span>
			<span><a href="registration.php">Registration</a></span>
			<span><a href="enq.php">Enquiries</a></span>
		</nav>';
?>
