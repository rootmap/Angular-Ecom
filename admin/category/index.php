<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$category_title = "";
$category_description = "";
$category_priority = "";
$category_parent_id = "";
$category_color = "";
$category_type = "";
$category_created_by = "";
$category_created_on = "";
$category_color_hit = "";


if (isset($_POST["btnSave"])) {
    extract($_POST);
    if (empty($category_title)) {
        $err = "Enter category title";
    } elseif (empty($category_description)) {
        $err = "Enter category description";
    } elseif (empty($category_color)) {
        $err = "Select category color";
    } elseif (empty($category_priority)) {
        $err = "Enter category priority";
    } else {
        $category_title = mysqli_real_escape_string($con, $category_title);
        $category_description = mysqli_real_escape_string($con, $category_description);
        $category_color_hit = mysqli_real_escape_string($con, $category_color);
        $category_priority = mysqli_real_escape_string($con, $category_priority);
        $category_parent_id = mysqli_real_escape_string($con, $category_parent_id);
        $category_created_by = getSession("admin_id");
        $category_created_on = date("Y-m-d H:i:s");
        $category_type = "custom";

        $category_color = "#" . $category_color_hit;

        $check_category_sql = "SELECT * FROM categories WHERE category_title = '$category_title'";
        $check_category = mysqli_query($con, $check_category_sql);
        $category_count = mysqli_num_rows($check_category);
        if ($category_count >= 1) {
            $err = "Category title already exists";
        } else {
            $insert_query = '';
            $insert_query .=' category_title = "' . $category_title . '"';
            $insert_query .=', category_description = "' . $category_description . '"';
            $insert_query .=', category_color = "' . $category_color . '"';
            $insert_query .=', category_priority = "' . $category_priority . '"';
            $insert_query .=', category_parent_id ="' . $category_parent_id . '"';
            $insert_query .=', category_created_by ="' . $category_created_by . '"';
            $insert_query .=', category_created_on ="' . $category_created_on . '"';
            $insert_query .=', category_type ="' . $category_type . '"';

            $run_insert_query = "INSERT INTO categories SET $insert_query";
            $result = mysqli_query($con, $run_insert_query);


            if (!$result) {
                if (DEBUG) {
                    $err = "run_insert_query error: " . mysqli_error($con);
                } else {
                    $err = "run_insert_query for category failed.";
                }
            } else {
                $msg = "Category added successfully";
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
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                jQuery.getJSON("get_category.php", function (data) {
                    console.log(data);
                    if (data !== "[]") {
                        var inlineDefault = new kendo.data.HierarchicalDataSource({
                            data: data
                        });
                        $("#treeview").kendoTreeView({
                            dataSource: inlineDefault,
                            template: kendo.template(jQuery("#treeview-template").html())
                        });
                    } else {
                        $("#treeview").html("");
                    }
                });
            });
        </script>
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
        <script id="treeview-template" type="text/kendo-ui-template">
            <input type='radio' name='category_parent_id' 
            value='#= item.category_id #' />#= item.category_title #
        </script>
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Category</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryTitle">Category Title</label>
                                        <div class="col-md-8"><input class="form-control" id="category_title" name="category_title" value="<?php echo $category_title; ?>" type="text"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryDescription">Category Description</label>
                                        <div class="col-md-8">
                                            <textarea name="category_description" id="category_description" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $category_description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryColor">Category Color</label>
                                        <div class="col-md-8"><input type="text" class="pick-a-color form-control" id="category_color" name="category_color" value="<?php echo $category_color; ?>"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="categoryPriority">Category Priority</label>
                                        <div class="col-md-4"><input class="form-control" id="category_priority" name="category_priority" value="<?php echo $category_priority; ?>" type="number" min="0"/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="parentCategory">Parent Category</label>
                                        <div class="col-md-8">
                                            <ul style="list-style: none;">
                                                <li><input type="radio" name="category_parent_id" value="0"/>Root Category</li>
                                            </ul>
                                            <div id="treeview">
                                            </div> 
                                        </div>
                                    </div>
                                    <div id="result"></div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnSave" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add Category</button>
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
        $("#catlist").addClass("active");
        $("#catlist").parent().parent().addClass("active");
        $("#catlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>