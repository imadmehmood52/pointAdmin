<?php
    include('../Connection.php');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <div class="wrapper" style="width: 60%; margin-top: 4%; padding-bottom: 0;">
        <h1 style="font-weight: bold;">Update Bookings<h1>
    </div>
    <div class="wrapper" style="border: 1px solid grey; width: 60%; margin-top: 5%">
        <form style="margin: 3%" action="change_booking.php" method="POST">
            <div class="mb-3">
                <label>Booking ID</label>
                <input type="number" class="form-control" name="B_ID" readonly placeholder="Enter Booking ID" value="<?php echo $_SESSION['B_ID']; ?>">
            </div>
            <div class="mb-3">
                <label>Stop</label>
                <br><br>
                    <select name="changeStop" class="form-control" style="text-align: center; background-color: white;">
                <option selected> --SELECT STOP-- </option>
                <?php
                        $res = mysqli_query($conn, "SELECT * from stops");
                        $count = mysqli_num_rows($res);

                        while($row = mysqli_fetch_array($res))
                        {
                            echo "<option value='". $row['Stop_No'] ."'>" .$row['Stop_Name'] ."</option>";
                        }
                    ?>
            </div>
            <!-- <div class="mb-3">
                <label>Route No.</label>
                <br><br>
                    <select name="R_No" class="form-control" style="text-align: center; background-color: white;" value="<?php echo $R_No; ?>">
                <option selected> <?php echo $R_No; ?> </option>
                    <?php
                        // $res = mysqli_query($conn, "SELECT * from routes_stops WHERE Stop_No = (SELECT Stop_No from bookings WHERE Booking_ID = $id)");
                        // $count = mysqli_num_rows($res);

                        // while($row = mysqli_fetch_array($res))
                        // {
                        //     echo "<option value='". $row['Route_No'] ."'>" .$row['Route_No']. " at " .$row['Time'] ."</option>";
                        // }
                    ?>
            </div> -->
            <div class="mb-3">
                <input type="submit" name ="UpdateBooking" style="width:100%;" class="btn btn-primary">
            </div>
        </form>
    </div>