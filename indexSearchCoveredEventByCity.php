<?php
include './cms/plugin.php';
$cms = new plugin();
?>



<div class="section section-featured">
    <div class="container">
        <div class="row section_padd60 ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                <h2><span class="section-topic">{{covered}}</span> {{events}}</h2>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" >

                <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="cx in c| limitTo:4">
                    <div class="card hm-zoom">

                        <!--Card image-->
                        <div class="view overlay hm-white-slight">
                            <img src="upload/event_web_logo/{{cx.event_web_logo}}" class="img-fluid mdbc-img" alt="">
                            <a>
                                <div class="mask"></div>
                            </a>
                        </div>
                        <!--/.Card image-->
                        <!--Social buttons-->
                        <div class="card-share">
                            <div class="social-reveal">
                                <!--Facebook-->
                                <a href="javascript:void(0);" class="btn-floating btn-fb"><i class="fa fa-facebook"></i></a>
                                <!--Twitter-->
                                <a href="javascript:void(0);" class="btn-floating btn-tw"><i class="fa fa-twitter"></i></a>
                                <!--Google -->
                                <a href="javascript:void(0);" class="btn-floating btn-gplus"><i class="fa fa-google-plus"></i></a>
                            </div>
                            <a class="btn-floating btn-action share-toggle primary-color-dark"><i class="fa fa-share-alt"></i></a>
                        </div>
                        <!--/Social buttons-->

                        <!--Card content-->
                        <div class="content" style="height:200px;">
                            <h6 class="title bold"><a href="#">{{cx.event_title| limitTo : 100}}</a> 
                                <span class="category-label badge badge-primary">{{cx.event_type_tag}}</span></h6>
                            <hr>
                            <a href="event_tickets.php?c_id={{cx.event_id}}" class="btn success-rounded-outline btn-block waves-effect">Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true">&nbsp;</i></a>
                        </div>
                        <!--/.Card content-->

                    </div>
                    <!--/.Card-->
                </div>
                <!-- single card end -->

            </div>

            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                <a href="more_covered_events.php"><button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button></a>
            </div>

        </div>
    </div>
</div>