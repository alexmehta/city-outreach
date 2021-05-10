<?php


class Notifications
{
    function removeNotification($user, $event){
        require '../includes/includes.php';
        ini_set('display_errors', 1);
        //delete from notifications database a  reminder
        $sql = "DELETE FROM notifications WHERE eventid=? and userid=?";
        //check to see if other users are using this event
        $sql = $pdo->prepare($sql);
        $sql->execute([$event, $user]);

        $statement = "SELECT * FROM notifications WHERE eventid=?";
        $statement = $pdo->prepare($statement);
        $statement->execute([$event]);
        $count = $statement->rowCount();
        //check if any other users are assigned to this event
        if ($count==0){
            $this->removeEventlock($event);
        }
    }
    function removeEventlock($id){
        //remove event by updating its lock
        require '../includes/includes.php';
        $statement = "UPDATE upcomingevents SET deleteable=true WHERE id=?";
        $statement = $pdo->prepare($statement);
        $statement->execute([$id]);
    }
    function insertNotification($user,$event)
    {

        require '../includes/includes.php';
        //insert into notifications database a new reminder
        $sql = "INSERT INTO notifications(eventid,userid) VALUES (?,?)";
        //make sure not to delete this event
        $statement = "UPDATE upcomingevents SET deleteable=false WHERE id=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$event, $user]);
        $statement = $pdo->prepare($statement);
        $statement->execute([$event]);
    }
    function getNotification($eventid, $userid){
        require 'includes/includes.php';
        $sql = "SELECT * FROM notifications WHERE userid=? AND eventid=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$userid,$eventid]);
        return $sql->rowCount();

    }
}