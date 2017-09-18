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
<?php endif; 
$admin_type = getSession('admin_type');
$admin_ID = getSession('admin_id');

if($admin_type==1)
{
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
        <?php if (checkPermission('partner', 'read', getSession('admin_type'))): ?>
            <li id="partnermenu"><a href="<?php echo baseUrl('admin/partner/partner_list.php'); ?>"><i class="icon-bulleted-list"></i><span>Partner List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('subscription', 'read', getSession('admin_type'))): ?>
            <li id="sublist"><a href="<?php echo baseUrl('admin/subscription/subscription_list.php'); ?>"><i class="icon-ticket"></i><span>Subscription List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('dynamic_form', 'read', getSession('admin_type'))): ?>
            <li id="formlist"><a href="<?php echo baseUrl('admin/dynamic_form/dynamic_form_list.php'); ?>"><i class="icon-ticket"></i><span>Dynamic Form List</span></a></li>
        <?php endif; ?>
        <?php if (checkPermission('register_user', 'read', getSession('admin_type'))): ?>
            <li id="reglist"><a href="<?php echo baseUrl('admin/register_user/index.php'); ?>"><i class="icon-ticket"></i><span>Register User Data</span></a></li>
        <?php endif; ?>
    </ul>
</li>
<?php 
}
if (checkPermission('user', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a href="#" data-target="#usersettings" data-toggle="collapse"><i class="icon-note-pad"></i><span>User Settings</span></a>
        <ul class="collapse " id="usersettings">
            <?php if (checkPermission('user', 'read', getSession('admin_type'))): ?>
                <li id="admin_list"><a href="<?php echo baseUrl('admin/user/admin_list.php'); ?>"><i class="icon-bulleted-list"></i><span>User List</span></a></li>
                <?php if($admin_type==1){ ?>
                <li id="admin_blocklist"><a href="<?php echo baseUrl('admin/user/admin_block_list.php'); ?>"><i class="icon-alert"></i><span>User Block List</span></a></li>
                <li id="admin_access"><a href="<?php echo baseUrl('admin/user/admin_access_log.php'); ?>"><i class="icon-ball-cap"></i><span>User Access Log</span></a></li>
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
        <a data-toggle="collapse" data-target="#order" href="#"><i class="fa fa-list-alt"></i><span>Order Settings<span class="badge badge-info" style="margin-left: 20px;"><?php
                    if ($newOrder > 0) {
                        echo $newOrder;
                    }
                    ?></span></span></a>
        <ul id="order" class="collapse ">
            <?php if (checkPermission('order', 'read', getSession('admin_type'))): ?>
                <li id="orderlist"><a href="<?php echo baseUrl('admin/orders/index.php'); ?>"><i class=" icon-paper-document-image"></i><span>Order List</span></a></li>
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
        </ul>
    </li>
<?php endif; ?>


<?php if (checkPermission('customer', 'read', getSession('admin_type'))): ?>
    <li class="hasSubmenu">
        <a data-toggle="collapse" data-target="#customer" href="#"><i class="fa fa-arrows"></i><span>Customer Settings</span></a>
        <ul id="customer" class="collapse ">
            <li id="customerlist"><a href="<?php echo baseUrl('admin/customer/user_list.php'); ?>"><i class=" icon-comment-typing"></i><span>Customer List</span></a></li>
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
            <?php if (checkPermission('venue', 'read', getSession('admin_type'))): ?>
                <li id="venlist"><a href="<?php echo baseUrl('admin/venue/venue_list.php'); ?>"><i class="icon-ticket"></i><span>Venue List</span></a></li>
            <?php endif; ?>
            <?php if (checkPermission('ticket_type', 'read', getSession('admin_type'))): ?>
                <li id="ticlist"><a href="<?php echo baseUrl('admin/ticket_type/ticket_type_list.php'); ?>"><i class="icon-ticket"></i><span>Ticket Type List</span></a></li>
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
        </ul>
    </li>
<?php endif; ?>
<?php  
if($admin_type==1)
{
?>
<li class="hasSubmenu">
    <a data-toggle="collapse" data-target="#eventreq" href="#"><i class="fa fa-th-list"></i><span>Event Request</span></a>
    <ul id="eventreq" class="collapse ">
        <li id="requesteventlist"><a href="<?php echo baseUrl('admin/event_request/event_request_list.php'); ?>"><i class="fa fa-th"></i><span>Event Request List</span></a></li>
    </ul>
</li>
<?php 
}
if (checkPermission('seat', 'read', getSession('admin_type'))): ?>
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