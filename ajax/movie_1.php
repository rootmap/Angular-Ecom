<?php
session_start();
extract($_POST);
$request_type = $_SERVER['REQUEST_METHOD'];
include '../cms/plugin.php';
$cms = new plugin();

function CountDate($exdate) {
    $date1 = new DateTime($exdate);
    $date2 = new DateTime(date('Y-m-d'));
    $diff = $date2->diff($date1)->format("%a");
    return $diff;
}

if ($request_type == "POST") {
    include "../config/config.php";
    include "../admin/event/blockbuster_api_class/GenerateSecretKey.php";
    $obj = new configtoapi();
    $api = new XmlToJson();

    //exit();
    if ($st == 1) {
        @$show_time = $api->getShowTime($movie_id, $request_date);
        if (empty($show_time['DTMID'])) {
            echo 0;
        } else {
            //echo var_dump($show_time);
            ?>
            <!--        <div class="alert alert-success" role="alert">Please Select Movie Show Time</div>-->
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
                <input type="hidden" id="theatre_id" value="<?php echo $theatre_id; ?>" />
                <!--        <button id="show_time" type="button" class="btn btn-primary pull-right"><i class="fa fa-ticket"></i> Next </button>-->
                <script>
                    $(document).ready(function () {

                        $('input[name=slot]').click(function () {
                            success("Please Wait Your Movie Show Time Data is Processing");
                            var slot = "0";
                            if ($('#slot01').is(':checked')) {
                            //alert("01");
                            var slot = "01";
                            var slot_time = '<?php echo $show_time['Show_01']; ?>';
                            ticketcategory(slot, slot_time);
                        } else if ($('#slot02').is(':checked')) {
                            //alert("02");
                            var slot = "02";
                            var slot_time = '<?php echo $show_time['Show_02']; ?>';
                            ticketcategory(slot, slot_time);
                        } else if ($('#slot03').is(':checked')) {
                            //alert("03");
                            var slot = "03";
                            var slot_time = '<?php echo $show_time['Show_03']; ?>';
                            ticketcategory(slot, slot_time);
                        } else if ($('#slot04').is(':checked')) {
                            //alert("04");
                            var slot = "04";
                            var slot_time = '<?php echo $show_time['Show_04']; ?>';
                            ticketcategory(slot, slot_time);
                        } else if ($('#slot05').is(':checked')) {
                            //alert("05");
                            var slot = "05";
                            var slot_time = '<?php echo $show_time['Show_05']; ?>';
                            ticketcategory(slot, slot_time);
                        }

                        $("#s_show_time").html(slot_time);
                    });
                    });
                    function ticketcategory(slot, slot_time)
                    {
                        var loader = '<img src="<?php echo $cms->LbaseUrl(); ?>favicon/loading.gif">';
                        var dtmid = '<?php echo $show_time['DTMID']; ?>';
                        var movie_id = $('#movie_id').val();
                        var movie_name = $('#movie_name').val();
                        var theatre_id = $('#theatre_id').val();
                        var request_date = $('#request_date').val();
                        $("#step_2_2").html(loader);
                        $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 2, 'dtmid': dtmid, 'slot': slot, 'movie_id': movie_id, 'movie_name': movie_name, 'request_date': request_date, 'theatre_id': theatre_id, 'slot_time': slot_time}, function (data) {

                            $("#step_2_2").html(data);
                        });
                    }
                </script>
                <?php
            }
        } elseif ($st == 2) {
            $seatstatus = $api->getShowTimeSeatStatus($dtmid, $slot);

            $seatcategory = explode("|", $seatstatus['SeatClass']);
            $seatcategory_price = explode("|", $seatstatus['SeatClassTicketPrice']);
            $type = 1;
            ?> 
            <div class="col-md-12" style="border-radius: 4px; text-align: left; padding-left: 0px; margin-bottom: 4px;">
                <style type="text/css">
                    .fe{padding-left:10px !important; display:block !important; background-image:none !important; border:1px solid #ccc !important; border-radius:4px !important;}
                    .fl{color:#000 !important; font-weight:bolder !importnat;}
                </style>
                <div class="movie_seat_type">
                    <table class="table table-bordered seat-tbl">
                        <tr class="bg-primary" id="tableheadtbl">
                            <th class="text-center">#</th>
                            <th class="text-center">Seat Type</th>
                            <th class="text-center">Seat Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Seat Total</th>
                        </tr>
                        <?php
                        $type = 1;
                        $parEleTicket=0;
                        foreach ($seatcategory as $seat_type):
                            $param = $type - 1;
                        if(!empty($seatcategory_price[$param]))
                        {

                            ?>

                            <tr class="allrow">

                                <td class="bg-primary text-center"><input type="radio" id="dd_type_<?php echo $type; ?>" name="dd" onclick="GetAllSeatRequest('<?php echo $type; ?>')"/></td>
                                <td class="text-danger" id="seat_type_<?php echo $type; ?>" style="text-align: center;"><?php echo $seat_type; ?></td>
                                <td class="text-info" id="seat_price_<?php echo $type; ?>" style="text-align: center;"><?php echo $seatcategory_price[$param]; ?></td>
                                <td><select name="quantity"  id="seat_<?php echo $type; ?>" onchange="rowTotalTicket(this.value, '<?php echo $seatcategory_price[$param]; ?>', '<?php echo $type; ?>')" class="form-control fe">
                                    <option value="0">Quantity</option>
                                    <?php
                                    for ($i = 1; $i <= 10; $i++):
                                        ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </td>
                            <td style="text-align: center;" class="row_total_all" id="row_total_<?php echo $type; ?>">0.00</td>

                        </tr>
                        <?php
                        $type++;
                        $parEleTicket++;
                    }
                    endforeach;

                    if(empty($parEleTicket))
                    {
                        ?>
                        <tr class="allrow">
                            <td class="bg-primary text-center" colspan="5">

                                <h3 class="text-danger">
                                    No Tickets Are Available Now. Please Select Another Date.
                                </h3>

                            </td>
                        </tr>
                        <?php
                    }

                    ?>
                </table>
                <script type="text/javascript">
                    <?php 
                    if(empty($parEleTicket)){
                        ?>
                        $("#tableheadtbl").css("display","none");

                        <?php
                    }
                    ?>

                    $(".personal_info").css("display","none");

                    function rowTotalTicket(quan, valp, place)
                    {
                        var rowtotal = valp * quan;

                        $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_2.php", {'st': 1, 'amount': rowtotal}, function (data) {
                            $("#row_total_" + place).html(data);
                            GetAllSeatRequest(place);
                        });


                    }

                    function success(msg) {
                        $.simplyToast('<i class="fa fa-check-circle"></i>&nbsp;&nbsp;' + msg, 'success');
                    }
                    function error(msg) {
                        $.simplyToast('<i class="fa fa-times-circle"></i>&nbsp;&nbsp;' + msg, 'danger');
                    }

                    function GetAllSeatRequest(place)
                    {
                        $(".allrow td").css("color", "#ccc");
                        $("select[name=quantity]").attr("disabled", "disabled");
                        $("#seat_type_" + place).css("color", "#000");
                        $("#seat_price_" + place).css("color", "#000");
                        $("#row_total_" + place).css("color", "#000");
                        $("#seat_" + place).removeAttr("disabled");
                        var seat_type = $("#seat_type_" + place).html();
                        var seat = $("#seat_" + place).val();

                        if (seat != '0')
                        {

                            $("#allMov_1").html("You Select " + seat + " " + seat_type + " Seat");
                            success("You Select " + seat + " " + seat_type + " Seat");
                            $('#seat_port').val(place);
                            $("#s_ticket_type").html(seat_type);
                            var spr = $("#seat_price_" + place).html();
                            $("#s_ticket_price").html(spr);
                            $("#s_ticket_quantity").html(seat);
                            var srt = $("#row_total_" + place).html();
                            $("#s_ticket_total_amount").html(srt);
                            $("#s_total_amount").html(srt);
                            if(srt!=null)
                            {
                                $(".personal_info").css("display","block");
                            }
                            //hidden_cost_total

                        } else
                        {
                            $('#seat_port').val("0");
                            $("select[name=quantity] option[value='0']").prop('selected', true);
                            $(".row_total_all").html("0.00");
                            $("#s_ticket_price").html("0.00");
                            $("#s_ticket_quantity").html("0.00");
                            $("#s_ticket_total_amount").html("0.00");
                            $("#s_total_amount").html("0.00");
                            $(".personal_info").css("display","none");
                        }


                    }
                </script>
            </div>

            <h3 class="text-info personal_info" style="margin-top: 20px;">
                Please Provide Your Personal Detail.
            </h3>

            <div class="col-md-12 personal_info" style="margin-top:-10px; padding-left: 0px;">


                <div class="form-group">
                    <label for="exampleInputEmail1" class="fl">Full Name</label>
                    <input type="text" class="form-control fe"  id="fullname" placeholder="Full Name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="fl">Email Address</label>
                    <input type="email" class="form-control fe"  id="email" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="fl">Mobile No.</label>
                    <input type="text" class="form-control fe"  id="mobile" placeholder="Mobile Number After +88">
                </div>
                <div class="col-md-12 col-sm-4" style="padding-left: 0;">
                    <button type="button" id="seat_tpc" style="margin-left: 0px;" class="btn success-rounded-outline waves-effect btn-tkt-tbl btn btn-success pull-left">Buy Ticket</button>
                </div>


                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="datepicker" style="height: 35px;"  class="form-control" placeholder="Date of birth">

                <input type="hidden" id="gender" value="1">
                <!--                            <button id="seat_tpc" type="button" class="btn btn-primary col-sm-4"><i class="fa fa-ticket"></i> Next </button>-->
            </div>
            <?php
            $theatre_id = 0;
            $sqlgettheater = mysqli_query($con, "SELECT theatre_id,name FROM event_movie_theatre WHERE name='" . $theatre . "' LIMIT 1");
            while ($fettheatre = mysqli_fetch_array($sqlgettheater)) {
                $theatre_id = $fettheatre['theatre_id'];
            }
            ?>    
            <input type="hidden" id="seat_port" value="0">
            <input type="hidden" id="movie_id" value="<?php echo $movie_id; ?>" />
            <input type="hidden" id="movie_name" value="<?php echo $movie_name; ?>" />
            <input type="hidden" id="request_date" value="<?php echo $request_date; ?>" />
            <input type="hidden" id="theatre_id" value="<?php echo $theatre_id; ?>" />
            <input type="hidden" id="slot_time" value="<?php echo $slot_time; ?>" />
            <!--        <button id="seat_tp" type="button" class="btn btn-primary btn-block"><i class="icon-search"></i> Next Step</button>-->

            <script>
                // $(document).ready(function () {
                    $('button#seat_tpc').click(function () {

                        var paramplace = $("#seat_port").val();
                        if (paramplace != "0")
                        {

                            var seatquantity = $("#seat_" + paramplace).val();

                            var theatre_id = $('#theatre_id').val();
                            var dtmsid = '<?php echo $seatstatus['DTMSID']; ?>';
                            var fullname = $('#fullname').val();
                            var email = $('#email').val();
                            var mobile = $('#mobile').val();
                            var dob = "";
                            var sex = "";
                            var movie_id = $('#movie_id').val();
                            var movie_name = $('#movie_name').val();
                            var request_date = $('#request_date').val();
                            var seat_price = $("#seat_price_" + paramplace).html();
                            var seat_type = $("#seat_type_" + paramplace).html();
                            var slot_time = $("#slot_time").val();


                        //  alert("fg")
                        if (ValidateFullNameEmailPhone(fullname, email, mobile) == true)
                        {


                            success("Please Wait Sending Information For Booking " + seatquantity + " Seat ");
                            var loader = '<img src="<?php echo $cms->LbaseUrl(); ?>favicon/loading.gif">';

                            // $("#step_3_2_title").show('slow');
                            //$("#step_3_2_title").html("Select Payment Method");
                            //$("#step_3_2").html(loader);
                            $("#step_2_1").hide('slow');
                            $("#step_5").show('slow');
                            $("#step_5").html(loader);
                            $('html,body').animate({
                                scrollTop: $("body").offset().top},
                                'slow');
                            $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 4,
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
                                'slot_time': slot_time,
                                'request_date': request_date, 'theatre_id': theatre_id}, function (data) {

                                    var datacld = jQuery.parseJSON(data);
                                    var order_id = datacld.order_id;
                                    var amount = datacld.amount;
                                    var rfullname = datacld.fullname;
                                    var rmobile = datacld.mobile;
                                    var remail = datacld.email;
                                    if (order_id != null)
                                    {
                                        $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 6, 'movie_id': movie_id, 'dtmsid': dtmsid, 'seatclass': seat_type, 'seat': seatquantity, 'cusname': fullname, 'cusemail': email, 'cusmobile': mobile, 'slot_time': slot_time}, function (data1) {
                                            var datacl = jQuery.parseJSON(data1);
                                            var status = datacl.status;

                                            var s_seat_number = datacl.seat_number;
                                            if (status == 1)
                                            {

                                                $("#s_seat_no").html(s_seat_number);
                                            //$("#step_3_2").html(data);
                                            $.post("<?php echo$cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 7, 'seat_number': s_seat_number, 'order_id': order_id, 'amount': amount, 'fullname': rfullname, 'email': remail, 'mobile': rmobile, 'request_date': request_date, 'theatre_id': theatre_id, 'movie_id': movie_id}, function (seat_location) {
                                                $("#step_2_1").hide('slow');
                                                $("#step_3").show('slow');
                                                $("#step_5").hide('slow');
                                                $("#collapseOne").removeClass('in');
                                                $(".hidecost").show('slow');
                                                $("#step_3_1").html(seat_location);
                                                var hiddenextratotal = 0;
                                                var extotal = $("#s_ticket_total_amount").html().replace(',', '');
                                                var actamarr = $("#cost_amount_array").val();
                                                var actdearr = $("#cost_deduct_array").val();
                                                if (actamarr == "")
                                                {
                                                    var hiddenextratotal = 0;
                                                    $("#hidden_cost_total").val('0');

                                                } else
                                                {
                                                    $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 10, 'ticket_total': extotal, 'extra_amount': actamarr, 'deduct_type': actdearr}, function (datad) {

                                                        $("#hidden_cost_total").val(datad);
                                                        var acthidden = datad;
                                                        var allsumtotal = (extotal - 0) + (acthidden - 0);
                                                        $("#s_total_amount").html(allsumtotal);

                                                        

                                                        console.log(acthidden, extotal);
                                                    });
                                                }




                                            });
                                            $("#step_4").show('slow');
                                        } else
                                        {
                                            $("#s_seat_no").html("Failed To Book Your Seat");
                                            error('Please Reload Page And Re - Book Your Ticket. ');
                                            //$("#step_3_2").html(data);
                                            //$("#step_4").show('slow');

                                        }
                                    });
                                    } else
                                    {
                                       error("Something went wrong, Please Try again.");
                                       window.location.reload();
                                   }
                                //$("form#booking_step_1").html(data);

                            });


}
} else
{

    <?php
    $counttype = count($seatcategory);
    for ($type = 1; $type <= $counttype; $type++):
        ?>
    var dd_select_<?php echo $type; ?> = $("#seat_type_<?php echo $type; ?>").val();

    <?php
    endfor;
    ?>

    if (<?php for ($type = 1; $type <= $counttype; $type++): if ($type == 1) { ?>dd_select_<?php echo $type; ?> == 0<?php } else { ?> && dd_select_<?php echo $type; ?> == 0<?php } endfor; ?>)
    {
      error('Please Select Your Seat Quantity');
  }

  if (<?php for ($type = 1; $type <= $counttype; $type++): if ($type == 1) { ?>document.getElementById('dd_type_<?php echo $type; ?>').checked == false<?php } else { ?> && document.getElementById('dd_type_<?php echo $type; ?>').checked == false<?php } endfor; ?>)
  {
   error('Please Select Your Seat Type');
}

}


});



                            //   });

                            function ValidateFullNameEmailPhone(fullname, email, phonenumber)
                            {
                                if (fullname == "")
                                {
                                   error('Fullname is empty');
                               } else if (email == "")
                               {
                                   error('Email is empty');
                               } else if (phonenumber == "")
                               {
                                   error('Phone/Mobile is empty');
                               } else
                               {
                                if (isValidEmailAddress(email))
                                {
                                    if (validatePhone(phonenumber) == "1")
                                    {
                                        return true;
                                    } else
                                    {
                                        if (validatePhone(phonenumber) == "2")
                                        {
                                           error('Invalid Phone Number');
                                       } else if (validatePhone(phonenumber) == "3")
                                       {
                                           error('Phone Length Should be 11');
                                       }
                                   }

                               } else
                               {
                                   error('Invalid Email Address');
                               }
                           }
                       }

                       function isValidEmailAddress(emailAddress) {
                        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                        return pattern.test(emailAddress);
                    }

                    function validatePhone(txtPhone) {
                        var a = txtPhone;
                        var getlength = a.length;
                        if (getlength > 10)
                        {
                            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

                            if (filter.test(a)) {
                                return "1";
                            } else {
                                return "2";
                            }
                        } else
                        {
                            return "3";
                        }
                    }

                </script>

                <?php
            } elseif ($st == 3) {
                ?>

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


                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="datepicker" style="height: 35px;"  class="form-control" placeholder="Date of birth">

                <input type="hidden" id="gender" value="1">


                <input type="hidden" id="movie_id" value="<?php echo $movie_id; ?>" />
                <input type="hidden" id="seat" value="<?php echo $seat; ?>" />
                <input type="hidden" id="seat_unit_price" value="<?php echo $seat_price; ?>" />
                <input type="hidden" id="seat_type" value="<?php echo $seat_type; ?>" />
                <input type="hidden" id="movie_name" value="<?php echo $movie_name; ?>" />
                <input type="hidden" id="request_date" value="<?php echo $request_date; ?>" />
                <input type="hidden" id="dtmsid" value="<?php echo $dtmsid; ?>" />
                <input type="hidden" id="theatre_id" value="<?php echo $theatre_id; ?>" />
                <input type="hidden" id="slot_time" value="<?php echo $slot_time; ?>" />
                <button id="seat_tpc" type="button" class="btn btn-primary col-sm-4"><i class="fa fa-ticket"></i> Next </button>
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

                            var theatre_id = $('#theatre_id').val();
                            var dtmsid = $('#dtmsid').val();
                            var fullname = $('#fullname').val();
                            var email = $('#email').val();
                            var mobile = $('#mobile').val();
                            var dob = "";
                            var sex = "";
                            var movie_id = $('#movie_id').val();
                            var movie_name = $('#movie_name').val();
                            var request_date = $('#request_date').val();
                            var seat_price = $('#seat_unit_price').val();
                            var seat_type = $('#seat_type').val();
                            var slot_time = $("#slot_time").val();
                            if (fullname != '' && email != '' && email != '')
                            {


                               success("Please Wait Sending Information For Booking " + seatquantity + " Seat ");
                               var loader = '<img src="<?php echo $cms->LbaseUrl(); ?>favicon/loading.gif">';

                            //$("#step_3_2_title").show('slow');
                            //$("#step_3_2_title").html("Select Payment Method");
                            $("#step_2_1").hide('slow');
                            $("#step_5").html(loader);
                            $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 4,
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
                                'slot_time': slot_time,
                                'request_date': request_date, 'theatre_id': theatre_id}, function (data) {



                                    $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 6, 'movie_id': movie_id, 'dtmsid': dtmsid, 'seatclass': seat_type, 'seat': seatquantity, 'cusname': fullname, 'cusemail': email, 'cusmobile': mobile, 'slot_time': slot_time}, function (data1) {
                                        var datacl = jQuery.parseJSON(data1);
                                        var status = datacl.status;
                                        var s_seat_number = datacl.seat_number;

                                        if (status == 1)
                                        {

                                            $("#s_seat_no").html(s_seat_number);
                                            $("#step_3_2").html(data);
                                            $("#step_4").show('slow');
                                            $('html,body').animate({
                                                scrollTop: $("body").offset().top},
                                                'slow');
                                        } else
                                        {
                                            $("#s_seat_no").html("Failed.");
                                            $("#step_3_2").html(data);
                                            $("#step_4").show('slow');

                                        }
                                    });
                                //$("form#booking_step_1").html(data);

                            });

                        } else
                        {
                            error("Please Fillup Fullname, Email, Phone No.");
                        }

                    });



                });</script>
