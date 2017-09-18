<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow }}</h2>
            <h4 class="title">Payment Method Offline List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr >
                        <th class="text-center">ID</th>
                        <th>Event Name</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th class="text-right">Status</th>
                        
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="paymethodOff in payOfflinedata">

                        <td class="text-center">{{ paymethodOff.id }}</td>
                        <td>{{ paymethodOff.event_title }}</td>
                        <td>{{ paymethodOff.name }}</td>
                        <td>{{ paymethodOff.date }}</td>
                        <td>{{ paymethodOff.payment_method_status }}</td>
                       
                        <td class="td-actions text-right">
                            <a href="paymentMethodOffline.php?pid={{ paymethodOff.event_id }}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>
                           <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeletepayOffList(paymethodOff.id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

