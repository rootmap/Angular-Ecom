<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$announcement_id = 0;
if (isset($_GET['announcement_id'])) {
    $announcement_id = $_GET['announcement_id'];
    $announcement_id = validateInput($announcement_id);
}

$announcement_title = "";
$announcement_short_desc = "";
$announcement_long_desc = "";
$announcement_status = "";


if (isset($_POST["btnSave"])) {
    extract($_POST);
    if (empty($announcement_title)) {
        $err = "Enter Announcement Title";
    } elseif (empty($announcement_short_desc)) {
        $err = "Enter Announcement Short Description";
    } elseif (empty($announcement_long_desc)) {
        $err = "Select Announcement Long Description";
    } else {
        $announcement_title = mysqli_real_escape_string($con, $announcement_title);
        $announcement_short_desc = mysqli_real_escape_string($con, $announcement_short_desc);
        $announcement_long_desc = mysqli_real_escape_string($con, $announcement_long_desc);
        if (isset($announcement_status)) {
            $announcement_status = mysqli_real_escape_string($con, $announcement_status);
        }
        $announcement_created_by = getSession("admin_id");
        $announcement_created_on = date("Y-m-d H:i:s");

        $check_announce_sql = "SELECT * FROM announcements WHERE announcement_title = '$announcement_title' AND announcement_id NOT IN ($announcement_id)";
        $check_announce = mysqli_query($con, $check_announce_sql);
        $announce_count = mysqli_num_rows($check_announce);
        if ($announce_count >= 1) {
            $err = "Announcement already exists";
        } else {
            $update_query = '';
            $update_query .=' announcement_title = "' . $announcement_title . '"';
            $update_query .=', announcement_short_desc = "' . $announcement_short_desc . '"';
            $update_query .=', announcement_long_desc = "' . $announcement_long_desc . '"';
            if (isset($announcement_status)) {
                $update_query .=', announcement_status = "' . $announcement_status . '"';
            }
            $update_query .=', announcement_created_on ="' . $announcement_created_on . '"';
            $update_query .=', announcement_created_by ="' . $announcement_created_by . '"';

            $run_update_query = "UPDATE announcements SET $update_query WHERE announcement_id=$announcement_id";
            $result = mysqli_query($con, $run_update_query);


            if (!$result) {
                if (DEBUG) {
                    $err = "run_update_query error: " . mysqli_error($con);
                } else {
                    $err = "run_update_query for category failed.";
                }
            } else {
                $msg = "Announcement update successfully";
            }
        }
    }
}



if ($announcement_id > 0) {
    $sqlGetAnnounce = "SELECT * FROM announcements WHERE announcement_id=$announcement_id";
    $resultGetAnnounce = mysqli_query($con, $sqlGetAnnounce);
    if ($resultGetAnnounce) {
        $resultGetAnnounceObj = mysqli_fetch_object($resultGetAnnounce);
        if (isset($resultGetAnnounceObj->announcement_id)) {
            $announcement_title = $resultGetAnnounceObj->announcement_title;
            $announcement_short_desc = $resultGetAnnounceObj->announcement_short_desc;
            $announcement_long_desc = $resultGetAnnounceObj->announcement_long_desc;
            $announcement_status = $resultGetAnnounceObj->announcement_status;
        }
    } else {
        if (DEBUG) {
            $err = "resultGetAnnounce error: " . mysqli_error($con);
        } else {
            $err = "resultGetAnnounce for category failed.";
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Announcement</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryTitle">Announcement Title</label>
                                        <div class="col-md-8"><input class="form-control" id="announcement_title" name="announcement_title" value="<?php echo $announcement_title; ?>" type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryDescription">Announcement Short Description</label>
                                        <div class="col-md-8">
                                            <textarea name="announcement_short_desc" id="announcement_short_desc" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $announcement_short_desc; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryDescription">Announcement Long Description</label>
                                        <div class="col-md-8">
                                            <textarea id="announce_description" name="announcement_long_desc" rows="3" cols="30"><?php echo $announcement_long_desc; ?></textarea>
                                        </div>
                                    </div>
                                    <?php if (checkPermission('announce', 'status', getSession('admin_type'))): ?>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="categoryDescription">Announcement Status</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="announcement_status">
                                                    <option value="">Select Status</option>
                                                    <option value="active" <?php if($announcement_status == "active"){ echo "selected"; } ?>>Active</option>
                                                    <option value="inactive" <?php if($announcement_status == "inactive"){ echo "selected"; } ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div id="result"></div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnSave" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add Announcement</button>
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
        $("#announcelist").addClass("active");
        $("#announcelist").parent().parent().addClass("active");
        $("#announcelist").parent().addClass("in");
    </script>
    <script>
        $(document).ready(function () {
            $("#announce_description").kendoEditor({
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

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>