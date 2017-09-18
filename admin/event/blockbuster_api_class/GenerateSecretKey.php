<?php

class configtoapi {

    public function open() {
        //@include '../../../config/local.config.php';
        //$con = mysqli_connect("localhost", "ticketchai15", "ODsza^neen0?", "ticketchai-new");
        $con = mysqli_connect("localhost", "tickette_chdata", "Ticket@chai#2017", "tickette_chdata");
        return $con;
    }

    public function close($con) {
        mysqli_close($con);
    }

    function insert($object, $object_array) {
        $count = 0;
        $fields = '';
        $con = $this->open();
        foreach ($object_array as $col => $val) {
            if ($count++ != 0)
                $fields .= ', ';
            $col = mysqli_real_escape_string($con, $col);
            $val = mysqli_real_escape_string($con, $val);
            $fields .= "`$col` = '$val'";
        }
        $query = "INSERT INTO `$object` SET $fields";
        if (mysqli_query($con, $query)) {
            $this->close($con);
            return 1;
        } else {
            return 0;
        }
    }

    function clean($str) {
        $con = $this->open();
        $str = mysqli_real_escape_string($con, $str);
        $this->close($con);
        return $str;
    }

    function OrderID($str, $mov) {
        if ($str != '') {
            $newstr = $str;
        } else {

            $genstr = $mov . $this->lastinsertedid() . time();
            @session_regenerate_id();
            $_SESSION['SESS_ORDER_ID'] = $genstr;
            @session_write_close();
            $newstr = $genstr;
        }
        return $newstr;
    }

    function lastinsertedid() {
        $query = "SELECT MAX(id) as maxa FROM order_movie_event";
        $sql = $this->FlyQuery($query, "1");
        $maxa = $sql[0]->maxa;

        $query1 = "SELECT MAX(order_id) as maxb FROM orders";
        $sql1 = $this->FlyQuery($query1, "1");
        $maxb = $sql1[0]->maxb;

        return $maxa . "" . $maxb;
    }

    function FlyQuery($object, $st) {
        $count = 0;
        $fields = '';
        $con = $this->open();
        $query = $object;
        $result = mysqli_query($con, $query);
        if ($result) {

            if ($st == 1) {
                $count = mysqli_num_rows($result);
                if ($count >= 1) {
                    //$object[]=array();
                    while ($rows = $result->fetch_object()) {
                        $objects[] = $rows;
                    }
                    $this->close($con);
                    return $objects;
                }
            } elseif ($st == 3) {
                $this->close($con);
                return 1;
            } else {
                $count = mysqli_num_rows($result);
                $this->close($con);
                return $count;
            }
        }
    }

    function FlyPrepare($object) {
        $con = $this->open();
        $query = $object;
        $result = mysqli_query($con, $query);
        if ($result) {
                $this->close($con);
                return 1;
        }
        else
        {
            $this->close($con);
            return 0;
        }
    }

    function FlyGetMax($table,$fid)
    {
        $con = $this->open();
        $result = mysqli_query($con, "SELECT MAX(`$fid`) as maxa FROM `$table`");
        if ($result) {
                if(mysqli_num_rows($result)==0)
                {
                    $this->close($con);
                    return 1;
                }
                else
                {
                    while ($rows = $result->fetch_object()) {
                        $objects[] = $rows;
                    }


                    $this->close($con);
                    return $objects[0]->maxa;
                }
                
        }
        else
        {
            $this->close($con);
            return 0;
        }
    }

    function FlyLastID()
    {
        $con = $this->open();
        return mysqli_insert_id($con);
        /*if($last_id)
        {
            return $last_id;
        }
        else
        {
            return 0;
        }*/
    }

    function MultiInsert($object) {
        $count = 0;
        $fields = '';
        $con = $this->open();
        $query = $object;
        $result = mysqli_multi_query($con, $query);
        if ($result) {
            $this->close($con);
            return 1;
        }
    }

}

class GenerateKeySecret {

    function encrypt_cbc($str, $key) {
        $iv = $key;
        @$td = mcrypt_module_open("rijndael-128", "", "cbc", $iv);
        @mcrypt_generic_init($td, $key, $iv);
        $encrypted = mcrypt_generic($td, $str);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return bin2hex($encrypted);
    }

