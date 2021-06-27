<?php

class User
{
    function BasicUser($email, $password, $DOB): string
    {
        require "../includes/includes.php";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password, DOB) values(?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password, $DOB]);
        return "success";
    }

    function googleUser($email, $userid, $firstname, $lastname, $profile)
    {
        require "../../includes/includes.php";
        if (!$this->googleUserExists($userid)) {
            $sql = "INSERT INTO users (email, googleid, firstname,lastname,profile) values(?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $userid, $firstname, $lastname, $profile]);
        }
        $this->validateGoogleUser($userid);
        header("LOCATION: ../../index.php");
    }

    function googleUserExists($userid): bool
    {
        ini_set('display_errors', 1);
        require "../../includes/includes.php";
        $sql = "SELECT * FROM users WHERE googleid=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userid]);
        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function validateGoogleUser($userid)
    {
        require "../../includes/includes.php";
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

    /**
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @param $unit
     * @return float
     * @author Alexander Mehta (alexandermehta@outlook.com)
     * @details calculates distance between 2 cords
     */
    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }

    }
    function getPreferredDistance($id){

        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        $database = new database();
        $pdo = $database->connect();
        $sql = "SELECT * FROM users where id=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        $sql = $sql->fetch();
        if ($sql['miles']==0){
            return "";
        }
        return $sql['miles'];
    }
    /**
     * @details turns off a users notifications
     */
    function turnOffNotifications()
    {
        session_start();
        $id = $_SESSION['id'];
        require "../../includes/includes.php";
        $sql = "UPDATE users SET notifications=false WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        echo 'done';
    }

    /**
     * @param $miles
     * @return string
     * @details turns on notifications in database
     */
    function turnOnNotifications($miles)
    {
        session_start();
        $id = $_SESSION['id'];
        require "../../includes/includes.php";
        $sql = "UPDATE users SET miles=?, notifications = true WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$miles, $id]);
        return "done";
    }

    /**
     * @param $line1
     * @param $line2
     * @param $city
     * @param $state
     * @param $zip
     * @param $id
     * @details sets location
     */
    function location($line1, $line2, $city, $state, $zip, $id)
    {
        ini_set('display_errors', 1);
        require "../../includes/includes.php";
        $sql = "UPDATE users SET address1=?,address2=?,city=?,state=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$line1, $line2, $city, $state, $id]);
        $address = $line1 . " " . $line2 . ", " . $city . ", " . $state;
        $geocode = file_get_contents("http://open.mapquestapi.com/geocoding/v1/address?key=l0xvGksmufrkzdxcOLx8FjkIco0kvBNW&location=" . $address);
        $output = json_decode($geocode, true);
        //print_r($geocode);
        //print_r($output);
//        ->results->locations->displayLatLng->lng
        $lat = $output["results"][0]["locations"][0]["latLng"]["lat"];
        $long = $output["results"][0]["locations"][0]["latLng"]["lng"];

        /*
                echo $lat . " ," . $long;

                $geocode = file_get_contents("http://open.mapquestapi.com/geocoding/v1/address?key=l0xvGksmufrkzdxcOLx8FjkIco0kvBNW&location=" . $lat . "," . $long);
                $output = json_decode($geocode,true);
                print_r($output) ;

                $long = $output["results"][0]["locations"][0]["street"];

                echo $long;*/
        $this->setLatLong($lat, $long, $id);
    }

    function setLatLong($latitude, $longitude, $id)
    {
        ini_set('display_errors', 1);
        require "../../includes/includes.php";
        $sql = "UPDATE users SET longitude=? , latitude=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$longitude, $latitude, $id]);
    }

    function changeDefaults($id)
    {
        ini_set('display_errors', 1);
        require "../../includes/includes.php";
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
        require "../includes/includes.php";
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