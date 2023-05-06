<?php
	include('../connection.php');
	if(isset($_POST['DeleteDriver']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "DELETE FROM drivers WHERE
				Driver_ID = $id";

			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if($res)
			{
				$_SESSION['deletedriver'] = "Driver deleted successfully";
				header('Location: drivers.php');
			}
			else
			{
				$_SESSION['deletedriver'] = "Failed to delete driver";
				header('Location: drivers.php');
			}
		}
	}

	else if(isset($_POST['UpdateDriver']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "SELECT * FROM drivers WHERE
				Driver_ID = $id";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($res==true)
			{
				$count = mysqli_num_rows($res);
				if($count==1)
				{
					while($rows=mysqli_fetch_assoc($res))
					{
						$D_ID = $rows['Driver_ID'];
						$d = $rows['Name'];
						$D_Ph = $rows['Phone'];
					}
				}
			}
		}
		?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/admin.css">
		<div class="wrapper" style="width: 60%; margin-top: 4%; padding-bottom: 0;">
			<h1 style="font-weight: bold;">Update Drivers<h1>
		</div>
		<div class="wrapper" style="border: 1px solid grey; width: 60%; margin-top: 5%">
			<form style="margin: 3%" action="updateDriver.php" method="GET">
				<div class="mb-3">
					<label>Driver ID</label>
					<input type="number" class="form-control" name="D_ID" readonly placeholder="Enter Driver ID" value="<?php echo $D_ID; ?>">
				</div>
				<div class="mb-3">
					<label>Driver Name</label>
					<input type="text" class="form-control" name="d" placeholder="Enter Driver Name" value="<?php echo $d; ?>">
				</div>
				<div class="mb-3">
					<label>Driver Phone No.</label>
					<input type="number" class="form-control" name="D_Ph" placeholder="Enter Driver Phone No" value="<?php echo $D_Ph; ?>">
				</div>
                <div class="mb-3">
					<input type="submit" style="width:100%;" class="btn btn-primary">
				</div>
			</form>
		</div>
		<div class="padded" style="margin-bottom:7%"></div>
		<?php
	}
	else
	{
		?>
		<script>
			alert("No Fields Were Selected")
			window.location.href = "drivers.php";
		</script>
		<?php

	}
			?>
