<?php 
class Admin
{


    function checkAdmin($userId)
    {
        include "../../includes/includes.php";
        $sql = "SELECT admin FROM users where id=?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$userId]);
        $sql = $sql->fetch();
        return $sql['admin'];
    }
}

?>
