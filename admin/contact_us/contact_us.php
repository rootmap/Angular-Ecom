
<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

$CU_id = "";
//$item_description = "";
$CU_name = "";
//$item_file = "";
$CU_email = "";
//$CU_phone = "";
$CU_subject = "";
$CU_message = "";
//$VG_description = "";
//$VG_video_link = "";
//$VG_created_on = "";
//$VG_created_by = "";
//$IG_event_id = "";
//$IG_title = "";
//$IG_description = "";
//$IG_created_on = "";
//$IG_created_by = "";
//$image_file = array();
//$last_image_id = 0;
//$CU_id = 0;
//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
$arrcont = array();
$sqlcontact = "SELECT * FROM contact_us";
$resultconta = mysqli_query($con, $sqlcontact);

if ($resultconta) {
    while ($obj = mysqli_fetch_object($resultconta)) {
        $arrcont[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "result contact us Data error: " . mysqli_error($con);
    } else {
        $err = "result contact us Data query failed.";
    }
}



if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start

    $CU_name = mysqli_real_escape_string($con, $name);
    $CU_email = mysqli_real_escape_string($con, $email);
    //$CU_phone = mysqli_real_escape_string($con, $CU_phone);
    $CU_subject = mysqli_real_escape_string($con, $subject);
    $CU_message = mysqli_real_escape_string($con, $message);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'CU_name = "' . $CU_name . '"';
    $insert_eedc_array .= ',CU_email = "' . $CU_email . '"';
    //$insert_eedc_array .= ',CU_phone = "' . $CU_phone . '"';
    $insert_eedc_array .= ',CU_subject = "' . $CU_subject . '"';
    $insert_eedc_array .= ',CU_message = "' . $CU_message . '"';

    $run_eedc_array_sql = "INSERT INTO contact_us SET $insert_eedc_array";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_contact_us_sql error: " . mysqli_error($con);
        } else {
            $err = "run_contact_us_sql query failed.";
        }
    } else {
        $msg = "contact data saved successfully";
        $link = "contact_us_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for discount start
if (isset($_POST["btneditGallery"])) {
    extract($_POST);

    //echo var_dump($_POST);
    //exit();
    // video link save start
    $id = mysqli_real_escape_string($con, $id);
    $CU_name = mysqli_real_escape_string($con, $name);
    $CU_email = mysqli_real_escape_string($con, $email);
//    $CU_phone = mysqli_real_escape_string($con, $CU_phone);
    $CU_subject = mysqli_real_escape_string($con, $subject);
    $CU_message = mysqli_real_escape_string($con, $message);
    $VG_created_on = date("Y-m-d");
    //$VG_created_by = getSession("admin_id");

    $insert_eedc_array = '';
    $insert_eedc_array .= 'CU_name = "' . $CU_name . '"';
    $insert_eedc_array .= ',CU_email = "' . $CU_email . '"';
    //$insert_eedc_array .= ',CU_phone = "' . $CU_phone . '"';
    $insert_eedc_array .= ',CU_subject = "' . $CU_subject . '"';
    $insert_eedc_array .= ',CU_message = "' . $CU_message . '"';

    $run_eedc_array_sql = "UPDATE contact_us SET $insert_eedc_array WHERE CU_id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);

    if (!$result) {
        if (DEBUG) {
            $err = "run_contact_us_sql error: " . mysqli_error($con);
        } else {
            $err = "run_contact_us_sql query failed.";
        }
    } else {
        $msg = "contact Edit data saved successfully";
        $link = "contact_us_list.php?msg=" . base64_encode($msg);
        redirect($link);
    }
    // Video link save end
    // Image file save start
    // Image file save end
}
//update option for discount end
//edit option for discount start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $contsql = "SELECT * FROM contact_us WHERE CU_id = '" . $id . "'";
    $contarray = array();
    $sqlcont = mysqli_query($con, $contsql);
    $countchk = mysqli_num_rows($sqlcont);
    if ($countchk != 0) {
        while ($countrow = mysqli_fetch_object($sqlcont)) {
            $contarray[] = $countrow;
        }
    }
}
//edit option for discount end
//    echo var_dump($contarray);
//    exit();
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
        <div id="content">

            <?php
                include basePath('admin/message.php');
                if(isset($_GET['id'])) {
                ?>
                <h3 class="bg-white content-heading border-bottom strong"> Edit Contact Us</h3>

                <div class="innerAll spacing-x2">
                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGallery" enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">



                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle">Name</label>
                                            <div class="col-md-8"><input class="form-control" id="name" name="name" type="text" value="<?php echo $contarray[0]->CU_name; ?>" /></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Email</label>
                                            <div class="col-md-8"><input class="form-control" id="email" name="email" type="text" value="<?php echo $contarray[0]->CU_email; ?>" /></div>

                                        </div>

                                     

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Subject</label>
                                            <div class="col-md-8"><input class="form-control" id="subject" name="subject" type="text" value="<?php echo $contarray[0]->CU_subject; ?>" /></div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">message</label>
                                            <div class="col-md-8"><textarea class="form-control" id="message" name="message"><?php echo $contarray[0]->CU_message; ?></textarea></div>

                                        </div>


                                        



                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>Update Record</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
               <?php } else { ?>


                <h3 class="bg-white content-heading border-bottom strong">Contact Us</h3>

                <div class="innerAll spacing-x2">

                     <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createGallery" enctype="multipart/form-data">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="galleryError"></div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle">Name</label>
                                            <div class="col-md-8"><input class="form-control" id="name" name="name"  type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Email</label>
                                            <div class="col-md-8"><input class="form-control" id="email" name="email"  type="text"/></div>

                                        </div>

                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-md-4 control-label" for="itemDescription">Phone</label>
                                                                                    <div class="col-md-8"><input class="form-control" id="eventwise_discount_amount" name="eventwise_discount_amount" value="<?php //echo $arrcont[0]->CU_phone;  ?>" type="text"/></div>
                                        
                                                                                </div>-->

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">Subject</label>
                                            <div class="col-md-8"><input class="form-control" id="subject" name="subject"  type="text"/></div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemDescription">message</label>
                                            <div class="col-md-8"><textarea class="form-control" id="message" name="message"></textarea></div>

                                        </div>



                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btnCreateEDC" name="btnCreateGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>


        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
<!--    <script>
        $(document).ready(function () {
            $("#item_description").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>-->



    <script type="text/javascript">
        $("#contactList").addClass("active");
        $("#contactList").parent().parent().addClass("active");
        $("#contactList").parent().addClass("in");
    </script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>

