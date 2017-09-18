<?php
include '../../config/config.php';

$adminID = 0;
$generatedHtml = '';
$event_id = 0;
$place_id = 0;
$ticket_price = 0;
$is_seat_plan = "no";
$template_id = "";
$seats = "";
$column = 0;
$row = 0;

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $adminID = getSession('admin_id');
}

$arrEvents = array();
$sqlGetEvent = "SELECT * FROM events WHERE event_is_seat_plan='yes'";
$resultGetEvent = mysqli_query($con, $sqlGetEvent);
if ($resultGetEvent) {
    while ($resultGetEventObj = mysqli_fetch_object($resultGetEvent)) {
        $arrEvents[] = $resultGetEventObj;
    }
} else {
    if (DEBUG) {
        $err = "resultGetEvent error: " . mysqli_error($con);
    } else {
        $err = "resultGetEvent query failed.";
    }
}


$arrSeatPlace = array();
$sqlSeatPlace = "SELECT SP_id,SP_title FROM seat_place";
$resultSeatPlace = mysqli_query($con, $sqlSeatPlace);
if ($resultSeatPlace) {
    while ($resultSeatPlaceObj = mysqli_fetch_object($resultSeatPlace)) {
        $arrSeatPlace[] = $resultSeatPlaceObj;
    }
} else {
    if (DEBUG) {
        $err = "resultGetEvent error: " . mysqli_error($con);
    } else {
        $err = "resultGetEvent query failed.";
    }
}



