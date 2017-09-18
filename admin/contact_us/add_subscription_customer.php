<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}
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
            <h3 class="bg-white content-heading border-bottom strong">Subscription Form</h3>
            <div style="margin-left: 10px;margin-right: 10px;padding-top: 5px;">
                <?php include basePath('admin/message.php'); ?>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">add new subscriber customer</h3>
                    </div>
                    <div class="panel-body">

                        
                        <script>
                            $(document).ready(function (e) {
                                //alert('success');
                                $('#submit').click(function (e) {
//                                        alert('success');
                                    var Fullname = $('#FullName').val();
                                    var Email = $('#Email').val();
                                     var Phone = $('#Phone').val();
                                    
                                    var gender='';
                                    if(document.getElementById('gender_0').checked) {
                                        var gender=1;
                                    }else if(document.getElementById('gender_1').checked) {
                                        var gender=2;
                                    }
                                    
                                   // alert(gender);
                                     //alert(title+" "+content);
                                   //console.log(Fullname+" "+Email+" "+Phone);  
                                   $.post("subs_ajax.php", {'st':4,'full_name':Fullname,'email':Email,'phone':Phone,'gender':gender}, function (data) {
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
                                    $('#FullName').val("");
                                    $('#Email1').val("");
                                    $('#Phone').val(""); 
                                }

                            });

                        </script>

                        <div class="form-group">
                            <label for="FullName">Full name</label>
                            <input type="text" class="form-control" id="FullName" placeholder="FullName">
                        </div>

                        <div class="form-group">
                            <label for="Email1">Email address</label>
                            <input type="email" class="form-control" id="Email" placeholder="Email">

                        </div>
                        <div class="form-group">
                            <label for="Phone">Phone</label>
                            <input type="text" class="form-control" id="Phone" placeholder="Phone">
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" id="gender_0" value="1" aria-label="...">Male
                            </label>

                            <label>
                                <input type="radio" name="gender" id="gender_1" value="2" aria-label="...">Female
                            </label>
                        </div>

                        <script>
                            $(document).ready(function(e) {
                                $('#customer_data_table').hide();
                                $('#Upload_form_excel').click(function(e) {
                                    $('#fileinput').click();
                                });
                            
                                $('#fileinput').on('change',prepareUpload);
                                
                                function prepareUpload(event)
                                {
                                  $('#excel_processing').html('Your Customer List is Processing...');  
                                  files = event.target.files;
                                  $('form').submit();
                                }
                                
                                $('form').on('submit', uploadFiles);
                                
                                function uploadFiles(event)
                                {
                                    event.stopPropagation(); // Stop stuff happening
                                    event.preventDefault(); // Totally stop stuff happening

                                    // START A LOADING SPINNER HERE

                                    // Create a formdata object and add the files
                                    var data = new FormData();
                                    $.each(files, function(key, value)
                                    {
                                        data.append(key, value);
                                    });

                                    $.ajax({
                                        url: 'submit.php?files',
                                        type: 'POST',
                                        data: data,
                                        cache: false,
                                        dataType: 'json',
                                        processData: false, // Don't process the files
                                        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                                        success: function(data, textStatus, jqXHR)
                                        {
                                            if(typeof data.error === 'undefined')
                                            {
                                                // Success so call function to process the form
                                                console.log("Data Saved Successfully");
                                                //var datacl=jQuery.parseJSON(data);
                                                var extra=data.files;
                                                $('#customer_data_table').show();
                                                var str=extra.replace('/\/','');
                                                console.log(str)
                                                $('#customer_data').html(str);
                                                $('#excel_processing').hide('slow')
                                                //submitForm(event, data);
                                            }
                                            else
                                            {
                                                // Handle errors here
                                                console.log('ERRORS: ' + data.error);
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown)
                                        {
                                            // Handle errors here
                                            console.log('ERRORS: ' + textStatus);
                                            // STOP LOADING SPINNER
                                        }
                                    });
                                }
                                
                            });
                            
                            
                            
                            
                        </script>
                        <form id="inffile" method="post" action="">
                        
                            <div class="file_upload_box" style="height: 1px; overflow: hidden;">
                                <input type="file" id="fileinput" name="file">
                            </div>

                        </form>


                        <div class="clearfix"></div> 
                        <button class="btn btn-primary" type="button" id="submit">save</button>
                        <button class="btn btn-success" type="button" id="Upload_form_excel">Upload form excel</button>
                        <button  class="btn btn-info" type="button" id="clear">clear</button>

                        
                    </div>
                </div>

            </div>    
            
            <div class="col-lg-8 well">
                <div id="excel_processing"></div>
                <table class="table table-bordered" id="customer_data_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="customer_data">
                        <tr>
                            <td>1</td>
                            <td>Mahamod</td>
                            <td>Male</td>
                            <td>f.bhuyian@gmail.com</td>
                            <td>01927608261</td>
                            <td><a href="#" class="btn btn-warning">Delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
         </div>
        
        

        <div class="clearfix"></div>
        <?php include basePath('admin/footer.php'); ?>

    </div>
    <script type="text/javascript">
        $("#subscriptioncustomer").addClass("active");
        $("#subscriptioncustomer").parent().parent().addClass("active");
        $("#subscriptioncustomer").parent().addClass("in");
    </script>

    <?php include basePath('admin/footer_script.php'); ?>
</body>
</html>
