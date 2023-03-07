<?php

require("model/database.php");
require("model/todo_db.php");
require("model/category_db.php");

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $items = get_items_by_category($category_id);
    include('view/item_list.php');
} else if ($action == 'delete_item') {
    $itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE || $itemNum == NULL || $itemNum == FALSE) {
        $error = "Missing or incorrect item id or category id.";
        include('view/error.php');
    } else {
        delete_item($itemNum);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('view/item_add.php');
} else if ($action == 'add_item') {
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);

    if ($category_id == NULL || $category_id == FALSE || $title == NULL || $description == NULL || $title == FALSE || $description == FALSE) {
        $error = "Invalid item data. Check all fields and try again.";
        include('view/error.php');
    } else {
        add_item($category_id, $description, $title);
        header("Location: .?category_id=$category_id");
    }
}

?>