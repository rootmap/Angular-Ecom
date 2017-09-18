<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />


        <?php include basePath('admin/header_script.php'); ?>	
    </head>
    <body class="">

        <?php include basePath('admin/header.php'); ?>

        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>


        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Charity Feature List</h3>
            <div style="margin-left: 10px;margin-right: 10px;margin-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            <div class="k-grid  k-secondary" data-role="grid" style="margin-left: 10px;margin-right: 10px;">
                <div class="k-toolbar k-grid-toolbar">
                    <?php if (checkPermission('gallery', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/charity_feature.php') ?>">
                            <span class="k-icon k-add"></span>
                            Add New Chairty Feature 
                        </a>
                    <?php endif; ?>
                    <?php if (checkPermission('event', 'create', getSession('admin_type'))): ?>
                        <a class="k-button k-button-icontext k-grid-add" href="<?php echo baseUrl('admin/event/chairty_feature_list.php'); ?>">
                            <span class="k-icon k-i-arrowhead-w"></span>
                            Go Back Chairty Feature List
                        </a>
                    <?php endif; ?>
                </div>
            </div>



            <!-- Content Start Here -->
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <div id="grid" style="margin-left: 10px;margin-right: 10px;"></div>
                <button  id="export-grid" style="margin: 10px 10px;" class="k-button">Export Report To CSV</button>
            <?php else : ?>
                <div style="margin-left: 10px;margin-right: 10px;"><h5 class="text-center">You dont have permission to view the content</h5></div>
            <?php endif; ?>
                
            <script id="edit_gallery" type="text/x-kendo-template">
            <?php if (checkPermission('gallery', 'update', getSession('admin_type'))): ?>
                                <a class="k-button k-button-icontext k-grid-edit" href="<?php echo baseUrl('admin/event/charity_feature.php'); ?>?id=#= id #"><span class="k-icon k-edit"></span>Edit</a>
            <?php endif; ?>
            <?php if (checkPermission('gallery', 'delete', getSession('admin_type'))): ?>   
                                <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
            <?php endif; ?>
            </script>
            <script type="text/javascript">
                function deleteClick(imageID) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../controller/event/chairty_feature_controller.php",
                            data: {IG_id: imageID},
                            success: function (result) {

                                if (result === true) {
                                    $(".k-i-refresh").click();
                                }
                            }
                        });
                    }
                }

            </script>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "../controller/event/chairty_feature_controller.php",
                                type: "GET"
                            },
                            destroy: {
                                url: "../controller/event/chairty_feature_controller.php",
                                type: "POST"
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    id: {nullable: true},
                                    transaction_id: {type: "string"},
                                    event_id: {type: "number"},
                                    event_title: {type: "string"},
                                    name: {type: "string"},
                                    contact_no: {type: "string"},
                                    email: {type: "string"},
                                    donate_amount: {type: "number"},
                                    donation_date: {type: "string"},
                                    donation_payment_method: {type: "string"},
                                    donation_status: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#grid").kendoGrid({
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
                            {field: "id", title: "ID", width: "150px"},
                            {field: "transaction_id", title: "Transaction ID", width: "150px"},
                            {field: "event_id", title: "Event ID", width: "150px"},
                            {field: "event_title", title: "Event Title", width: "150px"},
                            {field: "name", title: "Name", width: "150px"},
                            {field: "contact_no", title: "Phone", width: "150px"},
                            {field: "email", title: "Email", width: "150px"},
                            {field: "donate_amount", title: "Donate Amount", width: "150px"},
                            {field: "donation_date", title: "Date", width: "150px"},
                            {field: "donation_payment_method", title: "Payment Method", width: "150px"},
                            {field: "donation_status", title: "Status", width: "150px"},
                            {
                                title: "Action", width: "180px",
                                template: kendo.template($("#edit_gallery").html())
                            }
                        ],
                    });
                    
                    // CSV file export code
                    jQuery("#export-grid").click(function (e) {
                        e.preventDefault();
                        var dataSource = jQuery("#grid").data("kendoGrid").dataSource;
                        var filters = dataSource.filter();
                        var allData = dataSource.data();
                        var query = new kendo.data.Query(allData);
                        var data = query.filter(filters).data;

                        var json_data = JSON.stringify(data);
                        console.log(json_data);
                        JSONToCSVConvertor(json_data, "Donation Data List", true);

                    });
                });
                
                
                


                    function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
                        //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
                        var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

                        var CSV = '';
                        //Set Report title in first row or line

                        CSV += ReportTitle + '\r\n\n';

                        //This condition will generate the Label/Header
                        if (ShowLabel) {
                            var row = "";

                            //This loop will extract the label from 1st index of on array
                            for (var index in arrData[0]) {

                                //Now convert each value to string and comma-seprated
                                var regexUnderscore = new RegExp("_", "g");
                                row += index.replace(regexUnderscore, " ").toUpperCase() + ',';
                                //  row += index + ',';
                            }

                            row = row.slice(0, -1);

                            //append Label row with line break
                            CSV += row + '\r\n';
                        }
                        //1st loop is to extract each row
                        for (var i = 0; i < arrData.length; i++) {
                            var row = "";

                            //2nd loop will extract each column and convert it in string comma-seprated
                            for (var index in arrData[i]) {
                                row += '"' + arrData[i][index] + '",';
                            }

                            row.slice(0, row.length - 1);

                            //add a line break after each row
                            CSV += row + '\r\n';
                        }

                        if (CSV == '') {
                            alert("Invalid data");
                            return;
                        }

                        //Generate a file name
                        var fileName = "donation_ticketchai_Report_";
                        //this will remove the blank-spaces from the title and replace it with an underscore
                        fileName += ReportTitle.replace(/ /g, "_");

                        //Initialize file format you want csv or xls
                        var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

                        // Now the little tricky part.
                        // you can use either>> window.open(uri);
                        // but this will not work in some browsers
                        // or you will not get the correct file extension    

                        // this trick will generate a temp <a /> tag
                        var link = document.createElement("a");
                        link.href = uri;

                        //set the visibility hidden so it will not effect on your web-layout
                        link.style = "visibility:hidden";
                        link.download = fileName + ".csv";

                        //this part will append the anchor tag and remove it after automatic click
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }


                

            </script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.k-grid-delete').click(function () {
                        $.ajax({
                            type: 'POST',
                            url: "../controller/event/chairty_feature_controller.php",
                            data: "",
                            success: function () {

                            }
                        });
                    });
                });
            </script>


            <!-- Content End Here -->

        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#chairtyfeaturelist").addClass("active");
        $("#chairtyfeaturelist").parent().parent().addClass("active");
        $("#chairtyfeaturelist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>


