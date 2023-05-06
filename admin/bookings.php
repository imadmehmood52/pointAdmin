<?php include('header.php'); ?>

	<?php
		if(isset($_SESSION['addbooking']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['addbooking'];
				unset($_SESSION['addbooking']);
				?>
			</div>
			<?php
		}
		else if(isset($_SESSION['updatebooking']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['updatebooking'];
				unset($_SESSION['updatebooking']);
				?>
			</div>
			<?php
		}
		if(isset($_SESSION['deletebooking']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['deletebooking'];
				unset($_SESSION['deletebooking']);
				?>
			</div>
			<?php
		}
	?>

	<!-- <div class="wrapper">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDriverModal"  style="margin-top: 1%;">
			Add Booking
		</button>
	</div> -->
	<form action="change_Booking.php" method="post">
		<div class="page-content" style="margin-bottom: 0%">
		<div class="wrapper">
			<h1>Bookings</h1>
			<br>
			<table class="tbl-full">
				<tr>
					<th></th>
					<th>Booking ID</th>
					<th>Route No.</th>
					<th>Stop Name</th>
					<th>Student ID</th>
					<th>Student Name</th>
					<th>Status (Click to Confirm)</th>
				</tr>
				<?php
					$sql="select * from bookings";
					$res=mysqli_query($conn, $sql);

					if($res==true)
					{
						$count = mysqli_num_rows($res);
						if($count>0)
						{
							while($rows=mysqli_fetch_assoc($res))
							{
								$B_ID = $rows['Booking_ID'];
								$R_No = $rows['Route_No'];
								$S_ID = $rows['Student_ID'];
								$S_No = $rows['Stop_No'];
								$S = $rows['Status'];
								
								$rows1 = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where ID = '$S_ID'"));
								$Name = $rows1['First_Name'].' '.$rows1['Last_Name'];

								$rows1 = mysqli_fetch_assoc(mysqli_query($conn, "select Stop_Name from stops where Stop_No = '$S_No'"));
								$S_No = $rows1['Stop_Name'];
								
								?>
								<tr>
									<td><input class="form-check-input" type="checkbox" value="<?=$B_ID?>" name="Chkbox[]" style="margin-right:10" ></td>
									<td><?php echo $B_ID;?></td>
									<td><?php echo $R_No;?></td>
									<td><?php echo $S_No;?></td>
									<td><?php echo $S_ID;?></td>
									<td><?php echo $Name;?></td>
									<td>
										<?php if($S == 0)
										{?>
											<button class="btn" type="button" style="background-color: transparent; margin:auto; border: none; " onclick="confirmBooking(<?php echo($B_ID)?>)">&#9989;</button>
										<?php
										}
										else
										{?>
											Confirmed
										<?php
										}
										?>
									</td>
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
			<button type="submit" class="btn btn-primary" name="DeleteBooking" style="float:right; margin-left: 0;">
		 		Delete Booking
			</button>
			<button type="submit" class="btn btn-primary" name="UpdateBooking" style="float:right; margin-right:1%;">
				Update Booking
			</button>
			<!-- <button type="submit" class="btn btn-primary" name="UpdateDriver" style="float:right; margin-right:1%;">
				Confirm Booking
			</button> -->
		</div>
	</form>

	<br>

	<!-- Add Flight Modal -->
	<form action="add_driver.php" method="POST">
	<div class="modal fade" id="AddDriverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
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
	        <button type="submit" name="AddDriver" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>
	</form>

<?php 
	include('footer.php'); 
?>


<script>
	function confirmBooking(id)
	{
		$.ajax({
			url: "confirmbooking.php",
			type: "POST",
			data: {id: id},
			success: function (result) {
				alert('Booking '+id+' Confirmed');
				location.reload();
			}
		});
	}
</script>