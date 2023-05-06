<?php
    include('../connection.php');

    $D_ID = $_GET['D_ID'];
	$d = $_GET['d'];
	$D_Ph = $_GET['D_Ph'];
	
	if($D_ID == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "drivers.php";
			</script>
		<?php
	}
	else
	{
		$sql = "UPDATE drivers SET
				Name = '$d',
				Phone = '$D_Ph' WHERE
				Driver_ID = $D_ID";

		include('../connection.php');
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
		if($res)
		{
			$_SESSION['updatedriver'] = "Driver updated successfully";
			header('Location: drivers.php');
		}
		else
		{
			$_SESSION['updatedriver'] = "Failed to update driver";
			header('Location: drivers.php');
		}
	}
?>
