<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$form_event_id = "";
$form_field_id = "";
$form_field_type = "";
$form_field_name = "";
$form_field_given_id = "";
$form_field_is_required = "";
$form_field_priority = "";
$form_field_value_array = "";
$form_field_status = "";
$form_type = "";
// Get Event Title Data
$arrEvents = array();
$sqlEvent = "SELECT event_id,event_title FROM events WHERE event_status='active'";
$resultEvent = mysqli_query($con, $sqlEvent);
if ($resultEvent) {
    while ($resultEventObj = mysqli_fetch_object($resultEvent)) {
        $arrEvents[] = $resultEventObj;
    }
} else {
    if (DEBUG) {
        $err = "resultEvent error: " . mysqli_error($con);
    } else {
        $err = "resultEvent query failed.";
    }
}
// Get Event Title Data


if (isset($_POST['form_event_id'])) {

    extract($_POST);
//    debug($_POST);

    $checkStatus = 0;

    if (empty($form_event_id) || $form_event_id == '0') {
        $err = "Event title required";
    } else if (empty($form_type)) {
        $err = "Form type required";
    } else {


        $fieldType = '';
        $fieldTitle = '';
        $fieldID = '';
        $fieldName = '';
        $fieldValues = '';
        $fieldPriority = '';
        $fieldRequired = '';
        $fieldUnique = '';

        for ($i = 0; $i < 10; $i++) {
            if (isset($_POST['form_field_type_' . $i]) AND isset($_POST['form_field_title_' . $i]) AND isset($_POST['form_field_given_id_' . $i]) AND isset($_POST['form_field_name_' . $i])) {
                $fieldType = $_POST['form_field_type_' . $i];
                $fieldTitle = $_POST['form_field_title_' . $i];
                $fieldID = $_POST['form_field_given_id_' . $i];
                $fieldName = $_POST['form_field_name_' . $i];
                $fieldValues = $_POST['form_field_value_array_' . $i];
                $fieldPriority = $_POST['form_field_priority_' . $i];

                //setting required field value based on submission
                if (isset($_POST['form_field_is_required_' . $i]) AND $_POST['form_field_is_required_' . $i] == "yes") {
                    $fieldRequired = 'yes';
                } else {
                    $fieldRequired = 'no';
                }


                // setting unique value based on submission
                if (isset($_POST['form_field_is_unique_' . $i]) AND $_POST['form_field_is_unique_' . $i] == "yes") {
                    $fieldUnique = 'yes';
                } else {
                    $fieldUnique = 'no';
                }

                $insertValue = '';
                $insertValue .=' form_event_id = "' . validateInput($form_event_id) . '"';
                $insertValue .=', form_type = "' . validateInput($form_type) . '"';
                $insertValue .=', form_field_type = "' . validateInput($fieldType) . '"';
                $insertValue .=', form_field_title = "' . validateInput($fieldTitle) . '"';
                $insertValue .=', form_field_name = "' . validateInput($fieldName) . '"';
                $insertValue .=', form_field_given_id = "' . validateInput($fieldID) . '"';
                $insertValue .=', form_field_is_required = "' . validateInput($fieldRequired) . '"';
                $insertValue .=', form_field_is_unique = "' . validateInput($fieldUnique) . '"';
                $insertValue .=', form_field_priority = "' . validateInput($fieldPriority) . '"';
                $insertValue .=', form_field_value_array = "' . validateInput($fieldValues) . '"';
                $insertValue .=', form_field_status = "' . validateInput('active') . '"';

                $sqlInsertForm = "INSERT INTO event_dynamic_forms SET $insertValue";
                $resultInsertForm = mysqli_query($con, $sqlInsertForm);

                if (!$resultInsertForm) {
                    $checkStatus++;
                    if (DEBUG) {
                        echo "resultInsertForm error: " . mysqli_error($con);
                    }
                }
            }
        }
    }


    if ($checkStatus == 0) {
        $msg = "Form data saved successfully.";
        $link = "dynamic_form_list.php?msg=" . base64_encode($msg);
        redirect($link);
    } else {
        $err = "All form data not inserted properly, Please check.";
    }
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
            <h3 class="bg-white content-heading border-bottom strong">Add Dynamic Form</h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="dynamicForm">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="form-group">
                                    <label  class="col-md-4 control-label"></label>
                                    <div class="col-md-12" id="DynamicError"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Event Title</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="form_event_id" name="form_event_id">
                                                <option value="0">Select Event</option>
                                                <?php if (count($arrEvents) >= 1): ?>
                                                    <?php foreach ($arrEvents as $Event): ?>
                                                        <option value="<?php echo $Event->event_id; ?>"  
                                                        <?php
                                                        if ($Event->event_id == $form_event_id) {
                                                            echo ' selected="selected"';
                                                        }
                                                        ?>>
                                                                <?php echo $Event->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Form Type</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="form_type" name="form_type">
                                                <option value="">Select Form Type</option>
                                                <option value="subs"<?php
                                                if ($form_type == "subs") {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>Subscription Form</option>
                                                <option value="info"<?php
                                                if ($form_type == "info") {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>User Info Form</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr class="separator" />
                            <span id="total_field">
                                <div class="row field-add">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="type">Element Type</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="form_field_type" name="form_field_type_0">
                                                    <option value="0">Select Type</option>
                                                    <option value="textbox">Text Box</option>
                                                    <option value="selectbox">Select Box</option>
                                                    <option value="radio">Radio</option>
                                                    <option value="checkbox">Check Box</option>
                                                    <option value="upload">File Upload</option>
                                                    <option value="textarea">Text Area</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element Title</label>
                                            <div class="col-md-8"><input class="form-control" id="form_field_title" name="form_field_title_0" type="text" /></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element ID</label>
                                            <div class="col-md-8"><input class="form-control" id="form_field_given_id" name="form_field_given_id_0" type="text" /></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element Name</label>
                                            <div class="col-md-8"><input class="form-control" id="form_field_name" name="form_field_name_0" type="text"/></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element Priority</label>
                                            <div class="col-md-8"><input class="form-control" id="form_field_priority" name="form_field_priority_0" type="number" /></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element Value</label>
                                            <div class="col-md-8"><input class="form-control" id="form_field_value_array" name="form_field_value_array_0" type="text"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Element Required</label>
                                            <div class="col-md-8"><input id="form_field_is_required" name="form_field_is_required_0" type="checkbox" value="yes"/></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Is Unique</label>
                                            <div class="col-md-8"><input id="form_field_is_unique" name="form_field_is_unique_0" type="checkbox" value="yes"/></div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="separator" />
                            </span>
                            <button onclick="javascript:generateFieldDiv();" type="button" name="addMore" id="addMore" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> Add Another Field</button>
                            <br/><br/>
                            <div class="form-actions">
                                <button type="button"  return="false" id="btnSave" name="btnSave" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- // Widget END -->
                </form>
                <!-- // Form END -->
            </div>
            <!-- Content End Here -->
        </div>
        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->
    </div><!-- // Main Container Fluid END -->
    <script type="text/javascript">
        $("#formlist").addClass("active");
        $("#formlist").parent().parent().addClass("active");
        $("#formlist").parent().addClass("in");
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnSave").click(function () {

                var form_event_id = $("#form_event_id").val();
                var form_type = $("#form_type").val();

                if (form_event_id === '0') {
                    $("#DynamicError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Event title required</strong></div>');
                } else if (form_type === "") {
                    $("#DynamicError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong>Form type required</strong></div>');
                } else {
                    $("#dynamicForm").submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        function generateFieldDiv() {
            // Field Generate Function
            var count = $('div.field-add').length;
            var fieldHTML = '';
            if (count + 1 > 10) {
                alert("You cant add more than 10 field in a form.")
            } else {
                fieldHTML += '<div id="fieldDIV' + (count + 1) + '" class="row field-add">';
                fieldHTML += '<div class="col-md-12">';
                fieldHTML += '<button onclick="javascript:closeDiv(' + (count + 1) + ');" type="button" class="remove_btn close" aria-hidden="true">&times;</button>';
                fieldHTML += '</div>';
                fieldHTML += '<div class="col-md-6">';
                fieldHTML += '<div class="form-group">';//type
                fieldHTML += '<label class="col-md-4 control-label" for="type">Element Type</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<select class="form-control" id="form_field_type" name="form_field_type_' + (count) + '">';
                fieldHTML += '<option value="0">Select Type</option>';
                fieldHTML += '<option value="textbox">Text Box</option>';
                fieldHTML += '<option value="selectbox">Select Box</option>';
                fieldHTML += '<option value="radio">Radio</option>';
                fieldHTML += '<option value="checkbox">Check Box</option>';
                fieldHTML += '<option value="upload">File Upload</option>';
                fieldHTML += '<option value="textarea">Text Area</option>';
                fieldHTML += '</select>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//type
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element Title</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input class="form-control" id="form_field_title" name="form_field_title_' + (count) + '" type="text"/>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element ID</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input class="form-control" id="form_field_given_id" name="form_field_given_id_' + (count) + '" type="text" />';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element Name</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input class="form-control" id="form_field_name" name="form_field_name_' + (count) + '" type="text"/>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '</div>';//div first
                fieldHTML += '<div class="col-md-6">';//div second
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element Priority</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input class="form-control" id="form_field_priority" name="form_field_priority_' + (count) + '" type="number" />';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element Value</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input class="form-control" id="form_field_value_array" name="form_field_value_array_' + (count) + '" type="text"/>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Element Required</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input id="form_field_is_required" name="form_field_is_required_' + (count) + '" type="checkbox" value="yes"/>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '<div class="form-group">';//
                fieldHTML += '<label class="col-md-4 control-label">Is Unique</label>';
                fieldHTML += '<div class="col-md-8">';
                fieldHTML += '<input id="form_field_is_unique" name="form_field_is_unique_' + (count) + '" type="checkbox" value="yes"/>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';//
                fieldHTML += '</div>';//second div
                fieldHTML += '<hr class="separator" style="width:100%;" />';
                fieldHTML += '</div>';

            }
            $("#total_field").append(fieldHTML);
        }

        // Remove Field Function
        function closeDiv(id) {
            $("#fieldDIV" + id).remove();
        }
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
