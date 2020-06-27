<?php 
require_once '/var/www/html/admin/config/config.php';

$upload = 'err'; 
    if(!empty($_FILES['files'])){ 
        $targetDir = "/var/www/html/admin/uploads/"; 
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
        $fileNames = array_filter($_FILES['files']['name']); 
        if(!empty($fileNames)){ 
            foreach($_FILES['files']['name'] as $key=>$val){ 
                $fileName = uniqid().'-'.substr(basename($_FILES['files']['name'][$key]),0,25); 
                $targetFilePath = $targetDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        $insertValuesSQL .= "".$fileName.","; 
                        
                    }
                }
            } 
             
                if(!empty($insertValuesSQL)){ 
                    $insertValuesSQL = trim($insertValuesSQL, ','); 
                    $db = getDbInstance();
                    $data_to_db['file_name'] = $insertValuesSQL;
                    $db->where('id', $_POST['id']);
                    $stat = $db->update('associate_products', $data_to_db);
                    if($stat){
                        $upload ='ok';
                    }

                } 
            
            }     
       
    } 

echo $upload;


?>