if (isset($_POST['btnCreatePlan'])) {
    extract($_POST);

    if ($event_id == "") {
        $err = "Event Title is required.";
    } elseif ($venue_id == "") {
        $err = "Venue Title is required.";
    } elseif ($place_id == "") {
        $err = "Place Title is required.";
    } elseif ((!isset($is_seat_plan) OR $is_seat_plan != "yes") AND $template_id == "") {
        $err = "Place Plan Title is required.";
    } elseif ($ticket_price == "" OR $ticket_price == 0) {
        $err = "Ticket Price is required.";
    } elseif (($column == 0 OR $row == 0) AND (!isset($is_seat_plan) OR $is_seat_plan != "yes")) {
        $err = "Your selected Place Plan can't be used, because either Column or Row is not defined.";
    } else {

        if (isset($is_seat_plan) OR $is_seat_plan == "yes") {
            $arrTemplate = array();
            $sqlGetTemplate = "SELECT ST_template_array FROM seat_template WHERE ST_SPC_id=$template_id";
            $resultGetTemplate = mysqli_query($con, $sqlGetTemplate);
            if ($resultGetTemplate) {
                $resultGetTemplateObj = mysqli_fetch_object($resultGetTemplate);
                if ($resultGetTemplateObj->ST_template_array) {
                    $arrTemplate = $resultGetTemplateObj->ST_template_array;
                    $arrTemplate = unserialize($arrTemplate);
                }
            }
            if ($column > 0 AND $row > 0) {
                $count = 1;
                $generatedHtml .= '<table style="margin: 0px auto;" border="1">';
                for ($i = 0; $i < $row; $i++) {
                    $generatedHtml .= '<tr>';
                    for ($j = 0; $j < $column; $j++) {
                        $checked = '';
                        $generatedHtml .= '<td style="padding: 8px;" class="text-center">';
                        if (array_key_exists($count, $arrTemplate)) {
                            if (array_key_exists($count, $seats)) {
                                $checked = 'checked="checked"';
                            }
                            $generatedHtml .= '<input type="checkbox" value="Checked" name="seats[' . $count . ']" ' . $checked . '>';
                        }
                        $generatedHtml .= '</td>';
                        $count++;
                    }
                    $generatedHtml .= '</tr>';
                }
                $generatedHtml .= '</table>';
            }
        }


        $dateTimeNow = date("Y-m-d H:i:s");
        if (count($seats) > 0) {
            $seats = serialize($seats);
        }

        if (isset($is_seat_plan) OR $is_seat_plan == "yes") {
            $seats = "";
            $template_id = 0;
        } else {
            $is_seat_plan == "no";
        }

        $insertSeatAllocation = '';
        $insertSeatAllocation .=' ESP_event_id = "' . validateInput($event_id) . '"';
        $insertSeatAllocation .=', ESP_venue_id = "' . validateInput($venue_id) . '"';
        $insertSeatAllocation .=', ESP_place_id = "' . validateInput($place_id) . '"';
        $insertSeatAllocation .=', ESP_template_id = "' . validateInput($template_id) . '"';
        $insertSeatAllocation .=', ESP_template_column = "' . validateInput($column) . '"';
        $insertSeatAllocation .=', ESP_template_row = "' . validateInput($row) . '"';
        $insertSeatAllocation .=', ESP_seats_available_array = "' . validateInput($seats) . '"';
        $insertSeatAllocation .=', ESP_ticket_price = "' . validateInput($ticket_price) . '"';
        $insertSeatAllocation .=', ESP_is_plan_not_applicable = "' . validateInput($is_seat_plan) . '"';
        $insertSeatAllocation .=', ESP_created_on = "' . validateInput($dateTimeNow) . '"';
        $insertSeatAllocation .=', ESP_created_by = "' . validateInput($adminID) . '"';

        $sqlInsertSeatAllocation = "INSERT INTO event_seat_plan SET $insertSeatAllocation";
        $resultInsertSeatAllocation = mysqli_query($con, $sqlInsertSeatAllocation);

        if ($resultInsertSeatAllocation) {
            $generatedHtml = '';
            $msg = "Seat Allocation saved successfully.";
        } else {
            if (DEBUG) {
                $err = "resultInsertSeatAllocation error: " . mysqli_error($con);
            } else {
                $err = "resultInsertSeatAllocation query failed.";
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Add Seat Template</h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="faqCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="faqError"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Select Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="event_id" onchange="javascript:getVenueObj(this.value);">
                                                <option value="">Select Event Title</option>
                                                <?php if (count($arrEvents) > 0): ?>
                                                    <?php foreach ($arrEvents AS $Events): ?>
                                                        <option value="<?php echo $Events->event_id; ?>" <?php
                                                if ($Events->event_id == $event_id) {
                                                    echo "selected='selected'";
                                                }
                                                        ?>><?php echo $Events->event_title; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Select Venue Title</label>
                                        <div class="col-md-8">
                                            <span id="showTemplate">
                                                <select class="form-control" name="venue_id">
                                                    <option value="">Select Event Title First</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="venueTitle">Select Place Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="place_id" onchange="javascript:getPlaceTemplateObj(this.value);">
                                                <option value="">Select Place Title</option>
                                                <?php if (count($arrSeatPlace) > 0): ?>
                                                    <?php foreach ($arrSeatPlace AS $Place): ?>
                                                        <option value="<?php echo $Place->SP_id; ?>" <?php
                                                if ($Place->SP_id == $place_id) {
                                                    echo "selected='selected'";
                                                }
                                                        ?>><?php echo $Place->SP_title; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Select Place Plan Title</label>
                                        <div class="col-md-8">
                                            <span id="showPlace">
                                                <select class="form-control" name="template_id" id="isTempId" <?php
                                                        if ($is_seat_plan == "yes") {
                                                            echo "disabled='disabled'";
                                                        }
                                                        ?>>
                                                    <option value="">Select Place Title First</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Is Seat Plan Applicable?</label>
                                        <div class="col-md-8">
                                            <span id="showPlace">
                                                <input type="checkbox" name="is_seat_plan" value="yes" id="isSeatPlan" <?php
                                                       if ($is_seat_plan == "yes") {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>/>&nbsp;&nbsp;No
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Ticket Price</label>
                                        <div class="col-md-8">
                                            <span id="showPlace">
                                                <input class="form-control" type="number" name="ticket_price" value="<?php echo $ticket_price; ?>" />
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <h3 class="text-center" style="margin-top: 15px;margin-bottom: 15px;">Select available seats to sale tickets</h3>

                            <div id="generateTable" class="col-md-12">
<?php echo $generatedHtml; ?>
                            </div>
                            <input type="hidden" name="column" id="seatColumn" value="">
                            <input type="hidden" name="row" id="seatRow" value="">


                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreateFAQ" name="btnCreatePlan" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Plan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
<?php include basePath('admin/footer.php'); ?>

        <script type="text/javascript">
            function getVenueObj(eventID) {
                var newHtml = '';

                if (eventID > 0) {
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "admin/ajax/ajaxGetVenueList.php",
                        dataType: "json",
                        data: {eventID: eventID},
                        success: function (response) {
                            var obj = response;

                            if (obj.output === "success") {
                                newHtml += '<select class="form-control" name="venue_id">';
                                newHtml += '<option value="">Select Venue Title</option>';
                                //                            if (obj.arrGetVenueInfo.length > 0) {
                                $.each(obj.arrGetVenueInfo, function (key, Place) {
                                    newHtml += '<option value="' + Place.venue_id + '">' + Place.venue_title + '</option>';
                                });
                                //                            }
                                newHtml += '</select>';

                                $("#showTemplate").html(newHtml);
                            } else {
                                error(obj.msg);
                            }
                        }
                    });
                }
            }


            function getPlaceTemplateObj(placeID) {
                var newHtml = '';

                if (placeID > 0) {
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "admin/ajax/ajaxGetPlaceList.php",
                        dataType: "json",
                        data: {placeID: placeID},
                        success: function (response) {
                            var obj = response;

                            if (obj.output === "success") {
                                newHtml += '<select class="form-control" id="isTempId" name="template_id" onchange="javascript:getTemplateDesign(this.value);">';
                                newHtml += '<option value="">Select Template Title</option>';
                                if (obj.arrGetPlaceTemplate.length > 0) {
                                    $.each(obj.arrGetPlaceTemplate, function (key, Place) {
                                        newHtml += '<option value="' + Place.SPC_id + '">' + Place.SPC_title + '</option>';
                                    });
                                }
                                newHtml += '</select>';

                                $("#showPlace").html(newHtml);
                            } else {
                                error(obj.msg);
                            }
                        }
                    });
                }
            }



            function getTemplateDesign(templateID) {
                var newHtml = '';

                if (templateID > 0) {
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "admin/ajax/ajaxGetTemplateDesign.php",
                        dataType: "json",
                        data: {templateID: templateID},
                        success: function (response) {
                            var obj = response;

                            if (obj.output === "success") {

                                var column = obj.arrGetTemplate[0].ST_column_count;
                                var row = obj.arrGetTemplate[0].ST_row_count;
                                var count = 1;
                                //                            alert(column);
                                //                            alert(row);
                                if (column > 0 && row > 0) {
                                    $("#seatColumn").val(column);
                                    $("#seatRow").val(row);
                                    var seatHtml = '<table style="margin: 0px auto;" border="1">';
                                    for (var a = 0; a < row; a++) {
                                        seatHtml += '<tr>';
                                        for (var b = 0; b < column; b++) {
                                            seatHtml += '<td style="padding: 8px;" class="text-center">';
                                            if ((count in obj.arrGetTemplate[0].Template_array)) {
                                                seatHtml += '<input type="checkbox" value="Checked" name="seats[' + count + ']" checked="checked">';
                                            }
                                            //                                        seatHtm(count in obj.arrGetTemplate[0].Template_array)l += '&nbsp;' + count + '</td>';
                                            count++;
                                        }
                                        seatHtml += '</tr>';
                                    }
                                    seatHtml += '</table>';
                                } else {
                                    var seatHtml = '';
                                }
                                $("#generateTable").html(seatHtml);
                            } else {
                                error(obj.msg);
                            }
                        }
                    });
                }
            }

        </script>
        <script type="text/javascript">
            $("#allocateseatList").addClass("active");
            $("#allocateseatList").parent().parent().addClass("active");
            $("#allocateseatList").parent().addClass("in");

            //enabling or disabling the template id field depending on isSeatPLan checkbox
            $("#isSeatPlan").click(function () {
                if ($('#isSeatPlan').attr('checked')) {
                    $("#isTempId").prop('disabled', true);
                } else {
                    $("#isTempId").prop('disabled', false);
                }
            });
        </script>
<?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>