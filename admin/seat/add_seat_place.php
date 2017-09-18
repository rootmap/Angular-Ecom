<?php
include '../../config/config.php';
$adminID = 0;
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $adminID = getSession('admin_id');
}

$place_title = '';
$shapeType = '';
$shapeTitle = '';
$shapeCoordinates = '';
$checkStatus = 0;
$SP_height = '';
$SP_width = '';
$SP_image_color = "";

if (isset($_POST['btnCreatePlace'])) {
    extract($_POST);

    if ($place_title == "") {
        $err = "Place Title is required.";
    } elseif ($_FILES["place_image"]["error"] == 4) {
        $err = "Place Layout Image is required.";
    } elseif ($_FILES["place_color_image"]["error"] == 4) {
        $err = "Place Layout Color Image is required.";
    } else {

        $dateTimeNow = date("Y-m-d H:i:s");

        /*         * *****Renaming the image file******** */
        $lastPlaceID = getMaxValue('seat_place', 'SP_id');
        $strPlaceTitleCln = clean($place_title);
        $Layout_image = basename($_FILES['place_image']['name']);
        $info = pathinfo($Layout_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $Layout_image_name = 'PlaceName-' . $strPlaceTitleCln . '-PlaceID-' . ($lastPlaceID + 1) . '.' . $info; /* create custom image name color id will add  */
        $image_source = $_FILES["place_image"]["tmp_name"];
        list($SP_width, $SP_height, $type, $attr) = getimagesize($_FILES["place_image"]['tmp_name']);
        /*         * *****Renaming the image file******** */


        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/place_layout/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/place_layout/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/place_layout/' . $Layout_image_name;

        // colour image upload start here

        $Layout_color_image = basename($_FILES['place_color_image']['name']);
        $info_color = pathinfo($Layout_color_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $Layout_color_image_name = 'PlaceName-' . $strPlaceTitleCln . '-PlaceID-' . ($lastPlaceID + 1) . '.' . $info_color; /* create custom image name color id will add  */
        $image_color_source = $_FILES["place_color_image"]["tmp_name"];
        list($SP_width, $SP_height, $type, $attr) = getimagesize($_FILES["place_color_image"]['tmp_name']);

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/place_color_image/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/place_color_image/', 0777, TRUE);
        }
        $image_target_path_color = $config['IMAGE_UPLOAD_PATH'] . '/place_color_image/' . $Layout_color_image_name;

        // colour image upload end here 

        if (move_uploaded_file($image_source, $image_target_path)) {
            if (move_uploaded_file($image_color_source, $image_target_path_color)) {
                $insertPlace = '';
                $insertPlace .=' SP_title = "' . validateInput($place_title) . '"';
                $insertPlace .=', SP_image = "' . validateInput($Layout_image_name) . '"';
                $insertPlace .=', SP_image_color = "' . validateInput($Layout_color_image_name) . '"';
                $insertPlace .=', SP_width = "' . validateInput($SP_width) . '"';
                $insertPlace .=', SP_height = "' . validateInput($SP_height) . '"';
                $insertPlace .=', SP_created_on = "' . validateInput($dateTimeNow) . '"';
                $insertPlace .=', SP_created_by = "' . validateInput($adminID) . '"';

                $sqlInsertPlace = "INSERT INTO seat_place SET $insertPlace";
                $resultInsertPlace = mysqli_query($con, $sqlInsertPlace);
                if ($resultInsertPlace) {
                    $msg = "Place information saved successfully.";
                    $SP_id = mysqli_insert_id($con);

                    for ($i = 0; $i < 20; $i++) {
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
                } else {
                    if (DEBUG) {
                        $err = "resultInsertPlace error: " . mysqli_error($con);
                    } else {
                        $err = "resultInsertPlace query failed.";
                    }
                }

                if ($checkStatus > 0) {
                    $err = "All Coordinates data not inserted properly, Please check.";
                } else {
                    $msg = "Coordinates data saved successfully.";
                }
            } else {
                $err = "Place Layout Color Image upload failed.";
            }
        } else {
            $err = "Place Layout Image upload failed.";
        }
    }
}
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Place</h3>

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
                                        <label class="col-md-4 control-label" for="questionFAQ">Place Layout Color Image</label>
                                        <div class="col-md-8">
                                            <input name="place_color_image" type="file" />
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
                                        <div class="row field-add">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label" for="type">Shape Type</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="form_field_type" name="shape_type_0">
                                                            <option value="0">Select Shape Type</option>
                                                            <option value="rect">Rectangle</option>
                                                            <option value="circle">Circle</option>
                                                            <option value="poly">Polygon</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Shape Coordinates</label>
                                                    <div class="col-md-8"><input class="form-control" id="form_field_given_id" name="shape_coordinate_0" type="text" /></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Shape Title</label>
                                                    <div class="col-md-8"><input class="form-control" id="form_field_title" name="shape_title_0" type="text" /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </span>

                                    <button onclick="javascript:generateFieldDiv();" type="button" name="addMore" id="addMore" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> Add Another Field</button>
                                </div>
                            </div>


                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreatePlace" name="btnCreatePlace" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Plan</button>
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
                alert("You cant add more than 20 fields in a form.")
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