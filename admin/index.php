<?php
    include('header.php');
?>
<section class="Main-Content">
    <h1>DASHBOARD</h1>
    <div class="col-5 text-center">
        <?php
            $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where (Type != 'admin')"));
        ?>
        <h1><?php echo "$count"; ?></h1>
            Users
    <br />
    </div>
    <div class="col-5 text-center">
        <?php
            $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM bookings"));
        ?>
        <h1><?php echo "$count"; ?></h1>
            Bookings
        <br />
    </div>
    <div class="col-5 text-center">
        <?php
            $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM routes"));
        ?>
        <h1><?php echo "$count"; ?></h1>
            Routes
        <br />
    </div>
    <div class="col-5 text-center">
        <?php
            $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM stops"));
        ?>
        <h1><?php echo "$count"; ?></h1>
            Stops
        <br />
    </div>
    <div class="col-5 text-center">
        <?php
            $count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM drivers"));
        ?>
        <h1><?php echo "$count"; ?></h1>
            Drivers
         <br />
    </div>
    <div class="clearfix"></div>
</section>
<?php
    include('footer.php');
?>