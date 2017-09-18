<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$tag_title = "";
$tag_color = "";

if (isset($_POST['btnTag'])) {
    extract($_POST);
    
    if (empty($tag_title)) {
        $err = "Enter tag title";
    }elseif (empty ($tag_color)) {
        $err = "Select tag color";
    } else {
        $tag_title = mysqli_real_escape_string($con, $tag_title);
        $tag_color_hit = mysqli_real_escape_string($con, $tag_color);
        $tag_color = "#".$tag_color_hit;

        $checkTag = "SELECT * FROM tags WHERE tag_title = '$tag_title'";
        $resultTag = mysqli_query($con, $checkTag);
        $countTag = mysqli_num_rows($resultTag);

        if ($countTag >= 1) {
            $err = "Tag title already exists";
        } else {
            $insertTag = '';
            $insertTag .=' tag_title = "' . $tag_title . '"';
            $insertTag .=' ,tag_color = "' . $tag_color . '"';

            $run_insert_query = "INSERT INTO tags SET $insertTag";
            $result = mysqli_query($con, $run_insert_query);

            if (!$result) {
               if (DEBUG) {
                    $err = "run_insert_query error: " . mysqli_error($con);
                } else {
                    $err = "run_insert_query query failed.";
                }
            } else {
                $msg = "Tag added successfully";
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
        <style type="text/css">
            .pick-a-color-markup {
                margin:5px 0px;
            }
            .container {
                margin: 0px 5px;
                width: 50%;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".pick-a-color").pickAColor({
                    showSpectrum: true,
                    showSavedColors: true,
                    saveColorsPerElement: true,
                    fadeMenuToggle: true,
                    showAdvanced: true,
                    showBasicColors: true,
                    showHexInput: true,
                    allowBlank: true,
                    inlineDropdown: true
                });
            });
        </script>

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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Create Tag</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Tag Title</label>
                                        <div class="col-md-8"><input class="form-control" id="tag_title" name="tag_title" value="<?php echo $tag_title; ?>" type="text"/></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Tag Color</label>
                                        <div class="col-md-8"><input type="text" class="pick-a-color form-control" id="tag_color" name="tag_color" value="<?php echo $tag_color; ?>"></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnTag" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add Tag</button>
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
        $("#taglist").addClass("active");
        $("#taglist").parent().parent().addClass("active");
        $("#taglist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>