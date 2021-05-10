<?php

        //this code inserts a notification
        session_start();
        $userid = $_SESSION['id'];
        $id =
        require "Notifications.php";
        $Notification = new Notifications();
        $Notification->insertNotification($_SESSION['id'],$_POST['id']);
        HEADER("LOCATION: ../index.php");
        ?>