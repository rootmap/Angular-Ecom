<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
?>
<!DOCTYPE html>
<a href="contact_us_list.php"></a>
<html>
    <a href="subscription.php"></a>
    <head>
        <title>Ticket Chai | Admin Panel</title>
        <script>
            function deletesub(id)
            {
                // alert(id);
                $.post("subs_ajax.php", {'st': 2, 'id': id}, function (data) {
                    //console.log(id);   
                    if (data == 0)
                    {
                        alert('no data found');
                    }
                    else
                    {
                        $('#tr' + id).hide('slow');
                        alert('success');
                    }
                });
            }

            

            function Subscribe(id)
            {
                // alert(id);
                $.post("subs_ajax.php", {'st': 3, 'id': id}, function (data) {
                    //console.log(id);   
                    if (data == 0)
                    {
                        alert('no data found');
                    }
                    else
                    {

                        alert('success');
                    }
                });
            }


        </script>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />


        <?php include basePath('admin/header_script.php'); ?>	
    </head>
    <body class="">

        <?php include basePath('admin/header.php'); ?>

        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-inverse">
                <div class="user-profile media innerAll">
                    <div>
                        <a href="#" class="strong">Navigation</a>
                    </div>
                </div>
                <div class="sidebarMenuWrapper">
                    <ul class="list-unstyled">
                        <?php include basePath('admin/side_menu.php'); ?>
                    </ul>
                </div>
            </div>
        </div>


        <div id="content">
            <h3 class="bg-white content-heading border-bottom strong">Contact List</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>
            
            <div class="col-lg-8">
                <table class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Email subscription list</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sqlquery = mysqli_query($con, "SELECT * FROM subscription");
                        while ($row = mysqli_fetch_array($sqlquery)):
                            ?>
                            <tr id="tr<?php echo $row['id']; ?>">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td><?php echo $row['head']; ?></td>
                                <td><?php echo $row['image']; ?></td>


                                <td><button onclick="Subscribe(<?php echo $row['id']; ?>)" class="btn btn-info">Subscribe Email</button></td>
                                <td><button onclick="deletesub(<?php echo $row['id']; ?>)" type="button" class="btn btn-danger">Delete</button></td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Content Start Here -->     


        </div>

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

    </div>
    <script type="text/javascript">
        $("#subscriptiondataList").addClass("active");
        $("#subscriptiondataList").parent().parent().addClass("active");
        $("#subscriptiondataList").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
