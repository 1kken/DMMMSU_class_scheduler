<?php
    //Handle Create Read Update Delete (CRUD) operations for users
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        echo "Handel post";
    }

    if($_SERVER['REQUEST_METHOD'] !== "GET"){
        echo "Handle get";
    }

    if($_SERVER['REQUEST_METHOD'] !== "PUT"){
        echo "Handle put";
    }

    if($_SERVER['REQUEST_METHOD'] !== "DELETE"){
        echo "Handle delete";
    }