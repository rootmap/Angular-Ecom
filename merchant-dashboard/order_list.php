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
        <?php echo $cms->pageTitle("Order List| Buy Online Ticket... "); ?>
        <!--./Title Part end Here-->



        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--CSS Part start here-->
        <?php echo $cms->headCss(array("orderList")); ?>
        <!--./CSS Part end here-->



    </head>

    <body ng-app="merchantaj" ng-controller="orderListController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
<div growl></div>

        <!--modal From Date Wise Order Report Start-->


    <from class="modal fade" id="myModal" tabindex="-1" ng-model="modelData" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><legend><span class="ti-timer"></span> Order Date And Time</legend></h4>
                    <div class="form-group">
                        <style type="text/css">
                             select option:empty{display:none }
                          </style>
                        <label for="1"> Select Event</label>
                        <select ng-model="modelData.event" ng-init="modelData=''" name="event" class="form-control">
                            <option value="">SELECT EVENT</option>
                            <option ng-repeat="venueMtd in VenueNewData" value="{{ venueMtd.event_id}}">{{ venueMtd.event_title}}</option>
                        </select>
                    </div>
                </div>

                <div class="modal-body">
                    <!-- Step 2 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <div class="clearfix"></div>
                                    <input id="start-date-order" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input id="end-date-order" type="text" date-format='yyyy-MM-dd' class="form-control datepicker" placeholder="Date Picker Here"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">

                                    <button type="button" ng-click="ModelDataReportDateWise(modelData)" value="save" class="btn btn-fill btn-info btn-block">Generate Report</button>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- ./Step 2 -->
                </div>
            </div>
        </div>
    </from>
    <!--modal From Date Wise Order Report  End-->



    <!--modal From Event Wise  Order Report Start-->


    <from class="modal fade" id="prossingModal" tabindex="-1" ng-model="modelDataG" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><legend><span class="ti-timer"></span> Eventwise Order Report</legend></h4>
                    <div class="form-group">
                        <label for="1"> Select Event</label>
                        <select  ng-model="modelDataG.event" name="event" class="form-control" ng-init="modelDataG.event=1">
                           <option value="1" ng-selected="true">Select Event</option>
                            <option ng-repeat="venueMtdG in VenueNewData" ng-selected="{{ venueMtdG.event_id}}=={{ modelDataG.event}}" value="{{ venueMtdG.event_id}}">{{ venueMtdG.event_title}}</option>
                        </select>
                    </div>

                    <div class="row-fluid" style="margin-top: 20px;">
                        <div class="col-md-6">

                            <button type="button" ng-click="MEventWOrderReport(modelDataG)" value="save" class="btn btn-fill btn-info btn-block">Generate Order Report</button>

                        </div>
                    </div>


                </div>


            </div>
        </div>
    </from>
    <!--modal From Event Wise Order Report  End-->

    <!--Modal From Send Message To All Attendees Start Here-->
    <div class="modal fade" id="sendAttendeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Send Message To All Attendees</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Send To:</label>
                            <input type="text" class="form-control" ng-model="attendeesEmailAll"  id="recipient-name2"  >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea  ng-model="attendeesmsgAll"  class="form-control" id="message-text2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" ng-click="SendMessageToAllAttendees()">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal From Send Message To All Attendees End Here-->



    <!--processing modal from start here-->  

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Send To:</label>
                            <input type="email" class="form-control" id="recipient-name"  ng-model="email" placeholder="@email" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label" >Message:</label>
                            <textarea class="form-control" id="message-text" ng-model="msg"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="sendmassage()">Send message</button>
                </div>
            </div>
        </div>
    </div>

    <!--processing modal from end here-->

    <div class="wrapper">
        <?php include ('includes/sidebar.php'); ?>

        <div class="main-panel">
            <?php include ('includes/top_navigation.php'); ?> 

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- Wizard Sarts Here -->
                            <?php include ('includes/box_order_list.php'); ?> 
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
echo $cms->footerJs(array("orderList"));
?>
<script>
    // Init DatetimePicker
    demo.initFormExtendedDatetimepickers();

    jQuery(document).ready(function () {
        /*kendo script start here */
//                    var postarray={"id":1};
//                    var dataSource = new kendo.data.DataSource({
//                        pageSize: 15,
//                        transport: {
//                            read: {
//                                url: "./php/controller/ticketListController.php",
//                                type: "POST",
//                                data:
//                                {
//                                        "acst":1, //action status sending to json file
//                                        "table":"select id,cid,contacts,process,CASE WHEN 1 THEN 'Active' ELSE 'Inactive' END AS status,remarks,date from send_message_history as smh",
//                                        "cond":0,
//                                        "multi":postarray
//
//                                }
//                            }
//                        },
//                        autoSync: true,
//                        schema: {
//                            data: "data",
//                            total: "data.length",
//                            model: {
//                                TT_id: "TT_id",
//                                fields: {
//                                    TT_id: {nullable: true},
//                                    TT_type_title: {type: "string"}
//                                }
//                            }
//                        }
//                    });
//                    
//                    jQuery("#ticlkst").kendoGrid({
//                        dataSource: dataSource,
//                        filterable: true,
//                        pageable: {
//                            refresh: true,
//                            input: true,
//                            numeric: false,
//                            pageSizes: true,
//                            pageSizes: [5, 10, 20, 50],
//                        },
//                        sortable: true,
//                        groupable: true,
//                        columns: [
//                            {field: "TT_id", title: "TT_id"},
//                            {field: "TT_type_title", title: "TT_type_title"}
//                        ]
//                    });
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
<!--prossing script start here-->
<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Send E-ticket ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<!--prossing script end here-->

<!--send message to all attendees script start here-->
<script>
$('#sendAttendeesModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Send Message To All Attendees' + recipient)
 // modal.find('.modal-body input').val(recipient)
})
</script>
<!--send message to all attendees script end here-->
</html>
