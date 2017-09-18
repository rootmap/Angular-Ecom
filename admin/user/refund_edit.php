<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
//$arr = array();
//$get_admin_types = "SELECT * FROM admin_types";
//$rs = mysqli_query($con, $get_admin_types);
//
//while ($obj = mysqli_fetch_object($rs)) {
//$arr[] = $obj;
//}
$id = "";
$merchantnamenew = "";
$placeAvailAbleAmount = "";
$RefundMethodnew = "";

$mobilenumber = "";
$BankName = "";
$AcNumber = "";
$RequestAmount = "";
$RemarksNote = "";
$refundStatus = "";
$merchant_id = array();

$mobilenumber = '';
$BankName = '';
$AcNumber = '';


//UPDATE OPSTION START HERE
if (isset($_POST["btnUpdateRefund"])) {

    extract($_POST);
    $validation = FALSE;


    if (!empty($merchantname) && !empty($AvailableAmount) && !empty($RefundMethod) && !empty($RequestAmount) && !empty($refundStatus)) {


        if ($AvailableAmount >= $RequestAmount) {

            $merchantnamenew = mysqli_real_escape_string($con, $merchantname);
            $placeAvailAbleAmount = mysqli_real_escape_string($con, $AvailableAmount);
            $RefundMethodnew = mysqli_real_escape_string($con, $RefundMethod);

            $RequestAmount = mysqli_real_escape_string($con, $RequestAmount);
            $RemarksNote = mysqli_real_escape_string($con, $RemarksNote);
            $refundStatus = mysqli_real_escape_string($con, $refundStatus);

            if ($RefundMethodnew == 2) {
                if (!empty($mobilenumber)) {
                    $mobilenumber = mysqli_real_escape_string($con, $mobilenumber);
                } else {
                    $validation = TRUE;
                }
            }

            if ($RefundMethodnew == 3) {
                if (!empty($BankName) && !empty($AcNumber)) {
                    $BankName = mysqli_real_escape_string($con, $BankName);
                    $AcNumber = mysqli_real_escape_string($con, $AcNumber);
                } else {
                    $validation = TRUE;
                }
            }

            if ($validation == FALSE) {

              echo  $sql = "UPDATE `refund_request` SET ";
                $sql .="merchant_id='$merchantnamenew',";
                $sql .="available_amount='$placeAvailAbleAmount',";
                $sql .="refund_method='$RefundMethodnew',";
                if ($RefundMethodnew == 2) {
                    $sql .="mobile_number='$mobilenumber',";
                } elseif ($RefundMethodnew == 3) {
                    $sql .="bank_name='$BankName',";
                    $sql .="ac_number='$AcNumber',";
                }
                $sql .="request_amount='$RequestAmount',";
                $sql .="remarks='$RemarksNote',";
                $sql .="status='$refundStatus'";
                $sql .=" WHERE id='$id'";

//            echo $sql;
//            exit();
                $checkAdmin = mysqli_query($con, $sql);

                if (!$checkAdmin) {
                    $err = mysqli_error($con);
                } else {
                    $msg = "Refund Request Update Successfully.";
                }
            } else {

                $err = "Some Field is Still Empty.";
            }
        } else {
            $err = "Requested Withdraw amount should be less than or equal to Total amount.";
        }
    } else {
        $err = "Failed, Please Fillup all field.";
    }
}

