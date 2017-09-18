<?php
if (!empty($dsh_param)) {
    ?>
    <div class="card">

        <form class="step-content">
            <div class="card padding_top15">

                <div class="col-sm-4 text-center">
                    <a href="event_list.php" class="thumbnail bg1">
                        <h1><i class="pe-7s-helm"></i></h1>
                        <h5 class="text-uppercase">Event Name</h5>

                        <h3><span>{{ totaleventplace }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="order_list.php" class="thumbnail bg2">
                        <h1><i class="pe-7s-cash"></i></h1>
                        <h5 class="text-uppercase">{{ totalsales }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ totalsalesamount }} </span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="userlist.php" class="thumbnail bg3">
                        <h1><i class="pe-7s-graph2"></i></h1>
                        <!--                //Net Earnings-->
                        <h5 class="text-uppercase">{{ users }}</h5>
                        <h3><i class="fa"></i><span>{{ totalusers }}</span></h3>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4 text-center">
                    <a href="javascript:void(0)" class="thumbnail bg4">
                        <h1><i class="pe-7s-box1"></i></h1>
                        <h5 class="text-uppercase">{{ netbalance }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ totalnetbalance }} </span></h3>

                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="refundRequestList.php" class="thumbnail bg5">
                        <h1><i class="pe-7s-back-2"></i></h1>
                        <h5 class="text-uppercase">{{ refunds }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ refundsamount }}</span></h3>

                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="order_list.php" class="thumbnail bg6">
                        <h1><i class="pe-7s-note2"></i></h1>
                        <h5 class="text-uppercase">{{ TotalOrder }}</h5>
                        <h3><span>{{ TotalOrderAmount }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="ticket_list.php" class="thumbnail bg3">
                        <h1><i class="pe-7s-map"></i></h1>
                        <h5 class="text-uppercase">Ticket List</h5>
                        <h3><span>{{ ticketList }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="paymentMethodList.php" class="thumbnail bg2">
                        <h1><i class="pe-7s-cash"></i></h1>
                        <h5 class="text-uppercase">Payment Method</h5>
                        <h3><span>{{ paymentmethod }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="#!" class="thumbnail bg1">
                        <h1><i class="pe-7s-keypad"></i></h1>
                        <h5 class="text-uppercase">Total Attendees</h5>
                        <h3><span>{{ checkInmanagement }}</span></h3>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>

    <?php
} else {
    ?>
    <div class="card">

        <form class="step-content">
            <div class="card padding_top15">

                <div class="col-sm-4 text-center">
                    <a href="event_list.php" class="thumbnail bg1">
                        <h1><i class="pe-7s-helm"></i></h1>
                        <h5 class="text-uppercase">{{ eventname }}</h5>

                        <h3><span>{{ totaleventplace }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="order_list.php" class="thumbnail bg2">
                        <h1><i class="pe-7s-cash"></i></h1>
                        <h5 class="text-uppercase">{{ totalsales }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ totalsalesamount }} </span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="userlist.php" class="thumbnail bg3">
                        <h1><i class="pe-7s-graph2"></i></h1>
                        <!--                //Net Earnings-->
                        <h5 class="text-uppercase">{{ users }}</h5>
                        <h3><i class="fa"></i><span>{{ totalusers }}</span></h3>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4 text-center">
                    <a href="javascript:void(0)" class="thumbnail bg4">
                        <h1><i class="pe-7s-box1"></i></h1>
                        <h5 class="text-uppercase">{{ netbalance }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ totalnetbalance }} </span></h3>

                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="refundRequestList.php" class="thumbnail bg5">
                        <h1><i class="pe-7s-back-2"></i></h1>
                        <h5 class="text-uppercase">{{ refunds }}</h5>
                        <h3><i class="fa"></i><span>৳ {{ refundsamount }}</span></h3>

                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="order_list.php" class="thumbnail bg6">
                        <h1><i class="pe-7s-note2"></i></h1>
                        <h5 class="text-uppercase">{{ TotalOrder }}</h5>
                        <h3><span>{{ TotalOrderAmount }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="ticket_list.php" class="thumbnail bg3">
                        <h1><i class="pe-7s-map"></i></h1>
                        <h5 class="text-uppercase">Ticket List</h5>
                        <h3><span>{{ ticketList }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="paymentMethodList.php" class="thumbnail bg2">
                        <h1><i class="pe-7s-cash"></i></h1>
                        <h5 class="text-uppercase">Payment Method</h5>
                        <h3><span>{{ paymentmethod }}</span></h3>
                    </a>
                </div>
                <div class="col-sm-4 text-center">
                    <a href="#!" class="thumbnail bg1">
                        <h1><i class="pe-7s-keypad"></i></h1>
                        <h5 class="text-uppercase">Total Attendees</h5>
                        <h3><span>{{ checkInmanagement }}</span></h3>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>

    <?php
}
?>
