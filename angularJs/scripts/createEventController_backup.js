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
            $scope.imagecover = null;
            $scope.imagethumble = null;

            $scope.evtname = "";

            $scope.opened = [];
            $scope.open = function (index) {
                $timeout(function () {
                    $scope.opened[index] = true;
                });
            };


            $scope.InitDate = function () {
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


            }

            $scope.InitTime = function ()
            {
                $('.timepicker1').datetimepicker({
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

                });
            }


            $scope.createNewEvtLink = function (addEvent)
            {
                $scope.boundString = addEvent.EventName;
                $scope.evtname = $scope.boundString.replace(/ /g, '').toLowerCase();
                addEvent.EventURL = $scope.evtname;


                console.log(addEvent.EventURL);

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
                }
                else
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
                $http.get("./php/controller/eventSubCategoryController.php").success(function (data, status, heards, config) {
                    $scope.eventsubcategorydata = data;
                    console.log(data);
                });
            }

            $scope.loadSubCategoryList();

            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY END


            //CREATE FUNCTION TO LOAD subcategory DATA AUTOMATICALLY START
            $scope.loadEventTypeList = function () {
                $http.get("./php/controller/eventTypeController.php").success(function (data, status, heards, config) {
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
                }
                else
                {
                    $scope.SWCatID = addEvent.EventSubCategory;
                }

                if ($scope.NewSWCatID != '' && addEvent.EventSubCategory == '0')
                {
                    $scope.SWCatID = $scope.NewSWCatID;
                }
                else
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
                                }
                                else if (data == 2)
                                {
                                    growl.error("Failed, Please Try Again", {title: ' '});
                                }
                                else
                                {
                                    console.log(data);
                                }
                            });
                }
                else
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

            $scope.clearCover = function ()
            {
                $scope.imagecover = '';
                $scope.goCats = false;
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

            $scope.clearCover = function ()
            {
                $scope.imagecover = '';
                $scope.goCats = false;
                console.log('Function Working');
            }

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
                        growl.success("Deleted Successfully", {title: ' '});
                        //TO LOAD LIST DATA AUTOMATICALLY START
                        $scope.eventlistdata = $scope.loadEventList();
                        //TO LOAD LIST DATA AUTOMATICALLY END
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

            $scope.evt = [];
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

            $scope.tck = [];
            $scope.tck_counter = 1;

            $scope.tckaddRow = function () {

                //$scope.rows.push($scope.counter);
                $scope.tck.push({
                    id: $scope.tck_counter,
                    rein: 'tck' + $scope.tck_counter, //data send time title show and count number show
                    tick_name: '',
                    tick_type: '',
                    tick_quantity: '0',
                    tick_price: '0',
                    tick_currency: '0',
                    tick_min_quan: '0',
                    tick_start_date: '0000-00-00',
                    tick_max_quan: '0',
                    tick_availability: '0',
                    tick_fee_from: '0'
                });
                $scope.tck_counter++;

                console.log($scope.tck);
            }


            $scope.Shawoer = function (vale)
            {
                console.log(vale);
                if (vale == true)
                {
                    vale = false;
                }
                else if (vale == false)
                {
                    vale = true;
                }
            }



            $scope.tckaddRow();


            $scope.createEventJourney = function (evt)
            {
                console.log(evt);
                console.log($scope.tags);
                console.log($scope.tck);
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