    function decrypt_cbc($code, $key) {
        $code = $this->hes2bin($code);
        $iv = $key;
        $td = mcrypt_module_open("rijndaek-128", "", "cbc", $iv);
        mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $code);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return utf8_encode(trim($decrypted));
    }

    protected function hes2bin($hexdata) {
        $bindata = '';
        for ($i = 0; $i < strlen($hexdata); $i+=2):
            $bindata .=chr(hexdec(substr($hexdata, $i, 2)));
        endfor;
        return $bindata;
    }

    public function trxid($length) {
        $chars = "ABCDEFGHIJKLMNOPQRSTWVXYZ12345678910";
        $size = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .=$chars[rand(0, $size - 1)];
        }
        return $str;
    }

    function ApiAccessLink($param = '') {

        $cur_random_value = time();
        $key = 'TcZcoChai9372341';
        $conparam = '';
        if ($param != '') {
            $count_array = count($param);
            if ($count_array != 0) {
                foreach ($param as $pp => $value):
                    $conparam .="&" . $pp . "=" . $value;
                endforeach;
            } else {
                $conparam = '';
            }
        }

        $credential = "password=BDTicket@Chai##231&trxid=" . $cur_random_value . "" . $conparam . "&format=xml";
        $BBC_Codero_Key_Generate = $this->encrypt_cbc($credential, $key);
        $BBC_Request_KEY_VALUE = urldecode($BBC_Codero_Key_Generate);
        return $BBC_Request_KEY_VALUE;
    }

    function ApiAccessLinkConfirm($param = '', $trx = '') {

        $cur_random_value = $trx;
        $key = 'TcZcoChai9372341';
        $conparam = '';
        if ($param != '') {
            $count_array = count($param);
            if ($count_array != 0) {
                foreach ($param as $pp => $value):
                    $conparam .="&" . $pp . "=" . $value;
                endforeach;
            } else {
                $conparam = '';
            }
        }

        $credential = "password=BDTicket@Chai##231&trxid=" . $cur_random_value . "" . $conparam . "&format=xml";
        $BBC_Codero_Key_Generate = $this->encrypt_cbc($credential, $key);
        $BBC_Request_KEY_VALUE = urldecode($BBC_Codero_Key_Generate);
        return $BBC_Request_KEY_VALUE;
    }

}

class XmlToJson {

    public function Parse($url) {

        @$fileContents = file_get_contents($url);

        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);

        $fileContents = trim(str_replace('"', "'", $fileContents));

        $simpleXml = simplexml_load_string($fileContents);

        $json = json_encode($simpleXml);

