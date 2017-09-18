<?php
include '../../config/config.php';




if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}


if (isset($_POST['btnCreateEventInclude'])) {
    extract($_POST);
    $event_id = mysqli_real_escape_string($con, $event_id);
    $cost_title = mysqli_real_escape_string($con, $cost_title);
    $cost_amount = mysqli_real_escape_string($con, $cost_amount);
    $deduction_type = mysqli_real_escape_string($con,$deduction_type);


    $insert_IncludesArray = '';
    $insert_IncludesArray .= ' event_id = "' . $event_id . '"';
    $insert_IncludesArray .= ' ,cost_title = "' . $cost_title . '"';
    $insert_IncludesArray .= ', cost_amount = "' . $cost_amount . '"';
    $insert_IncludesArray .= ', deduction_type = "' . $deduction_type . '"';
    $insert_IncludesArray .= ', date = "' . date('Y-m-d') . '"';
    $insert_IncludesArray .= ', status = "1"';


    $run_insert_query = "INSERT INTO event_ticket_extra_cost SET $insert_IncludesArray";
    $result = mysqli_query($con, $run_insert_query);


    $msg = "Movie Ticket Cost Saved Successfully";
    $link = "event_ticket_extra_cost_list.php?msg=" . base64_encode($msg);
    redirect($link);
}
//update movie ticket extra cost list start

if (isset($_POST['btnEditEventInclude'])) {
    extract($_POST);
    $id = mysqli_real_escape_string($con, $id);
    $event_id = mysqli_real_escape_string($con, $event_id);
    $cost_title = mysqli_real_escape_string($con, $cost_title);
    $cost_amount = mysqli_real_escape_string($con, $cost_amount);
    $deduction_type = mysqli_real_escape_string($con, $deduction_type);


    $insert_IncludesArray = '';
    $insert_IncludesArray .= ' id = "' . $id . '"';
    $insert_IncludesArray .= ' ,event_id = "' . $event_id . '"';
    $insert_IncludesArray .= ' ,cost_title = "' . $cost_title . '"';
    $insert_IncludesArray .= ' ,cost_amount = "' . $cost_amount . '"';
    $insert_IncludesArray .= ' ,deduction_type = "' .$deduction_type . '"';
    $insert_IncludesArray .= ' ,date = "' . date('Y-m-d') . '"';
    $insert_IncludesArray .= ' ,status = "1"';
    $run_eedc_array_sql = "UPDATE event_ticket_extra_cost SET $insert_IncludesArray WHERE id='" . $id . "'";
    $result = mysqli_query($con, $run_eedc_array_sql);
    if (!$result) {
        if (DEBUG) {
            $err = "run_event _movie_array_sql error: " . mysqli_error($con);
        } else {
            $err = "run_event _movie_sql query failed.";
        }
    } else {
        $msg = "Update Event Movie Data successfully";
        $link = "event_ticket_extra_cost_list.php?msg=" . base64_encode($msg);
        redirect($link);
        // Video link save end
        // Image file save start
        // Image file save end
    }
}

//update movie ticket extra cost list end

//edit option for movie ticket extra cost list  start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $emtecl = "SELECT * FROM  event_ticket_extra_cost WHERE id = '" . $id . "'";
    $emteclarray = array();
    $sqlemtecl = mysqli_query($con, $emtecl);
    $sqlemteclchk = mysqli_num_rows($sqlemtecl);
    if ($sqlemteclchk != 0) {
        while ($emcelrow = mysqli_fetch_object($sqlemtecl)) {
            $emteclarray[] = $emcelrow;
        }
    }
}
//edit option for movie ticket extra cost list  end


//edit option for movie ticket extra cost list (EVENT) start
$eventsarray = array();
$eventssql = "SELECT event_id,event_title FROM events";
$eventresult = mysqli_query($con, $eventssql);
if ($eventresult) {
    while ($eventobj = mysqli_fetch_object($eventresult)) {
        $eventsarray[] = $eventobj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
//edit option for movie ticket extra cost list (EVENT)  end



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
                        <?php include basePath('admin/side_menu.php');
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="content">
            <?php
            include basePath('admin/message.php');
            if (isset($_GET['id'])) {
                ?>
                <!--Edit data  code start-->
                <h3 class="bg-white content-heading border-bottom strong">Edit Movie Ticket Extra Cost Detail</h3>

                <div class="innerAll spacing-x2">

                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="includesCreate">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="includesError"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Events</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="eventname_id" name="event_id">
                                                    <option value="0">Select Event</option>
                                                    <?php if (count($eventsarray) >= 1): ?>
                                                        <?php foreach ($eventsarray as $events): ?>
                                                            <option <?php if ($emteclarray[0]->event_id == $events->event_id) { ?> selected="selected" <?php } ?> value="<?php echo $events->event_id; ?>">
                                                                <?php echo $events->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Cost Title </label>
                                            <div class="col-md-8">
                                                <input class="form-control"  name="cost_title" value="<?php echo $emteclarray[0]->cost_title ?>"  type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Cost Amount </label>
                                            <div class="col-md-8">
                                                <input class="form-control"  name="cost_amount"  value="<?php echo $emteclarray[0]->cost_amount ?>" type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Deduction Type</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="deduction_type" name="deduction_type">
                                                    <option <?php if($emteclarray[0]->deduction_type == 0){ ?> selected="selected" <?php } ?>value="0">Select Type</option>
                                                    <option <?php if($emteclarray[0]->deduction_type == 1){ ?> selected="selected" <?php } ?>value="1">Amount</option>
                                                    <option <?php if($emteclarray[0]->deduction_type == 2){ ?> selected="selected" <?php } ?>value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  onclick="javascript:return confirm('Are you absolutely sure to save This cost record ?')"   id="btnEditEventInclude" name="btnEditEventInclude" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Data Record </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } else { ?>


                <!--input data  code start-->
                <h3 class="bg-white content-heading border-bottom strong">Create New Movie Ticket Extra Cost Detail</h3>

                <div class="innerAll spacing-x2">
                    <?php //include basePath('admin/message.php');  ?>
                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="includesCreate">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="includesError"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Events</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="eventname_id" name="event_id">
                                                    <option value="0">Select Event</option>
                                                    <?php if (count($eventsarray) >= 1): ?>
                                                        <?php foreach ($eventsarray as $events): ?>
                                                            <option value="<?php echo $events->event_id; ?>"><?php echo $events->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Cost Title </label>
                                            <div class="col-md-8">
                                                <input class="form-control"  name="cost_title"  placeholder="Cost Title" type="text"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Cost Amount </label>
                                            <div class="col-md-8">
                                                <input class="form-control"  name="cost_amount"  placeholder="Cost Amount" type="text"/>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Deduction Type</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="deduction_type" name="deduction_type">
                                                    <option value="0">Select Type</option>
                                                    <option value="1">Amount</option>
                                                    <option value="2">Percent</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  onclick="javascript:return confirm('Are you absolutely sure to save This cost record ?')"   id="btnCreateEventInclude" name="btnCreateEventInclude" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Save Movie Cost Record </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#movie-ticket-extra-costs").addClass("active");
        $("#movie-ticket-extra-costs").parent().parent().addClass("active");
        $("#movie-ticket-extra-costs").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>

</body>
</html>