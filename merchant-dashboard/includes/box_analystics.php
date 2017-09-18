<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color" data-color="blue">
            <div class="header text-center">
                <h5 class="title"> Customer </h5>
                <p class="description">All Event Customer </p>
            </div>
            <div class="content">
                <div id="chartDashboard" class="chart-circle" data-percent="{{ Customer }}">{{ Customer }}%</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color" data-color="green">
            <div class="header text-center">
                <h5 class="title">page viewes</h5>
                <p class="description">Page Visited</p>
            </div>
            <div class="content">
                <div id="chartOrders" class="chart-circle" data-percent="{{ visitevents }}">{{ visitevents }}%</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color" data-color="orange">
            <div class="header text-center">
                <h5 class="title">Total Order</h5>
                <p class="description">Paid Orders</p>
            </div>
            <div class="content">
                <div id="chartNewVisitors" class="chart-circle" data-percent="{{ paidOrders }}">{{ paidOrders }}%</div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color" data-color="brown">
            <div class="header text-center">
                <h5 class="title">Published</h5>
                <p class="description">All Active Events</p>
            </div>
            <div class="content">
                <div id="chartSubscriptions" class="chart-circle" data-percent="{{ publishedAllEvents }}">{{ publishedAllEvents }}%</div>
            </div>
        </div>
    </div>
</div>
<h4 class="page-header">Today Report</h4>
<div class="row">
    <div class="col-lg-3 col-sm-6" style="height: 20px;">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-danger text-center">
                            <i class="ti-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>{{ boxTitle }}</p>
                            <h5>  {{ totalOrderQuantity }}</h5>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-reload"></i> {{ Updatednow }}
                </div>
            </div>-->
        </div>
    </div>

    <div class="col-lg-3 col-sm-6" style="height: 15px;">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="ti-shopping-cart-full"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>{{ TotalOrderAmount }}</p>
                            <h5>{{ totalOrderAmountData }}</h5>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-calendar"></i>{{ Lastday }}
                </div>
            </div>-->
        </div>
    </div>
    <div class="col-lg-3 col-sm-6" style="height: 20px;">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-danger text-center">
                            <i class="ti-wallet"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>{{ refund }}</p>
                            <h5>{{ refundRequestData }}</h5>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-timer"></i>{{ Inthelasthour }} 
                </div>
            </div>-->
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="ti-announcement"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>{{ Totalevent }}</p>
                            
                            
                            <h5>{{ totalEventData }}</h5>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-reload"></i> {{ Updatednow }}
                </div>
            </div>-->
        </div>
    </div>
</div>
<h4 class="page-header">Last 7 Day Report</h4>
<div class="row">
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="numbers pull-left">
                            <h3>{{ totalOrderSeven }}</h3>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="pull-right">
                            <span class="label label-success">
                                +18%
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="big-title">total earnings <span class="text-muted">in last</span> 7 <span class="text-muted">days</span></h6>
                <div id="chartTotalEarnings"></div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="footer-title">{{ FinancialStatistics }}</div>
                <div class="pull-right">
                    <button class="btn btn-info btn-fill btn-icon btn-sm">
                        <i class="ti-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="numbers pull-left">
                            169
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="pull-right">
                            <span class="label label-danger">
                                -14%
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="big-title">total subscriptions <span class="text-muted">in last</span> 7 days</h6>
                <div id="chartTotalSubscriptions"></div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="footer-title">{{ Viewallmembers }}</div>
                <div class="pull-right">
                    <button class="btn btn-default btn-fill btn-icon btn-sm">
                        <i class="ti-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="numbers pull-left">
                            8,960
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="pull-right">
                            <span class="label label-warning">
                                ~51%
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="big-title">total downloads <span class="text-muted">in last</span> 7 days</h6>
                <div id="chartTotalDownloads" ></div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="footer-title">{{ Viewmoredetails }}</div>
                <div class="pull-right">
                    <button class="btn btn-success btn-fill btn-icon btn-sm">
                        <i class="ti-info"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
