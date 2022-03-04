<?php
	session_start();
	error_reporting(1);
	$user=$_SESSION['fbuser'];

	$con=mysqli_connect("localhost","root","","facebook");

	$query1=mysqli_query($con,"SELECT * FROM users WHERE Email='$user'");
	$rec1=mysqli_fetch_array($query1);
	$userid=$rec1[0];
	mysqli_query($con,"UPDATE user_status SET status='Offline' WHERE user_id='$userid'");
	unset($_SESSION['fbuser']);
	//session_destroy();
	header("location:../../index.php");
?>