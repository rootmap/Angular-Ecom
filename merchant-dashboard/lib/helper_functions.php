<?php

if (session_id() == '') {
    //session has not started
    @session_start();
}

/**
 * redirect by Javascript to given link
 *
 * @return string
 */
function redirect($link = NULL) {

    if ($link) {
        echo "<script language=Javascript>document.location.href='$link';</script>";
    } else {
        /* echo '$link does not specified'; */
    }
}

/**
 * Give your file name as suffix it will return full base path
 * @return string 
 */
function basePath($suffix = '') {
    global $config;
    $suffix = ltrim($suffix, '/');
    return $config['BASE_DIR'] . '/' . trim($suffix);
}

/**
 * Give your file name as suffix it will return full base url
 * @return string 
 */
function baseUrl($suffix = '') {
    $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';
    //$web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "Dropbox/odesk/pos/";
    if ($_SERVER['HTTP_HOST'] == "localhost") {
        $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchai_aj/";
    } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.48") {
        $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "";
    } elseif ($_SERVER['HTTP_HOST'] == "ticketchai.com" || $_SERVER['HTTP_HOST'] == "http://ticketchai.com" || $_SERVER['HTTP_HOST'] == "http://ticketchai.com/" || $_SERVER['HTTP_HOST'] == "https://ticketchai.com" || $_SERVER['HTTP_HOST'] == "https://ticketchai.com/" || $_SERVER['HTTP_HOST'] == "www.ticketchai.com/" || $_SERVER['HTTP_HOST'] == "www.ticketchai.com") {
        $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/ticketchaiorg/";
    } else {
        $web_root = $protocol . $_SERVER['HTTP_HOST'] . "/" . "ticketchaiorg/";
    }

    $suffix = ltrim($suffix, '/');
    return $web_root . trim($suffix);
//    global $config;
//    $suffix = ltrim($suffix, '/');
//    return $config['BASE_URL'] . trim($suffix);
}

/**
 * cpunt user character and make a limit
 * @return string
 */
function charLimiter($string = '', $limit = null, $suffix = '..') {
    if ($limit AND strlen($string) > $limit) {
        return substr($string, 0, $limit) . $suffix;
    } else {
        return $string;
    }
}

/**
 * Click able Url  str_replace('http://','',str_replace('https://','',$url))
 * @return string
 */
function clickableUrl($url = '') {

    $url = str_replace('http://', '', str_replace('https://', '', $url));
    $url = 'http://' . $url;
    return $url;
}

/**
 * Clean a string for 
 * @return string
 * */
