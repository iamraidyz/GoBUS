<?php
//This file contains most of the functions used by GoBUS web application.


function https_php_self() { 
/* HTTPS submission - establish secure connection */

$resource = $_SERVER['PHP_SELF'];
$domain = $_SERVER['HTTP_HOST'];
$protocol = "https";
return $protocol . "://" . $domain . $resource;
}

function verifyLogin($pass,$user) {
/* login verification - check DB for username-password match,
return true if successful */

$db = new mysqli( "emps-sql.ex.ac.uk"
			, "pv232"
			, "pv232"
			, "pv232" );

if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}
$pw=hash("sha256", trim($pass));
$user = $db->real_escape_string( $user );
$sqlV="SELECT * FROM users WHERE username=\"{$user}\""
;
$resultV=$db->query($sqlV);

while ( $row = $resultV->fetch_assoc() ) {

if($row['username']==$user && $row['pass']==$pw)
{return true;}
else{return false;}
}
$db->close();
}

function dateCheck($date)
{//check date is not in the past
$cYear = intval(date('o'));
$cMonth = intval(date('m'));
$cDay = intval(date('d'));

$year=intval(substr( $date, 0, 4));
$month=intval(substr( $date, 5, 2));
$date=intval(substr( $date, 8, 2));

if($year<$cYear){echo '<b><font color="red">Please enter a valid date</font></b>'; return false;}
elseif($year==$cYear && $month<$cMonth){echo '<b><font color="red">Please enter a valid date</font></b>'; return false;}
elseif($year<=$cYear && $month=$cMonth && $date<$cDay){echo '<b><font color="red">Please enter a valid date</font></b>'; return false;}
else{return true;}
}


function getPrice($code){
//takes a service code, returns ticket price

$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232" );
		
		if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}
$sqlService="SELECT * FROM services WHERE code =\"{$code}\";";
$resultService=$db->query($sqlService);

$price = mysqli_fetch_object($resultService)->price;
return $price;

}

function checkCard($cardNum){
//verifies credit card format
if ( strlen( $cardNum) == 16
&& ctype_digit( $cardNum) ) {
 return true;
} else {
echo "<b><font color='red'>Please enter a valid card number</font></b>"; return false;
}
}

function login($user){
//Log user in
$_SESSION['username'] = $user;
}

function checkName($name){//check name
if ( strlen( $name ) <= 20&& strlen( $name ) >=2 ) {
return true;
} else {
echo "<b><font color='red'>Please enter a valid name</font></b>"; return false;
}
}



function checkUsername($username){
//check username is available,
//if there is record in db, returns true

if(strlen($username)<3){echo '<b><font color="red"> Username too short, please choose different. </b></font>'; return false;}
$db = new mysqli( "emps-sql.ex.ac.uk"
			, "pv232"
			, "pv232"
			, "pv232" );

if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}

$username = $db->real_escape_string( $username);
$sql="SELECT * FROM users WHERE username=\"{$username}\"";
$result=$db->query($sql);

if(mysqli_num_rows($result)>0)
{echo '<b><font color="red"> Username is taken, please choose different. </b></font>'; return false;}
else{return true;}
$db->close();
}



function createUser($username,$fname,$sname,$pw,$email){
//create new user

$db = new mysqli( "emps-sql.ex.ac.uk"
			, "pv232"
			, "pv232"
			, "pv232" );

if ( $db->connect_error ) {
		header( "location: system_down.php" );}
$pass=hash("sha256", trim($pw));
$sql="INSERT INTO users VALUES (\"{$username}\",\"{$fname}\",\"{$sname}\",\"{$pass}\",\"{$email}\");";
$db->query($sql);

$db->close();
}



function checkEmail($email){
//verify email format
if (strpos($email, '@')&&strpos($email, '.')) {return true;
}else{echo'<b><font color="red"> Not a valid email. </b></font>'; return false;}
}

function findService($from_city, $from_stop,$to_city,$to_stop){
//finds service, returns it's code
$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232" );
		
		if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}

$sqlFrom="SELECT stop_code FROM destinations WHERE city =\"{$from_city}\" AND stop = \"{$from_stop}\";";
$sqlTo="SELECT stop_code FROM destinations WHERE city =\"{$to_city}\" AND stop = \"{$to_stop}\";";


$resultFrom =$db->query($sqlFrom);

$codeFrom = mysqli_fetch_object($resultFrom)->stop_code;

$resultTo = $db->query($sqlTo);
$codeTo = mysqli_fetch_object($resultTo)->stop_code;

$sqlService="SELECT code FROM services WHERE start_point =\"{$codeFrom}\" AND end_point = \"{$codeTo}\";";
$resultService=$db->query($sqlService);
$serviceCode= mysqli_fetch_object($resultService)->code;

//If no service is found,
//try swap star with end(services go both ways)
if(!isset($serviceCode)){

$sqlService="SELECT code FROM services WHERE start_point =\"{$codeTo}\" AND end_point = \"{$codeFrom}\";";
$resultService=$db->query($sqlService);
$serviceCode= mysqli_fetch_object($resultService)->code;
}
return $serviceCode;


}
function serviceFree($code){
//check service has a free seat,
//if capacity is bigger than number of booked seats,
//return true
$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232" );
		
		if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}
$sqlService="SELECT * FROM services WHERE code =\"{$code}\";";
$resultService=$db->query($sqlService);

$capacity = mysqli_fetch_object($resultService)->capacity;
$booked = mysqli_fetch_object($resultService)->booked;

if($capacity>$booked){return true;}
else{echo mysqli_fetch_object($resultService)->code.'code'; echo 'c: '.$capacity.'This service is fully booked, sorry!'.$booked;return false;}

}

function createBooking($code,$dis,$username,$fname,$lname){
//creates bew booking and returns Booking ref(a random number)
$booking_ref= rand(0001,9999);

$db = new mysqli( "emps-sql.ex.ac.uk"
		, "pv232"
		, "pv232"
		, "pv232" );
		
		if ( $db->connect_error ) {
		header( "location: system_down.php" ); 
			}

$sqlService="UPDATE services SET booked = booked+1 WHERE code =\"{$code}\";";
$db->query($sqlService);

$sqlBooking="INSERT INTO bookings VALUES(\"{$booking_ref}\",\"{$code}\",\"{$username}\",\"{$dis}\",\"{$fname}\",\"{$lname}\");";
$db->query($sqlBooking);
return $booking_ref;
}

?>
