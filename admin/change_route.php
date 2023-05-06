<?php
	include('header.php');

	$res = mysqli_query($conn, "SELECT * FROM stops");

	$stops = array();
	$s = array();
	$t = array();
	while($row = mysqli_fetch_array($res))
	{
		array_push($stops, $row['Stop_Name']);
	}
	
	if(isset($_POST['DeleteRoute']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "DELETE FROM routes_stops WHERE
				Route_No = $id";

			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if($res)
			{
				$sql = "DELETE FROM routes WHERE
				Route_No = $id";

				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

				if(!$res)
				{
					$_SESSION['deleteroute'] = "Failed to delete route";
					header('Location: routes.php');
				}
				
				$_SESSION['deleteroute'] = "Route deleted successfully";
				header('Location: routes.php');
			}
			else
			{
				$_SESSION['deleteroute'] = "Failed to delete route_stop";
				header('Location: routes.php');
			}
		}
	}

	else if(isset($_POST['UpdateRoute']) && isset($_POST['Chkbox']))
	{
		$Chk = $_POST['Chkbox'];
		foreach ($Chk as $id)
		{
			$sql = "SELECT * FROM routes WHERE
				Route_No = $id";
			$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($res==true)
			{
				$count = mysqli_num_rows($res);
				$rows=mysqli_fetch_assoc($res);
				
				if($count>=1)
				{
					$R_No = $rows['Route_No'];
					$d = $rows['Driver'];
					$D_Ph = $rows['Phone'];

					$sql = "SELECT * FROM routes_stops WHERE
					Route_No = $id";
					$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

					while($rows=mysqli_fetch_assoc($res))
					{
						$sno=$rows['Stop_No'];
						$rows1=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM stops WHERE Stop_No = $sno"));
						array_push($s, $rows1['Stop_Name']);
						array_push($t, $rows['Time']);
					}
				}
			}
		}
		?>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/admin.css">
		<div class="wrapper" style="width: 60%; margin-top: 4%; padding-bottom: 0;">
			<h1 style="font-weight: bold;">Update Routes<h1>
		</div>
		<form style="margin: 3%" action="updateRoute.php" method="GET">
			<div class="wrapper" id="updateForm" style="border: 1px solid grey; width: 60%; margin-top: 5%">
				<div class="mb-3">
					<label>Route No</label>
					<input type="number" class="form-control" name="R_No" readonly placeholder="Enter Route No" value="<?php echo $R_No; ?>">
				</div>
				<div class="mb-3">
					<label>Stop</label>
					<br>
  				  	<select name="s[]" class="form-control" style="text-align: center; background-color: white;" value="<?php echo $s[0]; ?>">
						<option selected> <?php echo $s[0]; ?> </option>
						<?php
							include 'Connection.php';
							$res = mysqli_query($conn, "SELECT * FROM stops");
							$count = mysqli_num_rows($res);

							while($row = mysqli_fetch_array($res))
							{
								echo "<option value='". $row['Stop_Name'] ."'>" .$row['Stop_Name'] ."</option>";
							}
						?>
					</select>
			    </div>
				<div class="mb-3">
					<label>Time</label>
					<input type="time" class="form-control" name="t[]" value="<?php echo $t[0]; ?>" placeholder="Enter Time">
				</div>
				<div class="mb-3">
					<label>Driver Name</label>
					<input type="Text" class="form-control" name="d" placeholder="Enter Driver Name" value="<?php echo $d; ?>">
				</div>
				<div class="mb-3">
					<label>Driver Phone No.</label>
					<input type="number" class="form-control" name="D_Ph" placeholder="Enter Driver Phone No." value="<?php echo $D_Ph; ?>">
				</div>
			</div>
			<div class="wrapper" style="width: 60%;">
				<div class="mb-3">
					<button type="submit" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Submit</button>
					<button type="button" class="btn btn-secondary" id="addStopBtn" style="float:right; margin-right:2%;">Add</button>
				</div>
			</div>
		</form>
		<div class="padded" style="margin-bottom:7%"></div>
		<?php
	}
	else
	{
		?>
		<script>
			alert("No Fields Were Selected")
			window.location.href = "routes.php";
		</script>
		<?php
	}
		?>

<script>
	var counts = 1;
	var s = <?php echo json_encode($s); ?>;
	var stops = <?php echo json_encode($stops); ?>;
	var times = <?php echo json_encode($t); ?>;

	$(document).ready(function(){
		for(;counts<s.length;counts++)
		{
			var formfields = '<div class="mb-3">\
			<label>Stop</label>\
			<br>\
			<select name="s[]" class="form-control" value="'+s[counts]+'" id="stoplist'+counts+'" style="text-align: center; background-color: white;">\
				<option selected>'+s[counts]+'</option>\
			</select>\
			</div>\
			<div class="mb-3">\
				<label>Time</label>\
				<input type="time" class="form-control" name="t[]" value="'+times[counts]+'" placeholder="Enter Time">\
			</div>';
			$('#updateForm').append(formfields);

			for(i=0;i<stops.length;i++)
			{
				$('#stoplist'+counts+'').append('<option>'+stops[i]+'</option>')
			}
		}
	});

	$('#addStopBtn').click(function(){
		counts++;
		
		var formfields = '<div class="mb-3">\
		<label>Stop</label>\
		<br>\
		<select name="s[]" class="form-control" id="stoplist'+counts+'" style="text-align: center; background-color: white;">\
			<option disabled selected>--Select Stop--</option>\
		</select>\
		</div>\
		<div class="mb-3">\
			<label>Time</label>\
			<input type="time" class="form-control" name="t[]" placeholder="Enter Time">\
		</div>';
		$('#updateForm').append(formfields);

		for(i=0;i<stops.length;i++)
		{
			$('#stoplist'+counts+'').append('<option>'+stops[i]+'</option>')
		}
	});
</script>