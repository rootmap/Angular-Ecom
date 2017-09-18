<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

$PC_promotion_id = 0;
$PC_code = '';
$PC_code_use_type = '';
$PC_code_used_email = '';
$PC_code_status = '';


if(isset($_GET['promotion_id'])){
    $PC_promotion_id = $_GET['promotion_id'];
}
echo $PC_promotion_id;
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
            <h3 class="bg-white content-heading border-bottom strong">Add Promotion Code</h3>
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
                                        <label class="col-md-4 control-label">Promotion Code</label>
                                        <div class="col-md-8"><input class="form-control" id="PC_code" name="PC_code" value="<?php echo $PC_code; ?>" type="text"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Email</label>
                                        <div class="col-md-8"><input class="form-control" id="PC_code_used_email" name="PC_code_used_email" value="<?php echo $PC_code_used_email; ?>" type="text"/></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Use Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="PC_code_use_type" name="PC_code_use_type">
                                                <option value="0">Select Type</option>
                                                <option value="single">Single</option>
                                                <option value="multiple">Multiple</option>
                                            </select>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Promotion Code Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="PC_code_status" name="PC_code_status">
                                                <option value="0">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="applied">Applied</option>
                                                <option value="used">Used</option>
                                                <option value="archive">Archive</option>
                                            </select>

                                        </div>
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
    
    <script type="text/javascript">
        $("#promotionlist").addClass("active");
        $("#promotionlist").parent().parent().addClass("active");
        $("#promotionlist").parent().addClass("in");
    </script>
   
    <script type="text/javascript">
        
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>