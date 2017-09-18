/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *compile techonogy www.minifier.org/
 /* global angular */

angular.module('merchantaj', ['angular-growl']).directive('fileInput', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, elem, attrs) {
            elem.bind('change', function () {
                $parse(attrs.fileInput).assign(scope, elem[0].files);
                scope.$apply()
            })
        }
    }
}).controller('createEventController', function ($scope, $http, $timeout, growl, listEdit) {
    $scope.list = [];
    listEdit.linkList($scope.list);
    $scope.addToList = function () {
        $scope.c = $scope.list.length;
        if ($scope.c < 3) {
            $scope.feedback2 = listEdit.add($scope.todo);
            document.getElementById("todo").value = "";
            var a = $scope.list.indexOf($scope.todo)
        } else {
            growl.warning("You can add maximum 3 tags", {
                title: ' '
            })
        }
    };
    $scope.remove = function (index) {
        $scope.feedback = listEdit.remove(index)
    };
    $scope.addEvent = [];
    $scope.evt = {};
    $scope.evt.ven_address = "";
    $scope.evt.ven_addresss = "";
    $scope.evt.ven_city = "";
    $scope.evt.ven_country = "";
    $scope.evt.ven_zip = "";
    $scope.evt.ven_name = "";
    $scope.evt.tick_desc = "";
    $scope.evt.tick_mess_atten = "";
    $scope.evt.evt_desc = "";
    $scope.evt.evt_terms = "";
    $scope.evt.pm_gt_fee = "";
    $scope.evt.evt_btn_lbl = "";
    $scope.evt.OrganizedBy = "";
    $scope.evt.EventType = "";
    $scope.evt.EventCategory = "";
    $scope.evt.EventSubCategory = "";
    $scope.evt.newsubcat = "";
    $scope.evt.EventName = "";
    $scope.imagecover = null;
    $scope.imagethumble = null;
    $scope.evtname = "";
    $scope.opened = [];
    $scope.open = function (index) {
        $timeout(function () {
            $scope.opened[index] = !0
        })
    };
    $scope.InitDate = function (id) {
        $('.datepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: !0,
            minDate: 'now',
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
            $scope.evt[id] = $("#" + id).val()
        })
    }
    $scope.InitTime = function () {
        $('.timepicker').datetimepicker({
            format: 'h:mm:ss A',
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
            console.log($scope.evt[dfmod])
        })
    }
    $scope.AutoVarVal = function (id, df) {
        $scope.evt[id] = df
    }
    $scope.InitDateTicket = function () {
        $('.datepickerT').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: !0,
            minDate: 'now',
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
            $scope.tck[id][dfmod] = df
        })
    }
    $scope.InitTimeTicket = function () {
        $('.timepickerT').datetimepicker({
            format: 'h:mm:ss A',
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
            $scope.tck[id][dfmod] = df
        })
    }
    $scope.tck = [];
    $scope.tck_counter = 1;
    $scope.tckaddRow = function () {
        $scope.tck.push({
            id: $scope.tck_counter,
            rein: 'tck' + $scope.tck_counter,
            stdate: 'stdate',
            eddate: 'eddate',
            tick_name: '',
            tick_type: 0,
            tick_quantity: 0,
            tick_price: 0,
            tick_currency: 0,
            tick_min_quan: 1,
            tick_start_date: '0000-00-00',
            tick_end_date: '0000-00-00',
            tick_start_time: '00:00:00',
            tick_end_time: '00:00:00',
            tick_mess_atten: '',
            tick_max_quan: 10,
            tick_availability: 0,
            tick_fee_from: 0
        });
        $scope.tck_counter++
    }
    $scope.RunAlways = function () {
        setInterval(function () {
            $scope.tclpr = 0;
            angular.forEach($scope.tck, function (value, key) {
                $scope.tclpr += (value.tick_price - 0)
            });
            if ($scope.tclpr > 0) {
                $('.h').show();
                console.log('t')
            } else {
                $('.h').hide();
                console.log('f')
            }
        }, 1000)
    }
    $scope.RunAlways();
    $scope.removeTicket = function (item) {
        var lop = $scope.tck.length;
        if (lop != 1) {
            var index = $scope.tck.indexOf(item);
            $scope.tck.splice(index, 1)
        } else {
            growl.error("Failed To Remove, Minimum 1 Row Required.", {
                title: ' '
            })
        }
    }
    $scope.ppl = [];
    $scope.ppl_counter = 1;
    $scope.pplloop = function () {
        $scope.ppl.push({
            id: $scope.ppl_counter,
            point_name: '',
            point_address: '',
            point_contact_detail: ''
        });
        $scope.ppl_counter++;
        console.log($scope.ppl)
    }
    $scope.removepickPoint = function (item) {
        var lop = $scope.ppl.length;
        if (lop != 1) {
            var index = $scope.ppl.indexOf(item);
            $scope.ppl.splice(index, 1)
        } else {
            growl.error("Failed To Remove, Minimum 1 Row Required.", {
                title: ' '
            })
        }
    }
    $scope.pickuppoint = function (fid) {
        $(".pickupPoint").hide('slow');
        if (document.getElementById('offlinePayment0').checked == !0) {
            $(".pickupPoint").show('slow')
        }
    }
    $scope.CheckLinkRouting = function (df) {
        if (df >= 1) {
            $http.get("./php/controller/RouteVerifyController.php").success(function (data, status, config) {
                if (data == 1) {
                    $scope.RouteData = data;
                    console.log(data)
                } else if (data == 2) {
                    growl.error("Invalid Link Already Exists, Please Try Another Name on link.", {
                        title: ' '
                    })
                }
            })
        }
    }
    $scope.mtt = "";
    $scope.merchantTicketTypes = function () {
        $http.get("./php/controller/merchantTicketController.php").success(function (data) {
            console.log(data);
            $scope.mtt = data
        })
    }
    $scope.merchantTicketTypes();
    $scope.EventTypeAllocate = function (evt) {
        console.log(evt.EventType);
        if (evt.EventType == 5) {
            $scope.freenother = !0;
            $scope.evt.evt_btn_lbl = 3;
            $scope.evt.pm_gt_fee = 0
        }
    }
    $scope.addEvent.urlvb = !1;
    $scope.EventURLStatus = "Check Aavailability";
    $scope.createNewEvtLink = function (addEvent) {
        $scope.boundString = addEvent.EventName;
        $scope.evtname = $scope.boundString.replace(/ /g, '').toLowerCase();
        addEvent.EventURL = $scope.evtname;
        $scope.EventURLStatus_success = !1;
        $scope.EventURLStatus_invalid = !1;
        $scope.addEvent.urlvb = !1;
        if (addEvent.EventURL != null) {
            $http.post("./php/controller/validateURLController.php", {
                'urm': $scope.evtname
            }).success(function (data) {
                if (data == 1) {
                    $scope.addEvent.urlvb = !0;
                    $scope.EventURLStatus2 = "Success, Valid URL";
                    $scope.EventURLStatusColor = "#fff"
                } else {
                    $scope.addEvent.urlvb = !1;
                    $scope.EventURLStatus2 = "Failed, Invalid URL.";
                    $scope.EventURLStatusColor = "#FF0000"
                }
            })
        }
    }
    $scope.createNewEvtLinkCus = function (addEvent) {
        $scope.boundString = addEvent.EventURL;
        $scope.tempname = $scope.boundString.replace(/ /g, '').toLowerCase();
        addEvent.EventURL = $scope.tempname;
        if (addEvent.EventURL != null) {
            $http.post("./php/controller/validateURLController.php", {
                'urm': $scope.tempname
            }).success(function (data) {
                if (data == 1) {
                    $scope.EventURLStatus2 = "Success, Valid URL";
                    $scope.EventURLStatusColor = "#fff"
                } else {
                    $scope.EventURLStatus2 = "Failed, Invalid URL.";
                    $scope.EventURLStatusColor = "#FF0000"
                }
            })
        }
    }
    $scope.myFunc = function () {
        console.log(this.keycode)
    }
    $scope.checkNewSub = function (newsubst) {
        if (newsubst == 0) {
            $scope.newsubcat = !0
        } else {
            $scope.newsubcat = !1
        }
    }
    $scope.loadCategoryList = function () {
        $http.get("./php/controller/eventCategoryController.php").success(function (data, status, config) {
            $scope.eventcategorydata = data;
            console.log(data)
        })
    }
    $scope.loadCategoryList();
    $scope.loadSubCategoryList = function () {
        $http.post("./php/controller/eventSubCategoryController.php").success(function (data, status, config) {
            $scope.eventsubcategorydata = data;
            console.log(data)
        })
    }
    $scope.loadSubCategoryList();
    $scope.loadEventTypeList = function () {
        $http.post("./php/controller/eventTypeController.php").success(function (data, status, config) {
            $scope.eventtypedata = data;
            console.log(data)
        })
    }
    $scope.loadEventTypeList();
    
