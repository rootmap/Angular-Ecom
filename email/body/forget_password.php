<?php
include '../../config/config.php';
$user_email = "";
$user_hash = "";
$user_first_name = "";
$user_middle_name = "";
$user_last_name = "";
$social_type = "";

if (isset($_GET['user_id']) AND $_GET['user_id'] > 0) {
    $UserID = $_GET['user_id'];
    $sqlUserInfo = "SELECT * FROM users WHERE user_id=$UserID";
    $executeUserInfo = mysqli_query($con, $sqlUserInfo);
    if ($executeUserInfo) {
        $getUserInfo = mysqli_fetch_object($executeUserInfo);
        if (isset($getUserInfo->user_id)) {
            $user_first_name = $getUserInfo->user_first_name;
            $user_email = $getUserInfo->user_email;
            $user_hash = $getUserInfo->user_hash;
            $social_type = $getUserInfo->user_social_type;
        }
    }
    ?>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f5f5f5">
            <tbody>
                <tr>
                    <td>
                        <table width="500" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>

                                <?php include basePath('email/header.php'); ?>
                                <tr>
                                    <td height="50">
                                        <table width="500" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #e3e3e3;padding:0;margin:0">
                                            <tbody>
                                                <tr>
                                                    <td width="60" height="50"><img width="60" height="50" border="0" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                                    <td width="380"><img width="380" height="1" border="0" align="top" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                                    <td width="60"><img width="60" height="1" border="0" alt="" src="https://ci4.googleusercontent.com/proxy/Qe2uM_zJqchcwTlSmPb8F2nhsXkA5eD0lk8IOyrxbmkOSiHjC-kxXxWwQtdsEUA17dyZRtkP095VYXO2JJ0NHrwgw56AGxWOrVKDQkkXb_1ewA=s0-d-e1-ft#http://www.ticketchai.com/storage/newsletter/images/dot.gif" class="CToWUd"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <!-- content -->

                                                        <p style="font:22px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:0px 0 0 0;padding:0;color:#000">Hello <?php echo $user_first_name; ?>,</p>
                                                        <p style="text-align:justify;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:15px 0 0 0;padding:0">We had receive a forgot password request from your email. </p>
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td> 
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">If you want to reset your password please click the link to set your new password <b><a href="<?php echo baseUrl(); ?>reset_password.php?m=<?php echo base64_encode($user_email); ?>&h=<?php echo base64_encode($user_hash); ?>" target="blank">Click here</a></b>.</p>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td> 
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">If you didn't make this request please ignore this email.</p>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thanks Again</p><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;color:#777777;line-height:21px;margin:0;padding:0">ticketchai.com Team</p></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td height="8" background="">
                                                        <p style="font:10px Helvetica Neue,Helvetica,Arial,sans-serif;margin:10px 0 10px 0;padding:10px 0 0 0;color: #0066cc;">
                                                            Note: Do not reply to this email. This is an system generated email.
                                                        </p>
                                                    </td>
                                                    <td height="50">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php include basePath('email/footer.php'); ?>
                            </tbody>
                        </table>

                    </td>
                </tr>
            </tbody>
        </table>
    </body>
    <?php
} else {
    echo "Incorrect parameter";
}