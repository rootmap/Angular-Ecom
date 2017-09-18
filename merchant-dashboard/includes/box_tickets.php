<div class="col-md-12">
    <div class="card">
        <div class="header">
            <!--<h2>{{ flyshow}}</h2>-->
            <h4 class="title">All Event Tickets</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width" id="ticlkst">
            <div class="col-md-6 col-md-offset-3">
                
                    <div class="ticket ticket-small" ng-repeat="ticketList in ticketListdata">
                        <a href="create_event_tickets.php?edit=edit&tid={{ticketList.TT_id}}">
                        <div class="inner text-success">
                            <p class="text-danger text-uppercase">Event Name: {{ ticketList.event_title}}</p>
                            <p class="text-danger text-uppercase">Ticket Name: {{ ticketList.TT_type_title}}</p>
                            <p class="event-name bold">
                                <span class="">{{ ticketList.TT_type_id}}</span>
                                <span class="label label-success status-label ticket-limit">Quantity : {{ ticketList.TT_ticket_quantity}}</span>
                                <span class="pull-right">
                                    <i class="fa"><b> ৳ </b></i>
                                    <span class="">{{ ticketList.TT_price}}</span>
                                </span>
                            </p>
                            <p class="ticket-time"> {{ ticketList.TT_startDate}} @{{ ticketList.TT_startTime}} - {{ ticketList.TT_endDate}} @{{ ticketList.TT_endTime}} </p>

                        </div>

                        <div class="clearfix"></div>
                        </a>
                    </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>


        </div>
    </div>
</div>
