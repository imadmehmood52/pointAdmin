<?php
    include('../connection.php');
    if(isset($_SESSION['Admin']))
    {
?>
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Point - Admin Page</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                    <link rel="stylesheet" href="../css/admin.css">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                    <script type="text/javascript" src="../JS/JavaScript.js"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                </head>

                <body>
                    <section class="Nav">
                        <div class="Logo">
                                <a href="../index.php"><img src="../Images/Logo1.png" alt="Logo" style="width:50px; margin:10px"></a>
                        </div>
                        <div class="menu text-right">
                            <ul>
                                <li>
                                    <a href="routes.php">Routes</a>
                                </li>
                                <li>
                                    <a href="stops.php">Stops</a>
                                </li>
                                <li>
                                    <a href="bookings.php">Bookings</a>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <div class="classfix"></div>
<?php
    }
    else
    {
        ?>
        <script>
            alert('Page unavailable');
            window.location.href = "../index.php";
        </script>      
        <?php
    }
?>