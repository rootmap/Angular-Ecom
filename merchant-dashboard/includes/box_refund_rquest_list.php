<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Refund Request List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th> Merchant Name</th>
                        <th>Available Amount</th>
                        <th>Request Amount</th>
                     
                        <th>Status</th>

<!--                        <th class="text-right">Actions</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="refundList in refundListdata| limitTo:10">

                        <td class="text-center">{{ refundList.id}}</td>
                        <td>{{ refundList.admin_full_name}}</td>
                        <td>{{ refundList.available_amount}}</td>
                        <td>{{ refundList.request_amount}}</td>
                        <td>{{ refundList.status}}</td>
                       


                        <td class="td-actions text-right">
<!--                            <a href="newrefundrequest.php?qid={{ refundList.id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>
                            <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeleterefundList(refundList.id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>-->
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

