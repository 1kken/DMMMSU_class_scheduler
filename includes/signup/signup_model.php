<?php
    declare(strict_types=1);

    function get_user_email(object $pdo,string $email){
        $query = "SELECT user_name FROM users WHERE user_name = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
   } 