<?php

    declare(strict_types=1);
    function check_if_password_is_incorrect(object $pdo, string $password, string $user_id){
        $stmt = $pdo->prepare("SELECT password FROM user WHERE instructor_id = :user_id OR student_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        if(!password_verify($password, $result['password'])){
            return true;
        }
        return false; 
    }
    function get_hashed_password(object $pdo,string $user_id): string{
        $stmt = $pdo->prepare("SELECT password FROM user WHERE instructor_id = :user_id OR student_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['password'];
    }

    function change_password(object $pdo, string $new_password, string $user_id){
        $stmt = $pdo->prepare("UPDATE user SET password = :new_password WHERE instructor_id = :user_id OR student_id = :user_id");
        $stmt->bindParam(':new_password', password_hash($new_password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    function get_full_name(object $pdo, string $user_id): string{
            $stmt = $pdo->prepare("SELECT first_name,last_name
                            FROM instructor
                            WHERE instructor_id = :user_id
                            UNION
                            SELECT first_name,last_name
                            FROM student
                            WHERE student_id =:user_id;");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['first_name'] . " " . $result['last_name'];
    }