//    $scope.createEvent = function (addEvent) {
//        $scope.StartDate = $("#start-date").val();
//        $scope.EndDate = $("#end-date").val();
//        $scope.StartTime = $("#start-time").val();
//        $scope.EndTime = $("#end-time").val();
//        $scope.NewSWCatID = '';
//        if (addEvent.EventSubCategory == 0 && addEvent.newsubcat != '') {
//            console.log(addEvent.newsubcat);
//            $http.post("./php/controller/createEventNewSubCatController.php", {
//                'name': addEvent.newsubcat,
//                'parent': addEvent.EventCategory
//            }).success(function (data, status, config) {
//                console.log(data);
//                if (data != '') {
//                    $scope.NewSWCatID = data
//                }
//            })
//        } else {
//            $scope.SWCatID = addEvent.EventSubCategory
//        }
//        if ($scope.NewSWCatID != '' && addEvent.EventSubCategory == '0') {
//            $scope.SWCatID = $scope.NewSWCatID
//        } else {
//            $scope.SWCatID = $scope.SWCatID
//        }
//        console.log($scope.SWCatID);
//        if ($scope.imagecover != null && $scope.imagethumble != null) {
//            if (addEvent.urlvb == !0) {
//                growl.info("Creating event please wait...", {
//                    title: ' '
//                });
//                $http.post("./php/controller/createEventController.php", {
//                    'EventName': addEvent.EventName,
//                    'EventURL': addEvent.EventURL,
//                    'EventCategory': addEvent.EventCategory,
//                    'EventSubCategory': $scope.SWCatID,
//                    'EventType': addEvent.EventType,
//                    'OrganizedBy': addEvent.OrganizedBy,
//                    'StartDate': $scope.StartDate,
//                    'StartTime': $scope.StartTime,
//                    'EndDate': $scope.EndDate,
//                    'EndTime': $scope.EndTime,
//                    'NameOfVenue': addEvent.NameOfVenue,
//                    'StreetLine1': addEvent.StreetLine1,
//                    'StreetLine2': addEvent.StreetLine2,
//                    'CityFrom': addEvent.CityFrom,
//                    'CountryFiled': addEvent.CountryFiled,
//                    'EventDescription': addEvent.EventDescription,
//                    'EventTags': addEvent.EventTags,
//                    'PaymentGatewayAndServiceCharge': addEvent.PaymentGatewayAndServiceCharge,
//                    'ChangetheLabel': addEvent.ChangetheLabel,
//                    'cover': $scope.imagecover,
//                    'card': $scope.imagethumble
//                }).success(function (data, status, config) {
//                    if (data == 1) {
//                        $http.post('./email/merchentTicketCreation.php', {
//                            'uri': addEvent.EventURL
//                        }).success(function (data, status, config) {
//                            console.log('mail send');
//                            growl.success("Thank You, Your event is created successfully.", {
//                                title: ' '
//                            });
//                            growl.info("Redirecting...", {
//                                title: ' '
//                            });
//                            window.location.href = "event_list.php"
//                        })
//                    } else if (data == 2) {
//                        growl.error("Failed, Please Try Again", {
//                            title: ' '
//                        })
//                    } else {
//                        console.log(data)
//                    }
//                })
//            } else {
//                growl.error("Please Type a Valid URL.", {
//                    title: ' '
//                })
//            }
//        } else {
//            growl.info("Please Select A Cover/Card Image/Photo", {
//                title: ' '
//            })
//        }
//    }
//    $scope.imageUpload = function (event) {
//        var files = event.target.files;
//        var file = files[files.length - 1];
//        $scope.file = file;
//        var reader = new FileReader();
//        reader.onload = $scope.imageIsLoaded;
//        reader.readAsDataURL(file)
//    }
//    $scope.imageIsLoaded = function (e) {
//        $scope.$apply(function () {
//            $scope.goCats = !0;
//            $scope.step = e.target.result;
//            $scope.imagecover = e.target.result
//        })
//    }
//    $scope.clearCover = function () {
//        console.log('Function Working');
//        $scope.goCats = !1;
//        $scope.imagecover = ''
//    }
//    $scope.imageUpload_thumble = function (event) {
//        var files = event.target.files;
//        var file = files[files.length - 1];
//        $scope.file = file;
//        var reader = new FileReader();
//        reader.onload = $scope.imageIsLoaded_thumble;
//        reader.readAsDataURL(file)
//    }
//    $scope.imageIsLoaded_thumble = function (e) {
//        $scope.$apply(function () {
//            $scope.goCats_thumble = !0;
//            $scope.step_thumble = e.target.result;
//            $scope.imagethumble = e.target.result
//        })
//    }
//    $scope.clearThumble = function () {
//        $scope.imagethumble = '';
//        $scope.goCats_thumble = !1
//    }
//    $scope.upload = function () {
//        var fd = new FormData();
//        angular.forEach($scope.files, function (file) {
//            fd.append('file', file)
//        });
//        var request = $http({
//            method: 'POST',
//            url: './php/controller/createEventController.php',
//            data: fd,
//            transformRequest: angular.identity,
//            headers: {
//                'Content-Type': undefined
//            }
//        });
//        request.then(function (data, status, headers, config) {
//            growl.success("Insert Successfully", {
//                title: ' '
//            })
//        }, function (error) {
//            $scope.msg = error.data
//        })
//    }
//    $scope.loadEventList = function () {
//        $http.post("./php/controller/eventListController.php", {
//            'event_id': 1
//        }).success(function (data, status, config) {
//            $scope.eventlistdata = data;
//            console.log(data)
//        })
//    }
//    $scope.Deleteventlist = function (eventlist) {
//        $http.post("./php/controller/eventListDeleteController.php", {
//            'event_id': eventlist
//        }).success(function (data, status, config) {
//            if (data == 1) {
//                $scope.eventlistdata = $scope.loadEventList();
//                growl.success("Deleted Successfully", {
//                    title: ' '
//                })
//            } else {
//                growl.error("Failed To Deleted", {
//                    title: ' '
//                })
//            }
//        })
//    }
//    $scope.eventEditFunction = function (eventlist) {
//        $http.post("./php/controller/eventListEditController.php", {
//            'event_id': eventlist
//        }).success(function (data, status, config) {
//            $scope.eventlistdata = data;
//            $scope.addEvent.EventName = data[0].event_title;
//            $scope.addEvent.EventURL = data[0].event_url;
//            $scope.addEvent.EventCategory = data[0].event_category_id;
//            $scope.addEvent.EventSubCategory = data[0].eventSub_category;
//            $scope.addEvent.EventType = data[0].event_type;
//            $scope.addEvent.OrganizedBy = data[0].organized_by;
//            $scope.addEvent.StartDate = data[0].event_created_on;
//            $scope.addEvent.StartTime = data[0].event_created_on;
//            $scope.addEvent.EndDate = data[0].event_created_end;
//            $scope.addEvent.EndTime = data[0].event_created_end;
//            $scope.addEvent.NameOfVenue = data[0].name_of_venue;
//            $scope.addEvent.StreetLine1 = data[0].streetLine1;
//            $scope.addEvent.StreetLine2 = data[0].streetLine2;
//            $scope.addEvent.CityFrom = data[0].city_from;
//            $scope.addEvent.CountryFiled = data[0].country_filed;
//            $scope.addEvent.EventDescription = data[0].event_description;
//            $scope.addEvent.EventTags = data[0].event_tag;
//            $scope.addEvent.PaymentGatewayAndServiceCharge = data[0].payment_servicecge;
//            $scope.addEvent.ChangetheLabel = data[0].change_Label
//        })
//    }
    $scope.loadEventpayment = function () {
        $http.post("./php/controller/paymentMethodAllname.php").success(function (data, status, config) {
            $scope.pmrows = [];
            angular.forEach(data, function (value, key) {
                $scope.pmrows.push({
                    check_namest: '0',
                    check_name_ID: value.id,
                    check_name: value.name,
                    check_t_c: value.terms_and_conditions,
                    check_box: 'false'
                });
                console.log(value.name)
            })
        })
    }
    $scope.loadEventpayment();
    $scope.loadEventOfflinepayment = function () {
        $http.post("./php/controller/offlinePaymentList.php").success(function (data, status, config) {
            $scope.off_pmrows = [];
            angular.forEach(data, function (value, key) {
                $scope.off_pmrows.push({
                    off_check_namest: '0',
                    off_check_name_ID: value.id,
                    off_check_name: value.name,
                    off_check_t_c: value.terms_and_conditions,
                    off_check_box: 'false'
                });
                console.log(value.name)
            })
        })
    }
    $scope.loadEventOfflinepayment();
    $scope.removetagfrmar = function (tage) {
        for (var i = $scope.tags.length - 1; i >= 0; i--) {
            if ($scope.tags[i].tag == tage) {
                $scope.tags.splice(i, 1)
            }
        }
        $scope.tags.shift();
        console.log($scope.tags)
    }
    $scope.Shawoer = function (vale) {
        console.log(vale);
        if (vale == !0) {
            vale = !1
        } else if (vale == !1) {
            vale = !0
        }
    }
    $scope.LoadCurrency = function () {
        $http.post('./php/controller/eventCurrencyListController.php').success(function (data, status, config) {
            $scope.LoadCurrency = data
        })
    }
    $scope.LoadCurrency();
    $scope.LoadPaymentGateway = function () {
        $http.post('./php/controller/paymentGatewayController.php').success(function (data, status, config) {
            $scope.LoadPaymentGateway = data
        })
    }
    $scope.LoadPaymentGateway();
    $scope.LoadEventButton = function () {
        $http.post('./php/controller/eventbuttonlistController.php').success(function (data, status, config) {
            $scope.LoadEventButton = data
        })
    }
    $scope.LoadEventButton();
    $scope.LoadEventDefaultImage = function () {
        $http.post('./php/controller/eventDefaultImageController.php').success(function (data, status, config) {
            $scope.LoadEventDefaultImage = data;
            console.log(data)
        })
    }
    $scope.LoadEventDefaultImage();
    $scope.tckaddRow();
    $scope.defaultImageCover = function (img) {
        if (img != '') {
            $('.previewOne').hide();
            $scope.previewOneDefault = !0;
            growl.info("Cover image selected", {
                title: ' '
            });
            $scope.imageCover = img
        }
    }
    $scope.clearCoverDefault = function () {
        $('.previewOne').show();
        $scope.previewOneDefault = !1
    }
    $scope.defaultImageThumb = function (img) {
        if (img != '') {
            $('.previewTwo').hide();
            $scope.previewTwoDefault = !0;
            growl.info("Thumbnail image selected", {
                title: ' '
            });
            $scope.imageThamb = img;
            console.log($scope.previewTwoDefault)
        }
    }
    $scope.clearThumbleDefault = function () {
        $('.previewTwo').show();
        $scope.previewTwoDefault = !1;
        console.log($scope.previewTwoDefault)
    }

