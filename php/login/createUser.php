<?php
 include "../user/User.php";
 $user= new User();
 $email = $_POST['email'];
 $password = $_POST['password'];
 $user->BasicUser($email,$password,$_POST['DOB']);
 header("LOCATION: ../index.php");

?>