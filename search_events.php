<?php //
include './cms/plugin.php';
$cms = new plugin();

?>
                   
                   <div class="container">
                            <div class="row section_padd20 ">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >
                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in searchResult">
                                        <div class="card" >
                                            <div class="header">
                                                <img alt="Sorry  Logo missing" class="ch-image" src="upload/event_web_logo/{{x.event_web_logo}}" />
                                                <!--<div class="filter"></div>-->
                                                <div class="category">
                                                    <span class="category-label label label-info">{{x.event_type_tag}}</span>
                                                </div>

                                                <div class="actions">
                                                    <a href="checkout1.php?id={{x.event_id}}" class="btn btn-success btn-raised btn-round">
                                                        <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{x.btn_name}}
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
                                                <h6 class="title bold" style="font-size:12px !important;"><a class="glow2" href="checkout1.php?id={{x.event_id}}">{{x.event_title.length > '50' ? (x.event_title | limitTo:30) + ' ...' : x.event_title}}</a></h6>
                                                <hr>
                                                <p class="description">   
                                                    <span class="margin5 text-danger bold"><i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i> {{x.venue_title}}</span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-primary bold"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.venue_start_date}} - {{x.venue_end_date}}</span>
                                                </p>
                                                <p class="description">
                                                    <span class="margin5 text-warning bold"><i class="fa fa-clock-o" aria-hidden="true">&nbsp;</i> {{x.venue_start_time}} - {{x.venue_end_time}}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- single card end -->

                                </div>
                                
                            </div>
                        </div>




