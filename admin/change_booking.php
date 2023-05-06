<?php
	include('../connection.php');

	function changeStop()
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$_SESSION['B_ID'] = $id;
			echo 'changeStop.php';
		}
	}

	if(isset($_POST['DeleteBooking']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "DELETE FROM bookings WHERE
				Booking_ID = $id";

			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if($res)
			{
				$_SESSION['deletebooking'] = "Booking deleted successfully";
				header('Location: bookings.php');
			}
			else
			{
				$_SESSION['deletebooking'] = "Failed to delete booking";
				header('Location: bookings.php');
			}
		}
	}

	else if((isset($_POST['UpdateBooking']) && isset($_POST['Chkbox'])) || (isset($_POST['UpdateBooking']) && isset($_POST['changeStop'])))
	{
		if(isset($_POST['Chkbox']))
		{
			$Chk = $_POST['Chkbox'];
			foreach ($Chk as $id)
			{
				$sql = "SELECT * FROM bookings WHERE
					Booking_ID = $id";
				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				if($res==true)
				{
					$count = mysqli_num_rows($res);
					if($count==1)
					{
						while($rows=mysqli_fetch_assoc($res))
						{
							$R_No = $rows['Route_No'];
							$S_No = $rows['Stop_No'];
							$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Stop_Name FROM stops WHERE Stop_No = '$S_No'"));
							$S_Na = $row['Stop_Name'];
						}
					}
				}
			}
		}
		elseif(isset($_POST['changeStop']))
		{
			$id = $_POST['B_ID'];
			$S_No = $_POST['changeStop'];
			$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Stop_Name FROM stops WHERE Stop_No = '$S_No'"));
			$S_Na = $row['Stop_Name'];
			$sql = "SELECT * FROM bookings WHERE
					Booking_ID = $id";
			
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($res==true)
			{
				$count = mysqli_num_rows($res);
				if($count==1)
				{
					while($rows=mysqli_fetch_assoc($res))
					{
						$R_No = $rows['Route_No'];
					}
				}
			}
		}
		
		?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/admin.css">
		<div class="wrapper" style="width: 60%; margin-top: 4%; padding-bottom: 0;">
			<h1 style="font-weight: bold;">Update Bookings<h1>
		</div>
		<div class="wrapper" style="border: 1px solid grey; width: 60%; margin-top: 5%">
			<form style="margin: 3%" action="updateBooking.php" method="GET">
				<div class="mb-3">
					<label>Booking ID</label>
					<input type="number" class="form-control" name="B_ID" readonly placeholder="Enter Booking ID" value="<?php echo $id; ?>">
				</div>
				<div class="mb-3">
					<label>Stop Name</label>
					<input type="text" class="form-control" name="S_Na" readonly placeholder="Enter Stop" value="<?php echo $S_Na; ?>">
				</div>
				<div class="mb-3">
					<label>Route No.</label>
					<br><br>
  				  	<select name="R_No" class="form-control" style="text-align: center; background-color: white;" required value="<?php echo $R_No; ?>">
					<option> --SELECT ROUTE-- </option>
						<?php
							$res = mysqli_query($conn, "SELECT * from routes_stops WHERE Stop_No = $S_No");
							$count = mysqli_num_rows($res);

							while($row = mysqli_fetch_array($res))
							{
								echo "<option value='". $row['Route_No'] ."'>" .$row['Route_No']. " at " .$row['Time'] ."</option>";
							}
						?>
				</div>
                <div class="mb-3">
					<input type="submit" style="width:100%;" class="btn btn-primary">
				</div>
			</form>
			<div class="text-center">
				<a href='<?php changeStop() ?>'>Change Stop</a>
			</div>
		</div>
		<div class="padded" style="margin-bottom:7%"></div>
		<?php
	}
	else
	{
		?>
		<script>
			alert("No Fields Were Selected")
			window.location.href = "bookings.php";
		</script>
		<?php

	}
			?>
