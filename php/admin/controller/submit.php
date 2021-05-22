<?php
include "../model/Events.php";
$events = new Events();
$events->editEvent($_POST['id'], $_POST['name'], $_POST['date'], $_POST['time'], $_POST['location'], $_POST['tag']);
header("LOCATION: ../admin.php");
