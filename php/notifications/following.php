<?php
if (isset($_SESSION['id'])):

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/includes.php";

    ini_set('display_errors', 1);
    $stmt = ("SELECT * FROM upcomingevents WHERE tag in (SELECT tags FROM listtags WHERE listtags.id in (SELECT tag from following WHERE userid=?))");
    $stmt = $pdo->prepare($stmt);
    $stmt->execute([$_SESSION['id']]);
    while ($row = $stmt->fetch()):?>
        <?php
        $dt = new DateTime("now", new DateTimeZone('America/Phoenix'));
        $time = strtotime($row['date']);
        if ($time > strtotime($dt->format("m/d/Y, H:i:s"))):
            ?>
            <tr>
                <td>
                    <a href="../event.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a>

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

                    while ($row2 = $stmt2->fetch()):?>
                        <?php echo $row2['tag'] . " "; ?>

                    <?php endwhile; ?>
                </td>
                <td>

                </td>
            </tr>
        <?php endif ?>
    <?php endwhile; ?>
    </tbody>
</table>
<?php endif; ?>
</body>
</html>
