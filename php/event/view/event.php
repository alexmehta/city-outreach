<?php
require "../model/Events.php";
$event = new Events();
$event = $event->getEvent($_GET['id']);
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>        <?php echo $event['name'] ?>
    </title>
</head>
<body>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->


<h1>
    <?php echo $event['name'] ?> <span class="badge bg-secondary"><?php echo $event['tag'] ?></span>
</h1>
<h4>
    <b>
        Details:
    </b>
    <p>
        Date: <?php echo $event['date'] . " " . $event['time'] ?>
    </p>
    <p>
        Location: <?php
        echo $event['location'];
        ?>
    </p>
    <?php
    include_once "../../notifications/Notifications.php";
    $notification = new Notifications();
    if ($notification->getNotification($_GET['id'], $_SESSION['id']) == 0):


        ?>
        <td><a href="../../notifications/view/addReminder.php?id=<?php echo $_GET['id']; ?>">Follow</a></td>
    <?php endif; ?>

    <?php
    if ($notification->getNotification($_GET['id'], $_SESSION['id']) != 0):


        ?>

        <td><a href="../../notifications/removeReminder.php?id=<?php echo $_GET['id']; ?>">Unfollow</a></td>


    <? endif; ?>
</h4>
</body>
</html>
