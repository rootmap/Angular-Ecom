<?php
session_start();
//require_once './DBconnection/database_connections.php';
require_once './DBconnection/database_connections.php';

//require_once '../DBconnection/auth.php';

$o_id = $_GET['o_id'];


$sqlgetactualdata = "SELECT a.*,
b.name,
c.*,
a.order_id as mov_order_id,
eml.event_id
FROM order_movie_event as a 
LEFT JOIN event_movie_theatre as b on b.theatre_id=a.theatre_id 
LEFT JOIN orders as c on c.order_id=a.verified_order_id 
LEFT JOIN event_movie_list as eml on eml.movie_id=a.movie_id 

WHERE a.verified_order_id='" . $o_id . "'  or a.order_id='".$o_id."'";


$queryactualuser = mysqli_query($con, $sqlgetactualdata);

$chkactualuser = mysqli_num_rows($queryactualuser);

$alldataact = array();


    
//    echo 'heheheheehehehe';
    
    while ($rowactu = mysqli_fetch_object($queryactualuser)):

        $alldataact[] = $rowactu;

    endwhile;



    // echo $order_id;

    //echo var_dump($alldataact);

//    exit();

    ?>

<div>
                <h5 style="background: #A9D95E none repeat scroll 0 0;color: black;font-size: 14px;margin: 26px auto 13px;padding: 3px;
                           text-align: center;width: 70%;">Please print and bring this ticket with you</h5>
</div>

<div style="width:550px; height:auto; font-size: 12px; margin:0 auto; border:1px solid #ccc; background:#FFF; font-family: helvetica,arial; font-size: 12px;">

    <div  style="width:550px; height:100px; margin:0 auto; border-bottom:1px solid #ccc;">

        <div style="width:250px; height:80px; margin:10px;color: rgb(116, 118, 121); font-family: helvetica,arial; font-size: 11px; float:left;">

            <!--<img class="logo mar-0" height="50" style="padding-top: 15px;" src="<?php // echo baseUrl(); ?>pdfticket/images/Logo_Blockbuster_Cinemas.png" alt="Blockbuster Cinemas"/>-->
            <img class="logo mar-0" height="50" style="padding-top: 15px;" src="http://ticketchai.org/upload/Logo_Blockbuster_Cinemas.png" alt="Blockbuster Cinemas"/>
            </div>

        <div style="width:250px; height:80px; margin:10px;color: rgb(116, 118, 121); font-family: helvetica,arial; font-size: 11px; float: right; text-align: right;">

            <p class="mar-top-60" style="padding-top: 40px;">Block Buster Cinemas Online Ticket</p>

            </div>

        </div>

        <div class="customer-info">

            <table  style="width:400px; margin-top:20px; margin-left:125px; font-family: helvetica,arial; margin: 0 auto;">

            	<tr>

                    <th style="text-align: left; color:#2B84C3; font-weight:bold; font-size: 12px; padding-top: 20px;" colspan="2" class="text-left bbc-blue bold">Booking Details</th>

                </tr>

                <tr>

                    <td class="bold" style="font-weight:bold;  font-size: 12px;">Name</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->fullname; ?></td>

                </tr>

                <tr>

                    <td class="bold" style="font-weight:bold;  font-size: 12px;">Ticket Number</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->lid; ?></td>

                </tr>

                <tr>

                	<th colspan="2" style="text-align: left;  font-size: 12px; color:#2B84C3; font-weight:bold;">Movie &amp; Show Time Details</th>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold;  font-size: 12px;">Movie Name</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->movie_name; ?></td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold;  font-size: 12px;">Theatre Name</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->name; ?></td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold;  font-size: 12px;">Movie Show Date</td>

                        <td  style=" color:#2B84C3; font-size: 12px;"><?php 

                        echo date("l", strtotime($alldataact[0]->request_date)).", ".date("d", strtotime($alldataact[0]->request_date))." ".date("M", strtotime($alldataact[0]->request_date))." ".date("Y", strtotime($alldataact[0]->request_date));

                        ?> </td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold; font-size: 12px;">Movie Show Time</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->show_time; ?></td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold; font-size: 12px;">Seat Class</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->seat_type; ?></td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold; font-size: 12px;">No of Seats</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->seat; ?></td>

                </tr>

                <tr>

                	<td class="bold" style="font-weight:bold; font-size: 12px;">Seat Number(s)</td>

                    <td style="font-size: 12px;"><?php echo $alldataact[0]->seat_number; ?></td>

                </tr>

                <tr>

                	<th colspan="2" style="text-align: left; color:#2B84C3; font-size: 12px; font-weight:bold;">Payment Details</th>

                </tr>

                <tr>

                    <td class="bold" style=" font-size: 12px; font-weight: bold;">Total Price</td>

                    <td style="font-size: 12px;"><?php 

                    $total_price=$alldataact[0]->seat_unit_price*$alldataact[0]->seat; 

                    echo $total_price;

                    ?> Taka</td>

                </tr>

                <tr>

                	<td colspan="2" style="text-align: center;  font-size: 12px; color:#2B84C3; font-weight:bold; padding-top: 10px;">Electronic Ticket Bar Code</td>

                </tr>

                <tr>

                    <td colspan="2" class="text-center" style="text-align: center;">

                        <div class="barcodecell"><barcode  code="<?php echo $alldataact[0]->lid; ?>" type="c93" text="1"/></div>
