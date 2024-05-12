<?php

if(isset($_POST['instructor_id'])&& isset($_POST['sy_instructor']) && isset($_POST['section_instructor']) && isset($_POST['semester_instructor'])){
    echo "4";
}

if(isset($_POST['instructor_id'])&& isset($_POST['sy_instructor']) && empty($_POST['section_instructor']) && empty($_POST['semester_instructor'])){
    echo "instructor sy";
}

if(isset($_POST['instructor_id']) && isset($_POST['section_instructor']) && empty($_POST['sy_instructor']) && empty($_POST['semester_instructor'])){
    echo "insructor section";
}

if(isset($_POST['instructor_id']) && isset($_POST['semester_instructor']) && empty($_POST['sy_instructor']) && empty($_POST['section_instructor'])){
    echo "instructor semester";
}

//instructor - School Year - Section
//instructor -  School - Year-Semester
// instructor - Section- Semester
//make a filter if(isset based on this)
if(isset($_POST['instructor_id']) && isset($_POST['sy_instructor']) && isset($_POST['section_instructor']) && empty($_POST['semester_instructor'])){
    echo "instructor sy section";
}

if(isset($_POST['instructor_id']) && isset($_POST['sy_instructor']) && isset($_POST['semester_instructor']) && empty($_POST['section_instructor'])){
    echo "instructor sy semester";
}

if(isset($_POST['instructor_id']) && isset($_POST['section_instructor']) && isset($_POST['semester_instructor']) && empty($_POST['sy_instructor'])){
    echo "instructor section semester";
}

