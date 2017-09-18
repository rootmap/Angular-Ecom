<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';
$clients_name = "";
$clients_contact_num = "";
$clients_email = "";
$clients_address = "";
$clients_details = "";
$clients_link = "";
$clients_image = "";
$clients_created_by = "";
$clients_created_on = "";


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
    $clients_contact_num = mysqli_real_escape_string($con, $clients_contact_num);
    $clients_email = mysqli_real_escape_string($con, $clients_email);
    $clients_address = mysqli_real_escape_string($con, $clients_address);
    $clients_link = mysqli_real_escape_string($con, $clients_link);
    $clients_details = mysqli_real_escape_string($con, $clients_details);
    $clients_image = mysqli_real_escape_string($con, $clients_image);
    $clients_created_by = getSession("admin_id");
    $clients_created_on = date("Y-m-d H:i:s");

    $insert_ClientArray = '';
    $insert_ClientArray .= ' clients_name = "' . $clients_name . '"';
    $insert_ClientArray .= ', client_phone = "' . $clients_contact_num . '"';
    $insert_ClientArray .= ', client_email = "' . $clients_email . '"';
    $insert_ClientArray .= ', client_address = "' . $clients_address . '"';
    $insert_ClientArray .= ', clients_link = "' . $clients_link . '"';
    $insert_ClientArray .= ', clients_details = "' . $clients_details . '"';
    $insert_ClientArray .= ', clients_image = "' . $clients_image . '"';
    $insert_ClientArray .= ', clients_created_by = "' . $clients_created_by . '"';
    $insert_ClientArray .= ', clients_created_on = "' . $clients_created_on . '"';

    $checkClient = "SELECT * FROM clients WHERE clients_name = '$clients_name'";
    $checkClientResult = mysqli_query($con, $checkClient);
    $countClient = mysqli_num_rows($checkClientResult);
    if ($countClient >= 1) {
        $err = "Client name already exists";
    } else {
        $run_insert_ClientArray = "INSERT INTO clients SET $insert_ClientArray";
        $resultClientInsert = mysqli_query($con, $run_insert_ClientArray);

        if ($resultClientInsert) {
            $msg = "Client saved successfully";
            $link = "client_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "resultClientInsert error: " . mysqli_error($con);
            } else {
                $err = "resultClientInsert query failed.";
            }
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
            <h3 class="bg-white content-heading border-bottom strong">Add Clients</h3>
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
                                        <label class="col-md-4 control-label">Client Contact Number</label>
                                        <div class="col-md-8"><input class="form-control" id="clients_contact_num" name="clients_contact_num" value="<?php echo $clients_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Client Email</label>
                                        <div class="col-md-8"><input class="form-control" id="clients_email" name="clients_email" value="<?php echo $clients_name; ?>" type="email"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Client Address</label>
                                        <div class="col-md-8"><textarea id="clients_address" name="clients_address" rows="3" cols="61"style="border:1px solid #E5E5E5;"><?php echo $clients_address; ?></textarea></div>
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
                                        <label class="col-md-4 control-label">Client Details</label>
                                        <div class="col-md-8"><textarea id="clients_details" name="clients_details" rows="3" cols="30"><?php echo html_entity_decode($clients_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateClient" name="btnCreateClient" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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
                var clients_contact_num = $("#clients_contact_num").val();
                var clients_email = $("clients_email").val();
                var clients_address = $("clients_address").val();
                var clients_image = $("#clients_image").val();
                var clients_link = $("#clients_link").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;
                if (clients_name === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client name required</em></strong></div>');
                } else if (clients_contact_num === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client contact number required</em></strong></div>');
                } else if (clients_email === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client email required</em></strong></div>');
                } else if (clients_address === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client address required</em></strong></div>');
                } else if (clients_image === "") {
                    $("#clientError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Client image required</em></strong></div>');
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