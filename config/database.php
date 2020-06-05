<?php
	$conn = mysqli_connect('localhost', 'root', '123456', 'email_send');
	if(!$conn) {
	   echo "Connection Error.".mysqli_connect_error(); 
	}
	else {
	   //echo "Connect";
	}
?>