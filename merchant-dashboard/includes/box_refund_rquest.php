<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow }}</h2>
            <h4 class="title page-header"> <i class="fa fa-credit-card"></i>Refund</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div> 
        <div class="content table-responsive table-full-width">

            <div class="row">
                <!-- BEGIN STEP CONTENT-->

                <form class="tsf-step-content" ng-model="RefundndMethod">
                    <div class="row-fluid">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="form-group">
                                <label>{{ MerchantID}} </label>
                                <input type="hidden"  ng-model="RefundndMethod.marchentid=<?php echo $login_user_id; ?>" />
                                <input type="text" class="form-control" value="<?php echo $login_user_name; ?>" disabled="disabled">
                            </div>
                            
                            <div class="form-group">
                                <label for="1">{{ AvailableAmount }}</label>
                                <input ng-readonly="true" type="text" class="form-control" id="1" name="AvailableAmount" required ng-model="RefundndMethod.AvailableAmount">
                            </div>
                            <div class="form-group">
                                <label for="1">{{ RequestAmount}}</label>
                                <input type="text" class="form-control" id="1" name="RequestAmount" required ng-model="RefundndMethod.RequestAmount">
                            </div>
                            <div class="form-group">
                                <label for="1">{{ RemarksNote }}</label>
                                <input type="text" class="form-control" id="1" name="RemarksNote" required ng-model="RefundndMethod.RemarksNote">
                            </div>
                            <div class="form-group">
                                <label for="1">{{ RefundMethod }}</label>
                                <select ng-model="RefundndMethod.RefundMethodnew" ng-change="getRMethod(RefundndMethod)" name="RefundMethodnew" class="form-control"  data-title="Single Select">
                                    <option value=""></option>
                                    <option ng-repeat="rfundpay in Refundpaydata" ng-selected="{{ rfundpay.id}}=={{ RefundndMethod.RefundMethodnew }}" value="{{ rfundpay.id}}">{{ rfundpay.name}}</option>
                                </select>
<!--                                <input type="text" class="form-control" id="1" placeholder="Name of Venue" required ng-model="RefundndMethod.RefundMethodnew">-->
                            </div>
                            <div class="form-group" ng-show="bkash">
                                <label for="1">{{ mobilenumber }}</label>
                                <input type="text" class="form-control" id="1" name="mobilenumber" required ng-model="RefundndMethod.mobilenumber">
                            </div>
                            <div class="form-group" ng-show="bank">
                                <label for="1">{{ BankName }}</label>
                                <input type="text" class="form-control" id="1"  name="BankName" required ng-model="RefundndMethod.BankName">
                            </div>
                            <div class="form-group" ng-show="bank">
                                <label for="1">{{ AcNumber }}</label>
                                <input type="text"  class="form-control" id="1" name="AcNumber" required ng-model="RefundndMethod.AcNumber">
                            </div>

                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-4">
                                   
                                    <button type="button" value="save" ng-click="DataSave(RefundndMethod);" class="btn btn-fill btn-info btn-block">SAVE</button>
                                   
                                </div>
                            </div>
                            <div class="row-fluid" style="margin-top: 20px;">
                                <div class="col-md-6">
                                   
                                    <code>Minimum Withdraw Amount 500 TK. BDT</code>
                                    
                                </div>
                            </div>


                        </div>    

                    </div>    
                </form>
                <!-- END STEP CONTENT-->
            </div>
        </div>
    </div>
</div>

