<?php
    declare(strict_types=1);
    function get_user(object $pdo,string $id_number)
    {
        $sql = "SELECT * FROM user WHERE id_number = :id_number";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_number",$id_number,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }