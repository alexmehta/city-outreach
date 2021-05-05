<?php

session_start();
$answer = $_GET['answer'];
if ($answer == "key") {
    $_SESSION['view'] = true;
} else {
    $_SESSION['view'] = false;
}
header("LOCATION: ../../index.php");


?>