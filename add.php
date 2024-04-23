<?php
	include('conn.php');
	
	$topic=$_POST['topic'];
		
	mysqli_query($conn,"insert into `topics` (topic) values ('$topic')");
	header('location:main.php');
	
?>