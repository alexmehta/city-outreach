<?php
    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locations</title>

</head>
<body>
    <form action="../db/setSettingLocation.php" method="post">
        <label for="time-period">
            Miles
        </label>
        <input name="miles" id="time-period" type="number">
        <input id="submit" name="submit" value="submit" type="submit">
    </form>
    <form action="../db/turnOffLocation.php" method="post">
        <label for="submit">
            Turn Off Notifications
        </label>
        <input id="submit" name="turn-off" value="submit" type="submit">
    </form>
</body>
</html>
