<?php
   function check_student_id_available($pdo, $student_id){
       $sql = "SELECT * FROM student WHERE student_id = ?";
       $sql = $pdo->prepare($sql);
       $sql->execute([$student_id]);
       $sql = $sql->fetch(PDO::FETCH_ASSOC);
       return $sql;
   } 