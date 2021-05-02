<?php
    $id = $_GET['id'];
require "object/eventTag.php";
session_start();
$unfollow = new eventTag();
$unfollow->unfollow($id);
header("LOCATION: ../tags.php");