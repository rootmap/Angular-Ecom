<?php
include '../../config/config.php';

if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$adminEventPermission = '';
$adminID = 0;
$adminEventID = '';
if ((getSession('admin_event_permission')) AND ( getSession('admin_id'))) {
    $adminEventPermission = getSession('admin_event_permission');
    $adminID = getSession('admin_id');
    $adminEventID = getSession('admin_event_id');
}

$userCity = 0;
$userCountry = 0;
$userFName = "";
$userLName = "";
$userPhone = "";
$userEmail = "";
$userId = 0;
$strRandPassword = "";
$userZip = "";
$userAddress = "";
$chkDelivery = "";
$orderId = 0;
$orderEventId = 0;
$checkStatus = 0;
$deliveryCost = 0;

$arrAllEvents = array();
$sqlGetEvents = "SELECT event_title,event_id "
        . "FROM events "
        . "WHERE event_status='active' "
        . "AND event_is_seat_plan='no' "
        . "ORDER BY event_title ASC";
$resultGetEvents = mysqli_query($con, $sqlGetEvents);
if ($resultGetEvents) {
    while ($resultGetEventsObj = mysqli_fetch_object($resultGetEvents)) {
        $arrAllEvents[] = $resultGetEventsObj;
    }
} else {
    if (DEBUG) {
        $err = "resultGetEvents error: " . mysqli_error($con);
    } else {
        $err = "resultGetEvents query failed.";
    }
}


// Get All Countries For User Address
$countryArray = array();
$countrySql = "SELECT * FROM countries WHERE country_status = 'allow'";
$resultCountry = mysqli_query($con, $countrySql);
if ($resultCountry) {
    while ($rowCountry = mysqli_fetch_object($resultCountry)) {
        $countryArray[] = $rowCountry;
    }
} else {
    if (DEBUG) {
        $err = "resultCountry error: " . mysqli_error($con);
    } else {
        $err = "resultCountry query failed";
    }
}

// Get All Cities For User Address
$cityArray = array();
$citySql = "SELECT * FROM cities WHERE city_status = 'allow'";
$resultCity = mysqli_query($con, $citySql);
if ($resultCity) {
    while ($rowCity = mysqli_fetch_object($resultCity)) {
        $cityArray[] = $rowCity;
    }
} else {
    if (DEBUG) {
        $err = "resultCity error: " . mysqli_error($con);
    } else {
        $err = "resultCity query failed";
    }
}



