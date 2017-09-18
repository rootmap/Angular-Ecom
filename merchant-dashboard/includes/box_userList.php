<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">User List</h4>
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
<!--            Button End Here-->
            </div>





            <div class="cleafix"></div>
            <div ng-init="userlist[]">

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User phone</th>
                            <th>user gender</th>
                          
<!--                            <th class="td-actions text-center" width="100">Actions</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="userlist in userlistdata | limitTo:50 | filter:search">
                            <td class="text-center">{{ userlist.user_id}}</td>
                            <td>{{ userlist.fullname  }}</td>
                            <td>{{ userlist.user_email}}</td>
                            <td>{{ userlist.user_phone}}</td>
                            <td>{{ userlist.user_gender}}</td>
                            


<!--                            <td class="td-actions text-right">
                                <a href="create_event.php?eid={{eventlist.event_id}}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a  href="javascript:void(0);" rel="tooltip" ng-click="Deleteventlist(eventlist.event_id)" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                    <i class="ti-close"></i>
                                </a>
                            </td>-->
                        </tr>

                    </tbody>

                </table>


                <div>{{userlist| json}}</div>
            </div><!--ng-init end here-->
        </div>
    </div>
</div>
