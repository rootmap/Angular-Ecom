<?php

$host = $_SERVER['HTTP_HOST'];
$domain = str_replace('www.', '', str_replace('http://', '', $host));
if ($domain == '192.168.1.108') {
    $config['SITE_NAME'] = 'Ticket Chai | Buy Online Tickets....';
    $config['BASE_URL'] = 'http://192.168.1.108/ticketchai/';
    $config['ROOT_DIR'] = '/ticketchai/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'tickette_chdata';
    $config['DB_USER'] = 'tickette_chdata';
    $config['DB_PASSWORD'] = 'Ticket@chai#2017';
} elseif ($domain == '192.168.1.130') {
    $config['SITE_NAME'] = 'Ticket Chai | Buy Online Tickets....';
    $config['BASE_URL'] = 'http://192.168.1.130/ticketchai/';
    $config['ROOT_DIR'] = '/ticketchai/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'ticketch_test_server';
    $config['DB_USER'] = 'ticketch_test_se';
    $config['DB_PASSWORD'] = '@minul@2017';
} elseif ($domain == '192.168.1.48') {
    $config['SITE_NAME'] = 'Ticket Chai | Buy Online Tickets....';
    $config['BASE_URL'] = 'http://192.168.1.48/ticketchai/';
    $config['ROOT_DIR'] = '/ticketchai/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'ticketch_test_server';
    $config['DB_USER'] = 'ticketch_test_se';
    $config['DB_PASSWORD'] = '@minul@2017';
} else {
    $config['SITE_NAME'] = 'Ticket Chai | Buy Online Tickets....';
    $config['BASE_URL'] = 'http://localhost/ticketchai/';
    $config['ROOT_DIR'] = '/ticketchai/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'ticketch_test_server';
    $config['DB_USER'] = 'ticketch_test_se';
    $config['DB_PASSWORD'] = '@minul@2017';
}date_default_timezone_set('Asia/Dhaka');
$config['PASSWORD_KEY'] = "#t1ck3tc74i*"; /* If u want to change PASSWORD_KEY value first of all make the admin table empty */$config['ITEMS_PER_PAGE'] = 20; /* Pagination */$config['CATEGORY_ITEMS_PER_PAGE'] = 120; /* category.php */$config['IMAGE_PATH'] = $config['BASE_DIR'] . '/images'; /* system image path */$config['IMAGE_URL'] = $config['BASE_URL'] . 'images'; /* Upload system path */$config['IMAGE_UPLOAD_PATH'] = $config['BASE_DIR'] . '/upload'; /* Upload files go here */$config['IMAGE_UPLOAD_URL'] = $config['BASE_URL'] . 'upload'; /* Upload link with this */$config['MAX_CATEGORY_LEVEL'] = 10; /* to control category level */$config['PRODUCT_CATEGORY_ID'] = 2; /* product category id start from here */$config['BOOKMARK_CATEGORY_ID'] = 119; /* bookmark category id start from here */$config['BRAND_CATEGORY_ID'] = 1; /* Brand category id start from here */$config['CATEGORY_CAROUSEL_LIMIT'] = 8; /* product category page per category slide limit */$config['COUPON_MAX_APPLY'] = 4; /* Maximum attempt time for applying coupon code *//* define banner areas */$config['BANNER_AREA']['HOME'] = "Home page top ";
$config['BANNER_AREA']['NEW'] = "New arrival page";
$config['BANNER_AREA']['SALES'] = "Sales page"; /* define banner areas */$config['CURRENCY'] = "TK";
$config['CURRENCY_SIGN'] = "৳"; /* Start of magic quote remover function  This function is used for removing magic quote, Thats means using this function no slash will add automatically before quotations */if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    } unset($process);
}