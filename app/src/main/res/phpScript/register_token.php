<?php
	require_once 'connection.php';

	$token=$_POST['token'];

	$query="INSERT INTO token VALUES ('','$token')";
	$result=mysqli_query($connection,$query);

	mysqli_close($connection);
?>