        return $json;
    }

    public function getMovieName($index, $st = 0) {

        $secure = new GenerateKeySecret();
        $obj = new configtoapi();
        $movielistparam = $secure->ApiAccessLink();
        $api_link = "https://api.blockbusterbd.net/v4/MovieList.php?username=shahbaz@ticketchai.com&request_id=$movielistparam";
        //$dd = file_get_contents($api_link);
        $movie = $this->Parse($api_link);
        $yummy = json_decode($movie);

        if ($st == 1):
            //include '../../config/config.php';
            $new_index = count($yummy->Movie) - 1;
            if (!empty($new_index)):
                for ($i = 0; $i <= $new_index; $i++):
                    //for($i=$new_index; $i>=1; $i--):
                    $sqlcheck_movie = $obj->FlyQuery("SELECT * FROM events WHERE event_title='" . $yummy->Movie[$i]->MovieName . "'", "2");
                    $sqlcheck_movie_rows = $sqlcheck_movie;
                    if ($sqlcheck_movie_rows == 0) {
                        $index = $i;
                        break;
                    }
                endfor;
            endif;
        endif;

        $array = array("MovieID" => $yummy->Movie[$index]->MovieID,
            "MovieName" => $yummy->Movie[$index]->MovieName,
            "DirName" => $yummy->Movie[$index]->DirName,
            "ReleaseDate" => $yummy->Movie[$index]->ReleaseDate,
            "MovieStartDate" => $yummy->Movie[$index]->MovieStartDate,
            "MovieEndDate" => $yummy->Movie[$index]->MovieEndDate,
            "MovieType" => $yummy->Movie[$index]->MovieType,
            "MovieStatus" => $yummy->Movie[$index]->MovieStatus,
            "MovieTrailer" => $yummy->Movie[$index]->MovieTrailer,
            "Status" => $yummy->Movie[$index]->Status,
            "Country" => $yummy->Movie[$index]->Country,
            "Remarks" => $yummy->Movie[$index]->Remarks,
            "Banner" => $yummy->Movie[$index]->Banner,
            "BannerSmall" => $yummy->Movie[$index]->BannerSmall,
            "LastUpdate" => $yummy->Movie[$index]->LastUpdate,
            "status_code" => $yummy->Movie[$index]->status_code,
            "index_value" => $index);
        return $array;
    }
    
    public function UpdateMovieStatus($st = 0)
    {

        $secure = new GenerateKeySecret();
        $obj = new configtoapi();
        $movielistparam = $secure->ApiAccessLink();
        $api_link = "https://api.blockbusterbd.net/v4/MovieList.php?username=shahbaz@ticketchai.com&request_id=$movielistparam";
        //$dd = file_get_contents($api_link);
        $movie = $this->Parse($api_link);
        $yummy = json_decode($movie);

        if ($st == 1){
            //include '../../config/config.php';
            $new_index = count($yummy->Movie) - 1;
            if (!empty($new_index)){
                $dd=0;
                for ($i = 0; $i <= $new_index; $i++):
                    //for($i=$new_index; $i>=1; $i--):
                    //$sqlcheck_movie = $obj->FlyQuery("SELECT movie_id,date,status FROM event_movie_list WHERE movie_id='" . $yummy->Movie[$i]->MovieID . "'", "2");
                   // $sqlcheck_movie_rows = $sqlcheck_movie;
                    //if ($sqlcheck_movie_rows == 0) {
                        $obj->FlyQuery("UPDATE event_movie_list SET date='".date('Y-m-d')."',status='".$yummy->Movie[$i]->MovieStatus."',movietype='".$yummy->Movie[$i]->MovieType."' WHERE movie_id='" . $yummy->Movie[$i]->MovieID . "'", "3");
                    //}
                    $dd+=1;
                endfor;
                return $dd;
                
            }
        }
    }

    public function getTheatreName($index, $st = 0) {
        $obj = new configtoapi();
        $secure = new GenerateKeySecret();
        $theaterlistparam = $secure->ApiAccessLink();
        $api_link = "https://api.blockbusterbd.net/v4/TheatreList.php?username=shahbaz@ticketchai.com&request_id=$theaterlistparam";
        //$dd = file_get_contents($api_link);
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);
        $ret_val = 0;
        if ($st == 1):
            //include '../../config/config.php';
            $new_index = count($yummy->TheatreList) - 1;
            if (!empty($new_index)):
                for ($i = 0; $i <= $new_index; $i++):
                    $sqlcheck_movie = $obj->FlyQuery("SELECT * FROM event_movie_theatre WHERE theatre_id='" . $yummy->TheatreList[$i]->TheatreID . "'", "2");
                    if ($sqlcheck_movie == 0) {
                        $checkandinsert = ' SET ';
                        $checkandinsert .="theatre_id='" . $yummy->TheatreList[$i]->TheatreID . "',";
                        $checkandinsert .="name='" . $yummy->TheatreList[$i]->TheatreName . "',";
                        $checkandinsert .="date='" . date('Y-m-d') . "',";
                        $checkandinsert .="status='" . $yummy->TheatreList[$i]->Status . "'";
                        $obj->FlyQuery("INSERT INTO event_movie_theatre " . $checkandinsert, "3");
                        $index = $i;
                        $checkandinsert = '';
                        $ret_val+=1;
                    }
                endfor;
            endif;
        endif;
        return $ret_val;
//        if ($st == 1) {
//            $index = count($yummy->TheatreList) - 1;
//        }
//
//        $array = array("TheatreID" => $yummy->TheatreList[$index]->TheatreID,
//            "TheatreName" => $yummy->TheatreList[$index]->TheatreName,
//            "Remarks" => $yummy->TheatreList[$index]->Remarks,
//            "Status" => $yummy->TheatreList[$index]->Status,
//            "LastUpdate" => $yummy->TheatreList[$index]->LastUpdate,
//            "status_code" => $yummy->TheatreList[$index]->status_code);
//        return $array;
    }

    public function getShowTime($MovieID, $RequestDate) {

        $secure = new GenerateKeySecret();
        $movieinfoparam = $secure->ApiAccessLink(array("MovieID" => $MovieID, "RequestDate" => $RequestDate));
        $api_link = "https://api.blockbusterbd.net/v4/MovieSchedule.php?username=shahbaz@ticketchai.com&request_id=$movieinfoparam";
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);
        
        return $yummy;
        // return $yummy;
