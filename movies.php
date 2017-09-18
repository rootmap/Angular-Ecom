<?php
include './cms/plugin.php';
$cms = new plugin();
?>
<!doctype html>
<html lang="en" ng-app="frontEnd">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("Movies | Ticket Chai");
        ?>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <?php
        echo $cms->headCss(array("movies"));
        ?>
        <style type="text/css">
            .filter-select{
                background-image: none !important;
                background-color: transparent !important;
                border: 2px solid #FFF !important;
                color: #FFF !important;
            }
            .filter-select>option{
                color:black;
            }
            .form-group{padding-bottom:7px;margin:11px 0 0 0 !important;}
            .btn-nav-search {
                background-color: transparent !important;
                border: 2px solid #ffffff !important;
                color: #ffffff !important;
                height: 37px !important;
                width: 100%;
                min-width: 210px;
                margin-top: 10px !important;
                border-radius: 0px !important;
            }
        </style>
    </head>

    <body  class="index-page signin"  ng-controller="moviesController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <?php echo $cms->FbSocialScript(); ?>
        <?php include 'include/navbar.php'; ?>

        <div class="clearfix"></div>
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; margin-top:70px;">
                <!-- Carousel Starts Here -->
                <div id="imageShowCase" class="owl-carousel">
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/web-showcase_tmrw_movie-page.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#" name="uvi6WZKHCJ0" id="play-button" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/star-trek_web-showcase_now.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#" name="uvi6WZKHCJ0" id="play-button" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/rmadaari-in-cinemas-now_1280x500.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#!" name="eX_iASz1Si8" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/jungle-book-poster-triptych.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#!" name="xN2g9Coc2nk" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/bamoms-bmhp.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#!" name="xN2g9Coc2nk" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                    <div class="item">
                        <img src="<?php echo $cms->baseUrl('assets/img/movies/web_showcase_july-29.jpg'); ?>" alt="1" class="banner-img img-fluid img-responsive" />
                        <a href="#!" name="xN2g9Coc2nk" data-toggle="modal" data-target="#myModal" class="tplay"></a>
                    </div>
                </div>
                <div class="owl-controls">
                    <a id="ts-next" class="ps-nav hidden-xs"> <img src="<?php echo $cms->baseUrl('assets/img/arrow-right.png'); ?>" alt="N E X T"> </a>
                    <a id="ts-prev" class="ps-nav hidden-xs"> <img src="<?php echo $cms->baseUrl('assets/img/arrow-left.png'); ?>" alt="P R E V"></a>
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
                                <div id="play"></div>



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
                <!-- Search Navigation Starts Here -->
                <nav class="navbar navbar-success" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search-nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand bold h4-responsive visible-xs text-cente" href="#"><i class="fa fa-ticket" aria-hidden="true">&nbsp;</i> {{buy_eventTickets}}</a>
                        </div>
                        <style type="text/css">
	                        select option:empty { display:none }
	                    </style>

                        <div class="collapse navbar-collapse" id="search-nav">
                            <ul class="nav navbar-nav">
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center hidden-xs">
                                    <li class="text-center">
                                        <a class="navbar-brand bold h4-responsive" href="#"><i class="fa fa-ticket" aria-hidden="true">&nbsp;</i> {{buy_eventTickets2}}</a>
                                    </li>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                                    <li>
                                        <select  ng-change="loadMovieDates()" ng-init="loadMovies()" ng-model="mid"  class="form-control filter-select">
                                            <option value="">Select Movie</option>
                                            <option ng-repeat="mov in ActiveMovies" value="{{mov.movie_id}}">{{mov.mov_name}}</option>
                                        </select>
                                    </li>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                                    <li>
                                        <select  ng-change="loadMovieSlot()" ng-model="mdate" class="form-control filter-select">
                                        	<option value="">Select Movie</option>
                                        	<option ng-repeat="dater in AllMovieDates" value="{{dater.valop}}">{{dater.valht}}</option>
                                        </select>
                                    </li>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                                    <li>
                                        <select  ng-model="mslot" class="form-control filter-select">
                                        	<option value="">Select Movie & Date</option>
                                        	<option ng-repeat="slot in AllMovieSlot" value="{{slot.slotval}}">
                                        		{{slot.slot}}
                                        	</option>
                                        </select>
                                    </li>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 text-center">
                                    <li>
                                        <button type="button" ng-click="loadMovieSeatInInfo()" class="btn btn-nav-search btn-block"><i class="fa fa-search" aria-hidden="true">&nbsp;</i> Search</button>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Search Navigation Ends Here -->
                <div class="clearfix"></div>
                <!-- Movies Now Showing section starts here -->
                <div class="section-simple2">
                    <div class="container">
                        <div class="row section_padd30">
                            <!-- Left Sidebar Section Starts Here -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="section-heading">
                                    <h2 class="text-fluid">{{movies}} <span class="section-topic">{{movies_showing}}</span></h2>
                                </div>
                                <div class="section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">
                                    <!-- picked up from ex design -->
                                    <!-- single card starts -->
                                    <div class="card-box  col-md-3 col-sm-6 col-xs-12" ng-repeat="x in name| limitTo : 8"><!--Card 1 start here-->
                                        <!--Card-->
                                        <div class="card movie-card">                            
                                            <div class="header movie">
                                                <img class="ch-image" src="upload/event_web_logo/{{x.logo}}"/>
                                                <div class="actions row text-center col-sm-12">
                                                    <a href="movies_purchase.php?Mid={{x.movie_id}}&Mname={{x.name}}" class="btn btn-success btn-raised btn-round text-center white-text">
                                                        <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                                    </a>
                                                    <button class="btn btn-danger btn-raised btn-round text-center white-text">
                                                        <i class="fa fa-play" aria-hidden="true">&nbsp;</i> {{btn_trailer}}
                                                    </button>
                                                </div>
                                                <div class="category">
                                                    <span class="category-label label primary-color-dark">{{x.event_organizer_details}}</span>    
                                                </div>
                                            </div>
                                            <a class="btn-floating btn-action  primary-color-dark">
                                                <i class="fa" aria-hidden="true">{{x.movietype}}</i>
                                            </a>
                                            <div class="content">
                                                <h6 class="title bold"><a class="glow2" href="#">{{x.name | limitTo : 80}}</a></h6>
                                                <div class="genre-list">
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                </div>
                                                <p class="description padding_bottom10">
                                                    <span class="text-primary bold pull-left"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.moviestartdate}}</span>
                                                    <span class="text-danger bold pull-right"><i class="fa fa-language" aria-hidden="true">&nbsp;</i> {{lan_h}}</span>
                                                </p>
                                            </div>
                                        </div><!-- end card -->
                                    </div>
                                    <!-- single card ends -->
                                    <!-- ./picked up from ex design -->
                                    <!-- single card starts -->
