<?php include 'head.php'; include 'functions.php'; session_start();?>
	<body>
		<?php include 'top.php';?>

		<main>
		<!-- Message form with textarea, two textboxes and submit button -->
		<h1>Leave us a message</h1>
		<form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>"method="post">
	<textarea rows="4" cols="50" name="text"></textarea> <br>
	Your name: <input class="textbox" type="text" name="name"><br/>
	Email address:  <input  type="email" class="textbox" name="email"><br/>
	<input type="submit" name="submit_message"/>
	</form>
	


	<?php
	if ( isset( $_POST[ 'submit_message' ] )) {
	//check all inputs are valid and send message or report errors
	if(strlen( $_POST[ 'name' ] )>0&&checkEmail($_POST[ 'email' ])&&strlen( $_POST['text'] )>0)
	{
	$code =rand(0001,9999);
	
	$db = new mysqli( "emps-sql.ex.ac.uk"
	, "pv232"
	, "pv232"
	, "pv232");
	if ( $db->connect_error ) {
	header('system_down.php');
	}

	$name = $db->real_escape_string(htmlentities($_POST[ 'name' ]));
	$email = $db->real_escape_string(htmlentities($_POST[ 'email' ]));
	$text = $db->real_escape_string(htmlentities($_POST[ 'text' ]));

	$sql = "INSERT INTO comments VALUES (\"{$code}\",\"{$text}\",\"{$name}\",\"{$email}\");";
	$result= $db->query( $sql );
	$db->close();}
	else{echo "<font color=red>Invalid details.</font>";}
	}
	
?>
	</main>
	</body>
	<?php include 'footer.php';?>