//print_r($msg);
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!<html> <![endif]-->
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
        <h3 class="bg-white content-heading border-bottom strong">Add Admin</h3>
        <div class="innerAll spacing-x2">
            <?php include basePath('admin/message.php'); 
            $id = $_GET['rid'];
            ?>
            <form class="form-horizontal margin-none" action="" method="post" autocomplete="off">

                <div class="widget widget-inverse">
                    <div class="widget-body">
                        <div class="row">

                            <div class="col-md-6">
                                <input type="hidden" value="<?php echo $id; ?>" name="id" />
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="merchantname">Merchant Name</label>

                                    <div class="col-md-8">
                                        <?php
                                        /* @var $id type */
                                        

                                        $sqldataquery = mysqli_query($con, "SELECT id,merchant_id,request_amount,refund_method,mobile_number,
                                                                            bank_name,ac_number,remarks,status FROM refund_request as r where r.id='$id'");
                                        $rowdata = mysqli_fetch_array($sqldataquery);

                                        $merchant_id = $rowdata['merchant_id'];
                                        $refund_method=$rowdata['refund_method'];

                                        $query = "SELECT MI_id,concat(`MI_first_name`,' ',`MI_last_name`) as fullname
                                                            FROM `merchant_info`  WHERE MI_id='$merchant_id'";
                                        //$query="SELECT * FROM merchant_info WHERE MI_id='$id'";
                                        $result = mysqli_query($con, $query);
                                        ?>

                                        <select class="form-control" id="merchantnamenew" name="merchantname"> 
                                            <option value="0">Select Name</option>
                                            <?php while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option <?php if ($row['MI_id'] == $merchant_id) { ?> selected="selected" <?php } ?> value="<?php echo $row['MI_id']; ?>"><?php echo $row['fullname']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>


                                </div>

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="AvailableAmount">Available Amount</label>
                                    <div class="col-md-8">

                                        <input readonly="readonly"  type="text" class="form-control"  id="placeAvailAbleAmount" name="AvailableAmount" required >
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="RefundMethod">Refund Method</label>
                                    <div class="col-md-8">

                                        <select class="form-control" id="RefundMethodnew" name="RefundMethod" value="<?php echo $rowdata['refund_method']; ?>" > 
                                            <option value="0">Select Method</option>
                                            <option <?php if($rowdata['refund_method']==1){ ?> selected="selected" <?php } ?> value="1">cash</option>
                                            <option <?php if($rowdata['refund_method']==2){ ?> selected="selected" <?php } ?> value="2">Bkash</option>
                                            <option <?php if($rowdata['refund_method']==3){ ?> selected="selected" <?php } ?> value="3">Bank</option>
                                        </select>

                                        <br>



                                        <div id="hidden_div">

                                            
                                            <div class="form-group" id="q2"  style="display: none;">
                                                <label for="2"> mobile number</label>
                                                <input type="text" class="form-control" id="mobilenumber" value="<?php echo $rowdata['mobile_number']; ?>" name="mobilenumber">
                                            </div>
                                            
                                            <div class="form-group" id="q3"  style="display: none;">
                                                <label for="3">Bank Name</label>
                                                <input type="text" class="form-control" id="BankName" value="<?php echo $rowdata['bank_name']; ?>" name="BankName">
                                            </div>
                                            
                                            <div class="form-group" id="q4"  style="display: none;">
                                                <label for="3"> Ac/Number</label>
                                                <input type="text"  class="form-control" id="AcNumber" value="<?php echo $rowdata['ac_number']; ?>" name="AcNumber">
                                            </div>
                                            
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="RequestAmount">Request Amount</label>
                                    <div class="col-md-8">

                                        <input type="text" class="form-control" id="RequestAmount" name="RequestAmount" value="<?php echo  $rowdata['request_amount'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="RemarksNote">Remarks/Note</label>
                                    <div class="col-md-8">

                                        <input type="text" class="form-control" value="Request For Withdraw." value="<?php echo  $rowdata['remarks'];?>" id="RemarksNote" name="RemarksNote" placeholder="Request For Withdraw.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="refundStatus">Refund Status</label>
                                    <div class="col-md-8">
                                       
                                        <select class="form-control" id="refundStatus"  name="refundStatus">
                                            <option value="0">Select Status</option>
                                            
                                            <option <?php if($rowdata['status']==1){ ?> selected="selected" <?php } ?> value="1">Active</option>
                                            <option <?php if($rowdata['status']==2){ ?> selected="selected" <?php } ?> value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="separator" />
                        <div class="form-actions">
                           
                             <button type="submit"  id="btnUpdateRefund" name="btnUpdateRefund" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php include basePath('admin/footer.php'); ?>
</div>
<script type="text/javascript">

    $("#admin_list").addClass("active");
    $("#admin_list").parent().parent().addClass("active");
    $("#admin_list").parent().addClass("in");
    function checkType(typeID) {
        var adminTypeID = typeID;
        if (adminTypeID > 0) {
            $.ajax({
                type: "POST",
                url: baseUrl + "admin/ajax/ajaxCheckAdminType.php",
                dataType: "json",
                data: {adminTypeID: adminTypeID},
                success: function (response) {
                    var obj = response;
                    var newHtml = '';
                    if (obj.output === "success") {
                        if (obj.flag == 1) {
                            if (obj.arrEvent.length > 0) {
                                $.each(obj.arrEvent, function (key, Event) {
                                    newHtml += '<tr>';
                                    newHtml += '<td><input type="checkbox" name="eventID[]" value="' + Event.event_id + '"></td>';
                                    newHtml += '<td>' + Event.event_title + '</td>';
                                    newHtml += '</tr>';
                                });
                            } else {
                                newHtml += '<tr>';
                                newHtml += '<td colspan="2" >No active event found in record.</td>';
                                newHtml += '</tr>';
                            }
                            $("#RefundMethodnew").html(newHtml);
                            $("#tblEvent").show("slow");
                        } else {
                            $("#tblEvent").hide("slow");
                        }
                    } else {
                        error(obj.msg);
                    }
                }
            });
        }
    }




</script>


<?php include basePath('admin/footer_script.php'); ?>
<script>
    $(document).ready(function () {
<?php
if (!empty($merchant_id)) {
    ?>
            var mval = '<?= $merchant_id ?>';
            if (mval != null)
            {
                $.post("../ajax/getTotalAmount.php", {'mid': mval}, function (data) {
                    var obj = jQuery.parseJSON(data);
                    $("#placeAvailAbleAmount").val(obj);
                    //alert(obj);
                });
            }
    <?php
}
?>

        $("#merchantnamenew").change(function () {
            var mval = $(this).val();
            if (mval != null)
            {
                $.post("../ajax/getTotalAmount.php", {'mid': mval}, function (data) {
                    var obj = jQuery.parseJSON(data);
                    $("#placeAvailAbleAmount").val(obj);
                });
            }
        });
        $("#RefundMethodnew").change(function () {
            var rval = $(this).val();
            if (rval != null)
            {
                if (rval == 1)
                {
                    $("#q2").hide();
                    $("#q3").hide();
                    $("#q4").hide();
                }
                else if (rval == 2)
                {
                    $("#q2").show();
                    $("#q3").hide();
                    $("#q4").hide();
                }
                else if (rval == 3)
                {
                    $("#q2").hide();
                    $("#q3").show();
                    $("#q4").show();
                }

            }
        });
        
        <?php 
        if(!empty($refund_method))
        {
            ?>
            var rval = '<?php echo $refund_method; ?>';
            if (rval != null)
            {
                if (rval == 1)
                {
                    $("#q2").hide();
                    $("#q3").hide();
                    $("#q4").hide();
                }
                else if (rval == 2)
                {
                    $("#q2").show();
                    $("#q3").hide();
                    $("#q4").hide();
                }
                else if (rval == 3)
                {
                    $("#q2").hide();
                    $("#q3").show();
                    $("#q4").show();
                }

            }        
            <?php
        }
        
        ?>
        
    });
</script>
</body>
</html>
