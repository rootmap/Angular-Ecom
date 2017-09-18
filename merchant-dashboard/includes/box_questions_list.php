<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h2>{{ flyshow}}</h2>
            <h4 class="title">Questions List</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th> Questions Title</th>
                        <th>Questions Type</th>
                        <th> Event Title</th>
                        <th class="text-right">Status</th>

                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="questionList in questionListdata">

                        <td class="text-center">{{ questionList.form_id}}</td>
                        <td>{{ questionList.form_field_title}}</td>
                         <td>{{ questionList.form_field_type}}</td>
                        <td>{{ questionList.event_title}}</td>
                       
                        <td>{{ questionList.form_field_status}}</td>

                        <td class="td-actions text-right">
<!--                            <a href="add_more_questions.php?qid={{ questionList.form_event_id}}"  rel="tooltip" title="Edit Ticket" class="btn btn-success btn-simple btn-xs">
                                <i class="ti-pencil-alt"></i>
                            </a>-->
                            <a href="javascript:void(0);" rel="tooltip" title="Remove" ng-click="DeleteQustionList(questionList.form_id)" class="btn btn-danger btn-simple btn-xs">
                                <i class="ti-close"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
