/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * compile techonology  http://www.minifier.org/
 */

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
    
//    ADD to list function
    $scope.addToList = function () {
        $scope.c = $scope.list.length;
        if ($scope.c < 3) {
            $scope.feedback2 = listEdit.add($scope.todo);
            $('#todo').value = ""
        } else {
            growl.warning("You can add maximum 3 tags", {
                title: ' '
            })
        }
    };
   //    ADD to list function
 
    
    //   Remove function
    $scope.remove = function (index) {
        $scope.feedback = listEdit.remove(index)
    };
    //   Remove function

    
    
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
    $scope.evt.pm_gt_fee = "";
    $scope.evt.evt_btn_lbl = "";
    $scope.evt.OrganizedBy = "";
    $scope.evt.banner = "";
    $scope.evt.logo = "";
    $scope.evt.EventType = "";
    $scope.evt.EventCategory = "";
    $scope.evt.EventSubCategory = "";
    $scope.evt.newsubcat = "";
    $scope.evt.EventName = "";
    $scope.imagecover = null;
    $scope.imagethumble = null;
    $scope.evtname = "";
    $scope.opened = [];
    
    //   Open function
    $scope.open = function (index) {
        $timeout(function () {
            $scope.opened[index] = !0
        })
    };
   //   Open function


    //   Date picker function
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
    //   Date picker function
    
   //   Time picker function
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
       //   Time picker function
       
    //   Return auto value function   
    $scope.AutoVarVal = function (id, df) {
        $scope.evt[id] = df
    }
    //   Return auto value function   

    //   Initial date ticket value function   
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
            var dateval = $(this).attr("data-id");
            if (dateval != null)
            {
                $scope.tck[id][dfmod] = dateval;
                alert(dateval);
            }
            else
            {
                $scope.tck[id][dfmod] = df;
            }

        })
    }
    //   Initial date ticket value function   

    //   Initial time ticket value function   
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
    //   Initial time ticket value function   

    
    $scope.tck = [];
    $scope.tck_counter = 1;
   //   Ticket row add function   
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
            tick_evt_des: '',
            tick_evt_messatten: '',
            tick_mess_atten: '',
            tick_max_quan: 10,
            tick_availability: 0,
            tick_fee_from: 0
        });
        $scope.tck_counter++;

        //tick_evt_messatten

    }
    $scope.tckaddRow();
    //   Ticket row add function   
    
    //   Allways run function   
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
    //   Allways run function   
    
    //   Remove ticket function function   
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
   //   Remove ticket function function   
    
    $scope.ppl = [];
    $scope.ppl_counter = 1;
    //  PPL LOOP function   
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
    //  PPL LOOP function
    
    //  Remove pick point function   
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
    //  Remove pick point function   
    
   //   pick up point function   
    $scope.pickuppoint = function (fid) {
        if (fid == "Pick UP Point") {
            if (document.getElementById('offlinePayment1').checked == !0) {
                $(".pickupPoint").show('slow')
            } else if (document.getElementById('offlinePayment1').checked == !1) {
                $(".pickupPoint").show('slow')
            }
        }
    }
    //   pick up point function
    
    //   Check routing function   
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
    //   Check routing function
    
   //   merchent Ticket type function   
    $scope.mtt = "";
    $scope.merchantTicketTypes = function () {
        $http.get("./php/controller/merchantTicketController.php").success(function (data) {
            console.log(data);
            $scope.mtt = data
        })
    }
    $scope.merchantTicketTypes();
    //   merchent Ticket type function   
    
    
    //   Event  type allocation  function   
    $scope.EventTypeAllocate = function (evt) {
        console.log(evt.EventType);
        if (evt.EventType == 5) {
            $scope.freenother = !0;
            $scope.evt.evt_btn_lbl = 3;
            $scope.evt.pm_gt_fee = 0
        }
    }
    //   Event  type allocation  function   
    
    //   Create new event link function   
    $scope.addEvent.urlvb = !1;
    $scope.EventURLStatus = "Check Aavailability";
    $scope.createNewEvtLink = function (addEvent) {
        $scope.boundString = addEvent.EventName;
        $scope.evtname = $scope.boundString.replace(/ /g, '').toLowerCase();
        addEvent.EventURL = $scope.evtname;
        $scope.EventURLStatus_success = !1;
        $scope.EventURLStatus_invalid = !1;
        $scope.EventURLStatus_processing = !0;
        $scope.addEvent.urlvb = !1;
        if (addEvent.EventURL != null) {
            $http.post("./php/controller/validateURLController.php", {
                'urm': $scope.evtname
            }).success(function (data) {
                if (data == 1) {
                    $scope.addEvent.urlvb = !0;
                    $scope.EventURLStatus_processing = !1;
                    $scope.EventURLStatus2 = "Valid";
                    $scope.EventURLStatusColor = "#fff"
                } else {
                    $scope.addEvent.urlvb = !1;
                    $scope.EventURLStatus_processing = !1;
                    $scope.EventURLStatus2 = "Invalid";
                    $scope.EventURLStatusColor = "#FF0000"
                }
            })
        }
    }
    //   Create new event link function      
    
    //   Create new event link cus function   
    $scope.createNewEvtLinkCus = function (addEvent) {
        $scope.EventURLStatus2 = "Valid";
        $scope.EventURLStatusColor = "#fff";
        $scope.boundString = addEvent.EventURL;
        $scope.tempname = $scope.boundString.replace(/ /g, '').toLowerCase();
        addEvent.EventURL = $scope.tempname;
        $scope.EventURLStatus = "Processing...";
        if (addEvent.EventURL != null) {
            $http.post("./php/controller/validateURLController.php", {
                'urm': $scope.tempname
            }).success(function (data) {
                if (data == 1) {
                    $scope.EventURLStatus2 = "Invalid";
                    $scope.EventURLStatusColor = "#FF0000"
                } else {
                    $scope.EventURLStatus2 = "Valid";
                    $scope.EventURLStatusColor = "#fff"
                }
            })
        }
    }
   //   Create new event link cus function   

   //  function for console anything   
    $scope.myFunc = function () {
        console.log(this.keycode)
    }
   //  function for console anything   

    //  sub category check function  
    $scope.checkNewSub = function (newsubst) {
        if (newsubst == 0) {
            $scope.newsubcat = !0
        } else {
            $scope.newsubcat = !1
        }
    }
    //  sub category check function  
    
   //  load category list function      
    $scope.loadCategoryList = function () {
        $http.get("./php/controller/eventCategoryController.php").success(function (data, status, config) {
            $scope.eventcategorydata = data;
            console.log(data)
        })
    }
    $scope.loadCategoryList();
   //  load category list function      

   //  load subcategory list function      
    $scope.loadSubCategoryList = function () {
        $http.post("./php/controller/eventSubCategoryController.php").success(function (data, status, config) {
            $scope.eventsubcategorydata = data;
            console.log(data)
        })
    }
    $scope.loadSubCategoryList();
   //  load category list function     
   
  //  load event type list function      
    $scope.loadEventTypeList = function () {
        $http.post("./php/controller/eventTypeController.php").success(function (data, status, config) {
            $scope.eventtypedata = data;
            console.log(data)
        })
    }
    $scope.loadEventTypeList();
  //  load event type list function      
    
  //  image upload function          
    $scope.imageUpload = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoaded;
        reader.readAsDataURL(file)
    }
  //  image upload function      
    
    
    //  image isloaded function         
    $scope.imageIsLoaded = function (e) {
        $scope.$apply(function () {
            $scope.goCats = !0;
            $scope.step = e.target.result;
            $scope.imagecover = e.target.result
        })
    }
    //  image isloaded function         

   //  clear cover image function         
    $scope.clearCover = function () {
        console.log('Function Working');
        $scope.goCats = !1;
        $scope.imagecover = ''
    }
    //  clear cover image function         
    
    
   //  clear old cover image function          
    $scope.clearOldBanner = function () {
        $scope.evt.banner = "";
        $('#hideMe').hide();
        $('#back').show()
    }
   //  clear old cover image function          

  //  clear old logo function           
    $scope.clearOldLogo = function () {
        $scope.evt.logo = "";
        $('#logohideMe').hide();
        $('#logoback').show()
    }
 //  clear old logo function          

    //  upload thumb  image function          
    $scope.imageUpload_thumble = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoaded_thumble;
        reader.readAsDataURL(file)
    }
   //  upload thumb  image function 
   
   //  upload thumb is loaded  image function          
    $scope.imageIsLoaded_thumble = function (e) {
        $scope.$apply(function () {
            $scope.goCats_thumble = !0;
            $scope.step_thumble = e.target.result;
            $scope.imagethumble = e.target.result
        })
    }
   //  upload thumb is loaded  image function          
    
    
   //  clear thumb  image function          
    $scope.clearThumble = function () {
        $scope.imagethumble = '';
        $scope.goCats_thumble = !1
    }
   //  clear thumb  image function          
    
    
       //  file upload  image function          
    $scope.upload = function () {
        var fd = new FormData();
        angular.forEach($scope.files, function (file) {
            fd.append('file', file)
        });
        var request = $http({
            method: 'POST',
            url: './php/controller/createEventController.php',
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
//  file upload  image function          

    //  load event list function          
    $scope.loadEventList = function () {
        $http.post("./php/controller/eventListController.php", {
            'event_id': 1
        }).success(function (data, status, config) {
            $scope.eventlistdata = data;
            console.log(data)
        })
    }
   //  load event list function          

  //  delete event list function           
    $scope.Deleteventlist = function (eventlist) {
        $http.post("./php/controller/eventListDeleteController.php", {
            'event_id': eventlist
        }).success(function (data, status, config) {
            if (data == 1) {
                $scope.eventlistdata = $scope.loadEventList();
                growl.success("Deleted Successfully", {
                    title: ' '
                })
            } else {
                growl.error("Failed To Deleted", {
                    title: ' '
                })
            }
        })
    }
   //  delete event list function          

    
    //  load event payment function          
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
    //  load event payment function          

    
    
    //  load offline event payment function          
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
    //  load offline event payment function          
    
    
    
   //  remove tag  function          
    $scope.removetagfrmar = function (tage) {
        for (var i = $scope.tags.length - 1; i >= 0; i--) {
            if ($scope.tags[i].tag == tage) {
                $scope.tags.splice(i, 1)
            }
        }
        $scope.tags.shift();
        console.log($scope.tags)
    }
   //  remove tag  function
   
   //  shawoer  function          
    $scope.Shawoer = function (vale) {
        console.log(vale);
        if (vale == !0) {
            vale = !1
        } else if (vale == !1) {
            vale = !0
        }
    }
    //  shawoer  function          

    //  load currency function           
    $scope.LoadCurrency = function () {
        $http.post('./php/controller/eventCurrencyListController.php').success(function (data, status, config) {
            $scope.LoadCurrency = data
        })
    }
    $scope.LoadCurrency();
    //  load currency function
    
    //  load payment getway function           
    $scope.LoadPaymentGateway = function () {
        $http.post('./php/controller/paymentGatewayController.php').success(function (data, status, config) {
            $scope.LoadPaymentGateway = data
        })
    }
    $scope.LoadPaymentGateway();
    //  load payment getway function           

    //  load event button function           
    $scope.LoadEventButton = function () {
        $http.post('./php/controller/eventbuttonlistController.php').success(function (data, status, config) {
            $scope.LoadEventButton = data
        })
    }
    $scope.LoadEventButton();
   //  load event button function           

   //  load event default image function           
    $scope.LoadEventDefaultImage = function () {
        $http.post('./php/controller/eventDefaultImageController.php').success(function (data, status, config) {
            $scope.LoadEventDefaultImage = data;
//            alert(data.banner_image)
        })
    }
    $scope.LoadEventDefaultImage();
    //  load event default image function           

    
    
    
    
    // default cover image
    $scope.defaultImageCover = function (img) {
        if (img != '') {
            $('.previewOne').hide();
            $scope.previewOneDefault = !0;
            growl.info("Cover image selected", {
                title: ' '
            });
            $scope.imageCover = img;
            
        }
    }
   // default image cover

   // clear image cover
    $scope.clearCoverDefault = function () {
        $('.previewOne').show();
        $scope.previewOneDefault = !1
    }
    // clear image cover
    
    // default image thumb function 
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
    // dafault image thumb function

   // clear image thumb function
    $scope.clearThumbleDefault = function () {
        $('.previewTwo').show();
        $scope.previewTwoDefault = !1;
        console.log($scope.previewTwoDefault)
    }
   // clear image thumb function

 
   // image upload modal function
    function imgModalCo() {
        $('.imageC').click(function () {
            $('#cover_imagem').hide();
            $("#cover_imagem'").modal('hide')
        })
    }
    imgModalCo();
   // image upload modal function


    
  // image  modal th function
    function imgModalTh() {
        $('.imageT').click(function () {
            $('#thumb_image').hide();
            $("#thumb_image'").modal('hide')
        })
    }
    imgModalTh();
 // image  modal th function

//    event description, ticket description mess attendice  get value function
    var eventD, ticketD, tick_mess_attenD;
    $scope.myFunction = function () {
        eventD = document.getElementById("evt_desc").value;
        ticketD = document.getElementById("tick_desc").value;
        tick_mess_attenD = document.getElementById("tick_mess_atten").value
    }
//    event description, ticket description mess attendice  get value function
    
    
    //    event edit  function
    $scope.eventEditFunction = function (eventlist) {
        $http.post("./php/controller/eventListEditController.php", {
            'event_id': eventlist
        }).success(function (data, status, config) {

            $scope.editLoadTickets(eventlist);

            $scope.eventlistdata = data;
            $scope.evt.EventId = data[0].event_id;
            $scope.evt.EventName = "Copy Of " + data[0].event_title;
            $scope.evt.EventURL = "Copy-Of-" + data[0].event_url;
            $scope.evt.EventCategory = data[0].event_category_id;
            $scope.evt.EventSubCategory = data[0].eventSub_category;
            $scope.evt.EventType = data[0].event_type;
            $scope.evt.OrganizedBy = data[0].organized_by;
            $scope.evt.banner = data[0].banner;
            $scope.evt.logo = data[0].logo;
            $scope.evt.evt_start_date = data[0].startDate;
            $scope.evt.StartTime = data[0].startTime;
            $scope.evt.evt_end_date = data[0].endDate;
            $scope.evt.EndTime = data[0].endTime;
            $scope.evt.ven_name = data[0].name_of_venue;
            $scope.evt.ven_address = data[0].streetLine1;
            $scope.evt.ven_address = data[0].streetLine2;
            $scope.evt.ven_city = data[0].city_from;
            $scope.evt.ven_country = data[0].country_filed;
            $scope.evt.evt_desc = data[0].event_description;
            $scope.evt.EventTags = data[0].event_tag;
            $scope.evt.pm_gt_fee = data[0].payment_servicecge;
            $scope.evt.evt_btn_lbl = data[0].change_Label;
            $scope.evt.event_description = data[0].event_description;
            $scope.evt.evt_desc = data[0].event_description;

            //alert($scope.evt.evt_desc);
            //data[0].event_description;
            //setTimeout(Function(){
            //$("#tinymce").html($scope.evt.evt_desc);

            //},5000);


        });
    }
   //    event edit  function

    
//     edit load ticket  function 
    $scope.editLoadTickets = function (eid) {
        $http.post("./php/controller/editLoadTicket.php", {
            'eid': eid
        }).success(function (data, status, config) {
            //console.log(data);
            $scope.evttag = data.evttags;
            $scope.tt = data.tt;
            $scope.tck = $scope.tt;
            $scope.ppdata = data.tt;
            $scope.ppl = $scope.ppdata;
            //console.log($scope.tt);

            angular.forEach($scope.evttag, function (value, key) {
                // console.log(key + ': ' + value);
                $scope.list.push(value);
            });

            $scope.evt.pm_gt_fee = data.pmc[0].pms_id;

            $scope.evt.evt_btn_lbl = data.btninfo[0].button_id;

            //alert(data.pmc[0].pms_id);

            angular.forEach(data.tt, function (value, key) {
                $scope.tck[key]['tick_name'] = value.TT_type_title;
                $scope.tck[key]['tick_type'] = value.TT_type_id;
                $scope.tck[key]['tick_quantity'] = value.TT_ticket_quantity;
                $scope.tck[key]['tick_price'] = value.TT_price;
                $scope.tck[key]['tick_currency'] = value.TT_currency;
                $scope.tck[key]['tick_min_quan'] = value.TTmin_quantity;
                $scope.tck[key]['tick_start_date'] = value.TT_startDate;
                $scope.tck[key]['tick_end_date'] = value.TT_endDate;
                $scope.tck[key]['tick_start_time'] = value.TT_startTime;
                $scope.tck[key]['tick_end_time'] = value.TT_endTime;
                $scope.tck[key]['tick_mess_atten'] = value.TT_MessageToAttendee;
                $scope.tck[key]['tick_max_quan'] = value.TT_per_user_limit;
                $scope.tck[key]['tick_availability'] = value.TT_availability;
                $scope.tck[key]['tick_fee_from'] = value.TT_WhowillpayTicketchaifee;
                $scope.tck[key]['tick_evt_des'] = value.TT_type_description;
                $scope.tck[key]['tick_evt_messatten'] = value.TT_MessageToAttendee;
            });

            angular.forEach(data.ppdata, function (value, key) {
                $scope.ppl[key]['point_name'] = value.name;
                $scope.ppl[key]['point_address'] = value.address;
                $scope.ppl[key]['point_contact_detail'] = value.point_details;

            });


            angular.forEach(data.pminfo, function (value, key) {
                // $scope.pmrows[key]['check_namest'] = value.chk;
                if (value.chk != 0) {
                    $scope.pmrows[key]['check_namest'] = value.chk;
                    //console.log($scope.pmrows[key]['check_namest']);
                }

            });

            angular.forEach(data.pmoffline, function (value, key) {
                $scope.off_pmrows[key]['off_check_namest'] = value.chk;
                if (value.chk != 0) {
                    $(".pickupPoint").show('slow')
                    //$scope.pickuppoint();
                }
            });



        });
        // arrayText.push(this.text);

    }
//     edit load ticket  function 

//     for alert  function 
    $scope.AssignValueDesc = function (val) {
        alert(val);
    }
//     for alert  function 



//    Create event journey function
    $scope.createEventJourney = function (evt, status, btn_click, eid) {
        $scope.myFunction();
        if($scope.imageOne != null || $scope.imageCover != null || eid != null){
            
            growl.info("Please wait your event info is processing to create new event", {
                title: ' '
            });
            
            
            $timeout(function () {
                $http.post('./php/controller/cloneEventController.php', {
                    
                    imageOne:$scope.imageCover,
                    imageTwo:$scope.imageThamb,
                    coverD_img:$scope.evt.banner,
                    thambD_img:$scope.evt.logo,
                    
                    'eventId': eid,
                    'event': evt,
                     evt_desc: eventD,
                    
                    'ticket': $scope.tck,
                     tick_mess_atten: tick_mess_attenD,
                     tick_desc: ticketD,
                      
                    'tags': $scope.list,
                    
                    paymentMethod: $scope.pmrows,
                    offlinePaymentMethod: $scope.off_pmrows,
                    
                    pick_point: $scope.ppl,
                    e_status: status
                    
                }).success(function (data, status, config) {
                    $scope.result = data;
                    console.log($scope.result);
                    if ($scope.result > 0) {
                        growl.success("Event Create Successfully Completed.", {
                            title: ' '
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
                                window.location.href = "event_list.php"
                            }, 3000)
                        }
                    } else {
                        growl.error("Failed, Create event.", {
                            title: ' '
                        })
                    }
                })
            }, 3000)
            
        }
         
    }
    //    Create event journey function




//    Create event journey function
//    $scope.createEventJourney = function (evt, status, btn_click, eid) {
//        $scope.myFunction();
//        if ($scope.imageOne != null || $scope.imageCover != null) {
//            alert(1);
//            growl.info("Please wait your event info is processing to create new event", {
//                title: ' '
//            });
//            $timeout(function () {
//                $http.post('./php/controller/cloneEventController.php', {
//                    'eventId': eid,
//                    'event': evt,
//                    'ticket': $scope.tck,
//                    'tags': $scope.list,
//                    imageOne: $scope.imageOne,
//                    imageTwo: $scope.imageTwo,
//                    paymentMethod: $scope.pmrows,
//                    offlinePaymentMethod: $scope.off_pmrows,
//                    pick_point: $scope.ppl,
//                    coverD_img: $scope.imageCover,
//                    thambD_img: $scope.imageThamb,
//                    e_status: status,
//                    evt_desc: eventD,
//                    tick_desc: ticketD,
//                    tick_mess_atten: tick_mess_attenD
//                }).success(function (data, status, config) {
//                    $scope.result = data;
//                    console.log($scope.result);
//                    if ($scope.result > 0) {
//                        growl.success("Event Create Successfully Completed.", {
//                            title: ' '
//                        });
//                        setTimeout(function () {
//                            growl.info("Redirecting page.....", {
//                                title: ' '
//                            })
//                        }, 1500);
//                        if (btn_click == 'btn_preview') {
//                            setTimeout(function () {
//                                window.open(".././checkout1.php?id=" + data, "MsgWindow", "width=1200,height=700")
//                            }, 500)
//                        } else {
//                            setTimeout(function () {
//                                window.location.href = "event_list.php"
//                            }, 3000)
//                        }
//                    } else {
//                        growl.error("Failed, Create event.", {
//                            title: ' '
//                        })
//                    }
//                })
//            }, 3000)
//            
//        } else {
//            alert(2);
//            
//            growl.info("Please wait your event info is processing to create new event", {
//                title: ' '
//            });
//            $timeout(function () {
//                $http.post('./php/controller/cloneEventController.php', {
//                    'eventId': eid,
//                    'event': evt,
//                    'ticket': $scope.tck,
//                    'tags': $scope.list,
//                    paymentMethod: $scope.pmrows,
//                    offlinePaymentMethod: $scope.off_pmrows,
//                    pick_point: $scope.ppl,
//                    e_status: status,
//                    tick_desc: ticketD,
//                    tick_mess_atten: tick_mess_attenD
//                }).success(function (data, status, config) {
//                    $scope.result = data;
//                    console.log($scope.result);
//                    if ($scope.result > 0) {
//                        growl.success("Event Create Successfully Completed.", {
//                            title: ' '
//                        });
//                        setTimeout(function () {
//                            growl.info("Redirecting page.....", {
//                                title: ' '
//                            })
//                        }, 1500);
//                        if (btn_click == 'btn_preview') {
//                            setTimeout(function () {
//                                window.open(".././checkout1.php?id=" + data, "MsgWindow", "width=1200,height=700")
//                            }, 500)
//                        } else {
//                            setTimeout(function () {
//                                window.location.href = "event_list.php"
//                            }, 3000)
//                        }
//                    } else {
//                        growl.error("Failed, Create event.", {
//                            title: ' '
//                        })
//                    }
//                })
//            }, 3000)
//            
//            
//        }
//    }
    //    Create event journey function

    
    //    image upload journey function

    $scope.imageUploadJourney = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoadedJourney;
        reader.readAsDataURL(file)
    }
        //    image upload journey function

    //    image is loaded journey function
    $scope.imageIsLoadedJourney = function (e) {
        $scope.$apply(function () {
            $scope.previewOne = !0;
            $scope.step = e.target.result;
            $scope.imageOne = e.target.result;
            console.log($scope.imageOne)
        })
    }
   //    image is loaded journey function

  //    create event function
    $scope.createEvent = function (addEvent) {
        $scope.StartDate = $("#start-date").val();
        $scope.EndDate = $("#end-date").val();
        $scope.StartTime = $("#start-time").val();
        $scope.EndTime = $("#end-time").val();
        $scope.NewSWCatID = '';
        if (addEvent.EventSubCategory == 0 && addEvent.newsubcat != '') {
            console.log(addEvent.newsubcat);
            $http.post("./php/controller/createEventNewSubCatController.php", {
                'name': addEvent.newsubcat,
                'parent': addEvent.EventCategory
            }).success(function (data, status, config) {
                console.log(data);
                if (data != '') {
                    $scope.NewSWCatID = data
                }
            })
        } else {
            $scope.SWCatID = addEvent.EventSubCategory
        }
        if ($scope.NewSWCatID != '' && addEvent.EventSubCategory == '0') {
            $scope.SWCatID = $scope.NewSWCatID
        } else {
            $scope.SWCatID = $scope.SWCatID
        }
        console.log($scope.SWCatID);
        if ($scope.imageOne != null || $scope.imageCover != null) {
            if (addEvent.urlvb == !0) {
                growl.info("Creating event please wait...", {
                    title: ' '
                });
                $http.post("./php/controller/cloneEventController.php", {
                    'EventName': addEvent.EventName,
                    'EventURL': addEvent.EventURL,
                    'ticket': $scope.tck,
                    'paymentMethod': $scope.pmrows,
                    'offlinePaymentMethod': $scope.off_pmrows,
                    'pick_point': $scope.ppl,
                    'EventCategory': addEvent.EventCategory,
                    'EventSubCategory': $scope.SWCatID,
                    'EventType': addEvent.EventType,
                    'OrganizedBy': addEvent.OrganizedBy,
                    'StartDate': $scope.StartDate,
                    'StartTime': $scope.StartTime,
                    'EndDate': $scope.EndDate,
                    'EndTime': $scope.EndTime,
                    'NameOfVenue': addEvent.NameOfVenue,
                    'StreetLine1': addEvent.StreetLine1,
                    'StreetLine2': addEvent.StreetLine2,
                    'CityFrom': addEvent.CityFrom,
                    'CountryFiled': addEvent.CountryFiled,
                    'EventDescription': addEvent.EventDescription,
                    'EventTags': addEvent.EventTags,
                    'PaymentGatewayAndServiceCharge': addEvent.PaymentGatewayAndServiceCharge,
                    'ChangetheLabel': addEvent.ChangetheLabel,
                    'imageOne': $scope.imageOne,
                    'imageTwo': $scope.imageTwo,
                    'cover': $scope.imageCover,
                    'card': $scope.imageThamb,
                }).success(function (data, status, config) {
                    console.log(data);
                    if (data == 1) {
                        $http.post('./email/merchentTicketCreation.php', {
                            'uri': addEvent.EventURL
                        }).success(function (data, status, config) {
                            console.log('mail send');
                            growl.success("Thank You, Your event is created successfully.", {
                                title: ' '
                            });
                            growl.info("Redirecting...", {
                                title: ' '
                            });
                            window.location.href = "event_list.php"
                        })
                    } else if (data == 2) {
                        growl.error("Failed, Please Try Again", {
                            title: ' '
                        })
                    } else {
                        console.log(data)
                    }
                })
            } else {
                growl.error("Please Type a Valid URL.", {
                    title: ' '
                })
            }
        } else {
            growl.info("Please Select A Cover/Card Image/Photo", {
                title: ' '
            })
        }
    }
 //    create event function

 //    clear cover  function    
    $scope.clearCover = function () {
        $scope.imagecover = '';
        $scope.previewOne = !1
    }
     //    clear cover  function    

     //    thumb upload journey  function    
    $scope.imageUpload_thumbleJourney = function (event) {
        var files = event.target.files;
        var file = files[files.length - 1];
        $scope.file = file;
        var reader = new FileReader();
        reader.onload = $scope.imageIsLoaded_thumbleJourney;
        reader.readAsDataURL(file)
    }
   //    thumb upload journey  function    

        //    thumb upload journey is loaded  function     
    $scope.imageIsLoaded_thumbleJourney = function (e) {
        $scope.$apply(function () {
            $scope.previewTwo = !0;
            $scope.step_thumble = e.target.result;
            $scope.imageTwo = e.target.result;
            console.log($scope.imageTwo)
        })
    }
            //    thumb upload journey is loaded  function     
    
  //    clear thumb  function     
    $scope.clearThumble = function () {
        $scope.imagethumble = '';
        $scope.previewTwo = !1
    }
  //    clear thumb  function     


    //    upload journey function
    $scope.uploadJourney = function () {
        var fd = new FormData();
        angular.forEach($scope.files, function (file) {
            fd.append('file', file)
        });
        var request = $http({
            method: 'POST',
            url: './php/controller/cloneEventController.php',
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
    //    upload journey function

    
    
//    for console function
    $scope.debug = function (pmrows) {
        console.log(pmrows)
    }
//    for console function
    
    
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
    $scope.banner = "Banner";
    $scope.logo = "Logo";
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
            maxLength = 3,
            minLength = 0;
    return {
        add: function (item) {
            if (_list.length >= maxLength)
                return 'Too many list items';
            _list.push(item);
            return item + ' is added'
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