<div class="card padding_top15">
                                    <form method="#" action="#">
                                        <div class="header">
                                            <h4 class="title"> {{title}} <hr/> </h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="ticket ticket-small">
                                                        <div class="inner text-success">
                                                            <p class="text-danger text-uppercase">{{ ticket }}</p>
                                                            <p class="event-name bold">
                                                                <span class="">{{ EntryPass }}</span>
                                                                <span class="label label-success status-label ticket-limit">500 tickets</span>
                                                                <span class="pull-right">
                                                                    <i class="fa"><b> ৳ </b></i>
                                                                    <span class="">500</span>
                                                                </span>
                                                            </p>
                                                            <p class="ticket-time"> 11 Aug, 2016 @10:00 AM - 12 Aug, 2016 @10:00 AM </p>

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div id="addNewTicketCard" class="ticket ticket-small">
                                                        <a href="javascript:void(0);" class="inner text-success">
                                                            <div class="text-center" style="padding-top: 50px;">
                                                                <i class="fa fa-plus fa-2x bold"></i>
                                                                <p class="text-uppercase">{{ AddAnotherTicket }}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-md-offset-4">
                                                    <button type="submit" class="btn btn-fill btn-info btn-block">{{ submit }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix" style="padding: 30px;"></div>
                                </div>

