<?php
    session_start();
    if (!isset($_SESSION['id'])){
        HEADER("LOCATION:" . "/login/login.php?redirect=" .  $_SERVER['REQUEST_URI']);
    }