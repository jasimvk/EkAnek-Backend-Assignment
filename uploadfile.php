<?php 

error_reporting(E_ERROR | E_PARSE);
include('security.php');


if(isset($_POST['uploadfilebtn']))
    {
         error_reporting(E_ERROR | E_PARSE);
 
          $name= $_FILES['file']['name'];

            $tmp_name= $_FILES['file']['tmp_name'];
            $size= $_FILES['file']['size'];
            if ($size > 500000) {
                $_SESSION['status'] = "File is too large";
                header('Location: public_folder.php');
            }    
         $submitbutton= $_POST['submit'];

         $position= strpos($name, "."); 

         $fileextension= substr($name, $position + 1);

         $fileextension= strtolower($fileextension);

         $description= $_POST['Description'];
  
  
  
      

         $path= 'Uploads/';
        
         if (!empty($name)){  if (file_exists($name)) {
            $_SESSION['status'] = "Could not save";
            
          }
           // Check file size
         else if ($size > 500000) {
            $_SESSION['status'] = "Could not save";
          }
          if($fileextension != "jpg" && $fileextension != "png" && $fileextension != "jpeg"
         && $fileextension != "pdf" &&  $fileextension != "xlsx" &&  $fileextension != "docx") {
            $_SESSION['status'] = "Could not save";
    
         }
            if (move_uploaded_file($tmp_name, $path.$name)) {
            
                        $query = "INSERT INTO files (description, filename)
                        VALUES ('$description', '$name')";
                        $query_run = mysqli_query($connection, $query); 
                    
                        if($query_run)
                                {
                                    $_SESSION['success'] =  "Your FILE is added";
                                    header('Location: public_folder.php');
                                }
                                else
                                {
                                    $_SESSION['status'] = "Yor FILE is NOT Added";
                                    header('Location: public_folder.php');
                                }
                
                    }
            }
    }
         
?>