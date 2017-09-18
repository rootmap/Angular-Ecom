<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $arrayCategory = array();
    $sqlCategory = "SELECT cat1.category_id,cat1.category_type, cat1.category_title, cat1.category_color, cat1.category_priority, cat2.category_id AS category_parent_id, cat2.category_title AS category_parent_name FROM categories AS cat1 LEFT JOIN categories AS cat2 ON cat1.category_parent_id = cat2.category_id ORDER BY category_id DESC";
    $resultCategory = mysqli_query($con, $sqlCategory);
    if ($resultCategory) {
        while ($objCategory = mysqli_fetch_object($resultCategory)) {
            $arrayCategory[] = $objCategory;
        }
    } else {
        if (DEBUG) {
            $err = "resultCategory error: " . mysqli_error($con);
        } else {
            $err = "resultCategory query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayCategory) . "}";
}


if ($verb == "POST") {
    extract($_POST);
    $category_id = mysqli_real_escape_string($con, $category_id);
    $delete_sql = "DELETE FROM categories WHERE category_id = '" . $category_id . "'";
    $resultCategoryDelete = mysqli_query($con, $delete_sql);
    if ($resultCategoryDelete) {
        echo json_encode($resultCategoryDelete);
    } else {
        if (DEBUG) {
            $err = "resultCategoryDelete error: " . mysqli_error($con);
        } else {
            $err = "resultCategoryDelete query failed";
        }
    }
}
?>