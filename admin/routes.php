<?php include('header.php'); ?>

	<?php
		$res = mysqli_query($conn, "SELECT * FROM stops");

		$stops = array();
		while($row = mysqli_fetch_array($res))
		{
			array_push($stops, $row['Stop_Name']);
		}
	?>
	<?php
		if(isset($_SESSION['addroute']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['addroute'];
				unset($_SESSION['addroute']);
				?>
			</div>
			<?php
		}
		else if(isset($_SESSION['updateroute']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['updateroute'];
				unset($_SESSION['updateroute']);
				?>
			</div>
			<?php
		}
		if(isset($_SESSION['deleteroute']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['deleteroute'];
				unset($_SESSION['deleteroute']);
				?>
			</div>
			<?php
		}
	?>

	<div class="wrapper">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddRouteModal"  style="margin-top: 1%;">
			Add Route
		</button>
	</div>
	<form action="change_route.php" method="post">
		<div class="page-content" style="margin-bottom: 0%">
		<div class="wrapper">
			<h1>Routes</h1>
			<br>
			<table class="tbl-full">
				<tr>
					<th></th>
					<th>Route No</th>
					<th>Stops</th>
					<th>Times</th>
					<th>Driver's Name</th>
					<th>Driver's Phone No.</th>
				</tr>
				<?php
					$sql="select * from routes";
					$res=mysqli_query($conn, $sql);

					if($res==true)
					{
						$count = mysqli_num_rows($res);
						if($count>0)
						{
							$i = 0;
							while($rows=mysqli_fetch_assoc($res))
							{
								$R_No = $rows['Route_No'];
								$d = $rows['Driver'];
								$D_Ph = $rows['Phone'];
								$i++;
								?>
								<tr>
									<td><input class="form-check-input" type="checkbox" value="<?=$R_No?>" name="Chkbox[]" style="margin-right:10" ></td>
									<td><?php echo $R_No;?></td>
									<td>
									<?php 
										$res1 = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Route_No = '$R_No'");
										while($rows1 =  mysqli_fetch_assoc($res1))
										{
											$s = $rows1['Stop_No'];
											$rows2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM stops WHERE
											Stop_No = '$s'")); 
											$s = $rows2['Stop_Name'];
											echo $s;
											?><br><?php
										}
									?>
									</td>
									<td>
									<?php 
										$res1 = mysqli_query($conn, "SELECT * FROM routes_stops WHERE Route_No = '$R_No'");
										while($rows1 =  mysqli_fetch_assoc($res1))
										{
											$t = $rows1['Time'];
											echo $t;
											?><br><?php
										}
									?>
									</td>
									<td><?php echo $d;?></td>
									<td><?php echo $D_Ph;?></td>
								</tr>

								<?php

							}
						}
					}
				?>


			</table>
		</div>
	</div>

		<div class="wrapper" style="margin-bottom: 1%">
			<button type="submit" class="btn btn-primary" name="DeleteRoute" style="float:right; margin-left: 0;">
		 		Delete Route
			</button>
			<button type="submit" class="btn btn-primary" name="UpdateRoute" style="float:right; margin-right:1%;">
				Update Route
			</button>
		</div>
	</form>

	<br>

	<!-- Add Flight Modal -->
	<form action="add_route.php" method="POST">
	<div class="modal fade" id="AddRouteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Route</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body" id="addForm" style="overflow-y: auto; height: 350px">
			    <div class="mb-3">
					<label>Stop</label>
					<br>
  				  	<select name="s[]" class="form-control" style="text-align: center; background-color: white;">
						<option disabled selected>--Select Stop--</option>
						<?php
							include 'Connection.php';
							$res = mysqli_query($conn, "SELECT * FROM stops");

							while($row = mysqli_fetch_array($res))
							{
								echo "<option value='". $row['Stop_Name'] ."'>" .$row['Stop_Name'] ."</option>";
							}
						?>
					</select>
			    </div>
				<div class="mb-3">
					<label>Time</label>
					<input type="time" class="form-control" name="t[]" placeholder="Enter Time">
				</div>
				<div class="mb-3">
					<label>Driver Name</label>
					<input type="Text" class="form-control" name="d" placeholder="Enter Driver Name">
				</div>
				<div class="mb-3">
					<label>Driver Phone No.</label>
					<input type="number" class="form-control" name="D_Ph" placeholder="Enter Driver Phone No.">
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="float:right; margin-right:2%;">Close</button>
			<button type="button" class="btn btn-secondary" id="addStopBtn" style="float:right; margin-right:2%;">Add</button>
			<button type="submit" name="AddRoute" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>
	</form>
	

<?php include('footer.php'); ?>


<script>
	var wrapper = $('#addForm');
	var counts = 0;
	var stops = <?php echo json_encode($stops); ?>;
	
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
		$(wrapper).append(formfields);

		for(i=0;i<stops.length;i++)
		{
			$('#stoplist'+counts+'').append('<option>'+stops[i]+'</option>')
		}
	});
</script>