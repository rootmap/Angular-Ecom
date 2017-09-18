<div class="col-md-12">
    <div class="card">
        <div class="header">
            <!--<h2>{{ flyshow}}</h2>-->
            <h4 class="title">Attendees Report List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->

        </div>

        <div class="content table-responsive table-full-width">
            <div class="col-md-12">
<!--                <input  class="form-control" type="text" ng-model="search">-->
                <form class="navbar-form navbar-left navbar-search-form" role="search">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input value="" name="valu_sar" class="form-control"  ng-model="search" placeholder="Search..." type="text">
                    </div>
                </form>

                <div class="col-md-2"><br>


                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Date Wise Event Report</button>
                </div>
                <!--Button End Here-->
            </div>

            <div class="cleafix"></div>



            <div class="cleafix"></div>
            <div ng-init="attendlist[]">

                <table class="table">
                    <thead>
                        <tr>

                            <th>Ticket No</th>
                            <th>Date Time</th>
                            <th>Event</th>
                            <th>Customers</th>
                            <th>Phone</th>
                            <th>Status</th>

<!--                            <th class="td-actions text-center" width="100">Actions</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="attendlist in attendlistdata| limitTo:10 | filter:search">
                            <td>{{ attendlist.ticket_id}}</td>
                            <td>{{ attendlist.datetime}}</td>
                           
                            <td>{{ attendlist.event_title}}</td>
                            <td>{{ attendlist.fullname}}</td>
                            <td>{{ attendlist.user_phone}}</td>
                            <td>{{ attendlist.status}}</td>



                            <td class="td-actions text-right">
                                <!--                                <a href="create_event.php?eid={{eventlist.event_id}}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </a>-->
                                <a  href="javascript:void(0);"  ng-click="Deleteventlist(attendlist.event_id)" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                    <i class="ti-close"></i>
                                </a>
                            </td>
                        </tr>
						


                    </tbody>

                </table>


                <div>{{attendlist| json}}</div>
            </div><!--ng-init end here-->
        </div>
    </div>
</div>
