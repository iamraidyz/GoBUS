<?php
//This file contains password strength tests
//password will only pass these tests if it's strength is bigger than 1.

//check for password length, more than 8 is recommended
function eight( $str ) {
return strlen( $str ) > 8;
}

//check for upper characters in password
function upper( $str ) {
return preg_match( "/[A-Z]/", $str );
}

//char for lower character in password
function lower( $str ) {
return preg_match( "/[a-z]/", $str );
}

//check for digits in password
function hasDigit($str){
return preg_match("/[0-9]/", $str);
}

//check for special character in password
function hasSpecial($str){
return preg_match('/[\'\^\.\£\$\%\&\*\(\)\}\{\@\#\~\?\>\<\>\,\|\=\_\+\¬\-]/', $string);
}

//carry out all tests and echo strength and return result of test(true/false)
function testPass($pass){
$level=0;
if(eight($pass)){$level+=1;}
if(upper($pass)){$level+=1;}
if(lower($pass)){$level+=1;}
if(hasDigit($pass)){$level+=1;}
if(hasSpecial($pass)){$level+=1;}

switch($level){
case 1: echo 'Password strength : <b><font color=red">Very weak.</font></b>';return false; break;
case 2: echo 'Password strength : <b><font color="orange">Weak.</font></b>';return true; break;
case 3: echo 'Password strength : <b><font color="grey">Medium</font></b>';return true; break;
case 4: echo 'Password strength : <b><font color="blue">Good</font></b>';return true; break;
case 5: echo 'Password strength : <b><font color="green">Strong.</font></b>';return true; break;
default : echo 'Password strength : <b><font color="red">Very weak.</font></b>'; break;}
}
?>
