<?php
include '../../config/config.php';

$adminID = 0;
$generatedHtml = '';
$event_id = 0;
$place_id = 0;
$ticket_price = 0;
$ESP_id = 0;
$venue_id = 0;
$template_id = 0;
$seats = array();
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $adminID = getSession('admin_id');
}

if (isset($_GET['ESP_id'])) {
    $ESP_id = $_GET['ESP_id'];
}
// getting event data
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


if (isset($_POST['btnCreatePlan'])) {
    extract($_POST);
   
    if ($event_id == "") {
        $err = "Event Title is required.";
    } elseif ($venue_id == "") {
        $err = "Venue Title is required.";
    } elseif ($place_id == "") {
        $err = "Place Title is required.";
    } elseif ($template_id == "") {
        $err = "Place Plan Title is required.";
    } elseif ($ticket_price == "" OR $ticket_price == 0) {
        $err = "Ticket Price is required.";
    } elseif ($column == 0 OR $row == 0) {
        $err = "Your selected Place Plan can't be used, because either Column or Row is not defined.";
    } else {
        
        if (count($seats) > 0) {
            $seats = serialize($seats);
        }

        $updateSeatAllocation = '';
        $updateSeatAllocation .=' ESP_event_id = "' . validateInput($event_id) . '"';
        $updateSeatAllocation .=', ESP_venue_id = "' . validateInput($venue_id) . '"';
        $updateSeatAllocation .=', ESP_place_id = "' . validateInput($place_id) . '"';
        $updateSeatAllocation .=', ESP_template_id = "' . validateInput($template_id) . '"';
        $updateSeatAllocation .=', ESP_template_column = "' . validateInput($column) . '"';
        $updateSeatAllocation .=', ESP_template_row = "' . validateInput($row) . '"';
        $updateSeatAllocation .=', ESP_seats_available_array = "' . validateInput($seats) . '"';
        $updateSeatAllocation .=', ESP_ticket_price = "' . validateInput($ticket_price) . '"';
        $updateSeatAllocation .=', ESP_updated_by = "' . validateInput($adminID) . '"';


        $sqlUpdate = "UPDATE event_seat_plan SET $updateSeatAllocation WHERE ESP_id=$ESP_id";
        $resultUpdate = mysqli_query($con, $sqlUpdate);
        if ($resultUpdate) {
            $msg = "Event Seat Template Updated Successfully";
            $link = "allocate_seat_list.php?msg=" . base64_encode($msg);
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "resultUpdate error: " . mysqli_error($con);
            } else {
                $err = "resultUpdate query failed.";
            }
        }
    }
}

// getting data from event seat plan table
$sqlGetEventSeatPlan = "SELECT * FROM event_seat_plan WHERE ESP_id=$ESP_id";
$resultGetEventSeatPlan = mysqli_query($con, $sqlGetEventSeatPlan);
if ($resultGetEventSeatPlan) {
    $resultGetEventSeatPlanObj = mysqli_fetch_object($resultGetEventSeatPlan);
    $event_id = $resultGetEventSeatPlanObj->ESP_event_id;
    $place_id = $resultGetEventSeatPlanObj->ESP_place_id;
    $template_id = $resultGetEventSeatPlanObj->ESP_template_id;
    $ticket_price = $resultGetEventSeatPlanObj->ESP_ticket_price;
    $seats = $resultGetEventSeatPlanObj->ESP_seats_available_array;
    $template_row = $resultGetEventSeatPlanObj->ESP_template_row;
    $template_column = $resultGetEventSeatPlanObj->ESP_template_column;
} else {
    if (DEBUG) {
        $err = "resultGetEventSeatPlan error: " . mysqli_error($con);
    } else {
        $err = "resultGetEventSeatPlan query failed.";
    }
}

//getting template data
$arrayTemplate = array();
$sqlTemplate = "SELECT SPC_id,SPC_SP_id,SPC_title FROM seat_place_coordinate WHERE SPC_SP_id = $place_id";
$resultTemplate = mysqli_query($con, $sqlTemplate);
if ($resultTemplate) {
    while ($resultTemplateObj = mysqli_fetch_object($resultTemplate)) {
        $arrayTemplate[] = $resultTemplateObj;
    }
} else {
    if (DEBUG) {
        $err = "resultTemplate error: " . mysqli_error($con);
    } else {
        $err = "resultTemplate query failed.";
    }
}
// getting venue data
$arrayVenue = array();
$sqlGetVenue = "SELECT venue_id,venue_event_id,venue_title FROM event_venues WHERE venue_event_id=$event_id";
$resultGetVenue = mysqli_query($con, $sqlGetVenue);
if ($resultGetVenue) {
    $resultGetVenueObj = mysqli_fetch_object($resultGetVenue);
    $venue_id = $resultGetVenueObj->venue_id;
    $venue_title = $resultGetVenueObj->venue_title;
} else {
    if (DEBUG) {
        $err = "resultGetVenue error: " . mysqli_error($con);
    } else {
        $err = "resultGetVenue query failed.";
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

$seats = unserialize($seats);

if ($template_column > 0 AND $template_row > 0) {
    $count = 1;
    $generatedHtml .= '<table style="margin: 0px auto;" border="1">';
    for ($i = 0; $i < $template_row; $i++) {
        $generatedHtml .= '<tr>';
        for ($j = 0; $j < $template_column; $j++) {
            $checked = '';
            $generatedHtml .= '<td style="padding: 8px;" class="text-center">';
            if (array_key_exists($count, $seats)) {
                $generatedHtml .= '<input type="checkbox" value="Checked" name="seats[' . $count . ']" ' . $checked . ' checked="checked">&nbsp;' . $count . '';
            } else {
                $generatedHtml .= '<input type="checkbox" value="Checked" name="seats[' . $count . ']" ' . $checked . '>&nbsp;' . $count . '';
            }
            $generatedHtml .= '</td>';
            $count++;
        }
        $generatedHtml .= '</tr>';
    }
    $generatedHtml .= '</table>';
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
    <body>
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Edit Seat Template</h3>
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
                                                    <option value="<?php echo $venue_id; ?>"><?php echo $venue_title; ?></option>                                                    
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
                                                <select class="form-control" name="template_id">
                                                    <option value="">Select Place Title First</option>
<?php if (count($arrayTemplate) > 0): ?>
    <?php foreach ($arrayTemplate AS $template): ?>
                                                            <option value="<?php echo $template->SPC_id; ?>" <?php
                                                            if ($template->SPC_id == $template_id) {
                                                                echo "selected='selected'";
                                                            }
                                                            ?>>
                                                            <?php echo $template->SPC_title; ?></option>
                                                        <?php endforeach; ?>
                                                            <?php endif; ?>
                                                </select>
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
                            <input type="hidden" name="column" id="seatColumn" value="<?php echo $template_column; ?>">
                            <input type="hidden" name="row" id="seatRow" value="<?php echo $template_row; ?>">

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="submit"  id="btnCreatePlan" name="btnCreatePlan" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Seat Template</button>
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
                                newHtml += '<select class="form-control" name="template_id" onchange="javascript:getTemplateDesign(this.value);">';
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
        </script>
<?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>