if (isset($_POST['form_event_id_1']) AND isset($_POST['selVenueLost_1']) AND isset($_POST['selTicktList_1']) AND isset($_POST['txtQunty_1'])) {
//    debug($_POST);
    extract($_POST);
//    exit();


    if ($form_event_id_1 == 0) {
        $err = "Event title required";
    } elseif ($selVenueLost_1 == 0) {
        $err = "Venue title required";
    } elseif ($selTicktList_1 == 0) {
        $err = "Ticket type required";
    } elseif ($txtQunty_1 == "") {
        $err = "Ticket quantity required";
    } else {

        $sqlCheckUser = "SELECT user_id FROM users WHERE user_email='" . validateInput($userEmail) . "' LIMIT 1";
        $resultCheckUser = mysqli_query($con, $sqlCheckUser);
        if ($resultCheckUser) {
            $resultCheckUserObj = mysqli_fetch_object($resultCheckUser);
            if (isset($resultCheckUserObj->user_id)) {
                $userId = $resultCheckUserObj->user_id;
            }
        } else {
            $checkStatus++;
            if (DEBUG) {
                $err = "resultCheckUser error: " . mysqli_error($con);
            } else {
                $err = "resultCheckUser query failed";
            }
        }

        if ($userId == 0) {
            $strRandPassword = randCode(10);
            $strRandPassword = securedPass($strRandPassword);
            $userHash = session_id();

            $saveUser = '';
            $saveUser .= ' user_email = "' . validateInput($userEmail) . '"';
            $saveUser .= ', user_password = "' . validateInput($strRandPassword) . '"';
            $saveUser .= ', user_status = "' . validateInput("active") . '"';
            $saveUser .= ', user_hash = "' . validateInput($userHash) . '"';
            $saveUser .= ', user_verification = "' . validateInput("yes") . '"';
            $saveUser .= ', user_first_name = "' . validateInput($userFName) . '"';
            $saveUser .= ', user_last_name = "' . validateInput($userLName) . '"';
            $saveUser .= ', user_agree_tc = "' . validateInput("I AGREE") . '"';
            $saveUser .= ', user_phone = "' . validateInput($userPhone) . '"';

            $sqlSaveUser = "INSERT INTO users SET $saveUser";
            $resultSaveUser = mysqli_query($con, $sqlSaveUser);

            if ($resultSaveUser) {
                $userId = mysqli_insert_id($con);
            } else {
                $checkStatus++;
                if (DEBUG) {
                    $err = "resultSaveUser error: " . mysqli_error($con);
                } else {
                    $err = "resultSaveUser query failed";
                }
            }
        }


        $getLastOrderID = getMaxValue('orders', 'order_id');
        $orderDBID = $getLastOrderID + 1;
        $orderPublicID = '[' . date("dmy", time()) . '-' . $orderDBID . ']';
        $OrderPlaced = date("Y-m-d H:i:s", time());
        $sessionID = session_id();
        $totalItem = 0;

        for ($i = 1; $i <= 6; $i++) {
            if (isset($_POST['txtQunty_' . $i])) {
                $totalItem += $_POST['txtQunty_' . $i];
            }
        }
        
        $arrUserCity = explode("|", $userCity);


        $placeNewOrder = '';
        $placeNewOrder .= ' order_id = "' . validateInput($orderDBID) . '"';
        $placeNewOrder .= ', order_user_id = "' . validateInput($userId) . '"';
        $placeNewOrder .= ', order_created = "' . validateInput($OrderPlaced) . '"';
        $placeNewOrder .= ', order_number = "' . validateInput($orderPublicID) . '"';
        $placeNewOrder .= ', order_status = "' . validateInput('approved') . '"';
        //payment
        $placeNewOrder .= ', order_payment_type = "' . validateInput('COD') . '"';
        //order method
        if ($chkDelivery == "on") {
            $placeNewOrder .= ', order_method = "' . validateInput("deliver") . '"';
        } else {
            $placeNewOrder .= ', order_method = "' . validateInput("pickup") . '"';
        }
        
        $placeNewOrder .= ', order_total_item = "' . validateInput($totalItem) . '"';
        $placeNewOrder .= ', order_promotion_codes = "' . validateInput("") . '"';
        $placeNewOrder .= ', order_promotion_discount_amount = "' . validateInput("") . '"';
        $placeNewOrder .= ', order_session_id = "' . validateInput($sessionID) . '"';

        //Billing Address Insertion
        $placeNewOrder .= ', order_billing_phone = "' . mysqli_real_escape_string($con, $userPhone) . '"';
//        $placeNewOrder .= ', order_billing_country = "' . mysqli_real_escape_string($con, $billingCountry) . '"';
//        $placeNewOrder .= ', order_billing_city = "' . mysqli_real_escape_string($con, $billingCity) . '"';
//        $placeNewOrder .= ', order_billing_zip = "' . mysqli_real_escape_string($con, $billingZip) . '"';
//        $placeNewOrder .= ', order_billing_address = "' . mysqli_real_escape_string($con, $billingAddress) . '"';
        //shipping address
        if ($chkDelivery == "on") {
            $placeNewOrder .= ', order_shipment_charge = "' . validateInput($arrUserCity[1]) . '"';
            
            $placeNewOrder .= ', order_shipping_phone = "' . validateInput($userPhone) . '"';
            $placeNewOrder .= ', order_shipping_country = "' . validateInput($userCountry) . '"';
            $placeNewOrder .= ', order_shipping_city = "' . validateInput($arrUserCity[0]) . '"';
            $placeNewOrder .= ', order_shipping_zip = "' . validateInput($userZip) . '"';
            $placeNewOrder .= ', order_shipping_address = "' . validateInput($userAddress) . '"';
        }

        $sqlPlaceOrder = "INSERT INTO orders SET $placeNewOrder";
        $executePlaceOrder = mysqli_query($con, $sqlPlaceOrder);

        if ($executePlaceOrder) {
            $orderId = mysqli_insert_id($con);
        } else {
            $checkStatus++;
            if (DEBUG) {
                $err = "executePlaceOrder error: " . mysqli_error($con);
            } else {
                $err = "executePlaceOrder query failed";
            }
        }


        $eventId = 0;
        $venueId = 0;
        $ticktTypeId = 0;
        $ticktQnty = 0;
        $ticktPrice = 0;
        $ticktDiscount = 0;
        $orderSubTotal = 0;
        $orderTotalDiscount = 0;
        for ($i = 1; $i <= 6; $i++) {
            if (isset($_POST['form_event_id_' . $i]) AND isset($_POST['form_event_id_' . $i]) AND isset($_POST['selVenueLost_' . $i]) AND isset($_POST['txtQunty_' . $i])) {
                $eventId = $_POST['form_event_id_' . $i];
                $venueId = $_POST['selVenueLost_' . $i];
                $ticktTypeId = $_POST['selTicktList_' . $i];
                $ticktQnty = $_POST['txtQunty_' . $i];

                $sqlCheckTickt = "SELECT TT_current_price "
                        . "FROM event_ticket_types "
                        . "WHERE TT_event_id=$eventId "
                        . "AND TT_venue_id=$venueId "
                        . "AND TT_id=$ticktTypeId "
                        . "AND TT_status='active'";
                $resultCheckTickt = mysqli_query($con, $sqlCheckTickt);
                if ($resultCheckTickt) {
                    $resultCheckTicktObj = mysqli_fetch_object($resultCheckTickt);
                    if (isset($resultCheckTicktObj->TT_current_price)) {
                        $ticktPrice = $resultCheckTicktObj->TT_current_price;
                    }
                } else {
                    $checkStatus++;
                    if (DEBUG) {
                        $err = "resultCheckTickt error: " . mysqli_error($con);
                    } else {
                        $err = "resultCheckTickt query failed";
                    }
                }

                //calculating total price for all tickets
                $orderSubTotal += $ticktQnty * $ticktPrice;
                $orderTotalDiscount += $ticktQnty * $ticktDiscount;

                $saveOrderEvent = '';
                $saveOrderEvent .= ' OE_order_id = "' . validateInput($orderId) . '"';
                $saveOrderEvent .= ', OE_event_id = "' . validateInput($eventId) . '"';
                $saveOrderEvent .= ', OE_session_id = "' . validateInput($sessionID) . '"';
                $saveOrderEvent .= ', OE_user_id = "' . validateInput($userId) . '"';

                $sqlSaveEventOrder = "INSERT INTO order_events SET $saveOrderEvent";
                $resultSaveOrderEvent = mysqli_query($con, $sqlSaveEventOrder);

                if (!$resultSaveOrderEvent) {
                    $checkStatus++;
                    if (DEBUG) {
                        $err = "resultSaveOrderEvent error: " . mysqli_error($con);
                    } else {
                        $err = "resultSaveOrderEvent query failed";
                    }
                } else {
                    $orderEventId = mysqli_insert_id($con);
                }


                $saveOrderItem = '';
                $saveOrderItem .= ' OI_OE_id = "' . validateInput($orderEventId) . '"';
                $saveOrderItem .= ', OI_order_id = "' . validateInput($orderId) . '"';
                $saveOrderItem .= ', OI_session_id = "' . validateInput($sessionID) . '"';
                $saveOrderItem .= ', OI_unique_id = "' . validateInput(randCode(29)) . '"';
                $saveOrderItem .= ', OI_item_type = "' . validateInput("ticket") . '"';
                $saveOrderItem .= ', OI_venue_id = "' . validateInput($venueId) . '"';
                $saveOrderItem .= ', OI_item_id = "' . validateInput($ticktTypeId) . '"';
                $saveOrderItem .= ', OI_quantity = "' . validateInput($ticktQnty) . '"';
                $saveOrderItem .= ', OI_unit_price = "' . validateInput($ticktPrice) . '"';
                $saveOrderItem .= ', OI_unit_discount = "' . validateInput($ticktDiscount) . '"';
                $saveOrderItem .= ', OI_is_verified = "' . validateInput("no") . '"';

                $sqlSaveItemOrder = "INSERT INTO order_items SET $saveOrderItem";
                $resultSaveOrderItem = mysqli_query($con, $sqlSaveItemOrder);

                if (!$resultSaveOrderItem) {
                    $checkStatus++;
                    if (DEBUG) {
                        $err = "resultSaveOrderItem error: " . mysqli_error($con);
                    } else {
                        $err = "resultSaveOrderItem query failed";
                    }
                }
            }
        }

        $updateOrder = '';
        $updateOrder .= ' order_total_amount = "' . validateInput($orderSubTotal) . '"';
        $updateOrder .= ', order_discount_amount = "' . validateInput($orderTotalDiscount) . '"';

        $sqlUpdateOrder = "UPDATE orders SET $updateOrder WHERE order_id=$orderId";
        $resultUpdateOrder = mysqli_query($con, $sqlUpdateOrder);

        if (!$resultUpdateOrder) {
            $checkStatus++;
            if (DEBUG) {
                $err = "resultUpdateOrder error: " . mysqli_error($con);
            } else {
                $err = "resultUpdateOrder query failed";
            }
        }
    }


    if ($checkStatus == 0) {
        $msg = "Order saved successfully.";
    } else {
        $msg = "Order save failed. Please check all queries.";
    }
}
//debug($arrAllEvents);
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
            <h3 class="bg-white content-heading border-bottom strong">Place Manual Order</h3>
            <div class="hidden-print bg-white innerAll border-bottom">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <br/>
            <div class="col-md-12">
                <form method="POST" id="submitOrder" action="manual_order.php">
                    
                        <div class="row">
                            <div class="form-group add-field">
                                <span class="fieldForm">
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Event Title</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <select onchange="javascript:getVenues(this.value, 1);" class="form-control" id="form_event_id" name="form_event_id_1">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arrAllEvents) > 0): ?>
                                                    <?php foreach ($arrAllEvents AS $Event): ?>
                                                        <option value="<?php echo $Event->event_id; ?>"><?php echo $Event->event_title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Venue Title</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <span id="selVenueLost_1">
                                                <select class="form-control" name="selVenueLost_1">
                                                    <option value="0">Select Venue</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Ticket Type</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <span id="selTicktList_1">
                                                <select class="form-control" name="selTicktList_1">
                                                    <option value="0">Select Ticket</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Ticket Quantity</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <span id="selQntyList">
                                                <input class="form-control" type="text" name="txtQunty_1">
                                            </span>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-3 pull-right">
                                <button onclick="javascript:generateFieldDiv();" type="button" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Add Row</button>
                            </div>
                        </div>
                        <br/><br/>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Customer's First Name</label>
                                    <br/>
                                    <div class="col-md-12">
                                        <input value="<?php echo $userFName; ?>" type="text" name="userFName" id="userFName" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Customer's Last Name</label>
                                    <br/>
                                    <div class="col-md-12">
                                        <input value="<?php echo $userLName; ?>" type="text" name="userLName" id="userLName" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Customer's Phone</label>
                                    <br/>
                                    <div class="col-md-12">
                                        <input value="<?php echo $userPhone; ?>" type="text" name="userPhone" id="userPhone" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Customer's Email</label>
                                    <br/>
                                    <div class="col-md-12">
                                        <input value="<?php echo $userEmail; ?>" type="text" name="userEmail" id="userEmail" class="form-control" />
                                    </div>
                                </div>

                                <div class="clearfix"></div><br/>

                                <div class="col-md-6 text-right">
                                    <label class="col-md-12 control-label">Is Home Delivery?</label>
                                    <br/>
                                    <div class="col-md-12">
                                        <input type="checkbox" name="chkDelivery" id="chkDelivery" />
                                    </div>
                                </div>

                                <div class="clearfix"></div><br/>

                                <span id="showDeliveryOpt" style="display: none;">
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Customer's Address</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <input value="<?php echo $userAddress; ?>" type="text" name="userAddress" class="form-control" id="userAddress" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Customer's Zip/Postal Code</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <input value="<?php echo $userZip; ?>" type="text" name="userZip" class="form-control" id="userZip" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Customer's City</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <select name="userCity" class="form-control" id="userCity">
                                                <option value="0">Select City</option>
                                                <?php if (count($cityArray) >= 1): ?>
                                                    <?php foreach ($cityArray as $city): ?>
                                                        <option 
                                                            value="<?php echo $city->city_name; ?>|<?php echo $city->city_delivery_charge; ?>"
                                                            <?php
                                                            if ($city->city_name . "|" . $city->city_delivery_charge == $userCity) {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>
                                                            <?php echo $city->city_name; ?> (Charge: <?php echo $city->city_delivery_charge; ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-12 control-label">Customer's Country</label>
                                        <br/>
                                        <div class="col-md-12">
                                            <select name="userCountry" id="userCountry" class="form-control">
                                                <option value="0">Select Country</option>
                                                <?php if (count($countryArray) >= 1): ?>
                                                    <?php foreach ($countryArray as $country): ?>
                                                        <option 
                                                            value="<?php echo $country->country_name; ?>"
                                                            <?php
                                                            if ($country->country_name == $userCountry) {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>
                                                            <?php echo $country->country_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <br/><br/>
                        <button type="button" onclick="javascript:submitOrder();"  class="btn btn-primary" style="margin-left: 10px;" name="btnSubmit"><i class="fa fa-plus-circle"></i> Submit</button>
                    </div>
                </form>




        </div>


        <?php include basePath('admin/footer.php'); ?>


        <?php include basePath('admin/footer_script.php'); ?>

        <script>
            function getVenues(eventId, divId) {

                if (eventId > 0) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo baseUrl(); ?>" + "admin/controller/manual_order/getVenues.php",
                        data: {
                            eventId: eventId
                        },
                        success: function (response) {
                            var obj = $.parseJSON(response);
                            var newHtml = "";
                            if (obj.output === "success") {
                                newHtml += '<select class="form-control" name="selVenueLost_' + divId + '" onchange="javascript:getTickets(this.value,' + divId + ');">';
                                newHtml += '<option value="0">Select Venue</option>';
                                $.each(obj.resultGetVenuesObj, function (key, Venue) {
                                    newHtml += '<option value="' + Venue.venue_id + '">' + Venue.venue_title + ' (' + Venue.DateMod + ')</option>';
                                });
                                newHtml += '</select>';

                                $("#selVenueLost_" + divId).html(newHtml);
                            } else {
                                alert("Ajax response failed.")
                            }
                        }
                    });
                }
            }

            function getTickets(venueId, divId) {

                if (venueId > 0) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo baseUrl(); ?>" + "admin/controller/manual_order/getTickets.php",
                        data: {
                            venueId: venueId
                        },
                        success: function (response) {
                            var obj = $.parseJSON(response);
                            var newHtmlTickts = "";
                            var newHtmlQnty = "";
                            if (obj.output === "success") {
                                newHtmlTickts += '<select class="form-control" id="ticktList" name="selTicktList_' + divId + '">';
                                newHtmlTickts += '<option value="0">Select Ticket</option>';
                                $.each(obj.resultGetTicketsObj, function (key, Ticket) {
                                    if (Ticket.TT_ticket_quantity > 0) {
                                        newHtmlTickts += '<option value="' + Ticket.TT_id + '" limit="' + Ticket.TT_per_user_limit + '">' + Ticket.TT_type_title + ' (' + Ticket.TT_current_price + '; Limit: ' + Ticket.TT_per_user_limit + ')</option>';
                                    } else {
                                        newHtmlTickts += '<option value="' + Ticket.TT_id + '" disabled>' + Ticket.TT_type_title + ' (' + Ticket.TT_current_price + ') - SOLD OUT</option>';
                                    }
                                });
                                newHtmlTickts += '</select>';

                                $("#selTicktList_" + divId).html(newHtmlTickts);
                            } else {
                                alert("Ajax response failed.")
                            }
                        }
                    });
                }
            }


            function generateFieldDiv() {
                // Field Generate Function
                var count = $('span.fieldForm').length;
                var fieldHTML = '';
                if (count + 1 > 6) {
                    alert("You cant add more than 6 field in this form.")
                } else {

                    fieldHTML += '<span class="fieldForm">';
                    fieldHTML += '<div class="col-md-3">';
                    fieldHTML += '<label class="col-md-12 control-label">Event Title</label>';
                    fieldHTML += '<br/>';
                    fieldHTML += '<div class="col-md-12">';
                    fieldHTML += '<select onchange="javascript:getVenues(this.value,' + parseInt(count + 1) + ');" class="form-control" id="form_event_id" name="form_event_id_' + parseInt(count + 1) + '">';
                    fieldHTML += '<option value="0">Select Event</option>';
<?php if (count($arrAllEvents) > 0): ?>
    <?php foreach ($arrAllEvents AS $Event): ?>
                            fieldHTML += '<option value="<?php echo $Event->event_id; ?>"><?php echo $Event->event_title; ?></option>';
    <?php endforeach; ?>
<?php endif; ?>
                    fieldHTML += '</select>';
                    fieldHTML += '</div>';
                    fieldHTML += '</div>';
                    fieldHTML += '<div class="col-md-3">';
                    fieldHTML += '<label class="col-md-12 control-label">Venue Title</label>';
                    fieldHTML += '<br/>';
                    fieldHTML += '<div class="col-md-12">';
                    fieldHTML += '<span id="selVenueLost_' + parseInt(count + 1) + '">';
                    fieldHTML += '<select class="form-control" name="selVenueLost_' + parseInt(count + 1) + '">';
                    fieldHTML += '<option value="0">Select Venue</option>';
                    fieldHTML += '</select>';
                    fieldHTML += '</span>';
                    fieldHTML += '</div>';
                    fieldHTML += '</div>';
                    fieldHTML += '<div class="col-md-3">';
                    fieldHTML += '<label class="col-md-12 control-label">Ticket Type</label>';
                    fieldHTML += '<br/>';
                    fieldHTML += '<div class="col-md-12">';
                    fieldHTML += '<span id="selTicktList_' + parseInt(count + 1) + '">';
                    fieldHTML += '<select class="form-control" name="selTicktList_' + parseInt(count + 1) + '">';
                    fieldHTML += '<option value="0">Select Ticket</option>';
                    fieldHTML += '</select>';
                    fieldHTML += '</span>';
                    fieldHTML += '</div>';
                    fieldHTML += '</div>';
                    fieldHTML += '<div class="col-md-3">';
                    fieldHTML += '<label class="col-md-12 control-label">Ticket Quantity</label>';
                    fieldHTML += '<br/>';
                    fieldHTML += '<div class="col-md-12">';
                    fieldHTML += '<span id="selQntyList_' + parseInt(count + 1) + '">';
                    fieldHTML += '<input class="form-control" type="text" name="txtQunty_' + parseInt(count + 1) + '">';
                    fieldHTML += '</span>';
                    fieldHTML += '</div>';
                    fieldHTML += '</div>';
                    fieldHTML += '</span>';

                }
                $("div.add-field").append(fieldHTML);
            }



            $("#chkDelivery").click(function () {
                if ($(this).prop('checked')) {
                    $("#showDeliveryOpt").show();
                } else {
                    $("#showDeliveryOpt").hide();
                }
            });



            function submitOrder() {
                var status = 0;

                if ($("#userFName").val() == "") {
                    $("#userFName").addClass("has-error");
                    status++;
                } else {
                    $("#userFName").removeClass("has-error");
                }

                if ($("#userPhone").val() == "") {
                    $("#userPhone").addClass("has-error");
                    status++;
                } else {
                    $("#userPhone").removeClass("has-error");
                }

                if ($("#userEmail").val() == "") {
                    $("#userEmail").addClass("has-error");
                    status++;
                } else {
                    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                    var email = $("#userEmail").val();
                    if (pattern.test(email)) {
                        $("#userEmail").removeClass("has-error");
                    } else {
                        status++;
                        $("#userEmail").addClass("has-error");
                    }
                }

                if ($("#chkDelivery").prop('checked')) {
                    if ($("#userAddress").val() == "") {
                        $("#userAddress").addClass("has-error");
                        status++;
                    } else {
                        $("#userAddress").removeClass("has-error");
                    }

                    if ($("#userZip").val() == "") {
                        $("#userZip").addClass("has-error");
                        status++;
                    } else {
                        $("#userZip").removeClass("has-error");
                    }

                    if ($("#userCity").val() == 0) {
                        $("#userCity").addClass("has-error");
                        status++;
                    } else {
                        $("#userCity").removeClass("has-error");
                    }

                    if ($("#userCountry").val() == 0) {
                        $("#userCountry").addClass("has-error");
                        status++;
                    } else {
                        $("#userCountry").removeClass("has-error");
                    }
                }



                if (status === 0) {
                    $("#submitOrder").submit();
                }

            }

        </script>
        <script type="text/javascript">
            $("#manualorder").addClass("active");
            $("#manualorder").parent().parent().addClass("active");
            $("#manualorder").parent().addClass("in");
        </script>
    </body>
</html>