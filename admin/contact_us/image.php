<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    $link = baseUrl() . 'admin/login.php?err=' . base64_encode("You need to login first.");
    redirect($link);
}



extract($_POST);
define('UPLOAD_DIR', './image/');
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace('data:image/gif;base64,', '', $img);
$img = str_replace('data:image/bmp;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$new_data=explode(";",$_POST['img']);
$type=substr($new_data[0],11,100);

$image_name=uniqid() . '.'.$type;
$file = UPLOAD_DIR . $image_name;		
$success = file_put_contents($file, $data);

function uploadFiximageFromString($destination,$file,$pre,$data) {
        list($width, $height, $type, $attr) = getimagesize($file);		
		if($width>=960)
		{
			$dividewidth=round($width/3,0);
			$divideheight=round($height/3,0);
			$new_width=$dividewidth;
			$new_height=$divideheight;				
		}
		else
		{
			$new_width=$width;
			$new_height=$height;
		}
		$imagess = imagecreatefromstring($data);
		$tmp = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($tmp, false);
        imagesavealpha($tmp, true);
        $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
        imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
        
        imagecopyresized($tmp, $imagess, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		$info = getimagesize($file);
		switch (image_type_to_mime_type($info[2])) {
            case 'image/jpeg':
				$image_nameret=$pre."".time().".jpg";
                imagejpeg($tmp,$destination. '/'.$image_nameret, 100);
                break;
            case 'image/png':
				$image_nameret=$pre."".time().".png";
                imagepng($tmp,$destination. '/'.$image_nameret, 0);
                break;
            case 'image/gif':
				$image_nameret=$pre."".time().".gif";
                imagegif($tmp,$destination. '/'.$image_nameret);
                break;
            default:
                exit;
                break;
        }
		
        return $image_nameret;
        imagedestroy($imagess);
        imagedestroy($tmp);
    }
    
    
 if($st==2)
 {
    $image_success=uploadFiximageFromString(UPLOAD_DIR,$file,"status",$data);
    $array=  array("image_name"=>$image_name,"status"=>1);
    echo json_encode($array);
 }
 else 
 {
    $array=  array("image_name"=>"","status"=>0);
    echo json_encode($array);
 }
?>