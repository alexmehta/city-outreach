<?php
session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
</head>
<body>
<h2>Settings</h2>
<a href="settings/view/location.php">Change location</a>
<br>
<a href="settings/view/key_issues.php">Key Issues</a>
<br>
<a href="settings/view/LocationNotifications.php">Change Notification Location</a>
<br>

<?php
if ($_SESSION['view']) {
    echo "<a href='settings/db/view.php?answer=all'>Show all events</a>";

} else {
    echo "<a href='settings/db/view.php?answer=key'>Show only key events</a>";
}
?>
</body>
</html>
