<?php

include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
extract($_POST);
//$category_id ='';
$event_list_array = array();
$sqleventlist = mysqli_query($con, "SELECT event_id,event_title FROM events WHERE event_category_id='" . $category_id . "' order by event_status='active' desc");
$roweventlist = mysqli_num_rows($sqleventlist);
$load_opt = '';
if ($roweventlist != 0) {
    while ($eventlistrows = mysqli_fetch_object($sqleventlist)) {
        $event_list_array[] = $eventlistrows;
    }
    $load_opt .='<option value="0">Please Select A Event</option>';
    if (isset($_POST['event_id'])) {
        if (!empty($event_list_array)) {
            foreach ($event_list_array as $evlarray):
                if($_POST['event_id']==$evlarray->event_id)
                {
                    $extra_class='selected="selected"';
                }
                else
                {
                    $extra_class='';
                }
                $load_opt .='<option '.$extra_class.'   value="' . $evlarray->event_id . '">' . $evlarray->event_title . '</option>';

            endforeach;
        }
    } else {
        if (!empty($event_list_array)) {
            foreach ($event_list_array as $evlarray):
                $load_opt .='<option  value="' . $evlarray->event_id . '">' . $evlarray->event_title . '</option>';

            endforeach;
        }
    }
}

echo $load_opt;
?>                                   
