<?php
    include('../connection.php');

    $B_ID = $_GET['B_ID'];
	$S_Na = $_GET['S_Na'];
	$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Stop_No FROM stops WHERE Stop_Name = '$S_Na'"));
	$S_No = $row['Stop_No'];
	$R_No = $_GET['R_No'];
	
	if($B_ID == NULL || $S_Na == NULL || $S_No == NULL || $R_No == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "bookings.php";
			</script>
		<?php
	}
	else
	{
		$sql = "UPDATE bookings SET
				Stop_No = $S_No,
				Route_No = $R_No,
				Status = 0  WHERE
				Booking_ID = $B_ID";

		include('../connection.php');
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
		if($res)
		{
			$_SESSION['updatebooking'] = "Booking updated successfully";
			header('Location: bookings.php');
		}
		else
		{
			$_SESSION['updatebooking'] = "Failed to update booking";
			header('Location: bookings.php');
		}
	}
?>
