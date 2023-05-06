<?php
    include('../connection.php');
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE bookings SET Status = 1 WHERE Booking_ID = $id");
?>