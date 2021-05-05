<?php
ob_start();
session_start();
if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=0.8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City of Hayward Connect</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<h1>City of Hayward</h1>
<?php
if (!isset($id)) {

    echo "<a href='login/view/createaccount.php'>Create Account</a>
    <br>
    <a href= 'login/view/login.php'>Login</a>";
}else{
    include "user/User.php";
    $user = new User();
    if (!$user->getDefaults($_SESSION['id'])){
        header("LOCATION: tags/tags.php?newuser=true");
    }else{
        echo "<a href='tags/tags.php'>Tags</a>";
        echo "<br>";
        echo "<a href='login/logout.php'>Logout</a>";
        echo "<br>";
        echo "<a href='settings.php'>Settings</a>";
    }

}


if (isset($_SESSION['id'])){
    if ($_SESSION['view']){
        include "upcoming/following.php";
    }else{
        include "upcoming/defaultview.php";
    }
}
?>
</body>
</html>
