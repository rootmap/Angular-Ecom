
<div class="card">
    <div class="card padding_top15">

        <div class="header">
            <h4 class="title">
                <i class="fa fa-magic"></i>{{test}}
                <hr/>
            </h4>
        </div>



        <div class="table-responsive">
            
            <div class="col-md-12">
                <form class="navbar-form navbar-left navbar-search-form" role="search">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input value="" name="valu_sar" class="form-control"  ng-model="search" placeholder="Search..." type="text">
                    </div>
                </form>
            </div>    
            
            <table class="table table-bordered table-hover" style="border-collapse:collapse; ">
                <thead style="position:fix">
                    <tr class="">
                        <th class="table_heading text-center">
                            <p>Item</p>
                        </th>
                        <th class="table_heading text-center">
                            <p>Item name</p>
                        </th>
                        <th class="table_heading text-center">
                            <p>Ticket type</p>
                        </th>
                        <th class="table_heading text-center">
                            <p>Date</p>
                        </th>
                        <th class="table_heading text-center">
                            <p>Action</p>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr data-toggle="collapse" data-target=".demo1" ng-repeat="x in wishlistData | filter:search | orderBy:'event_title'">
                        <td id="package1" class="text-center">
                            <img class="img-rounded" style="" src="../upload/event_web_logo/{{x.event_web_logo}}" alt="Image missing" width="104" height="100">
                        </td>
                        <td class="text-center">{{x.event_title}}</td>
                        <td class="text-center">{{x.WL_product_type}}</td>
                        <td class="text-center">{{x.date}}</td>
                        <td class="text-center">
                            <a href="../checkout1.php?id={{x.event_id}}">
                                <button type="button" class="btn btn-success success-rounded-outline waves-effect"><i class="fa fa-cart-plus" aria-hidden="true"></i> Buy Ticket</button>
                            </a>
                            <button ng-click="deleteInfo(x)"  type="button" class="btn btn-danger danger-rounded-outline waves-effect"><i class="fa fa-remove"></i> remove</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                        <tr>
                            <td colspan="8" align="right">
<!--                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="disabled">
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav> -->
                            </td>
                        </tr>

                    </tfoot>
            </table>
            
        </div>



    </div>
</div>
