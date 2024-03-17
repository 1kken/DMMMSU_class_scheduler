<?php
    declare(strict_types=1);

use function PHPSTORM_META\type;

    function get_user_id_by_user_typer(object $pdo,string $user_type,string $user_id){
        if($user_type === "student"){
            $sql = "SELECT student_id FROM student WHERE student_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }
        if($user_type === "instructor"){
            $sql = "SELECT instructor_id FROM instructor WHERE instructor_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }
    }

    function create_user(object $pdo,string $user_type,string $id_number,string $password){
        //hashing password
        $password = password_hash($password,PASSWORD_BCRYPT,["cost"=>12]);
        //if student put into student pass
        if($user_type === "student"){
            $sql = "INSERT INTO student(student_id,user_type,pwd) VALUES(:id_number,:user_type,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_type",$user_type);
            $stmt->bindParam(":id_number",$id_number);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
        }
        if($user_type === "instructor"){
            $sql = "INSERT INTO instructor(instructor_id,user_type,pwd) VALUES(:id_number,:user_type,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_type",$user_type);
            $stmt->bindParam(":id_number",$id_number);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
        }
    }