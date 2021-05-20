<?php
    session_start();
    require "../model/Admin.php";
    $admin = new Admin;
    $admin = $admin->checkAdmin($_SESSION['id']);
    if(!$admin){
        echo "user not allowed as admin, return to main page: <a href='../../../index.php'>Link</a>";
        die();
    }













?>
