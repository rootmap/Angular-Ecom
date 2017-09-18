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

    /*///////////////////////////*/
    
    public function headCss($array = array()) {
        if (!empty($array)) {
            if (in_array($array, "home")) {
                $css = '';
                $css .=$this->SiteBasicCss();
                $css .=$this->owlCss();
                return $css;
            }
            elseif(in_array($array, "bus")) {
                $css = '';
                $css .=$this->SiteBasicCss();
                $css .=$this->bus_tctCss();
                return $css;
            }
            elseif(in_array($array, "cart")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->cartCss();
                return $css;
            }
            elseif(in_array($array, "checkout1")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->checkout1Css();
                return $css;
            }
            elseif(in_array($array, "checkout3")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->checkout3Css();
                return $css;
            }
            elseif(in_array($array, "contactPage")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->contactPageCss();
                return $css;
            }
            elseif(in_array($array, "eventTickets")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->eventTickets();
                return $css;
            }
            elseif(in_array($array, "events")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->events();
                return $css;
            }
            elseif(in_array($array, "movies")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->owlCss();
                return $css;
            }
            elseif(in_array($array, "moviesPurchase")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->owlCss();
                return $css;
            }
            elseif(in_array($array, "order")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->orderCss();
                return $css;
            }
            elseif(in_array($array, "orderAdd")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->orderCss();
                return $css;
            }
            elseif(in_array($array, "orderDashboard")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->orderCss();
                return $css;
            }
            elseif(in_array($array, "orderFavorite")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->orderCss();
                return $css;
            }
            elseif(in_array($array, "resetPassword")){
                $css = '';
                $css .= $this->SiteBasicCss();
                return $css;
            }
            elseif(in_array($array, "signin")){
                $css = '';
                $css .= $this->SiteBasicCss();
                return $css;
            }
            elseif(in_array($array, "signup")){
                $css = '';
                $css .= $this->SiteBasicCss();
                return $css;
            }
            elseif(in_array($array, "subscribe_newsletter")){
                $css = '';
                $css .= $this->SiteBasicCss();
                return $css;
            }
            elseif(in_array($array, "unsubscribe_newsletter")){
                $css = '';
                $css .= $this->SiteBasicCss();
                return $css;
            }
            elseif(in_array($array, "sitemap")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->sitemap();
                return $css;
            }
            elseif(in_array($array, "sitemapBuy")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->sitemap();
                return $css;
            }
            elseif(in_array($array, "sitemapCustomarSupport")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->sitemap();
                return $css;
            }
            elseif(in_array($array, "sitemapSponsor")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->sitemap();
                return $css;
            }
            elseif(in_array($array, "sitemapTerms")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->sitemap();
                return $css;
            }
            elseif(in_array($array, "wishList")){
                $css = '';
                $css .= $this->SiteBasicCss();
                $css .= $this->wishlistCss();
                return $css;
            }
            
        } else { 
            return $this->SiteBasicCss();
        }
    }

    public function fotterJs($array = array()) {
        if (!empty($array)) {
            if (in_array($array, "home")) {
                $js='';
                $js .=$this->SiteBasicJs();
                $js .=$this->bootstrapdatePickerJs();
                $js .=$this->crossOverJs();
                return $js;
            } elseif(in_array($array, "bus")) {
                $css = '';
                $css .=$this->SiteBasicJs();
                $css .=$this->bus_tctJs();
                return $css;
            }elseif(in_array($array, "bus")) {
                $css = '';
                $css .=$this->SiteBasicJs();
                $css .=$this->bus_tctJs();
                return $css;
            }
        } 
    }

    /*///////////////////////////*/
    
    /*///////////////////////////*/
    
    private function SiteBasicCss() {
        $basiccss = '';
        $basiccss .=$this->coreCss();
        $basiccss .=$this->siteFonts();
        $basiccss .=$this->otherCss();
        return $basiccss;
    }

    private function SiteBasicJs() {
        $basicjs = '';
        $basicjs .=$this->coreJs();
        $basicjs .=$this->materialkitJs();
        return $basicjs;
    }

    /*///////////////////////////*/
    
    
    /*///////////////////////////*/
    
    private function siteFonts() {
        $fontcss = '';
        $fontcss .='<!-- Fonts and icons -->
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/icon.css") . '" />
        <link rel="stylesheet" type="text/css" href="' . $this->baseUrl("assets/css/fonts.css") . '" />
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/fontello-2910d963/css/fontello.css") . '" />
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/font-awesome-4.6.3/css/font-awesome.min.css") . '" />
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/pe-icon-7-stroke.css") . '" />';

        return $fontcss;
    }

    private function coreCss() {
        $corecss = '';
        $corecss .= ' <!-- CSS Files -->
        <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/normalize.css") . ' ">
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/bootstrap.min.css") . '"/>
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/material-kit.css") . '"/>
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/animate.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/link-effects.css") . '">
        
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/mdb/css/mdb.min62d0.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/Simple-Background-Carousel-Plugin-with-jQuery-and-Animate-css-Crosscover/dist/css/crosscover.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/x-hipster-as-f-cards-v1.1/assets/css/hipster_cards.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/Waves-master/dist/waves.min.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/odometer-master/odometer-theme-default.css") . '"> 
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/bootstrap-social-gh-pages/bootstrap-social.css") . '"> 
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/bootstrap-select-1.10.0/dist/css/bootstrap-select.css") . '"> 
        
        ';
        
        return $corecss;
        
    }
    
    
