
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
$category_updated_by = "";
$category_color_hit = "";

if (isset($_GET["category_id"])) {
    $category_id = $_GET["category_id"];
}
$get_category_sql = "SELECT * FROM categories WHERE category_id = '$category_id'";
$get_category_sql_run = mysqli_query($con, $get_category_sql);
$count_category = mysqli_num_rows($get_category_sql_run);
if ($count_category > 0) {
    while ($row = mysqli_fetch_object($get_category_sql_run)) {
        $category_title = $row->category_title;
        $category_description = $row->category_description;
        $category_color = $row->category_color;
        $category_priority = $row->category_priority;
        $category_parent_id = $row->category_parent_id;
    }
}

if (isset($_POST["btnEdit"])) {
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
        $category_updated_by = getSession("admin_id");
        $category_type = "custom";

        $category_color = "#" . $category_color_hit;

        $check_category_sql = "SELECT * FROM categories WHERE category_title = '$category_title' AND category_id NOT IN (" . $category_id . ")";
        $check_category = mysqli_query($con, $check_category_sql);
        $category_count = mysqli_num_rows($check_category);
        if ($category_count >= 1) {
            $err = "Category title already exists";
        } else {


            $update_query = '';
            $update_query .=' category_title = "' . $category_title . '"';
            $update_query .=', category_description = "' . $category_description . '"';
            $update_query .=', category_color = "' . $category_color . '"';
            $update_query .=', category_priority = "' . $category_priority . '"';
            $update_query .=', category_parent_id ="' . $category_parent_id . '"';
            $update_query .=', category_updated_by ="' . $category_updated_by . '"';
            $update_query .=', category_type ="' . $category_type . '"';

            $run_update_query = "UPDATE categories SET $update_query WHERE category_id = $category_id";

            $result = mysqli_query($con, $run_update_query);
            if (!$result) {
                if (DEBUG) {
                    $err = "run_update_query error: " . mysqli_error($con);
                } else {
                    $err = "run_update_query for category failed.";
                }
            } else {
                $msg = "Category updated successfully";
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
                var category_id = jQuery("#category_id").val();
                console.log(category_id);
                jQuery.getJSON("get_category.php", function (data) {
                    console.log(data);
                    if (data !== "[]") {
                        var inlineDefault = new kendo.data.HierarchicalDataSource({
                            data: data
                        });
                        var treeView = $("#treeview").kendoTreeView({
                            dataSource: inlineDefault,
                            template: kendo.template(jQuery("#treeview-template").html())
                        });
                        var dataItem = treeView.get(category_id); // find item with id = 4
                        var $selected = treeview.findByUid(dataItem.uid);
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
            # var catID = <?php echo $category_parent_id; ?> #
            <input type='radio' id='cat_#= item.category_id #' # if(item.category_id == catID){# checked='checked' # } # name='category_parent_id' 
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Edit Category</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>"/>

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
                                                <li><input type="radio" name="category_parent_id" value="0" <?php
                                                    if ($category_parent_id == 0) {
                                                        echo "checked='checked'";
                                                    }
                                                    ?> />Root Category</li>
                                            </ul>
                                            <div id="treeview"></div> 
                                        </div>

                                    </div>
                                    <div id="result"></div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit" name="btnEdit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Category</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#catlist").addClass("active");
        $("#catlist").parent().parent().addClass("active");
        $("#catlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>