//    function imgModalCo() {
//        $('.imageC').click(function () {
//            $('#cover_imagem').hide();
//            $("#cover_imagem'").modal('hide')
//        })
//    }
//    imgModalCo();
//    function imgModalTh() {
//        $('.imageT').click(function () {
//            $('#thumb_image').hide();
//            $("#thumb_image'").modal('hide')
//        })
//    }
//    imgModalTh();
    var eventD, eventT, ticketD, tick_mess_attenD;
    $scope.myFunction = function () {
        eventD = document.getElementById("evt_desc").value;
        eventT = document.getElementById("evt_terms").value;
        ticketD = document.getElementById("tick_desc").value;
        tick_mess_attenD = document.getElementById("tick_mess_atten").value;
    }
    $scope.createEventJourney = function (evt, status, btn_click) {
//        alert(ticketTerms);
//          console.log(ticketTerms);
        $scope.myFunction();
        angular.forEach($scope.tck, function (value, key) {
            $scope.tck_name = (value.tick_name);
            $scope.tick_type = (value.tick_type);
            $scope.tick_quantity = (value.tick_quantity);
            $scope.tick_min_quan = (value.tick_min_quan);
            $scope.tick_max_quan = (value.tick_max_quan);
            $scope.tick_start_date = (value.tick_start_date);
            $scope.tick_end_date = (value.tick_end_date);
            $scope.tick_start_time = (value.tick_start_time);
            $scope.tick_end_time = (value.tick_end_time)
        });
        if (evt.EventName != '') {
            if (evt.EventCategory != '') {
                if (evt.EventType != '') {
                    if (evt.OrganizedBy != '') {
                        if (evt.evt_start_date != '') {
                            if (evt.ven_name != '') {
                                if (eventD != '') {
                                    if (evt.evt_end_date != '') {
                                        if ($scope.tck_name != '') {
                                            if ($scope.tick_type != '') {
                                                if ($scope.tick_quantity != '') {
                                                    if ($scope.tick_min_quan != '') {
                                                        if ($scope.tick_max_quan != '') {
                                                            if ($scope.tick_start_date != '') {
                                                                if ($scope.tick_end_date != '') {
                                                                    if ($scope.tick_start_time != '') {
                                                                        if ($scope.tick_end_time != '') {
                                                                            if ($scope.imageOne != null || $scope.imageCover != null) {
                                                                                growl.info("Please wait your event info is processing to create new event", {
                                                                                    title: ' '
                                                                                });
                                                                                $timeout(function () {
                                                                                    $http.post('./php/controller/createEventJourneycontroller.php', {
                                                                                        'event': evt,
                                                                                        'ticket': $scope.tck,
                                                                                        'tags': $scope.list,
                                                                                        imageOne: $scope.imageOne,
                                                                                        imageTwo: $scope.imageTwo,
                                                                                        paymentMethod: $scope.pmrows,
                                                                                        offlinePaymentMethod: $scope.off_pmrows,
                                                                                        pick_point: $scope.ppl,
                                                                                        coverD_img: $scope.imageCover,
                                                                                        thambD_img: $scope.imageThamb,
                                                                                        e_status: status,
                                                                                        evt_desc: eventD,
                                                                                        evt_terms: eventT,
                                                                                        tick_mess_atten: tick_mess_attenD
                                                                                    }).success(function (data, status, config) {
                                                                                        $scope.result = data;
                                                                                        if ($scope.result > 0) {
                                                                                            growl.success("Event Create Successfully Completed.", {
                                                                                                title: ' '
                                                                                            });
                                                                                            $http.post('./email/merchentEventCreation.php', {e_id: data}).success(function (data, status, config) {
                                                                                                console.log('mail sent');
                                                                                            });

                                                                                            setTimeout(function () {
                                                                                                growl.info("Redirecting page.....", {
                                                                                                    title: ' '
                                                                                                })
                                                                                            }, 1500);
                                                                                            if (btn_click == 'btn_preview') {
                                                                                                setTimeout(function () {
                                                                                                    window.open(".././checkout1.php?id=" + data, "MsgWindow", "width=1200,height=700")
                                                                                                }, 500)
                                                                                            } else {
                                                                                                setTimeout(function () {
                                                                                                    window.location.href = "add_questions.php?eventId=" + data
                                                                                              }, 3000)
                                                                                            }
                                                                                        } else {
                                                                                            growl.error("Failed, Create event.", {
                                                                                                title: ' '
                                                                                            })
                                                                                        }
                                                                                    })
                                                                                }, 3000)
                                                                            } else {
                                                                                growl.info("Please Select A Cover/Card Image/Photo", {
                                                                                    title: ' '
                                                                                })
                                                                            }
                                                                        } else {
                                                                            growl.error("Ticket End time should not be empty", {
                                                                                title: ' '
                                                                            })
                                                                        }
                                                                    } else {
                                                                        growl.error("Ticket Start time should not be empty", {
                                                                            title: ' '
                                                                        })
                                                                    }
                                                                } else {
                                                                    growl.error("Ticket end date should not be empty", {
                                                                        title: ' '
                                                                    })
                                                                }
                                                            } else {
                                                                growl.error("Ticket Start date should not be empty", {
                                                                    title: ' '
                                                                })
                                                            }
                                                        } else {
                                                            growl.error("Ticket max quantity should not be empty", {
                                                                title: ' '
                                                            })
                                                        }
                                                    } else {
                                                        growl.error("Ticket min quantity should not be empty", {
                                                            title: ' '
                                                        })
                                                    }
                                                } else {
                                                    growl.error("Ticket quantity should not be empty", {
                                                        title: ' '
                                                    })
                                                }
                                            } else {
                                                growl.error("Ticket type should not be empty", {
                                                    title: ' '
                                                })
                                            }
                                        } else {
                                            growl.error("Ticket Name field should not be empty", {
                                                title: ' '
                                            })
                                        }
                                    } else {
                                        growl.error("Event End Date field should not be empty", {
                                            title: ' '
                                        })
                                    }
                                } else {
                                    growl.error("Event Description field should not be empty", {
                                        title: ' '
                                    })
                                }
                            } else {
                                growl.error("Event Vanue Name field should not be empty", {
                                    title: ' '
                                })
                            }
                        } else {
                            growl.error("Event Start Date field should not be empty", {
                                title: ' '
                            })
                        }
                    } else {
                        growl.error("Event OrganizedBy field should not be empty", {
                            title: ' '
                        })
                    }
                } else {
                    growl.error("Event Type field should not be empty", {
                        title: ' '
                    })
                }
            } else {
                growl.error("Event Category field should not be empty", {
                    title: ' '
                })
            }
        } else {
            growl.error("Event Title field should not be empty", {
                title: ' '
            })
        }
    }

    $scope.imageUploadJourney = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoadedJourney;
        reader.readAsDataURL(file)
    }
    $scope.imageIsLoadedJourney = function (e) {
        $scope.$apply(function () {
            $scope.previewOne = !0;
            $scope.step = e.target.result;
            $scope.imageOne = e.target.result
        })
    }
    $scope.clearCover = function () {
        $scope.imagecover = '';
        $scope.previewOne = !1
    }
    $scope.imageUpload_thumbleJourney = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoaded_thumbleJourney;
        reader.readAsDataURL(file)
    }
    $scope.imageIsLoaded_thumbleJourney = function (e) {
        $scope.$apply(function () {
            $scope.previewTwo = !0;
            $scope.step_thumble = e.target.result;
            $scope.imageTwo = e.target.result
        })
    }
    $scope.clearThumble = function () {
        $scope.imagethumble = '';
        $scope.previewTwo = !1
    }
    $scope.uploadJourney = function () {
        var fd = new FormData();
        angular.forEach($scope.files, function (file) {
            fd.append('file', file)
        });
        var request = $http({
            method: 'POST',
            url: './php/controller/createEventJourneycontroller.php',
            data: fd,
            transformRequest: angular.identity,
            headers: {
                'Content-Type': undefined
            }
        });
        request.then(function (data, status, headers, config) {
            growl.success("Insert Successfully", {
                title: ' '
            })
        }, function (error) {
            $scope.msg = error.data
        })
    }
    $scope.debug = function (pmrows) {
        console.log(pmrows)
    }
    $scope.AddEventDetails = "Edit Event Details";
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
    $scope.ProvideDateAndTime = "Provide Your Event Date And Time";
    $scope.StartDate = "Start Date";
    $scope.StartTime = "Start Time";
    $scope.EndDate = "End Date";
    $scope.EndTime = "End Time";
    $scope.Venue = "Provide Your Event Location / Venue";
    $scope.EventVenue = "Event Venue";
    $scope.NameOfVenue = "Name of Venue";
    $scope.StreetLine1 = "Street Line 1";
    $scope.StreetLine2 = "Street Line 2";
    $scope.CityFrom = "City";
    $scope.CountryFiled = "Country";
    $scope.LocationMapFixed = "Location Map";
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
    $scope.FINISH = "FINISH"
}).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(!0)
    }]).factory('listEdit', function () {
    var _list = [],
            maxLength = 3;
    minLength = 0;
    return {
        add: function (item) {
            if (_list.length >= maxLength)
                return 'Too many list items';
            _list.push(item);
            return item
        },
        remove: function (index) {
            if (_list.length == minLength)
                return 'You can\'t delete this last item';
            var item = _list.splice(index, 1)[0];
            return item + ' has been deleted'
        },
        count: function () {
            return internalList.length
        },
        linkList: function (list) {
            _list = list
        }
    }
})
