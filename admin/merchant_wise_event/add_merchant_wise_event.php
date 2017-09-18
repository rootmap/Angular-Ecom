<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}

//include '../../lib/Zebra_Image.php';
$arrMarchents = array();
$get_Marchents = "SELECT clients_id,clients_name FROM clients GROUP BY clients_id";
$resultMarchents = mysqli_query($con, $get_Marchents);
if ($resultMarchents) {
    while ($obj = mysqli_fetch_object($resultMarchents)) {
        $arrMarchents[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

$arrEvents = array();
$get_Events = "SELECT event_id, event_title FROM events GROUP BY event_id";
$resultEvents = mysqli_query($con, $get_Events);
if ($resultEvents) {
    while ($obj = mysqli_fetch_object($resultEvents)) {
        $arrEvents[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}

$merchant_id = "";
$event_id = "";
$merchant_event_created_on = "";

if (isset($_POST["btnCreateMerchantEvent"])) {
    extract($_POST);
    

    $merchant_id = mysqli_real_escape_string($con, $merchant_id);
    $event_id = mysqli_real_escape_string($con, $event_id);
    $merchant_event_created_on = date("Y-m-d");

    $insert_MerEvntArray = '';
    $insert_MerEvntArray .= ' merchant_id = "' . $merchant_id . '"';
    $insert_MerEvntArray .= ', event_id = "' . $event_id . '"';
    $insert_MerEvntArray .= ', date = "' . $merchant_event_created_on . '"';
    
    
    
    $checkMerEvnt = "SELECT * FROM merchant_wise_event_data WHERE event_id = '$event_id'";
    $checkMerEvntResult = mysqli_query($con, $checkMerEvnt);
    $countMerEvnt = mysqli_num_rows($checkMerEvntResult);
    if ($countMerEvnt >= 1) {
        $err = "Event name already exists";
    } else {
        $run_insert_MerEvntArray = "INSERT INTO merchant_wise_event_data SET $insert_MerEvntArray";
        
        $resultMerEvntInsert = mysqli_query($con, $run_insert_MerEvntArray);
        //echo var_dump($resultMerEvntInsert);
        //exit();
        if ($resultMerEvntInsert) {
            $msg = "Mechant's Event saved successfully";
            $link = "merchant_wise_event_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "resultMerEvntInsert error: " . mysqli_error($con);
            } else {
                $err = "resultMerEvntInsert query failed.";
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
            <h3 class="bg-white content-heading border-bottom strong">Add Merchant-wise Event</h3>
            <div class="innerAll spacing-x2">
<?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="createClient" enctype="multipart/form-data">
                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="merchant-event-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="MerchantTitle">Merchant Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="merchant_id" name="merchant_id">
                                                <option value="0">Select Merchant</option>
                                                <?php if (count($arrMarchents) >= 1): ?>
                                                    <?php foreach ($arrMarchents as $marchents): ?>
                                                        <option value="<?php echo $marchents->clients_id; ?>">
                                                            <?php echo $marchents->clients_name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="EventTitle">Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="event_id" name="event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arrEvents) >= 1): ?>
                                                    <?php foreach ($arrEvents as $events): ?>
                                                        <option value="<?php echo $events->event_id; ?>">
                                                            <?php echo $events->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreateMerchantEvent" name="btnCreateMerchantEvent" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save</button>
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
        $("#merchant-events").addClass("active");
        $("#merchant-events").parent().parent().addClass("active");
        $("#merchant-events").parent().addClass("in");
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateMerchantEvent").click(function () {
                var merchant_id = $("#merchant_id").val();
                var event_id = $("#event_id").val();
                var URL_check = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/;
                if (merchant_id === "") {
                    $("#merchant-event-error").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Merchant name required</em></strong></div>');
                } else if (event_id === "") {
                    $("#merchant-event-error").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Event name required</em></strong></div>');
                } else {
                    $("#merchant-event-error").submit();
                }
            });
        });

    </script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>