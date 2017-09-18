<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $date = "2016-12-07";
    $date = strtotime($date);
    $date = strtotime("+2 day", $date);
    echo date('Y-m-d', $date);
?>