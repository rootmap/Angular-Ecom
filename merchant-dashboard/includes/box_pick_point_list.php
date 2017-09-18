<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Pick Point List</h4>
<!--            <p class="category">Here is a Pick Point List Data for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Point ID</th>
                        <th>Event Name</th>
                        <th>Point Address</th>
                        <th>point Contact details</th>
                       
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="pickPointList in pickPointListdata">

                        <td class="text-center">{{ pickPointList.id}}</td>
                        <td>{{ pickPointList.event_title}}</td>
                        <td>{{ pickPointList.address}}</td>
                        <td>{{ pickPointList.point_details}}</td>
                     


                        <td class="td-actions text-right">
<!--                            <a href="venueAdd.php?vid={{ pickPointList.id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>-->
                            <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeletepickPointList(pickPointList.id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

