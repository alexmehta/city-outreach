<?php
require_once "../../user/User.php";
$user = new User();
$user->turnOnNotifications($_POST['miles']);
header("LOCATION: ../../index.php");