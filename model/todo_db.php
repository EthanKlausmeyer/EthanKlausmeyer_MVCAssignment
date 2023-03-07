<?php
function get_items_by_category($category_id){
    global $db;
    $query = 'SELECT * FROM todoitems T WHERE T.categoryID = :category_id ORDER BY ItemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

function get_item($itemNum){
    global $db;
    $query = 'SELECT * FROM todoitems WHERE ItemNum = :itemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->execute();
    $item = $statement->fetch();
    $statement->closeCursor();
    return $item;
}

function delete_item($itemNum){
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :itemNum';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($category_id, $description, $title){
    global $db;
    $query = 'INSERT INTO todoitems (categoryID, Description, Title) VALUES (:category_id, :description, :title)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $statement->closeCursor();
}
