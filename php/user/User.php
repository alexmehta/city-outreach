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
        return "success";
    }

    function googleUser($email, $userid, $firstname, $lastname, $profile)
    {
        echo "/includes/includes.php";
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        if (!$this->googleUserExists($userid)){
            $sql = "INSERT INTO users (email, googleid, firstname,lastname,profile) values(?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $userid, $firstname, $lastname, $profile]);
        }
        $this->validateGoogleUser($userid);
    }
    function validateGoogleUser($userid){
        include "../../includes/includes.php";
        $sql = "SELECT * FROM users WHERE googleid = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userid]);
        $stmt = $stmt->fetch();
        $id = $stmt['id'];
        $_SESSION['id'] = $id;
        $_SESSION['view'] = $stmt['view'];
        $_SESSION['email'] = $stmt['email'];
        $_SESSION['loged'] = true;
        $_COOKIE['view'] = $stmt['view'];
        $_COOKIE['last_login'] = date("Y/m/d");
        header("../../index.php");
    }
    function googleUserExists($userid): bool
    {
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "SELECT * FROM users WHERE googleid=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userid]);
        if ($stmt->rowCount()==0){
            return false;
        }else{
            return true;
        }
    }

    function location($line1, $line2, $city, $state, $zip, $id)
    {
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "UPDATE users SET address1=?,address2=?,city=?,state=?,zip=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$line1, $line2, $city, $state, $zip, $id]);

    }

    function changeDefaults($id)
    {
        ini_set('display_errors', 1);
        include "../../includes/includes.php";
        $sql = "UPDATE users SET view = true WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

    }

    function getDefaults($id)
    {
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

    function login($email, $password, $redirect)
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
        if ($redirect != "none") {
            header("LOCATION: .." . $redirect);
        } else {
            header("LOCATION: ../index.php");
        }
    }
}