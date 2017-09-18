angular
        .module('merchantaj', ['angular-growl'])
        .controller('paymentMethodOffline', function ($scope, $http, $timeout, growl) {

            

            //CREATE TICKET TYPE FUNCTION TO LOAD LIST DATA AUTOMATICALLY START
            $scope.loadPaymentmethodofflineEdit = function () {
                $http.get("./php/controller/paymentMethodController.php").success(function (data, status, heards, config) {
                    $scope.Evntpaymtd = data;
                });
            }
            $scope.loadPaymentmethodofflineEdit();

              $scope.loadEventOfflinepayment = function () {
                $http.post("./php/controller/offlinePaymentList.php").success(function (data, status, config) {
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
            //CREATE TICKET TYPE FUNCTION TO LOAD LIST DATA AUTOMATICALLY END

            //CHECKBOX DATA START HERE
            $scope.loadEventpayment = function () {
                $http.get("./php/controller/paymentMethodOfflineAllname.php").success(function (data, status, config) {                    
                    //creating new array for ind payment method
                    $scope.rows=[];
                    
                    //extracting data for name and id and create st/status
                    angular.forEach(data, function (value, key) {
                        $scope.rows.push({
                            check_namest: '0',
                            check_name_ID:value.id,
                            check_name:value.name,
                            check_box:'false'
                        });
                        console.log(value.name);
                    });
                    //creating new array for ind payment method
                    
                });
            }
            //checkbox data start here
            $scope.loadEventpayment();
            //CHECKBOX DATA END HERE
            
            
            $scope.pickuppoint = function (fid)
            {
//                alert(fid);
                //console.log(fid);
                if (fid == "Pick UP Point")
                {
                    if (document.getElementById('offlinePayment0').checked == true)
                    {
                        $("#pickupPoint").show('slow');
                         //console.log('ck');
                    }else{
                         $("#pickupPoint").hide('slow');
                    } 
                   
                }
                
               
            }
            
//            ADD and remove row script
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
//            ADD and remove row script            


            $scope.submitData = function(event_id){
             
                $http.post("./php/controller/paymentMethodOfflineSave.php",{'e_id':event_id ,'offlinePaymentMethod': $scope.off_pmrows, pick_point: $scope.ppl}).success(function(data){
                   // alert(data);
                    if(data == 1){
                        growl.success("Successfully added.", {title: ' '});
                        growl.info("Redirecting .....", {title: ' '});
                       setTimeout(function(){ 
                       window.location.href="./pickPointList.php"
                       }, 2000);
                    }else{
                        growl.error("Select an event.", {title: ' '});
                    }
                });
            }
            
            
            
            $scope.loadPaymentmethodofflineEdit = function (payEvent) {
                $http.post("./php/controller/paymentMethodOfflineEditController.php", {'id': payEvent }).success(function (data, status, config) {
                    $scope.rows=[];
                    $scope.event_id=payEvent;
                    //extracting data for name and id and create st/status
                    angular.forEach(data, function (value, key) {    
                        $scope.rows.push({
                            check_namest: value.pmst,
                            check_name_ID:value.id,
                            check_name:value.name
                        });
                        console.log(value.name);
                    });
                    console.log(data);
                });
            }
            
       
            
        }).config(['growlProvider', function (growlProvider) {
        growlProvider.globalTimeToLive(3000);
        growlProvider.globalDisableCountDown(true);
    }]);