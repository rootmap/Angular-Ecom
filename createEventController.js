/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global angular */

angular
        .module('merchantaj', ['angular-growl'])
        .directive('fileInput', function ($parse) {
            return{
                restrict: 'A',
                link: function (scope, elem, attrs) {
                    elem.bind('change', function () {
                        $parse(attrs.fileInput).assign(scope, elem[0].files);
                        scope.$apply();
                    });
                }
            }
        })

        .controller('createEventController', function ($scope, $http, $timeout, growl) {

            $scope.addEvent = [];
            $scope.evt = {};
            $scope.evt["ven_address"] = "";
            $scope.evt["ven_addresss"] = "";
            $scope.evt["ven_city"] = "";
            $scope.evt["ven_country"] = "";
            $scope.evt["ven_zip"] = "";
            $scope.evt["ven_name"] = "";
            $scope.evt["tick_desc"] = "";
            $scope.evt["tick_mess_atten"] = "";
            $scope.evt["evt_desc"] = "";
            $scope.evt["pm_gt_fee"] = "";
            $scope.evt["evt_btn_lbl"] = "";
            $scope.evt["OrganizedBy"] = "";
            $scope.evt["EventType"] = "";
            $scope.evt["EventCategory"] = "";
            $scope.evt["EventSubCategory"] = "";
            $scope.evt["newsubcat"] = "";

            $scope.evt["EventName"] = "";



            $scope.imagecover = null;
            $scope.imagethumble = null;

            $scope.evtname = "";

            $scope.opened = [];
            $scope.open = function (index) {
                $timeout(function () {
                    $scope.opened[index] = true;
                });
            };





            $scope.InitDate = function (id) {
                $('.datepicker1').datetimepicker({
                    format: 'YYYY-MM-DD', //use this format if you want the 12hours timpiecker with AM/PM toggle
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }
                });

                $("#" + id).on("dp.change", function () {
                    $scope.evt[id] = $("#" + id).val();
                    console.log($scope.evt[id]);
                });
            }
            
            $scope.InitTime = function ()
            {
                $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
                    format: 'h:mm:ss A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }

                }).on("dp.change", function () {
                    var df = $(this).val();
                    var dfmod = $(this).attr("name");
                    $scope.evt[dfmod] = df;
                    console.log($scope.evt[dfmod]);
                });
            }
            
            $scope.InitDateTicket = function () {
                $('.datepickerT').datetimepicker({
                    format: 'YYYY-MM-DD', //use this format if you want the 12hours timpiecker with AM/PM toggle
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }
                }).on("dp.change", function () {
                    var df = $(this).val();
                    var dfmod = $(this).attr("name");
                    var id = $(this).attr("id");
                    $scope.tck[id][dfmod] = df;
                    //console.log($scope.tck);
                });
            }

            $scope.InitTimeTicket = function ()
            {
                $('.timepickerT').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
                    format: 'h:mm:ss A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }

                }).on("dp.change", function () {
                    var df = $(this).val();
                    var dfmod = $(this).attr("name");
                    var id = $(this).attr("id");
                    $scope.tck[id][dfmod] = df;
                    //console.log($scope.tck);
                });
            }

            $scope.tck = [];
            $scope.tck_counter = 1;

            $scope.tckaddRow = function () {

                //$scope.rows.push($scope.counter);
                $scope.tck.push({
                    id: $scope.tck_counter,
                    rein: 'tck' + $scope.tck_counter, //data send time title show and count number show
                    stdate: 'stdate',
                    eddate: 'eddate',
                    tick_name: '',
                    tick_type: 0,
                    tick_quantity: 0,
                    tick_price: 0,
                    tick_currency: 0,
                    tick_min_quan: 0,
                    tick_start_date: '0000-00-00',
                    tick_end_date: '0000-00-00',
                    tick_start_time: '00:00:00',
                    tick_end_time: '00:00:00',
                    tick_mess_atten: '',
                    tick_max_quan: 0,
                    tick_availability: 0,
                    tick_fee_from: 0
                });
                $scope.tck_counter++;

                //console.log($scope.tck.length,"Total ITem");
            }



            $scope.RunAlways = function ()
            {

                setInterval(function () {
                    //console.log($scope.tck);
                    $scope.tclpr = 0;
                    angular.forEach($scope.tck, function (value, key) {
                        //console.log(value.tick_price);
                        $scope.tclpr += (value.tick_price - 0);
                    });


                    // console.log( $scope.tclpr);
                    if ($scope.tclpr>0 )
                    {
                        $('.h').show();
                       // $scope.tclpr;
                        //$scope.freenother='true';
                        console.log('t');
                    }
                    else{
                        $('.h').hide();
                        //$scope.tclpr;
                        // $scope.freenother ='false';
                        console.log('f');
                    }
                }, 1000);
            }

            $scope.RunAlways();

            $scope.removeTicket = function (item) {
                var lop = $scope.tck.length;
                if (lop != 1)
                {
                    var index = $scope.tck.indexOf(item);
                    $scope.tck.splice(index, 1);
                } else
                {
                    growl.error("Failed To Remove, Minimum 1 Row Required.", {title: ' '});
                }
            }

            $scope.ppl = [];
            $scope.ppl_counter = 1;
            $scope.pplloop = function ()
            {
                $scope.ppl.push({
                    id: $scope.ppl_counter,
                    point_name: '',
                    point_address: '',
                    point_contact_detail: ''
                });

                $scope.ppl_counter++;

                console.log($scope.ppl);
            }

            $scope.removepickPoint = function (item) {
                var lop = $scope.ppl.length;
                if (lop != 1)
                {
                    var index = $scope.ppl.indexOf(item);
                    $scope.ppl.splice(index, 1);
                } else
                {
                    growl.error("Failed To Remove, Minimum 1 Row Required.", {title: ' '});
                }
            }



            $scope.pickuppoint = function (fid)
            {

                //console.log(fid);
                if (fid == "Pick UP Point")
                {
                    //$(".pickupPoint").show('slow');
                    if (document.getElementById('offlinePayment1').checked == true)
                    {
                        $(".pickupPoint").show('slow');
                    } else if (document.getElementById('offlinePayment1').checked == false)
                    {
                        $(".pickupPoint").show('slow');
                    }

                }
            }

            $scope.CheckLinkRouting = function (df) {
                if (df >= 1)
                {
                    $http.get("./php/controller/RouteVerifyController.php").success(function (data, status, heards, config) {
                        if (data == 1)
                        {
                            $scope.RouteData = data;
                            console.log(data);
                        } else if (data == 2)
                        {
                            growl.error("Invalid Link Already Exists, Please Try Another Name on link.", {title: ' '});
                        }
                    });
                }
            }


            
            $scope.mtt = "";
            $scope.merchantTicketTypes = function ()
            {
                $http.get("./php/controller/merchantTicketController.php").success(function (data) {
                    console.log(data);
                    $scope.mtt = data;
                });
            }

            $scope.merchantTicketTypes();

            $scope.EventTypeAllocate = function (evt)
            {
                console.log(evt.EventType);
                if (evt.EventType == 5)
                {
                    $scope.freenother = true;
                    $scope.evt['evt_btn_lbl'] = 3;
                    $scope.evt['pm_gt_fee'] = 0;
                }
                //evt.EventType
            }

            $scope.EventURLStatus = "Check Aavailability";

            $scope.createNewEvtLink = function (addEvent)
            {
                $scope.boundString = addEvent.EventName;
                $scope.evtname = $scope.boundString.replace(/ /g, '').toLowerCase();
                addEvent.EventURL = $scope.evtname;

                $scope.EventURLStatus = "Processing...";
                if (addEvent.EventURL != null)
                {
                    $http.post("./php/controller/validateURLController.php", {'urm': $scope.evtname}).success(function (data) {
                        if (data == 1)
                        {
                            $scope.EventURLStatus = "Success, Valid URL";
                        } else
                        {
                            $scope.EventURLStatus = "Failed, Invalid URL.";
                        }
                        //console.log(data);
                    });
                }
            }

            $scope.createNewEvtLinkCus = function (addEvent)
            {
                $scope.boundString = addEvent.EventURL;
                $scope.tempname = $scope.boundString.replace(/ /g, '').toLowerCase();
                addEvent.EventURL = $scope.tempname;

                $scope.EventURLStatus = "Processing...";
                if (addEvent.EventURL != null)
                {
                    $http.post("./php/controller/validateURLController.php", {'urm': $scope.tempname}).success(function (data) {
                        if (data == 1)
                        {
                            $scope.EventURLStatus = "Success, Valid URL";
                        } else
                        {
                            $scope.EventURLStatus = "Failed, Invalid URL.";
                        }
                        //console.log(data);
                    });
                }
            }

            $scope.myFunc = function ()
            {
                console.log(this.keycode);
            }


            $scope.checkNewSub = function (newsubst)
            {
                if (newsubst == 0)
                {
                    $scope.newsubcat = true;
                } else
                {
                    $scope.newsubcat = false;
                }
            }
            
            //CREATE FUNCTION TO LOAD category DATA AUTOMATICALLY START
            $scope.loadCategoryList = function () {
                $http.get("./php/controller/eventCategoryController.php").success(function (data, status, heards, config) {
                    $scope.eventcategorydata = data;
                    console.log(data);
                });
            }

            $scope.loadCategoryList();

            //CREATE FUNCTION TO LOAD category DATA AUTOMATICALLY END

            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY START
            $scope.loadSubCategoryList = function () {
                $http.post("./php/controller/eventSubCategoryController.php").success(function (data, status, heards, config) {
                    $scope.eventsubcategorydata = data;
                    console.log(data);
                });
            }

            $scope.loadSubCategoryList();

            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY END


            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY START
            $scope.loadEventTypeList = function () {
                $http.post("./php/controller/eventTypeController.php").success(function (data, status, heards, config) {
                    $scope.eventtypedata = data;
                    console.log(data);
                });
            }

            $scope.loadEventTypeList();



            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY END


            $scope.createEvent = function (addEvent) {

                //date start here
                $scope.StartDate = $("#start-date").val();
                $scope.EndDate = $("#end-date").val();
                //date end here

                //time start here
                $scope.StartTime = $("#start-time").val();
                $scope.EndTime = $("#end-time").val();
                //time end here

//                console.log($scope.StartDate,$scope.EndDate,$scope.StartTime,$scope.EndTime);
                //console.log(addEvent);

                $scope.NewSWCatID = '';

                if (addEvent.EventSubCategory == 0 && addEvent.newsubcat != '')
                {
                    console.log(addEvent.newsubcat);
                    $http.post("./php/controller/createEventNewSubCatController.php", {'name': addEvent.newsubcat, 'parent': addEvent.EventCategory}).success(function (data, status, heards, config) {
                        console.log(data);
                        if (data != '')
                        {
                            $scope.NewSWCatID = data;
                        }
                    });
                } else
                {
                    $scope.SWCatID = addEvent.EventSubCategory;
                }

                if ($scope.NewSWCatID != '' && addEvent.EventSubCategory == '0')
                {
                    $scope.SWCatID = $scope.NewSWCatID;
                } else
                {
                    $scope.SWCatID = $scope.SWCatID
                }

                console.log($scope.SWCatID);

                if ($scope.imagecover != null && $scope.imagethumble != null)//Image uploaded condition stsrt here
                {

                    $http.post("./php/controller/createEventController.php", {'EventName': addEvent.EventName, 'EventURL': addEvent.EventURL,
                        'EventCategory': addEvent.EventCategory, 'EventSubCategory': $scope.SWCatID, 'EventType': addEvent.EventType,
                        'OrganizedBy': addEvent.OrganizedBy, 'StartDate': $scope.StartDate, 'StartTime': $scope.StartTime, 'EndDate': $scope.EndDate, 'EndTime': $scope.EndTime,
                        'NameOfVenue': addEvent.NameOfVenue, 'StreetLine1': addEvent.StreetLine1, 'StreetLine2': addEvent.StreetLine2, 'CityFrom': addEvent.CityFrom, 'CountryFiled': addEvent.CountryFiled,
                        'EventDescription': addEvent.EventDescription, 'EventTags': addEvent.EventTags, 'PaymentGatewayAndServiceCharge': addEvent.PaymentGatewayAndServiceCharge, 'ChangetheLabel': addEvent.ChangetheLabel,
                        'cover': $scope.imagecover, 'card': $scope.imagethumble})
                            .success(function (data, status, heards, config) {
                                //console.log(data);
                                if (data == 1)
                                {
                                    growl.success("Insert Value Submit successfully", {title: ' '});
                                    window.location.href = "event_list.php";
                                } else if (data == 2)
                                {
                                    growl.error("Failed, Please Try Again", {title: ' '});
                                } else
                                {
                                    console.log(data);
                                }
                            });
                } else
                {
                    growl.info("Please Select A Cover/Card Image/Photo", {title: ' '});
                }
            }


