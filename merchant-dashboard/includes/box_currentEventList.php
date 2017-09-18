<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Current Event List</h4>
            <p class="category">Here is a subtitle for this table</p>
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

            <!--Button End Here-->
            <div class="content table-responsive table-full-width">
                <div ng-init="eventlist[]">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="text-center">Event ID</td>
                                <td>Event Name</td>
                                <td>Event Category</td>
                                <td>Event Type</td>
                                <td>Organized By</td>
                                <td>Status</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="eventlist in eventlistdata| filter:search">
                                <td class="text-center">{{ eventlist.event_id}}</td>
                                <td>{{ eventlist.event_title}}</td>
                                <td>{{ eventlist.category_title}}</td>
                                <td>{{ eventlist.name}}</td>
                                <td>{{ eventlist.organized_by}}</td>
                                <td>{{ eventlist.event_status}}</td>
                                <td>{{ eventlist.event_created_on}}</td>
                                <td>{{ eventlist.event_created_end}}</td>


                                <td class="td-actions text-right">

                                    <a href="edit_event.php?eid={{eventlist.event_id}}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a  href="javascript:void(0);" rel="tooltip" ng-click="Deleteventlist(eventlist.event_id)" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="ti-close"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div>{{ eventlist|json }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