<!--                                    <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in name| limitTo : 12">

                                        <div class="card hm-zoom movie">

                                            <div class="view overlay">
                                                <img src="tc-merchant-template/assets/img/movies/small-thumbs/{{x.logo}}" class="img-fluid ch-image" alt="">
                                                <a>
                                                    <div class="mask"></div>
                                                </a>
                                            </div>

                                            <a class="btn-floating btn-action  primary-color-dark">

                                                <i class="fa" aria-hidden="true"> {{x.movietype}}</i>
                                            </a>

                                            <div class="hidden-buttons">
                                                <a  href="event_tickets.php?id={{x.event_id}}" class="ticket btn btn-info btn-raised btn-round white-text">
                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                                </a>
                                                <button class="trailer btn btn-danger btn-raised btn-round text-center white-text">
                                                    <i class="fa fa-play" aria-hidden="true">&nbsp;</i> {{btn_trailer}}
                                                </button>
                                                <div class="category margin-top-230">
                                                    <span class="category-label label primary-color-dark">{{x.event_organizer_details}}</span>
                                                </div>
                                            </div>

                                            <div class="content text-center" style="height: 170px !important;">
                                                <h6 class="title bold"><a class="glow2" href="#">{{x.name| limitTo : 80}}</a></h6>
                                                <div class="genre-list">
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                    <span class="genre bold">{{x.event_type_tag}}</span>
                                                </div>
                                                <p class="description padding_bottom10">
                                                    <span class="text-primary bold pull-left"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.moviestartdate}}</span>
                                                    <span class="text-danger bold pull-right"><i class="fa fa-language" aria-hidden="true">&nbsp;</i> {{lan_h}}</span>
                                                </p>
                                            </div>

                                        </div>

                                    </div>-->

                                    <!-- single card starts -->




                                    <!-- <div class="card-box  col-md-3 col-sm-6 col-xs-12" ng-repeat="x in name| limitTo : 12"><!--Card 1 start here-->
                                    <!--Card-->