//            $scope.openexpo = function () {
//                $("#upload").click();
//            }

            $scope.imageUpload = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded;
                reader.readAsDataURL(file);
            }

            $scope.imageIsLoaded = function (e) {
                $scope.$apply(function () {
                    $scope.goCats = true;
                    $scope.step = e.target.result;
                    $scope.imagecover = e.target.result;
                });
            }

            $scope.clearCover =function ()
            {
                console.log('Function Working');
                $scope.goCats = false;
                $scope.imagecover = '';
            }


            $scope.imageUpload_thumble = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded_thumble;
                reader.readAsDataURL(file);
            }

            $scope.imageIsLoaded_thumble = function (e) {
                $scope.$apply(function () {
                    $scope.goCats_thumble = true;
                    $scope.step_thumble = e.target.result;
                    $scope.imagethumble = e.target.result;
                });
            }

//            $scope.clearCover = function ()
//            {
//                $scope.imagecover = '';
//                $scope.goCats = false;
//                console.log('Function Working');
//            }

            $scope.clearThumble = function ()
            {
                $scope.imagethumble = '';
                $scope.goCats_thumble = false;
            }

            $scope.upload = function () {
//                var name = $scope.name;
                var fd = new FormData();
                angular.forEach($scope.files, function (file) {
                    fd.append('file', file);
                });

                var request = $http({
                    method: 'POST',
                    url: './php/controller/createEventController.php',
                    data: fd,
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}

                });
                request.then(function (data, status, headers, config) {

                    growl.success("Insert Successfully", {title: ' '});
                    // $scope.alert();
                }, function (error) {
                    $scope.msg = error.data;
//                     growl.error("Insert Value Submit successfully", {title: ' '});
                    //$scope.alert();
                });
            }
