<?php
    include('../connection.php');

    $R_No = $_GET['R_No'];
	$d = $_GET['d'];
	$D_Ph = $_GET['D_Ph'];
	$s = array();
    $t = array();

    foreach($_GET['s'] as $stop)
	{
		$rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM stops WHERE
        Stop_Name = '$stop'"));
		$stop = $rows['Stop_No'];
		array_push($s, $stop);
	}
	foreach($_GET['t'] as $time)
	{
		array_push($t, $time);
	}
	
	if($R_No == NULL)
	{
		?>
			<script>
				alert("Enter All Required Values.")
				window.location.href = "routes.php";
			</script>
		<?php
	}
	else
	{
		$sql = "UPDATE routes SET
				Driver = '$d',
				Phone = '$D_Ph' WHERE
				Route_No = $R_No";

		include('../connection.php');
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
		if($res)
		{
			$res = mysqli_query($conn, "DELETE FROM routes_stops WHERE
			Route_No = $R_No");
			if($res)
			{
				$i = 0;
				foreach($s as $stop)
				{
					$res = mysqli_query($conn, "insert into routes_stops set
												Route_No = $R_No,
												Stop_No = $stop,
												Time = '$t[$i]'");
					$i+=1;
					if(!$res)
					{
						$_SESSION['updateroute'] = "Failed to update route_stops";
						header('Location: routes.php');
					}
				}
			}
			else
			{
				$_SESSION['updateroute'] = "Failed to delete route_stops";
				header('Location: routes.php');
			}
			$_SESSION['updateroute'] = "Route updated successfully";
			header('Location: routes.php');
		}
		else
		{
			$_SESSION['updateroute'] = "Failed to update route";
			header('Location: routes.php');
		}
	}
?>
