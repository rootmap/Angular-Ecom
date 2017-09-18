<?php
include './cms/plugin.php';
$cms = new plugin();
?>

<div class="section section-featured" id="cityFeature">
    <div class="container">
        <div class="row section_padd60 ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                <h2><span class="section-topic">{{featured}}</span> {{events}}</h2>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="fx in d| limitTo : 8 ">
                    <div class="card">
                        <div class="header">
                            <img class="ch-image" src="upload/event_web_logo/{{fx.event_web_logo}}" />
                            <div class="filter"></div>
                            <div class="category">
                                <span class="category-label label label-info">{{fx.event_type_tag}}</span>
                            </div>

                            <div class="actions">
                                <a href="event_tickets.php?id={{fx.event_id}}" class="btn btn-success btn-raised btn-round">
                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                </a>
                            </div>

                            <div class="social-line" data-buttons="3">
                                <button class="btn btn-social btn-facebook">
                                    <i class="fa fa-facebook-square">&nbsp;</i>{{btn_fb}}
                                </button>
                                <button class="btn btn-social btn-twitter">
                                    <i class="fa fa-twitter-square">&nbsp;</i>{{btn_tw}}
                                </button>
                                <button class="btn btn-social btn-google">
                                    <i class="fa fa-google-plus-square">&nbsp;</i>{{btn_g}}
                                </button>
                            </div>
                        </div>   

                        <div class="content" style="height: 200px !important;">
                            <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="#">{{fx.event_title.length > '25' ? (fx.event_title | limitTo:20) + '..' : fx.event_title}}</a></h6>
                            <hr>
                            <p class="description">
                                <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{fx.venue_title}}</span>
                            </p>
                            <p class="description">
                                <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{fx.venue_start_date}} - {{fx.venue_end_date}}</span>
                            </p>
                            <p class="description">
                                <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{fx.venue_start_time}} - {{fx.venue_end_time}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                <a href="more_featured_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
            </div>
        </div>
    </div>
</div>