<?php
	include('conn.php');
	mysqli_query($conn,"DELETE FROM `generated_passwords`");
	header('location:main.php');
?>