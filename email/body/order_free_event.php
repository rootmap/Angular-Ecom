<?php
$sqlq=mysqli_query($con, "SELECT * FROM users_info_free_event WHERE session_id='" . $orderArray[0]->order_session_id . "'");
$chkord=mysqli_num_rows($sqlq);
if ($chkord != 0) {
    $rowd=mysqli_fetch_array($sqlq);
    //OI_session_id
    
    ?>
<tr>
    <td valign="top">
        <h1 style="font-size:22px;font-weight:normal;line-height:22px;">Hello <?php echo $rowd['full_name']; ?>,</h1>
        <p style="font-size:15px;line-height:16px;">
            Thank you for free event registration. Your ticket has been attached with this email please download and bring this ticket printed copy with you in the event. The details of your event registration are given below.
        </p>
    </td>
</tr>
<tr>
    <td valign="top">
        <h3 style="font-size:16px;font-weight:normal;">Your Ticket Number #&nbsp;<?php echo $orderNumber; ?></h3>
    </td>
</tr>
<?php } ?>
        