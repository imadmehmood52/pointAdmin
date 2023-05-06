<?php include('header.php'); ?>

	<?php
		if(isset($_SESSION['adddriver']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['adddriver'];
				unset($_SESSION['adddriver']);
				?>
			</div>
			<?php
		}
		else if(isset($_SESSION['updatedriver']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['updatedriver'];
				unset($_SESSION['updatedriver']);
				?>
			</div>
			<?php
		}
		if(isset($_SESSION['deletedriver']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['deletedriver'];
				unset($_SESSION['deletedriver']);
				?>
			</div>
			<?php
		}
	?>

	<div class="wrapper">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDriverModal"  style="margin-top: 1%;">
			Add Driver
		</button>
	</div>
	<form action="change_driver.php" method="post">
		<div class="page-content" style="margin-bottom: 0%">
		<div class="wrapper">
			<h1>Drivers</h1>
			<br>
			<table class="tbl-full">
				<tr>
					<th></th>
					<th>Driver ID</th>
					<th>Driver Name</th>
					<th>Driver Phone No.</th>
				</tr>
				<?php
					$sql="select * from drivers";
					$res=mysqli_query($conn, $sql);

					if($res==true)
					{
						$count = mysqli_num_rows($res);
						if($count>0)
						{
							$i = 0;
							while($rows=mysqli_fetch_assoc($res))
							{
								$D_ID = $rows['Driver_ID'];
								$d = $rows['Name'];
								$D_Ph = $rows['Phone'];
								$i++;
								?>
								<tr>
									<td><input class="form-check-input" type="checkbox" value="<?=$D_ID?>" name="Chkbox[]" style="margin-right:10" ></td>
									<td><?php echo $i;?></td>
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
			<button type="submit" class="btn btn-primary" name="DeleteDriver" style="float:right; margin-left: 0;">
		 		Delete Driver
			</button>
			<button type="submit" class="btn btn-primary" name="UpdateDriver" style="float:right; margin-right:1%;">
				Update Driver
			</button>
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

<?php include('footer.php'); ?>