function myUrlEncode($string) {
    /* source = http://php.net/manual/en/function.urlencode.php */
    $entities = array(' ', '--', '&quot;', '!', '@', '#', '%', '^', '&', '*', '_', '(', ')', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
    $replacements = array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-');
    return str_replace($entities, $replacements, urlencode(strtolower(trim($string))));
}

/**
 * Check the mail is valid or not
 * 
 * @return string
 */
function isValidEmail($email = '') {
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}

/**
 * 1.  This function will convert to md5() and inject our secure $saltKeyWord <br/>
 * 2.  The password_key is mention at $saltKeyWord variable at top of the class <br/>
 * 3.  This password_key is not changeable after create some user with the keyoerd <br/>
 * 4.  If u want to change $saltKeyWord value first of all make the user table empty<br/>
 * 
 * @return string
 */
function securedPass($pass = '') {

    global $config;
    $saltKeyWord = $config['PASSWORD_KEY']; /* If u want to change $saltKeyWord value first of all make the admin table empty */

    if ($pass != '') {
        $pass = md5($pass);
        /* created md5 hash */
        $length = strlen($pass);
        /* calculating the lengh of the value */
        $password_code = $saltKeyWord;
        if ($password_code != '') {
            $security_code = trim($password_code);
        } else {
            $security_code = '';
        }
        /* checking set $password_code or not */
        $start = floor($length / 2);
        /* dividing the lenght */
        $search = substr($pass, 1, $start);
        /* $search = which part will replace */
        $secur_password = str_replace($search, $search . $security_code, $pass);

        /* $search.$security_code replacing a part this password_code */
        return $secur_password;
    } else {
        return '';
    }
}

function secretPass($pass) {
    $bytes = 044;
    $salt = base64_encode($bytes);
    $hash = hash('sha512', $salt . $pass);
    return md5($hash);
}

/**
 * Auto creates a 6 char string [a-z A-Z 0-9]
 *
 * @return string
 */
function passwordGenerator() {
    $buchstaben = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
    $pw_gen = '';

    for ($i = 1; $i <= 6; $i++) {
        mt_srand((double) microtime() * 1000000);
        $tmp = mt_rand(0, count($buchstaben) - 1);
        $pw_gen.=$buchstaben[$tmp];
    }

    return $pw_gen;
}

/*
 * setSession function set value with custom unique session key
 *  $indexName:   $_SESSION['session_name']
 *  $value:   $_SESSION['session_name'] = $value
 * @return NULL
 */

function setSession($indexName = '', $value = '') {
    global $config;
    $indexName = trim($indexName);
    $value = trim($value);
    $_SESSION[md5($config['PASSWORD_KEY']) . '_' . $indexName] = $value;
    ;
}

/*
 * unsetSession function unset value with custom unique session key
 *  $indexName:   $_SESSION['session_name']
 * @return NULL
 */

function unsetSession($indexName = '') {
    global $config;
    $indexName = trim($indexName);
    if (isset($_SESSION[md5($config['PASSWORD_KEY']) . '_' . $indexName])) {
        unset($_SESSION[md5($config['PASSWORD_KEY']) . '_' . $indexName]);
    }
}

/*
 * getSession function set value with custom unique session key
 *  $indexName:   $_SESSION['session_name']
 *  @return String or boolean
 * 
 */

function getSession($indexName = '') {
    global $config;
    $indexName = trim($indexName);

    if (isset($_SESSION[md5($config['PASSWORD_KEY']) . '_' . $indexName])) {
        return $_SESSION[md5($config['PASSWORD_KEY']) . '_' . $indexName];
    } else {
        return FALSE;
    }
}

/*
 * getConfig function gets the value defined against given $name from config_settings table
 *  $name:   $config['name']
 *  @return String or boolean
 * 
 */

function getConfig($name = '') {
    global $con;
    $output = '';
    if (!isset($_SESSION['CONFIG']) OR count($_SESSION['CONFIG']) == 0) {
        $_SESSION['CONFIG'] = array();
        $arrConfig = array();
        $configSettingsSql = "SELECT * FROM config_settings";
        $configSettingsSqlResult = mysqli_query($con, $configSettingsSql);
        if ($configSettingsSqlResult) {
            while ($rowObj = mysqli_fetch_object($configSettingsSqlResult)) {
                $arrConfig[] = $rowObj;
                $_SESSION['CONFIG'] = $arrConfig;
                foreach ($_SESSION['CONFIG'] AS $Config) {
                    if ($Config->CS_option == $name) {
                        $output = $Config->CS_value;
                    }
                }
            }
        } else {
            if (DEBUG) {
                //$output = 'configSettingsSqlResult Error' . mysqli_error($con);
            } else {
                // $output = 'configSettingsSqlResult query failed.';
            }
        }
    } else {
        foreach ($_SESSION['CONFIG'] AS $Config) {
            if ($Config->CS_option == $name) {
                $output = $Config->CS_value;
            }
        }
    }

    return $output;
}

/**
 * show an array with pre tag<br/>
 * Default die false 
 * @return string  
 */
function printDie($array = array(), $die = FALSE) {
    /* this function used for print a array */

    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($die) {
        die("<b>This Die exicute from printDie function at helpers_functions file</b>");
    }
}

/**
 * query from databse for max value 
 * Example: Max id of a table
 * @return string or number 
 */
function getMaxValue($tableNmae = '', $fieldName = '') {
    global $con;
    if ($tableNmae != '' AND $fieldName != '') {
        $sql = "SELECT MAX($fieldName) AS max_value FROM $tableNmae";
        $sqlResult = mysqli_query($con, $sql);
        if ($sqlResult) {
            $sqlResultObjRow = mysqli_fetch_object($sqlResult);
            if (isset($sqlResultObjRow->max_value)) {
                return $sqlResultObjRow->max_value;
            } else {
                return 0; /* no max value set in object   */
            }
        } else {

            if (DEBUG) {
                echo 'Max value sqlResult error: ' . mysqli_error($con);
            } else {
                return 0; /* sql error  */
            }
        }
    } else {
        return 0; /* table or filed missing */
    }
}

function checkFiles($files) {
    $path = '';
    if (isset($_POST['path'])) {
        $path = $_POST['path'];
    }
    move_uploaded_file($files["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
}

/**
 * function which converts decimal to hours, minutes & seconds 
 * input type: decimal value
 * @return time difference 
 */
function convertTime($dec) {
    // start by converting to seconds
    $seconds = (int) ($dec * 3600);
    // we're given hours, so let's get those the easy way
    $hours = floor($dec);
    // since we've "calculated" hours, let's remove them from the seconds variable
    $seconds -= $hours * 3600;
    // calculate minutes left
    $minutes = floor($seconds / 60);
    // remove those from seconds as well
    $seconds -= $minutes * 60;
    // return the time formatted HH:MM:SS
    return lz($hours) . ":" . lz($minutes) . ":" . lz($seconds);
}

// lz = leading zero
function lz($num) {
    return (strlen($num) < 2) ? "0{$num}" : $num;
}

/**
 * based on $_SESSION['admin_type'] this function check resticted file 
 *  $file = only relative path of a file name
 *  example : admin/admin/index.php 
 * @return bool 
 */
function checkAdminAccess($file = '') {
    global $notAllow;
    global $config;
    if (checkAdminLogin()) {
        $adminType = getSession('admin_type');

        if (in_array(trim($file), $notAllow[$adminType])) {
            //not allow
            return FALSE;
        } else {
            //allow
            return TRUE;
        }
    }
}

/**
 * unset : admin_login, admin_id ,admin_email , admin_type, admin_hash,  admin_password, admin_name
 * @return bool 
 */
function AdminLogout() {
    unsetSession('admin_name');
    unsetSession('admin_email');
    unsetSession('admin_id');
    unsetSession('admin_type');
    unsetSession('admin_hash');
    unsetSession('admin_password');
    unsetSession('admin_event_id');
    unsetSession('admin_event_permission');
    unsetSession('admin_sales_report');
    unsetSession('admin_profit_report');
    unsetSession('admin_event_report');
    unsetSession('admin_user_report');
    return TRUE;
}

/**
 * Check:admin_login, admin_id ,admin_email , admin_type, admin_hash,  admin_password, admin_name
 * @return bool 
 */
function checkAdminLogin() {
    global $config;
    $status = array();

    if (getSession('admin_id') > 0) {
        $status[] = 1;
    }
    if (getSession('admin_email') != '') {
        $status[] = 2;
    }
    if (getSession('admin_type') != '') {
        $status[] = 3;
    }
    if (getSession('admin_hash') != '') {
        $status[] = 4;
    }
    if (getSession('admin_password') != '') {
        $status[] = 5;
    }
    if (getSession('admin_name') != '') {
        $status[] = 6;
    }
    if (getSession('admin_event_permission') != '') {
        $status[] = 7;
    }
    if (getSession('admin_sales_report') != '') {
        $status[] = 8;
    }
    if (getSession('admin_profit_report') != '') {
        $status[] = 9;
    }
    if (getSession('admin_event_report') != '') {
        $status[] = 10;
    }
    if (getSession('admin_user_report') != '') {
        $status[] = 11;
    }
    if (count($status) < 11 OR in_array(0, $status)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

/**
 * unset : admin_login, admin_id ,admin_email , admin_type, admin_hash,  admin_password, admin_name
 * @return bool 
 */
function UserLogout() {
    unsetSession('user_id');
    unsetSession('user_email');
    unsetSession('user_first_name');
    unsetSession('user_verification');
    unsetSession('user_hash');
    return TRUE;
}

/**
 * Check:admin_login, admin_id ,admin_email , admin_type, admin_hash,  admin_password, admin_name
 * @return bool 
 */
function checkUserLogin() {
    global $config;
    $status = array();

    if (getSession('user_id') > 0) {
        $status[] = 1;
    }

    if (getSession('user_email') != '') {
        $status[] = 2;
    }

    if (getSession('user_first_name') != '') {
        $status[] = 3;
    }

    if (getSession('user_verification') != '') {
        $status[] = 4;
    }
    if (getSession('user_hash') != '') {
        $status[] = 5;
    }


    if (count($status) < 5 OR in_array(0, $status)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

/**
 * query from databse for a field value<br> 
 * Example: id to title, id to email<br>
 * Example: $where : id=34 OR name='the name '<br>
 * if no where return first value <br>
 * $tableNmae = '', $fieldName = '', $where = ''
 * @return string 
 */
function getFieldValue($tableNmae = '', $fieldName = '', $where = '') {
    global $con;
    if ($tableNmae != '' AND $fieldName != '') {

        if ($where != '') {
            $sql = "SELECT $fieldName AS field_value FROM $tableNmae WHERE " . $where;
        } else {
            $sql = "SELECT $fieldName AS field_value FROM $tableNmae";
        }

        $sqlResult = mysqli_query($con, $sql);
        if ($sqlResult) {
            $sqlResultObjRow = mysqli_fetch_object($sqlResult);
            if (isset($sqlResultObjRow->field_value)) {
                return $sqlResultObjRow->field_value;
            } else {
                return 'Unknown'; /* no value in object   */
            }
        } else {

            if (DEBUG) {
                echo 'getFieldValue error: ' . mysqli_error($con);
            } else {
                return 'Unknown'; /* sql error  */
            }
        }
    } else {
        return 'Unknown'; /* table or filed missing */
    }
}

/** Error hendling for Zebra image lib
 * 
 * @param type $error
 * @return string
 */
function zebraImageErrorHandaling($error = 0) {
    switch ($error) {

        case 1:
            return 'Source file could not be found!';
            break;
        case 2:
            return 'Source file is not readable!';
            break;
        case 3:
            return 'Could not write target file!';
            break;
        case 4:
            return 'Unsupported source file format!';
            break;
        case 5:
            return 'Unsupported target file format!';
            break;
        case 6:
            return 'GD library version does not support target file format!';
            break;
        case 7:
            return 'GD library is not installed!';
            break;
        default :
            return '';
    }
}

function getCurrentDirectory() {
    $path = dirname($_SERVER['PHP_SELF']);
    $position = strrpos($path, '/') + 1;
    return substr($path, $position);
}

/**
 * Add Option For Config Setting
 * 
 * @return boolean
 */
function add_option($option_name = '', $option_value = '') {
    
}

/**
 * Update Option Value For Config Setting
 * 
 * @return boolean
 */
function update_option($option_name = '', $option_value = '') {
    $session_id = session_id();
    global $con;
    if ($option_name != '' && checkOptionName($option_name) == true) {
        $optionUpdateSql = "UPDATE config_settings SET CS_value = '$option_value', CS_updated_by = '$session_id' WHERE CS_option = '$option_name'";
        $optionUpdateResult = mysqli_query($con, $optionUpdateSql);
        if ($optionUpdateResult) {
            return true;
        }
    }
}

/**
 * Delete Option For Config Setting
 * 
 * @return boolean
 */
function delete_option($option_name = '') {
    
}

/**
 * Get Option Value For Config Setting
 * 
 * @return boolean
 */
function get_option($option_name = '') {
    global $con;
    if ($option_name != '' && checkOptionName($option_name) == true) {
        $optionGetSql = "SELECT CS_value FROM config_settings WHERE CS_option='$option_name'";
        $optionGetResult = mysqli_query($con, $optionGetSql);
        if ($optionGetResult) {
            $optionGetResultRowObj = mysqli_fetch_object($optionGetResult);
            if (isset($optionGetResultRowObj->CS_value)) {
                return $optionGetResultRowObj->CS_value;
            } else {
                return $option_name . " Not Found";
            }
        }
    } else {
        return $option_name . " Not Found";
    }
}

/**
 * Get Option Name For Config Setting
 * Check If The Name Contains Only Upper Case Letters [A-Z] And Or underscores(_).
 * @return boolean
 */
function checkOptionName($name = '') {
    if (preg_match("/^[A-Z_]+[A-Z]*$/", $name)) {
        // matches
        return true;
    } else {
        // doesn't match
        return false;
    }
}

/**
 * This removes special characters from a string<br> 
 * @return string 
 */
function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-_]/', '', $string); // Removes special chars.
}

/**
 * This function removes a word from last in a string<br> 
 * @return string 
 */
function removeWord($string) {
    $string = explode(" ", $string);
    array_splice($string, -2);
    return implode(" ", $string);
}

function extra_clean($string) {
    $pattern = '/-+/';
    $replacement = '-';
    $removeDoubleDash = preg_replace($pattern, $replacement, $string);
    $pattern = '/(-+)$/';
    $replacement = '';
    $removeEndDash = preg_replace($pattern, $replacement, $removeDoubleDash);
    return $allSmallCase = strtolower($removeEndDash);
}

/* =============================== Admin Permission Related Functions =============================== */

/**
 * This function reads the permission.xml file from config folder and returns an array<br> 
 * @return array
 */
function readPermissionXmlArray() {
    global $con;
    $arrPermission = array();
    $xmlUrl = basePath() . "config/permission.xml";

    if (file_exists($xmlUrl)) {
        $permissionParam = simplexml_load_file($xmlUrl) or die("Error: Cannot create object");
        $permissionParam = json_encode($permissionParam);
        $permissionParam = json_decode($permissionParam, TRUE);
        $arrPermission = $permissionParam;
    } else {
        $arrPermission = array("message" => "File not found in the location.");
    }
    return $arrPermission;
}

/* =============================== Admin Permission Related Functions =============================== */

/**
 * This removes special characters from a string<br> 
 * @return string 
 */
function validateInput($value = '') {
    $output = '';
    global $con;
    if ($value != "") {
        $output = trim($value);
        $output = strip_tags($output);
        if (is_int($output)) {
            $output = intval($output);
        } elseif (is_float($output)) {
            $output = floatval($output);
        } elseif (is_string($output)) {
            $output = mysqli_real_escape_string($con, $output);
        }
    }
    return $output;
}

/**
 * This function is used to generate registration form for event<br> 
 * @return string 
 */
function generateRegistrationForm($eventID = 0) {
    $output = '';
    global $con;

    if ($eventID > 0) {
        $arrForm = array();
        $sqlGetForm = "SELECT * FROM event_dynamic_forms WHERE form_event_id=$eventID AND form_type='info' AND form_field_status='active' ORDER BY form_field_priority DESC";
        $resultGetForm = mysqli_query($con, $sqlGetForm);
        if ($resultGetForm) {
            while ($resultGetFormObj = mysqli_fetch_object($resultGetForm)) {
                $arrForm[] = $resultGetFormObj;
            }
        } else {
            if (DEBUG) {
                $output = "resultGetForm error: " . mysqli_error($con);
            } else {
                $output = "resultGetForm query failed.";
            }
        }

        //generating form
        $arrFormValue = '';
        $isRequired = '';
        if (count($arrForm) > 0) {
            foreach ($arrForm AS $Form) {

                //breaking down the values of each form element
                if (!empty($Form->form_field_value_array)) {
                    $arrFormValue = explode(',', $Form->form_field_value_array);
                }
                //checking if this form field is required or not
                if ($Form->form_field_is_required == "yes") {
                    $isRequired = 'required';
                } else {
                    $isRequired = '';
                }


                //checking field type and writing the HTML accordingly
                if ($Form->form_field_type == "textbox") {

                    //checking if admin wants a date picker
                    if (strpos($Form->form_field_name, 'date') !== false AND strpos($Form->form_field_given_id, 'date') !== false) {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';
                        $output .= '<div class="col-md-8">';
                        $output .= '<div class="input-group date" id="' . $Form->form_field_given_id . '">';
                        $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        $output .= '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>';
                        $output .= '</span>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                        $output .= '<script type="text/javascript">
                                        $(function () {
                                            $("#' . $Form->form_field_given_id . '").datetimepicker({
                                                format: "YYYY-MM-DD"
                                            });
                                        });
                                    </script>';
                    } elseif (strpos($Form->form_field_name, 'email') !== false AND strpos($Form->form_field_given_id, 'email') !== false) {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';
                        $output .= '<div class="col-md-8">';
                        $output .= '<div class="input-group">';
                        $output .= '<span class="input-group-addon">@</span>';
                        $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                    } else {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';
                        $output .= '<div class="col-md-8">';
                        $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                    }
                } elseif ($Form->form_field_type == "radio") {
                    $output .= '<div class="form-group">';
                    $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                    if ($isRequired == 'required') {
                        $output .= '<span class="required">*</span>';
                    }
                    $output .= '</label>';
                    $output .= '<div class="col-md-8">';
                    if (count($arrFormValue) > 0) {
                        foreach ($arrFormValue AS $Value) {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" value="' . clean($Value) . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="radio" ' . $isRequired . ' />&nbsp;' . $Value . '&nbsp;&nbsp;&nbsp;';
                        }
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix"></div><br/>';
                } elseif ($Form->form_field_type == "checkbox") {
                    $output .= '<div class="form-group">';
                    $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                    if ($isRequired == 'required') {
                        $output .= '<span class="required">*</span>';
                    }
                    $output .= '</label>';
                    $output .= '<div class="col-md-8">';
                    if (count($arrFormValue) > 0) {
                        foreach ($arrFormValue AS $Value) {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" value="' . clean($Value) . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="checkbox" ' . $isRequired . ' />&nbsp;' . $Value . '&nbsp;&nbsp;&nbsp;';
                        }
                    }
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix"></div><br/>';
                } elseif ($Form->form_field_type == "selectbox") {
                    $output .= '<div class="form-group">';
                    $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                    if ($isRequired == 'required') {
                        $output .= '<span class="required">*</span>';
                    }
                    $output .= '</label>';
                    $output .= '<div class="col-md-8">';
                    $output .= '<select data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" class="form-control" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" ' . $isRequired . '>';
                    $output .= '<option value="">' . $Form->form_field_title . '</option>';
                    if (count($arrFormValue) > 0) {
                        foreach ($arrFormValue AS $Value) {
                            $output .= '<option value="' . clean($Value) . '">' . $Value . '</option>';
                        }
                    }
                    $output .= '</select>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix"></div><br/>';
                } elseif ($Form->form_field_type == "upload") {
                    $output .= '<div class="form-group">';
                    $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                    if ($isRequired == 'required') {
                        $output .= '<span class="required">*</span>';
                    }
                    $output .= '</label>';
                    $output .= '<div class="col-md-8">';
                    $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="file" ' . $isRequired . ' />';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix"></div><br/>';
                } elseif ($Form->form_field_type == "textarea") {
                    $output .= '<div class="form-group">';
                    $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                    if ($isRequired == 'required') {
                        $output .= '<span class="required">*</span>';
                    }
                    $output .= '</label>';
                    $output .= '<div class="col-md-8">';
                    $output .= '<textarea data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="file" ' . $isRequired . '></textarea>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix"></div><br/>';
                }
            }
            $output .= '<input type="hidden" name="eventID" value="' . $eventID . '" />';
            $output .= '<br/><br/>';
            $output .= '<div class="col-md-4">&nbsp;</div>';
            $output .= '<div class="col-md-8">';
            $output .= '<input type="button" class="btn btn-primary" value="Submit" onclick="javascript:saveRegistration();">';
            $output .= '';
            $output .= '</div>';
        }

        return $output;
    }
}

function generateRegistrationForm_beatch_custom($eventID = 0) {
    $output = '';
    global $con;



    if ($eventID > 0) {

        $sqlfet = mysqli_query($con, "SELECT event_id,event_is_eticket_user_image as status FROM events WHERE event_id='" . $eventID . "'");
        $chk = mysqli_num_rows($sqlfet);
        if ($chk != 0) {
            while ($row = mysqli_fetch_object($sqlfet)):
                $exdata[] = $row;
            endwhile;
            $event_status = $exdata[0]->status;
        }

        $arrForm = array();
        $sqlGetForm = "SELECT * FROM event_dynamic_forms WHERE form_event_id=$eventID AND form_type='subs' AND form_field_status='active' ORDER BY form_field_priority DESC";
        $resultGetForm = mysqli_query($con, $sqlGetForm);
        if ($resultGetForm) {
            while ($resultGetFormObj = mysqli_fetch_object($resultGetForm)) {
                $arrForm[] = $resultGetFormObj;
            }
        } else {
            if (DEBUG) {
                $output = "resultGetForm error: " . mysqli_error($con);
            } else {
                $output = "resultGetForm query failed.";
            }
        }


        $userID = getSession('user_id');
        $user_email = getSession('user_email');

        $userInfoQuery = "SELECT * FROM users WHERE user_id = $userID AND user_email = '$user_email'";
        $userInfoResult = mysqli_query($con, $userInfoQuery);
        if ($userInfoResult) {
            $userInfo = mysqli_fetch_object($userInfoResult);
            $user_first_name = $userInfo->user_first_name;
            $user_email = $userInfo->user_email;
            $user_last_name = $userInfo->user_last_name;
            $user_full_name = $user_first_name . " " . $user_last_name;
            $user_phone = $userInfo->user_phone;
            $user_street_address = $userInfo->user_street_address;
            $user_zip = $userInfo->user_zip;
            $user_social_type = $userInfo->user_social_type;
            $user_verification = $userInfo->user_verification;
        } else {
            if (DEBUG) {
                $err = "userInfoResult error: " . mysqli_error($con);
            } else {
                $err = "userInfoResult query failed";
            }
        }


        //generating form
        $arrFormValue = '';
        $isRequired = '';
        if (count($arrForm) > 0) {
            foreach ($arrForm AS $Form) {

                //breaking down the values of each form element
                if (!empty($Form->form_field_value_array)) {
                    $arrFormValue = explode(',', $Form->form_field_value_array);
                }
                //checking if this form field is required or not
                if ($Form->form_field_is_required == "yes") {
                    $isRequired = 'required';
                } else {
                    $isRequired = '';
                }




                //checking field type and writing the HTML accordingly
                if ($Form->form_field_type == "textbox") {
                    if ($Form->form_field_priority == "0") {

                        if ($Form->form_field_name == "name") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_full_name . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "stall_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "hotel_room_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "address") {
                            if ($user_street_address == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_street_address . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "mobile_no") {
                            if ($user_phone == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_phone . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "email") {
                            if ($user_email == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_email . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } else {
                            $output .= '<div class="form-group">';
                            $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                            if ($isRequired == 'required') {
                                $output .= '<span class="required">*</span>';
                            }
                            $output .= '</label>';
                            $output .= '<div class="col-md-8">';
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="clearfix"></div><br/>';
                        }
                    } else {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';

                        if ($Form->form_field_name == "Gender") {
                            $output .= '<div class="col-md-8">';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_0" class="form-control" type="radio" value="Male" ' . $isRequired . ' /> Male &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_1" class="form-control" type="radio" value="Female"  ' . $isRequired . ' /> Female &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_2" class="form-control" type="radio" value="Other"  ' . $isRequired . ' /> Other <label>';
                        } elseif ($Form->form_field_name == "Age") {
                            $output .= '<div class="col-md-8">';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_0" class="form-control" type="radio" value="16-24" ' . $isRequired . ' /> 16-24 &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_1" class="form-control" type="radio" value="25-34"  ' . $isRequired . ' /> 25-34 &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_2" class="form-control" type="radio" value="35-45"  ' . $isRequired . ' /> 35-45 &nbsp; &nbsp;  <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_3" class="form-control" type="radio" value="46+"  ' . $isRequired . ' /> 46+ &nbsp; &nbsp;  <label>';
                        } elseif ($Form->form_field_name == "How did you get to know about Social Business Youth Summit 2016? (100 words max)") {
                            $output .= '<div class="col-md-4">';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_0" class="form-control" type="radio" value="Social Media" ' . $isRequired . ' /> Social Media &nbsp; &nbsp; <label>';
                            $output .= '<div class="clearfix" style="margin-top:5px;"></div>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_1" class="form-control" type="radio" value="TicketChai" ' . $isRequired . ' /> TicketChai &nbsp; &nbsp; <label>';
                            $output .= '<div class="clearfix" style="margin-top:5px;"></div>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_2" class="form-control" type="radio" value="Website"  ' . $isRequired . ' /> Website &nbsp; &nbsp; <label>';
                            $output .= '<div class="clearfix" style="margin-top:5px;"></div>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_3" class="form-control" type="radio" value="Campus Representative"  ' . $isRequired . ' /> Campus Representative &nbsp; &nbsp;  <label>';
                            $output .= '<div class="clearfix" style="margin-top:5px;"></div>';
                            $output .= '<label style="margin-right:10px;  margin-left:-6px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '_4" class="form-control" type="radio" value="Others"  ' . $isRequired . ' /> Others &nbsp; &nbsp;  <label>';
                        } elseif ($Form->form_field_name == "Past Attendence") {
                            $output .= '<div class="col-md-8">';
                            $output .= '<div class="col-md-12"><label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . str_replace(" ", "_", $Form->form_field_given_id) . '_0" class="form-control" type="radio" value="Yes" ' . $isRequired . ' /> Yes &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . str_replace(" ", "_", $Form->form_field_given_id) . '_1" class="form-control" type="radio" value="No"  ' . $isRequired . ' /> No &nbsp; &nbsp; <label></div>';
                            ?>
                            <script>
                                $(document).ready(function () {
                                    $('input#Past_Attendence_0').on('ifChecked', function () {
                                        if (document.getElementById("Past_Attendence_0").checked == true)
                                        {
                                            $("#poststryes").show('slow');
                                        }

                                    });

                                    $('input#Past_Attendence_1').on('ifChecked', function () {
                                        $("#poststryes").hide('slow');

                                    });

                                });
                            </script>    
                            <?php

                            $output .= '<div style="display:none; padding-left:17px; clear:both;" id="poststryes"><div class="clearfix" style="margin-right:10px; display:block; clear:both;"></div><label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="poststryes_0" class="form-control" type="radio" value="2014" ' . $isRequired . ' /> 2014 &nbsp; &nbsp; <label>';
                            $output .= '<label style="margin-right:10px; clear:both;"><input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="poststryes_1" class="form-control" type="radio" value="2015"  ' . $isRequired . ' /> 2015 &nbsp; &nbsp; <label></div>';
                        } else {
                            $output .= '<div class="col-md-8">';
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        }
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                    }
                }
            }

            if ($event_status == "yes") {
                $output .= '<div class="form-group">';

                $output .= '<label class="col-md-4 control-label">Please Upload Your Photo ';
                $output .= '<span class="required">*</span>';
                $output .= '</label>';
                $output .= '<div class="col-md-8"><img id="upload_photo_option"  src="' . baseUrl() . '/images/upload_icon.png" style="width:100px;" class="img-responsive"> 
                        <img id="upload_photo"  style="width:100px; display:none; margin-top:-90px;"  src="' . baseUrl() . 'images/gears.gif" class="img-responsive pull-right"></div>';
                $output .= '<div class="col-md-8" style="width:0px; height:0px; opacity:0;">';

                $output .= '<input data-key="' . time() . '"  data-name="Your Photo"  onchange="getfilename()" name="upload_image_eticket"  id="upload_image_eticket"   type="file" required />';
                $output .= '</div>';
                $output .= '</div><span class="col-md-offset-4 text-info text-center" id="fileplace"></span>';
                $output .= '<div class="clearfix"></div><br/>';

                $output .= '<script src="' . baseUrl() . 'custom_javascript/cropbox.js"></script><script>';
                $output .= '$(document).ready(function(){
                        $("#upload_photo_option").click(function(){
                        $("input[name=upload_image_eticket]").click();
                        });
                        var options =
                        {
                            imgSrc:"' . baseUrl() . 'images/gears.gif"
                        }
                        $("#upload_image_eticket").on("change", function(){
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                options.imgSrc = e.target.result;
                                $("#upload_photo").attr("src",e.target.result);
                                $("#imgsource").val(e.target.result);
                            }
                            
                            reader.readAsDataURL(this.files[0]);
                            this.files = [];
                        });

                        });
                        
                        function getfilename()
                        {
                            var filen=$("input[name=upload_image_eticket]").val();
                            $("#fileplace").html(filen);
                            $("#upload_photo").show();
                            $("#imgstatus").val("1");
                        }
                        ';


                $output .= '</script>';
            }

            $output .= '<input type="hidden" name="eventID" value="' . $eventID . '" />';
            $output .= '<br/><br/>';
            $output .= '<div class="col-md-4">&nbsp;</div>';
            $output .= '<div class="col-md-8">';
            $output .= '<input type="button" class="btn btn-primary" value="Submit" onclick="javascript:saveRegistration();">';
            $output .= '';
            $output .= '</div>';
        }

        return $output;
    }
}

function generateRegistrationForm_beatch($eventID = 0) {
    $output = '';
    global $con;



    if ($eventID > 0) {

        $sqlfet = mysqli_query($con, "SELECT event_id,event_is_eticket_user_image as status FROM events WHERE event_id='" . $eventID . "'");
        $chk = mysqli_num_rows($sqlfet);
        if ($chk != 0) {
            while ($row = mysqli_fetch_object($sqlfet)):
                $exdata[] = $row;
            endwhile;
            $event_status = $exdata[0]->status;
        }

        $arrForm = array();
        $sqlGetForm = "SELECT * FROM event_dynamic_forms WHERE form_event_id=$eventID AND form_type='subs' AND form_field_status='active' ORDER BY form_field_priority DESC";
        $resultGetForm = mysqli_query($con, $sqlGetForm);
        if ($resultGetForm) {
            while ($resultGetFormObj = mysqli_fetch_object($resultGetForm)) {
                $arrForm[] = $resultGetFormObj;
            }
        } else {
            if (DEBUG) {
                $output = "resultGetForm error: " . mysqli_error($con);
            } else {
                $output = "resultGetForm query failed.";
            }
        }


        $userID = getSession('user_id');
        $user_email = getSession('user_email');

        $userInfoQuery = "SELECT * FROM users WHERE user_id = $userID AND user_email = '$user_email'";
        $userInfoResult = mysqli_query($con, $userInfoQuery);
        if ($userInfoResult) {
            $userInfo = mysqli_fetch_object($userInfoResult);
            $user_first_name = $userInfo->user_first_name;
            $user_email = $userInfo->user_email;
            $user_last_name = $userInfo->user_last_name;
            $user_full_name = $user_first_name . " " . $user_last_name;
            $user_phone = $userInfo->user_phone;
            $user_street_address = $userInfo->user_street_address;
            $user_zip = $userInfo->user_zip;
            $user_social_type = $userInfo->user_social_type;
            $user_verification = $userInfo->user_verification;
        } else {
            if (DEBUG) {
                $err = "userInfoResult error: " . mysqli_error($con);
            } else {
                $err = "userInfoResult query failed";
            }
        }


        //generating form
        $arrFormValue = '';
        $isRequired = '';
        if (count($arrForm) > 0) {
            foreach ($arrForm AS $Form) {

                //breaking down the values of each form element
                if (!empty($Form->form_field_value_array)) {
                    $arrFormValue = explode(',', $Form->form_field_value_array);
                }
                //checking if this form field is required or not
                if ($Form->form_field_is_required == "yes") {
                    $isRequired = 'required';
                } else {
                    $isRequired = '';
                }


                //checking field type and writing the HTML accordingly
                if ($Form->form_field_type == "textbox") {
                    if ($Form->form_field_priority == "0") {

                        if ($Form->form_field_name == "name") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_full_name . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "stall_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "hotel_room_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "address") {
                            if ($user_street_address == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_street_address . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "mobile_no") {
                            if ($user_phone == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_phone . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "email") {
                            if ($user_email == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_email . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } else {
                            $output .= '<div class="form-group">';
                            $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                            if ($isRequired == 'required') {
                                $output .= '<span class="required">*</span>';
                            }
                            $output .= '</label>';
                            $output .= '<div class="col-md-8">';
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="clearfix"></div><br/>';
                        }
                    } else {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';
                        $output .= '<div class="col-md-8">';
                        $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                    }
                }
            }

            if ($event_status == "yes") {
                $output .= '<div class="form-group">';

                $output .= '<label class="col-md-4 control-label">Please Upload Your Photo ';
                $output .= '<span class="required">*</span>';
                $output .= '</label>';
                $output .= '<div class="col-md-8"><img id="upload_photo_option"  src="' . baseUrl() . '/images/upload_icon.png" style="width:100px;" class="img-responsive"> 
                        <img id="upload_photo"  style="width:100px; display:none; margin-top:-90px;"  src="' . baseUrl() . 'images/gears.gif" class="img-responsive pull-right"></div>';
                $output .= '<div class="col-md-8" style="width:0px; height:0px; opacity:0;">';

                $output .= '<input data-key="' . time() . '"  data-name="Your Photo"  onchange="getfilename()" name="upload_image_eticket"  id="upload_image_eticket"   type="file" required />';
                $output .= '</div>';
                $output .= '</div><span class="col-md-offset-4 text-info text-center" id="fileplace"></span>';
                $output .= '<div class="clearfix"></div><br/>';

                $output .= '<script src="' . baseUrl() . 'custom_javascript/cropbox.js"></script><script>';
                $output .= '$(document).ready(function(){
                        $("#upload_photo_option").click(function(){
                        $("input[name=upload_image_eticket]").click();
                        });
                        var options =
                        {
                            imgSrc:"' . baseUrl() . 'images/gears.gif"
                        }
                        $("#upload_image_eticket").on("change", function(){
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                options.imgSrc = e.target.result;
                                $("#upload_photo").attr("src",e.target.result);
                                $("#imgsource").val(e.target.result);
                            }
                            
                            reader.readAsDataURL(this.files[0]);
                            this.files = [];
                        });

                        });
                        
                        function getfilename()
                        {
                            var filen=$("input[name=upload_image_eticket]").val();
                            $("#fileplace").html(filen);
                            $("#upload_photo").show();
                            $("#imgstatus").val("1");
                        }
                        ';


                $output .= '</script>';
            }

            $output .= '<input type="hidden" name="eventID" value="' . $eventID . '" />';
            $output .= '<br/><br/>';
            $output .= '<div class="col-md-4">&nbsp;</div>';
            $output .= '<div class="col-md-8">';
            $output .= '<input type="button" class="btn btn-primary" value="Submit" onclick="javascript:saveRegistration();">';
            $output .= '';
            $output .= '</div>';
        }

        return $output;
    }
}

function generateRegistrationFormOnlyRegistration($eventID = 0) {
    $output = '';
    global $con;



    if ($eventID > 0) {

        $sqlfet = mysqli_query($con, "SELECT event_id,event_is_eticket_user_image as status FROM events WHERE event_id='" . $eventID . "'");
        $chk = mysqli_num_rows($sqlfet);
        if ($chk != 0) {
            while ($row = mysqli_fetch_object($sqlfet)):
                $exdata[] = $row;
            endwhile;
            $event_status = $exdata[0]->status;
        }

        $arrForm = array();
        $sqlGetForm = "SELECT * FROM event_dynamic_forms WHERE form_event_id=$eventID AND form_type='subs' AND form_field_status='active' ORDER BY form_field_priority DESC";
        $resultGetForm = mysqli_query($con, $sqlGetForm);
        if ($resultGetForm) {
            while ($resultGetFormObj = mysqli_fetch_object($resultGetForm)) {
                $arrForm[] = $resultGetFormObj;
            }
        } else {
            if (DEBUG) {
                $output = "resultGetForm error: " . mysqli_error($con);
            } else {
                $output = "resultGetForm query failed.";
            }
        }


        $userID = getSession('user_id');
        $user_email = getSession('user_email');

        $userInfoQuery = "SELECT * FROM users WHERE user_id = $userID AND user_email = '$user_email'";
        $userInfoResult = mysqli_query($con, $userInfoQuery);
        if ($userInfoResult) {
            $userInfo = mysqli_fetch_object($userInfoResult);
            $user_first_name = $userInfo->user_first_name;
            $user_email = $userInfo->user_email;
            $user_last_name = $userInfo->user_last_name;
            $user_full_name = $user_first_name . " " . $user_last_name;
            $user_phone = $userInfo->user_phone;
            $user_street_address = $userInfo->user_street_address;
            $user_zip = $userInfo->user_zip;
            $user_social_type = $userInfo->user_social_type;
            $user_verification = $userInfo->user_verification;
        } else {
            if (DEBUG) {
                $err = "userInfoResult error: " . mysqli_error($con);
            } else {
                $err = "userInfoResult query failed";
            }
        }


        //generating form
        $arrFormValue = '';
        $isRequired = '';
        if (count($arrForm) > 0) {
            foreach ($arrForm AS $Form) {

                //breaking down the values of each form element
                if (!empty($Form->form_field_value_array)) {
                    $arrFormValue = explode(',', $Form->form_field_value_array);
                }
                //checking if this form field is required or not
                if ($Form->form_field_is_required == "yes") {
                    $isRequired = 'required';
                } else {
                    $isRequired = '';
                }


                //checking field type and writing the HTML accordingly
                if ($Form->form_field_type == "textbox") {
                    if ($Form->form_field_priority == "0") {

                        if ($Form->form_field_name == "name") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_full_name . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "stall_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "hotel_room_no") {
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                        } elseif ($Form->form_field_name == "address") {
                            if ($user_street_address == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_street_address . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "mobile_no") {
                            if ($user_phone == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_phone . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } elseif ($Form->form_field_name == "email") {
                            if ($user_email == "") {
                                $output .= '<div class="form-group">';
                                $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                                if ($isRequired == 'required') {
                                    $output .= '<span class="required">*</span>';
                                }
                                $output .= '</label>';
                                $output .= '<div class="col-md-8">';
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                                $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="clearfix"></div><br/>';
                            } else {
                                $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" value="' . $user_email . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="hidden" ' . $isRequired . ' />';
                            }
                        } else {
                            $output .= '<div class="form-group">';
                            $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                            if ($isRequired == 'required') {
                                $output .= '<span class="required">*</span>';
                            }
                            $output .= '</label>';
                            $output .= '<div class="col-md-8">';
                            $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '"  data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';

                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="clearfix"></div><br/>';
                        }
                    } else {
                        $output .= '<div class="form-group">';
                        $output .= '<label class="col-md-4 control-label">' . $Form->form_field_title . ' ';
                        if ($isRequired == 'required') {
                            $output .= '<span class="required">*</span>';
                        }
                        $output .= '</label>';
                        $output .= '<div class="col-md-8">';
                        $output .= '<input data-key="' . $Form->form_id . '" data-unique="' . $Form->form_field_is_unique . '" data-name="' . $Form->form_field_title . '" name="' . $Form->form_field_name . '|' . $Form->form_id . '" id="' . $Form->form_field_given_id . '" class="form-control" type="text" ' . $isRequired . ' />';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="clearfix"></div><br/>';
                    }
                }
            }

            if ($event_status == "yes") {
                $output .= '<div class="form-group">';

                $output .= '<label class="col-md-4 control-label">Please Upload Your Photo ';
                $output .= '<span class="required">*</span>';
                $output .= '</label>';
                $output .= '<div class="col-md-8"><img id="upload_photo_option"  src="' . baseUrl() . '/images/upload_icon.png" style="width:100px;" class="img-responsive"> 
                        <img id="upload_photo"  style="width:100px; display:none; margin-top:-90px;"  src="' . baseUrl() . 'images/gears.gif" class="img-responsive pull-right"></div>';
                $output .= '<div class="col-md-8" style="width:0px; height:0px; opacity:0;">';

                $output .= '<input data-key="' . time() . '"  data-name="Your Photo"  onchange="getfilename()" name="upload_image_eticket"  id="upload_image_eticket"   type="file" required />';
                $output .= '</div>';
                $output .= '</div><span class="col-md-offset-4 text-info text-center" id="fileplace"></span>';
                $output .= '<div class="clearfix"></div><br/>';

                $output .= '<script src="' . baseUrl() . 'custom_javascript/cropbox.js"></script><script>';
                $output .= '$(document).ready(function(){
                        $("#upload_photo_option").click(function(){
                        $("input[name=upload_image_eticket]").click();
                        });
                        var options =
                        {
                            imgSrc:"' . baseUrl() . 'images/gears.gif"
                        }
                        $("#upload_image_eticket").on("change", function(){
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                options.imgSrc = e.target.result;
                                $("#upload_photo").attr("src",e.target.result);
                                $("#imgsource").val(e.target.result);
                            }
                            
                            reader.readAsDataURL(this.files[0]);
                            this.files = [];
                        });

                        });
                        
                        function getfilename()
                        {
                            var filen=$("input[name=upload_image_eticket]").val();
                            $("#fileplace").html(filen);
                            $("#upload_photo").show();
                            $("#imgstatus").val("1");
                        }
                        ';


                $output .= '</script>';
            }

            $output .= '<input type="hidden" name="eventID" value="' . $eventID . '" />';
            $output .= '<br/><br/>';
            $output .= '<div class="col-md-4">&nbsp;</div>';
            $output .= '<div class="col-md-8">';
            $output .= '<input type="button" class="btn btn-primary" value="Submit" onclick="javascript:saveRegistrationOnly();">';
            $output .= '';
            $output .= '</div>';
        }

        return $output;
    }
}

//D:\XAMPP\htdocs\ticketchai\lib\helper_functions.php
/**
 * This function is used to check if a specific user have access to specific module and specific task<br> 
 * @return boolean
 */
function checkPermission($module = '', $action = '', $adminTypeID = 0) {

    global $con;
    $status = '';
    $strPermission = '';

    if ($module != "" AND $action != "" AND $adminTypeID > 0) {
        $strPermission = $module . ',' . $action;

        if (isset($_SESSION['ADMIN_PERMISSION']) AND count($_SESSION['ADMIN_PERMISSION']) > 0) {
            if (in_array($strPermission, $_SESSION['ADMIN_PERMISSION'])) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }
        } else {
            $arrExistPermission = array();
            $sqlGetPermission = "SELECT * FROM admin_permission WHERE AP_AT_id=$adminTypeID";
            $resultGetPermission = mysqli_query($con, $sqlGetPermission);
            if ($resultGetPermission) {
                while ($resultGetPermissionObj = mysqli_fetch_object($resultGetPermission)) {
                    $arrExistPermission[] = $resultGetPermissionObj->AP_module_name . "," . $resultGetPermissionObj->AP_action_name;
                    $_SESSION['ADMIN_PERMISSION'] = $arrExistPermission;
                    if (in_array($strPermission, $_SESSION['ADMIN_PERMISSION'])) {
                        $status = TRUE;
                    } else {
                        $status = FALSE;
                    }
                }
            } else {
                if (DEBUG) {
                    $status = "resultGetPermission error: " . mysqli_error($con);
                } else {
                    $status = "resultGetPermission query failed.";
                }
            }
        }
        return $status;
    } else {
        return $status = "Incorrect parameters";
    }
}

/**
 * This function is used to generate random string<br> 
 * @return String
 */
function randCode($length) {
    $random = "";
    srand((double) microtime() * 1000000);

    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
    $data .= "0FGH45OP89";

    for ($i = 0; $i < $length; $i++) {
        $random .= substr($data, (rand() % (strlen($data))), 1);
    }
    return $random;
}
?>