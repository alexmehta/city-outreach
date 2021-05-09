<?php

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Notifications</title>
</head>
<body>
    <h1>
        Upcoming Events
    </h1>
    <p>Here are some upcoming events related to your interests</p>
    <?php
        include "../following.php";
    ?>

</body>
</html>
