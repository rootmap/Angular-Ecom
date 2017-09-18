<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Venue List</h4>
<!--            <p class="category">Here is a Venue List Data for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Event Name</th>
                        <th>Venue Name</th>
                        <th>City</th>
                        <th>Country</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="venueList in venueListdata | limitTo:10">

                        <td class="text-center">{{ venueList.venue_id}}</td>
                        <td>{{ venueList.event_title}}</td>
                        <td>{{ venueList.venue_title}}</td>
                        <td>{{ venueList.city}}</td>
                        <td>{{ venueList.country}}</td>


                        <td class="td-actions text-right">
<!--                            <a href="venueAdd.php?vid={{ venueList.venue_id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>-->
                            <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeleteVenueList(venueList.venue_id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

