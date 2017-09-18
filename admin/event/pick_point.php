<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
$EI_event_id = "";
$EI_venue_id = "";
$EI_name = "";
$EI_description = "";
$EI_price = "";
$EI_total_quantity = "";
$EI_limit = "";
$EI_status = "";
$EI_created_on = "";
$EI_created_by = "";

$arr = array();
$get_events = "SELECT event_id,event_title FROM events order by event_id desc";
$rs = mysqli_query($con, $get_events);
if ($rs) {
    while ($obj = mysqli_fetch_object($rs)) {
        $arr[] = $obj;
    }
} else {
    if (DEBUG) {
        $err = "get_events error: " . mysqli_error($con);
    } else {
        $err = "get_events query failed.";
    }
}



$varr = array();
$get_venues = "SELECT venue_id,venue_title FROM event_venues order by venue_id desc";
$vrs = mysqli_query($con, $get_venues);
if ($vrs) {
    while ($vobj = mysqli_fetch_object($vrs)) {
        $varr[] = $vobj;
    }
} else {
    if (DEBUG) {
        $err = "get_venues error: " . mysqli_error($con);
    } else {
        $err = "get_venues query failed.";
      
    }
}

//insert start
   if (isset($_POST['btneditEntpickpnt'])) {
    extract($_POST);

    $EI_event_id = mysqli_real_escape_string($con, $EI_event_id);
    $EI_status = "1";
    $EI_created_by = getSession("admin_id");
    $EI_created_on = date("Y-m-d H:i:s");

    $countpost = count($_POST['EI_pick_point']);
    $i = 0;
    if ($countpost != 0) {
        foreach ($_POST['EI_pick_point'] as $point):
            $insert_IncludesArray = '';
            $insert_IncludesArray .= ' event_id = "' . $EI_event_id . '"';
            $insert_IncludesArray .= ', name = "' . $point . '"';
            $insert_IncludesArray .= ', date = "' . date('Y-m-d') . '"';
            $insert_IncludesArray .= ', status = "1"';
            $insert_IncludesArray .= ', created_on = "' . $EI_created_on . '"';
            $insert_IncludesArray .= ', created_by = "' . $EI_created_by . '"';


            $run_insert_query = "UPDATE event_pick_point SET $insert_IncludesArray WHERE id='".$id."'";
            $result = mysqli_query($con, $run_insert_query);
            $i++;
        endforeach;
    }

    if ($i == 0) {
        $err = "run_insert_query query failed.";
    } else {
        $msg = "Event Pick Point UPDATE successfully";
        $link = "event_pick_point_list.php?msg=" . base64_encode($msg) . "&" . "venue_id=" . $EI_venue_id . "&" . "event_id=" . $EI_event_id;
        redirect($link);
    }
}
//insert end










//Update event pick point start

if (isset($_POST['btnCreateEventInclude'])) {
    extract($_POST);

    $EI_event_id = mysqli_real_escape_string($con, $EI_event_id);
    $EI_status = "1";
    $EI_created_by = getSession("admin_id");
    $EI_created_on = date("Y-m-d H:i:s");

    $countpost = count($_POST['EI_pick_point']);
    $i = 0;
    if ($countpost != 0) {
        foreach ($_POST['EI_pick_point'] as $point):
            $insert_IncludesArray = '';
            $insert_IncludesArray .= ' event_id = "' . $EI_event_id . '"';
            $insert_IncludesArray .= ', name = "' . $point . '"';
            $insert_IncludesArray .= ', date = "' . date('Y-m-d') . '"';
            $insert_IncludesArray .= ', status = "1"';
            $insert_IncludesArray .= ', created_on = "' . $EI_created_on . '"';
            $insert_IncludesArray .= ', created_by = "' . $EI_created_by . '"';


            $run_insert_query = "INSERT INTO event_pick_point SET $insert_IncludesArray";
            $result = mysqli_query($con, $run_insert_query);
            $i++;
        endforeach;
    }

    if ($i == 0) {
        $err = "run_insert_query query failed.";
    } else {
        $msg = "Event Pick Point Saved Data successfully";
        $link = "event_pick_point_list.php?msg=" . base64_encode($msg) . "&" . "venue_id=" . $EI_venue_id . "&" . "event_id=" . $EI_event_id;
        redirect($link);
    }
}


