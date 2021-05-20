<?php
    require "../../user/User.php";
    session_start();
    $user = new User();
    $user->location($_POST['address-line1'],$_POST['address-line2'],$_POST['city'],$_POST['region'],$_POST['postal-code'],$_SESSION['id']);
    header("LOCATION: ../../settings.php");