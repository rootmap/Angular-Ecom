<?php
session_start();

if(isset($_GET['order_id'])){
$o_id = trim($_GET['order_id']);
$html = file_get_contents("http://ticketchai.org/user_dashboard/downloadTicketLoadMovie.php?o_id=$o_id");
//$html = file_get_contents("http://ticketchai.org/user_dashboard/downloadTicketLoad.php?o_id=$o_id");
//$html = file_get_contents("http://ticketchai.org/user_dashboard/downloadTicketLoadMovie.php?o_id=$o_id");

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

}
#################################################### bkash pdf create #########################################

if(!empty($_GET['o_id'])){ 
    $order_id = trim($_GET['o_id']);
$html = file_get_contents("http://ticketchai.org/user_dashboard/downloadTicketLoadMovie.php?o_id=$order_id");

$nfile="e-ticket-" . $order_id . "-" . time() . ".pdf";
include("./mpdf/mpdf2.php");
$mpdf = new mPDF();
$mpdf->WriteHTML($html, 2);
@$mpdf->Output('../pdf/' . $nfile, 'F');
echo $nfile;
//$mpdf->Output();
}
?>