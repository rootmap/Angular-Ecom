<?php
session_start();

$o_id = trim($_GET['order_id']);
$html = file_get_contents(" http://www.ticketchai.org/email/body/order_movie_ticket.php?order_id=$o_id");

//$html = file_get_contents(" http://www.ticketchai.org/user_dashboard/downloadTicketLoad.php?o_id='$o_id' ");
//exit();

//include("./pdflib/MPDF57/mpdf.php");
$nfile="e-ticket-" . $o_id . "-" . time() . ".pdf";
include("./mpdf/mpdf2.php");
$mpdf = new mPDF();
$mpdf->WriteHTML($html, 2);
@$mpdf->Output('../pdf/' . $nfile, 'F');
echo $nfile;
//$mpdf->Output();
?>