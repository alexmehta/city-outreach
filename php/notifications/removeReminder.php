<?php
    session_start();
    include_once "Notifications.php";
    $event = new Notifications();

    $event->removeNotification($_SESSION['id'],$_GET['id']);
    header("LOCATION: ../index.php");