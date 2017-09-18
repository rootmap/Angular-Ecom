<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Event Button List</h4>

        </div>
        <div ng-init="EventButton[]">
            <div class="content table-responsive table-full-width">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Event Name</th>
                            <th>Button Name</th>
                            <!--<th>Date</th>-->
<!--                            <th >Status</th>-->

                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="EventButton in eventBtndata | filter:search">

                            <td class="text-center">{{ EventButton.id}}</td>
                            <td>{{ EventButton.event_title}}</td>
                            <td>{{ EventButton.name}}</td>
                            <!--<td>{{ EventButton.date}}</td>-->
<!--                            <td>{{ EventButton.status}}</td>-->

                            <td class="td-actions text-right">
<!--                                <a href="paymentGetwayChargesListController.php?vid={{ EventButton.event_id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                    <i class="ti-pencil-alt"></i>
                                </a>-->
                                <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeletepayList(EventButton.event_id)" class="btn btn-danger btn-simple btn-xs">
                                    <i class="ti-close"></i>
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div>{{EventButton| json}}</div>
            </div>
        </div>
    </div>
</div>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

