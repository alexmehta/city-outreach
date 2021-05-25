<?php

class Events
{

    /**
     * @param $id
     * @return array
     * @author Alexander Mehta (alexandermehta@outlook.com)
     *
     */
    function getEvent($id)
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
        $sql = "SELECT * FROM upcomingevents WHERE id=?";
        $pdo = new database();
        $pdo = $pdo->connect();
        $sql = $pdo->prepare($sql);
        $sql->execute([$id]);
        return $sql->fetch();
    }

}