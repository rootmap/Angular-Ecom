
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';
$clients_id = 0;
$clients_name = "";
$clients_details = "";
$clients_link = "";
$clients_image = "";
$clients_updated_by = "";

if (isset($_GET['clients_id'])) {
    $clients_id = $_GET['clients_id'];
}

// Getting Image When Edit Image
$sqlImage = "SELECT clients_image FROM clients WHERE clients_id=$clients_id";
$resultImage = mysqli_query($con, $sqlImage);
if ($resultImage) {
    while ($ImageObj = mysqli_fetch_object($resultImage)) {
        $clients_image = $ImageObj->clients_image;
    }
} else {
    if (DEBUG) {
        $err = "resultImage error: " . mysqli_error($con);
    } else {
        $err = "resultImage query failed.";
    }
}

if (isset($_POST["clients_name"])) {
    extract($_POST);


    /*     * *************** Client Image Code start Here *********************** */

    if ($_FILES["clients_image"]["tmp_name"] != '') {

        /*         * ***Renaming the image file******** */

        $cli_image = basename($_FILES['clients_image']['name']);
        $info = pathinfo($cli_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $clients_image = 'Client-' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $client_image_source = $_FILES["clients_image"]["tmp_name"];
        /*         * *****Renaming the image file******** */

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/clients_image/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/clients_image/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/clients_image/' . $clients_image;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["clients_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/clients_image/' . $clients_image;

        if (!$zebra->resize(300)) {
            zebraImageErrorHandaling($zebra->error);
        }
    }
    /*     * *************** Client Image Code End Here *********************** */


    $clients_name = mysqli_real_escape_string($con, $clients_name);
    $clients_link = mysqli_real_escape_string($con, $clients_link);
    $clients_image = mysqli_real_escape_string($con, $clients_image);
    $clients_details = mysqli_real_escape_string($con, $clients_details);
    $clients_updated_by = getSession("admin_id");

    $update_ClientArray = '';
    $update_ClientArray .= ' clients_name = "' . $clients_name . '"';
    $update_ClientArray .= ', clients_link = "' . $clients_link . '"';
    $update_ClientArray .= ', clients_details = "' . $clients_details . '"';
    if ($_FILES["clients_image"]["tmp_name"] != '') {
        $update_ClientArray .= ', clients_image = "' . $clients_image . '"';
    }
    $update_ClientArray .= ', clients_updated_by = "' . $clients_updated_by . '"';


    $run_update_query = "UPDATE clients SET $update_ClientArray WHERE clients_id = $clients_id";
    $result = mysqli_query($con, $run_update_query);


    if ($result) {
        $msg = "Client updated successfully";
        $link = "client_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        if (DEBUG) {
            $err = "run_update_query error: " . mysqli_error($con);
        } else {
            $err = "run_update_query query failed.";
        }
    }
}



$sqlClients = "SELECT * FROM clients  WHERE clients_id = $clients_id";
$resultClient = mysqli_query($con, $sqlClients);
$countClient = mysqli_num_rows($resultClient);
if ($countClient > 0) {
    while ($ClientObj = mysqli_fetch_object($resultClient)) {
        $clients_name = $ClientObj->clients_name;
        $clients_link = $ClientObj->clients_link;
        $clients_details = $ClientObj->clients_details;
        $clients_image = $ClientObj->clients_image;
    }
} else {
    if (DEBUG) {
        $err = "resultClient error: " . mysqli_error($con);
    } else {
        $err = "resultClient query failed.";
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
        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Edit Client</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createClient" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="clientError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Client Name</label>
                                        <div class="col-md-8"><input class="form-control" id="clients_name" name="clients_name" value="<?php echo $clients_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Client Link</label>
                                        <div class="col-md-8"><input class="form-control" id="clients_link" name="clients_link" value="<?php echo $clients_link; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Client Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="clients_image" id="clients_image"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"></label>
                                        <div class="col-md-8">
                                            <img src="<?php echo baseUrl("upload/clients_image/") ?><?php echo $clients_image; ?>" width="80px" height="50px;"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Client Details</label>
                                        <div class="col-md-8"><textarea id="clients_details" name="clients_details" rows="3" cols="30"><?php echo html_entity_decode($clients_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateClient" name="btnCreateClient" class="btn btn-primary" ><i class="fa fa-edit"></i> Update</button>
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
    <script>
        $(document).ready(function () {
            $("#clients_details").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>
    <script type="text/javascript">
        $("#clientmenu").addClass("active");
        $("#clientmenu").parent().parent().addClass("active");
        $("#clientmenu").parent().addClass("in");
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateClient").click(function () {
                var clients_name = $("#clients_name").val();
                var clients_link = $("#clients_link").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;


                if (clients_name === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client name required</em></strong></div>');
                } else if (clients_link !== "") {
                    if (URL_check.test(clients_link)) {
                        $("#createClient").submit();
                    } else {
                        $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter valid URL link</em></strong></div>');
                    }
                } else {
                    $("#createClient").submit();
                }
            });
        });

    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>