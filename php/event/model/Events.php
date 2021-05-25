<?php

class Events
{
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
    /**
     * @throws Exception
     */
    function getMap($id){
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        $sql = "SELECT * FROM upcomingevents where id=?";
        $pdo = new database();
        $pdo = $pdo->connect();
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        $sql = $sql->fetch();
        $image = "images/". $sql['id'] .  ".png";
        $map = ("https://www.mapquestapi.com/staticmap/v4/getmap?key=l0xvGksmufrkzdxcOLx8FjkIco0kvBNW&size=600,400&type=map&imagetype=png&pois=Location," . $sql['lat'] . ",". $sql['long'] );
        if (!file_exists($image)) {
            $data = $this->file_get_contents_curl(
                $map);
            file_put_contents($image, $data);
        }
        return $image;

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