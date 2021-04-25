<?php
    require "../user/User.php";
    $user = new User();
    $user->login($_POST['email'],$_POST['password']);