//update event pick point end
//edit event pick point start
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $eventpickpoint = "SELECT * FROM event_pick_point  WHERE id = '" . $id . "'";
    $pickpointarray = array();
    $sqlpickpoint = mysqli_query($con, $eventpickpoint);
    $pickpointchk = mysqli_num_rows($sqlpickpoint);
    if ($pickpointchk != 0) {
        while ($pickpointrow = mysqli_fetch_object($sqlpickpoint)) {
            $pickpointarray[] = $pickpointrow;
        }
    }
}
//edit event pick point end
//    echo var_dump($pickpointarray);
//    exit();
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
        <script>
            function hiderow(id)
            {
                var chkclass = id;
                //alert(chkclass);
                if (chkclass == 'class0')
                {
                    alert("You Cann't Remove Table 1st Rows");
                }
                else
                {
                    var c = confirm("are you sure to Delete this Row From Table ?.");
                    if (c)
                    {
                        $('.' + id).closest('tr').remove();
                        var increval = cloneCount--;
                        var increvald = cloneCountd--;
                    }
                }
            }



        </script>
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
            <div class="innerAll spacing-x2">

                <?php
                include basePath('admin/message.php');
                if (isset($_GET['id'])) {
                    ?>
                    <h3 class="bg-white content-heading border-bottom strong">Edit New Pick Point For Event</h3>

                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="includesCreate">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">

                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="includesError"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Event Title</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="EI_event_id" name="EI_event_id">
                                                    <option  value="0">Select Event</option>
                                                    <?php if (count($arr)>= 0): ?>
                                                        <?php foreach ($arr as $at): ?>
                                                            <option <?php if ($pickpointarray[0]->event_id == $at->event_id) { ?> selected="selected" <?php } ?> value="<?php echo $at->event_id; ?>">
                                                                <?php echo $at->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle"></label>
                                            <div class="col-md-8">
                                                <table class="table table-striped table-bordered"  id="productmore">
    <!--                                                    <thead>
                                                        <tr>
                                                            <th>Pick Point</th>
                                                            <th style="text-align:right;"><input type="hidden" id="currentId"></th>
                                                        </tr>
                                                    </thead>-->
                                                    <tbody id="POITable">
                                                        <tr class="class0" id="0">
                                                            <td style="text-align:right;">
                                                                <input class="form-control"  name="EI_pick_point[]" min="1" placeholder="Pick Point Name" value="<?php echo $pickpointarray[0]->name; ?>" type="text"/>
                                                            </td>
    <!--                                                            <td align="center" style="font-size:32px;"><label><a href="#" class="hhdrow" onClick="hiderow('class0')"><i class="fa fa-trash-o"></i></a></label></td>-->
                                                        </tr>
                                                    </tbody>
    <!--                                                    <tbody>       
                                                        <tr>
                                                            <td style="text-align:right;" colspan="2">
                                                                <button type="button"  onclick="return addTableRow('#productmore');
                                                                        return false;" id="btn2" class="btn" ><i class="icon-plus"></i> ADD MORE</button>
                                                            </td>                            
                                                        </tr>        
                                                    </tbody>-->
                                                </table>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  onclick="javascript:return confirm('Are you absolutely sure to save This pick point record ?')"   id="btneditEntpickpnt" name="btneditEntpickpnt" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Update Pickpoint List</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                <?php } else { ?>
                    <h3 class="bg-white content-heading border-bottom strong">Create New Pick Point For Event</h3>
                    <form class="form-horizontal margin-none" method="post" autocomplete="off" id="includesCreate">

                        <div class="widget widget-inverse">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-9">

                                        <div class="form-group">
                                            <label  class="col-md-4 control-label"></label>
                                            <div class="col-md-8" id="includesError"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle">Event Title</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="EI_event_id" name="EI_event_id">
                                                    <option value="0">Select Event</option>
                                                    <?php if (count($arr) >= 1): ?>
                                                        <?php foreach ($arr as $at): ?>
                                                            <option value="<?php echo $at->event_id; ?>"  
                                                            <?php
                                                            if ($at->event_id == $EI_event_id) {
                                                                echo ' selected="selected"';
                                                            }
                                                            ?>>
                                                                <?php echo $at->event_title; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="venueTitle"></label>
                                            <div class="col-md-8">
                                                <table class="table table-striped table-bordered"  id="productmore">
                                                    <thead>
                                                        <tr>
                                                            <th>Pick Point</th>
                                                            <th style="text-align:right;"><input type="hidden" id="currentId"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="POITable">
                                                        <tr class="class0" id="0">
                                                            <td style="text-align:right;">
                                                                <input class="form-control"  name="EI_pick_point[]" min="1" placeholder="Pick Point Name" type="text"/>
                                                            </td>
                                                            <td align="center" style="font-size:32px;"><label><a href="#" class="hhdrow" onClick="hiderow('class0')"><i class="fa fa-trash-o"></i></a></label></td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>       
                                                        <tr>
                                                            <td style="text-align:right;" colspan="2">
                                                                <button type="button"  onclick="return addTableRow('#productmore');
                                                                            return false;" id="btn2" class="btn" ><i class="icon-plus"></i> ADD MORE</button>
                                                            </td>                            
                                                        </tr>        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                                <hr class="separator" />
                                <div class="form-actions">
                                    <button type="submit"  onclick="javascript:return confirm('Are you absolutely sure to save This pick point record ?')"   id="btnCreateEventInclude" name="btnCreateEventInclude" class="btn btn-primary" ><i class="fa fa-check-circle"></i> Create Pickpoint List</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>
    </div>
    <script type="text/javascript">
        $("#eventpickpointlist").addClass("active");
        $("#eventpickpointlist").parent().parent().addClass("active");
        $("#eventpickpointlist").parent().addClass("in");
    </script>
    <?php include basePath('admin/footer_script.php'); ?>
    <script type="text/javascript">

        var cloneCount = 1;
        var cloneCountd = 0;
        function addTableRow(table)
        {
            var increval = cloneCount++;
            var increvald = cloneCountd++;
            var $tr = $(table + ' tbody:first').children("tr:last").clone().attr("class", 'class' + increval);

            $tr.find("input[type!='hidden'][name*=first_name],select,button").clone();
            $tr.find(".hhdrow").attr("onClick", "hiderow('class" + increval + "')");
            //$(table+' tbody:first').children("tr:last").after($tr);
            $(table + ' tbody:first').children("tr:last").after($tr);
        }


    </script>
</body>
</html>