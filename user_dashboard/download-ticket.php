<?php
session_start();

//$o_id = trim($_GET['oid']);
 $o_id = $_GET['oid'];
 $order_session=$_GET['order_session'];
 
//$html = file_get_contents("http://192.168.1.48/ticketchai_aj/user_dashboard/downloadTicketLoad.php?o_id=$o_id");

$html = file_get_contents("http://ticketchai.com/ticketchaiorg/user_dashboard/downloadTicketLoad.php?o_id=$o_id"."&order_session=$order_session");

include("./mpdf/mpdf2.php");
$mpdf = new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
//$nfile="e-ticket-" . $o_id . "-" . time() . ".pdf";
//include("./mpdf/mpdf2.php");
//$mpdf = new mPDF();
//$mpdf->WriteHTML($html, 2);
//@$mpdf->Output('../pdf/' . $nfile, 'F');
//echo $nfile;

?>