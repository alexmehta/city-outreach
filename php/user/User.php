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
    function login($email,$password){
        ini_set('display_errors', 1);
        include "../includes/includes.php";
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $stmt= $stmt->fetch();
        $id = $stmt['id'];

        if ($password==$stmt['password']&&$email==$stmt['email']){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $stmt['email'];
            $_SESSION['loged'] = true;
            $_COOKIE['last_login'] = date("Y/m/d");
            header("LOCATION: ../index.php");
        }
        else{
            header("LOCATION: ../login/error.html");
        }


    }
}