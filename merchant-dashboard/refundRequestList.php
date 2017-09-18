<?php
include './DBconnection/auth.php';
include '../cms/merchantPlugin.php';
$cms = new plugin();
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--Title Part start Here-->
        <?php echo $cms->pageTitle("Ticket List| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("newrefundlist")); ?>
        <!--./CSS Part end here-->

    </head>

    <body ng-app="merchantaj" ng-controller="newrefundRequestListController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div growl></div>
        <div class="wrapper">
            <?php include ('includes/sidebar.php'); ?>

            <div class="main-panel">
                <?php include ('includes/top_navigation.php'); ?> 

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- Wizard Sarts Here -->
                                 <?php include ('includes/box_refund_rquest_list.php'); ?> 
                                <!--./ Wizard Ends Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php include ('includes/footer.php'); ?> 
            </div>
        </div>
    </body>

    <!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->

    <!-- Footer Js start here--->
    
        
    
    
    <?php
    echo $cms->footerJs(array("newrefundlist"));
    ?>
    <script>
        jQuery (document).ready(function () {
        /*kendo script start here */
                    var postarray={"id":1};
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 15,
                        transport: {
                            read: {
                                url: "./php/controller/ticketListController.php",
                                type: "POST",
                                data:
                                {
                                        "acst":1, //action status sending to json file
                                        "table":"select id,cid,contacts,process,CASE WHEN 1 THEN 'Active' ELSE 'Inactive' END AS status,remarks,date from send_message_history as smh",
                                        "cond":0,
                                        "multi":postarray

                                }
                            }
                        },
                        autoSync: true,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                TT_id: "TT_id",
                                fields: {
                                    TT_id: {nullable: true},
                                    TT_type_title: {type: "string"}
                                }
                            }
                        }
                    });
                    
                    jQuery("#ticlkst").kendoGrid({
                        dataSource: dataSource,
                        filterable: true,
                        pageable: {
                            refresh: true,
                            input: true,
                            numeric: false,
                            pageSizes: true,
                            pageSizes: [5, 10, 20, 50],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [
                            {field: "TT_id", title: "TT_id"},
                            {field: "TT_type_title", title: "TT_type_title"}
                        ]
                    });
                    /*kendo script start here */
                });    
    </script>
    <!--Footer Js End Here-->

    


    <script type="text/javascript">
//        $(document).ready(function () {
//            demo.initOverviewDashboard();
//            demo.initCirclePercentage();
//
//        });
    </script>

    <script type="text/javascript">
        // jQuery
        //$("form#event-cover-photo").dropzone({url: "/file/post"});
        // Dropzone class:
        //var myDropzone = new Dropzone("form#event-cover-photo", { url: "/file/post"});
    </script>



    

<!--  Angular LIBRARY Js
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    ./Angular LIBRARY Js

    Bootstrap Js start
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    Bootstrap Js End


     custom anular script
    <script src="../angularJs/app.js"></script>
    <script src="../angularJs/scripts/createEventController.js"></script>
    CUSTOM ANGULAR SCRIPT-->
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

