<?php
    require_once "../../user/User.php";
    $user = new User();
    $user->turnOffNotifications();
    header("LOCATION: ../../index.php");