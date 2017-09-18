<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Event List</h4>
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
            <div ng-init="eventlist[]">

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event Type</th>
<!--                            <th>Organized By</th>-->
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="td-actions text-center" width="100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="eventlist in eventlistdata| limitTo:10 | filter:search">
                            <td class="text-center">{{ eventlist.event_id}}</td>
                            <td>{{ eventlist.event_title | uppercase  }}</td>
                            <td>{{ eventlist.category_title}}</td>
                            <td>{{ eventlist.name}}</td>
<!--                            <td>{{ eventlist.organized_by}}</td>-->
                            <td><a  href="change_event_status.php?eid={{ eventlist.event_id}}">{{ eventlist.event_status}}</a></td>
                            <td>{{ eventlist.event_created_on | date:'shortTime'}}</td>
                            <td>{{ eventlist.event_created_end | date:'shortTime'}}</td>


                            <td class="td-actions text-right">
                                <div ng-if="eventlist.event_status!='delete'" class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href=".././checkout1.php?id={{eventlist.event_id}}" target="_blank" rel="tooltip" title="Clone This Event" class="text-warning">
                                                <i class="fa fa-globe"></i> Preview
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="reports_1.php?rpt={{eventlist.event_id}}" target="_blank" rel="tooltip" title="Clone This Event" class="text-warning">
                                                <i class="fa fa-pie-chart"></i> Report
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="dashboard.php?dsh={{eventlist.event_id}}" target="_blank"  rel="tooltip" title="Edit Profile" class="text-info">
                                                <i class="fa fa-dashboard"></i> Dashboard
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="clone_event.php?eid={{eventlist.event_id}}" target="_blank"  rel="tooltip" title="Clone This Event" class="text-warning">
                                                <i class="fa fa-clone"></i> Clone
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="edit_event.php?eid={{eventlist.event_id}}" target="_blank"  rel="tooltip" title="Edit Profile" class="text-info">
                                                <i class="ti-pencil-alt"></i> Modify
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a  href="javascript:void(0);" rel="tooltip" ng-click="Deleteventlist(eventlist.event_id)" title="Remove" class="text-danger">
                                                <i class="ti-close"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>


                <div>{{eventlist| json}}</div>
            </div><!--ng-init end here-->
        </div>
    </div>
</div>
