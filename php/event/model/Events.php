<?php

class Events
{
    function createLatLong($address, $id)
    {
        ini_set('display_errors', 1);
        require "../../includes/includes.php";
        $url  ="https://open.mapquestapi.com/geocoding/v1/address?key=l0xvGksmufrkzdxcOLx8FjkIco0kvBNW&location=" . $address;
        $geocode = file_get_contents(preg_replace("/ /", "%20", $url));
        $output = json_decode($geocode, true);
        $lat = $output["results"][0]["locations"][0]["latLng"]["lat"];
        $long = $output["results"][0]["locations"][0]["latLng"]["lng"];
        $sql = "UPDATE upcomingevents SET `long`=?, `lat`=? WHERE id=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$long, $lat, $id]);
    }
    function getEvents($id): array
    {
        require_once "../../includes/database.php";
        $pdo = (new database())->connect();
        $sql = "SELECT * FROM meetingminutes where event=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        return $sql->fetchAll();
    }
    /**
     * @throws Exception
     */
    function getMap($id): string
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        $sql = "SELECT * FROM upcomingevents where id=?";
        $pdo = new database();
        $pdo = $pdo->connect();
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        $sql = $sql->fetch();
        if ($sql['long']==null || $sql['lat']==null){
            $this->createLatLong($sql['location'],$id);
        }
        $image = "images/" . $sql['id'] . ".png";
        $map = ("https://www.mapquestapi.com/staticmap/v4/getmap?key=l0xvGksmufrkzdxcOLx8FjkIco0kvBNW&size=600,400&type=map&imagetype=png&pois=Location," . $sql['lat'] . "," . $sql['long']);
        if (!file_exists($image)) {
            $data = $this->file_get_contents_curl(
                $map);
            file_put_contents($image, $data);

        }
        return $image;

    }

    function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * @param $id
     * @return array
     * @author Alexander Mehta (alexandermehta@outlook.com)
     *
     */
    function getEvent($id)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        $sql = "SELECT * FROM upcomingevents WHERE id=?";
        $pdo = new database();
        $pdo = $pdo->connect();
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        return $sql->fetch();
    }

}