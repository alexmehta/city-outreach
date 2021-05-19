<?php 
class Admin{



	function checkAdmin($userId){
        include "../../includes/includes.php";
        $sql = "LIMIT 1 SELECT admin FROM users where id=?"
        $sql = $pdo->prepare($sql);
        $sql = $sql->execute([$userId]);
        return $stmt->fetch();
	}	


?>