//        if (empty($yummy->MovieSchedule->DTMID)) {
//            $array = array("DTMID" => "",
//                "RequestDate" => "",
//                "TheatreName" => "",
//                "MovieID" => "",
//                "MovieName" => "",
//                "Show_01" => "",
//                "Show_02" => "",
//                "Show_03" => "",
//                "Show_04" => "",
//                "Show_05" => "",
//                "TotalShow" => "",
//                "Remarks" => "",
//                "Status" => "",
//                "status_code" => "");
//            return $array;
//        } else {
//            $array = array("DTMID" => $yummy->MovieSchedule->DTMID,
//                "RequestDate" => $yummy->MovieSchedule->RequestDate,
//                "TheatreName" => $yummy->MovieSchedule->TheatreName,
//                "MovieID" => $yummy->MovieSchedule->MovieID,
//                "MovieName" => $yummy->MovieSchedule->MovieName,
//                "Show_01" => $yummy->MovieSchedule->Show_01,
//                "Show_02" => $yummy->MovieSchedule->Show_02,
//                "Show_03" => $yummy->MovieSchedule->Show_03,
//                "Show_04" => $yummy->MovieSchedule->Show_04,
//                "Show_05" => $yummy->MovieSchedule->Show_05,
//                "TotalShow" => $yummy->MovieSchedule->TotalShow,
//                "Remarks" => $yummy->MovieSchedule->Remarks,
//                "Status" => $yummy->MovieSchedule->Status,
//                "status_code" => $yummy->MovieSchedule->status_code);
//            return $array;
//        }
    }

    public function getShowTimeSeatStatus($DTMID, $SLOT) {

        $secure = new GenerateKeySecret();
        $theatreseatstatusinfoparam = $secure->ApiAccessLink(array("DTMID" => $DTMID, "Slot" => $SLOT));
        $api_link = "https://api.blockbusterbd.net/v4/MovieScheduleTheatreSeatStatus.php?username=shahbaz@ticketchai.com&request_id=$theatreseatstatusinfoparam";
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);

        $array = array("DTMSID" => $yummy->MovieScheduleTheatreSeatStatus->DTMSID,
            "DTMID" => $yummy->MovieScheduleTheatreSeatStatus->DTMID,
            "SLOT" => $yummy->MovieScheduleTheatreSeatStatus->SLOT,
            "TheatreID" => $yummy->MovieScheduleTheatreSeatStatus->TheatreID,
            "MovieID" => $yummy->MovieScheduleTheatreSeatStatus->MovieID,
            "RequestDate" => $yummy->MovieScheduleTheatreSeatStatus->RequestDate,
            "ShowTime" => $yummy->MovieScheduleTheatreSeatStatus->ShowTime,
            "SeatClass" => $yummy->MovieScheduleTheatreSeatStatus->SeatClass,
            "SeatClassTicketPrice" => $yummy->MovieScheduleTheatreSeatStatus->SeatClassTicketPrice,
            "Total_E_FRONT_Seat" => $yummy->MovieScheduleTheatreSeatStatus->Total_E_FRONT_Seat,
            "Total_E_REAR_Seat" => $yummy->MovieScheduleTheatreSeatStatus->Total_E_REAR_Seat,
            "Total_Seat" => $yummy->MovieScheduleTheatreSeatStatus->Total_Seat,
            "Total_Processing_Seat" => $yummy->MovieScheduleTheatreSeatStatus->Total_Processing_Seat,
            "E_FRONT_Processing_Seat" => $yummy->MovieScheduleTheatreSeatStatus->E_FRONT_Processing_Seat,
            "E_REAR_Processing_Seat" => $yummy->MovieScheduleTheatreSeatStatus->E_REAR_Processing_Seat,
            "E_FRONT_Sold_Out" => $yummy->MovieScheduleTheatreSeatStatus->E_FRONT_Sold_Out,
            "E_REAR_Sold_Out" => $yummy->MovieScheduleTheatreSeatStatus->E_REAR_Sold_Out,
            "Total_Sold_Out" => $yummy->MovieScheduleTheatreSeatStatus->Total_Sold_Out,
            "E_FRONT_Available_Seat" => $yummy->MovieScheduleTheatreSeatStatus->E_FRONT_Available_Seat,
            "E_REAR_Available_Seat" => $yummy->MovieScheduleTheatreSeatStatus->E_REAR_Available_Seat,
            "Available_Seat" => $yummy->MovieScheduleTheatreSeatStatus->Available_Seat,
            "lastupdate" => $yummy->MovieScheduleTheatreSeatStatus->lastupdate,
            "status_code" => $yummy->MovieScheduleTheatreSeatStatus->status_code);
        return $array;
    }

    public function SecureBookingApi($DTMSID, $SeatClass, $Seat, $CusName, $CusEmail, $CusMobile) {
        $secure = new GenerateKeySecret();
        $booking_param = array("DTMSID" => $DTMSID, "SeatClass" => $SeatClass, "Seat" => $Seat, "CusName" => $CusName, "CusEmail" => $CusEmail, "CusMobile" => $CusMobile);
        $theatreseatstatusinfoparam = $secure->ApiAccessLink($booking_param);
        $api_link = "https://api.blockbusterbd.net/v4/MovieSeatBookingRequest.php?username=shahbaz@ticketchai.com&request_id=$theatreseatstatusinfoparam";
        $theatre = $this->Parse($api_link);
        return $yummy = json_decode($theatre);
//            $array = array("trx_id" => $yummy->trx_id,
//                "lid" => $yummy->lid,
//                "DTMSID" => $yummy->DTMSID,
//                "status" => $yummy->status,
//                "SeatClass" => $yummy->SeatClass,
//                "quantity" => $yummy->quantity,
//                "cost" => $yummy->cost,
//                "seat_numbers" => $yummy->seat_numbers,
//                "request_date" => $yummy->request_date,
//                "expire_time" => $yummy->expire_time,
//                "hold_time" => $yummy->hold_time,
//                "summery" => $yummy->summery,
//                "status_code" => $yummy->status_code);
//        return $array;
    }

    public function SecureBookingConfirm($DTMSID, $LID,$trxid) {
        $secure = new GenerateKeySecret();
        $booking_param = array("DTMSID" => $DTMSID, "LID" => $LID, "ConfirmStatus" => "CONFIRM");
        $theatreseatstatusinfoparam = $secure->ApiAccessLinkConfirm($booking_param,$trxid);
        $api_link = "https://api.blockbusterbd.net/v4/MovieSeatUpdateStatus.php?username=shahbaz@ticketchai.com&request_id=$theatreseatstatusinfoparam";
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);
//        $array = array("trx_id" => $yummy->trx_id,
//            "lid" => $yummy->lid,
//            "DTMSID" => $yummy->DTMSID,
//            "request_date" => $yummy->request_date,
//            "summery" => $yummy->summery,
//            "status" => $yummy->status,
//            "status_code" => $yummy->status_code);
        return $yummy;
    }

    public function SecureBookingCancel($DTMSID, $LID,$trxid) {
        $secure = new GenerateKeySecret();
        $booking_param = array("DTMSID" => $DTMSID, "LID" => $LID, "ConfirmStatus" => "CANCEL");
        $theatreseatstatusinfoparam = $secure->ApiAccessLinkConfirm($booking_param,$trxid);
        $api_link = "https://api.blockbusterbd.net/v4/MovieSeatUpdateStatus.php?username=shahbaz@ticketchai.com&request_id=$theatreseatstatusinfoparam";
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);
//        $array = array("trx_id" => $yummy->trx_id,
//            "lid" => $yummy->lid,
//            "DTMSID" => $yummy->DTMSID,
//            "request_date" => $yummy->request_date,
//            "summery" => $yummy->summery,
//            "status" => $yummy->status,
//            "status_code" => $yummy->status_code);
        return $yummy;
    }

    public function SecureBalanceStatement() {
        $secure = new GenerateKeySecret();
        $theatreseatstatusinfoparam = $secure->ApiAccessLink();
        $api_link = "https://api.blockbusterbd.net/v4/balance.php?username=shahbaz@ticketchai.com&request_id=$theatreseatstatusinfoparam";
        $theatre = $this->Parse($api_link);
        $yummy = json_decode($theatre);
        $array = array("username" => $yummy->username,
            "balance" => $yummy->balance,
            "status" => $yummy->status,
            "request_date" => $yummy->request_date,
            "summery" => $yummy->summery,
            "status_code" => $yummy->status_code,
            "NewTr" => 1453182256);
        return $array;
    }

}
