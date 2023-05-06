<?php
	include('../connection.php');
	if(isset($_POST['AddDriver']))
	{
		$d = $_POST['d'];
		$D_Ph = $_POST['D_Ph'];

		$sql = "INSERT INTO drivers set
				Name = '$d',
				Phone = '$D_Ph'";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{
			$_SESSION['adddriver'] = "Driver added successfully";
			header('Location: drivers.php');
		}
		else
		{
			$_SESSION['addDriver'] = "Failed to add driver";
			header('Location: drivers.php');
		}
	}
 ?>
