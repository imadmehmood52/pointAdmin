<?php
	include('../connection.php');
	if(isset($_POST['AddStop']))
	{
		$s = $_POST['s'];

		$sql = "INSERT INTO stops set
				Stop_Name = '$s'";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{
			$_SESSION['addstop'] = "Stop added successfully";
			header('Location: stops.php');
		}
		else
		{
			$_SESSION['addstop'] = "Failed to add stop";
			header('Location: stops.php');
		}
	}
 ?>
