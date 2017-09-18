/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


angular
        .module('merchantaj')
        .controller('paymentMethodControllerList', function ($scope, $http, $timeout) {

            //PAYMENT METHOD FUNCTION TO LOAD  EDIT DATA AUTOMATICALLY START
            $scope.loadPaymentmethodEdeitList = function (payEvent) {
                $http.get("./php/controller/paymentMethodEditController.php", {'id': payEvent.id }).success(function (data, status, heards, config) {
                    $scope.payeventdata = data;
                    $scope.payMethod.event_id = data[0].event_id;
                    $scope.paymentStyle.check_namest = data[0].payment_method_id;
                    console.log(data);
                });
            }
             $scope.loadPaymentmethodEdeitList();
            // PAYMENT METHOD FUNCTION TO LOAD EDIT LIST DATA AUTOMATICALLY END








        });