<?php
	include('config/database.php');
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	$time = date("Y-m-d H:i:s");
	$insert = mysqli_query($conn, 'INSERT INTO emails(`body`, `subject` ,`created_at`) VALUES ("'.$body.'","'.$subject.'","'.$time.'")');
	if($insert) {
		$message = '<div class="alert alert-success" role="alert">Record Inserted Successfully.</div>';
		echo $message;
	} else {
		$message = '<div class="alert alert-danger" role="alert">Record Not Inserted Successfully.</div>';
		echo $message;
	}
?>