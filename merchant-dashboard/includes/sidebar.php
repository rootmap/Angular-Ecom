<div class="sidebar" data-background-color="brown" data-active-color="danger">
    <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="logo text-center db_tc_logo_bg">
        <a href="../index.php" class="db-logo text-center">
            <img src="assets/img/white-shadow-logo.png" alt="Ticketchai Logo"/>
        </a>
    </div>
    <div class="logo logo-mini db_tc_logo_bg">
        <a href="#!" class="simple-text">
            <img src="assets/img/fav1.png" alt="Ticketchai Logo"/>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <a href="profileImage.php">
                <div class="photo">
                    <img src="../upload/merchent_images/<?php echo $defimage; ?>" />
                </div>
            </a>    
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <?php echo $login_user_name; ?>
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li><a href="user_profile.php">My Profile</a></li>
                        <li><a href="user_edit_profile.php?uid=<?php echo $login_user_id; ?>">Edit Profile</a></li>
                        <li><a href="changePassword.php">Change Password</a></li>
                        <li><a href="profileImage.php">Change Profile Image</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a href="events.php">
                    <i class="pe-7s-display1 bold"></i>
                    <p>Organizer View</p>
                </a>
            </li>

            <li>
                <a href="create_event_journey.php">
                    <i class="pe-7s-display1 bold"></i>
                    <p> Create Event 
                        <!--                        <b class="caret"></b>-->
                    </p>
                </a>
            </li>


            <li>
                <a data-toggle="collapse" href="#Events">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Event Setting
                        <b class="caret"></b>
                    </p>
                </a> 
                <div class="collapse" id="Events">
                    <ul class="nav">
                        <!--<li><a href="create_event.php">Create Event</a></li>-->
                        <!--<li><a href="event_list.php">Event List</a></li>-->
                        <li><a href="event_list.php">Manage Event</a></li>
                        <li><a href="current_event_list.php">Current Event List</a></li>
                        <!--<li><a href="arcive_event_list.php">Popular Event List</a></li>-->
                        <li><a href="upcoming_event_list.php">Upcoming Event List</a></li>
                        <li><a href="change_event_status.php">Change Event Status</a></li>
                        <!--<li><a href="register.php">Register</a></li>-->
                        <li><a href="add_questions.php">Edit Question Form</a></li>
                        <li><a href="questions_list.php">Question List</a></li>
                        <li><a href="userlist.php">User List</a></li>
                        <li><a href="partnersImg.php">Upload Event Partners Images</a></li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#EventsExtraSettings">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Payment Settings
                        <b class="caret"></b>
                    </p>
                </a> 
                <div class="collapse" id="EventsExtraSettings">
                    <ul class="nav">
                        <li><a href="payment_method.php">Payment Method Online</a></li>
                        <li><a href="paymentMethodList.php">Payment Method Online List</a></li>
                        <li><a href="paymentMethodOffline.php">Payment Method Offline</a></li>
                        <li><a href="paymentMethod_offlineList.php">Payment Method Offline List</a></li>

                        <li><a href="paymentGetwayChargesListController.php">Payment Gateway Charges  </a></li>
                        <li><a href="paymentGetwayChargesServicesList.php">Payment Gateway Charge List </a></li>

                        <!--<li><a href="add_more_questions.php">Add more Questions</a></li>-->


                    </ul>
                </div>
            </li>

            <li>    
                <a data-toggle="collapse" href="#Refund">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Refund
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Refund">
                    <ul class="nav">

                        <li><a href="newrefundrequest.php">New Refund Request</a></li>
                        <li><a href="refundRequestList.php">Refund Request List</a></li>

                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#manal_order">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Order management
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="manal_order">
                    <ul class="nav">

                        <li><a href="manual_order.php"> Manual order</a></li>
                        <li><a href="order_list.php">Order List</a></li>
                        <li><a href="quick_order_venue.php">Quick Order venue</a></li>

                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#checking_management">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Attendees management
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="checking_management">
                    <ul class="nav">

                        <li><a href="online_checking.php">Online Check in</a></li>
                        <li><a href="attendees_report.php">Attendees report</a></li>

                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#Tickets">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Tickets
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Tickets">
                    <ul class="nav">
                        <li><a href="tickets.php">All Tickets</a></li>
                        <li><a href="ticket_list.php">Ticket List</a></li>
                        <li><a href="create_event_tickets.php">Create Ticket</a></li>
                        <!--                                    <li><a href="event_list.php">Event List</a></li>
                                                            <li><a href="venue_list.php">Venue List</a></li>-->
                    </ul>
                </div>
            </li>

            <li>
                <a href="reports_1.php">
                    <i class="pe-7s-display1 bold"></i>
                    <p>Reports 

                    </p>
                </a>

            </li>

            <li>
                <a data-toggle="collapse" href="#EventsButton">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Events Button
                        <b class="caret"></b>
                    </p>
                </a> 
                <div class="collapse" id="EventsButton">
                    <ul class="nav">
                        <li><a href="eventExtraButtonSetting.php"> Set Event Button</a></li>
                        <li><a href="eventButtonList.php">Event Button List</a></li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#manal_orders">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Venue settings
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="manal_orders">
                    <ul class="nav">
                        <li><a href="venueAdd.php">Add Venue</a></li>
                        <li><a href="venue_list.php">List Of Venue</a></li>

                    </ul>
                </div>
            </li>


            <li>
                <a data-toggle="collapse" href="#pickpoint">
                    <i class="pe-7s-display2 bold"></i>
                    <p>Pickup Point
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pickpoint">
                    <ul class="nav">
                        <!--                        <li><a href="add_questions.php">Add Questions</a></li>-->
                        <li><a href="manualNewPickuppoint.php"> Manual new pickup point  </a></li>
                        <li><a href="pickPointList.php">Pick Point List </a></li>


                    </ul>
                </div>
            </li>

            <li>
                <a href="dashboard.php">
                    <i class="pe-7s-display1 bold"></i>
                    <p>Event Dashboard

                    </p>
                </a>

            </li>
            <!--            <li>
                            <a href="analystics.php">
                                <i class="pe-7s-display1 bold"></i>
                                <p>Analystics
                                    <b class="caret"></b>
                                </p>
                            </a>-->
            <!--                                <div class="collapse" id="Analytics">
                                                <ul class="nav">
                                                    <li><a href="#">All Events</a></li>
                                                    <li><a href="#">Test Event - 01</a></li>
                                                    <li><a href="#">Test Event - 02</a></li>
                                                    <li><a href="analystics.php">Analystics</a></li>
                                                </ul>
                                            </div>-->
            <!--</li>-->

            <!--            <li>
                            <a href="reports.php">
                                <i class="pe-7s-display1 bold"></i>
                                <p>Reports 1
                                    <b class="caret"></b>
                                </p>
                            </a>
            
                        </li>-->



            <!--            <li>
                            <a data-toggle="collapse" href="#coustom">
                                <i class="pe-7s-display2 bold"></i>
                                <p>Custom Field/Questions
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="coustom">
                                <ul class="nav">
                                    <li><a href="add_questions.php">Add Questions</a></li>
                                    <li><a href="questions_list.php">Question List</a></li>
            
                                </ul>
                            </div>
                        </li>-->


            <!--            <li>
                            <a data-toggle="collapse" href="#management_generate">
                                <i class="pe-7s-display2 bold"></i>
                                <p> Manual Ticket Generate
                                                            <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="management_generate">
                                <ul class="nav">
            
                                    <li><a href="#"></a></li>
                                    <li><a href="#"></a></li>
            
                                </ul>
                            </div>
                        </li>-->


            <!--</li>-->


        </ul>
    </div>
</div>