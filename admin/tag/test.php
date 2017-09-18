<?php
include '../../config/config.php';
$city_name = "";
$id = "";
if (isset($_POST['city_name'])) {
    extract($_POST);
    $city = explode("-", $city_name);
    $id = $city[1];
    debug($id);
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



        <script type="text/javascript">
            $(document).ready(function () {
                $("#city_name").autocomplete({
                    source: 'data.php',
                    minLength: 1
                });
            });
        </script>
    </head>
    <body>
        <form method="post">
            Name : <input type="text" id="city_name" name="city_name" value="<?php echo $city_name; ?>" />
            <button type="submit">Click</button>
        </form>
        <?php include basePath('admin/footer_script.php'); ?>
    </body>
