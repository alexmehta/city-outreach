<?php
    require "../user/User.php";
    session_start();
if ($_POST['token'] == $_SESSION['token']) {
    $user = new User();
    $user->login($_POST['email'], $_POST['password']);
}