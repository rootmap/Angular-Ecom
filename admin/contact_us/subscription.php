<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}


//edit option subscription start

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $subsql = "SELECT * FROM  subscription WHERE id = '" . $id . "'";
    $subarray = array();
    $sqlsub = mysqli_query($con, $subsql);
    $subchk = mysqli_num_rows($sqlsub);
    if ($subchk != 0) {
        while ($subrow = mysqli_fetch_object($sqlsub)) {
            $subarray[] = $subrow;
        }
    }
}

//edit option subscription end
?>






<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Chai | Admin Panel</title>


        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />


<?php include basePath('admin/header_script.php'); ?>

        <style type="text/css">
            .fileUpload {
                position: relative !important;
                overflow: hidden !important;
                margin: 0px !important;
            }
            .fileUpload input.upload {
                position: absolute !important;
                top: 0 !important;
                right: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                font-size: 20px !important;
                cursor: pointer !important;
                opacity: 0 !important;
                filter: alpha(opacity=0) !important;
            }
        </style>
        <link rel="stylesheet" href="../../css/crop/style.css" type="text/css" />
        <script src="../../js/cropbox.js"></script>


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
<?php
include basePath('admin/message.php');
if (isset($_GET['id'])) {
    ?>

                <h3 class="bg-white content-heading border-bottom strong"> Edit Subscription Form</h3>

                <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">

                </div>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Panel title</h3>
                        </div>
                        <div class="panel-body">



                            <div class="form-group">
                                <label for="exampleInputTitle">Title</label>
                                <script>
                                    $(document).ready(function (e) {
                                        //alert('success'); 
                                        $('#submit').click(function (e) {
                                            //                                        alert('success');
                                            var title = $('#title').val();
                                            var id = '<?php echo $_GET['id']; ?>';
                                            var content = $('#exampleInputTitle').val();
                                            var def_image_name = $(this).attr("name");
                                            if (def_image_name != "")
                                            {
                                                var image_name =def_image_name;
                                            }
                                            else
                                            {
                                                
                                                var image_name =$("#eximage").val();
                                            }
                                            //alert(content);
                                            // alert(title+" "+content);
                                            $.post("subs_ajax.php", {'st': 6, 'title': title, 'id': id, 'content': content, 'image_name': image_name}, function (data) {
                                                //console.log(data);
                                                if (data == 0)
                                                {
                                                    alert("Data Not Inserted");
                                                }
                                                else
                                                {
                                                    //clear(); //aggrigate function
                                                    //alert('Success');
                                                    window.location.replace('../subscription/subscription_list.php?msg=' + data);
                                                }

                                            });

                                        });


                                        $('#clear').click(function (e)
                                        {
                                            clear();
                                        });

                                        function clear()
                                        {
                                            $('#title').val("");
                                            $('#exampleInputTitle').val("");
                                        }

                                    });

                                </script>
                                <input type="text" class="form-control" id="title"  value="<?php echo $subarray[0]->head; ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputTitle">Content</label>
                                <textarea type="text" class="form-control" id="exampleInputTitle" value="type your contant" ><?php echo $subarray[0]->content; ?> </textarea>
                            </div>
                            <script>
                                $(document).ready(function (e) {
                                    $('#Upload_image').click(function (e) {
                                        $('#fileinput').click();
                                    });
                                });



                                $(window).load(function () {
                                    var options =
                                            {
                                                imgSrc: ''
                                            }


                                    var cropper = $('#imgpanel').cropbox(options);
                                    //status
                                    $('#fileinput').on('change', function () {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            options.imgSrc = e.target.result;
                                            var img = e.target.result;
                                            //<img class="img-responsive" src="./profile/5617bfc9217bf.gif" />														 
                                            var d = new Date();
                                            var n = d.getTime();

                                            $('#imgpanel').show();
                                            $('#imgpanel').html("<img id='img" + n + "' class='img-responsive' src='" + e.target.result + "' /><div><pre id='image_link'></pre></div>");

                                            //

                                            post_data = {'img': img, 'st': 2};
                                            $.post('image.php', post_data, function (datas) {
                                                var datacl = jQuery.parseJSON(datas);
                                                var status = datacl.status;
                                                var image_name = datacl.image_name;
                                                if (status == 1)
                                                {
                                                    alert("Done.");
                                                    $('#submit').attr("name", image_name);
                                                    $('#image_link').html("../contact_us/image/" + image_name);
                                                }
                                                else
                                                {
                                                    alert("Upload Failed.");
                                                }
                                            });

                                        }
                                        reader.readAsDataURL(this.files[0]);
                                        this.files = [];
                                    })

                                    //status end

                                });
                            </script>



                            <div class="file_upload_box" style="height: 1px; overflow: hidden;">
                                <input type="file" id="fileinput" name="file">
                                <input type="hidden" value="<?php echo $subarray[0]->image; ?>" id="eximage">
                            </div>


                            <div class="clearfix"></div>     
                            <button class="btn btn-primary" type="button" id="Upload_image" name="replaceimg">Replace image</button>
                            <button  class="btn btn-info" type="button" id="clear" >clear</button>
                            <button class="btn btn-success" type="button" id="submit" name="">Update Record</button>

                        </div>
                    </div>
                </div>


                <div class="col-lg-3">

                    <!--image panel start from here-->

                    <div class="panel panel-default">
                        <div class="panel-body" id="imgpanel">
                            <img class="img-responsive" src="image/<?php echo $subarray[0]->image; ?>" />
                        </div>
                    </div>                
                    <!--image panel end from here-->

                </div> 
            </form>
        </div> 
