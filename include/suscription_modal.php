<!-- subscription widget starts here -->
<!--<div class="clearfix"></div>
<div id="subscription" class="container-fluid subscribe-widget navbar-fixed-bottom" style="border-radius: 0px;">
    <button id="btn-sclose" class="btn btn-warning btn-raised btn-fab btn-fab-mini btn-round"><i class="fa fa-chevron-down"></i></button>
    <div class="row" style="overflow: hidden;">
        <div class="container">
            <div class="col-md-6">
                <h3 class="subscribe-label">Subscribe & Stay Tuned For Exciting Events </h3>
            </div>
            <div class="col-md-6">
                <form ng-submit="subscribe_newsletter(email)">
                    <div class="input-group">
                        <input type="email" class="form-control subscription_input" ng-model="email" placeholder="Type Your Email For Latest Newsletters" required >
                        <span class="input-group-btn">
                            <a href="#" class="btn btn-raised btn-danger btn-subscribe" ng-click="subscribe_newsletter(email)"><i class="fa fa-envelope">&nbsp;</i> Subscribe</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>-->

<!--[subscription modal starts]-->

<div class="modal fade modalsubs hidden-xs" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup-bg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body">
            	<div class="box-title2">
                	<h3 class="subscribe-label bold">Subscribe Us & Stay Tuned<br/>For Exciting Events </h3>
                    <hr>
                    <h5 class="bold text-center">Subscribe to our Awsome newsletter for weekly and monthly updates and offers about all exciting events happenning around you!</h5>
                </div>
                
            </div>
            <div class="modal-footer">
                <form ng-submit="subscribe_newsletter(email)">
                        <div class="input-group input-group-lg">
                        	<input type="email" class="form-control" ng-model="email" placeholder="Type Your Email For Latest Newsletters" required >
                            <span class="input-group-btn">
                                <a href="#" class="btn btn-raised btn-danger btn-subscribe" ng-click="subscribe_newsletter(email)"><i class="fa fa-envelope">&nbsp;</i> Subscribe</a>
                            </span>
                        </div>
                    </form>
                    <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<!--[subscription modal ends]-->
<!-- subscription widget ends here -->