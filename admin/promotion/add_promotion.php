<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$promotion_title = "";
$promotion_description = "";
$promotion_image = "";
$promotion_code_prefix = "";
$promotion_code_suffix = "";
$promotion_code_predefined_user = "";
$promotion_code_use_type = "";
$promotion_discount_type = "";
$promotion_expire = "";
$promotion_status = "";
$promotion_number_of_code = "";
$PC_promotion_id = 0;
$PC_code = "";
$PC_code_use_type = "";
$PC_code_status = "";
$promotion_discount_amount = "";
$promotion_multiple_count = 0;

if (isset($_POST['promotion_title'])) {
    extract($_POST);

    $promotion_title = validateInput($promotion_title);
    $promotion_code_prefix = validateInput($promotion_code_prefix);
    $promotion_code_suffix = validateInput($promotion_code_suffix);
    $promotion_code_predefined_user = validateInput($promotion_code_predefined_user);
    if (!$promotion_code_predefined_user OR $promotion_code_predefined_user != "yes") {
        $promotion_code_predefined_user = 'no';
    }
    $promotion_description = validateInput($promotion_description);
    $promotion_discount_type = validateInput($promotion_discount_type);
    $promotion_status = validateInput($promotion_status);
    $promotion_expire_date = validateInput($promotion_expire);
    $date = date_create("$promotion_expire_date");
    $promotion_expire = date_format($date, "Y-m-d");
    $promotion_discount_amount = validateInput($promotion_discount_amount);
    $promotion_code_use_type = validateInput($promotion_code_use_type);
    $promotion_number_of_code = validateInput($promotion_number_of_code);
    $promotion_multiple_count = validateInput($promotion_multiple_count);

    if ($promotion_code_use_type == "multiple") {
        $promotion_number_of_code = 1;
    }
    
    $promotionArray = '';
    $promotionArray .= ' promotion_title = "' . $promotion_title . '"';
    $promotionArray .= ', promotion_code_prefix = "' . $promotion_code_prefix . '"';
    $promotionArray .= ', promotion_code_suffix = "' . $promotion_code_suffix . '"';
    $promotionArray .= ', promotion_code_predefined_user = "' . $promotion_code_predefined_user . '"';
    $promotionArray .= ', promotion_code_use_type = "' . $promotion_code_use_type . '"';
    $promotionArray .= ', promotion_description = "' . $promotion_description . '"';
    $promotionArray .= ', promotion_status = "' . $promotion_status . '"';
    $promotionArray .= ', promotion_expire = "' . $promotion_expire . '"';
    $promotionArray .= ', promotion_discount_type = "' . $promotion_discount_type . '"';
    $promotionArray .= ', promotion_discount_amount = "' . $promotion_discount_amount . '"';
    $promotionArray .= ', promotion_number_of_code = "' . $promotion_number_of_code . '"';
    $promotionArray .= ', promotion_multiple_count = "' . $promotion_multiple_count . '"';


    $sqlInsertPromotion = "INSERT INTO promotions SET $promotionArray";
    $resultInsertPromotion = mysqli_query($con, $sqlInsertPromotion);

    if ($resultInsertPromotion) {
        $PC_promotion_id = mysqli_insert_id($con);

        for ($i = 0; $i < $promotion_number_of_code; $i++) {
            $PC_code = $promotion_code_prefix . rand(10000, 19999) . $promotion_code_suffix;
            $PC_code_use_type = $promotion_code_use_type;
            if ($promotion_code_predefined_user === 'yes') {
                $PC_code_status = 'inactive';
            } else {
                $PC_code_status = 'active';
            }

            $PCArray = '';
            $PCArray .= ' PC_promotion_id = "' . $PC_promotion_id . '"';
            $PCArray .= ', PC_code = "' . $PC_code . '"';
            $PCArray .= ', PC_code_use_type = "' . $PC_code_use_type . '"';
            $PCArray .= ', PC_code_status = "' . $PC_code_status . '"';

            $sqlInsertPC = "INSERT INTO promotion_codes SET $PCArray";
            $runInsertPC = mysqli_query($con, $sqlInsertPC);

            if ($runInsertPC) {
                $msg = "Promotion added successfully";
                $link = "promotion_list.php?msg=" . base64_encode($msg);
                redirect($link);
            } else {
                $err = "Promotion code entry error";
            }
        }
    } else {
        if (DEBUG) {
            $err = "resultInsertPromotion error: " . mysqli_error($con);
        } else {
            $err = "resultInsertPromotion query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Add Promotion</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createPromotion" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="promotionError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Title</label>
                                        <div class="col-md-8"><input class="form-control" id="promotion_title" name="promotion_title" value="<?php echo $promotion_title; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Prefix</label>
                                        <div class="col-md-8"><input class="form-control" id="promotion_code_prefix" name="promotion_code_prefix" value="<?php echo $promotion_code_prefix; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Suffix</label>
                                        <div class="col-md-8"><input class="form-control" id="promotion_code_suffix" name="promotion_code_suffix" value="<?php echo $promotion_code_suffix; ?>" type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" style="margin-top: -8px;">Promotion Predefined User</label>
                                        <div class="col-md-8">
                                            <input type="checkbox" name="promotion_code_predefined_user" id="promotion_code_predefined_user" value="yes" <?php
                                            if ($promotion_code_predefined_user == 'yes') {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Use Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="promotion_code_use_type" name="promotion_code_use_type" onchange="javascript:showMultipleCountDiv(this.value);">
                                                <option value="0">Select Type</option>
                                                <option value="single">Single</option>
                                                <option value="multiple">Multiple</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group" id="showMultipleCount" style="display: none;">
                                        <label class="col-md-4 control-label">Promotion Multiple Count</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="promotion_multiple_count" name="promotion_multiple_count" value="<?php echo $promotion_multiple_count; ?>" type="number" min="0"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Discount Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="promotion_discount_type" name="promotion_discount_type">
                                                <option value="0">Select Type</option>
                                                <option value="percentage">Percentage</option>
                                                <option value="fix">Fix</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Discount Amount</label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="promotion_discount_amount" name="promotion_discount_amount" value="<?php echo $promotion_discount_amount; ?>" type="number"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Expire Date</label>
                                        <div class="col-md-8">
                                            <input id="promotion_expire" name="promotion_expire" value="<?php echo $promotion_expire; ?>"/>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Details</label>
                                        <div class="col-md-8"><textarea id="promotion_description" name="promotion_description" rows="3" cols="30"><?php echo html_entity_decode($promotion_description, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="promotion_status" name="promotion_status">
                                                <option value="0">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="archive">Archive</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group" id="showCode">
                                        <label class="col-md-4 control-label">How Many Codes</label>
                                        <div class="col-md-8"><input type="number" required="required" class="form-control" name="promotion_number_of_code" id="promotion_number_of_code" value="<?php echo $promotion_number_of_code; ?>"/></div>
                                    </div>

                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreatePromotion" name="btnCreatePromotion" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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
            $("#promotion_description").kendoEditor({
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
        $("#promotionlist").addClass("active");
        $("#promotionlist").parent().parent().addClass("active");
        $("#promotionlist").parent().addClass("in");
    </script>
    <script>
        $(document).ready(function () {
            $("#promotion_expire").kendoDatePicker();
        });
    </script>
    <script type="text/javascript">
        function showMultipleCountDiv(type) {
            var showDiv = type;
            if (showDiv === 'multiple') {
                $("#showMultipleCount").show();
                $("#showCode").hide();
            } else {
                $("#showMultipleCount").hide();
                $("#showCode").show();
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreatePromotion").click(function () {
                var promotion_title = $("#promotion_title").val();
                var promotion_code_prefix = $("#promotion_code_prefix").val();
                var promotion_code_use_type = $("#promotion_code_use_type").val();
                var promotion_discount_type = $("#promotion_discount_type").val();
                var promotion_discount_amount = $("#promotion_discount_amount").val();
                var promotion_expire = $("#promotion_expire").val();
                var promotion_status = $("#promotion_status").val();
                var promotion_number_of_code = $("#promotion_number_of_code").val();
                var promotion_multiple_count = $("#promotion_multiple_count").val();

                if (promotion_title === "") {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion title required</em></strong></div>');
                } else if (promotion_code_prefix === "") {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion code prefix required</em></strong></div>');
                } else if (promotion_code_use_type === '0') {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion code use type required</em></strong></div>');
                } else if (promotion_code_use_type === 'multiple') {
                    if (promotion_multiple_count === "") {
                        $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion multiple count required</em></strong></div>');
                    } else {
                        $("#createPromotion").submit();
                    }
                } else if (promotion_discount_type === '0') {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion discount type required</em></strong></div>');
                } else if (promotion_discount_amount === "") {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion discount amount required</em></strong></div>');
                } else if (promotion_expire === "") {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion expire date required</em></strong></div>');
                } else if (promotion_status === '0') {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Promotion status required</em></strong></div>');
                } else if (promotion_number_of_code === "") {
                    $("#promotionError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Number of promotion code required</em></strong></div>');
                } else {
                    $("#createPromotion").submit();
                }
            });
        });
    </script>



    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>