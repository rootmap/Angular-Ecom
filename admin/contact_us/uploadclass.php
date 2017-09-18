<?php
class UploadFiles
{
    
    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
        
    }
    
    function fileUpload($filup,$name, $destination) {
            if (is_uploaded_file($_FILES[$filup]['tmp_name'])) {
				$extension=$this->getExtension($_FILES[$filup]['name']);
				$convertlower=strtolower($extension);
				if($convertlower!='php' || $convertlower!='bat' || $convertlower!='exe' || $convertlower!='dat' || $convertlower!='xss' || $convertlower!='js' || $convertlower!='json' || $convertlower!='cgi' || $convertlower!='mpeg')
				{
				   $filename=$name.".".$extension;
                   $result = move_uploaded_file($_FILES[$filup]['tmp_name'], $destination."/".$filename);
                  	if ($result == 1)
					{
						return $filename;
					}
					else 
					{
					  return 0;
					}
				}
				else
				{
					return 0;
				}
            }
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

