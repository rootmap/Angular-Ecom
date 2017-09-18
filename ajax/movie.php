<?php
session_start();
extract($_POST);
$request_type = $_SERVER['REQUEST_METHOD'];
if ($request_type == "POST") {
    include "../config/config.php";
    include "../admin/event/blockbuster_api_class/GenerateSecretKey.php";
    $obj = new configtoapi();
    $api = new XmlToJson();

    //exit();
    if ($st == 1) {
        $show_time = $api->getShowTime($movie_id, $request_date);
        if(empty($show_time['DTMID']))
        {
            echo 0;
        }
        else
        {
        //echo var_dump($show_time);
       
        //echo var_dump($show_time);
        ?>
        <div class="alert alert-success" role="alert">Please Select Movie Show Time</div>
        <?php
        for ($i = 1; $i <= 5; $i++):
            if ($show_time['Show_0' . $i] != "No-Show") {
                ?>
                <div class="col-md-12" style="border-radius: 4px; text-align: left; margin-bottom: 4px;">
                    <div class="input-group"  style="border-radius: 4px; margin-bottom: 4px;">
                        <span class="input-group-addon" style="border-radius: 4px;  text-align: left;">
                            <input name="slot" id="slot<?php echo '0' . $i; ?>" type="radio" aria-label="..."> Show Time <?php echo $i; ?> : <?php echo $show_time['Show_0' . $i]; ?>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <?php
            }
        endfor;
        ?>
        <input type="hidden" id="movie_id" value="<?php echo $movie_id; ?>" />
        <input type="hidden" id="movie_name" value="<?php echo $movie_name; ?>" />
        <input type="hidden" id="request_date" value="<?php echo $request_date; ?>" />
        <button id="show_time" type="button" class="btn btn-primary btn-block"><i class="icon-search"></i> Next Step</button>
        <script>
            $(document).ready(function () {

                $('button#show_time').click(function () {
                    success("Please Wait Your Movie Show Time Data is Processing");
                    var loader = '<img src="<?php echo baseUrl(); ?>images/loading.gif">';
                    var slot = "0";
                    if ($('#slot01').is(':checked')) {
                        //alert("01");
                        var slot = "01";
                        var slot_time = "<?php echo $show_time['Show_01']; ?>";
                    }
                    else if ($('#slot02').is(':checked')) {
                        //alert("02");
                        var slot = "02";
                        var slot_time = "<?php echo $show_time['Show_02']; ?>";
                    }
                    else if ($('#slot03').is(':checked')) {
                        //alert("03");
                        var slot = "03";
                        var slot_time = "<?php echo $show_time['Show_03']; ?>";
                    }
                    else if ($('#slot04').is(':checked')) {
                        //alert("04");
                        var slot = "04";
                        var slot_time = "<?php echo $show_time['Show_04']; ?>";
                    }
                    else if ($('#slot05').is(':checked')) {
                        //alert("05");
                        var slot = "05";
                        var slot_time = "<?php echo $show_time['Show_05']; ?>";
                    }

                    var dtmid = '<?php echo $show_time['DTMID']; ?>';
                    var movie_id = $('#movie_id').val();
                    var movie_name = $('#movie_name').val();
                    var request_date = $('#request_date').val();
                    
                    $("form#booking_step_1").html(loader);
                    $.post("<?php echo baseUrl(); ?>ajax/movie.php", {'st': 2, 'dtmid': dtmid, 'slot': slot,'slot_time': slot_time, 'movie_id': movie_id, 'movie_name': movie_name, 'request_date': request_date}, function (data) {
                        $("form#booking_step_1").html(data);
                    });

                });

            });

        </script>
        <?php
        }
    } elseif ($st == 2) {
        $seatstatus = $api->getShowTimeSeatStatus($dtmid, $slot);
        //echo var_dump($seatstatus);
        ?>
        <div class="alert alert-success" role="alert">Please Select Seat Category</div>
        <?php
        $seatcategory = explode("|", $seatstatus['SeatClass']);
        $seatcategory_price = explode("|", $seatstatus['SeatClassTicketPrice']);
        $type = 1;
        foreach ($seatcategory as $seat_type):
            ?>
            <div class="col-md-12" style="border-radius: 4px; text-align: left; padding-left: 0px; margin-bottom: 4px;">
                <div class="input-group"  style="border-radius: 4px;  padding-left: 0px; margin-bottom: 4px;">
                    <span class="input-group-addon" style="border-radius: 4px;  text-align: left;">
                        <input name="seat_type" id="type<?php echo $type; ?>" type="radio" aria-label="..."> <?php echo $seat_type; ?> : <?php
                        $param = $type - 1;
                        echo $seatcategory_price[$param];
                        ?>
                        <input type="hidden" value="<?php echo $seatcategory_price[$param]; ?>" id="type<?php echo $type; ?>_p"  />
                    </span>
                </div><!-- /input-group -->
            </div>
            <?php
            $type++;
        endforeach;
        ?>
        <div class="col-md-12" style="border-radius: 4px; text-align: left; padding-left: 0px; margin-bottom: 4px;">
            <div class="input-group"  style="border-radius: 4px;  padding-left: 0px; margin-bottom: 4px;">
                <select id="quantity_id" style="height: 35px;" class="form-control">
                    <option value="0">Select Quantity</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++):
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                    endfor;
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-12" id="quantity_price_place" style="border-radius: 4px; display: none; text-align: left; padding-left: 0px; margin-bottom: 4px;">
            <div class="input-group"  style="border-radius: 4px;  padding-left: 0px; margin-bottom: 4px;">
                <span class="input-group-addon" id="quantity_price" style="border-radius: 4px;  text-align: left;">

                </span>
            </div><!-- /input-group -->
        </div>
        <input type="hidden" id="movie_id" value="<?php echo $movie_id; ?>" />
         <input type="hidden" id="slot_time" value="<?php echo $slot_time; ?>" />
        <input type="hidden" id="movie_name" value="<?php echo $movie_name; ?>" />
        <input type="hidden" id="request_date" value="<?php echo $request_date; ?>" />
        <button id="seat_tp" type="button" class="btn btn-primary btn-block"><i class="icon-search"></i> Next Step</button>
        <script>
            $(document).ready(function () {

                $('#quantity_id').change(function () {
                    var getquantity = $(this).val();
                    if (getquantity != "0")
                    {
                    //alert('Success');
                    var seat_price = '0';
        <?php
        $stp = 1;
        foreach ($seatcategory as $seat_type):
            if ($stp == 1) {
                ?>
                            if ($('#type<?php echo $stp; ?>').is(':checked')) {
                            //alert("01");
                            var seat_price = $('#type<?php echo $stp; ?>_p').val();
                                    //console.log(seat_price);
                            }
                <?php
            } else {
                ?>
                            else if ($('#type<?php echo $stp; ?>').is(':checked')) {
                            //alert("01");
                            var seat_price = $('#type<?php echo $stp; ?>_p').val();
                            }
                <?php
            }
            $stp++;
        endforeach;
        ?>

                    var totalamountofprice = (seat_price * getquantity);
                            $('#quantity_price_place').show('slow');
                            //console.log(getquantity);
                            //console.log(totalamountofprice);
                            //console.log(seat_price);
                            var htmlstring = "Seat Quantity : " + getquantity + " & Total Price : ৳ " + totalamountofprice;
                            $('#quantity_price').html(htmlstring);
                    }
                    else
                    {
                        $('#quantity_price_place').hide('slow');
                        }
                    }
                    );
                            $('button#seat_tp').click(function () {
                        success("Please Wait Your Movie Seat & Quantity Data is Processing");
                        var loader = '<img src="<?php echo baseUrl(); ?>images/loading.gif">';
                        var seat_type = "0";
                        var seat_price = "0";
        <?php
        $stp = 1;
        foreach ($seatcategory as $seat_type):
            if ($stp == 1) {
                ?>
                                if ($('#type<?php echo $stp; ?>').is(':checked')) {
                                    //alert("01");
                                    var seat_type = '<?php echo $seat_type; ?>';
                                    var seat_price = $('#type<?php echo $stp; ?>_p').val();
                                }
                <?php
            } else {
                ?>
                                else if ($('#type<?php echo $stp; ?>').is(':checked')) {
                                //alert("01");
                                var seat_type = '<?php echo $seat_type; ?>';
                                var seat_price = $('#type<?php echo $stp; ?>_p').val();
                            }
                <?php
            }
            $stp++;
        endforeach;
        ?>
                    var seatquantity = $('#quantity_id').val();
                    var dtmsid = '<?php echo $seatstatus['DTMSID']; ?>';
                    var movie_id = $('#movie_id').val();
                    var slot_time = $('#slot_time').val();
                    var movie_name = $('#movie_name').val();
                    var request_date = $('#request_date').val();
                    // $("form#booking_step_1").html(loader);
                    $.post("<?php echo baseUrl(); ?>ajax/movie.php", {'st': 3, 'dtmsid': dtmsid, 'seat': seatquantity, 'seat_type': seat_type, 'seat_price': seat_price,'slot_time':slot_time, 'movie_id': movie_id, 'movie_name': movie_name, 'request_date': request_date}, function (data) {

                        $("form#booking_step_1").html(data);
                    });
                });
            });

        </script>
        <?php
    } elseif ($st == 3) {
        ?>

        <div class="alert alert-warning" role="alert"><?php echo $obj->clean($movie_name); ?> / <?php echo $obj->clean($seat_type); ?> : <?php echo $obj->clean($seat); ?> / ৳ : <?php
            $total = $seat_price * $seat;
            echo $obj->clean($total);
            ?></div>

        <div class="input-group" style="margin-bottom: 5px;">
            <span class="input-group-addon" style="width: 100px; text-align: left;" id="sizing-addon2">Full Name</span>
            <input id="fullname" type="text" style="height: 35px; background: #FFF; border: 1px #ccc solid;" class="form-control" placeholder="Full Name" aria-describedby="sizing-addon2">
        </div>

        <div class="input-group" style="margin-bottom: 5px;">
            <span class="input-group-addon"  style="width: 100px; text-align: left;" id="sizing-addon2">Email</span>
            <input id="email" type="text"  style="height: 35px; background: #FFF; border: 1px #ccc solid;" class="form-control" placeholder="Email Address" aria-describedby="sizing-addon2">
        </div>

        <div class="input-group" style="margin-bottom: 5px;">
            <span class="input-group-addon"  style="width: 100px; text-align: left;" id="sizing-addon2">Mobile</span>
            <input type="text" value="+880" style="height: 35px; width:60px;  background: #FFF; border: 1px #ccc solid; border-right: 0px;" class="form-control" placeholder="Phone/Mobile" aria-describedby="sizing-addon2">
            <input id="mobile" type="text" style="height: 35px; width: 140px; background: #FFF; border: 1px #ccc solid;" class="form-control" placeholder="Last 10 Digit" aria-describedby="sizing-addon2">
        </div>

        <div class="col-md-6" style="padding-left: 0px;">
            <div class="input-group" style="margin-bottom: 5px;">
                <input type="text"  id="datepicker" style="height: 35px;"  class="form-control" placeholder="Date of birth">
            </div>
        </div>
        <div class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
            <div class="input-group" style="margin-bottom: 5px;">
                <select id="gender" style="height: 35px; width: 150px;" class="form-control">
                    <option value="0">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
            </div>
        </div>

        <input type="hidden" id="movie_id" value="<?php echo $movie_id; ?>" />
        <input type="hidden" id="seat" value="<?php echo $seat; ?>" />
        <input type="hidden" id="seat_unit_price" value="<?php echo $seat_price; ?>" />
        <input type="hidden" id="seat_type" value="<?php echo $seat_type; ?>" />
        <input type="hidden" id="movie_name" value="<?php echo $movie_name; ?>" />
        <input type="hidden" id="request_date" value="<?php echo $request_date; ?>" />
        <input type="hidden" id="dtmsid" value="<?php echo $dtmsid; ?>" />
        <input type="hidden" id="slot_time" value="<?php echo $slot_time; ?>" />
        <button id="seat_tpc" type="button" class="btn btn-primary btn-block"><i class="icon-search"></i> Next Step</button>
        <script>
            $(document).ready(function () {
                $('#datepicker').click(function () {
                    if ($(this).val() == "")
                    {
                        $(this).val('0000-00-00');
                    }
                });
                $('button#seat_tpc').click(function () {

                    var seatquantity = $('#seat').val();
                    success("Please Wait Sending Information For Booking " + seatquantity + " Seat ");
                    var loader = '<img src="<?php echo baseUrl(); ?>images/loading.gif">';

                    var dtmsid = $('#dtmsid').val();
                    var fullname = $('#fullname').val();
                    var email = $('#email').val();
                    var mobile = $('#mobile').val();
                    var dob = $('#datepicker').val();
                    var sex = $('#gender').val();
                    var movie_id = $('#movie_id').val();
                    var movie_name = $('#movie_name').val();
                    var request_date = $('#request_date').val();
                    var seat_price = $('#seat_unit_price').val();
                    var seat_type = $('#seat_type').val();
                    var slot_time = $('#slot_time').val();
                    // $("form#booking_step_1").html(loader);
                    $.post("<?php echo baseUrl(); ?>ajax/movie.php", {'st': 4,
                        'dtmsid': dtmsid,
                        'seat': seatquantity,
                        'seat_type': seat_type,
                        'seat_price': seat_price,
                        'movie_id': movie_id,
                        'movie_name': movie_name,
                        'fullname': fullname,
                        'email': email,
                        'mobile': mobile,
                        'dob': dob,
                        'sex': sex,
                        'slot_time':slot_time,
                        'request_date': request_date}, function (data) {
                        $.post("<?php echo baseUrl(); ?>ajax/movie.php", {'st': 6, 'dtmsid': dtmsid, 'seatclass': seat_type, 'seat': seatquantity, 'cusname': fullname, 'cusemail': email, 'cusmobile': mobile,'slot_time':slot_time}, function (data1) {
                            var datacl = jQuery.parseJSON(data1);
                            var status = datacl.status;
                            if (status == 1)
                            {
                                $("form#booking_step_1").html(data);
                            }
                            else
                            {
                                $("form#booking_step_1").html(data);
                            }
                        });

                        //$("form#booking_step_1").html(data);


                    });
                });
            });

        </script>
        <?php
    } elseif ($st == 4) {

        $order_id = $obj->OrderID(@$_SESSION['SESS_ORDER_ID'], $movie_id);

        $chk = $obj->FlyQuery("SELECT * FROM users WHERE (user_email='" . $email . "' OR user_phone='" . $mobile . "')", "2");
        if ($chk == 0) {

            $obj->FlyQuery("INSERT INTO users SET user_email='" . $email . "',user_first_name='" . $fullname . "',user_DOB='" . $dob . "',user_gender='" . $sex . "',user_phone='" . $mobile . "'", "3");
            $customer_id = $obj->FlyQuery("SELECT user_id,user_email FROM users WHERE user_email='" . $email . "'", "1");

            //echo "INSERT INTO users SET user_email='".$email."',user_first_name='".$fullname."',user_DOB='".$dob."',user_gender='".$sex."',user_phone='".$mobile."'";

            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $customer_id[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='".$slot_time."'";
            $ins .=",seat_unit_price='" . $seat_price . "'";
            $ins .=",seat_type='" . $seat_type . "'";
            $ins .=",request_date='" . $request_date . "'";
            $ins .=",fullname='" . $fullname . "'";
            $ins .=",email='" . $email . "'";
            $ins .=",mobile='" . $mobile . "'";
            $ins .=",dob='" . $dob . "'";
            $ins .=",sex='" . $sex . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='0'";
            $obj->FlyQuery("INSERT INTO order_movie_event SET " . $ins, "3");
        } else {
            $usersql = $obj->FlyQuery("SELECT * FROM users WHERE (user_email='" . $email . "' OR user_phone='" . $mobile . "')", "1");
            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $usersql[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='".$slot_time."'";
            $ins .=",seat_unit_price='" . $seat_price . "'";
            $ins .=",seat_type='" . $seat_type . "'";
            $ins .=",request_date='" . $request_date . "'";
            $ins .=",fullname='" . $fullname . "'";
            $ins .=",email='" . $email . "'";
            $ins .=",mobile='" . $mobile . "'";
            $ins .=",dob='" . $dob . "'";
            $ins .=",sex='" . $sex . "'";
            $ins .=",date='" . date('Y-m-d') . "'";
            $ins .=",status='0'";

            $obj->FlyQuery("INSERT INTO order_movie_event SET " . $ins, "3");
        }

        $amount = $seat_price * $seat;
        ?>

        <div class="alert alert-danger" role="alert">Note: Please make sure to complete your payment transaction with in 15 minutes. </div>

        <div class="col-md-12" style="border-radius: 4px; text-align: left; padding-left: 0px; margin-bottom: 4px;">
            <div class="input-group"  style="border-radius: 4px;  padding-left: 0px; margin-bottom: 4px;">
                <span class="input-group-addon" style="border-radius: 4px;  text-align: left;">
                    <input name="ticket_type" checked="checked" id="ticket_type" type="radio" aria-label="...">  Ticket Type : E-Ticket
                </span>
            </div><!-- /input-group -->
        </div>

        <div class="col-md-12" style="border-radius: 4px; text-align: left; padding-left: 0px; margin-bottom: 4px;">
            <div class="input-group"  style="border-radius: 4px;  padding-left: 0px; margin-bottom: 4px;">
                <span class="input-group-addon" style="border-radius: 4px;  text-align: left;">
                    <input name="payment_method" checked="checked"  name="payment_method" id="payment_method" type="radio" aria-label="..."> Payment Method :
                    Online
                </span>
            </div><!-- /input-group -->
        </div>

        <button id="payment" type="button" class="btn btn-primary btn-block"><i class="icon-search"></i> Pay Now</button>
        <script>
            $(document).ready(function () {
                $('button#payment').click(function () {
                    success("Please Wait page is redirecting to payment page.");
                    var loader = '<img src="<?php echo baseUrl(); ?>images/loading.gif">';
                    // $("form#booking_step_1").html(loader);
                    $.post("<?php echo baseUrl(); ?>ajax/movie.php", {'st': 5, 'order_id': '<?php echo $order_id; ?>', 'amount': '<?php echo $amount; ?>'}, function (data) {
                        $("form#booking_step_1").html(loader);
                        window.location.replace('<?php echo baseUrl(); ?>processing_online_movie.php?total=<?php echo $amount; ?>&oid=<?php echo $order_id; ?>');
                                    });
                                });
                            });

        </script>                          
        <?php
    } elseif ($st == 5) {
        echo 1;
    } elseif ($st == 6) {
        $dd = $api->SecureBookingApi($dtmsid, $seatclass, $seat, $cusname, $cusemail, $cusmobile);
        if ($dd['status'] == "9999") {
            $array = array("status" => 1, "seat_number" => $dd['seat_numbers']);
            $order_id = $obj->OrderID(@$_SESSION['SESS_ORDER_ID'], $movie_id);
            $obj->FlyQuery("UPDATE order_movie_event SET seat_number='".$dd['seat_numbers']."' WHERE order_id='" . $order_id . "'", "3");
        } else {
            $array = array("status" => 0, "seat_number" => "0,0");
        }
        echo json_encode($array);
    }
} else {
    echo "...OFF";
}