<?php
} elseif ($st == 4) {
    include '.././email/mail_helper_functions.php';
    $order_id = $obj->OrderID(@$_SESSION['SESS_ORDER_ID'], $movie_id);

    if ((getSession('user_id'))) {
        $userID = getSession('user_id');

        $ins = "";
        $ins .="order_id='" . $order_id . "'";
        $ins .=",customer_id='" . $userID . "'";
        $ins .=",movie_id='" . $movie_id . "'";
        $ins .=",movie_name='" . $movie_name . "'";
        $ins .=",theatre_id='" . $theatre_id . "'";
        $ins .=",dtmsid='" . $dtmsid . "'";
        $ins .=",seat='" . $seat . "'";
        $ins .=",show_time='" . $slot_time . "'";
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
        $exusrid = $userID;
    } else {
        $chk = $obj->FlyQuery("SELECT * FROM users WHERE (user_email='" . $email . "' OR user_phone='" . $mobile . "')", "2");
        $chk1 = $obj->FlyQuery("SELECT * FROM users WHERE user_email='" . $email . "' AND user_phone='" . $mobile . "'", "2");
        $chk2 = $obj->FlyQuery("SELECT * FROM users WHERE user_email='" . $email . "'", "2");
        if ($chk == 0 && $chk1 == 0 && $chk2 == 0) {

            $obj->FlyQuery("INSERT INTO users SET user_email='" . $email . "',user_first_name='" . $fullname . "',user_DOB='" . $dob . "',user_gender='" . $sex . "',user_phone='" . $mobile . "'", "3");
            $customer_id = $obj->FlyQuery("SELECT user_id,user_email FROM users WHERE user_email='" . $email . "'", "1");

                //echo "INSERT INTO users SET user_email='".$email."',user_first_name='".$fullname."',user_DOB='".$dob."',user_gender='".$sex."',user_phone='".$mobile."'";

            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $customer_id[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",theatre_id='" . $theatre_id . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='" . $slot_time . "'";
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
            $exusrid = $customer_id[0]->user_id;
            session_start();
            session_regenerate_id();
            $_SESSION['USER_DASHBOARD_USER_ID'] = $exusrid;
            $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $fullname;


            $EmailSubject = "Thank you for registering with TicketChai";
            $EmailBody = file_get_contents($cms->LbaseUrl('email/movie-signup.php?user_id=' . $exusrid));
                //$sendMailStatus = sendEmailFunction($email, $fullname, 'support@ticketchai.com', $EmailSubject, $EmailBody);
                // smtpmailer('to@gmail.com', 'from@gmail.com', $name, $sub,"$html");
            smtpmailer($email, 'support@ticketchai.com', $fullname, "$EmailSubject", "$EmailBody");
        } elseif ($chk != 0 && $chk1 == 0 && $chk2 == 0) {

            $obj->FlyQuery("INSERT INTO users SET user_email='" . $email . "',user_first_name='" . $fullname . "',user_DOB='" . $dob . "',user_gender='" . $sex . "',user_phone='" . $mobile . "'", "3");
            $customer_id = $obj->FlyQuery("SELECT user_id,user_email FROM users WHERE user_email='" . $email . "'", "1");

                //echo "INSERT INTO users SET user_email='".$email."',user_first_name='".$fullname."',user_DOB='".$dob."',user_gender='".$sex."',user_phone='".$mobile."'";

            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $customer_id[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",theatre_id='" . $theatre_id . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='" . $slot_time . "'";
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
            $exusrid = $customer_id[0]->user_id;

            session_start();
            session_regenerate_id();
            $_SESSION['USER_DASHBOARD_USER_ID'] = $exusrid;
            $_SESSION['USER_DASHBOARD_USER_FULLNAME'] = $fullname;


            $EmailSubject = "Thank you for registering with TicketChai";
            $EmailBody = file_get_contents($cms->LbaseUrl('email/movie-signup.php?user_id=' . $exusrid));
                //$sendMailStatus = sendEmailFunction($email, $fullname, 'support@ticketchai.com', $EmailSubject, $EmailBody);
            smtpmailer($email, 'support@ticketchai.com', $fullname, "$EmailSubject", "$EmailBody");
        } elseif ($chk1 == 1) {

                //$obj->FlyQuery("INSERT INTO users SET user_email='" . $email . "',user_first_name='" . $fullname . "',user_DOB='" . $dob . "',user_gender='" . $sex . "',user_phone='" . $mobile . "'", "3");
            $customer_id = $obj->FlyQuery("SELECT user_id,user_email FROM users WHERE user_email='" . $email . "' AND user_phone='" . $mobile . "'", "1");

                //echo "INSERT INTO users SET user_email='".$email."',user_first_name='".$fullname."',user_DOB='".$dob."',user_gender='".$sex."',user_phone='".$mobile."'";

            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $customer_id[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",theatre_id='" . $theatre_id . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='" . $slot_time . "'";
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
            $exusrid = $customer_id[0]->user_id;
        } elseif ($chk2 == 1) {

                //$obj->FlyQuery("INSERT INTO users SET user_email='" . $email . "',user_first_name='" . $fullname . "',user_DOB='" . $dob . "',user_gender='" . $sex . "',user_phone='" . $mobile . "'", "3");
            $customer_id = $obj->FlyQuery("SELECT user_id,user_email FROM users WHERE user_email='" . $email . "'", "1");

                //echo "INSERT INTO users SET user_email='".$email."',user_first_name='".$fullname."',user_DOB='".$dob."',user_gender='".$sex."',user_phone='".$mobile."'";

            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $customer_id[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",theatre_id='" . $theatre_id . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
            $ins .=",show_time='" . $slot_time . "'";
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
            $exusrid = $customer_id[0]->user_id;
        } else {
            $usersql = $obj->FlyQuery("SELECT * FROM users WHERE user_email='" . $email . "'", "1");
            $ins = "";
            $ins .="order_id='" . $order_id . "'";
            $ins .=",customer_id='" . $usersql[0]->user_id . "'";
            $ins .=",movie_id='" . $movie_id . "'";
            $ins .=",movie_name='" . $movie_name . "'";
            $ins .=",theatre_id='" . $theatre_id . "'";
            $ins .=",show_time='" . $slot_time . "'";
            $ins .=",dtmsid='" . $dtmsid . "'";
            $ins .=",seat='" . $seat . "'";
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
            $exusrid = $usersql[0]->user_id;
        }
    }

    $amount = $seat_price * $seat;

    $array = array("user_id" => $exusrid, "order_id" => $order_id, "amount" => $amount, "fullname" => $fullname, "email" => $email, "mobile" => $mobile);
    echo json_encode($array);
} elseif ($st == 5) {
    $event_id="NO_ONE_CAN_DEFINE";

    $sqlmoviesevent = mysqli_query($con, "SELECT movie_id,event_id FROM event_movie_list WHERE movie_id='" . $movie_id . "'");
    $chkevtexID=mysqli_num_rows($sqlmoviesevent);
    if($chkevtexID!=0)
    {
        $fetevent = mysqli_fetch_array($sqlmoviesevent);
        $event_id = $fetevent['event_id'];
    }
    
       // print_r($fetevent);

    $costarray = array();
    $sqlextracost = "SELECT id,cost_title,cost_amount FROM event_ticket_extra_cost WHERE event_id='" . $event_id . "'";
    $querycost = mysqli_query($con, $sqlextracost);
    $chkcost = mysqli_num_rows($querycost);
    if ($chkcost != 0) {
        while ($costdata = mysqli_fetch_object($querycost)):
            $costarray[] = $costdata;
        endwhile;
    }

    @$sessionID = session_id();
    $orderID = $order_id;


    if (count($costarray) == 0) {

         /*print_r($costarray);
         exit();*/

         $cost_total_extra = 0;
         foreach ($costarray as $cost):

            /* extra all cost */
        $chksql = "SELECT * FROM order_extra_cost_history WHERE order_id='" . $order_id . "' AND cost_id='" . $cost->id . "'";
            //$chkrowextra = mysqli_num_rows(mysqli_query($con, $chksql));
        if (mysqli_num_rows(mysqli_query($con, $chksql)) == 0) {
            mysqli_query($con, "INSERT INTO order_extra_cost_history SET order_id='" . $order_id . "',cost_id='" . $cost->id . "',cost_title='" . $cost->cost_title . "',cost_amount='" . $cost->cost_amount . "',date='" . date('Y-m-d') . "'");
        }

        $cost_total_extra +=$cost->cost_amount;

        endforeach;

        

        $getacualdetailsql = "SELECT a.*,e.event_id FROM order_movie_event as a 
        LEFT JOIN event_movie_list as e on e.movie_id=a.movie_id WHERE a.order_id='" . $orderID . "' GROUP BY a.order_id";

        $useractual=$obj->FlyQuery($getacualdetailsql,1);
        //print_r($dd);
        //exit();
        /*$queryacualdetail = mysqli_query($con, $getacualdetailsql);
        $chkactual = mysqli_num_rows($queryacualdetail);
        $useractual = array();
        while ($rowact = mysqli_fetch_object($queryacualdetail)):
            $useractual[] = $rowact;
            endwhile;*/

        //print_r($useractual);
        //exit();
            //shipping_receiver != "" && contactno != "" && shipping_address //emailshipping


            $payst = "booking";
            $userID = $useractual[0]->customer_id;
            $phone = $useractual[0]->mobile;
            $movie_id = $useractual[0]->movie_id;
            $seat_quantity = $useractual[0]->seat;
            $seat_unit_amount = $useractual[0]->seat_unit_price;
            $seat_amount = $seat_quantity * $seat_unit_amount;
            $seat_amount_order = $amount;
            $full_name = $useractual[0]->fullname;
            $lid = $useractual[0]->lid;
            $trx_id = $useractual[0]->trx_id;
            $dtmsid = $useractual[0]->dtmsid;
            $email = $useractual[0]->email;
            $mobile = $useractual[0]->mobile;
            $event_id = $useractual[0]->event_id;

            $payRadio = 'movieeticket';
            $getLastOrderID = $obj->FlyGetMax('orders', 'order_id');

        //echo $getLastOrderID;
        //exit();

            $orderDBID = $getLastOrderID + 1;
            $orderPublicID = '[' . date("dmy", time()) . '-' . $orderDBID . ']';
            $OrderPlaced = date("Y-m-d H:i:s", time());

            if ($payment_method == 4) {
                $order_payment_type = "movie-eticket-online";
            } elseif($payment_method == 3) {
                $order_payment_type = "movie-eticket-bkash";
            } else{
                $order_payment_type = "movie-eticket-cod";
            }

            $placeNewOrder = '';
            $placeNewOrder .= ' order_user_id = "' . intval($userID) . '"';
            $placeNewOrder .= ', order_created = "' . $OrderPlaced . '"';
            $placeNewOrder .= ', order_number = "' . $orderPublicID . '"';
            $placeNewOrder .= ', order_status = "' . $payst . '"';
            //payment
            $placeNewOrder .= ', order_payment_type = "' . $order_payment_type . '"';
            $placeNewOrder .= ', order_method = "eticket"';
            $placeNewOrder .= ', order_shipment_charge = "' . floatval(0) . '"';
            $placeNewOrder .= ', order_total_item = "' . intval($seat_quantity) . '"';
            $placeNewOrder .= ', order_total_amount = "' . floatval($seat_amount_order) . '"';
            $placeNewOrder .= ', order_discount_amount = "' . floatval(0) . '"';
            $placeNewOrder .= ', order_promotion_codes = "' . validateInput("0") . '"';
            $placeNewOrder .= ', order_promotion_discount_amount = "' . floatval("0") . '"';
            $placeNewOrder .= ', order_session_id = "' . $sessionID . '"';

            //Billing Address Insertion
            $placeNewOrder .= ', order_billing_phone = "' . $phone . '"';
            $placeNewOrder .= ', order_billing_country = "0"';
            $placeNewOrder .= ', order_billing_city = "0"';
            $placeNewOrder .= ', order_billing_zip = "0"';
            $placeNewOrder .= ', order_billing_address = "0"';
            if ($payment_method == 2) {
                //shipping address
                $placeNewOrder .= ', order_shipping_first_name = "' . $shipping_receiver . '"';
                $placeNewOrder .= ', order_shipping_phone = "' . $contactno. '"';
                $placeNewOrder .= ', order_shipping_country = "0"';
                $placeNewOrder .= ', order_shipping_city = "' . $shipping_city . '"';
                $placeNewOrder .= ', order_shipping_zip = "' . $areazipcode . '"';
                $placeNewOrder .= ', order_shipping_address = "' . $shipping_address . '"';
            } else {
                //shipping address
                $placeNewOrder .= ', order_shipping_phone = "' . $phone . '"';
                $placeNewOrder .= ', order_shipping_country = "0"';
                $placeNewOrder .= ', order_shipping_city = "0"';
                $placeNewOrder .= ', order_shipping_zip = "0"';
                $placeNewOrder .= ', order_shipping_address = "0"';
            }
            $sqlPlaceOrder = "INSERT INTO orders SET $placeNewOrder";


        //echo $sqlPlaceOrder;
        //exit();
            $order_id_placesqlchk = $obj->FlyQuery("SELECT order_id FROM orders WHERE order_session_id='".$sessionID."'",2);
        //echo $order_id_placesqlchk;
        ///exit();
            if($order_id_placesqlchk==0)
            {
                $executePlaceOrder = $obj->FlyPrepare($sqlPlaceOrder);

                $order_id_placesql = $obj->FlyQuery("SELECT order_id FROM orders WHERE order_session_id='".$sessionID."'",1);
                $order_id_place=$order_id_placesql[0]->order_id; // query for last id


                

                $opd = $obj->FlyPrepare("UPDATE order_movie_event SET payment_method='" . $payment_method . "',verified_order_id='" . $order_id_place . "' WHERE order_id='" . $order_id . "'");

                /*if ($opd == 1) {
                    echo $event_id;
                } else {
                    echo 0;
                }
*/
                //echo $order_id_place;
                //exit();

                if ($order_id_place) {
                //echo '$executePlaceOrder';
                //foreach ($arrEventTmpCart AS $OrderEvents) {
                    $insertOrderEvent = '';
                    $insertOrderEvent .= ' OE_order_id = "' . intval($orderDBID) . '"';
                    $insertOrderEvent .= ', OE_event_id = "' . intval($event_id) . '"';
                    $insertOrderEvent .= ', OE_session_id = "' . $sessionID . '"';
                    $insertOrderEvent .= ', OE_user_id = "' . intval($userID) . '"';

                    $sqlInsertOrderEvent = "INSERT INTO order_events SET $insertOrderEvent";
                    $resultInsertOrderEvent = $obj->FlyPrepare($sqlInsertOrderEvent);

                    if ($resultInsertOrderEvent) {
                        $OE_id_placesql = $obj->FlyQuery("SELECT OE_id FROM order_events WHERE OE_session_id='".$sessionID."'",1);
                        $OE_id=$OE_id_placesql[0]->OE_id; // query for last id
                        //$OE_id = mysqli_insert_id($con);


                        $countQuantity = 1;

                        for ($i = 1; $i <= $countQuantity; $i++) {

                            $insertOrderItem = '';
                            $insertOrderItem .= ' OI_OE_id = "' . intval($OE_id) . '"';
                            $insertOrderItem .= ', OI_order_id = "' . intval($orderDBID) . '"';
                            $insertOrderItem .= ', OI_session_id = "' . mysqli_real_escape_string($con, $sessionID) . '"';
                            $insertOrderItem .= ', OI_unique_id = "' . mysqli_real_escape_string($con, randCode(29)) . '"';
                            $insertOrderItem .= ', OI_item_type = "' . mysqli_real_escape_string($con, "ticket") . '"';
                            $insertOrderItem .= ', OI_venue_id = "' . intval(0) . '"';
                            $insertOrderItem .= ', OI_item_id = "' . intval($movie_id) . '"';
                            $insertOrderItem .= ', OI_quantity = "' . intval($seat_quantity) . '"';
                            $insertOrderItem .= ', OI_unit_price = "' . floatval($seat_unit_amount) . '"';
                            $insertOrderItem .= ', OI_unit_discount = "' . floatval(0) . '"';

                            $sqlInsertOrderItems = "INSERT INTO order_items SET $insertOrderItem";
                            $resultInsertOrderItems = $obj->FlyPrepare($sqlInsertOrderItems);

                            $OE_id_pdf_placesql = $obj->FlyQuery("SELECT OI_id FROM order_items WHERE OI_session_id='".$sessionID."'",1);
                            $OE_id_pdf=$OE_id_pdf_placesql[0]->OI_id; // query for last id
                            
                            //$OE_id_pdf = mysqli_insert_id($con);

                        //$status++;
                        }

                    //}
                    //}
                    } else {
                    //$status++;
                    }
                //}
                }

                $getacualdetailsql = "UPDATE order_movie_event SET verified_order_id='" . $orderDBID . "' WHERE order_id='" . $order_id . "'";
                $queryacualdetail = $obj->FlyPrepare($getacualdetailsql);
                echo 1;

            }
            else
            {
                echo 1;
                //exit();
            }

            

            //movie process
            //mysqli_query($con,$sqlextracost);
        }
    } elseif ($st == 6) {
        $seat_number = 0;
        @$dd = $api->SecureBookingApi($dtmsid, $seatclass, $seat, $cusname, $cusemail, $cusmobile);
        //echo var_dump($dd);
        if (empty($dd->seat_numbers)) {

            $array = array("status" => 0, "seat_number" => "0");
            echo json_encode($array);
        } else {
            $seat_number = $dd->seat_numbers;
            $lid = $dd->lid;
            $trx_id = $dd->trx_id;
            $array = array("status" => 1, "seat_number" => @$seat_number);
            $order_id = $obj->OrderID(@$_SESSION['SESS_ORDER_ID'], $movie_id);
            $obj->FlyQuery("UPDATE order_movie_event SET seat_number='" . @$seat_number . "',lid='" . $lid . "',trx_id='" . $trx_id . "' WHERE order_id='" . $order_id . "'", "3");
            echo json_encode($array);
        }
    } elseif ($st == 7) {


        $string_booked_seat = $seat_number;
        $dd = explode(",", $string_booked_seat);
        $newarray = array();
        foreach ($dd as $ff):
            $newarray[] = $ff;
        endforeach;
        //echo var_dump($newarray);
        ?>
        <style type="text/css">
            .booking_hall_frame
            {
                width: 580px; padding-left: 3px; padding-top: 10px; border: 1px #000 solid; clear: both; margin-left: auto; margin-right: auto;
            }

            .hall_row
            {
                width: 100%;
                clear: both;
                display: block;
            }

            .chair
            {
                width: 25px; height: 25px; margin-bottom: 5px; float: left;
                background: url('<?php echo $cms->LbaseUrl(); ?>favicon/movie_seats_available.jpg') no-repeat center;
            }

            .padding_chair_both_side
            {
                padding-left: 26px; padding-right: 26px;
            }

            .chair_row_end
            {
                width: 25px; height: 25px; font-weight: bolder;  color: #33cc33; margin-bottom: 5px; text-align: center; line-height: 30px; margin-right: 5px;  float: left;
            }

            .booked_chair
            {
                width: 25px; height: 25px; margin-bottom: 5px; float: left;
                background: url('<?php echo $cms->LbaseUrl(); ?>favicon/movie_seat_booked.jpg') no-repeat center;
            }
        </style>

        <h3 style="margin-bottom: 10px;" class="text-center"><span class="label label-danger">Screen Position Here</span> </h3>

        <div class="booking_hall_frame">
            <?php
            if ($theatre_id == 6) {
                for ($i = 65; $i <= 75; $i++):
                    if ($i == 65) {
                        ?>
                        <div class="clearfix"></div>
                        <h5 style="margin-bottom: 10px;" class="text-center"><span class="label label-info">Executive Class</span> </h5>
                        <div class="clearfix"></div>
                        <?php
                    } elseif ($i == 74) {
                        ?>
                        <div class="clearfix"></div>
                        <h5 style="margin-bottom: 10px; margin-top: 30px;" class="text-center"><span class="label label-info">Business Class</span> </h5>
                        <div class="clearfix"></div>
                        <?php
                    }
                    ?>
                    <div class="hall_row">
                        <div class="chair_row_end">
                            <?php
                            echo " " . chr($i);
                            ?>
                        </div>
                        <?php
                        if ($i > 73) {
                            for ($a = 1; $a <= 10; $a++):
                                if (in_array(chr($i) . "" . $a, $newarray)) {
                                    ?>
                                    <div class="booked_chair padding_chair_both_side" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="chair padding_chair_both_side" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                    <?php
                                }
                                endfor;
                            } else {
                                for ($a = 1; $a <= 20; $a++):
                                    if (in_array(chr($i) . "" . $a, $newarray)) {
                                        ?>
                                        <div class="booked_chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                        <?php
                                    }
                                    endfor;
                                }
                                ?>
                                <br>
                            </div>
                            <?php
                            endfor;
                        } else {
                        //if Normal Hall
                            for ($i = 65; $i <= 78; $i++):
                                if ($i == 65) {
                                    ?>
                                    <div class="clearfix"></div>
                                    <h5 style="margin-bottom: 10px;" class="text-center"><span class="label label-info">E-Front</span> </h5>
                                    <div class="clearfix"></div>
                                    <?php
                                } elseif ($i == 75) {
                                    ?>
                                    <div class="clearfix"></div>
                                    <h5 style="margin-bottom: 10px; margin-top: 30px;" class="text-center"><span class="label label-info">E-Rear</span> </h5>
                                    <div class="clearfix"></div>
                                    <?php
                                }
                                ?>
                                <div class="hall_row">
                                    <div class="chair_row_end">
                                        <?php
                                        " " . chr($i);
                                        ?>
                                    </div>
                                    <?php
                                    if (chr($i) == "A") {
                                        for ($a = 1; $a <= 19; $a++):
                                            if (in_array(chr($i) . "" . $a, $newarray)) {
                                                ?>
                                                <div class="booked_chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                <?php
                                            }
                                            endfor;
                                        } elseif (chr($i) == "B") {
                                            for ($a = 1; $a <= 21; $a++):
                                                if (in_array(chr($i) . "" . $a, $newarray)) {
                                                    ?>
                                                    <div class="booked_chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                    <?php
                                                }
                                                endfor;
                                            } else {
                                                for ($a = 1; $a <= 20; $a++):
                                                    if (in_array(chr($i) . "" . $a, $newarray)) {
                                                        ?>
                                                        <div class="booked_chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="chair" title="<?php echo chr($i) . "" . $a; ?>"></div>
                                                        <?php
                                                    }
                                                    endfor;
                                                }
                                                ?>
                                                <br>
                                            </div>
                                            <?php
                                            endfor;
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4 class="page-header col-md-12 text-left">
                                            <i class="fa fa-user"></i> Customer Detail
                                        </h4>
                                        <div class="col-md-6">
                                            <label class="col-sm- strong fl">
                                                Full Name
                                            </label>
                                            <div class="col-sm-12" style="padding-left:0;">
                                                <?php echo $fullname; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-sm-12 strong fl">
                                                Contact Number
                                            </label>
                                            <div class="col-sm-12">
                                                <?php echo $mobile; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-sm-12 strong fl" style="padding-left:0;">
                                                Email (User id)
                                            </label>
                                            <div class="col-sm-12" style="padding-left:0;">
                                                <?php echo $email; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="col-md-12 bg-default">&nbsp;</div>
                                    <div class="col-md-12">
                                        <h4 class="page-header col-md-12 text-left">
                                            <i class="fa fa-user"></i> Billing Detail 
                                            <span class="pull-right" id="exdatacheck"><input type="checkbox" name="cusdetailship" id="cusdetailship" /> Use Customer Detail as Shipping</span>
                                        </h4>
                                        <div class="col-md-6" style="margin-bottom: 5px;">
                                            <label class="col-sm- strong fl">
                                                Payment Method : 
                                            </label>
                                            <div class="col-sm-12" style="padding-left:0;">
                                                <select class="fe form-control" name="payment_method"  id="payment_method">
                                                    <option value="">Select A Payment Method</option>
                                                    <?php
                                                    $sqlpmstring = "SELECT * FROM payment_method WHERE status='1'";
                                                    $querypm = mysqli_query($con, $sqlpmstring);
                                                    $chkpm = mysqli_num_rows($querypm);
                                                    if ($chkpm != 0) {
                                                        $pmarray = array();
                                                        while ($rowpm = mysqli_fetch_object($querypm)):
                                                            $pmarray[] = $rowpm;
                                                        endwhile;

                                                        foreach ($pmarray as $pm):

                                                            if ($pm->id == 2 && CountDate($request_date) > 1) {
                                                                ?>
                                                                <option value="<?php echo $pm->id; ?>"><?php echo $pm->name; ?></option>
                                                                <?php
                                                            } elseif ($pm->id != 2) {
                                                                ?>
                                                                <option value="<?php echo $pm->id; ?>"><?php echo $pm->name; ?></option>
                                                                <?php
                                                            }

                                                            endforeach;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 offline_payment" id="r2" style="margin-bottom: 5px;">
                                                <label class="col-sm- strong fl">
                                                    Select Your Shipping City : 
                                                </label>
                                                <div class="col-sm-12" style="padding-left:0;">
                                                    <select class="fe form-control" name="shipping_city"  id="shipping_city">
                                                        <option value="">Select Your City</option>
                                                        <?php
                                                        $sqlgetcitycost = "SELECT m.event_id,m.movie_id,c.city_delivery_charge as cost,c.city_id,c.city_name FROM event_movie_list as m
                                                        LEFT JOIN event_cities as c on c.event_id=m.event_id 
                                                        WHERE m.movie_id='" . $movie_id . "'";
                                                        $citycostarray = array();
                                                        $costquery = mysqli_query($con, $sqlgetcitycost);
                                                        $chkcostcity = mysqli_num_rows($costquery);
                                                        if ($chkcostcity != 0) {
                                                            while ($rowcost = mysqli_fetch_object($costquery)):
                                                                $citycostarray[] = $rowcost;
                                                            endwhile;

                                                            foreach ($citycostarray as $city):
                                                                ?>
                                                            <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                                            <?php
                                                            endforeach;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 offline_payment" id="r1" style="margin-bottom: 5px;">
                                                <label class="col-sm- strong fl">
                                                    Contact Person Name
                                                </label>
                                                <div class="col-sm-12" style="padding-left:0;">
                                                    <input type="text" class="form-control fe"  name="shipping_receiver" id="shipping_receiver" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 offline_payment" id="r3" style="margin-bottom: 5px;">
                                                <label class="col-sm- strong fl">
                                                    Contact No.
                                                </label>
                                                <div class="col-sm-12" style="padding-left:0;">
                                                    <input type="text"  class="form-control fe"  name="contactno" id="contactno" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 offline_payment" id="r5" style="margin-bottom: 5px;">
                                                <label class="col-sm- strong fl">
                                                    Your Area Zip code
                                                </label>
                                                <div class="col-sm-12" style="padding-left:0;">
                                                    <input type="text"  class="form-control fe"  name="areazipcode" id="areazipcode" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 offline_payment" id="r4" style="margin-bottom: 5px;">
                                                <label class="col-sm- strong fl">
                                                    Shipping Address
                                                </label>
                                                <div class="col-sm-12" style="padding-left:0; margin-bottom: 5px;">
                                                    <textarea rows="1" class="form-control fe"  name="shipping_address" id="shipping_address"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="col-sm-12 strong">
                                                    <a href="#" class="fl" style="color:#000 !important;">Our Terms &AMP; Condition.</a>
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="checkbox" name="terms" id="terms" /> I Agree to Terms & Conditions
                                                </div>
                                            </div>
                                            <br/>

                                        </div><br>

                                        <script>
                                            $(document).ready(function () {
                                                $("#r1").hide('slow');
                                                $("#r2").hide('slow');
                                                $("#r3").hide('slow');
                                                $("#r4").hide('slow');
                                                $("#r5").hide('slow');
                                                $("#exdatacheck").hide('slow');
                                                $("#payment_method").change(function () {
                                                    var pmval = $(this).val();
                                                //alert(pmval);
                                                if (pmval != null && pmval == 2)
                                                {
                                                    $("#exdatacheck").show('slow');
                                                    $("#r1").show('slow');
                                                    $("#r2").show('slow');
                                                    $("#r3").show('slow');
                                                    $("#r4").show('slow');
                                                    $("#r5").show('slow');
                                                }
                                            });

                                                $("input[name=cusdetailship]").click(function () {
                                                    checkandplaceexdata()
                                                });

                                                $("#shipping_city").change(function () {
                                                    var cityval = $(this).val();
                                                    if (cityval != "")
                                                    {
                                                        $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 8, 'city_id': cityval}, function (data) {
                                                            $(".hidecost_city_delivery").show('slow');
                                                            $("#delivery_cost").html(data);
                                                            var extot = $("#s_ticket_total_amount").html();
                                                            var gettotalticket = extot.replace(",", "");
                                                            var ourhidecost = $("#hidden_cost_total").val();
                                                            var deliverycost = $("#delivery_cost").html();

                                                            var sumtotal = (gettotalticket - 0) + (ourhidecost - 0) + (deliverycost - 0);

                                                            $("#s_total_amount").html(sumtotal);

                                                        });
                        } // 
                        else
                        {
                           error("Please Select A Shipping City.");
                       }
                   });


                                                function checkandplaceexdata()
                                                {
                                                    if (document.getElementById('cusdetailship').checked == true)
                                                    {
                                                        $("#shipping_receiver").val('<?php echo $fullname; ?>');
                                                        $("#contactno").val('<?php echo $mobile; ?>');
                                                    } else
                                                    {
                                                        $("#shipping_receiver").val("");
                                                        $("#contactno").val("");
                                                    }
                                                }
                                            });
                                        </script>

                                        <?php
                                        $sqlmoviesevent = mysqli_query($con, "SELECT movie_id,event_id FROM event_movie_list WHERE movie_id='" . $movie_id . "'");
                                        $fetevent = mysqli_fetch_array($sqlmoviesevent);
                                        $event_id = $fetevent['event_id'];

                                        $costarray = array();
                                        $sqlextracost = "SELECT id,cost_title,cost_amount,deduction_type FROM event_ticket_extra_cost WHERE event_id='" . $event_id . "'";
                                        $querycost = mysqli_query($con, $sqlextracost);
                                        $chkcost = mysqli_num_rows($querycost);
                                        if ($chkcost != 0) {
                                            while ($costdata = mysqli_fetch_object($querycost)):
                                                $costarray[] = $costdata;
                                            endwhile;
                                        }

        //echo var_dump($costarray);

                                        $cost_total_extra = 0;
                                        if (count($costarray) > 0) {

                                            foreach ($costarray as $cost):
                                                $chksql = "SELECT * FROM order_extra_cost_history WHERE order_id='" . $order_id . "' AND cost_id='" . $cost->id . "'";
                                            $chkrowextra = mysqli_num_rows(mysqli_query($con, $chksql));
                                            if ($chkrowextra == 0) {
                                                mysqli_query($con, "INSERT INTO order_extra_cost_history SET order_id='" . $order_id . "',cost_id='" . $cost->id . "',cost_title='" . $cost->cost_title . "',cost_amount='" . $cost->cost_amount . "',date='" . date('Y-m-d') . "'");
                                            }
                                            $cost_total_extra +=$cost->cost_amount;
                                            endforeach;
                                        }

                                        $gatewayamount = $amount + $cost_total_extra;
                                        ?>

                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <div class="col-sm-12">
                                                <button id="payment" style="margin-top: 10px;" type="button" class="btn success-rounded-outline waves-effect btn-tkt-tbl col-sm-4"><i class="fa fa-ticket"></i> confirm</button>
                                                <script>
        //                        $(document).ready(function () {

            $("#r1").hide('slow');
            $("#r2").hide('slow');
            $("#r3").hide('slow');
            $("#r4").hide('slow');
            $("#r5").hide('slow');
            $("#exdatacheck").hide('slow');
            $("#payment_method").change(function () {
                var pmval = $(this).val();
                //alert(pmval);
                if (pmval == 1)
                {
                    $("#exdatacheck").show('slow');
                    $("#r1").show('slow');
                    $("#r2").show('slow');
                    $("#r3").show('slow');
                    $("#r4").show('slow');
                    $("#r5").show('slow');
                }
                else{
                    $("#r1").hide('slow');
                    $("#r2").hide('slow');
                    $("#r3").hide('slow');
                    $("#r4").hide('slow');
                    $("#r5").hide('slow');
                    $("#exdatacheck").hide('slow');
                }
            });

            $('button#payment').click(function () {
                            // alert("payment")
                            var getpayment_method = $("#payment_method").val();
                            if (getpayment_method != "")
                            {
                                if (document.getElementById('terms').checked == true)
                                {
                                    // Create Base64 Object
                                    // Create Base64 Object
                                    var Base64 = {_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) {
                                        var t = "";
                                        var n, r, i, s, o, u, a;
                                        var f = 0;
                                        e = Base64._utf8_encode(e);
                                        while (f < e.length) {
                                            n = e.charCodeAt(f++);
                                            r = e.charCodeAt(f++);
                                            i = e.charCodeAt(f++);
                                            s = n >> 2;
                                            o = (n & 3) << 4 | r >> 4;
                                            u = (r & 15) << 2 | i >> 6;
                                            a = i & 63;
                                            if (isNaN(r)) {
                                                u = a = 64
                                            } else if (isNaN(i)) {
                                                a = 64
                                            }
                                            t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
                                        }
                                        return t
                                    }, decode: function (e) {
                                        var t = "";
                                        var n, r, i;
                                        var s, o, u, a;
                                        var f = 0;
                                        e = e.replace(/[^A-Za-z0-9\+\/\=]/g, "");
                                        while (f < e.length) {
                                            s = this._keyStr.indexOf(e.charAt(f++));
                                            o = this._keyStr.indexOf(e.charAt(f++));
                                            u = this._keyStr.indexOf(e.charAt(f++));
                                            a = this._keyStr.indexOf(e.charAt(f++));
                                            n = s << 2 | o >> 4;
                                            r = (o & 15) << 4 | u >> 2;
                                            i = (u & 3) << 6 | a;
                                            t = t + String.fromCharCode(n);
                                            if (u != 64) {
                                                t = t + String.fromCharCode(r)
                                            }
                                            if (a != 64) {
                                                t = t + String.fromCharCode(i)
                                            }
                                        }
                                        t = Base64._utf8_decode(t);
                                        return t
                                    }, _utf8_encode: function (e) {
                                        e = e.replace(/\r\n/g, "\n");
                                        var t = "";
                                        for (var n = 0; n < e.length; n++) {
                                            var r = e.charCodeAt(n);
                                            if (r < 128) {
                                                t += String.fromCharCode(r)
                                            } else if (r > 127 && r < 2048) {
                                                t += String.fromCharCode(r >> 6 | 192);
                                                t += String.fromCharCode(r & 63 | 128)
                                            } else {
                                                t += String.fromCharCode(r >> 12 | 224);
                                                t += String.fromCharCode(r >> 6 & 63 | 128);
                                                t += String.fromCharCode(r & 63 | 128)
                                            }
                                        }
                                        return t
                                    }, _utf8_decode: function (e) {
                                        var t = "";
                                        var n = 0;
                                        var r = c1 = c2 = 0;
                                        while (n < e.length) {
                                            r = e.charCodeAt(n);
                                            if (r < 128) {
                                                t += String.fromCharCode(r);
                                                n++
                                            } else if (r > 191 && r < 224) {
                                                c2 = e.charCodeAt(n + 1);
                                                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                                                n += 2
                                            } else {
                                                c2 = e.charCodeAt(n + 1);
                                                c3 = e.charCodeAt(n + 2);
                                                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                                                n += 3
                                            }
                                        }
                                        return t
                                    }}

                                    // 
                                    var gettotal = $("#s_total_amount").html();
                                    var encoded_amount = Base64.encode(gettotal);
                                    var encoded_order_id = Base64.encode('<?php echo $order_id; ?>');
                                    var encoded_pm = Base64.encode(getpayment_method);
                                    if (getpayment_method == 3)
                                    {

                                        //var bkash_vat = 2.50;

                                        //var calculate_bkash_vat = (gettotal * bkash_vat) / 100;

                                        //var total_bkash_order_amount = (gettotal - 0) + (calculate_bkash_vat - 0);

                                        $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 11, 'am': gettotal}, function (ream) {
                                            var encoded_amount_bkash = ream;
                                            console.log(encoded_amount_bkash);
                                            //redirect bkash payment api                                           
                                            $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 9, 'order_id': '<?php echo $order_id; ?>', 'cost': gettotal, 'city_id': 0}, function (datag) {
                                                if (datag == 1)
                                                {

                                                    var newamountofpay = Base64.encode($("#s_total_amount").html());
                                                    success("Please Wait Your Information is processing.");

                                                    $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 5, 'order_id': '<?php echo $order_id; ?>', 'amount': gettotal, 'payment_method': getpayment_method, 'movie_id': '<?php echo $movie_id; ?>'}, function (data) {

                                                        window.location.replace('<?php echo $cms->LbaseUrl(); ?>bkash-payment.php?oid=' + encoded_order_id + '&total=' + encoded_amount_bkash);
                                                    });
                                                }
                                            });
                                        });


                                        //redirect bkash payment api 
                                    } else if (getpayment_method == 1)
                                    {
                                        var shipping_receiver = $("#shipping_receiver").val();
                                        var contactno = $("#contactno").val();
                                        var shipping_address = $("#shipping_address").val();
                                        var shipping_city = $("#shipping_city").val();
                                        var areazipcode = $("#areazipcode").val();
                                        if (shipping_receiver != "" && areazipcode != "" && contactno != "" && shipping_address != "")
                                        {
                                            var getcityname = $("#shipping_city option[value=" + shipping_city + "]").html();
                                            var cost = $("#delivery_cost").html();
                                            $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 9, 'order_id': '<?php echo $order_id; ?>', 'cost': cost, 'city_id': shipping_city}, function (datag) {
                                               // alert(datag);
                                               if (datag == 1)
                                               {
                                                var payto = (gettotal - 0) + (cost - 0);
                                                var newamountofpay = Base64.encode(payto);

                                                success("Please Wait Your Information is processing.");
                                                $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 5, 'order_id': '<?php echo $order_id; ?>', 'amount': payto, 'payment_method': getpayment_method, 'shipping_receiver': shipping_receiver, 'contactno': contactno, 'shipping_address': shipping_address, 'shipping_city': getcityname, 'areazipcode': areazipcode, 'movie_id': '<?php echo $movie_id; ?>'}, function (data) {
                                                    alert(encoded_order_id);
                                                    window.location.replace('<?php echo $cms->LbaseUrl(); ?>processing_cod_movie.php?oid=' + encoded_order_id + '&amount=' + newamountofpay + '&pm' + encoded_pm);
                                                });
                                            }
                                        });


                                        } else
                                        {
                                            if (shipping_receiver == "")
                                            {
                                                error("Please Provide Ticket Receiver Name.");
                                            }

                                            if (shipping_city == "")
                                            {
                                               error("Please Provide Your Shipping City.");
                                           }

                                           if (areazipcode == "")
                                           {
                                            error("Please Provide Your Area Zip Code.");
                                        }

                                        if (contactno == "")
                                        {
                                           error("Please Provide Receiver Contact No.");
                                       }
                                       if (shipping_address == "")
                                       {
                                           error("Please Provide Shpping Address.");
                                       }
                                   }

                               } else
                               {
                                   success("Please your order detail is processing.");
                                   $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 5, 'order_id': '<?php echo $order_id; ?>', 'amount': gettotal, 'payment_method': getpayment_method, 'movie_id': '<?php echo $movie_id; ?>'}, function (data) {
                                                success("Please Wait page is redirecting to payment page.");
                                    //alert('Yahooo ... Processing Please Wait.');
                                                window.location.replace('<?php echo $cms->LbaseUrl(); ?>processing_online_movie.php?total=' + encoded_amount + '&oid=' + encoded_order_id + '&pm=' + encoded_pm);

                                            });
                               }
                           } else
                           {
                               error("Please check and make sure you agree with our terms & condition.");
                           }
                       } else
                       {
                        error("Please choose a payment method.");
                    }
                });
        //                        });

    </script>
