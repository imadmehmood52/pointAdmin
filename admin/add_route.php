<?php
	include('../connection.php');
	if(isset($_POST['AddRoute']))
	{
		$s = $_POST['s'];
		$t = $_POST['t'];
		$d = $_POST['d'];
		$D_Ph = $_POST['D_Ph'];

		$rows = mysqli_query($conn, "SELECT * FROM routes");
		$id = mysqli_num_rows($rows)+1;

		$sql = "INSERT INTO routes set
				Route_No = $id,
                Driver = '$d',
				Phone = '$D_Ph'";

		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if($res)
		{
			$i = 0;
			foreach($s as $stop)
			{
				$rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM stops WHERE
				Stop_Name = '$stop'"));
				$stopno = $rows['Stop_No'];
				$time = $t[$i];

				$sql = "insert into routes_stops set
						Route_No = $id,
						Stop_No = $stopno,
						Time = '$time'";
							
				$i+=1;

				$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

				if(!$res)
				{
					$_SESSION['addroute'] = "Failed to add route_stop";
					header('Location: routes.php');
				}
			}
			$_SESSION['addroute'] = "Route added successfully";
			header('Location: routes.php');
		}
		else
		{
			$_SESSION['addroute'] = "Failed to add route";
			header('Location: routes.php');
		}
	}
 ?>
