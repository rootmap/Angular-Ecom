<div class="">
                                <div class=" padding_top15">

                                    <div class="header">
                                        <h4 class="title">
                                                <i class="fa fa-shopping-cart"></i> {{cart}}
                                                <hr/>
                                            </h4>
                                    </div>

                                    <div class="card">


                                        <div class="content table-responsive col-lg-12 col-md-12 col-sm-12 col-xm-12">
                                            <table class="table table-bordered table-hover">
                                                <thead style="position:fix">
                                                    <tr class="">
                                                        <th class="table_heading text-center">
                                                            <p>Item</p>
                                                        </th>
                                                        <th class="table_heading text-center">
                                                            <p>Item name</p>
                                                        </th>
                                                        <th class="table_heading text-center">
                                                            <p>Unit Price</p>
                                                        </th>
                                                        <th class="table_heading text-center">
                                                            <p>Quantity</p>
                                                        </th>
                                                        <th class="table_heading text-center">
                                                            <p>SubTotal</p>
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody >
                                                    <tr ng-repeat="x in userCartData">
                                                        <td id="package1" class="text-center">
                                                            <img class="img-rounded"  src="../upload/event_web_banner/{{x.event_web_logo}}" alt="Image missing"  width="104" height="100">
                                                        </td>
                                                        <td class="text-center">{{x.event_title}}</td>
                                                        <td class="text-center">TK. {{x.EITC_unit_price}}</td>
                                                        <td class="text-center">{{x.EITC_quantity}}</td>
                                                        <td class="text-center">৳ {{x.EITC_unit_price * x.EITC_quantity}} </td>
                                                        <td class="text-center">
                                                            <button ng-click="deleteInfo(x)"  type="button" class="btn btn-danger danger-rounded-outline waves-effect"><i class="fa fa-remove"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>





                                </div>
                            </div>