//     $scope.alert = function(){
//		$scope.showMsg = true;
//		$timeout(function() {
//			$scope.showMsg = false;
//		}, 3000); 
//	}




            //CREATE FUNCTION TO LOAD LIST DATA AUTOMATICALLY START
            $scope.loadEventList = function () {
                $http.post("./php/controller/eventListController.php", {'event_id': 1}).success(function (data, status, heards, config) {
                    $scope.eventlistdata = data;
                    console.log(data);
                });
            }
            //CREATE FUNCTION TO LOAD LIST DATA AUTOMATICALLY END




            //TO LOAD LIST DATA AUTOMATICALLY START
            //$scope.loadEventList();
            //TO LOAD LIST DATA AUTOMATICALLY END 


            // DELETE FUNCTION WORKING START HERE
            $scope.Deleteventlist = function (eventlist) {
                $http.post("./php/controller/eventListDeleteController.php", {'event_id': eventlist}).success(function (data, status, heards, config) {
                    //$scope.companyData=data;
                    if (data == 1)
                    {
                        //TO LOAD LIST DATA AUTOMATICALLY START
                        $scope.eventlistdata = $scope.loadEventList();
                        //TO LOAD LIST DATA AUTOMATICALLY END
                        growl.success("Deleted Successfully", {title: ' '});

                    } else
                    {
                        growl.error("Failed To Deleted", {title: ' '});
                    }
                });

            }// DELETE FUNCTION WORKING END HERE


            //EDIT FUNCTIONS START HERE
            $scope.eventEditFunction = function (eventlist) {
                $http.post("./php/controller/eventListEditController.php", {'event_id': eventlist}).success(function (data, status, heards, config) {
                    $scope.eventlistdata = data;

                    $scope.addEvent.EventName = data[0].event_title;
                    $scope.addEvent.EventURL = data[0].event_url;
                    $scope.addEvent.EventCategory = data[0].event_category_id;
                    $scope.addEvent.EventSubCategory = data[0].eventSub_category;
                    $scope.addEvent.EventType = data[0].event_type;
                    $scope.addEvent.OrganizedBy = data[0].organized_by;
                    $scope.addEvent.StartDate = data[0].event_created_on;
                    $scope.addEvent.StartTime = data[0].event_created_on;
                    $scope.addEvent.EndDate = data[0].event_created_end;
                    $scope.addEvent.EndTime = data[0].event_created_end;

                    $scope.addEvent.NameOfVenue = data[0].name_of_venue;
                    $scope.addEvent.StreetLine1 = data[0].streetLine1;
                    $scope.addEvent.StreetLine2 = data[0].streetLine2;
                    $scope.addEvent.CityFrom = data[0].city_from;
                    $scope.addEvent.CountryFiled = data[0].country_filed;
                    $scope.addEvent.EventDescription = data[0].event_description;
                    $scope.addEvent.EventTags = data[0].event_tag;
                    $scope.addEvent.PaymentGatewayAndServiceCharge = data[0].payment_servicecge;
                    $scope.addEvent.ChangetheLabel = data[0].change_Label;
//                    $scope.addEvent.EventTags= data[0].event_tag;
//                    $scope.addEvent.EventTags= data[0].event_tag;





//                    $("#eventNameEdit").val($scope.eventlistdata[0].event_title);
//                    $("#EventCategoryEdit").val($scope.eventlistdata[0].event_category_id);
//                    $("#EventTypeEdit").val($scope.eventlistdata[0].event_type);
//                    $("#OrganizedByEdit").val($scope.eventlistdata[0].organized_by);
//                    $("#eventNameEdit").val($scope.eventlistdata[0].event_title);
//                    $("#StartDateEdit").val($scope.eventlistdata[0].event_created_on);
//                    $("#EndDateEdit").val($scope.eventlistdata[0].event_created_end);

                });
            }  //EDIT FUNCTIONS START HERE


            $scope.loadEventpayment = function () {
                $http.post("./php/controller/paymentMethodAllname.php").success(function (data, status, heards, config) {
                    //creating new array for ind payment method
                    $scope.pmrows = [];

                    //extracting data for name and id and create st/status
                    angular.forEach(data, function (value, key) {
                        $scope.pmrows.push({
                            check_namest: '0',
                            check_name_ID: value.id,
                            check_name: value.name,
                            check_t_c: value.terms_and_conditions,
                            check_box: 'false'
                        });
                        console.log(value.name);
                    });
                    //creating new array for ind payment method

                });
            }

            $scope.loadEventpayment();

            $scope.loadEventOfflinepayment = function () {
                $http.post("./php/controller/offlinePaymentList.php").success(function (data, status, heards, config) {
                    //creating new array for ind payment method
                    $scope.off_pmrows = [];

                    //extracting data for name and id and create st/status
                    angular.forEach(data, function (value, key) {
                        $scope.off_pmrows.push({
                            off_check_namest: '0',
                            off_check_name_ID: value.id,
                            off_check_name: value.name,
                            off_check_t_c: value.terms_and_conditions,
                            off_check_box: 'false'
                        });
                        console.log(value.name);
                    });
                    //creating new array for ind payment method

                });
            }

            $scope.loadEventOfflinepayment();


            $scope.tags = [];

            $scope.eventtag = function (tag)
            {
                //console.log(tag);
                $scope.tags.push({
                    'tag': tag
                });

                console.log($scope.tags);
            }

            $scope.removetagfrmar = function (tage)
            {
                for (var i = $scope.tags.length - 1; i >= 0; i--) {
                    if ($scope.tags[i].tag == tage) {
                        $scope.tags.splice(i, 1);
                    }
                }
                $scope.tags.shift();
                console.log($scope.tags);
            }




            $scope.Shawoer = function (vale)
            {
                console.log(vale);
                if (vale == true)
                {
                    vale = false;
                } else if (vale == false)
                {
                    vale = true;
                }
            }


            //CREATE FUNCTION TO LOAD currency DATA AUTOMATICALLY START
            $scope.LoadCurrency = function () {
                $http.post('./php/controller/eventCurrencyListController.php').success(function (data, status, heards, config) {
                    $scope.LoadCurrency = data;
                    //console.log(data);
                });
            }
            $scope.LoadCurrency();

            $scope.LoadPaymentGateway = function () {
                $http.post('./php/controller/paymentGatewayController.php').success(function (data, status, heards, config) {
                    $scope.LoadPaymentGateway = data;
                    //console.log(data);
                });
            }
            $scope.LoadPaymentGateway();

            $scope.LoadEventButton = function () {
                $http.post('./php/controller/eventbuttonlistController.php').success(function (data, status, heards, config) {
                    $scope.LoadEventButton = data;
                    //console.log(data);
                });
            }
            $scope.LoadEventButton();
            
            
            $scope.LoadEventDefaultImage= function () {
                $http.post('./php/controller/eventDefaultImageController.php').success(function (data, status, heards, config) {
                    $scope.LoadEventDefaultImage = data;
                    console.log(data);
                });
            }
            $scope.LoadEventDefaultImage();


            $scope.tckaddRow();

            // CREATE EVENT JOUNNEY FUNCTION START HARE

            $scope.createEventJourney = function (evt)
            {
                // console.log($scope.imageOne);
                // console.log($scope.imageTwo);
                //console.log($scope.off_pmrows);
                //console.log($scope.tags);
                //console.log($scope.ppl);
                if ($scope.imageOne != null && $scope.imageTwo != null) {
                    $http.post('./php/controller/createEventJourneycontroller.php', {'event': evt, 'ticket': $scope.tck, 'tags': $scope.tags, imageOne: $scope.imageOne, imageTwo: $scope.imageTwo, paymentMethod: $scope.pmrows, offlinePaymentMethod: $scope.off_pmrows, pick_point: $scope.ppl}).success(function (data, status, heards, config) {
                        //$scope.result=data.response;
                        $scope.result = data;
                        console.log($scope.result);
                        if ($scope.result > 0) {
                            growl.success("Event Create Successfully Completed.", {title: ' '});
                            setTimeout(function () {
                                growl.info("Redirecting page.....", {title: ' '});
                            }, 1500);
                            setTimeout(function () {
                                window.location.href = "add_questions.php?eventId=" + data;
                            }, 3000);
                        } else
                        {
                            growl.error("Failed, Create event.", {title: ' '});
                        }
                    });
                } else
                {
                    growl.info("Please Select A Cover/Card Image/Photo", {title: ' '});
                }
            }

            $scope.imageUploadJourney = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoadedJourney;
                reader.readAsDataURL(file);
            }

            $scope.imageIsLoadedJourney = function (e) {
                $scope.$apply(function () {
                    $scope.previewOne = true;
                    $scope.step = e.target.result;
                    $scope.imageOne = e.target.result;
                });
            }

            $scope.clearCover = function ()
            {
                $scope.imagecover = '';
                $scope.previewOne = false;
                console.log('Function Working');
            }

            $scope.clearThumble = function ()
            {
                $scope.imagethumble = '';
                $scope.previewTwo = false;
            }
            $scope.clearCover = function ()
            {
                $scope.imagecover = '';
                $scope.previewOne = false;
            }

            $scope.imageUpload_thumbleJourney = function (event) {
                var files = event.target.files; //FileList object 
                var file = files[files.length - 1];
                $scope.file = file;
                var reader = new FileReader();
                reader.onload = $scope.imageIsLoaded_thumbleJourney;
                reader.readAsDataURL(file);
            }

            $scope.imageIsLoaded_thumbleJourney = function (e) {
                $scope.$apply(function () {
                    $scope.previewTwo = true;
                    $scope.step_thumble = e.target.result;
                    $scope.imageTwo = e.target.result;
                });
            }



            $scope.uploadJourney = function () {
                var fd = new FormData();
                angular.forEach($scope.files, function (file) {
                    fd.append('file', file);
                });

                var request = $http({
                    method: 'POST',
                    url: './php/controller/createEventJourneycontroller.php',
                    data: fd,
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}

                });
                request.then(function (data, status, headers, config) {

                    growl.success("Insert Successfully", {title: ' '});
                    // $scope.alert();
                }, function (error) {
                    $scope.msg = error.data;
//                     growl.error("Insert Value Submit successfully", {title: ' '});
                    //$scope.alert();
                });
            }

            $scope.debug = function (pmrows)
            {
                console.log(pmrows);
            }



            //Field all Title show by angular start here 
            $scope.AddEventDetails = "Add Event Details";
            $scope.Basics = "Basics";
            $scope.DateAndTime = "Date & Time";
            $scope.Location = "Location";
            $scope.Description = "Description";
            $scope.Photos = "Photos";
            $scope.ProvideYBEventDetails = "Provide Your Basic Event Details";
            $scope.EventName = "Event Name";
            $scope.EventURL = "Event URL";
            $scope.EventCategory = "Event Category";
            $scope.EventSubCategory = "Event Sub-Category";
            $scope.EventType = "Event Type";
            $scope.OrganizedBy = "Organized By";
            /**1st part end here**/

            /***2nd part start here**/
            $scope.ProvideDateAndTime = "Provide Your Event Date And Time";
            $scope.StartDate = "Start Date";
            $scope.StartTime = "Start Time";
            $scope.EndDate = "End Date";
            $scope.EndTime = "End Time";
            /***2nd part end here**/

            /***3nd part start here**/
            $scope.Venue = "Provide Your Event Location / Venue";
            $scope.EventVenue = "Event Venue";
            $scope.NameOfVenue = "Name of Venue";
            $scope.StreetLine1 = "Street Line 1";
            $scope.StreetLine2 = "Street Line 2";
            $scope.CityFrom = "City";
            $scope.CountryFiled = "Country";
            $scope.LocationMapFixed = "Location Map";
            /***3nd part start here**/

            /**4th Part strat here**/
            $scope.PurEventDescription = "Provide Your Event Description";
            $scope.EventDescription = "Event Description";
            $scope.EventTags = "Event Tags";
            $scope.PaymentGatewayAndServiceCharge = "Payment Gateway & Service Charge";
            $scope.ChangetheLabel = "Change the Label";
            $scope.UploadYourEventPhotos = "Upload Your Event Photos";
            $scope.UploadCoverImage = "Upload Cover Image";
            $scope.UploadCardImage = "Upload Card Image";
            $scope.PREV = "PREV";
            $scope.NEXT = "NEXT";
            $scope.FINISH = "FINISH";
            /**4th part End here**/

            //Field all Title show by angular End here 
        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);//controller END here

