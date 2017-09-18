<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of plugin
 *
 * @author MD MAHAMUDUR ZAMAN BHUYIAN <fahad at fahadbhuyian.com>
 */
class plugin {
    /*  page Title start */

    public function pageTitle($title = '') {
        $page_title = '';
        if (empty($title)) {
            $page_title .='Ticketchai | Home ';
        } else {
            $page_title .=$title;
        }

        return "<title>" . $page_title . "</title>";
    }

    /*     * ********page Title  end********* */


    /* public css start */

    public function headCss($array = array()) {
        if (!empty($array)) {
            if (in_array("addMoreEventTickets", $array)) {
                $css = '';
                $css .=$this->siteFonts();
                $css .=$this->coreCss();
                return $css;
            } elseif (in_array("addMoreQustions", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("addQuestions", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("analystics", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                return $css;
            } elseif (in_array("createEvent", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("createEventTickets", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("dashboard", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("login", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("register", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("ticketList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
//                $css .=$this->Kendo("css");
                return $css;
            } elseif (in_array("eventList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                return $css;
            } elseif (in_array("currentList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                return $css;
            } elseif (in_array("upcomingList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                return $css;
            } elseif (in_array("arciveList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                return $css;
            } elseif (in_array("paymentMethod", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("paymentMethodList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("question", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("newrefundlist", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("newrefundrequest", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("onlineChecking", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("manualorder", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("userProfile", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("userEditProfile", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("paymentMethodOfflinelist", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("paymentMethodOffline", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("orderList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("venueAdd", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("venueList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("quickOrdervenue", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("eventButtonList", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("paymentGetwayCharges", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("eventButton", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("paymentGetawaylist", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("pickpointlist", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("profileImage", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("changePassword", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("userlist", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("attendeesReport", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("changeEventStatus", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("manualNewPickPoint", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } elseif (in_array("reports", $array)) {
                $css = '';
                $css .=$this->coreCss();
                $css .=$this->siteFonts();
                $css .=$this->notificationCss();
                return $css;
            } else {

                return $this->coreCss();
            }
        }
    }

    /*     * *********** public css end************** */



    /* public js start */

    public function footerJs($array = array()) {
        if (!empty($array)) {
            if (in_array("addMoreEventTickets", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->AddMoreEventAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("addMoreQustions", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->AddMoreQuestionsAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("addQuestions", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->AddQuestionsAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("analystics", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->AnalysticsAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("createEvent", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->CreateEventAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();

                return $js;  
            } elseif (in_array("cloneEvent", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->CloneEventAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                //clone
                return $js;
            }   elseif (in_array("editEvent", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->EditEventAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                //clone
                return $js;
            } elseif (in_array("createEventTickets", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->CreateEventTicketsAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("dashboard", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->dashboardAngular();
                $js .=$this->coreJs();

                return $js;
            } elseif (in_array("events", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->eventsAngular();
                $js .=$this->coreJs();

                return $js;
            } elseif (in_array("viewOrder", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->viewOrderAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("login", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->LoginAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("register", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->RegisterAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("ticketList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->ticketlistControllerAngular();
                $js .=$this->notificationJs();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("eventList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->eventListAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("currentList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->currentEventListAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("upcomingList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->upcomingEventListAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("arciveList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->arciveEventListAngular();
                $js .=$this->coreJs();
                return $js;
            } elseif (in_array("partnersImg", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->partnerimageAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("paymentMethodList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentMethodListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            }
            elseif (in_array("paymentMethod", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentMethodAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            }elseif (in_array("question", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->qustionAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("newrefundlist", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->newrefundlistAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("newrefundrequest", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->newrefundrequestAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("onlineChecking", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->onlineCheckingAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("manualOrder", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->manualOrderAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("userProfile", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->UserProfileAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("userEditProfile", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->userProfileEditAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("paymentMethodOfflinelist", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentmethodofflinelistAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("paymentMethodOffline", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentmethodofflineAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("orderList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->orderListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("venueAdd", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->venueAddAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("venueList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->venueListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("quickOrderVenue", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->quickOrderVenueAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("eventButtonList", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->eventButtonListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("paymentGetwayCharges", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentGetwayChargesAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("eventButton", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->eventButtonAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("paymentGetawaylist", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->paymentGetwayChargesServicesListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("pickpointlist", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->pickpointlistAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("profileImage", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->profileImageAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("changePassword", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->changePasswordAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("userlist", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->userListAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("attendeesReport", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->attendeesReportAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("changeEventStatus", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->changeEventStatusAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("manualNewPickPoint", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->manualNewPickPointAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } elseif (in_array("reports", $array)) {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->reportsAngular();
                $js .=$this->coreJs();
                $js .=$this->notificationJs();
                return $js;
            } else {
                $js = '';
                $js .=$this->angularJs();
                $js .=$this->coreJs();
                return $js;
            }
        }
    }

    /*     * ******public js end******* */


    /* notification start here */

    private function notificationCss() {
        $notific = "";
        $notific .= ' <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/angular-growl.min.css") . ' "> ';

        return $notific;
    }

    /* notification end here */


    /* Core CSS start Here */

    private function coreCss() {
        $corecss = '';
        $corecss .='<!--Core CSS Files-->
            <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/bootstrap.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/paper-dashboard.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/css/gsi-step-indicator.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/css/tsf-step-form-wizard.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/assets/css/loader.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/dropzone-master/dist/dropzone.css") . ' ">';

        return $corecss;
    }

    /*     * ***********Core CSS END Here************ */


    /* Notification Js start here */

    private function notificationJs() {
        $notifyJs = "";
        $notifyJs .= '<script type="text/javascript" src=" ' . $this->baseUrl("assets/js/angular-growl.min.js") . ' "></script>';

        return $notifyJs;
    }

    /* Notification Js end here */

    private function coreJs() {
        $corejs = '';
        $corejs .= '<!--Core JS Files-->
            
        <script src="' . $this->baseUrl("assets/js/jquery-1.10.2.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/jquery-ui.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/bootstrap.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/jquery.validate.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/moment.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-datetimepicker.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-selectpicker.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-checkbox-radio-switch-tags.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/jquery.easypiechart.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/chartist.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-notify.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/sweetalert2.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/jquery-jvectormap.js") . '" type="text/javascript"></script>
            
        <script src=" ' . $this->baseUrl("../tc-merchant-template/assets/js/loader.js") . ' "  type="text/javascript"></script>
        
        <script src=" ' . $this->baseUrl("assets/js/jquery.bootstrap.wizard.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-table.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/fullcalendar.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/paper-dashboard.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/jquery.sharrre.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/demo.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("../tc-merchant-template/plugins/dropzone-master/dist/min/dropzone.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/js/tsf-wizard-plugin.js") . '" type="text/javascript"></script>';
//        $corejs .=$this->angularJs();
//        $corejs .=$this->angularBootstrapJs();


        $filenamePut="'".$this->filename()."'";

        
        $corejs .='<script type="text/javascript">
					$(document).ready(function(){

						var getTest=$("a[href='.$filenamePut.']").parent().parent().parent().parent("li").html();

						

						if(getTest!="undefined")
						{
							$("a[href='.$filenamePut.']").parent().addClass('.$this->PushSingleQuta('active').');
							$("a[href='.$filenamePut.']").parent().parent().parent().parent("li").children('.$this->PushSingleQuta('a').').click();

						}
						

					});
				</script>';

        return $corejs;
    }


    private function PushSingleQuta($st)
    {
    	$str="";
    	$str .="'".$st."'";
    	return $str;
    }

    /*     * ********page JS file include end Here *********** */



    /* Font CSS file include start */

    private function siteFonts() {
        $fontcss = '';
        $fontcss .='<!-- Fonts and icons -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,300"   type="text/css"/>
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/themify-icons.css") . '" />
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/pe-icon-7-stroke.css") . '"  />
        <link rel="stylesheet" href="' . $this->baseUrl("../tc-merchant-template/plugins/fontello-2910d963/css/fontello.css") . '" />';



        return $fontcss;
    }

    /*     * *******Font CSS file include end********** */


    /* Angular LIBRARY Js  start Here */

//    private function angularJs() {
//        $angularlibrJs = '';
//        $angularlibrJs .='<!--Angular LIBRARY Js--->
//        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>';
//        return $angularlibrJs;
//    }

    private function angularJs() {
        $angularlibrJs = '';
        $angularlibrJs .='<!--Angular LIBRARY Js--->
        <script src="' . $this->baseUrl("../angularJs/core/angular.min.js") . '"></script>
        <script src="' . $this->baseUrl("../angularJs/core/ui-bootstrap.min.js") . '"></script>
        <script src="' . $this->baseUrl("../angularJs/core/ui-bootstrap-tpls.min.js") . '"></script>';
        return $angularlibrJs;
    }

    /*     * *********Angular LIBRARY Js End Here*********** */


    /* Angular Bootstrap Js start */

    private function angularBootstrapJs() {
        $angularBootJs = '';
        $angularBootJs .='<!--Angular Bootstrap Js-->
        <script src="' . $this->baseUrl("../angularJs/core/ui-bootstrap-tpls.min.js") . '"></script>
        <script src="' . $this->baseUrl("../angularJs/core/ui-bootstrap.min.js") . '"></script>
        <script src="' . $this->baseUrl("../angularJs/core/jquery.min.js") . '"></script>';
        return $angularBootJs;
    }

    /*     * ***********Angular Bootstrap Js End Here************ */



    /* Angular Private Function Start Here */

    private function dashboardAngular() {
        $jsangu = '';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/scripts/dashboardController.js") . '"></script>';
        return $jsangu;
    }

    private function eventsAngular() {
        $jsangu = '';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/scripts/eventController.js") . '"></script>';
        return $jsangu;
    }
    
    private function viewOrderAngular() {
        $jsangu = '';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangu .='<script src="' . $this->baseUrl("../angularJs/scripts/viewOrderController.js") . '"></script>';
        return $jsangu;
    }

    private function CreateEventAngular() {
        $jsangular = '';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/scripts/createEventController.js") . '"></script>';
        return $jsangular;
    } 

    private function CloneEventAngular() {
        $jsangular = '';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/scripts/cloneEventController.js") . '"></script>';
        return $jsangular;
    }
    
    private function EditEventAngular() {
        $jsangular = '';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangular .='<script src="' . $this->baseUrl("../angularJs/scripts/editEventController.js") . '"></script>';
        return $jsangular;
    }

    //clone

    private function CreateEventTicketsAngular() {
        $jsangularevent = '';
        $jsangularevent.='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $jsangularevent .='<script src="' . $this->baseUrl("../angularJs/scripts/createEventTicketsController.js") . '"></script>';
        return $jsangularevent;
    }

    private function AddMoreEventAngular() {
        $addEvantAngularJs = '';
        $addEvantAngularJs .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $addEvantAngularJs .='<script src="' . $this->baseUrl("../angularJs/scripts/addmoreEventTicketsController.js") . '"></script>';
        return $addEvantAngularJs;
    }

    private function AddMoreQuestionsAngular() {
        $addmoreQuestionsAj = '';
        $addmoreQuestionsAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $addmoreQuestionsAj .='<script src="' . $this->baseUrl("../angularJs/scripts/addMoreQuestionsController.js") . '"></script>';
        return $addmoreQuestionsAj;
    }

    private function AddQuestionsAngular() {
        $addmoreQuestionsAj = '';
        $addmoreQuestionsAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $addmoreQuestionsAj .='<script src="' . $this->baseUrl("../angularJs/scripts/addQuestionsController.js") . '"></script>';
        return $addmoreQuestionsAj;
    }

    private function AnalysticsAngular() {
        $analysticsAngularsAj = '';
        $analysticsAngularsAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $analysticsAngularsAj .='<script src="' . $this->baseUrl("../angularJs/scripts/analysticsController.js") . '"></script>';
        return $analysticsAngularsAj;
    }

    private function LoginAngular() {
        $loginAj = '';
        $loginAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $loginAj .='<script src="' . $this->baseUrl("../angularJs/scripts/loginController.js") . '"></script>';
        return $loginAj;
    }

    private function RegisterAngular() {
        $loginAj = '';
        $loginAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $loginAj .='<script src="' . $this->baseUrl("../angularJs/scripts/registerController.js") . '"></script>';
        return $loginAj;
    }

    private function ticketlistAngular() {
        $ticketlistAj = '';
        $ticketlistAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $ticketlistAj .='<script src="' . $this->baseUrl("../angularJs/scripts/createEventTicketsController.js") . '"></script>';
        return $ticketlistAj;
    }

    private function ticketlistControllerAngular() {
        $ticketlistAj = '';
        $ticketlistAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $ticketlistAj .='<script src="' . $this->baseUrl("../angularJs/scripts/TicketsListController.js") . '"></script>';
        return $ticketlistAj;
    }

    private function eventListAngular() {
        $eventListAj = '';
        $eventListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $eventListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/EventListController.js") . '"></script>';
        return $eventListAj;
    }

    private function currentEventListAngular() {
        $currentListAj = '';
        $currentListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $currentListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/currentEventListController.js") . '"></script>';
        return $currentListAj;
    }

    private function upcomingEventListAngular() {
        $upcomingListAj = '';
        $upcomingListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $upcomingListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/upcomingEventListController.js") . '"></script>';
        return $upcomingListAj;
    }

    private function arciveEventListAngular() {
        $arciveListAj = '';
        $arciveListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $arciveListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/arciveEventListController.js") . '"></script>';
        return $arciveListAj;
    }

    private function paymentMethodAngular() {
        $paymentMethod = '';
        $paymentMethod .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentMethod .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentMethodController.js") . '"></script>';
        return $paymentMethod;
    }
    
    private function partnerimageAngular() {
        $partnersImgMethod = '';
        $partnersImgMethod .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $partnersImgMethod .='<script src="' . $this->baseUrl("../angularJs/scripts/partnersImageController.js") . '"></script>';
        return $partnersImgMethod;
    }

    private function paymentMethodListAngular() {
        $paymentMethodList = '';
        $paymentMethodList .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentMethodList .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentMethodControllerList.js") . '"></script>';
        return $paymentMethodList;
    }

    private function qustionAngular() {
        $qustionAj = '';
        $qustionAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $qustionAj .='<script src="' . $this->baseUrl("../angularJs/scripts/qustionsListController.js") . '"></script>';
        return $qustionAj;
    }

    private function newrefundlistAngular() {
        $newrefundlistAj = '';
        $newrefundlistAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $newrefundlistAj .='<script src="' . $this->baseUrl("../angularJs/scripts/newrefundRequestListController.js") . '"></script>';
        return $newrefundlistAj;
    }

    private function newrefundrequestAngular() {
        $newrefundrequestAj = '';
        $newrefundrequestAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $newrefundrequestAj .='<script src="' . $this->baseUrl("../angularJs/scripts/newRefundRequestController.js") . '"></script>';
        return $newrefundrequestAj;
    }

    private function UserProfileAngular() {
        $userprofileAj = '';
        $userprofileAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $userprofileAj .='<script src="' . $this->baseUrl("../angularJs/scripts/UserProfileController.js") . '"></script>';
        return $userprofileAj;
    }

    private function userProfileEditAngular() {
        $userProfileEditAj = '';
        $userProfileEditAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $userProfileEditAj .='<script src="' . $this->baseUrl("../angularJs/scripts/userProfileEditController.js") . '"></script>';
        return $userProfileEditAj;
    }

    private function onlineCheckingAngular() {
        $onlineCheckingAj = '';
        $onlineCheckingAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $onlineCheckingAj .='<script src="' . $this->baseUrl("../angularJs/scripts/onlineCheckingController.js") . '"></script>';
        return $onlineCheckingAj;
    }

    private function manualOrderAngular() {
        $manualOrderAj = '';
        $manualOrderAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $manualOrderAj .='<script src="' . $this->baseUrl("../angularJs/scripts/manualOrderController.js") . '"></script>';
        return $manualOrderAj;
    }

    private function paymentmethodofflinelistAngular() {
        $paymentmethodofflinelistAj = '';
        $paymentmethodofflinelistAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentmethodofflinelistAj .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentMethodofflineList.js") . '"></script>';
        return $paymentmethodofflinelistAj;
    }

    private function paymentmethodofflineAngular() {
        $paymentmethodofflineAj = '';
        $paymentmethodofflineAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentmethodofflineAj .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentMethodOffline.js") . '"></script>';
        return $paymentmethodofflineAj;
    }

    private function orderListAngular() {
        $orderListAj = '';
        $orderListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $orderListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/orderListController.js") . '"></script>';
        return $orderListAj;
    }

    private function venueAddAngular() {
        $venueAddAj = '';
        $venueAddAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $venueAddAj .='<script src="' . $this->baseUrl("../angularJs/scripts/venueAddController.js") . '"></script>';
        return $venueAddAj;
    }

    private function venueListAngular() {
        $venueListAj = '';
        $venueListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $venueListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/venueListController.js") . '"></script>';
        return $venueListAj;
    }

    private function quickOrderVenueAngular() {
        $quickordervenueAj = '';
        $quickordervenueAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $quickordervenueAj .='<script src="' . $this->baseUrl("../angularJs/scripts/quickOrderVenueController.js") . '"></script>';
        return $quickordervenueAj;
    }

    private function eventButtonListAngular() {
        $eventButtonListAj = '';
        $eventButtonListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $eventButtonListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/eventButtonListController.js") . '"></script>';
        return $eventButtonListAj;
    }

    private function paymentGetwayChargesAngular() {
        $paymentGetwayChargesAj = '';
        $paymentGetwayChargesAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentGetwayChargesAj .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentGetwayChargesController.js") . '"></script>';
        return $paymentGetwayChargesAj;
    }

    private function eventButtonAngular() {
        $eventButtonShowListAj = '';
        $eventButtonShowListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $eventButtonShowListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/eventButtonlistShowController.js") . '"></script>';
        return $eventButtonShowListAj;
    }

    private function paymentGetwayChargesServicesListAngular() {
        $paymentGetwayChargesServicesListAj = '';
        $paymentGetwayChargesServicesListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $paymentGetwayChargesServicesListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/paymentgetawayServicesChargeslistController.js") . '"></script>';
        return $paymentGetwayChargesServicesListAj;
    }

    private function pickpointlistAngular() {
        $pickpointlisttAj = '';
        $pickpointlisttAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $pickpointlisttAj .='<script src="' . $this->baseUrl("../angularJs/scripts/pickpointlistController.js") . '"></script>';
        return $pickpointlisttAj;
    }

    private function profileImageAngular() {
        $profileImageAj = '';
        $profileImageAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $profileImageAj .='<script src="' . $this->baseUrl("../angularJs/scripts/profileImageController.js") . '"></script>';
        return $profileImageAj;
    }

    private function changePasswordAngular() {
        $changePasswordAj = '';
        $changePasswordAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $changePasswordAj .='<script src="' . $this->baseUrl("../angularJs/scripts/changePasswordController.js") . '"></script>';
        return $changePasswordAj;
    }

    private function userListAngular() {
        $userListAj = '';
        $userListAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $userListAj .='<script src="' . $this->baseUrl("../angularJs/scripts/userListController.js") . '"></script>';
        return $userListAj;
    }

    private function attendeesReportAngular() {
        $attendeesReportAj = '';
        $attendeesReportAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $attendeesReportAj .='<script src="' . $this->baseUrl("../angularJs/scripts/attendeesReportController.js") . '"></script>';
        return $attendeesReportAj;
    }

    private function changeEventStatusAngular() {
        $changeEventStatusAj = '';
        $changeEventStatusAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $changeEventStatusAj .='<script src="' . $this->baseUrl("../angularJs/scripts/changeEventStatusController.js") . '"></script>';
        return $changeEventStatusAj;
    }

    private function manualNewPickPointAngular() {
        $manualNewPickPointAj = '';
        $manualNewPickPointAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $manualNewPickPointAj .='<script src="' . $this->baseUrl("../angularJs/scripts/manualNewPickPointController.js") . '"></script>';
        return $manualNewPickPointAj;
    }

    private function reportsAngular() {
        $reportsAj = '';
        $reportsAj .='<script src="' . $this->baseUrl("../angularJs/app.js") . '"></script>';
        $reportsAj .='<script src="' . $this->baseUrl("../angularJs/scripts/reportsController.js") . '"></script>';
        return $reportsAj;
    }
     /** kendo function adding start from here * */
    private function Kendo($type = '') {
        if (!empty($type)) {
            if ($type == "css") {
                $css = '';
                $css .=$this->KendoCss();

                return $css;
            } elseif ($type == "js") {
                $js = '';
                $js .=$this->KendoJS();
                return $js;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    
    private function KendoCss() {
        $content = '<link rel="stylesheet" href="' . $this->baseUrl("kendo/css/kendo.common.min.css") . '"  />
                  <link rel="stylesheet" href="' . $this->baseUrl("kendo/css/kendo.metro.min.css") . '"  />';
        return $content;
    }

    private function KendoJS() {
        $content = '<script type="text/javascript" src="' . $this->baseUrl("kendo/js/kendo.web.min.js") . '"></script>';
        return $content;
    }

    /** kendo function end from here * */
    
    
    public function baseUrl($suffix = '') {
        $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
//$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/merchant-dashboard/";
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/merchant-dashboard/";
        } 
         elseif ($_SERVER['HTTP_HOST'] == "ticketchai.org" || $_SERVER['HTTP_HOST'] == "https://ticketchai.com" || $_SERVER['HTTP_HOST'] == "http://ticketchai.com/" ) {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/merchant-dashboard/";
        }else {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/merchant-dashboard/";
        }

        $suffix = ltrim($suffix, '/');
        return $web_root . trim($suffix);
    }
    /* Base URL start */
//
//    public function baseUrl($suffix = '') {
//        $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
////$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
//        if ($_SERVER['HTTP_HOST'] == "localhost") {
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchai_aj/merchant-dashboard/";
//        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchai_aj/merchant-dashboard/";
//        } 
//         else {
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "";
//        }
//
//        $suffix = ltrim($suffix, '/');
//        return $web_root . trim($suffix);
//    }

    /*     * **********Base URL end ****************** */

    function filename() {
        return basename($_SERVER['PHP_SELF']);
    }

    /* Facebook Page Plugin Start Here */

    public function FbSocialScript() {
        $cms = '';
        $cms .='<div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document,"script","facebook-jssdk"));
        </script>';
        return $cms;
    }

}