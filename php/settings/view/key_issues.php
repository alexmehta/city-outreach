<?php
    session_start();
    require_once "../../user/User.php";
    $user = new User();
    if (isset($_POST['turn-off'])){
        $user->turnOffNotifications($_SESSION['id']);
    }else{
        if (isset($_POST['miles'])){

        }
    }