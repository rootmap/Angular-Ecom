<?php
include '../../config/config.php';


if (isset($_GET['id']) AND $_GET['id'] > 0) {
    $ID = $_GET['id'];
    $sqlContact = "SELECT * FROM contact_us WHERE CU_id=$ID ";
    $executeContactInfo = mysqli_query($con, $sqlContact);
    if ($executeContactInfo) {
        $getContactInfo = mysqli_fetch_object($executeContactInfo);
        if (isset($getContactInfo->CU_id)) {
            $name = $getContactInfo->CU_name;
            $email = $getContactInfo->CU_email;
            $subject = $getContactInfo->CU_subject;
            $message = $getContactInfo->CU_message;
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

                                                        <p style="font:22px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:0px 0 0 0;padding:0;color:#000">Welcome to ticketchai</p>
                                                        <p style="text-align:justify;font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:15px 0 0 0;padding:0">Hello <?php echo $name; ?></p>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td> 
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Thank you for sending your query through ticketchai. </p>
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Your requesting contact subject is <strong><?php echo $subject ?></strong> and details is - <strong><?php echo $message; ?></strong> </p>
                                                        <p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;margin:20px 0 5px 0;padding:0">Ticketchai will contact with you for further extension.</p>

                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="50">&nbsp;</td>
                                                    <td><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:bold;margin:10px 0 10px 0;padding:10px 0 0 0;color:#000000">Thanks Again</p><p style="font:14px Helvetica Neue,Helvetica,Arial,sans-serif;color:#777777;line-height:21px;margin:0;padding:0">ticketchai.com Team</p></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="8" background="" colspan="3"></td>
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