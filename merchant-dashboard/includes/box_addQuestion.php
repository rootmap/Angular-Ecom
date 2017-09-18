<div class="card padding_top15">
    <form method="post" action="#" ng-model="addSingelData">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">
                {{ TicketsDetails}}
                <hr/>
            </h4>
        </div>
        <div class="content">
            <div class="row">
                <?php if (isset($_GET['eventId'])) {
                    ?>
                    <span ng-init="makeDefEvent('<?php echo $_GET['eventId']; ?>')"></span>
                <?php }
                ?>
                <style type="text/css">
                    select option:empty { display:none }
                </style>
                <div class="col-md-8 col-md-offset-2" id="evtbox">
                    <label>Select Event </label>
                    <select ng-init="addSingelData=''"  ng-model="addSingelData.eventTitle"  class="form-control" >
                        
                        <option value="">Select Event</option>
                        <option ng-repeat="eventOffCk in EvntOffChk"  value="{{ eventOffCk.event_id}}" ng-selected="{{ eventOffCk.event_id}}=={{ addSingelData.eventTitle}}" >{{ eventOffCk.event_title}} </option>
                        <!--<option value="">Please Select Event</option>-->
                        
                    </select>
                    
                   
                </div>

                <div class="clearfix"></div>

                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group"><br>
                        <label>{{ NameMandatory}}</label>
                        <input readonly="readonly" type="text" placeholder="Attendee's Answer | Default Field" class="form-control">
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label>{{ EmailMandatory}}</label>
                        <input readonly="readonly" type="text" placeholder="Attendee's Answer | Default Field" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label>Phone(Mandatory)</label>
                        <input readonly="readonly" type="text" placeholder="Attendee's Answer | Default Field" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-8 col-md-offset-2">
                    <code>Both Field/Questions is added when you are creating event, You can add more field by click "Continue", or you can finish and goto your event list.</code>
                    <br><br>
                </div>
            </div>




            <div class="row">
                <div class="col-md-5 col-md-offset-2">

                    <a href="#" class="btn btn-fill btn-info" ng-click="addskipData('<?php echo $_GET['eventId']; ?>',addSingelData.eventTitle)"><i class="fa fa-forward"></i> Continue Next</a> 
                    <a href="event_list.php" class="btn btn-fill btn-success"><i class="fa fa-check-circle-o"></i> Done Setting</a>
                </div>

            </div>


        </div>
    </form>
    <div class="clearfix" style="padding: 30px;"></div>
</div>