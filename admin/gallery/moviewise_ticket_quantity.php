

<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

include '../../lib/Zebra_Image.php';

//$event_id = "";
//$item_description = "";
$movie_name = "";
//$item_file = "";
$type_quantity = "";
//$VG_event_id = "";
//$VG_title = "";
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
//$cityname_id = 0;
//var event_id = $("#event_id").val(); var event_cost_title = $("#event_cost_title").val(); var event_cost = $("#event_cost").val();
//if (isset($_GET["event_id"])) {
//    $event_id = mysqli_real_escape_string($con, $_GET["event_id"]);
//}
$movietqarray = array();
$movietqssql = "SELECT movie_id,name FROM event_movie_list";
$movietqresult = mysqli_query($con, $movietqssql);
if ($movietqresult) {
    while ($movietqobj = mysqli_fetch_object($movietqresult)) {
        $movietqarray[] = $movietqobj;
    }
} else {
    if (DEBUG) {
        $err = "resultMovie error: " . mysqli_error($con);
    } else {
        $err = "resultMovie query failed.";
    }
}


//$cityarray = array();
//$citysql = "SELECT city_id,city_name FROM cities";
//$cityquery = mysqli_query($con, $citysql);
//$citycheck = mysqli_num_rows($cityquery);
//if ($citycheck != 0) {
//    while ($cityrow = mysqli_fetch_object($cityquery)) {
//        $cityarray[] = $cityrow;
//    }
//}
//UPDATE moviewise ticket Quantity start
if (isset($_POST["btneditGallery"])) {
    extract($_POST);
    //alert sms show 
    if (empty($movie_name) || empty($type_quantity)) {
        $err = "Please select a movie name and type quantity Edit";
    }

    if (!empty($movie_name) && !empty($type_quantity)) { //alert sms show data exit already
        $insert_iteam = "";
        $insert_iteam .= "movie_id= '" . $movie_name . "'";
        $insert_iteam .= ",user_quantity_limit = '" . $type_quantity . "'";
        $insert_iteam .= ",date = '" . date('Y-m-d') . "'";
        $insert_iteam .= ",status = '1'";
        $sql_insert_iteam = "UPDATE moviewise_ticket_quantity SET $insert_iteam WHERE id ='" . $id . "'";
        $iteam_result = mysqli_query($con, $sql_insert_iteam);

        if ($iteam_result == 1) {
            $msg = "Successfully submit Update Data.";
            $link = "moviewise_ticket_quantity_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            $err = "Data submit  failed.";
        }
    }//alert sms show data exit already end 
}


//UPDATE moviewise ticket Quantity End







if (isset($_POST["btnCreateGallery"])) {
    extract($_POST);
    //alert sms show 
    if (empty($movie_name) || empty($type_quantity)) {
        $err = "Please select a movie name and type quantity";
    }

    if (!empty($movie_name) && !empty($type_quantity)) { //alert sms show data exit already
        $insert_iteam = "";
        $insert_iteam .= "movie_id= '" . $movie_name . "'";
        $insert_iteam .= ",user_quantity_limit = '" . $type_quantity . "'";
        $insert_iteam .= ",date = '" . date('Y-m-d') . "'";
        $insert_iteam .= ",status = '1'";
        $sql_insert_iteam = "INSERT INTO moviewise_ticket_quantity SET $insert_iteam ";
        $iteam_result = mysqli_query($con, $sql_insert_iteam);

        if ($iteam_result == 1) {
            $msg = "Successfully submit Data.";
            $link = "moviewise_ticket_quantity_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            $err = "Data submit  failed.";
        }
    }//alert sms show data exit already end 
}

//edit option for movie start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $movietictqnt = "SELECT * FROM  moviewise_ticket_quantity WHERE id = '" . $id . "'";
    $movietcqntarray = array();
    $sqlmovie = mysqli_query($con, $movietictqnt);
    $moviechk = mysqli_num_rows($sqlmovie);
    if ($moviechk != 0) {
        while ($movierow = mysqli_fetch_object($sqlmovie)) {
            $movietcqntarray[] = $movierow;
        }
    }
}
//edit option for movie end
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


            <!--Edit start-->

            
                <?php
                include basePath('admin/message.php');
                if (isset($_GET['id'])) {
                    ?>
                    <h3 class="bg-white content-heading border-bottom strong" style="padding: 10px;"> Edit movie wise ticket quantity </h3>
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
                                            <label class="col-md-4 control-label" for="venueTitle">Movie name</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="movie_name" name="movie_name">
                                                    <option value="0">Select Movie</option>
                                                    <?php if (count($movietqarray) >= 0): ?>
                                                        <?php foreach ($movietqarray as $movietq): ?>
                                                            <option  <?php if ($movietcqntarray[0]->movie_id == $movietq->movie_id) { ?>selected="selected"<?php } ?> value="<?php echo $movietq->movie_id; ?>"><?php echo $movietq->name; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="itemTitle"> Type Quantity</label>
                                            <div class="col-md-8"><input class="form-control" id="type_quantity" name="type_quantity" value="<?php echo $movietcqntarray[0]->user_quantity_limit; ?>" type="text"/></div>
                                        </div>


                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  id="btneditGallery" name="btneditGallery" class="btn btn-primary" ><i class="fa fa-check-circle"></i>Update data</button>
                                </div>
                            </div>
                        </div>
                    </form>
</div>

                <?php } else { ?>
               



                <!--Edit end-->

                <h3 class="bg-white content-heading border-bottom strong"> Add movie wise ticket quantity </h3>
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
                                        <label class="col-md-4 control-label" for="venueTitle">Movie name</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="movie_name" name="movie_name">
                                                <option value="0">Select Movie</option>
                                                <?php if (count($movietqarray) >= 1): ?>
                                                    <?php foreach ($movietqarray as $movietq): ?>
                                                        <option value="<?php echo $movietq->movie_id; ?>"><?php echo $movietq->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="itemTitle"> Type Quantity</label>
                                        <div class="col-md-8"><input class="form-control" id="type_quantity" name="type_quantity"  type="text"/></div>
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

        <!-- // Main Container Fluid END -->
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
            $("#moviewiseticketquantity").addClass("active");
            $("#moviewiseticketquantity").parent().parent().addClass("active");
            $("#moviewiseticketquantity").parent().addClass("in");
        </script>

        <?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>


