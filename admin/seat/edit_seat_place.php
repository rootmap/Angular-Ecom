<?php
include '../../config/config.php';
include '../../lib/Zebra_Image.php';
$adminID = 0;
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $adminID = getSession('admin_id');
}
$SP_id = 0;
if (isset($_GET['SP_id'])) {
    $SP_id = $_GET['SP_id'];
}

$place_title = '';
$shapeType = '';
$shapeTitle = '';
$shapeCoordinates = '';
$checkStatus = 0;
$place_image = "";
$coordinate_id = 0;
if (isset($_POST['btnCreatePlace'])) {
    extract($_POST);
    
    if ($place_title == "") {
        $err = "Place Title is required.";
    } else {
        $dateTimeNow = date("Y-m-d H:i:s");

//        $lastPlaceID = getMaxValue('seat_place', 'SP_id');
//        $strPlaceTitleCln = clean($place_title);
        $Layout_image_name = "";
        if ($_FILES["place_image"]["tmp_name"] != '') {
            $Layout_image = basename($_FILES['place_image']['name']);
            $info = pathinfo($Layout_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
            $Layout_image_name = 'PlaceName-' . clean($place_title) . '-PlaceID-' . ($SP_id) . '.' . $info; /* create custom image name color id will add  */
            $image_source = $_FILES["place_image"]["tmp_name"];

            if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/place_layout/')) {
                mkdir($config['IMAGE_UPLOAD_PATH'] . '/place_layout/', 0777, TRUE);
            }
            $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/place_layout/' . $Layout_image_name;

            $zebra = new Zebra_Image();
            $zebra->source_path = $_FILES["place_image"]["tmp_name"]; /* original image path */
            $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/place_layout/' . $Layout_image_name;

            if (!(move_uploaded_file($image_source, $image_target_path))) {
                $err = "Layout image upload failed.";
            } else {
                //echo "Uploded";
            }
        }
        
        
        // color image code start
        $Layout_color_image = "";
        if ($_FILES["place_color_image"]["tmp_name"] != '') {
            $Layout_color_image = basename($_FILES['place_color_image']['name']);
            $info_color = pathinfo($Layout_color_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
            $Layout_color_image_name = 'PlaceName-' . clean($place_title) . '-PlaceID-' . ($SP_id) . '.' . $info_color; /* create custom image name color id will add  */
            $image_source_color = $_FILES["place_color_image"]["tmp_name"];

            if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/place_color_image/')) {
                mkdir($config['IMAGE_UPLOAD_PATH'] . '/place_color_image/', 0777, TRUE);
            }
            $image_target_path_color = $config['IMAGE_UPLOAD_PATH'] . '/place_color_image/' . $Layout_color_image_name;

            $zebra = new Zebra_Image();
            $zebra->source_path = $_FILES["place_color_image"]["tmp_name"]; /* original image path */
            $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/place_color_image/' . $Layout_color_image_name;

            if (!(move_uploaded_file($image_source_color, $image_target_path_color))) {
                $err = "Layout color image upload failed.";
            } else {
                //echo "Uploded";
            }
        }
        // color image code end



        // update place

        $updatePlace = '';
        $updatePlace .=' SP_title = "' . validateInput($place_title) . '"';
        if ($_FILES["place_image"]["tmp_name"] != '') {
            $updatePlace .= ', SP_image = "' . $Layout_image_name . '"';
        }
        if ($_FILES["place_color_image"]["tmp_name"] != '') {
            $updatePlace .= ', SP_image_color = "' . $Layout_color_image_name . '"';
        }
        $updatePlace .=', SP_updated_by = "' . validateInput($adminID) . '"';
        $sqlUpdatePlace = "UPDATE seat_place SET $updatePlace WHERE SP_id = $SP_id";
        $resultUpdatePlace = mysqli_query($con, $sqlUpdatePlace);
        if ($resultUpdatePlace) {
            for ($i = 0; $i < 20; $i++) {
                if (isset($_POST['coordinate_id_' . $i])) {
                    //update coordinate data
                    $coordinate_id = $_POST['coordinate_id_' . $i];
                    
                    if (isset($_POST['shape_type_' . $i]) AND isset($_POST['shape_coordinate_' . $i]) AND isset($_POST['shape_title_' . $i])) {
                        $shapeType = $_POST['shape_type_' . $i];
                        $shapeTitle = $_POST['shape_title_' . $i];
                        $shapeCoordinates = $_POST['shape_coordinate_' . $i];

                        $updatePlaceCoordinate = '';
                        $updatePlaceCoordinate .=' SPC_SP_id = "' . validateInput($SP_id) . '"';
                        $updatePlaceCoordinate .=', SPC_title = "' . validateInput($shapeTitle) . '"';
                        $updatePlaceCoordinate .=', SPC_shape_type = "' . validateInput($shapeType) . '"';
                        $updatePlaceCoordinate .=', SPC_coordinates = "' . validateInput($shapeCoordinates) . '"';
                        $updatePlaceCoordinate .=', SPC_updated_by = "' . validateInput($adminID) . '"';

                        $sqlUpdateCoordinate = "UPDATE seat_place_coordinate SET $updatePlaceCoordinate WHERE SPC_id = $coordinate_id";
                        $resultPlaceCoordinate = mysqli_query($con, $sqlUpdateCoordinate);
                        if (!$resultPlaceCoordinate) {
                            $checkStatus++;
                            if (DEBUG) {
                                echo "resultInsertForm error: " . mysqli_error($con);
                            }
                        }
                    }
                } else {

                    //insert new coordinate data
                    if (isset($_POST['shape_type_' . $i]) AND isset($_POST['shape_coordinate_' . $i]) AND isset($_POST['shape_title_' . $i])) {
                        $shapeType = $_POST['shape_type_' . $i];
                        $shapeTitle = $_POST['shape_title_' . $i];
                        $shapeCoordinates = $_POST['shape_coordinate_' . $i];

                        $insertPlaceCoordinate = '';
                        $insertPlaceCoordinate .=' SPC_SP_id = "' . validateInput($SP_id) . '"';
                        $insertPlaceCoordinate .=', SPC_title = "' . validateInput($shapeTitle) . '"';
                        $insertPlaceCoordinate .=', SPC_shape_type = "' . validateInput($shapeType) . '"';
                        $insertPlaceCoordinate .=', SPC_coordinates = "' . validateInput($shapeCoordinates) . '"';
                        $insertPlaceCoordinate .=', SPC_created_on = "' . validateInput($dateTimeNow) . '"';
                        $insertPlaceCoordinate .=', SPC_created_by = "' . validateInput($adminID) . '"';

                        $sqlPlaceCoordinate = "INSERT INTO seat_place_coordinate SET $insertPlaceCoordinate";
                        $resultPlaceCoordinate = mysqli_query($con, $sqlPlaceCoordinate);

                        if (!$resultPlaceCoordinate) {
                            $checkStatus++;
                            if (DEBUG) {
                                echo "resultInsertForm error: " . mysqli_error($con);
                            }
                        }
                    }
                }
            }
        } else {
            if (DEBUG) {
                $err = "resultUpdatePlace error: " . mysqli_error($con);
            } else {
                $err = "resultUpdatePlace query failed.";
            }
        }
        if ($checkStatus > 0) {
            $err = "All Coordinates data not inserted properly, Please check.";
        } else {
            $msg = "Coordinates data saved successfully.";
        }
    }
}



