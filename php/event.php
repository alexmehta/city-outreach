<?php
require "includes/includes.php";

$id = $_GET['id'];
$sql = "SELECT * FROM upcomingevents where id=? LIMIT 1";
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$statement = $statement->fetch();
$name = $statement['name'];
$date = $statement['date'];
$time = $statement['time'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event: <?php echo $name?></title>
</head>
<body>
<?php

    echo $name;
    echo "<br>";
    echo $date . " " . $time;


?>
<?php
if (isset($id)):

    ?>


    <table class="table" id="upcoming-events">
        <thead>
        <tr>
            <th>
                Item
            </th>

            <th>tag</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "includes/includes.php";
        ini_set('display_errors', 1);
        $sql = "SELECT * FROM meetingminutes where event=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()==0){
            echo "No events have been mentioned";
        }
        while ($row = $stmt->fetch()):?>
            <tr>
                <td>
                    <?php echo $row['name']; ?>
                </td>
                <td><?php echo $row['tag'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif ?>
</body>
</html>