<?php } else { ?>








        <h3 class="bg-white content-heading border-bottom strong">Subscription Form</h3>
        <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">

        </div>

        <div class="col-lg-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">


                    <a href="../../../../D:/server/htdocs/phpjson/oneclick.php"></a>
                    <div class="form-group">
                        <label for="exampleInputTitle">Title</label>
                        <script>
                            $(document).ready(function (e) {
                                //alert('success'); 
                                $('#submit').click(function (e) {
                                    //                                        alert('success');
                                    var title = $('#title').val();
                                    var content = $('#exampleInputTitle').val();
                                    var image_name = $(this).attr("name");
                                    //alert(content);
                                    // alert(title+" "+content);
                                    $.post("subs_ajax.php", {'st': 1, 'title': title, 'content': content, 'image_name': image_name}, function (data) {
                                        //console.log(data);
                                        if (data == 0)
                                        {
                                            alert("Data Not Inserted");
                                        }
                                        else
                                        {
                                            clear(); //aggrigate function
                                            alert("successfully save data");
                                        }

                                    });

                                });


                                $('#clear').click(function (e)
                                {
                                    clear();
                                });

                                function clear()
                                {
                                    $('#title').val("");
                                    $('#exampleInputTitle').val("");
                                }

                            });

                        </script>
                        <input type="text" class="form-control" id="title" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputTitle">Content</label>
                        <textarea type="text" class="form-control" id="exampleInputTitle" placeholder="Type your Content here"></textarea>
                    </div>
                    <script>
                        $(document).ready(function (e) {
                            $('#Upload_image').click(function (e) {
                                $('#fileinput').click();
                            });
                        });



                        $(window).load(function () {
                            var options =
                                    {
                                        imgSrc: ''
                                    }


                            var cropper = $('#imgpanel').cropbox(options);
                            //status
                            $('#fileinput').on('change', function () {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    options.imgSrc = e.target.result;
                                    var img = e.target.result;
                                    //<img class="img-responsive" src="./profile/5617bfc9217bf.gif" />														 
                                    var d = new Date();
                                    var n = d.getTime();

                                    $('#imgpanel').show();
                                    $('#imgpanel').html("<img id='img" + n + "' class='img-responsive' src='" + e.target.result + "' /><div><pre id='image_link'></pre></div>");

                                    //

                                    post_data = {'img': img, 'st': 2};
                                    $.post('image.php', post_data, function (datas) {
                                        var datacl = jQuery.parseJSON(datas);
                                        var status = datacl.status;
                                        var image_name = datacl.image_name;
                                        if (status == 1)
                                        {
                                            alert("Done.");
                                            $('#submit').attr("name", image_name);
                                            $('#image_link').html("http://localhost/admin/contact_us/image/" + image_name);
                                        }
                                        else
                                        {
                                            alert("Upload Failed.");
                                        }
                                    });

                                }
                                reader.readAsDataURL(this.files[0]);
                                this.files = [];
                            })

                            //status end

                        });
                    </script>



                    <div class="file_upload_box" style="height: 1px; overflow: hidden;">
                        <input type="file" id="fileinput" name="file">
                    </div>


                    <div class="clearfix"></div>     
                    <button class="btn btn-primary" type="button" id="Upload_image">Upload image</button>
                    <button class="btn btn-success" type="button" id="submit">save</button>
                    <button  class="btn btn-info" type="button" id="clear">clear</button>


                </div>
            </div>

        </div>    

        <div class="col-lg-4">

            <!--image panel start from here-->

            <div class="panel panel-default">
                <div class="panel-body" id="imgpanel">

                </div>
            </div>                
            <!--image panel end from here-->
        </form>
<?php } ?>       
</div> 


</div>

<div class="clearfix"></div>
<?php include basePath('admin/footer.php'); ?>

</div>
<script type="text/javascript">
    $("#subscriptionList").addClass("active");
    $("#subscriptionList").parent().parent().addClass("active");
    $("#subscriptionList").parent().addClass("in");
</script>

<?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
