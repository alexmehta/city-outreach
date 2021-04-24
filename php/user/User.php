<?php


class User
{
    function BasicUser($email, $password){
        ini_set('display_errors', 1);

        include "../includes/includes.php";
        $sql = "INSERT INTO users (email, password) values(?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email,$password]);

    }
}