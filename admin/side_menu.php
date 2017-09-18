<?php
$directory = getCurrentDirectory();
?>
<li id="dash"><a href="<?php echo baseUrl('admin/dashboard.php'); ?>"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>

<?php if (checkPermission('settings', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#menu-style" href="#"><i class="fa fa-cogs"></i><span>Website Settings </span></a>
        <ul id="menu-style" class="collapse">
            <?php if (checkPermission('settings', 'create', getSession('admin_type'))): ?>
                <li id="createsettings"><a href="<?php echo baseUrl('admin/settings/create_settings.php'); ?>"><i class="icon-ticket"></i><span class="pull-right badge badge-primary"></span>Create Settings</a></li>
            <?php endif; ?>    
            <li id="websettings"><a href="<?php echo baseUrl('admin/settings/web_settings.php'); ?>"><i class="icon-ticket"></i><span class="pull-right badge badge-primary"></span>Web Settings</a></li>
            <li id="imagesettings"><a href="<?php echo baseUrl('admin/settings/image_settings.php'); ?>"><i class="icon-bulleted-list"></i><span class="pull-right badge badge-primary"></span>Image Settings</a></li>
            <li id="mailsettings"><a href="<?php echo baseUrl('admin/settings/email_settings.php'); ?>"><i class="icon-bulleted-list"></i><span class="pull-right badge badge-primary"></span>Email Settings</a></li>
            <li id="socialsettings"><a href="<?php echo baseUrl('admin/settings/social_settings.php'); ?>"><i class="icon-bulleted-list"></i><span class="pull-right badge badge-primary"></span>Social Settings</a></li>
        </ul>
    </li>
    <?php
endif;
$admin_type = getSession('admin_type');
$admin_ID = getSession('admin_id');
?>

<li class="hasSubmenu">

    <a href="#" data-target="#general" data-toggle="collapse"><i class="icon-note-pad"></i><span>General Settings</span></a>
    <ul class="collapse " id="general">
        <?php if (checkPermission('country', 'read', getSession('admin_type'))): ?>
            <li id="countrylist"><a href="<?php echo baseUrl('admin/country/index.php'); ?>"><i class="icon-ball-cap"></i><span>Country List</span></a></li>
        <?php endif; ?>

        <?php if (checkPermission('city', 'read', getSession('admin_type'))): ?>
            <li id="citylist"><a href="<?php echo baseUrl('admin/city/index.php'); ?>"><i class=" icon-comment-typing"></i><span>City List</span></a></li>
        <?php endif; ?>

        <?php if (checkPermission('tag', 'read', getSession('admin_type'))): ?>
            <li id="taglist"><a href="<?php echo baseUrl('admin/tag/tag_list.php'); ?>"><i class="icon-ticket"></i><span>Tag List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('announce', 'read', getSession('admin_type'))): ?>
            <li id="announcelist"><a href="<?php echo baseUrl('admin/announce/index.php'); ?>"><i class=" icon-comment-typing"></i><span>Announcement List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('category', 'read', getSession('admin_type'))): ?>
            <li id="catlist"><a href="<?php echo baseUrl('admin/category/category_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Category List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('category', 'read', getSession('admin_type'))): ?>
            <li id="catslider"><a href="<?php echo baseUrl('admin/gallery/category_slider_list.php'); ?>"><i class="icon-comment-typing"></i><span>Category Slider list</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('banner', 'read', getSession('admin_type'))): ?>
            <li id="banlist"><a href="<?php echo baseUrl('admin/banner/banner_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Banner List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('special_offer', 'read', getSession('admin_type'))): ?>
            <li id="offerlist"><a href="<?php echo baseUrl('admin/special_offer/offer_list.php'); ?>"><i class="icon-ticket"></i><span>Offer List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('promotion', 'read', getSession('admin_type'))): ?>
            <li id="promotionlist"><a href="<?php echo baseUrl('admin/promotion/promotion_list.php'); ?>"><i class="icon-ticket"></i><span>Promotion List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('clients', 'read', getSession('admin_type'))): ?>
            <li id="clientmenu"><a href="<?php echo baseUrl('admin/clients/client_list.php'); ?>"><i class="icon-bulleted-list"></i><span>Client List</span></a></li>
        <?php endif; ?>

        <?php if (checkPermission('tag', 'read', getSession('admin_type'))): ?>
            <li id="movietermscondition"><a href="<?php echo baseUrl('admin/event/movie_terms_and_condition_list.php'); ?>"><i class="icon-ticket"></i><span>Movie Terms and Condition</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('clients', 'read', getSession('admin_type'))): ?>
            <li id="merchant-events"><a href="<?php echo baseUrl('admin/merchant_wise_event/merchant_wise_event_list.php'); ?>"><i class="icon-bulleted-list"></i><span>Merchant-wise Event List</span></a></li>
        <?php endif; ?>


        <?php if (checkPermission('clients', 'read', getSession('admin_type'))): ?>
            <li id="merchant-events-gallery"><a href="<?php echo baseUrl('admin/merchant_wise_gallery/add_merchant_wise_gallery.php'); ?>"><i class="icon-bulleted-list"></i><span>Merchant-wise Event Gallery</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('partner', 'read', getSession('admin_type'))): ?>
            <li id="partnermenu"><a href="<?php echo baseUrl('admin/partner/partner_list.php'); ?>"><i class="icon-bulleted-list"></i><span>Partner List</span></a></li>
        <?php endif; ?>
        <!--  <?php //if (checkPermission('subscription', 'read', getSession('admin_type'))):    ?>
              <li id="sublist"><a href="<?php // echo baseUrl('admin/subscription/subscription_list.php');    ?>"><i class="icon-ticket"></i><span>Subscription List</span></a></li>
        <?php //endif; ?>-->
        <?php if (checkPermission('dynamic_form', 'read', getSession('admin_type'))): ?>
            <li id="formlist"><a href="<?php echo baseUrl('admin/dynamic_form/dynamic_form_list.php'); ?>"><i class="icon-ticket"></i><span>Dynamic Form List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('dynamic_form', 'read', getSession('admin_type'))): ?>
            <li id="dynamicFormImage"><a href="<?php echo baseUrl('admin/dynamic_form/event_wise_image_field.php'); ?>"><i class="icon-ticket"></i><span>Dynamic Image Field</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('register_user', 'read', getSession('admin_type'))): ?>
            <li id="reglist"><a href="<?php echo baseUrl('admin/register_user/index.php'); ?>"><i class="icon-ticket"></i><span>Register User Data</span></a></li>
        <?php endif; ?>
    </ul>
