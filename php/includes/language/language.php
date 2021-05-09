<?php

if (!isset($_SESSION['lang'])){
    $_SESSION['lang'] = "en";
}else
    if (isset($_GET['lang']) && !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];
}
    //echo $_SESSION['lang'];