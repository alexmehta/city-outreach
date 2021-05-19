<?php


class Events
{
    //takes tags name and encodes as js list
    function getsOfTags(){
        $array = array();
        include "../../includes/includes.php";
        $sql = "SELECT * FROM listtags ORDER BY id ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        $stmt = $stmt->fetchAll();
        $tags = array();
        $i = 0;
        $ids = array();
        foreach ($stmt as $row){
            $tags[$i] = $row['tags'];
            $ids[$i] = $row['id'];
            $i++;
        }


        return json_encode($tags);
    }
    function getCountsAsTags(){
        $array = array();
        include "../../includes/includes.php";
        $sql = "SELECT * FROM listtags ORDER BY id ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        $stmt = $stmt->fetchAll();
        $i = 0;
        $ids = array();
        foreach ($stmt as $row){
            $sql = "SELECT * FROM upcomingevents where tag = ?";
            $smt = $pdo->prepare($sql);
            $smt->execute([$row['tags']]);
            $smt = $smt->fetchAll();
            //get events of specific tag
            $answer = 0;
            foreach ($smt as $row2){
                $sql = "SELECT * FROM notifications WHERE eventid=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$row2['id']]);
                $answer += $stmt->rowCount();
            }

            $ids[$i] = $answer;
            $i++;
        }
        return json_encode($ids);
    }
}