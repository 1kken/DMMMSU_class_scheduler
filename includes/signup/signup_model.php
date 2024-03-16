<?php
    declare(strict_types=1);

    function get_user_email(object $pdo,string $email){
        $query = "SELECT email FROM instructors WHERE email = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
   } 