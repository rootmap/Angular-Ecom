<?php
include '../../config/config.php';
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($con,$category_query);
$check_count = mysqli_num_rows($categories);

if ($check_count >= 1) {
       while ($row = mysqli_fetch_object($categories)) {
        $temp_rows = array();
        $temp_rows["category_id"] = utf8_encode($row->category_id);
        $temp_rows["category_title"] = utf8_encode($row->category_title);
        $temp_rows["category_parent_id"] = utf8_encode($row->category_parent_id);
        $temp_rows["expanded"] = "true";
        $rows[] = $temp_rows;
        
    }
    function buildTree($elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element["category_parent_id"] == $parentId) {
                $children = buildTree($elements, $element['category_id']);
                if ($children) {
                    $element['items'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    $tree = buildTree($rows);
    echo json_encode($tree);
}
else{
   echo json_encode("[]");
}
