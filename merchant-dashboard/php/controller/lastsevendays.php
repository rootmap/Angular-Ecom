<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include '../../DBconnection/auth.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// Including database connections start here
require_once '../../DBconnection/database_connections.php';
// Including database connections end here
//json data encoding passing start here
$data = json_decode(file_get_contents("php://input"));
//json data encoding passing end here







$newvar=array();
for ($x =1; $x <=7; $x++) {
    $date =date('Y-m-d');
    $date = strtotime($date);
    $date = strtotime("+$x day", $date);
    $newvar[]=date('d/m/Y', $date);
} 

echo json_encode($newvar);

