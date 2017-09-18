<?php
//require_once('mpdf/mpdf.php');
////include('../mpdf/mpdf.php');
//$mpdf=new mPDF();
//$mpdf->WriteHTML("yfyffyf");
//$mpdf->Output();   exit;
//

//include('includes/order_ticket.php');
//$html= "includes/order_ticket.php";
//$mpdf=new mPDF(); 
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->WriteHTML("fgdg");
//$mpdf->Output();
////$mpdf->Output('result.pdf','F');
//exit();
 ?>
<?php
$html = '
<h1><a name="top"></a>mPDF</h1>
<h2>Basic HTML Example</h2>
This file demonstrates most of the HTML elements.
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<h6>Heading 6</h6>
';
 
include("./mpdf/mpdf.php");
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
?>