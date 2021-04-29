<?php
class User
{
    function BasicUser($email, $password, $DOB)
    {
        ini_set('display_errors', 1);
        include "../includes/includes.php";
        $sql = "INSERT INTO users (email, password, DOB) values(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password,$DOB]);
    }
    function location($line1,$line2,$city,$state,$zip,$id){
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "UPDATE users SET address1=?,address2=?,city=?,state=?,zip=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$line1,$line2,$city,$state,$zip,$id]);

    }
    function login($email, $password)
    {
        ini_set('display_errors', 1);
        include "../includes/includes.php";
        session_start();
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $stmt = $stmt->fetch();
        if ($stmt){
            if (isset($password) && isset($email) && isset($stmt)) {
                if ($password == $stmt['password']) {
                    $id = $stmt['id'];
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $stmt['email'];
                    $_SESSION['loged'] = true;
                    $_COOKIE['last_login'] = date("Y/m/d");
                    header("LOCATION: ../index.php");
                    exit();
                }
            }
        }

        header("LOCATION: error.html");
        exit();
    }
}