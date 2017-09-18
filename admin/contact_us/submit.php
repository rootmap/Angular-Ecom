<?php
include '../../config/config.php';
if (!checkAdminLogin()) {
    echo 0;
} else {
$data = array();

if(isset($_GET['files']))
{  
    $error = false;
    $files = array();

    $uploaddir = './uploads/';
    foreach($_FILES as $file)
    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
        {
            $files[] = $uploaddir .$file['name'];
            $file_name_for_return=$file['name'];
            
            @include('reader.php');
            @$excel = new Spreadsheet_Excel_Reader();

            @$excel->setOutputEncoding('CP1251');
            @$excel->read('uploads/'.$file_name_for_return); 

            $s=0;
            $f=0;
            $datas='';
            for($i=1; $i<=$excel->sheets[0]['numRows']; $i++)
            {
                
                    
                if($i!=1)
                {
                    
                    
                    
                    @$firstName=$excel->sheets[0]["cells"][$i][1];
                    @$lastName=$excel->sheets[0]["cells"][$i][2];
                    @$gender=$excel->sheets[0]["cells"][$i][3];
                    @$phone=$excel->sheets[0]["cells"][$i][4];
                    @$email=$excel->sheets[0]["cells"][$i][5];
                    
                    @$full_name=$firstName." ".$lastName;
                    
                    $sqlquery_insert="INSERT INTO subscribe_customer_list (full_name,email,phone,gender,date,status) VALUES ('$full_name','$email','$phone','$gender','".date('Y-m-d')."','1')";
                    
                    $sqlquery_check="SELECT email from subscribe_customer_list WHERE email='$email'";
                    
                    
                    $sqlcheck=  mysqli_query($con,$sqlquery_check);
                    $sqlrowcount=  mysqli_num_rows($sqlcheck);
                    
                    if($sqlrowcount==0)
                    {
                        $msghi="Saved";
                        $dd=mysqli_query($con,$sqlquery_insert);
                    }
                    else
                    {
                        $msghi="Exists";
                    }
                    
                   
                    @$datas .="<tr>";
                    @$datas .="<td>".$i."</td>";
                    @$datas .="<td>".$full_name."</td>";
                    @$datas .="<td>".$gender."</td>";
                    @$datas .="<td>".$email."</td>";
                    @$datas .="<td>".$phone."</td>";
                    @$datas .="<td>(".$msghi.")</td>";
                    @$datas .="</tr>";
                    
                    
                }    
                    
                
            }
            //exit();
            
            
        }
        else
        {
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files'=>$datas);
}
else
{
    $data = array('success' => 'Form was submitted','formData' => $_POST);
}

echo json_encode($data);
}