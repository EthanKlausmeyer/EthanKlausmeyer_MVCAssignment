<?php
function get_categories(){
    global $db;
    $query = 'SELECT * FROM categories ORDER BY ID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    return $categories;
}

function get_category_name($category_id){
    global $db;
    $query = 'SELECT * FROM categories WHERE ID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    $category_name = $category['categoryName'];
    return $category_name;
}
