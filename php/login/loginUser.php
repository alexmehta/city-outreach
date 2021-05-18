<?php
    require "../user/User.php";
    session_start();
    $user = new User();
    $user->login($_POST['email'], $_POST['password'],$_POST['redirect']);


