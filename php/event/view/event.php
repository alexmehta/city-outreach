<?php

use Eluceo\iCal\Domain\Entity\Event;

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
    <b>Details:</b>
    <p>
        Date: <?php echo $event['date'] . " " . $event['time'] ?>
    </p>
    <p>
        Location: <?php
        echo $event['location'];
        if (!preg_match("(location|Remote|remote|REMOTE)", $event['location'])) {
            echo "<br>";
            $events = new Events();
            echo "<img src = ";
            try {
                echo $events->getMap($_GET['id']);
            } catch (Exception $e) {

            }
            echo ">";
        }
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
<h1>Other items in this meeting</h1>
<table class="table">
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Tag
            </th>
            <th>
                Ask a question
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "../../includes/database.php";
        $id = $_GET['id'];
        $pdo = (new database())->connect();
        $sql = "SELECT * FROM meetingminutes where event=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        //print_r($sql->fetchAll());
            while($row = $sql->fetch()):
        ?>
        <tr>
            <td>
                <?php
                    echo $row['name'];
                ?>
            </td>

            <td>
                <?php
                echo $row['tag'];
                ?>
            </td>
            <td>
                <a href="contact.php?tagid=<?php echo $row['id'];?>&event=<?php echo $_GET['id']; ?>">Contact</a>
            </td>

        </tr>
        <?php endwhile;?>
    </tbody>

</table>

</body>
</html>
