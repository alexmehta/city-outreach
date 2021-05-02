<?php
include "../../includes/csrf.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<form action="../loginUser.php" method="post">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
    <label>Email</label>
    <input name="email" type="email" required="required">
    <label>Password</label>
    <input type="password" name="password">
    <input type="submit">
</form>
</body>
</html>