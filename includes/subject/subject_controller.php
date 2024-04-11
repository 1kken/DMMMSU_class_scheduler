<?php
    declare(strict_types=1);
    function is_subject_id_taken(object $pdo,string $subject_id){
        if(get_subject_id($pdo, $subject_id)){
            return true;
        }
        return false;
    }

    function is_lecture_lab_units_valid(string $lecture_units, string $laboratory_units,string $total_units){
        //convert to number
        $lecture_units = (int)$lecture_units;
        $laboratory_units = (int)$laboratory_units;
        $total_units = (int)$total_units;
        if($lecture_units == 0 && $laboratory_units == 0 && $lecture_units > 3 && $laboratory_units > 3 && $total_units>6){
            return true;
        }
        return false;
    }

    function is_subject_priority_valid(string $priority){
        $priority = (int)$priority;
        if($priority < 1 || $priority > 5){
            return true;
        }
        return false;
    }