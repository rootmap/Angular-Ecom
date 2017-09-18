<?php
include './cms/plugin.php';
$cms = new plugin();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Seminers | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("events"));
        ?>           
        <style type="text/css">
            .filter-select{
                background-image: none !important;
                background-color: transparent !important;
                border: 2px solid #FFF !important;
                color: #FFF !important;
            }
            .filter-select>option{
                color:black;
            }
            .form-group{padding-bottom:7px;margin:11px 0 0 0 !important;}
            .btn-nav-search {
                background-color: transparent !important;
                border: 2px solid #ffffff !important;
                color: #ffffff !important;
                height: 37px !important;
                width: 100%;
                min-width: 210px;
                margin-top: 10px !important;
                border-radius: 0px !important;
            }
        </style>
        <!--[ style for search on place and category way ]-->

    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="eventClt">
        <?php include './include/categoryBody.php';?>
    </body>    

</html>