// Getting place data
$sqlGetPlace = "SELECT * FROM seat_place WHERE SP_id=$SP_id";
$resultGetPlace = mysqli_query($con, $sqlGetPlace);
if ($resultGetPlace) {
    $resultGetPlaceObj = mysqli_fetch_object($resultGetPlace);
    $place_title = $resultGetPlaceObj->SP_title;
    $Layout_image_name = $resultGetPlaceObj->SP_image;
    $Layout_color_image_name = $resultGetPlaceObj->SP_image_color;
} else {
    if (DEBUG) {
        $err = "resultGetPlace error: " . mysqli_error($con);
    } else {
        $err = "resultGetPlace query failed.";
    }
}

// Getting Coordinate data
$arrayCoordinates = array();
$sqlGetCoordinates = "SELECT * FROM seat_place_coordinate WHERE SPC_SP_id=$SP_id";
$resultGetCoordinates = mysqli_query($con, $sqlGetCoordinates);
if ($resultGetCoordinates) {
    while ($resultGetCoordinatesObj = mysqli_fetch_object($resultGetCoordinates)) {
        $arrayCoordinates[] = $resultGetCoordinatesObj;
    }
} else {
    if (DEBUG) {
        $err = "resultGetPlace error: " . mysqli_error($con);
    } else {
        $err = "resultGetPlace query failed.";
    }
}
//debug($arrayCoordinates);
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <?php include basePath('admin/header_script.php'); ?>	
        <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
    </head>
    <body class="">
        <?php include basePath('admin/header.php'); ?>

        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Edit Place</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" enctype="multipart/form-data">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-12">


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Place Title</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="form_field_title" value="<?php echo $place_title; ?>" name="place_title" type="text" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Place Layout Image</label>
                                        <div class="col-md-8">
                                            <input name="place_image" type="file" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <img src="<?php echo baseUrl("upload/place_layout/") ?><?php echo $Layout_image_name; ?>" width="80px" height="50px;"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Place Layout Color Image</label>
                                        <div class="col-md-8">
                                            <input name="place_color_image" type="file" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <img src="<?php echo baseUrl("upload/place_color_image/") ?><?php echo $Layout_color_image_name; ?>" width="80px" height="50px;"  />
                                        </div>
                                    </div>


                                    <hr class="separator" />
                                    <div class="alert alert-info fade in">
                                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
                                        <p># For Shape Type <strong>"Rectangle"</strong> Coordinates will be like <strong>"x1,y1,x2,y2"</strong></p>
                                        <p># For Shape Type <strong>"Circle"</strong> Coordinates will be like <strong>"x,y,radius"</strong></p>
                                        <p># For Shape Type <strong>"Polygon"</strong> Coordinates will be like <strong>"x1,y1,x2,y2,..,xn,yn"</strong></p>
                                    </div>


                                    <span id="total_field">
                                        <?php $count = 0; ?>
                                        <?php if (count($arrayCoordinates) > 0): ?>
                                            <?php foreach ($arrayCoordinates AS $coordinate): ?>
                                                <div class="row field-add">
                                                    <div class="col-md-6">
                                                        <div class="form-group">

                                                            <input type="hidden" name="coordinate_id_<?php echo $count; ?>" value="<?php echo $coordinate->SPC_id; ?>" />
                                                            <label class="col-md-4 control-label" for="type">Shape Type</label>
                                                            <div class="col-md-8">
                                                                <select class="form-control" id="form_field_type" name="shape_type_<?php echo $count; ?>">
                                                                    <option value="0">Select Shape Type</option>
                                                                    <option value="rect"<?php
                                                                    if ($coordinate->SPC_shape_type == "rect") {
                                                                        echo "selected = 'selected'";
                                                                    }
                                                                    ?>>Rectangle</option>
                                                                    <option value="circle"<?php
                                                                    if ($coordinate->SPC_shape_type == "circle") {
                                                                        echo "selected = 'selected'";
                                                                    }
                                                                    ?>>Circle</option>
                                                                    <option value="poly"<?php
                                                                    if ($coordinate->SPC_shape_type == "poly") {
                                                                        echo "selected = 'selected'";
                                                                    }
                                                                    ?>>Polygon</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Shape Coordinates</label>
                                                            <div class="col-md-8"><input class="form-control" id="form_field_given_id" name="shape_coordinate_<?php echo $count; ?>" type="text" value="<?php echo $coordinate->SPC_coordinates; ?>"  /></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Shape Title</label>
                                                            <div class="col-md-8"><input class="form-control" id="form_field_title" name="shape_title_<?php echo $count; ?>" type="text" value="<?php echo $coordinate->SPC_title; ?>"/></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $count++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </span>


                                    <button onclick="javascript:generateFieldDiv();" type="button" name="addMore" id="addMore" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> Add Another Field</button>
                                </div>
                            </div>


                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreatePlace" name="btnCreatePlace" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Plan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->

    <script type="text/javascript">
        function generateFieldDiv() {
            // Field Generate Function
            var count = $('div.field-add').length;
            var fieldHTML = '';
            if (count + 1 > 20) {
                alert("You cant add more than 20 field in a form.")
            } else {
                fieldHTML += '<div id="fieldDIV' + (count + 1) + '" class="row field-add">';
                fieldHTML += '<div class="col-md-12">';
                fieldHTML += '<button onclick="javascript:closeDiv(' + (count + 1) + ');" type="button" class="remove_btn close" aria-hidden="true">&times;</button>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-md-6">';
                fieldHTML += '<div class="form-group">';
                fieldHTML += '<label class="col-md-4 control-label" for="type">Shape Type</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<select class="form-control" id="form_field_type" name="shape_type_' + (count) + '">';
                fieldHTML += '<option value="0">Select Shape Type</option>';
                fieldHTML += '<option value="rect">Rectangle</option>';
                fieldHTML += '<option value="circle">Circle</option>';
                fieldHTML += '<option value="poly">Polygon</option>';
                fieldHTML += '</select>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="form-group">';
                fieldHTML += '<label class="col-md-4 control-label">Shape Coordinates</label>';
                fieldHTML += '<div class="col-md-8"><input class="form-control" id="form_field_given_id" name="shape_coordinate_' + (count) + '" type="text" /></div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-md-6">';
                fieldHTML += '<div class="form-group">';
                fieldHTML += '<label class="col-md-4 control-label">Shape Title</label>';
                fieldHTML += '<div class="col-md-8"><input class="form-control" id="form_field_title" name="shape_title_' + (count) + '" type="text" /></div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';



            }
            $("#total_field").append(fieldHTML);
        }

        // Remove Field Function
        function closeDiv(id) {
            $("#fieldDIV" + id).remove();
        }
    </script>
    <script type="text/javascript">
        $("#placeList").addClass("active");
        $("#placeList").parent().parent().addClass("active");
        $("#placeList").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>