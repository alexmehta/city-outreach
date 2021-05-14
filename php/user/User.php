<?php

class User
{
    function BasicUser($email, $password, $DOB)
    {
        ini_set('display_errors', 1);
        include "../includes/includes.php";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password, DOB) values(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password, $DOB]);
    }

    function location($line1, $line2, $city, $state, $zip, $id)
    {
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "UPDATE users SET address1=?,address2=?,city=?,state=?,zip=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$line1, $line2, $city, $state, $zip, $id]);

    }
    function changeDefaults($id){
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "UPDATE users SET view = true WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

    }
    function getDefaults($id){
        ini_set('display_errors', 1);
        include "includes/includes.php";
        $sql = "SELECT view FROM users WHERE id=? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $id
        ]);
        $stmt = $stmt->fetch();
        return $stmt['view'];
    }
    function login($email, $password,$redirect)
    {
        ini_set('display_errors', 1);
        include "../includes/includes.php";
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $stmt = $stmt->fetch();
        if ($stmt) {
            if (isset($password) && isset($email) && isset($stmt)) {
                if (password_verify($password, $stmt['password'])) {
                    $id = $stmt['id'];
                    $_SESSION['id'] = $id;
                    $_SESSION['view'] = $stmt['view'];
                    $_SESSION['email'] = $stmt['email'];
                    $_SESSION['loged'] = true;
                    $_COOKIE['view'] = $stmt['view'];
                    $_COOKIE['last_login'] = date("Y/m/d");

                }
            }
        }
        if ($redirect!="none"){
            header("LOCATION: .." . $redirect);
       }else{
            header("LOCATION: ../index.php");
    }
    }
}