/*///////////////////////////*/
    
/*///////////////////////////*/
    
    private function otherCss() {
        $otherCss = '';
        $otherCss .= '
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/demo.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/fontello-codes.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/fontello-embedded.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/fontello-ie7-codes.css") . '"> 
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/fontello-ie7.css") . '"> 
        <link rel="stylesheet" href="' . $this->baseUrl("assets/css/fontello.css") . '">';
        return $otherCss;
    }

    private function eventTicketsCss() {
        $eventTicketsCss = "";
        $eventTicketsCss .= '    
                <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/eventTickets.css") . ' ">
                <link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/mediaQuery.css") . ' ">    
                 ';
        return $eventTicketsCss;
    }

    private function bus_tctCss() {
        $bus_tctCss = '';
        $bus_tctCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/bus_tct.css") . ' ">';
        return $bus_tctCss;
    }

//    private function checkout1Css() {
//        $checkout1Css = '';
//        $checkout1Css .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/checkout1.css") . ' ">';
//        return $checkout1Css;
//    }

//    private function checkout3Css() {
//        $checkout3Css = '';
//        $checkout3Css .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/checkout3.css") . ' ">';
//        return $checkout3Css;
//    }

    private function moviesCss() {
        $moviesCss = '';
        $moviesCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/movies.css") . ' ">';
        return $moviesCss;
    }

    private function sitemapCss() {
        $sitemapCss = '';
        $sitemapCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/sitemap.css") . ' ">';
        return $sitemapCss;
    }

    private function orderCss() {
        $orderCss = '';
        $orderCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/order.css") . ' ">';
        return $orderCss;
    }

    private function wishlistCss() {
        $wishlistCss = '';
        $wishlistCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/wishlist.css") . ' ">';
        return $wishlistCss;
    }

    private function owlCss() {
        $owlcss = '';
        $owlcss .=' <!-- For Owl Carousel -->
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/owl.carousel/owl-carousel/owl.carousel.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/owl.carousel/owl-carousel/owl.theme.css") . '">
        <link rel="stylesheet" href="' . $this->baseUrl("plugins/owl.carousel/owl-carousel/owl.transitions.css") . '">';
        return $owlcss;
    }
    private function cartCss() {
        $cartCss = '';
        $cartCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/cart.css") . ' ">';
        return $cartCss;
    }
    private function checkout3Css() {
        $checkout3Css = '';
        $checkout3Css .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/checkout3.css") . ' ">';
        return $checkout3Css;
    }
    private function contactPageCss() {
        $contactPageCss = '';
        $contactPageCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/contactPage.css") . ' ">';
        return $contactPageCss;
    }
    private function checkout1Css() {
        $checkout1Css = '';
        $checkout1Css .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/checkout1.css") . ' ">';
        return $checkout1Css;
    }
    private function eventTickets() {
        $eventTicketsCss = '';
        $eventTicketsCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/eventTickets.css") . ' ">';
        return $eventTicketsCss;
    }
    private function events() {
        $eventTicketsCss = '';
        $eventTicketsCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/events.css") . ' ">';
        return $eventTicketsCss;
    }
    private function sitemap() {
        $eventTicketsCss = '';
        $eventTicketsCss .= '<link rel="stylesheet" href=" ' . $this->baseUrl("assets/css/sitemap.css") . ' ">';
        return $eventTicketsCss;
    }
    
    private function notificationCss(){
        $notific = "";
        $notific .= ' <link rel="stylesheet" href=" '. $this->baseUrl("assets/css/angular-growl.min.css") .' "> ';
        
        return $notific;
    }
    
    
