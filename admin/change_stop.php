<?php
	include('../connection.php');
	if(isset($_POST['DeleteStop']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "DELETE FROM routes WHERE
				Stop1 = $id OR Stop2 = $id OR Stop3 = $id";

			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			$sql = "DELETE FROM stops WHERE
				Stop_No = $id";

			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if($res)
			{
				$_SESSION['deletestop'] = "Stop deleted successfully";
				header('Location: stops.php');
			}
			else
			{
				$_SESSION['deletestop'] = "Failed to delete stop";
				header('Location: stops.php');
			}
		}
	}

	else if(isset($_POST['UpdateStop']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "SELECT * FROM stops WHERE
				Stop_No = $id";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($res==true)
			{
				$count = mysqli_num_rows($res);
				if($count==1)
				{
					while($rows=mysqli_fetch_assoc($res))
					{
						$S_No = $rows['Stop_No'];
						$s = $rows['Stop_Name'];
					}
				}
			}
		}
		?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/admin.css">
		<div class="wrapper" style="width: 60%; margin-top: 4%; padding-bottom: 0;">
			<h1 style="font-weight: bold;">Update Stop<h1>
		</div>
		<div class="wrapper" style="border: 1px solid grey; width: 60%; margin-top: 5%">
			<form style="margin: 3%" action="updateStop.php" method="GET">
				<div class="mb-3">
					<label>Stop No</label>
					<input type="number" class="form-control" name="S_No" readonly placeholder="Enter Stop No" value="<?php echo $S_No; ?>">
				</div>
				<div class="mb-3">
					<label>Stop Name</label>
					<input type="text" class="form-control" name="s" placeholder="Enter Stop Name" value="<?php echo $s; ?>">
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
			window.location.href = "stops.php";
		</script>
		<?php

	}
			?>
