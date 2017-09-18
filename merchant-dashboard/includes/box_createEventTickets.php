<div class="card padding_top15">

    <form method="post">
        <div class="header">
            <h4 class="title">
                {{ newEventtickets}}
              
                <hr/>
            </h4>
        </div>
        <div class="content">
            <div class="row">

                <div class="col-md-4 col-md-offset-2">
                    <?php 
                        if (!empty($_GET['tid'])){
                    ?>
                    <div class="form-group">
                       <label>Event Name</label>{{mrchntNew.evtlist[0].event_id}}
                       <input type="text" placeholder="Event Name" id="e_id" class="form-control" ng-model="evtlist[0].event_title" disabled>
                       
                    </div>
                    <?php 
                        }else{
                    ?>
                    <div class="form-group">
                        <label>Select Event</label>
                        <select placeholder="Select Event" class="form-control" ng-model="mrchntNew.event_id">
                            <option value="">Select Event</option>
                            <option ng-repeat="evt in evtlist" value="{{ evt.event_id}}">{{ evt.event_title}}</option><!-- ng-selected="{{evt.event_id}}=={{mrchntNew.event_id}}"-->
                        </select>
                    </div>
                    <?php 
                       }
                    ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ TicketName}}</label>
                        <input type="text" id="TicketNameEdit" placeholder="Ticket Name" class="form-control" ng-model="mrchntNew.TicketName">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="form-group">
                        <label>Total Quantity</label>
                        <input type="text" placeholder="Total Quantity" id="QtyEdit" class="form-control" ng-model="mrchntNew.Qty">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{ MinQty}}</label>
                        <input type="text" placeholder="1" id="minQtyEdit" class="form-control" ng-model="mrchntNew.MinQty">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>{{ MaxQty}}</label>
                        <input type="text" placeholder="10" id="MaxQtyEdit"  class="form-control" ng-model="mrchntNew.MaxQty">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <div class="form-group">
                        <label>{{ TicketType}}</label>
                        <select  ng-model="mrchntNew.TicketType" class="form-control"  data-title="Single Select" id="TicketTypeEdit">
                            <option value="">Select Type</option>
                            <option ng-repeat="tt in ticketTypedata" ng-selected="{{tt.id}}=={{typedefit}}" value="{{ tt.id}}">{{ tt.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group col-sm-6">
                        <label for="ticketPrice" class="control-label">{{ Currency}}</label>
                        <select class="form-control" data-title="Single Select" id="CurrencyEdit" ng-model="mrchntNew.Currency">
                            <option value="">Select Type</option>
                            <option ng-repeat="current in CurrentData"  value="{{ current.name}}" ng-selected="{{ current.name}}=={{curnt}}">{{ current.name}}</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="ticketPrice" class="control-label">{{ Price}}</label>
                        <input type="text"  placeholder="Ex: 1000" class="form-control" name="ticketPrice" id="ticketPrice" required="required" ng-model="mrchntNew.Price">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="form-group">
                        <label>Availability</label><br/>
                        <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
                            <label class="btn btn-success" ng-click='mrchntNew.aid = "1"'>
                                <input   type="radio" name="options" id="option1" value="available" checked="checked"/>
                                Available<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>

                            <label class="btn btn-success" ng-click='mrchntNew.aid = "2"'>
                                <input    type="radio" name="options" id="option2" value="halt">
                                Halt<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>

                            <label class="btn btn-success" ng-click='mrchntNew.aid = "3"'>
                                <input    type="radio" name="options" id="option3" value="hidden">
                                Hidden<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ WhowillpayTicketchaifee}}</label><br/>
                        <div class="btn-group" data-toggle="buttons" role="group" aria-label="..." id="WhowillpayTicketchaifeeEdit">
                            <label class="btn btn-success" ng-click='mrchntNew.WhowillpayTicketchaifee = "1"' >
                                <input type="radio" name="options2" id="options1" value="me" checked="checked"/>
                                Me<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>

                            <label class="btn btn-success" ng-click='mrchntNew.WhowillpayTicketchaifee = "2"' >
                                <input type="radio" name="options2" id="options2" value="customer">
                                Customer<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </label>

                        </div>
                    </div>
                </div>

                <!--                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ WhowillpayTicketchaifee}}</label><br/>
                                        <div class="btn-group" role="group" aria-label="..." id="WhowillpayTicketchaifeeEdit">
                                            <button type="button" ng-click='mrchntNew.WhowillpayTicketchaifee = "1"' class="btn btn-success" value="1">Me</button>
                                            <button type="button"  ng-click='mrchntNew.WhowillpayTicketchaifee = "2"' class="btn btn-success" value="2">Customer</button>
                                        </div>
                                    </div>
                                </div>-->
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <div class="form-group">
                        <label class="control-label">{{ StartDate}}</label>
                        <input  ng-model="mrchntNew.startdate" id="start-date" type="text"  class="form-control datepicker" placeholder="Date Picker Here" />



                        <!--                        <div  id="start-date-box" class="preview preview-date start" style="margin-top: 30px;">
                                                                                                                                        <input type="text" class='form-control input-group date' id='datetimepicker1' required>
                                                    <div id="StartDateEdit">
                                                        <p class="text-info">
                                                            <span>08</span>
                                                            <br>
                                                            <span>Aug, 2016</span>
                                                        </p>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ StartTime}}</label>
                        <input  id="start-time"  ng-model="mrchntNew.starttime"  type="text" class="form-control timepicker"  placeholder="Time Picker Here" />
                        <!--                        <a href="javascript:void(0);" id="start-time-box" class="preview preview-time start" style="margin-top: 30px;">
                                                                                                                                        <input type="text"class="form-control date-time-sr-only" id="startTime">
                                                    <div id="StartTimeEdit">
                                                        <p class="text-info">
                                                            <span>06:00</span>
                                                            <span>PM</span>
                                                        </p>
                                                    </div>
                                                </a>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="form-group">
                        <label class="control-label">{{ EndDate}}</label>
                        <input id="end-date"  ng-model="mrchntNew.enddate" type="text" class="form-control datepicker" id="EndDateEdit" placeholder="Date Picker Here" />
                        <!--                        <a href="javascript:void(0);" id="end-date-box" class="preview preview-date start" style="margin-top: 30px;">
                                                                                                                                        <input type="text" class="form-control date-time-sr-only" required>
                                                    <div>
                                                        <p class="text-info">
                                                            <span>08</span>
                                                            <br>
                                                            <span>Aug, 2016</span>
                                                        </p>
                                                    </div>
                                                </a>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ EndTime}}</label>
                        <input id="EndTimeEdit"   ng-model="mrchntNew.endtime"  type="text" class="form-control timepicker" placeholder="Time Picker Here" ng-model="mrchntNew.EndTime"/>
                        <!--                        <a href="javascript:void(0);" id="end-time-box" class="preview preview-time start" style="margin-top: 30px;">
                                                                                                                                        <input type="text" class="form-control date-time-sr-only" id="startTime">
                                                    <div id="EndTimeEdit">
                                                        <p class="text-info">
                                                            <span>{{ EndTimeEdit}}</span>
                                                                                            <span>PM</span>
                                                        </p>
                                                    </div>
                                                </a>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label for="1">{{ TicketDescription}}</label>
                        <textarea rows="3" placeholder="Ticket Description" class="form-control" id="TicketDescriptionEdit" ng-model="mrchntNew.TicketDescription"></textarea>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label for="1">{{ MessageToAttendee}}</label>
                        <textarea rows="3" placeholder="ex:Please Reach The Venue 15 Minutes Before The Show Start Time" id="MessageToAttendeeEdit" class="form-control" ng-model="mrchntNew.MessageToAttendee"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                    @$edit = $_GET['edit'];
                    if (isset($_GET['edit'])) {
                        ?>
                    <button type="btn" ng-click="insert(mrchntNew,'edit','<?php echo $edit = $_GET['tid']; ?>',evtlist[0].event_id)" class="btn btn-fill btn-info btn-block" >{{ Save}}</button>
                    <?php
                    } else { ?>
                         <button type="btn"  ng-click="insert(mrchntNew)" class="btn btn-fill btn-info btn-block" >{{ Save}}</button>
                  <?php  }
                    ?>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix" style="padding: 30px;"></div>
</div>