</div>
</div>

<div class="col-md-12 bg-info" style="margin-top: 20px; margin-bottom: 20px;">
    <i class="fa fa-credit-card"></i> Please Complete Your Payment Transaction with in 20 min, Otherwise Your Seat Will Be Canceled.
</div>

<?php
} elseif ($st == 8) {
    $costcity = array();
    $sqlstring = "SELECT `city_id`,`city_name`,`city_delivery_charge` as cost FROM `event_cities` WHERE `city_id`='" . $city_id . "'";
    $querycost = mysqli_query($con, $sqlstring);
    $chkstcost = mysqli_num_rows($querycost);
    if ($chkstcost != 0) {
        while ($rowcost = mysqli_fetch_object($querycost)):
            $costcity[] = $rowcost;
        endwhile;
        echo $costcity[0]->cost;
    }
    else {
        echo 0;
    }
} elseif ($st == 9) {
    $chk = $obj->FlyQuery("SELECT * FROM order_delivery_cost WHERE order_id='" . $order_id . "'", "2");
    if ($chk == 0) {
        echo $obj->insert("order_delivery_cost", array("order_id" => $order_id, "city_id" => $city_id, "cost" => $cost, "date" => date('Y-m-d'), "status" => 1));
    } else {
        echo $obj->FlyQuery("UPDATE order_delivery_cost SET `city_id`='" . $city_id . "',`cost`='" . $cost . "' WHERE `order_id`='" . $order_id . "'", "3");
    }
} elseif ($st == 10) {
        //calculate extra cost start
    $getam = explode(",", $extra_amount);
    $getded = explode(",", $deduct_type);
        //echo var_dump($getam);
        //echo var_dump($getded);
    $amount = 0;
    $inde = 0;
    foreach ($getam as $am):
        $type = $getded[$inde];
    if ($type == 1) {
        $amount+=$am;
    } elseif ($type == 2) {
        $calam = ($ticket_total * $am) / 100;
        $amount+=$calam;
    } else {
        $amount+=$am;
    }
    $inde++;
    endforeach;
    echo $amount;
        //calculate extra cost end
} elseif ($st == 11) {
    echo base64_encode(number_format($am));
}
} else {
    echo "...OFF";
}