</li>
<?php if (checkPermission('user', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a href="#" data-target="#usersettings" data-toggle="collapse"><i class="icon-note-pad"></i><span>User Settings</span></a>
        <ul class="collapse " id="usersettings">
            <?php if (checkPermission('user', 'read', getSession('admin_type'))): ?>
                <li id="admin_list"><a href="<?php echo baseUrl('admin/user/admin_list.php'); ?>"><i class="icon-bulleted-list"></i><span>User List</span></a></li>
                <?php if ($admin_type == 1) { ?>
                    <li id="admin_blocklist"><a href="<?php echo baseUrl('admin/user/admin_block_list.php'); ?>"><i class="icon-alert"></i><span>User Block List</span></a></li>
                    <li id="admin_access"><a href="<?php echo baseUrl('admin/user/admin_access_log.php'); ?>"><i class="icon-ball-cap"></i><span>User Access Log</span></a></li>
                    <li id="refund_list"><a href="<?php echo baseUrl('admin/user/refund_list.php'); ?>"><i class=" icon-paper-document-image"></i><span>Refund List</span></a></li>
                    <li id="merchant_report"><a href="<?php echo baseUrl('admin/user/merchant_report.php'); ?>"><i class=" icon-paper-document-image"></i><span>Merchant Report</span></a></li>
                <?php } ?>
            <?php endif; ?>
            <?php if (checkPermission('admin_types', 'read', getSession('admin_type'))): ?>
                <li id="admin_type"><a href="<?php echo baseUrl('admin/admin_types/index.php'); ?>"><i class=" icon-paper-document-image"></i><span>User Type List</span></a></li>
            <?php endif; ?>
             
                
        </ul>
    </li>
<?php endif; ?>


<?php if (checkPermission('order', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#order" href="#"><i class="fa fa-list-alt"></i><span>Order Report<span class="badge badge-info" style="margin-left: 20px;"><?php
                    if ($newOrder > 0) {
                        echo $newOrder;
                    }
                    ?></span></span></a>
        <ul id="order" class="collapse ">
            <?php if (checkPermission('order', 'read', getSession('admin_type'))): ?>
                <li id="orderlist"><a href="<?php echo baseUrl('admin/orders/index.php'); ?>"><i class=" icon-paper-document-image"></i><span>Order List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('order', 'read', getSession('admin_type'))): ?>
                <li id="orderDatewiselist"><a href="<?php echo baseUrl('admin/orders/order_date_wise.php'); ?>"><i class=" icon-paper-document-image"></i><span>Date-Wise Order Report</span></a></li>
            <?php endif; ?>    

            <?php if (checkPermission('order', 'manual', getSession('admin_type'))): ?>    
                <li id="manualorder"><a href="<?php echo baseUrl('admin/orders/manual_order.php'); ?>"><i class="fa fa-credit-card"></i><span>Manual Order</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('order', 'verify', getSession('admin_type'))): ?>
                <li id="verifyorder"><a href="<?php echo baseUrl('admin/orders/verify_order.php'); ?>"><i class=" icon-paper-document-image"></i><span>Verify Order</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('order', 'eventreport', getSession('admin_type'))): ?>
                <li id="eventorder"><a href="<?php echo baseUrl('admin/orders/event_report.php'); ?>"><i class=" icon-paper-document-image"></i><span>Event Order Report</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="movieorderlist"><a href="<?php echo baseUrl('admin/orders/movie_order_list.php'); ?>"><i class="icon-ticket"></i><span>Movie order list</span></a></li>
            <?php endif; ?> 
        </ul>
    </li>
<?php endif; ?>


<?php if (checkPermission('customer', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#customer" href="#"><i class="fa fa-arrows"></i><span>Customer Report</span></a>
        <ul id="customer" class="collapse ">
            <li id="customerlist"><a href="<?php echo baseUrl('admin/customer/user_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Customer List</span></a></li>
            <li id="eventwisecustomerlist"><a href="<?php echo baseUrl('admin/customer/user_list_event_wise.php'); ?>"><i class=" icon-comment-typing"></i><span>Eventwise Customer List</span></a></li>
            <li id="customerlistallsite"><a href="<?php echo baseUrl('admin/customer/all_site_user_list.php'); ?>"><i class=" icon-comment-typing"></i><span>All site Customer List</span></a></li>
            <li id="customeruniquelist"><a href="<?php echo baseUrl('admin/customer/site_unique_customer_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Site Unique Customer</span></a></li>
            <li id="customernopurchaselist"><a href="<?php echo baseUrl('admin/customer/fresh_customer_list.php'); ?>"><i class=" icon-comment-typing"></i><span>No Purchase Customer</span></a></li>
            <li id="customerpurchaselist"><a href="<?php echo baseUrl('admin/customer/purchase_customer_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Purchased Customer</span></a></li>
            <li id="purchase_multi_customer_list"><a href="<?php echo baseUrl('admin/customer/purchase_multi_customer_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Purchased Multiple Times</span></a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a href="#" data-target="#eventsettings" data-toggle="collapse"><i class="fa fa-bookmark"></i><span>Event Settings</span></a>
        <ul class="collapse " id="eventsettings">
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="evelist"><a href="<?php echo baseUrl('admin/event/event_list.php'); ?>"><i class="icon-ticket"></i><span>Event List</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="evdlist"><a href="<?php echo baseUrl('admin/event/delivery_cost_event_wise_for_city.php'); ?>"><i class="icon-ticket"></i><span>Event Delivery Cost List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('venue', 'read', getSession('admin_type'))): ?>
                <li id="venlist"><a href="<?php echo baseUrl('admin/venue/venue_list.php'); ?>"><i class="icon-ticket"></i><span>Venue List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('ticket_type', 'read', getSession('admin_type'))): ?>
                <li id="ticlist"><a href="<?php echo baseUrl('admin/ticket_type/ticket_type_list.php'); ?>"><i class="icon-ticket"></i><span>Add Ticket</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('ticket_type', 'read', getSession('admin_type'))): ?>
                <li id="ticlis"><a href="<?php echo baseUrl('admin/ticket/ticket_type_list.php'); ?>"><i class="icon-ticket"></i><span>Ticket Type</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event_includes', 'read', getSession('admin_type'))): ?>

                <li id="inclist"><a href="<?php echo baseUrl('admin/event_includes/all_event_includes_list.php'); ?>"><i class="icon-ticket"></i><span>Includes List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event_faq', 'read', getSession('admin_type'))): ?>
                <li id="faqlist"><a href="<?php echo baseUrl('admin/event_faq/faq_list.php'); ?>"><i class="icon-ticket"></i><span>FAQ List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event_guest', 'read', getSession('admin_type'))): ?>
                <li id="guestlist"><a href="<?php echo baseUrl('admin/event_guest/guest_list.php'); ?>"><i class="icon-ticket"></i><span>Guest List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="gallerylist"><a href="<?php echo baseUrl('admin/gallery/gallery_list.php'); ?>"><i class="icon-ticket"></i><span>Gallery List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="eventpicklist"><a href="<?php echo baseUrl('admin/event/pick_point.php'); ?>"><i class="icon-ticket"></i><span>New Pick Point For Event</span></a></li>
            <?php endif; ?>  
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="eventpickpointlist"><a href="<?php echo baseUrl('admin/event/event_pick_point_list.php'); ?>"><i class="icon-ticket"></i><span>Event Pick Point List</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="eventextradynamiccostlist"><a href="<?php echo baseUrl('admin/gallery/event_extra_daynamic_cost_list.php'); ?>"><i class="icon-ticket"></i><span>Event Extra Dynamic Cost List</span></a></li>
            <?php endif; ?>  
            <?php if (checkPermission('clients', 'read', getSession('admin_type'))): ?>
                <li id="movie-ticket-extra-costs"><a href="<?php echo baseUrl('admin/event/event_ticket_extra_cost_list.php'); ?>"><i class="icon-bulleted-list"></i><span>Event Movie Ticket Extra Cost</span></a></li>
            <?php endif; ?>  
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="listofpaymentmethod"><a href="<?php echo baseUrl('admin/gallery/list_of_payment_method.php'); ?>"><i class="icon-ticket"></i><span>List Of Payment Method</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="mediacontentlist"><a href="<?php echo baseUrl('admin/gallery/media_content_list.php'); ?>"><i class="icon-ticket"></i><span> Media Content List</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('gallery', 'read', getSession('admin_type'))): ?>
                <li id="recentpostlist"><a href="<?php echo baseUrl('admin/gallery/recent_post_list.php'); ?>"><i class="icon-ticket"></i><span> Recent Post List</span></a></li>
            <?php endif; ?> 

            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="evelist_blockbuster_api"><a href="<?php echo baseUrl('admin/event/event_list_blockbuster_api.php'); ?>"><i class="icon-ticket"></i><span>Event Movie List</span></a></li>
            <?php endif; ?>  
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="merchenttest"><a href="<?php echo baseUrl('admin/merchant-testimonial/merchant_testimonial_list.php'); ?>"><i class="icon-ticket"></i><span>Merchant Testimonial</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="moviegallerylist"><a href="<?php echo baseUrl('admin/gallery/movie_gallery_list.php'); ?>"><i class="icon-ticket"></i><span>Event Movie Gallery</span></a></li>
            <?php endif; ?>  
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="movielist"><a href="<?php echo baseUrl('admin/gallery/movie_list.php'); ?>"><i class="icon-ticket"></i><span>Movie list</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('order', 'eventreport', getSession('admin_type'))): ?>
                <li id="eventorder"><a href="<?php echo baseUrl('admin/orders/total_ticket_list.php'); ?>"><i class=" icon-paper-document-image"></i><span>Event Total Report</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="moviewiseticketquantity"><a href="<?php echo baseUrl('admin/gallery/moviewise_ticket_quantity_list.php'); ?>"><i class="icon-ticket"></i><span>Movie wise ticket quantity list</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwiseticketquantity"><a href="<?php echo baseUrl('admin/gallery/eventwise_ticket_quantity_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise Ticket Quantity list</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="event_online_charge_list"><a href="<?php echo baseUrl('admin/gallery/event_online_charge_list.php'); ?>"><i class="icon-ticket"></i><span>Event Wise Online Charge</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="charity_facebook_link"><a href="<?php echo baseUrl('admin/event/charity_facebook_link_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise Facebook link</span></a></li>
            <?php endif; ?>      

            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwisepaymethod"><a href="<?php echo baseUrl('admin/event/eventwise_payment_method_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise payment list</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwisetctylist"><a href="<?php echo baseUrl('admin/event/eventwise_ticket_type_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise Ticket Type list</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwisdiscount"><a href="<?php echo baseUrl('admin/gallery/eventwise_discount_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise Discount list</span></a></li>
            <?php endif; ?> 
            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwisechkout"><a href="<?php echo baseUrl('admin/event/eventwise_checkout_list.php'); ?>"><i class="icon-ticket"></i><span>Eventwise Checkout list</span></a></li>
            <?php endif; ?> 


            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventchktypelist"><a href="<?php echo baseUrl('admin/event/event_checkout_type_list.php'); ?>"><i class="icon-ticket"></i><span>Event Checkout Type list</span></a></li>
            <?php endif; ?>

            <?php if (checkPermission('event', 'read', getSession('admin_type'))): ?>
                <li id="eventwiseticketdesign"><a href="<?php echo baseUrl('admin/event/eticket_design.php'); ?>"><i class="icon-ticket"></i><span>Eventwise E-ticket Design</span></a></li>
            <?php endif; ?>    


        </ul>
    </li>
<?php endif; ?>
<?php
if ($admin_type == 1) {
    ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#eventreq" href="#"><i class="fa fa-th-list"></i><span>Event Request</span></a>
        <ul id="eventreq" class="collapse ">
            <li id="requesteventlist"><a href="<?php echo baseUrl('admin/event_request/event_request_list.php'); ?>"><i class="fa fa-th"></i><span>Event Request List</span></a></li>
        </ul>
    </li>
    <?php
}
if (checkPermission('seat', 'read', getSession('admin_type'))):
    ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#seat" href="#"><i class="fa fa-th-large"></i><span>Seat Module</span></a>
        <ul id="seat" class="collapse ">
            <li id="placeList"><a href="<?php echo baseUrl('admin/seat/place_list.php'); ?>"><i class="fa fa-th"></i><span>Place List</span></a></li>
            <li id="placeTemplateList"><a href="<?php echo baseUrl('admin/seat/place_template_list.php'); ?>"><i class="fa fa-th"></i><span>Place Template List</span></a></li>
            <li id="allocateseatList"><a href="<?php echo baseUrl('admin/allocate_seat/allocate_seat_list.php'); ?>"><i class="fa fa-th"></i><span>Assign Seat to Event</span></a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if (checkPermission('contact_us', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#contactus" href="#"><i class="fa fa-phone-square"></i><span>Contact Us</span></a>
        <ul id="contactus" class="collapse ">
            <li id="contactList"><a href="<?php echo baseUrl('admin/contact_us/contact_us_list.php'); ?>"><i class="fa fa-phone"></i><span>Contact Info List</span></a></li>            
        </ul>
    </li>
<?php endif; ?>

<li class="hasSubmenu">
    <a data-toggle="collapse" data-target="#subscription" href="#"><i class="fa fa-phone-square"></i><span>Subscription list</span></a>
    <ul id="subscription" class="collapse ">
        <li id="subscriptionList"><a href="<?php echo baseUrl('admin/contact_us/subscription.php'); ?>"><i class="fa fa-phone"></i><span>Subscription Info</span></a></li> 
        <li id="sublist"><a href="<?php echo baseUrl('admin/subscription/subscription_list.php'); ?>"><i class="fa fa-phone"></i><span>Subscription list</span></a></li> 
        <li id="subscriptioncustomer"><a href="<?php echo baseUrl('admin/contact_us/add_subscription_customer.php'); ?>"><i class="fa fa-phone"></i><span> Add  Subscription customer</span></a></li> 
        <li id="subscriptioncustomerList"><a href="<?php echo baseUrl('admin/subscription/subscription_customer_list.php'); ?>"><i class="fa fa-phone"></i><span>Subscription customer list</span></a></li> 
    </ul>
</li>

<?php if (checkPermission('contact_us', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#bkashtransaction" href="#"><i class="fa fa-phone-square"></i><span>Bkash</span></a>
        <ul id="bkashtransaction" class="collapse ">
            <li id="bkashtranlist"><a href="<?php echo baseUrl('admin/contact_us/bkash_list.php'); ?>"><i class="fa fa-phone"></i><span>Bkash list </span></a></li> 

        </ul>
    </li>

<?php endif; ?>

<?php if (checkPermission('contact_us', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#chairtyfeature" href="#"><i class="fa fa-phone-square"></i><span>Chairty Feature</span></a>
        <ul id="chairtyfeature" class="collapse ">
            <li id="chairtyfeaturelist"><a href="<?php echo baseUrl('admin/event/chairty_feature_list.php'); ?>"><i class="fa fa-phone"></i><span>chairty Feature list </span></a></li> 

        </ul>
    </li>

<?php endif; ?>