<!--                                    <div class="card movie-card">                            
                                        <div class="header movie">
                                            <img class="ch-image" src="tc-merchant-template/assets/img/movies/small-thumbs/{{x.logo}}"/>
                                            <div class="actions row text-center col-sm-12">
                                                <a  href="event_tickets.php?id={{x.event_id}}" class="ticket btn btn-info btn-raised btn-round white-text">
                                                    <i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i> {{btn_buy}}
                                                </a>
                                                <button class="btn btn-danger btn-raised btn-round text-center white-text">
                                                    <i class="fa fa-play" aria-hidden="true">&nbsp;</i> {{btn_trailer}}
                                                </button>
                                            </div>
                                            <div class="category margin-top-230">
                                                <span class="category-label label primary-color-dark">Blockbuster Cinamas</span>    
                                            </div>
                                        </div>
                                        <a class="btn-floating btn-action  primary-color-dark">
                                            <i class="fa" aria-hidden="true"> {{x.movietype}}</i>
                                        </a>
                                        <div class="content">
                                            <h6 class="title bold"><a class="glow2" href="#">{{x.name| limitTo : 80}}</a></h6>
                                            <div class="genre-list">
                                                <span class="genre bold">{{x.event_type_tag}}</span>
                                                <span class="genre bold">{{x.event_type_tag}}</span>
                                                <span class="genre bold">{{x.event_type_tag}}</span>
                                            </div>
                                            <p class="description padding_bottom10">
                                                <span class="text-primary bold pull-left"><i class="fa fa-calendar" aria-hidden="true">&nbsp;</i> {{x.moviestartdate}}</span>
                                                <span class="text-danger bold pull-right"><i class="fa fa-language" aria-hidden="true">&nbsp;</i> {{lan_h}}</span>
                                            </p>
                                        </div>
                                    </div> end card -->
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                            <button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i> {{btn_viewMore}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Movies Now Showing section ends here -->
            <div class="clearfix"></div>
            <!-- Movies Upcoming section starts here -->
            <div class="section-simple2">
                <div class="container">
                    <div class="row section_padd30">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="section-heading">
                                <h2 class="text-fluid">{{comig_soonTitle}} <span class="section-topic">{{comig_soonSpan}}</span></h2>
                            </div>
                            <div class="section-content section_padd30 animated wow fadeIn" data-wow-duration="1s" data-wow-delay="0.02s">

                                <!-- single card starts -->
                                <div class="card-box col-md-3 col-sm-6 col-xs-12" ng-repeat="x in name| filter:{status:'2'} | limitTo : 4">
                                    <!--Card-->
                                    <div class="card hm-zoom movie">

                                        <!--Card image-->
                                        <div class="view overlay">
                                            <img src="upload/event_web_logo/{{x.logo}}" class="img-fluid ch-image" alt="">
                                            <a>
                                                <div class="mask"></div>
                                            </a>
                                        </div>
                                        <span class="movie-date-label light-blue">
                                            {{x.releasedate| date: "dd"}}<br>
                                            {{x.releasedate| date:  "MMM"}}

                                        </span>
                                        <!--/.Card image-->
                                        <div class="hidden-buttons">
                                            <a href="movies-info.php?info_id={{x.movie_id}}" class="ticket btn btn-info btn-raised btn-round text-center white-text">
                                                <i class="fa fa-info" aria-hidden="true">&nbsp;</i> {{btn_info}}
                                            </a>
                                            <button class="trailer btn btn-danger btn-raised btn-round text-center white-text">
                                                <i class="fa fa-play" aria-hidden="true">&nbsp;</i> {{btn_trailer}}
                                            </button>
                                        </div>
                                        <!--Card content-->
                                        <div class="content text-center" style="height: 90px">
                                            <h6 class="title bold text-left"><a class="glow2" href="#">{{x.name| limitTo : 100}}</a></h6>
                                        </div>
                                        <!--/.Card content-->
                                    </div>
                                    <!--/.Card-->
                                </div>
                                <!-- single card ends -->
                            </div>

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 section-footer text-center section_padd60">
                            <button type="button" class="btn btn-block success-rounded-outline waves-effect"><i class="fa fa-arrow-circle-o-down" aria-hidden="true">&nbsp;</i>{{btn_viewMore}}</button>
                        </div>
                    </div>


                </div>
                <!-- Movies Upcoming section ends here -->
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
        </div>
        <!-- main content part ends here -->

        <?php include 'include/footer.php'; ?>

    </div>

    <?php echo $cms->angularJs(array('movie_angular')); ?>
    <?php echo $cms->fotterJs(array('movies')); ?>

    <script>
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
                videoId: 'uvi6WZKHCJ0',
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
    <script>
        $(document).ready(function () {
            var imageShowCase = $("#imageShowCase");

            imageShowCase.owlCarousel({
                autoPlay: 4000,
                stagePadding: 50,
                loop: true,
                margin: 10,
                stopOnHover: true,
                navigation: false,
                pagination: true,
                paginationSpeed: 1000,
                goToFirstSpeed: 2000,
                singleItem: true,
                autoHeight: true
            });

            // Custom Navigation Events
            $("#ts-next").click(function () {
                imageShowCase.trigger('owl.next');
            })
            $("#ts-prev").click(function () {
                imageShowCase.trigger('owl.prev');
            })

            /*$(".play").click(function () {
             owl.trigger('owl.play', 1000);
             })
             $(".stop").click(function () {
             owl.trigger('owl.stop');
             })
             
             $("#imageShowCase").mouseover(function () {
             $("#ps-next").addClass('active-ps-nav-next');
             $("#ps-prev").addClass('active-ps-nav-prev');
             });
             $("#imageShowCase").mouseout(function () {
             $("#ps-next").removeClass('active-ps-nav-next');
             $("#ps-prev").removeClass('active-ps-nav-prev');
             });*/




            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $(".modal-fullscreen").on('show.bs.modal', function () {
                setTimeout(function () {
                    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
                }, 0);
            });
            $(".modal-fullscreen").on('hidden.bs.modal', function () {
                $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
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
</body>

</html>