<div class="card padding_top15">
    <form method="post" ng-submit="AddAllQCData(rw)" name="morequestion">
        <input class="form-control" type="hidden"   ng-model="AddAllQCData.Id">
        <input class="form-control" type="hidden"   ng-model="EventId=<?php echo $eventID; ?>" />
        <div class="header">
            <h4 class="title">
                <h2>{{ flyshow}}</h2>
                {{ headeTitle}}
                <hr/>
                {{ amarnam}}
            </h4>
        </div>
        <div class="content">

            <table style="width: 100%;">
                <tbody>
                    <tr ng-repeat="rw in rows">
                        <td id="{{ rw}}">
                            <div class="row well" style="margin-bottom: 5px;">
                                <a style="display: none;" href="javascript:closeclone(0);"><i class="fa fa-times-circle"></i></a>
                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group">
                                        <label>{{ QuestionTitle}}</label>
                                        <input ng-model="rw.qt" name="qt[]" type="text" placeholder="eg:Contact Number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ QuestionType}}</label>
                                        <select ng-model="rw.ft" name="ft[]" class="form-control">
                                            <option class="" disabled="" value="" selected="selected">Please select type</option>
                                            <option label="textbox" value="textbox">Text Box</option>
                                            <option label="selectbox" value="selectbox">Select Box Option</option>
                                            <option label="radio" value="radio">Radio</option>
                                            <option label="checkbox" value="checkbox">Check Box</option>
                                            <option label="File" value="File">File</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
<!--                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group">
                                        <label>{{ Showfollowingtickets}}</label>
                                        <label>
                                            <input ng-true-value="'1'" ng-false-value="'0'" ng-model="rw.ep" name="ep[]"  type="checkbox" value="pass">
                                            {{  EntryPass}}
                                        </label>
                                    </div>
                                </div>-->

                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group">
                                        <label>{{ QuestionStatus}}</label><br>
                                        <label>
                                            <input type="radio" ng-model="rw.vd" name="{{rw.rein}}" value="yes"  id="{{rw.rein}}_0">
                                            {{ required}}
                                        </label><br>
                                        <label>
                                            <input type="radio"  ng-model="rw.vd" name="{{rw.rein}}" value="no"  id="{{rw.rein}}_1">
                                            {{  optional}}
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>                    

            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <button type="button" ng-click="addRow()" class="btn btn-fill btn-info btn-block"><i class="fa fa-plus"></i> {{ AddMoreQuestions}}</button>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-fill btn-info btn-block"  name="submit" type="button"  ng-show="!update" ng-click="AddAllQCData()" href="questions_list.php">{{ Submit}}</a>
                   <button class="btn btn-info" name="submit" type="button" ng-show="update" ng-click="AddAllQCDataUpdate()">Update</button>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix" style="padding: 30px;"></div>
</div>


<script type="text/javascript">
//    function addTableRow(table)
//    {
//       
//        
//        var $tr = $(table + ' tbody:first').children("tr:last").clone();
//        
//        $tr.find("input[type!='hidden'][name*=first_name],select,button").clone();
//        $tr.find("button[name*='ViewButton']").remove();
//        var lastincre=$tr.attr("id");
//        console.log(lastincre);
//        if(lastincre=="cl")
//        {
//            var i=1;
//        }
//        else
//        {
//            //var i;
//            var i=(lastincre-0)+(1-0);
//        }
//        $tr.attr("id",i);
//        $tr.find("a").css("display","inline");
//        $tr.find("a").attr("href","javascript:closeclone("+i+");");
//        $(table + ' tbody:first').children("tr:last").after($tr);
//        
//        
//        
//    }
//    
//    function closeclone(par)
//    {
//        if(par!="0")
//        {
//            $("#"+par).remove();
//        }
//    }

</script>