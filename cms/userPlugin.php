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

    function filename() {
        return basename($_SERVER['PHP_SELF']);
    }

    /*     * ********page Title  start********* */

    public function pageTitle($title = '') {

        $page_title = '';
        if (empty($title)) {
            $page_title .= 'TicketChai | Home';
        } else {
            $page_title .= $title;
        }

        return "<title>" . $page_title . "</title>";
    }

    /*     * ********page Title  end********* */



    /* public css start */

    public function headCss($array = array()) {
        if (!empty($array)) {
            if (in_array("dashboard", $array)) {
                $css = '';
                $css .= $this->coreCss();
                $css .= $this->siteFonts();
                $css .= $this->loaderCss();
                return $css;
            } elseif (in_array("user_profile", $array)) {
                $upcss = '';
                $upcss .= $this->coreCss();
                $upcss .= $this->siteFonts();
                $upcss .= $this->userProfile();
                $upcss .= $this->loaderCss();
                return $upcss;
            } elseif (in_array("user_order", $array)) {
                $upcss = '';
                $upcss .= $this->coreCss();
                $upcss .= $this->siteFonts();
                $upcss .= $this->userProfile();
                $upcss .= $this->loaderCss();
                return $upcss;
            } elseif (in_array("user_wishlist", $array)) {
                $wlcss = '';
                $wlcss .= $this->coreCss();
                $wlcss .= $this->siteFonts();
                $wlcss .= $this->userProfile();
                $wlcss .= $this->loaderCss();
                return $wlcss;
            } elseif (in_array("user_address", $array)) {
                $uacss = '';
                $uacss .= $this->coreCss();
                $uacss .= $this->siteFonts();
                $uacss .= $this->userAddress();
                $uacss .= $this->loaderCss();
                $uacss .= $this->notificationCss();
                return $uacss;
            } elseif (in_array("edit_profile", $array)) {
                $uepcss = '';
                $uepcss .= $this->coreCss();
                $uepcss .= $this->siteFonts();
                $uepcss .= $this->editProfile();
                $uepcss .= $this->notificationCss();
                $uepcss .= $this->loaderCss();
                return $uepcss;
            } elseif (in_array("edit_profile_image", $array)) {
                $upicss = '';
                $upicss .= $this->coreCss();
                $upicss .= $this->siteFonts();
                $upicss .= $this->editProfile();
                $upicss .= $this->notificationCss();
                $upicss .= $this->loaderCss();
                return $upicss;
            } elseif (in_array("user_cart", $array)) {
                $uccss = '';
                $uccss .= $this->coreCss();
                $uccss .= $this->siteFonts();
                $uccss .= $this->loaderCss();
                return $uccss;
            } elseif (in_array("login", $array)) {
                $ulcss = '';
                $ulcss .= $this->coreCss();
                $ulcss .= $this->siteFonts();
                $ulcss .= $this->loaderCss();
                return $ulcss;
            } elseif (in_array("user_registration", $array)) {
                $urcss = '';
                $urcss .= $this->coreCss();
                $urcss .= $this->siteFonts();
                $urcss .= $this->loaderCss();
                return $urcss;
            }
        }
    }

    /* public css end */

    /* public js start */

    public function footerJs($array = array()) {
        if (!empty($array)) {
            if (in_array("dashboard", $array)) {
                $js = '';
                $js .= $this->coreJs();
                $js .= $this->angularJs();
                $js .= $this->dashboardAngular();
                $js .= $this->loaderJs();
                return $js;
            } elseif (in_array("user_profile", $array)) {
                $upjs = '';
                $upjs .= $this->coreJs();
                //$upjs .= $this->barcodeJs();
                $upjs .= $this->angularJs();
                $upjs .= $this->userProfileAngular();
                $upjs .= $this->loaderJs();
                return $upjs;
            } elseif (in_array("user_order", $array)) {
                $orjs = '';
                $orjs .= $this->coreJs();
                //$orjs .= $this->barcodeJs();
                $orjs .= $this->angularJs();
                $orjs .= $this->userOrderAngular();
                $orjs .= $this->loaderJs();
                return $orjs;
            } elseif (in_array("user_paid_order", $array)) {
                $orpjs = '';
                $orpjs .= $this->coreJs();
                //$orpjs .= $this->barcodeJs();
                $orpjs .= $this->angularJs();
                $orpjs .= $this->userPaidOrderAngular();
                $orpjs .= $this->loaderJs();
                return $orpjs;
            } elseif (in_array("user_pandding_order", $array)) {
                $orpajs = '';
                $orpajs .= $this->coreJs();
                //$orpajs .= $this->barcodeJs();
                $orpajs .= $this->angularJs();
                $orpajs .= $this->userPanddingOrderAngular();
                $orpajs .= $this->loaderJs();
                return $orpajs;
            } elseif (in_array("user_order_ticket", $array)) {
                $otjs = '';
                $otjs .= $this->coreJs();
                $otjs .= $this->barcodeJs();
                $otjs .= $this->angularJs();
                $otjs .= $this->userOrderTicketAngular();
                $otjs .= $this->loaderJs();
                return $otjs;
            } elseif (in_array("user_wishlists", $array)) {
                $wljs = '';
                $wljs .= $this->coreJs();
                $wljs .= $this->angularJs();
                $wljs .= $this->userWishlistAngular();
                $wljs .= $this->loaderJs();
                return $wljs;
            } elseif (in_array("user_address", $array)) {
                $uadjs = '';
                $uadjs .= $this->coreJs();
                $uadjs .= $this->angularJs();
                $uadjs .= $this->userAddressAngular();
                $uadjs .= $this->loaderJs();
                $uadjs .= $this->notificationJs();
                return $uadjs;
            } elseif (in_array("edit_profile", $array)) {
                $uepjs = '';
                $uepjs .= $this->coreJs();
                $uepjs .= $this->angularJs();
                $uepjs .= $this->editProfileAngular();
                $uepjs .= $this->notificationJs();
                $uepjs .= $this->loaderJs();
                return $uepjs;
            } elseif (in_array("edit_password", $array)) {
                $upassjs = '';
                $upassjs .= $this->coreJs();
                $upassjs .= $this->angularJs();
                $upassjs .= $this->editPasswordAngular();
                $upassjs .= $this->notificationJs();
                $upassjs .= $this->loaderJs();
                return $upassjs;
            }elseif (in_array("user_cart", $array)) {
                $ucjs = '';
                $ucjs .= $this->coreJs();
                $ucjs .= $this->angularJs();
                $ucjs .= $this->user_cartAngular();
                $ucjs .= $this->loaderJs();
                return $ucjs;
            } elseif (in_array("logIn", $array)) {
                $uljs = '';
                $uljs .= $this->coreJs();
                $uljs .= $this->angularJs();
                $uljs .= $this->user_loginAngular();
                $uljs .= $this->loaderJs();
                return $uljs;
            } elseif (in_array("register", $array)) {
                $urjs = '';
                $urjs .= $this->coreJs();
                $urjs .= $this->angularJs();
                $urjs .= $this->user_registerAngular();
                $urjs .= $this->loaderJs();
                return $urjs;
            }  elseif (in_array("user_profile_image", $array)) {
                $upijs = '';
                $upijs .= $this->coreJs();
                $upijs .= $this->angularJs(); 
                $upijs .= $this->user_profile_imageAngular();
                $upijs .= $this->notificationJs();
                $upijs .= $this->loaderJs();
                return $upijs;
            }
        }
    }

    /* public js end */

    private function loaderCss(){
        $loader = "";
        $loader .= '<link rel="stylesheet" href=" ' .$this->baseUrl("assets/css/loader.css"). ' "> ';
        
        return $loader;
    }
    
    private function notificationCss() {
        $notific = "";
        $notific .= ' <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/angular-growl.min.css") . ' "> ';

        return $notific;
    }

    /* Core CSS start Here */

    private function coreCss() {
        $corecss = '';
        $corecss .= '  <!--Core CSS Files-->
            <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/bootstrap.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/paper-dashboard.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/css/gsi-step-indicator.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/css/tsf-step-form-wizard.min.css") . ' ">
            <link rel="stylesheet" href=" ' . $this->baseUrl("../tc-merchant-template/plugins/dropzone-master/dist/dropzone.css") . ' ">
                    ';
        return $corecss;
    }

    /* Core CSS end Here */

    /* Font CSS file include start */

    private function siteFonts() {
        $fontcss = '';

        $fontcss .= '<!-- Fonts and icons -->
                     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
                     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,300"   type="text/css"/>
                     <link rel="stylesheet" href="' . $this->baseUrl("assets/css/themify-icons.css") . '" />
                     <link rel="stylesheet" href="' . $this->baseUrl("assets/css/pe-icon-7-stroke.css") . '"  />
                     <link rel="stylesheet" href="' . $this->baseUrl("../tc-merchant-template/plugins/fontello-2910d963/css/fontello.css") . '" />
                    ';

        return $fontcss;
    }

    /* Font CSS file include end */

    /* user_profile CSS file include start */

    private function userProfile() {
        $upcss = '';

        $upcss .= ' <link href="assets/css/user_profile.css" rel="stylesheet" /> ';

        return $upcss;
    }

    /* user_profile CSS file include end */


    /* userAddress CSS file include start */

    private function userAddress() {
        $uadcss = '';

        $uadcss .= ' <link href="assets/css/user_address.css" rel="stylesheet" /> ';

        return $uadcss;
    }

    /* userAddress CSS file include end */


    /* editProfile CSS file include end */

    private function editProfile() {
        $uadcss = '';

        $uadcss .= ' <link href="assets/css/edit_profile.css" rel="stylesheet" /> ';

        return $uadcss;
    }

    /* editProfile CSS file include end */


    /*     * ***********Core Js start Here************ */

    private function coreJs() {
        $corejs = '';
        $corejs .= '
                   <!--Core JS Files-->
            
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
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src=" ' . $this->baseUrl("assets/js/jquery.bootstrap.wizard.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/bootstrap-table.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/fullcalendar.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/paper-dashboard.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/jquery.sharrre.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("assets/js/demo.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("../tc-merchant-template/plugins/dropzone-master/dist/min/dropzone.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("../tc-merchant-template/plugins/stepformwizard/assets/js/tsf-wizard-plugin.js") . '" type="text/javascript"></script>
                   ';
        
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
    
    private function barcodeJs() {
        $corejs = '';
        $corejs .= '
                   <!--barcode JS Files-->
        <script src="' . $this->baseUrl("assets/js/barcode/jquery-barcode.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/barcode/jquery-barcode.min.js") . '" type="text/javascript"></script>
       
         ';

        return $corejs;
    }

    /*     * ***********Core Js end Here************ */

    
    private function loaderJs(){
        $loader = '';
        $loader .= '<script type="text/javascript" src=" ' .$this->baseUrl("assets/js/loader.js"). ' "></script>';
        
        return $loader;
    }
    
    
    private function notificationJs() {
        $notifyJs = "";
        $notifyJs .= '<script type="text/javascript" src=" ' . $this->baseUrl("assets/js/angular-growl.min.js") . ' "></script>';

        return $notifyJs;
    }
    

    /*     * ***********Angular LIBRARY Js  start Here************ */

//    private function angularJs() {
//        $angularJslibs = '';
//        $angularJslibs .= ' 
//                           <!--Angular LIBRARY Js--->
//        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>
//                          ';
//        return $angularJslibs;
//    }
//    /*     * ***********Angular LIBRARY Js End Here************ */
//    
//    
//    /* Angular Bootstrap Js start */
//    private function angularBootstrapJs() {
//        $bootangularJslibs = '';
//        $bootangularJslibs .= '
//                              <!--Angular Bootstrap Js-->
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap-tpls.min.js"></script>
//        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.3/ui-bootstrap.min.js"></script>
//        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
//                              ';
//        return $bootangularJslibs;
//    }
//    /* Angular Bootstrap Js end */
//    

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

    /* Angular Private Function Start Here */

    private function dashboardAngular() {
        $dAngular = '';
        $dAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $dAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/dashboardController.js") . '"></script> ';

        return $dAngular;
    }

    private function userProfileAngular() {
        $upAngular = '';
        $upAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $upAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/userProfileController.js") . '"></script> ';

        return $upAngular;
    }

    private function userOrderAngular() {
        $upAngular = '';
        $upAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $upAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/orderController.js") . '"></script> ';

        return $upAngular;
    }

    private function userPaidOrderAngular() {
        $poAngular = '';
        $poAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $poAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/paidOrderController.js") . '"></script> ';

        return $poAngular;
    }

    private function userPanddingOrderAngular() {
        $paoAngular = '';
        $paoAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $paoAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/panddingOrderController.js") . '"></script> ';

        return $paoAngular;
    }

    private function userOrderTicketAngular() {
        $otAngular = '';
        $otAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $otAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/orderTicketController.js") . '"></script> ';

        return $otAngular;
    }

    private function userWishlistAngular() {
        $uWLAngular = '';
        $uWLAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $uWLAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/wishlistController.js") . '"></script> ';

        return $uWLAngular;
    }

    private function userAddressAngular() {
        $uAdAngular = '';
        $uAdAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $uAdAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/addressController.js") . '"></script> ';

        return $uAdAngular;
    } 

    private function editProfileAngular() {
        $uAdAngular = '';
        $uAdAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $uAdAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/editProfileController.js") . '"></script> ';

        return $uAdAngular;
    }
    
    private function editPasswordAngular() {
        $uepassAngular = '';
        $uepassAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $uepassAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/editPasswordController.js") . '"></script> ';

        return $uepassAngular;
    }

    private function user_cartAngular() {
        $uCAngular = '';
        $uCAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $uCAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/userCartController.js") . '"></script> ';

        return $uCAngular;
    }

    private function user_loginAngular() {
        $ulAngular = '';
        $ulAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $ulAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/userLoginController.js") . '"></script> ';

        return $ulAngular;
    }

    private function user_registerAngular() {
        $urAngular = '';
        $urAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $urAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/userRegisterController.js") . '"></script> ';

        return $urAngular;
    }
    
    private function user_profile_imageAngular() {
        $upiAngular = '';
        $upiAngular .= ' <script src="' . $this->baseUrl("../angularJs/uapp.js") . '"></script> ';
        $upiAngular .= ' <script src="' . $this->baseUrl("../angularJs/userScripts/userProfileImageController.js") . '"></script> ';
        return $upiAngular;
    }

    /* Angular Private Function End Here */





    /* Base URL start */

//    public function baseUrl($suffix = ''){
//        $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
//        
//        if($_SERVER['HTTP_HOST'] == "localhost"){
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchai_aj/user_dashboard/";
//            
//        }elseif($_SERVER['HTTP_HOST'] == "192.168.1.48"){
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchai_aj/user_dashboard/";
//        }else{
//            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "";
//        }
//        
//        $suffix = ltrim($suffix, '/');
//        return $web_root . trim($suffix);
//    }


    //public function baseUrl($suffix = '') {
        //$protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
//$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
        //if ($_SERVER['HTTP_HOST'] == "localhost") {
          //  $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/user_dashboard/";
        //} elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
           // $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/user_dashboard/";
       // } elseif ($_SERVER['HTTP_HOST'] == "ticketchai.org" && $_SERVER['HTTP_HOST'] == "ticketchai.com" && $_SERVER['HTTP_HOST'] == //"https://ticketchai.comhttpticketchai.org") {
           // $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/user_dashboard/";
       // }
       // else {
        //    $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/";
       // }

      //  $suffix = ltrim($suffix, '/');
      //  return $web_root . trim($suffix);
  //  }
    
    
    
    
    public function baseUrl($suffix = '') {
        $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
//$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/user_dashboard/";
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/user_dashboard/";
        } 
         elseif ($_SERVER['HTTP_HOST'] == "ticketchai.org" || $_SERVER['HTTP_HOST'] == "https://ticketchai.com" || $_SERVER['HTTP_HOST'] == "http://ticketchai.com/" ) {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/user_dashboard/";
        }else {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/user_dashboard/";
        }

        $suffix = ltrim($suffix, '/');
        return $web_root . trim($suffix);
    }
    
    

    /* Base URL end */
}

/* * *****************./End****************** */
?>