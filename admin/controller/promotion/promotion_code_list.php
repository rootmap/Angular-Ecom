<?php

include '../../../config/config.php';

header("Content-type: application/json");
$verb = $_SERVER["REQUEST_METHOD"];
if ($verb == "GET") {
    $promotion_id = $_GET['promotion_id'];
    $arrayPromotionCode = array();
    $sqlPromotionCode = "SELECT * FROM promotion_codes WHERE PC_promotion_id = '$promotion_id' ORDER BY PC_promotion_id DESC";
    $resultPromotionCode = mysqli_query($con, $sqlPromotionCode);
    if ($resultPromotionCode) {
        while ($objresultPromotionCode = mysqli_fetch_object($resultPromotionCode)) {
            $arrayPromotionCode[] = $objresultPromotionCode;
        }
    } else {
        if (DEBUG) {
            $err = "resultPromotionCode error: " . mysqli_error($con);
        } else {
            $err = "resultPromotionCode query failed";
        }
    }
    echo "{\"data\":" . json_encode($arrayPromotionCode) . "}";
}

if ($verb == "POST") {
    extract($_POST);
    $errors = array();

    $userDefinedValue = "";

    $PC_id = mysqli_real_escape_string($con, $_POST["PC_id"]);
    $PC_promotion_id = mysqli_real_escape_string($con, $_POST["PC_promotion_id"]);
    $PC_code_used_email = mysqli_real_escape_string($con, $_POST["PC_code_used_email"]);
    $PC_code_status = mysqli_real_escape_string($con, $_POST["PC_code_status"]);
    $PC_code_use_type = mysqli_real_escape_string($con, $_POST["PC_code_use_type"]);
    $sqlCheckUserDefined = "SELECT promotion_code_predefined_user FROM promotions WHERE promotion_id = $PC_promotion_id";
    $resultCheckUserDefined = mysqli_query($con, $sqlCheckUserDefined);
    if ($resultCheckUserDefined) {
        $resultCheckUserDefinedObj = mysqli_fetch_object($resultCheckUserDefined);
        $userDefinedValue = $resultCheckUserDefinedObj->promotion_code_predefined_user;
    } else {
        $err = "Promotion code user defined data not found";
    }

    if ($userDefinedValue === 'yes') {
        if ($PC_code_used_email === "") {
            $errors = array("error" => "yes", "message" => "Email address required");
            echo json_encode($errors);
        } elseif ($PC_code_status === "inactive") {
            $errors = array("error" => "yes", "message" => "Select status as active");
            echo json_encode($errors);
        } else {
            $validEmail = isValidEmail($PC_code_used_email);
            if (!$validEmail) {
                $errors = array("error" => "yes", "message" => "Email address invalid");
                echo json_encode($errors);
            } else {
                $updateArray = '';
                $updateArray .=' PC_code_used_email = "' . $PC_code_used_email . '"';
                $updateArray .=', PC_code_status ="' . $PC_code_status . '"';

                $sqlUpdateCode = "UPDATE promotion_codes SET $updateArray WHERE PC_id=$PC_id";
                $resultUpdateCode = mysqli_query($con, $sqlUpdateCode);
                if (!$resultUpdateCode) {
                    if (DEBUG) {
                        $err = "resultUpdateCode error: " . mysqli_error($con);
                    } else {
                        $err = "resultUpdateCode query failed";
                    }
                } else {
                    echo json_encode($resultUpdateCode);
                }
            }
        }
    } else {
        // if no then update
        $updateArray = '';
        $updateArray .=' PC_code_used_email = "' . $PC_code_used_email . '"';
        $updateArray .=', PC_code_status ="' . $PC_code_status . '"';

        if ($PC_code_used_email != "") {
            $validEmail = isValidEmail($PC_code_used_email);
            if (!$validEmail) {
                $errors = array("error" => "yes", "message" => "Email address invalid");
                echo json_encode($errors);
            }
        } else {
            $updateArray = '';
            $updateArray .=' PC_code_used_email = "' . $PC_code_used_email . '"';
            $updateArray .=', PC_code_status ="' . $PC_code_status . '"';

            $sqlUpdateCode = "UPDATE promotion_codes SET $updateArray WHERE PC_id=$PC_id";
            $resultUpdateCode = mysqli_query($con, $sqlUpdateCode);
            if (!$resultUpdateCode) {
                if (DEBUG) {
                    $err = "resultUpdateCode error: " . mysqli_error($con);
                } else {
                    $err = "resultUpdateCode query failed";
                }
            } else {
                echo json_encode($resultUpdateCode);
            }
        }
    }
}
?>
