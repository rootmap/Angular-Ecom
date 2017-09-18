<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$EF_question = "";
$EF_answer = "";
$EF_created_on = "";
$EF_updated_by = "";
$EF_event_id = "";

if (isset($_GET['EF_id'])) {
    $event_faq_id = $_GET['EF_id'];
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $sqlEvent = "select event_title from events where event_id = $event_id";
    $runEventSql = mysqli_query($con, $sqlEvent);
    if ($runEventSql) {
        while ($row = mysqli_fetch_object($runEventSql)) {
            $event_title = $row->event_title;
        }
    } else {
        if (DEBUG) {
            $err = "runEventSql` error: " . mysqli_error($con);
        } else {
            $err = "runEventSql query failed.";
        }
    }
}


if (isset($_POST['EF_question'])) {
    extract($_POST);

    $EF_event_id = validateInput($EF_event_id);
    $EF_question = validateInput($EF_question);
    $EF_answer = validateInput($EF_answer);
    $EF_updated_by = getSession("admin_id");


    $updateFAQArray = '';
    $updateFAQArray .= ' EF_event_id = "' . $EF_event_id . '"';
    $updateFAQArray .= ', EF_question = "' . $EF_question . '"';
    $updateFAQArray .= ', EF_answer = "' . $EF_answer . '"';
    $updateFAQArray .= ', EF_updated_by = "' . $EF_updated_by . '"';

    $checkQuestionSql = "SELECT event_faqs.EF_question FROM event_faqs WHERE EF_question = '$EF_question' AND EF_event_id=$EF_event_id AND EF_id NOT IN (" . $event_faq_id . ")";
    $checkQuestionRun = mysqli_query($con, $checkQuestionSql);
    $countQuestion = mysqli_num_rows($checkQuestionRun);
    if ($countQuestion >= 1) {
        $err = "This question is already added for this " . $event_title;
    } else {
        $updateFAQQuery = "UPDATE event_faqs SET $updateFAQArray WHERE EF_id = $event_faq_id";
        $result = mysqli_query($con, $updateFAQQuery);
        if ($result) {
            $msg = "Event FAQ updated successfully";
            $link = "created_faq_list.php?msg=" . base64_encode($msg) . "&event_id=" . $event_id;
            redirect($link);
        } else {
            if (DEBUG) {
                $err = "updateFAQQuery error: " . mysqli_error($con);
            } else {
                $err = "updateFAQQuery query failed.";
            }
        }
    }
}




$getFAQData = "SELECT event_faqs.* FROM event_faqs WHERE EF_id = $event_faq_id";
$resultFAQ = mysqli_query($con, $getFAQData);
$countFAQ = mysqli_num_rows($resultFAQ);
if ($resultFAQ) {
    if ($countFAQ > 0) {
        while ($row = mysqli_fetch_object($resultFAQ)) {
            $EF_event_id = $row->EF_event_id;
            $EF_question = $row->EF_question;
            $EF_answer = $row->EF_answer;
        }
    }
} else {
    if (DEBUG) {
        $err = "resultFAQ error: " . mysqli_error($con);
    } else {
        $err = "resultFAQ query failed ";
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
        <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
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
        <div id="content"><h3 class="bg-white content-heading border-bottom strong">Edit FAQ of <?php echo $event_title; ?></h3>

            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <form class="form-horizontal margin-none" method="post" autocomplete="off" id="faqCreate">

                    <div class="widget widget-inverse">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group">
                                        <label  class="col-md-4 control-label"></label>
                                        <div class="col-md-8" id="faqError"></div>
                                    </div>
                                    <input type="hidden" name="EF_event_id" value="<?php echo $EF_event_id; ?>"/>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="questionFAQ">Question</label>
                                        <div class="col-md-8">
                                            <textarea name="EF_question" id="EF_question" cols="30" rows="3" class="form-control rounded-none margin-bottom"><?php echo $EF_question; ?></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="answerFAq">Answer</label>
                                        <div class="col-md-8">
                                            <textarea id="EF_answer" name="EF_answer" rows="3" cols="30"><?php echo html_entity_decode($EF_answer, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="separator" />
                            <div class="form-actions">
                                <button type="button"  id="btnCreateFAQ" name="btnCreateFAQ" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update FAQ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->
        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->

    </div><!-- // Main Container Fluid END -->
    <script>
        $(document).ready(function () {
            $("#EF_answer").kendoEditor({
                tools: [
                    "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                    "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                    "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                    "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                    "fontName", "fontSize", "foreColor", "backColor"
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnCreateFAQ").click(function () {
                var EF_question = $("#EF_question").val();
                var EF_answer = $("#EF_answer").val();
                if (EF_question === "") {
                    $("#faqError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter question</em></strong></div>');
                } else if (EF_answer === "") {
                    $("#faqError").html('<div class="alert alert-danger fade in"><button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button><strong><em>Enter answer</em></strong></div>');
                } else {
                    $("#faqError").html('');
                    $("#faqCreate").submit();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $("#faqlist").addClass("active");
        $("#faqlist").parent().parent().addClass("active");
        $("#faqlist").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>