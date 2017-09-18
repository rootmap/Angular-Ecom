<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $admin_ID = getSession('admin_id');
}

$event_id = 0;
$ES_similar_event_id = array();
$ES_event_id = 0;

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}
$arrayAllEvents = array();
$eventSql = "SELECT * FROM events WHERE event_status='active' AND event_id NOT IN ('$event_id')";
$resultEvent = mysqli_query($con, $eventSql);

if ($resultEvent) {
    $countSqlEvent = mysqli_num_rows($resultEvent);
    if ($countSqlEvent > 0) {
        while ($row = mysqli_fetch_object($resultEvent)) {
            $arrayAllEvents[] = $row;
        }
    }
} else {
    if (DEBUG) {
        $err = "resultSimilarEvent error: " . mysqli_error($con);
    } else {
        $err = "resultSimilarEvent query failed.";
    }
}



$arrayCurrentSimilarEvent = array();
$sqlSimilarEvent = "SELECT * FROM event_similar";
$resultSimilarEvent = mysqli_query($con, $sqlSimilarEvent);
if ($resultSimilarEvent) {
    while ($resultSimilarEventObj = mysqli_fetch_object($resultSimilarEvent)) {
        $arrayCurrentSimilarEvent[] = $resultSimilarEventObj->ES_similar_event_id;
    }
} else {
    if (DEBUG) {
        $err = "resultSimilarEvent error: " . mysqli_error($con);
    } else {
        $err = "resultSimilarEvent query failed.";
    }
}


$arrayPostedSimilarEvents = array();
if (isset($_POST["btnSaveSimilar"])) {
    extract($_POST);
    $arrayPostedSimilarEvents = $ES_similar_event_id;

    $SimilarEventStatus = true;

    $arrayDeleteEvents = array_diff($arrayCurrentSimilarEvent, $arrayPostedSimilarEvents);
    $arrayAddEvents = array_diff($arrayPostedSimilarEvents, $arrayCurrentSimilarEvent);

    $arrayAddEvents = array_values($arrayAddEvents);
    $arrayDeleteEvents = array_values($arrayDeleteEvents);

    if (count($arrayAddEvents) > 0) {
        foreach ($arrayAddEvents AS $AddEvent) {

            $insertSimilarEventArray = '';
            $insertSimilarEventArray .= ' ES_event_id = "' . intval($event_id) . '"';
            $insertSimilarEventArray .= ', ES_similar_event_id = "' . intval($AddEvent) . '"';
            $insertSimilarEventArray .= ', ES_created_on = "' . mysqli_real_escape_string($con, date("Y-m-d H:i:s")) . '"';
            $insertSimilarEventArray .= ', ES_created_by = "' . intval($admin_ID) . '"';
            $insertSimilarEventArray .= ', ES_updated_by = "' . intval($admin_ID) . '"';

            $sqlSimilarEvent = "INSERT INTO event_similar SET $insertSimilarEventArray";
            $resultInsertSimilarEvent = mysqli_query($con, $sqlSimilarEvent);

            if ($resultInsertSimilarEvent) {
                $SimilarEventStatus = true;
            } else {
                if (DEBUG) {
                    $err = "resultInsertSimilarEvent error: " . mysqli_error($con);
                }
            }
        }
    } else {
        $SimilarEventStatus = true;
    }


    if (count($arrayDeleteEvents) > 0) {
        foreach ($arrayDeleteEvents AS $DeleteEvent) {

            $sqlDeleteSimilarEvent = "DELETE FROM event_similar "
                    . "WHERE ES_similar_event_id = $DeleteEvent ";
            $resultDeleteSimilar = mysqli_query($con, $sqlDeleteSimilarEvent);

            if ($resultDeleteSimilar) {
                $SimilarEventStatus = true;
            } else {
                if (DEBUG) {
                    $err = "resultDeleteSimilar error: " . mysqli_error($con);
                }
            }
        }
    } else {
        $SimilarEventStatus = true;
    }

    if ($SimilarEventStatus == true) {

        $arrayCurrentSimilarEvent = $arrayPostedSimilarEvents;
        $msg = "Similar event updated successfully.";
        $link = "event_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        $msg = "Similar event updated failed, revoked to old values.";
        $arrayCurrentSimilarEvent = $arrayAddEvents;
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Similar Event</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off">

                    <div class="widget widget-inverse">
                        <div class="widget-body" >
                            <table class="table table-bordered table-striped table-white">
                                <thead>
                                    <tr>
                                        <th class="center">No.</th>
                                        <th>Event Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($arrayAllEvents) > 0) : ?>
                                        <?php foreach ($arrayAllEvents as $arrEvent): ?>
                                            <tr>
                                                <td class="center">
                                                    <input type="checkbox" name="ES_similar_event_id[]" value="<?php echo $arrEvent->event_id; ?>" <?php
                                                    if (in_array($arrEvent->event_id, $arrayCurrentSimilarEvent)) {
                                                        echo "checked";
                                                    }
                                                    ?> />
                                                </td>
                                                <td>
                                                    <?php echo $arrEvent->event_title; ?>
                                                </td>

                                            </tr>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3">
                                                No active event found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="form-actions">
                                <button type="submit" name="btnSaveSimilar" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save Similar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#add_sim").addClass("active");
        $("#add_sim").parent().parent().addClass("active");
        $("#add_sim").parent().addClass("in");
    </script>



    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>