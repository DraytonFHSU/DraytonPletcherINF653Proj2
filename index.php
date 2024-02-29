<?php

//Drayton Pletcher
//Back-end web development 1
//Project 2

require_once('model/database.php');
require_once('model/toDo_db.php');

// Filter input to prevent XSS and SQL Injection
$ItemNum = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

// Determine the action to take, defaulting to listing the to do's if none specified
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?: filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?: 'list_toDos';

switch ($action) {
       
    case "add_toDo":
        if ($title && $description) {
            add_toDo($title, $description);
            header("Location: .?action=list_toDos" . $ItemNum);
            exit(); // Exits the script, making a break optional but good practice
        } else {
            $error_message = "Invalid toDo data. Check all fields and try again.";
            include("view/error.php");
            exit(); // Exits the script, making a break optional but good practice
        }
        break; // Good practice even after exit()
    
    case "delete_toDo":
        if ($ItemNum) {
            delete_toDo($ItemNum);
            header("Location: .?action=list_toDos" . $ItemNum);
            exit(); // Exits the script, making a break optional but good practice
        } else {
            $error_message = "Missing or incorrect toDo id.";
            include('view/error.php');
            exit(); // Exits the script, making a break optional but good practice
        }
        break; // Good practice even after exit()
    default:
        $toDos = get_toDos();
        include('view/toDolist.php');
        // No break needed after default as it's the last case
}