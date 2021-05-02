<?php
    $id = $_GET['id'];
    require "object/eventTag.php";
    session_start();
    $follow = new eventTag();
    $follow->follow($id);
    header("LOCATION: ../tags.php");
