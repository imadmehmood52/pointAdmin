<?php include('header.php'); ?>

	<?php
		if(isset($_SESSION['addstop']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['addstop'];
				unset($_SESSION['addstop']);
				?>
			</div>
			<?php
		}
		else if(isset($_SESSION['updatestop']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['updatestop'];
				unset($_SESSION['updatestop']);
				?>
			</div>
			<?php
		}
		if(isset($_SESSION['deletestop']))
		{
			?>
			<div class="wrapper" style="margin-top:1%">
				<?php
				echo $_SESSION['deletestop'];
				unset($_SESSION['deletestop']);
				?>
			</div>
			<?php
		}
	?>

	<div class="wrapper">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddStopModal"  style="margin-top: 1%;">
			Add Stop
		</button>
	</div>
	<form action="change_stop.php" method="post">
		<div class="page-content" style="margin-bottom: 0%">
		<div class="wrapper">
			<h1>Stops</h1>
			<br>
			<table class="tbl-full">
				<tr>
					<th></th>
					<th>Stop ID</th>
					<th>Stop Name</th>
				</tr>
				<?php
					$sql="select * from stops";
					$res=mysqli_query($conn, $sql);

					if($res==true)
					{
						$count = mysqli_num_rows($res);
						if($count>0)
						{
							$i = 0;
							while($rows=mysqli_fetch_assoc($res))
							{
								$S_No = $rows['Stop_No'];
								$s = $rows['Stop_Name'];
								$i++;
								?>
								<tr>
									<td><input class="form-check-input" type="checkbox" value="<?=$S_No?>" name="Chkbox[]" style="margin-right:10" ></td>
									<td><?php echo $i;?></td>
									<td><?php echo $s;?></td>
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
			<button type="submit" class="btn btn-primary" name="DeleteStop" style="float:right; margin-left: 0;">
		 		Delete Stop
			</button>
			<button type="submit" class="btn btn-primary" name="UpdateStop" style="float:right; margin-right:1%;">
				Update Stop
			</button>
		</div>
	</form>

	<br>

	<!-- Add Flight Modal -->
	<form action="add_stop.php" method="POST">
	<div class="modal fade" id="AddStopModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Stop</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
			    <div class="mb-3">
					<label>Stop Name</label>
					<input type="Text" class="form-control" name="s" placeholder="Enter Stop Name">
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="float:right; margin-right:2%;">Close</button>
	        <button type="submit" name="AddStop" class="btn btn-primary" style="float:right; margin-right:1%;  margin-left: 0">Submit</button>
	      </div>
	    </div>
	  </div>
	</div>
	</form>

<?php include('footer.php'); ?>