<!--                        <img src="<?php //echo baseUrl(); ?>pdfticket/images/barcode.png">-->
                    </td>

                </tr>

                <tr>

                	<td colspan="2" class="text-center" style="text-align: center; font-size: 12px;">

                            Customer Care Hotline +88028413768 ,<br>

                        +88028413766 ,<a style="color:#2B84C3; font-size: 12px; text-decoration:none;" target="_blank" href="#">+8801913399015</a>

                        ,<a style="color:#2B84C3; text-decoration:none; font-size: 12px;" target="_blank" href="#">+8801913398051</a>

                    </td>
                    
                </tr>
                
            </table>
            
            <table  style="width:550px; background-color:#f4f4f4; padding-left:25px; padding-right:25px; padding-bottom:25px; margin-top:30px;">

            	<tr>

                    <td style="width:100px; font-family: helvetica,arial; font-size: 11px; padding-top:0px;"><a target="_blank" href="mailto:customercare@blockbusterbd.com" style="">customercare@blockbusterbd.com</a></td>

                    <td style="width:200px; font-family: helvetica,arial; font-size: 11px; color: rgb(160, 163, 167); padding-top:12px;">Ka- 244 Pragati Avenue<br>Kuril Dhaka Bangladesh</td>

                    <td style="width:30px;">&nbsp;</td>

                    <td style="width:250px; text-align:right; padding-top:12px;">

                    	<span>

                        	<a  href="#"><img border="0" width="18" height="18" style="width: 18px; min-height: 18px; padding:5px; color:#2B84C3; text-decoration:none;" alt="Official Website" src="http://ticketchai.org/upload/web2.png"></a>

                        </span>

                        <span>

                        	<a  href="#"><img border="0" width="18" height="18" style="width: 18px; min-height: 18px; padding:5px; color:#2B84C3; text-decoration:none;" alt="Facebook" src="http://ticketchai.org/upload/facebook.png"></a>

                        </span>

                        <span>

                        	<a  href="#"><img border="0" width="18" height="18" style="width: 18px; min-height: 18px; padding:5px; color:#2B84C3; text-decoration:none;" alt="Twitter" src="http://ticketchai.org/upload/gmap.png"></a>

                        </span>

                        <span style="">

                        	<a  href="#"><img border="0" width="18" height="18" style="width: 30px; min-height: 18px; padding:5px; color:#2B84C3; text-decoration:none;" alt="Youtube" src="http://ticketchai.org/upload/youtube.png"></a>

                        </span>

                    </td>

                </tr>

                <tr>

                    <td colspan="4" style="padding-top: 10px; font-family: helvetica,arial; font-size: 11px; color: rgb(191, 194, 199);">

                    	<span>

                            <a  target="_blank" style="color: rgb(0, 185, 242); text-decoration: none; color:#2B84C3; text-decoration:none;" href="https://u1972694.ct.sendgrid.net/wf/click?upn=rVNMv17Ss-2F9MetArySh-2FGrEIwDonMzLbCcxxZD7SKecb53wK-2FSPVrhLsCUJObToE_Oj0n29nq4-2FozNqUmX5AnYIyjhPmzg2jgXPkXboBlU-2FefX1aDHql4p5ZHnNb-2F3jig48fYZPE3TAZtN9iMc5-2B0bcnLeMaDz-2BhuebBEcaV7P0NPjhKLSThpNm7MZ9VpyZO-2Fst9NH6IR6ZxGSBbBvWk9PXh-2FNrqj4ODvAbZfMCJb-2BrRRx9HKD91qcJaOghIlIA3dNZlY64mgwG4TZp0WYBu-2Buh7NZO3zDTxQDW57B-2F4fkMWLjPFnP6LOKGkNFpIXYuEzaGH5HvNbKvv-2BrdAzOzBVq213XyHGpiYNQyfQAFt3cs-2FprYJP2Tu9h7TKzP8-2Bkv1U">Contact Us</a>

                        </span>

                        |

                        <span>

                            <a  target="_blank" style="color: rgb(0, 185, 242); text-decoration: none; color:#2B84C3; text-decoration:none;" href="https://u1972694.ct.sendgrid.net/wf/click?upn=rVNMv17Ss-2F9MetArySh-2FGrEIwDonMzLbCcxxZD7SKec2g3UX42E53-2B8SVWjXMgTOpjaSpvbbmqDXuvuhBRuHxQ-3D-3D_Oj0n29nq4-2FozNqUmX5AnYIyjhPmzg2jgXPkXboBlU-2FefX1aDHql4p5ZHnNb-2F3jig48fYZPE3TAZtN9iMc5-2B0bcnLeMaDz-2BhuebBEcaV7P0NPjhKLSThpNm7MZ9VpyZO-2F8YfJmgr-2FHGWh6AnQSLSFQgEGFYV4LVWvEM-2FV4CX-2F4DaKmPG6UUub01TTwfLFCLgGvEl21etl323WL0GgaEOOMdEWjcogXaNJ2-2FloxmI-2BQqjZ5wOcVzV6xrBVouYkPs2w0Z1py33DDE45JM8NdCAjvnDGZkcZFNM5cZNG5iTXHmSsryqRMcuTayOu5ozdBtR-2F">Schedules</a>

                        </span>

                        |

                        <span>

                            <a  target="_blank" style="color: rgb(0, 185, 242); text-decoration: none; color:#2B84C3; text-decoration:none;" href="https://u1972694.ct.sendgrid.net/wf/click?upn=rVNMv17Ss-2F9MetArySh-2FGrEIwDonMzLbCcxxZD7SKeePxUnArIT0eMUX06twV409Jdb-2BugI63Yft1ak7hV9q-2Fw-3D-3D_Oj0n29nq4-2FozNqUmX5AnYIyjhPmzg2jgXPkXboBlU-2FefX1aDHql4p5ZHnNb-2F3jig48fYZPE3TAZtN9iMc5-2B0bcnLeMaDz-2BhuebBEcaV7P0NPjhKLSThpNm7MZ9VpyZO-2FMYblhSfDa-2BbQumOWc-2B2kZUeErqMYnePONxm-2Fr0-2FEzs6I7Z0-2FgfkbiLaLnSQBUTNq1G0aEOW-2FUHIGUa0dmDqWFlmpYHfaoP8js5S5l3bBfWaR3ApN3jK4OTVza7bXcXIweNBHpNA60mUEM02UiIpwGWrmEDk-2F9W72KrHhe6W00HzCSPgp3e2p31WCSGQLaxcz">Club Roayls</a>

                        </span>

                        |

                        <span>

                            <a  target="_blank" style="color: rgb(0, 185, 242); text-decoration: none; color:#2B84C3; text-decoration:none;" href="https://u1972694.ct.sendgrid.net/wf/click?upn=rVNMv17Ss-2F9MetArySh-2FGrEIwDonMzLbCcxxZD7SKeePxUnArIT0eMUX06twV409Jdb-2BugI63Yft1ak7hV9q-2Fw-3D-3D_Oj0n29nq4-2FozNqUmX5AnYIyjhPmzg2jgXPkXboBlU-2FefX1aDHql4p5ZHnNb-2F3jig48fYZPE3TAZtN9iMc5-2B0bcnLeMaDz-2BhuebBEcaV7P0NPjhKLSThpNm7MZ9VpyZO-2FMYblhSfDa-2BbQumOWc-2B2kZUeErqMYnePONxm-2Fr0-2FEzs6I7Z0-2FgfkbiLaLnSQBUTNq1G0aEOW-2FUHIGUa0dmDqWFlmpYHfaoP8js5S5l3bBfWaR3ApN3jK4OTVza7bXcXIweNBHpNA60mUEM02UiIpwGWrmEDk-2F9W72KrHhe6W00HzCSPgp3e2p31WCSGQLaxcz">+88-02-8413768</a>

                        </span>

                        | <span style="margin-left: 30px; display: inline-block;">Online Ticketing Partner

                            <img height="30" align="right" src="http://ticketchai.org/tc-merchant-template/assets/img/white-shadow-logo.png"></span>

                    </td>

                </tr>

            </table>

        </div>

    </div>

<h3 style="text-align: center; color: #f00;">Note : A Ticket Will Appear In Your Inbox From Blockbuster in few minutes , You can print this one or you can print blockbuster ticket receipt copy from your email and show this ticket in hall counter to collect your actual seat ticket.</h3>


