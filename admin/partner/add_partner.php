<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';
$partner_name = "";
$partner_details = "";
$partner_link = "";
$partner_image = "";
$partner_created_by = "";
$partner_created_on = "";


if (isset($_POST["partner_name"])) {
    extract($_POST);
    /*     * *************** partner Image Code start Here *********************** */

    if ($_FILES["partner_image"]["tmp_name"] != '') {

        /*         * ***Renaming the image file******** */

        $cli_image = basename($_FILES['partner_image']['name']);
        $info = pathinfo($cli_image, PATHINFO_EXTENSION); /* it will return me like jpeg, gif, pdf, png */
        $partner_image = 'Partner-' . date("Y-m-d-H-i-s") . '.' . $info; /* create custom image name color id will add  */
        $partner_image_source = $_FILES["partner_image"]["tmp_name"];
        /*         * *****Renaming the image file******** */

        if (!is_dir($config['IMAGE_UPLOAD_PATH'] . '/partner_image/')) {
            mkdir($config['IMAGE_UPLOAD_PATH'] . '/partner_image/', 0777, TRUE);
        }
        $image_target_path = $config['IMAGE_UPLOAD_PATH'] . '/partner_image/' . $partner_image;


        $zebra = new Zebra_Image();
        $zebra->source_path = $_FILES["partner_image"]["tmp_name"]; /* original image path */
        $zebra->target_path = $config['IMAGE_UPLOAD_PATH'] . '/partner_image/' . $partner_image;

        if (!$zebra->resize(300)) {
            zebraImageErrorHandaling($zebra->error);
        }
    }
    /*     * *************** partner Image Code End Here *********************** */

    $partner_name = mysqli_real_escape_string($con, $partner_name);
    $partner_link = mysqli_real_escape_string($con, $partner_link);
    $partner_details = mysqli_real_escape_string($con, $partner_details);
    $partner_image = mysqli_real_escape_string($con, $partner_image);
    $partner_created_by = getSession("admin_id");
    $partner_created_on = date("Y-m-d H:i:s");

    $insert_PartnerArray = '';
    $insert_PartnerArray .= ' partner_name = "' . $partner_name . '"';
    $insert_PartnerArray .= ', partner_link = "' . $partner_link . '"';
    $insert_PartnerArray .= ', partner_details = "' . $partner_details . '"';
    $insert_PartnerArray .= ', partner_image = "' . $partner_image . '"';
    $insert_PartnerArray .= ', partner_created_by = "' . $partner_created_by . '"';
    $insert_PartnerArray .= ', partner_created_on = "' . $partner_created_on . '"';

    $checkPartner = "SELECT * FROM partner WHERE partner_name = '$partner_name'";
    $checkPartnerResult = mysqli_query($con, $checkPartner);
    $countPartner = mysqli_num_rows($checkPartnerResult);
    if ($countPartner >= 1) {
        $err = "Partner name already exists";
    } else {
        $run_insert_PartnerArray = "INSERT INTO partner SET $insert_PartnerArray";
        $resultPartnerInsert = mysqli_query($con, $run_insert_PartnerArray);

        if ($resultPartnerInsert) {
            $msg = "Partner saved successfully";
            $link = "partner_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "resultPartnerInsert error: " . mysqli_error($con);
            } else {
                $err = "resultPartnerInsert query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Add Partner</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createPartner" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="partnerError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Partner Name</label>
                                        <div class="col-md-8"><input class="form-control" id="partner_name" name="partner_name" value="<?php echo $partner_name; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Partner Link</label>
                                        <div class="col-md-8"><input class="form-control" id="partner_link" name="partner_link" value="<?php echo $partner_link; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Partner Image</label>
                                        <div class="col-md-8">
                                            <input type="file" name="partner_image" id="partner_image"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Partner Details</label>
                                        <div class="col-md-8"><textarea id="partner_details" name="partner_details" rows="3" cols="30"><?php echo html_entity_decode($partner_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreatePartner" name="btnCreatePartner" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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
            $("#partner_details").kendoEditor({
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
        $("#partnermenu").addClass("active");
        $("#partnermenu").parent().parent().addClass("active");
        $("#partnermenu").parent().addClass("in");
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreatePartner").click(function () {
                var partner_name = $("#partner_name").val();
                var partner_image = $("#partner_image").val();
                var partner_link = $("#partner_link").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;
                if (partner_name === "") {
                    $("#partnerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Partner name required</em></strong></div>');
                } else if (partner_image === "") {
                    $("#partnerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Partner image required</em></strong></div>');
                } else if (partner_link !== "") {
                    if (URL_check.test(partner_link)) {
                        $("#createPartner").submit();
                    } else {
                        $("#partnerError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter valid URL link</em></strong></div>');
                    }
                } else {
                    $("#createPartner").submit();
                }
            });
        });

    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>