<?php


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City of Hayward Connect</title>
</head>
<body>
    <form action="login/createUser.php" method="post">
        <label>Email</label>
        <input name="email" type="email">
        <label>Password</label>
        <input type="password" name="password">
        <input type="submit">
    </form>
    <br>
    <form action="login/loginUser.php" method="post">
        <label>Email</label>
        <input name="email" type="email" required="required">
        <label>Password</label>
        <input type="password" name="password">
        <input type="submit">
    </form>
</body>
</html>
