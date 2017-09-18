<?php

include '../../config/config.php';
$templateID = 0;
$arrGetTemplate = array();
extract($_POST);

if ($templateID > 0) {
    $sqlGetTemplate = "SELECT ST_id,ST_column_count,ST_row_count,ST_template_array FROM seat_template WHERE ST_SPC_id=$templateID";
    $resultGetTemplate = mysqli_query($con, $sqlGetTemplate);

    if ($resultGetTemplate) {
        while ($resultGetTemplateObj = mysqli_fetch_object($resultGetTemplate)) {
            $arrGetTemplate[] = $resultGetTemplateObj;
            $arrGetTemplate[(count($arrGetTemplate) - 1)]->Template_array = unserialize($resultGetTemplateObj->ST_template_array);
        }

        $return_array = array("output" => "success", "arrGetTemplate" => $arrGetTemplate);
        echo json_encode($return_array);
        exit();
    } else {
        if (DEBUG) {
            $return_array = array("output" => "error", "msg" => "resultGetTemplate error: " . mysqli_error($con));
            echo json_encode($return_array);
            exit();
        } else {
            $return_array = array("output" => "error", "msg" => "resultGetTemplate query failed.");
            echo json_encode($return_array);
            exit();
        }
    }
}


