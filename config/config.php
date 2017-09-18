<?php

if (!session_id()) {

    session_start();

}







//function newsession_id()

//{

//    

//}



define('DEBUG', true);

if (DEBUG) {

    error_reporting(E_ALL);

    ini_set('display_errors', 1);

} else {



    error_reporting(E_ALL);

    ini_set('display_errors', 0);

}

/*

 * $config :  

 * All index name will be capitalized

 */

$config = array();

$notAllow = array();

$con = '';

$msg = '';

$err = '';

$warning = '';

$info = '';

if (isset($_GET['msg']) AND $_GET['msg'] != '') {

    $msg = base64_decode(trim($_GET['msg']));

}

if (isset($_GET['err']) AND $_GET['err'] != '') {

    $err = base64_decode(trim($_GET['err']));

} 

if (isset($_GET['warning']) AND $_GET['warning'] != '') {

    $warning = base64_decode(trim($_GET['warning']));

}

if (isset($_GET['info']) AND $_GET['info'] != '') {

    $info = base64_decode(trim($_GET['info']));

}



$config['BASE_DIR'] = dirname(dirname(__FILE__));



//http://localhost/ticketchai/

/* local.config.php

 * local configuration here 

 * SET the database username and password 

 */

include ($config['BASE_DIR'] . '/config/local.config.php');



$con = mysqli_connect($config['DB_HOST'], $config['DB_USER'], $config['DB_PASSWORD'], $config['DB_NAME']);

@mysqli_query($con,'SET CHARACTER SET utf8');

@mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

if (!$con) {

    die('Databse Connect Error: ' . mysqli_connect_error());

}



include ($config['BASE_DIR'] . '/lib/helper_functions.php');



/* access control */

include ($config['BASE_DIR'] . '/config/access.config.php');

if (isset($_SERVER['SCRIPT_NAME'])) {

    $requestFile = str_replace($config['ROOT_DIR'], '', $_SERVER['SCRIPT_NAME']);

}



function debug($object) {

    echo "<pre>";

    print_r($object);

    echo "</pre>";

}



if(in_array($_SERVER['PHP_SELF'],array("/ticketchai/","index.php","/ticketchai/index.php")))

{

	$actual_link="index.php";	

}

else

{

	@$actual_link=$_SERVER['HTTP_REFERER'];	

}



//echo $actual_link;

?>