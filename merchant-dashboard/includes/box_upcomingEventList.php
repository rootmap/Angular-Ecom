<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow }}</h2>
            <h4 class="title">Upcoming Event List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
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
                    <tr ng-repeat="eventlist in eventlistdata">
                        <td class="text-center">{{ eventlist.event_id }}</td>
                        <td>{{ eventlist.event_title }}</td>
                        <td>{{ eventlist.event_category_id }}</td>
                        <td>{{ eventlist.event_type }}</td>
                        <td>{{ eventlist.organized_by }}</td>
                        <td>{{ eventlist.event_status }}</td>
                        <td>{{ eventlist.event_created_on }}</td>
                        <td>{{ eventlist.event_created_end }}</td>


                        <td class="td-actions text-right">
<!--                            <a href="#" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                <i class="ti-user"></i>
                            </a>-->
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
        </div>
    </div>
</div>
