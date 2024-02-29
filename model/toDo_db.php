<?php
function get_toDos()
{
    global $db;
    $query = 'SELECT ItemNum, Title, Description From todoitems
    ORDER BY ItemNum';
    
    $statement = $db->prepare($query);
    $statement->execute();
    $ItemNum = $statement->fetchAll();
    $statement->closeCursor();
    return $ItemNum;
}

function delete_toDo($ItemNum)
{
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :ItemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':ItemNum', $ItemNum);
    $statement->execute();
    $statement->closeCursor();
}

function add_toDo($title, $description)
{
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description ) VALUES (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}