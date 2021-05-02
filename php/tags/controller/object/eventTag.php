<?php


class eventTag
{
    function follow($id)
    {
        ini_set('display_errors', 1);
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/includes.php";
        $user = $_SESSION['id'];
        $sql = "INSERT INTO following(userid,tag) VALUES(?,?)";
        $sql = $pdo->prepare($sql);
        $sql->execute([$user, $id]);
    }
    function unfollow($id){
        ini_set('display_errors', 1);
        include $_SERVER['DOCUMENT_ROOT'] . "/includes/includes.php";
        $user = $_SESSION['id'];

        $sql = "DELETE FROM following WHERE userid=? AND tag=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$user,$id]);
        $deleted = $sql->rowCount();

    }
}