/*///////////////////////////*/
    
/*///////////////////////////*/
    
    private function cardJs() {
        $cardjs = '';
        $cardjs = '<!--Card sector Js -->  
        <script src="' . $this->baseUrl("plugins/x-hipster-as-f-cards-v1.1/assets/js/hipster-cards.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("plugins/Waves-master/dist/waves.min.js") . '" type="text/javascript"></script>
        <script src=" ' . $this->baseUrl("plugins/odometer-master/odometer.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("plugins/WOW-master/dist/wow.min.js") . '" type="text/javascript"></script>';
        return $cardjs;
    }

    private function crosscoverJs() {
        $crosscoverjs = '';
        $crosscoverjs = ' <!-- Crosscoverjs-->    
        <script src="' . $this->baseUrl("plugins/Simple-Background-Carousel-Plugin-with-jQuery-and-Animate-css-Crosscover/dist/js/crosscover.js") . '" charset="utf-8"></script>';
        return $crosscoverjs;
    }

    private function materialkitJs() {
        $materialkitjs = '';
        $materialkitjs = ' <!-- material-kit js-->    
        <script src="' . $this->baseUrl("assets/js/material-kit.js") . '" type="text/javascript"></script>';
        return $materialkitjs;
    }

    private function bootstrapdatePickerJs() {
        $bootstrapdatepickerjs = '';
        $bootstrapdatepickerjs = '<!--Bootstrap Date Picker -->  
        <script src="' . $this->baseUrl("assets/js/bootstrap-datepicker.js") . '" type="text/javascript"></script>';
        return $bootstrapdatepickerjs;
    }

    private function coreJs() {
        $corejs = '';
        $corejs .= '<!--Core JS Files-->
        <script src="' . $this->baseUrl("assets/js/jquery.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/bootstrap.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/bootstrap-hover-dropdown.min.js") . '" type="text/javascript"></script>
        <script src="' . $this->baseUrl("assets/js/material.min.js") . '"></script>
        <script src="' . $this->baseUrl("assets/js/nouislider.min") . '"></script>
        <script src="' . $this->baseUrl("plugins/mdb/js/mdb.min.js") . '"></script>
        <script src="' . $this->baseUrl("plugins/mdb/js/tether.min.js") . '"></script>';

        return $corejs;
    }

    private function crossOverJs() {
        $meta = "";
        $meta .= '<!-- Crosscoverjs-->    
                  <script src="' . $this->baseUrl("plugins/Simple-Background-Carousel-Plugin-with-jQuery-and-Animate-css-Crosscover/dist/js/crosscover.js") . '" charset="utf-8"></script>';
        $meta .="<script>
                $(document).on('ready', function () {
                        $('.crosscover').crosscover({
                            dotsNav: false
                        });
                    });
                </script>";
        return $meta;
    }

    private function OwlcarouselJs() {
        $Owlcarouseljs = '';
        $Owlcarouseljs.='<!-- For Owl Carousel Js --><script src="' . $this->baseUrl("plugins/owl.carousel/owl-carousel/owl.carousel.min.js") . '" type="text/javascript"></script>';
        return $Owlcarouseljs;
    }
      private function bus_tctJs() {
        $bus_tctJs = '';
        $bus_tctJs .= '<link rel="stylesheet" href=" ' . $this->baseUrl("plugins/FlipClock-master/compiled/jquery.min.js") . ' ">';
        return $bus_tctJs;
    }
    
    
    
    private function notificationJs() {
        $notifyJs = "";
        $notifyJs .= '<script type="text/javascript" src=" '. $this->baseUrl("assets/js/angular-growl.min.js") .' "></script>';
        
        return $notifyJs;
    }
    
    
    

    private function baseUrl($suffix = '') {
        $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
        //$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/";
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/ticketchai_aj/";
        } else {
            $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/";
        }

        $suffix = ltrim($suffix, '/');
        return $web_root . trim($suffix);
    }

}
