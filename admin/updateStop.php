<?php
    include('../connection.php');

    $S_No = $_GET['S_No'];
	$s = $_GET['s'];
	
	if($S_No == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "stops.php";
			</script>
		<?php
	}
	else
	{
		$sql = "UPDATE stops SET
				Stop_Name = '$s' WHERE
				Stop_No = $S_No";

		include('../connection.php');
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
		if($res)
		{
			$_SESSION['updatestop'] = "Stop updated successfully";
			header('Location: stops.php');
		}
		else
		{
			$_SESSION['updatestop'] = "Failed to update stop";
			header('Location: stops.php');
		}
	}
?>
