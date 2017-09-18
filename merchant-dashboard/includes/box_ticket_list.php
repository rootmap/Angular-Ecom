<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Tickets List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width" id="ticlkst">
            


            <table class="table">
                <thead>
                    <tr >
                        <th class="text-center">ID</th>
                        <th>Event Name</th>
                        <th>Ticket Name</th>
                        <th>Qty</th>
                        <th class="text-center">Ticket Type</th>
<!--                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>-->
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="ticketList in ticketListdata | limitTo:100">

                        <td class="text-center">{{ ticketList.TT_id}}</td>
                        <td>{{ ticketList.event_title}}</td>
                        <td>{{ ticketList.TT_type_title}}</td>
                        <td>{{ ticketList.TT_ticket_quantity}}</td>
                        <td class="text-center">{{ ticketList.TT_type_id}}</td>
<!--                        <td class="text-center">{{ ticketList.TT_startDate }}</td>
                        <td class="text-center">{{ ticketList.TT_endDate }}</td>-->
                        <td class="td-actions text-right">
                            <a href="create_event_tickets.php?edit=edit&tid={{ticketList.TT_id}}"   title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>
                            <a href="javascript:void(0);"  title="Remove" ng-click="DeleteticketList(ticketList.TT_id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
