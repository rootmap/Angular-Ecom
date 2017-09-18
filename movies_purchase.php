<?php
if(!isset($_GET['Mid']))
{
    header('location: movies.php');
    exit();
}
include'DBconnection/database_connections.php';
include './cms/plugin.php';
$cms = new plugin();
include "config/config.php";
include "admin/event/blockbuster_api_class/GenerateSecretKey.php";
$obj = new configtoapi();
$api = new XmlToJson();
@$sDate = $_GET['sdate'];
@$movie_id = $_GET['Mid'];
$DTMSID="";
$showtime="";
$slotplace="";
$slotLoop="";
$theatre="";
if(isset($_GET['MSlot']))
{
    $strspl=explode(",",$_GET['MSlot']);
    $DTMSID=$strspl[0];
    $showtime=$strspl[1];
    $slotplace=$strspl[2];
    $strlpshowpl=explode("_", $slotplace);
    $slotLoop=$strlpshowpl[1];
    $theatre=$strspl[3];
    //print_r($strspl);
    //exit();
}

$theatrequery = '';

$movie_id = $obj->clean($movie_id);
$movie_namesql = $obj->FlyQuery("SELECT a.*,b.event_web_logo as logo,b.event_description as description FROM event_movie_list as a 
    LEFT JOIN `events` as b on b.event_id=a.event_id WHERE a.movie_id='" . $movie_id . "'", "1");




$sqlthe = array();
$sqltheatre = mysqli_query($con, "SELECT theatre_id,name FROM event_movie_theatre");
while ($row = mysqli_fetch_object($sqltheatre)) {
    $sqlthe[] = $row;
}

//$sqlmov = array();
//$sqlmovies = mysqli_query($con, "SELECT a.*,b.event_web_logo as logo FROM event_movie_list as a LEFT JOIN `events` as b on b.event_id=a.event_id");
//while ($row = mysqli_fetch_object($sqlmovies)) {
//    $sqlmov[] = $row;
//}
//getting featured event's venue from database
//debug($resultGetFeatVenue);
//Getting upcoming event data from database
//Getting upcoming event data from database
//converting array of featured event's id into string
//debug($resultGetUpcomingVenue);
//Getting root category from database
$arrRootCat = array();
$arrRootCatID = array();
$strRootCatID = '';
$sqlRootCat = "SELECT category_color,category_id,category_title,category_parent_id,category_priority"
. " FROM categories WHERE category_parent_id=0 ORDER BY category_priority DESC";
$resultRootCat = mysqli_query($con, $sqlRootCat);
if ($resultRootCat) {
    while ($resultRootCatObj = mysqli_fetch_object($resultRootCat)) {
        $arrRootCat[] = $resultRootCatObj;
        $arrRootCatID[] = $resultRootCatObj->category_id;
    }
} else {
    if (DEBUG) {
        $err = "resultRootCat error: " . mysqli_error($con);
    } else {
        $err = "resultRootCat query failed.";
    }
}

$arrayArchived = array();
$sqlArchived = "SELECT event_id,event_title,event_web_logo FROM events WHERE event_status='archived' ORDER BY event_created_on DESC";
$resultArchived = mysqli_query($con, $sqlArchived);
if ($resultArchived) {
    while ($resultArchivedObj = mysqli_fetch_object($resultArchived)) {
        $arrayArchived[] = $resultArchivedObj;
    }
} else {
    if (DEBUG) {
        $err = "resultArchived error: " . mysqli_error($con);
    } else {
        $err = "resultArchived query failed.";
    }
}

$sqlmov = array();
$sqlmovies = mysqli_query($con, "SELECT a.*,b.event_web_logo as logo FROM event_movie_list as a 
    LEFT JOIN `events` as b on b.event_id=a.event_id 
    WHERE a.movie_id='" . mysqli_real_escape_string($con, $_GET['Mid']) . "'");
while ($row = mysqli_fetch_object($sqlmovies)) {
    $sqlmov[] = $row;
}
//print_r($sqlmov);
if (!empty($sqlmov)) {
    $event_id = $sqlmov[0]->event_id;
} else {
    $event_id = 0;
}

/*print_r($sqlmov);

exit();*/

$discount_amount = 0;
$discount_type = 2;
$sqleventdiscount = "SELECT a.id,a.discount_title,a.discount_amount,a.status AS discount_type,a.event_id FROM eventwise_discount as a WHERE a.event_id='" . $event_id . "'";
$querydiscount = mysqli_query($con, $sqleventdiscount);
$chkdiscount = mysqli_num_rows($querydiscount);
if ($chkdiscount == 0) {
    $discount_amount = 0;
    $discount_type = 2;
} else {
    $disarray = array();
    while ($disrow = mysqli_fetch_object($querydiscount)):
        $disarray[] = $disrow;
    endwhile;
    $discount_amount = "";
    $discount_type = "";
    $sd = 1;
    foreach ($disarray as $ds):
        if (count($disarray) == $sd) {
            $discount_amount .=$ds->discount_amount;
            $discount_type .=$ds->discount_type;
        } else {
            $discount_amount .=$ds->discount_amount . ",";
            $discount_type .=$ds->discount_type . ",";
        }
        $sd++;
        endforeach;
    }
//eventwise discount end
//print_r($movie_namesql);

    $movie_tr="";
    $sqlperse="SELECT id,SUBSTRING_INDEX(trailer, '=', -1) as dtr FROM `event_movie_list` WHERE movie_id='".$_GET['Mid']."'";
    $sqlgetMovie=$obj->FlyQuery($sqlperse,"1");
    if(isset($sqlgetMovie[0]->dtr))
    {
        //$dd=mysqli_fetch_array($sqlgetMovie);
        $movie_tr=$sqlgetMovie[0]->dtr;
        //echo $dd['movie_id'];
    }

    extract($_GET);




    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("movies_purchase | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("moviesPurchase"));
        ?>
        <link rel="stylesheet" href="tc-merchant-template/plugins/simply-toast-master/simply-toast.min.css"/>

    </head>

    <body ng-init="loadMovieDetail('<?=$_GET['Mid']?>')" 
        <?php if(isset($_GET['MSlot'])){
            ?>
            onload="getseat('<?=$DTMSID?>', '<?=$slotLoop?>', '<?=$showtime?>', '<?=$theatre?>')" 
            <?php
        } ?>

        class="index-page signin" ng-app="frontEnd" ng-controller="movies_purchaseController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->

        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; 
        

        ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main"   style="background-color: transparent; margin-top: 70px;">
                <!-- Carousel Starts Here -->
                <div id="imageShowCase" class="owl-carousel">
                    <div class="item">
                        <img ng-src="{{banner}}" alt="1" class="banner-img img-fluid img-responsive" style="opacity: 0.7;" />
                        <div class="carousel-item-overlay hidden-xs">
                            <?php 
                            if(!empty($movie_tr) && $movie_tr!="Not-Available")
                            {
                                ?>
                                <a href="#" name="<?=$movie_tr?>" id="play-button" data-toggle="modal" data-target="#myModal" class="dtplay"></a>
                                <?php
                            }
                            ?>
                            
                            <a href="#!" class="movie-thumb">
                                <img class="ch-image-reflect img-thumbnail"  ng-src="{{thumb}}"/>
                            </a>
                            <div class="ci-overlay-bottom">
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">
                                    <h1 title="21st" id="eventTitle" class="bold movie_title padding_top10"><i class="fa fa-film" aria-hidden="true">&nbsp;</i> {{MovieDetail.name}}</h1>
                                    <p class="text-white text-capitalize bold"> <i class="fa fa-language" aria-hidden="true"></i>&nbsp; Hindi / English / Bangla </p>
                                    <button type="button" class="btn success-rounded-outline btn-sm btn-round waves-effect movie_genre_btn">Horror</button>
                                    <button type="button" class="btn success-rounded-outline btn-sm btn-round waves-effect movie_genre_btn">Romance</button>
                                    <br/>
                                    <span class="margin5 text-white text-capitalize bold"><i aria-hidden="true" class="fa fa-calendar">&nbsp;</i> {{MovieDetail.startdate}}</span>
                                    <span class="margin5 text-white text-capitalize bold"><i aria-hidden="true" class="fa fa-clock-o">&nbsp;</i> 11:30AM</span>
                                </div>
                                <div class="col-md-4 text-left">
                                    <h6 class="text-left text-white bold">DIRECTOR: </h6>
                                    <p class="text-left text-white">{{MovieDetail.movietype}}</p>
                                    <h6 class="text-left text-white bold">CAST: </h6>
                                    <p class="text-left text-white">No Mention </p>
                                </div>
                                <div class="col-md-2 text-right">
                                    <div class="social-share">
                                        <button class="btn btn-fab btn-fab-mini btn-round btn-facebook">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-fab btn-fab-mini btn-round btn-twitter">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-fab btn-fab-mini btn-round btn-google">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Core -->
                <!-- Modal -->
                <div class="modal modal-fullscreen fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <!--Content-->
                        <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header text-right">
                                <button type="button" class="btn btn-fab" data-dismiss="modal">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body">
                                <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
                                <div id="player"></div>

                                <!-- The Play-Link will appear in that div after the video was loaded -->
                                <?php 
                                if(!empty($movie_tr))
                                {
                                    ?>
                                    <div id="play"></div>
                                    <?php } ?>


                                    <!--<iframe id="video" width="100%" height="500px" src="https://www.youtube.com/embed/uvi6WZKHCJ0?rel=0" frameborder="0" allowfullscreen></iframe>-->
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">


                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!-- /.Live preview-->
                    <!-- ./Modal Core -->
                    <!-- Carousel Ends Here -->
                    <div class="clearfix"></div>
                    <!-- Movie Ticket Purchase section starts here -->
                    <div class="section-simple2">
                        <div class="container-fluid">
                            <div class="row section_padd30">

                                <!-- ./Here Ends Custom Movie Information Only Visible At Extra Small Devices-->
                                <!-- Here goes custom Html from movie ticket purchase page -->
                                <div id="movie-detail-tp" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- left part starts here -->
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="panel panel-default panel-movies">
                                            <div class="panel-heading">
                                                <h1 class="panel-name h1-responsive">{{movieHeading}}<strong>{{movieHeading_span}}</strong></h1>
                                            </div>




                                            <div class="panel-body">
                                                <h4 class="panel-title h4-responsive padding-10">{{booking_tickets}}</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-5 col-sm-12">
                                                                <h4 class="currnt-rqt pull-left"><b>{{request_date}}</b> <br/><b class="text-success pull-left h4-responsive">
                                                                    <?php
                                                                    $date = date('Y-m-d');
                                                                    $a = 1;

                                                                    if (isset($sDate)) {
                                                                        $chkdate = clean($sDate);
                                                                    }
                                                                    elseif(isset($MDate)){
                                                                        $chkdate = clean($MDate);
                                                                    } 
                                                                    else {
                                                                        $chkdate = $date;
                                                                    }
                                                                    echo date('D jS F Y',strtotime($chkdate));
                                                                    ?>
                                                                </b> </h4>
                                                            </div>
                                                            <div class="col-md-7 col-sm-12">
                                                                <h4 class="text-left"> <b>{{select_date}}</b> </h4>
                                                                <div class="padding_bottom10">
                                                                    <?php
                                                                    $theatrequery = $api->getShowTime($_GET['Mid'], $chkdate);

                                                                    for ($i = 0; $i <= 6; $i++):
                                                                        $datef = date("d M", strtotime("+" . $i . " day", strtotime($date)));
                                                                    $datet = date("Y-m-d", strtotime("+" . $i . " day", strtotime($date)));

                                                                    if ($chkdate == $datet) {
                                                                        ?>
                                                                        <a class="btn btn-success btn-fab btn-round bold" style=" padding: 22px 0 0 !important;" href="<?php echo $cms->LbaseUrl(); ?>movies_purchase.php?Mid=<?php echo $_GET['Mid']; ?>&sdate=<?php echo $datet; ?>" ng-click><?php echo $datef; ?></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a class="btn btn-danger btn-fab btn-round bold" style=" padding: 22px 0 0 !important;" href="<?php echo $cms->LbaseUrl(); ?>movies_purchase.php?Mid=<?php echo $_GET['Mid']; ?>&sdate=<?php echo $datet; ?>"><?php echo $datef; ?></a>
                                                                        <?php
                                                                    }
                                                                    $a++;
                                                                    endfor;
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item table-responsive">
                                                        <div class="col-sm-12 eventlist-desc-box" id="step_2_1">
                                                            <div class="eventlist-details">



                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item table-responsive">
                                                        <div class="col-sm-12 eventlist-desc-box" id="step_2_1">
                                                            <div class="eventlist-details">



                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 eventlist-desc-box" style="display: none;" id="step_2_2">

                                                        </div>
                                                    </li>
                                                    <li class="list-group-item table-responsive" id="step_1">









                                                        <?php

                                                        function CheckShowTimeExists($sunrise) {
                                                            $current_time = date('Y-m-d h:i a');
                                                            $date1 = DateTime::createFromFormat('Y-m-d H:i a', $current_time);
                                                            $date2 = DateTime::createFromFormat('Y-m-d H:i a', $sunrise);
                                                            if ($date1 < $date2) {
                                                                return 1;
                                                            }
                                                        }

                                                        if (isset($theatrequery->MovieSchedule->StatusResult)) {
                                                            if (!isset($theatrequery->MovieSchedule->DTMID)) {
                                                                ?>
                                                                <h4 class="page-header"><span class="text-danger">No Show Time Found,</span><br> <span class="text-success">Please Select Another Date</span></h4>
                                                                <?php
                                                            } else {

                                                                ?>
                                                                <table class="table table-bordered seat-tbl">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="4">
                                                                            <b class="text-info">{{tbl_H2}}</b> : 
                                                                            <?php echo $theatrequery->MovieSchedule->TheatreName; ?></th>
                                                                        </tr>
                                                                        <tr class="bg-primary">
                                                                            <th class="text-center">{{tbl_H1}}</th>
                                                                            <th class="text-center">{{tbl_H3}}</th>
                                                                            <th class="text-center">{{tbl_H4}}</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                        if(isset($theatrequery->MovieSchedule->TotalShow) && !empty($theatrequery->MovieSchedule->TotalShow))
                                                                        {
                                                                            $totalshow=$theatrequery->MovieSchedule->TotalShow;
                                                                            for($i=1; $i<=9; $i++):
                                                                                $dd='Show_0'.$i;
                                                                            if(isset($theatrequery->MovieSchedule->$dd))
                                                                            {
                                                                                //if($theatrequery->MovieSchedule->$dd!="No-Show")
                                                                                //{


                                                                                    if (CheckShowTimeExists($chkdate." ".$theatrequery->MovieSchedule->$dd) == 1) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <th><?php echo $i; ?></th>

                                                                                            <th valign="middle" style="text-align:center; font-size:17px;" class="text-info"><?php echo $theatrequery->MovieSchedule->$dd; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px;">
                                                                                                <button class="btn success-rounded-outline waves-effect btn-tkt-tbl" onclick="getseat('<?php echo $theatrequery->MovieSchedule->DTMID; ?>', '<?php echo '0' . $i; ?>', '<?php echo $theatrequery->MovieSchedule->$dd; ?>', '<?php echo $theatrequery->MovieSchedule->TheatreName; ?>')" type="button" class="btn btn-success">Get Ticket</button>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <th><?php echo $i; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px; color: #cccbd0;"><?php echo $theatrequery->MovieSchedule->$dd; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px;" class="text-danger">
                                                                                                Expired
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }

                                                                                //}
                                                                            }
                                                                            endfor;    
                                                                        }

                                                                        ?>

                                                                    </tbody>
                                                                </table>
                                                                <?php
                                                            }
                                                        } else {
                                                            if(count($theatrequery->MovieSchedule)!=0)
                                                            {
                                                                foreach ($theatrequery->MovieSchedule as $movAR) {

                                                                    //loop schedule started
                                                                                ?>
                                                                                <table class="table table-bordered seat-tbl">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th colspan="4">
                                                                                            <b class="text-info">{{tbl_H2}}</b> : 
                                                                                            <?php echo $movAR->TheatreName; ?></th>
                                                                                        </tr>
                                                                                        <tr class="bg-primary">
                                                                                            <th class="text-center">{{tbl_H1}}</th>
                                                                                            <th class="text-center">{{tbl_H3}}</th>
                                                                                            <th class="text-center">{{tbl_H4}}</th>

                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                <?php

                                                                                for($i=1; $i<=9; $i++):
                                                                                $dd='Show_0'.$i;
                                                                            if(isset($movAR->$dd))
                                                                            {
                                                                                    if (CheckShowTimeExists($chkdate." ".$movAR->$dd) == 1) {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <th><?php echo $i; ?></th>

                                                                                            <th valign="middle" style="text-align:center; font-size:17px;" class="text-info"><?php echo $movAR->$dd; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px;">
                                                                                                <button class="btn success-rounded-outline waves-effect btn-tkt-tbl" onclick="getseat('<?php echo $movAR->DTMID; ?>', '<?php echo '0' . $i; ?>', '<?php echo $movAR->$dd; ?>', '<?php echo $movAR->TheatreName; ?>')" type="button" class="btn btn-success">Get Ticket</button>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <tr>
                                                                                            <th><?php echo $i; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px; color: #cccbd0;"><?php echo $movAR->$dd; ?></th>
                                                                                            <th valign="middle" style="text-align:center; font-size:17px;" class="text-danger">
                                                                                                Expired
                                                                                            </th>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }

                                                                                     }
                                                                            endfor;    


                                                                        ?>

                                                                    </tbody>
                                                                </table>
                                                                <?php
                                                                    //loop schedule ended
                                                                }
                                                            }
                                                        }
                                                    ?>  
                                                </li>
                                                <li class="list-group-item table-responsive ">
                                                    <div class="category-list" id="step_5" style="display: none;">
                                                        <div class="tab-box ">

                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs list-tabs movie-tabs" role="tablist">
                                                                <li id="events_step_2_1" style="display: none;" class="events1"><a  href="#allMov_1_1" id="allMov_1" role="tab" data-toggle="tab">Please Wait...</a></li>
                                                                <li id="events_step_2_2" style="display: none;" class="events1"><a  href="#allMov_2_2" id="allMov_2" role="tab" data-toggle="tab">Please Wait...</a></li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="allMov_1_1">

                                                                    <div class="adds-wrapper">
                                                                        <div class="item-list">
                                                                            <!--/.photobox-->
                                                                            <div class="col-sm-12 eventlist-desc-box" id="step_2_1">
                                                                                <div class="eventlist-details">



                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 eventlist-desc-box" style="display: none;" id="step_2_2">

                                                                            </div>

                                                                            <!--/.eventlist-desc-box-->

                                                                            <!--/.eventlist-desc-box-->
                                                                        </div>






                                                                    </div>
                                                                    <!--/.adds-wrapper-->
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--/.tab-box-->

                                                    </div>

                                                    <div class="category-list" id="step_3" style="display: none;">
                                                        <div class="tab-box ">
                                                            <h3 class="text-center bold">Hall Layout</h3>

                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs list-tabs movie-tabs" role="tablist">
                                                                <!--<li class="events1 active"><a  href="#allMov" role="tab" data-toggle="tab" id="step_3_1_title">Hall Layout</a></li>-->

                                                            </ul>
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="allMov">

                                                                    <div class="adds-wrapper">
                                                                        <div class="item-list">
                                                                            <!--/.photobox-->
                                                                            <div class="col-sm-12 eventlist-desc-box" id="step_3_1">
                                                                                <!-- hall layout start-->

















                                                                                <!-- hall layout end-->  







                                                                            </div>
                                                                            <!--/.eventlist-desc-box-->
                                                                        </div>






                                                                    </div>
                                                                    <!--/.adds-wrapper-->
                                                                </div>



                                                            </div>

                                                        </div>
                                                        <!--/.tab-box-->






                                                    </div>

                                                </li>
                                            </ul>

                                        </div>
                                        <div class="panel-footer text-center">
                                            <a href="movies.php" class="btn btn-sm pf-btn waves-effect"><i class="fa fa-arrow-circle-o-left" aria-hidden="true">&nbsp;</i> {{backTo_moviePage}}</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./left part ends here -->
                                <!-- right part starts here -->
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div id="movie_cart">
                                        <div class="panel panel-ticket">
                                            <div id="headingTwo" role="tab" class="panel-heading bg-success">
                                                <h1 class="panel-name h1-responsive">
                                                    {{ticket_details}} <strong>{{ticket_detailsSpan}}</strong>
                                                </h1>
                                            </div>
                                            <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse in" id="collapseTwo">
                                                <div class="panel-body">
                                                    <!--<h4 class="panel-title h4-responsive padding-10">{{ticket_detailsText}}</h4>-->

                                                    <?php
                                                    if ($movie_namesql[0]->status == 1) {
                                                        ?>

                                                        <table class="table table-movie-rate">

                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="fa fa-arrow-circle-o-right"></i></td>
                                                                    <td>Movie </td>
                                                                    <td id="s_movie_name"><?php echo $movie_namesql[0]->name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-arrow-circle-o-right"></i></td>
                                                                    <td>Theatre </td>
                                                                    <td id="s_theatre_name">Not Mention Yet.</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-arrow-circle-o-right"></i></td>
                                                                    <td>Show Date</td>
                                                                    <td><?php echo $chkdate; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-arrow-circle-o-right"></i></td>
                                                                    <td>Show Time</td>
                                                                    <td id="s_show_time">00:00 </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table class="table table-movie-rate">

                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="fa fa-ticket"></i></td>
                                                                    <td>Ticket Type</td>
                                                                    <td id="s_ticket_type">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-ticket"></i></td>
                                                                    <td>Ticket Price</td>
                                                                    <td id="s_ticket_price">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-ticket"></i></td>
                                                                    <td>Quantity</td>
                                                                    <td id="s_ticket_quantity">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-ticket"></i></td>
                                                                    <td>Ticket Amount</td>
                                                                    <td id="s_ticket_total_amount">0.00</td>
                                                                </tr>
                                                                <?php
                                                                $costarray = array();
                                                                $cost_total_extra = 0;
                                                                $sqlextracost = "SELECT id,cost_title,cost_amount,deduction_type FROM event_ticket_extra_cost WHERE event_id='" . $movie_namesql[0]->event_id . "'";
                                                                $querycost = mysqli_query($con, $sqlextracost);
                                                                $chkcost = mysqli_num_rows($querycost);
                                                                // echo $costdata = mysqli_fetch_object($querycost);
                                                                if ($chkcost != 0) {
                                                                    while ($costdata = mysqli_fetch_object($querycost)):
                                                                        $costarray[] = $costdata;
                                                                    endwhile;
                                                                }
                                                                //
                                                                $cost_amount_array = array();
                                                                $cost_deduct_array = array();
                                                                if (count($costarray) > 0) {

                                                                    foreach ($costarray as $cost):
                                                                        ?>
                                                                    <tr class="hidecost" style="display: none;">
                                                                        <td><i class="fa fa-ticket"></i></td>
                                                                        <td ><?php echo $cost->cost_title; ?></td>
                                                                        <td><?php
                                                                            if ($cost->deduction_type == 2) {
                                                                                echo $cost->cost_amount . "%";
                                                                            } else {
                                                                                echo $cost->cost_amount;
                                                                            }
                                                                            ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $cost_amount_array[] = $cost->cost_amount;
                                                                        $cost_deduct_array[] = $cost->deduction_type;
                                                                        $cost_total_extra+=$cost->cost_amount;
                                                                        endforeach;
                                                                        ?>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <span class="hidecost"></span>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <input type="hidden" id="cost_amount_array" value="<?php
                                                                    if (count($cost_amount_array) > 0) {
                                                                        $d = 1;
                                                                        foreach ($cost_amount_array as $cma) {
                                                                            if (count($cost_amount_array) == $d) {
                                                                                echo $cma;
                                                                            } else {
                                                                                echo $cma . ",";
                                                                            }
                                                                            $d++;
                                                                        }
                                                                    }
                                                                    ?>">
                                                                    <input type="hidden" id="cost_deduct_array" value="<?php
                                                                    if (count($cost_deduct_array) > 0) {
                                                                        $e = 1;
                                                                        foreach ($cost_deduct_array as $cda) {
                                                                            if (count($cost_deduct_array) == $e) {
                                                                                echo $cda;
                                                                            } else {
                                                                                echo $cda . ",";
                                                                            }
                                                                            $e++;
                                                                        }
                                                                    }
                                                                    ?>">
                                                                    <input type="hidden" id="hidden_cost_total" value="0">
                                                                    <tr class="hidecost_city_delivery" style="display: none;">
                                                                        <td><i class="fa fa-ticket"></i></td>
                                                                        <td>Delivery Charge</td>
                                                                        <td id="delivery_cost">0.00</td>
                                                                    </tr>    



                                                                    <input type="hidden" id="discount_amount" value="<?php echo $discount_amount; ?>">
                                                                    <input type="hidden" id="discount_type" value="<?php echo $discount_type; ?>">
                                                                    <?php
                                                                    if ($chkdiscount != 0) {
                                                                        foreach ($disarray as $ds):
                                                                            ?>
                                                                        <tr class="hidediscount_bar">
                                                                            <td><i class="fa fa-ticket"></i></td>
                                                                            <td><?php echo $ds->discount_title; ?></td>
                                                                            <td class="disto" id="discount_total_<?php echo $ds->id; ?>">0.00</td>
                                                                        </tr> 
                                                                        <?php
                                                                        endforeach;
                                                                    }
                                                                    ?>
                                                                    <tr  id="s_total_amount_row">
                                                                        <td colspan="2">Total Amount : </td>
                                                                        <td id="s_total_amount">0.00</td>
                                                                    </tr>
                                                                    <input type="hidden" id="total_invoice" value="<?php echo $cost_total_extra; ?>">
                                                                </tbody>
                                                            </table>

                                                            <table class="table table-movie-rate">

                                                                <tbody>
                                                                    <tr>
                                                                        <td><i class="fa fa-bed"></i></td>
                                                                        <td><a href="">Seat Number</a> </td>

                                                                        <td><a href=""><i class="fa fa-ticket"></i> <span id="s_seat_no">0,0</span></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><i class="fa fa-arrow-circle-down"></i></td>
                                                                        <td><a href="">Seat Hold Time</a> </td>

                                                                        <td><a href=""><i class="fa fa-clock-o"></i> 20 Min </a></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>


                                                        </div>
                                                        <?php
                                                    } else {
                                                        $sqlmov = array();
                                                        $sqlmovies = mysqli_query($con, "SELECT a.*,b.event_web_logo as logo FROM event_movie_list as a 
                                                            LEFT JOIN `events` as b on b.event_id=a.event_id 
                                                            WHERE '" . date('Y-m-d') . "' between a.moviestartdate AND a.movieenddate");
                                                        $chkmoviesshow = mysqli_num_rows($sqlmovies);
                                                        if ($chkmoviesshow != 0) {
                                                            while ($row = mysqli_fetch_object($sqlmovies)) {
                                                                $sqlmov[] = $row;
                                                            }
                                                        }

                                                    //echo var_dump($sqlmov);
                                                        ?>
                                                        <div class="col-md-4 right-siderbar">
                                                            <style type="text/css">
                                                                .owl-pagination{ margin-top:35px; }
                                                            </style>
                                                            <div class="offer-promotion">

                                                                <div id="offer-promo-slider" class="owl-carousel owl-theme">
                                                                    <?php foreach ($sqlmov AS $Featured): ?>
                                                                        <div class="op-item">
                                                                            <div class="offer-promo-title">
                                                                                <h4><?php echo $Featured->name; ?></h4>
                                                                            </div>
                                                                            <img class="img-responsive" src="<?php echo baseUrl(); ?>upload/event_web_logo/<?php echo $Featured->logo; ?>" alt="img">
                                                                            <div class="offer-promo-footer">
                                                                                <div>
                                                                                    <a href="<?php echo baseUrl(); ?>purchase_movie_ticket.php?id=<?php echo $Featured->movie_id; ?>"><h4>Purchase Now</h4></a>
                                                                                </div>
                                                                                <div class="text-right">
                                                                                    <h5>On Blockbuster Cinemas</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>

                                                                </div>

                                                            </div>
                                                        </div>    
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- ./right part ends here -->
                            </div>
                            <!-- ./Here goes custom Html from movie ticket purchase page -->
                        </div>
                    </div>
                </div>

                <!-- Movie Ticket Purchase section ends here -->
                <div class="clearfix"></div>
                <!-- ticketchai simple section starts here -->
                <div class="section section-simple-close">
                    <div class="container">
                        <div class="row section_padd60">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                        </div>
                    </div>
                </div>
                <!-- ticketchai simple section ends here -->
            </div>
            <!-- main content part ends here -->
            <span ng-init="getShowtime('<?php echo $movie_id; ?>', '<?php echo $chkdate; ?>')"
                <?php include 'include/footer.php'; ?>

            </div>



            <?php echo $cms->fotterJs(array('movies_purchase')); ?>
            <?php echo $cms->angularJs(array('mPurchase_angular')); ?>
            <script src="./tc-merchant-template/plugins/simply-toast-master/simply-toast.min.js"></script>


            <script>
            // alert("fdg");
            new WOW().init();
            $('.selectpicker').selectpicker();
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#imageShowCase").mouseenter(function () {
                    $('#ts-prev').addClass('active-ps-nav');
                    $('#ts-next').addClass('active-ps-nav');
                }).mouseleave(function () {
                    $('#ts-prev').removeClass('active-ps-nav');
                    $('#ts-next').removeClass('active-ps-nav');
                });
            /*$('.hidden-buttons').hide();
             $(".movie").mouseenter(function () {
             $('.hidden-buttons').show();
             }).mouseleave(function () {
             $('.hidden-buttons').hide();
         });*/
            // the body of this function is in assets/material-kit.js
            //materialKit.initSliders();
            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

            window_width = $(window).width();

            if (window_width >= 768) {
                big_image = $('.wrapper > .header');

                $(window).on('scroll', materialKitDemo.checkScrollForParallax);
            }

        });
    </script>
    <script>
        $(document).ready(function (e) {
            $('a.tplay').on('click', function () {
                player.playVideo();
                $('.navbar-fixed-top').hide();
            });

            $('#myModal').on('click', function () {
                player.stopVideo();
                $('.navbar-fixed-top').show();
                location.reload();
            });

        });
    </script>
    
    <script>
        $(document).ready(function (n) {
            $('a.tplay').click(function () {
                var ytvidid = $(this).attr("name");
                //alert(ytvidid);
            });
        });
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '500',
                width: '100%',
                videoId: '<?=$movie_tr?>',
                events: {
                    'onClick': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });



        }

        // 4. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            event.target.playVideo();
        }



        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                //stopVideo;
                //setTimeout(stopVideo, 6000);
                done = true;
            }
        }

        function stopVideo() {
            player.stopVideo();
        }
    </script>
    <script>
        $(document).on('ready', function () {
            $('.crosscover').crosscover({
                dotsNav: false
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#subscription').hide();
            setTimeout(function (a) {
                $('#subscription').slideDown(1000);
            }, 15000);
            setTimeout(function (b) {
                $('#subscription').slideUp(3000);
            }, 30000);
            $('#btn-sclose').click(function () {
                $('#subscription').slideUp(1000);
            });

            $('#nav-search-btn').click(function () {
                $('#nav-search-field').show();
                $('#nav-search-btn').hide();
            });
            $('#nav-search-close').click(function () {
                $('#nav-search-field').hide();
                $('#rslt-div').hide();
                $('#nav-search-btn').show();
                $('#searchInput').val('');
            });
        });

        setTimeout(function () {
            $('#odometer1').html('50');
            $('#odometer2').html('100');
            $('#odometer3').html('200');
            $('#odometer4').html('10000');
        }, 1000);

    </script>
    <!--  Select Picker Plugin -->
    <!--searchbar script-->
    <script>
        $(document).ready(function () {

            $('.control').keyup(function () {

                // If value is not empty
                if ($(this).val().length == 0) {
                    // Hide the element
                    $('.show_hide').hide();
                } else {
                    // Otherwise show it
                    $('.show_hide').show();
                }
            }).keyup();
        });</script>
        <!--searchbar script-->

        <script type="text/javascript">

            function getseat(param1, param2, param3, param4)
            {
            //alert("fdg");
            var movie_id = '<?php echo $_GET['Mid']; ?>';
            var request_date = '<?php echo $chkdate; ?>';
            var dtmid = param1;
            var loader = '<img src="<?php echo $cms->LbaseUrl(); ?>favicon/loading.gif">';
            var dtmid = param1;
            var movie_name = '<?php echo $movie_namesql[0]->name; ?>';
            var theatre = param4;
            $("#s_theatre_name").html(param4);
            $("#s_show_time").html(param3);
            $("#step_1").hide('slow');
            $("#step_2").show('slow');
            $('#events_step_2_1').show('slow');
            $('#events_step_2_1').addClass('active');
            $("#step_2_1").html(loader);
            $.post("<?php echo $cms->LbaseUrl(); ?>ajax/movie_1.php", {'st': 2, 'dtmid': dtmid, 'slot': param2, 'movie_id': movie_id, 'movie_name': movie_name, 'request_date': request_date, 'theatre': theatre, 'slot_time': param3}, function (data) {
                $('#allMov_1').html('Please Select A Seat Type.');
                $("#step_2_1").html(data);
            });

        }

    </script>
</body>

</html>