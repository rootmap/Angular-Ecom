<?php

include '../../config/config.php';
include '../../lib/mpdf/mpdf.php';
extract($_GET);
$dateTimeNow=date("d-m-y H:i:s");
$mpdf=new mPDF('c', 'A4', '', '', 15, 15, 15, 15, 16, 13);
$mpdf->SetDisplayMode('fullpage');
$stylesheet=file_get_contents(baseUrl() . "pdfticket/style.css");
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->list_indent_first_level=0;
$url=baseUrl() . "pdfticket/e-ticket-mini.php?id=" . $order_id . "&type=ticket&OS_id=0&quantity=1";
$html=file_get_contents($url);
$mpdf->WriteHTML($html, 2);
$nfile="e_ticket_" . $order_id . "_" . time() . ".pdf";
@$mpdf->Output('../../pdfticket/email_pdf/' . $nfile, 'F');
echo $nfile;
exit();

