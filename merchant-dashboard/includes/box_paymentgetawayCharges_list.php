<div class="col-md-12">
    <div class="card">
        <div class="header">
            <!--<h2>{{ flyshow}}</h2>-->
           
            <h4 class="title">Payment Getaway Charges List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->

            <form class="navbar-form navbar-left navbar-search-form" role="search">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input value="" name="valu_sar" class="form-control"  ng-model="search" placeholder="Search..." type="text">
                </div>

            </form>
        </div>
        
         <div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr >
                        <th class="text-center">ID</th>
                        <th>Event Name</th>
                        <th>Payment Getaway</th>
                        <th>Date</th>
                        <th>Status</th>

                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="payGetaway in payGetawaydata | filter:search">

                        <td class="text-center">{{ payGetaway.id}}</td>
                        <td>{{ payGetaway.event_title}}</td>
                        <td>{{ payGetaway.name}}</td>
                        <td>{{ payGetaway.date}}</td>
                        <td>{{ payGetaway.status}}</td>

                        <td class="td-actions text-right">
<!--                            <a href="paymentGetwayChargesListController.php?vid={{ payGetaway.event_id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>-->
                            <a ng-click="Deletepaymentgetaway(payGetaway.id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>


                </tbody>
            </table>
<!--            <div>{{ payGetaway|json }}</div>-->
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

