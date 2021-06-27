<?php
require_once "loginCheck.php";
require_once "../model/Events.php";
$event = new Events();
?>
<style>

    * {
        margin: 0
    }

    .left, .right {
        width: 50%;
    }

    .left {
        float: left
    }

    .right {
        float: right
    }
</style>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="left">
    <canvas id="myChart">
    </canvas>
</div>
<script>
    const data = {
        labels: <?php echo $event->getsOfTags();?>
        ,
        datasets: [{
            label: 'Events most intrested in',
            data: <?php
            echo $event->getCountsAsTags();

            ?>,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 2
        }]
    };
    const config = {
        type: 'doughnut',
        data,
        options: {}
    };

    const chart = new Chart(document.getElementById("myChart"), config);
</script>
<div class="right">
    <table class="table" id="upcoming-events">
        <thead>
        <tr>
            <th>
                Event
            </th>
            <th>Date</th>
            <th>Time</th>
            <th>main tag</th>
            <th>Other events in meeting</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "../../includes/includes.php";
        ini_set('display_errors', 1);
        $stmt = $pdo->query("SELECT * FROM upcomingevents");
        while ($row = $stmt->fetch()):?>
            <?php
            $dt = new DateTime("now", new DateTimeZone('America/Phoenix'));
            $time = strtotime($row['date']);
            if ($time > strtotime($dt->format("m/d/Y, H:i:s"))):

                ?>

                <tr>
                    <td>

                        <a href="../../event/view/event.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a>

                    </td>
                    <td><?php echo $row['date'] ?></td>
                    <td>
                        <?php echo $row['time']; ?>
                    </td>
                    <td><?php echo $row['tag'] ?></td>
                    <td>
                        <?php
                        $sql = "SELECT * FROM meetingminutes WHERE event=?";
                        $stmt2 = $pdo->prepare($sql);
                        $stmt2->execute([$row['id']]);
                        $s = [];
                        $index = 0;


                        while ($row2 = $stmt2->fetch()):?>
                            <?php
                            $s[$index] = $row2['tag'];
                            $index++;
                            ?>

                        <?php endwhile; ?>
                        <?php
                        foreach ($s as $item) {
                            if (!array_key_exists($item, $s)) {
                                echo $item . " ";
                                $s[$item] = true;
                            }
                        }

                        ?>
                    </td>
                    <td>
                        <?php
                        require "model.php";
                        ?>
                    </td>
                </tr>
            <?php endif ?>
        <?php endwhile; ?>
        </tbody>
    </table>
    <div id="inbox" class="">
        <h1>Inbox</h1>
        <table class="table">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>Event</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Reply:</th>
            </tr>
            </thead>
            <tbody>
            <?php

            require_once "../model/Admin.php";
            $admin = new Admin();
            include "../../includes/includes.php";
            $sql = "SELECT * FROM messages where `read`=0";
            $sql = $pdo->prepare($sql);
            $sql->execute([]);
            //rint_r($sql->fetchAll());

            while ($row = $sql->fetch()):

                ?>
                <tr>
                    <td>
                        <?php

                        $sql2 = "SELECT * FROM users where id=?";
                        $sql2 = $pdo->prepare($sql2);
                        $sql2->execute([$row['user']]);

                        $s = $sql2->fetch();
                        echo $s["firstname"]; ?>
                    </td>
                    <td>
                        <?php echo $row['event']; ?>
                    </td>
                    <td>
                        <?php echo $row['subject'] ?>
                    </td>
                    <td>
                        <?php echo $row['message']; ?>
                    </td>
                    <td>
                        <a href="mailto:<?php echo $s['email']; ?>" target="_blank" class="btn btn-primary">Email</a>
                    </td>

                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>

    </div>
    <div>


</body>
</html>
