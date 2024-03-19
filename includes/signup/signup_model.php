<?php
    declare(strict_types=1);

    function get_user_id(object $pdo, string $user_id){
        $sql = "SELECT * FROM user WHERE student_id = :user_id OR instructor_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
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

    function create_user(object $pdo,string $user_type,string $user_id,string $password){
        //hashing password
        $password = password_hash($password,PASSWORD_BCRYPT,["cost"=>12]);
        //if student put into student pass
        if($user_type === "student"){
            $sql = "INSERT INTO user(student_id,user_type,password) VALUES(:id_number,:user_type,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_type",$user_type);
            $stmt->bindParam(":id_number",$user_id);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
        }
        if($user_type === "instructor"){
            $sql = "INSERT INTO user(instructor_id,user_type,password) VALUES(:id_number,:user_type,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":user_type",$user_type);
            $stmt->bindParam(":id_number",$user_id);
            $stmt->bindParam(":password",$password);
            $stmt->execute();
        }
    }