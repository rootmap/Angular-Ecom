<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Online Check in</h4>
            <p class="category">Here is a Online Check in</p>

            <div class="row-fluid">

                <div class="col-md-12">
                    {{ flyshow }}
                </div>
            </div>    
           
            <!--input field start here-->
            <div class="row-fluid">
                    
                <div class="col-md-6" style="margin-left:0px; padding-left:0px;">
                    <div class="input-group">
                        <input type="text" ng-model="rw.tocken" ng-keypress="($event.which === 13)?DataSave(rw):0"  class="form-control" placeholder="Barcode Here..." aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">Type Barcode & Press Enter</span>
                    </div>


                </div>
                <div class="col-md-3">
                    <div class="input-group" style="margin-top: -37px;">
                        <label  class="label label-success">In-Time Punch Only 
                            <input ng-model="rw.inout" value="IN" class="form-control" type="radio" id="pun_0" name="pun" />
                            
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group" style="margin-top: -37px;">
                        <label class="label label-success">Out-Time Punch Only 
                            <input ng-model="rw.inout" value="OUT" class="form-control" type="radio" id="pun_1" name="pun" />
                        </label>
                    </div>
                </div>
            </div>


            <!--input field end here-->
        </div>


        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Ticket No#</th>
                        <th>Date Time</th>
                        <th>Events</th>
                        <th>Customers</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="ckl in checkinlistdata">
                        <td class="text-center">{{ ckl.id }}</td>
                        <td>{{ ckl.ticket_id }}</td>
                        <td>{{ ckl.datetime }}</td>
                        <td>{{ ckl.event_title }}</td>
                        <td>{{ ckl.user_first_name }}</td>
                        <td>{{ ckl.user_phone }}</td>
                        <td>{{ ckl.status }}</td>
                        
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>