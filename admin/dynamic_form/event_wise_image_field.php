<?php
include '../../config/config.php';
$adminID = 0;
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
} else {
    $adminID = getSession('admin_id');
}



if (isset($_POST['submit'])) {
    extract($_POST);
    if (!empty($event_id) && !empty($event_image)) {


        $sqlup = mysqli_query($con, "UPDATE events SET event_is_eticket_user_image='" . $event_image . "' WHERE event_id='" . $event_id . "'");

        $link = baseUrl() . 'admin/dynamic_form/event_wise_image_field.php?event_id='.$event_id.'&msg=' . base64_encode("Event Updated Successfully.");
        redirect($link);
    } else {
        $link = baseUrl() . 'admin/dynamic_form/event_wise_image_field.php?event_id='.$event_id.'&err=' . base64_encode("Failed Update Event.");
        redirect($link);
    }
}


$event_id='';

$exdata=array();
if(isset($_GET['event_id']))
{
   extract($_GET); 
   $sqlfet=  mysqli_query($con,"SELECT event_id,event_is_eticket_user_image as status FROM events WHERE event_id='".$event_id."'");
    $chk=  mysqli_num_rows($sqlfet);
    if($chk!=0)
    {
        while($row=  mysqli_fetch_object($sqlfet)):
            $exdata[]=$row;
        endwhile;
        
        $event_id=$exdata[0]->event_id;
        $event_status=$exdata[0]->status;
        
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

        <div id="content" style="padding-left: 0px;">
            <h3 class="bg-white content-heading border-bottom">Define Dynamic Form Image Upload Permission - Event Wise <strong></strong></h3>
            <div class="innerAll spacing-x2">
                <?php include basePath('admin/message.php'); ?>
                <!-- Content Start Here -->
                <form class="form-horizontal" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
                            <a href="javascript:void(0);">
                                <div data-toggle="collapse" data-target="#widget0" class="widget-head" style="background-color: #006892;">
                                    <h4 class="heading" style="color: yellow;"><strong><i class="fa fa-plus-circle"></i>&nbsp;&nbsp; <span>Please Select Yes / No</span></strong></h4>
                                    <span class="collapse-toggle"></span>
                                </div>
                            </a>

                            <div id="widget0"  style="padding: 15px;">

                                <div class="col-md-5 pull-left">
                                    <input type="radio" <?php  if($event_id!=''){ if($event_status=="yes"){ ?> checked="checked" <?php } } ?> id="event_image_0" name="event_image" value="yes">&nbsp;Yes (Place a Image Field After The Dynamic Form)<br/>
                                    <input type="radio" <?php  if($event_id!=''){ if($event_status=="no"){ ?> checked="checked" <?php } } ?> id="event_image_1" name="event_image" value="no">&nbsp;No (I don't Want Image Field After The Dynamic Form)&nbsp;&nbsp;&nbsp;
                                </div>



                                <div class="col-md-5 pull-left">
                                    <label class="col-md-12">Select A Event</label>
                                    <select name="event_id" class="k-select">
                                        <option value="">Choose a event</option>
                                        <?php
                                        $evar = array();
                                        $sqlevent = mysqli_query($con, "select event_id,event_title from events WHERE event_status='active' AND event_is_private='yes'");
                                        $chkevent = mysqli_num_rows($sqlevent);
                                        if ($chkevent != 0) {

                                            while ($ev = mysqli_fetch_object($sqlevent)):
                                                $evar[] = $ev;
                                            endwhile;
                                            foreach ($evar as $event):
                                                
                                                ?>
                                                <option  
                                                    <?php  if($event_id==$event->event_id){  ?> selected="selected" <?php  } ?>
                                                     value="<?php echo $event->event_id; ?>"><?php echo $event->event_title; ?></option>
                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <script>
                                        $(document).ready(function () {
                                            $('select').change(function () {
                                                
                                                if (this.value != '')
                                                {
                                                    $("input[type=radio]").removeAttr('checked');
                                                    $.post("<?php echo baseUrl(); ?>admin/dynamic_form/ajax.php",{'st':1,'event_id':this.value},function(data){
                                                     //alert(data); 
                                                     $("input[name=event_image][value=" + data + "]").attr('checked', 'checked');
                                                    });
                                                }
                                            });

                                        });
                                    </script>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>

                        <?php // debug($arrPermissionXml);   ?>
                    </div>
                    <!-- Content End Here -->
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Set Permission</button>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php include basePath('admin/footer.php'); ?>
        <!-- // Footer END -->
    </div><!-- // Main Container Fluid END -->

    <script type="text/javascript">
        $("#dynamicFormImage").addClass("active");
        $("#dynamicFormImage").parent().parent().addClass("active");
        $("#dynamicFormImage").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
