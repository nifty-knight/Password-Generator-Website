<?php
	$id=$_GET['id'];
	include('conn.php');
	mysqli_query($conn,"DELETE FROM `generated_passwords` where id='$id'");
	header('location:main.php');
?>